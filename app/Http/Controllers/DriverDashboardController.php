<?php

namespace App\Http\Controllers;

use App\Models\DeliveryDriver;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class DriverDashboardController extends Controller
{
    public function index(): View
    {
        $driver = DeliveryDriver::query()
            ->where('user_id', auth('web')->id())
            ->firstOrFail();

        $activeOrdersList = Order::query()
            ->with(['restaurant'])
            ->where('delivery_driver_id', $driver->id)
            ->whereIn('fulfillment_status', [
                'ready',
                'dispatched',
            ])
            ->latest('placed_at')
            ->get();

        $activeOrdersList = $this->attachRoutePriorityData($activeOrdersList, $driver);

        $recommendedNextOrder = $activeOrdersList
            ->filter(fn ($order) => $order->route_distance_km !== null)
            ->sortBy('route_distance_km')
            ->first();

        if (! $recommendedNextOrder) {
            $recommendedNextOrder = $activeOrdersList->first();
        }

        $currentOrder = $recommendedNextOrder ?? $activeOrdersList->first();

        $activeOrdersCount = $activeOrdersList->count();

        $completedOrdersCount = Order::query()
            ->where('delivery_driver_id', $driver->id)
            ->whereIn('fulfillment_status', [
                'delivered',
                'completed',
            ])
            ->count();

        return view('driver.dashboard', [
            'driver' => $driver,
            'currentOrder' => $currentOrder,
            'activeOrdersList' => $activeOrdersList,
            'recommendedNextOrder' => $recommendedNextOrder,
            'activeOrdersCount' => $activeOrdersCount,
            'completedOrdersCount' => $completedOrdersCount,
        ]);
    }

    protected function attachRoutePriorityData(Collection $orders, DeliveryDriver $driver): Collection
    {
        return $orders->map(function ($order) use ($driver) {
            $distance = $this->calculateDistanceKm(
                $driver->current_latitude,
                $driver->current_longitude,
                $order->delivery_latitude,
                $order->delivery_longitude
            );

            $order->route_distance_km = $distance;

            if ($distance !== null) {
                $order->route_priority_reason = 'Recommended based on the shortest distance from the driver location.';
            } elseif ($order->fulfillment_status === 'dispatched') {
                $order->route_priority_reason = 'Recommended because this order is already dispatched.';
            } else {
                $order->route_priority_reason = 'Recommended based on active delivery status.';
            }

            return $order;
        });
    }

    protected function calculateDistanceKm($fromLat, $fromLng, $toLat, $toLng): ?float
    {
        if (
            $fromLat === null ||
            $fromLng === null ||
            $toLat === null ||
            $toLng === null
        ) {
            return null;
        }

        $earthRadiusKm = 6371;

        $latFrom = deg2rad((float) $fromLat);
        $lngFrom = deg2rad((float) $fromLng);
        $latTo = deg2rad((float) $toLat);
        $lngTo = deg2rad((float) $toLng);

        $latDelta = $latTo - $latFrom;
        $lngDelta = $lngTo - $lngFrom;

        $a = sin($latDelta / 2) ** 2
            + cos($latFrom) * cos($latTo) * sin($lngDelta / 2) ** 2;

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return round($earthRadiusKm * $c, 2);
    }

    public function updateLocation(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'driver_id' => ['required', 'exists:delivery_drivers,id'],
            'latitude' => ['required', 'numeric', 'between:-90,90'],
            'longitude' => ['required', 'numeric', 'between:-180,180'],
            'accuracy' => ['nullable', 'numeric', 'min:0'],
        ]);

        $driver = DeliveryDriver::query()
            ->where('id', $validated['driver_id'])
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $driver->update([
            'current_latitude' => $validated['latitude'],
            'current_longitude' => $validated['longitude'],
            'current_location_accuracy' => $validated['accuracy'] ?? null,
            'availability_status' => 'available',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Driver location updated successfully.',
            'driver_id' => $driver->id,
            'latitude' => $driver->current_latitude,
            'longitude' => $driver->current_longitude,
            'accuracy' => $driver->current_location_accuracy,
        ]);
    }

    public function markDispatched(Order $order): RedirectResponse
    {
        $driver = DeliveryDriver::query()
            ->where('user_id', auth()->id())
            ->firstOrFail();

        if ((int) $order->delivery_driver_id !== (int) $driver->id) {
            abort(403, 'This order is not assigned to this driver.');
        }

        $order->update([
            'fulfillment_status' => 'dispatched',
            'dispatched_at' => now(),
            'delivered_at' => null,
        ]);

        return redirect()
            ->route('driver.dashboard')
            ->with('success', 'Order marked as dispatched.');
    }

    public function markDelivered(Order $order): RedirectResponse
    {
        $driver = DeliveryDriver::query()
            ->where('user_id', auth()->id())
            ->firstOrFail();

        if ((int) $order->delivery_driver_id !== (int) $driver->id) {
            abort(403, 'This order is not assigned to this driver.');
        }

        $order->update([
            'fulfillment_status' => 'delivered',
            'delivered_at' => now(),
        ]);

        return redirect()
            ->route('driver.dashboard')
            ->with('success', 'Order marked as delivered.');
    }

    public function updateStatus(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:available,offline,unavailable'],
        ]);

        $driver = DeliveryDriver::query()
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $driver->update([
            'availability_status' => $validated['status'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Driver status updated successfully.',
            'driver_id' => $driver->id,
            'availability_status' => $driver->availability_status,
        ]);
    }
}