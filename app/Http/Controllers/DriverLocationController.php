<?php

namespace App\Http\Controllers;

use App\Models\DeliveryDriver;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DriverLocationController extends Controller
{
    public function show(): View
    {
        return view('driver.location');
    }

    public function update(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'driver_id' => ['required', 'exists:delivery_drivers,id'],
            'latitude' => ['required', 'numeric', 'between:-90,90'],
            'longitude' => ['required', 'numeric', 'between:-180,180'],
            'accuracy' => ['nullable', 'numeric', 'min:0'],
        ]);

        $driver = DeliveryDriver::findOrFail($validated['driver_id']);

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
}