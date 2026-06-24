<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\MenuItem;
use App\Models\Order;
use App\Models\Payment;
use App\Services\RecommendationService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Symfony\Component\Process\Process;

class CustomerDashboardController extends Controller
{
    public function __invoke(Request $request, RecommendationService $recommendationService): View
    {
        $user = $request->user();

        $recentOrders = collect();
        $recommendedItems = collect();
        $latestTrackableOrder = null;
        $menuCategories = collect();

        $aiEtaPrediction = [
            'distance_km' => null,
            'delivery_duration_minutes' => null,
            'remaining_preparation_minutes' => null,
            'elapsed_minutes' => null,
            'predicted_eta_minutes' => null,
            'delay_risk' => 'Unknown',
            'location_source' => 'unknown',
            'order_stage' => 'AI prediction unavailable',
            'fulfillment_status' => 'unknown',
            'explanation' => 'AI ETA prediction is not available yet.',
            'customer_update_message' => 'Smart delivery update is not available yet.',
        ];

        $aiInsights = [
            'favorite_category' => 'Not enough data yet',
            'preferred_restaurant' => 'Not enough data yet',
            'last_ordered_item' => 'No previous item found',
            'reason' => 'Place more orders so FastBites can learn your preferences.',
        ];

        $totalOrders = 0;
        $activeOrders = 0;
        $completedOrders = 0;
        $totalSpent = 0;

        if ($user instanceof Customer) {
            $ordersQuery = Order::query()->where('customer_id', $user->id);
            $paymentsQuery = Payment::query()->where('customer_id', $user->id);

            $recentOrders = (clone $ordersQuery)
                ->latest('placed_at')
                ->limit(5)
                ->get();

            $latestTrackableOrder = Order::with(['restaurant', 'deliveryDriver'])
                ->where('customer_id', $user->id)
                ->whereNotNull('restaurant_id')
                ->whereNotNull('delivery_latitude')
                ->whereNotNull('delivery_longitude')
                ->whereHas('restaurant', function ($query) {
                    $query->whereNotNull('latitude')
                        ->whereNotNull('longitude');
                })
                ->latest('placed_at')
                ->first();

            if ($latestTrackableOrder && $latestTrackableOrder->restaurant) {
                $aiEtaPrediction = $this->predictEtaWithPython($latestTrackableOrder);
            }

            $totalOrders = (clone $ordersQuery)->count();

            $activeOrders = (clone $ordersQuery)
                ->whereIn('fulfillment_status', [
                    'pending',
                    'accepted',
                    'preparing',
                    'ready',
                    'dispatched',
                ])
                ->count();

            $completedOrders = (clone $ordersQuery)
                ->whereIn('fulfillment_status', [
                    'delivered',
                    'completed',
                ])
                ->count();

            $totalSpent = (float) (clone $paymentsQuery)
                ->where('status', 'paid')
                ->sum('amount');

            $recommendedItems = $recommendationService->forCustomer($user, 8);
            $aiInsights = $recommendationService->insightsForCustomer($user);

            $recommendedItems = $this->attachRecommendationReasons(
                $recommendedItems,
                $aiInsights
            );

            $menuCategories = MenuItem::query()
                ->selectRaw('category, COUNT(*) as items_count')
                ->whereNotNull('category')
                ->where('category', '!=', '')
                ->where('is_available', 1)
                ->groupBy('category')
                ->orderBy('category')
                ->get()
                ->map(function ($item) {
                    return [
                        'name' => $item->category,
                        'count' => (int) $item->items_count,
                    ];
                });
        }

        return view('customer.dashboard', [
            'user' => $user,
            'displayName' => $this->resolveDisplayName($user),
            'profileCompletion' => $this->calculateProfileCompletion($user),
            'recentOrders' => $recentOrders,
            'recommendedItems' => $recommendedItems,
            'aiInsights' => $aiInsights,
            'aiEtaPrediction' => $aiEtaPrediction,
            'latestTrackableOrder' => $latestTrackableOrder,
            'totalOrders' => $totalOrders,
            'activeOrders' => $activeOrders,
            'completedOrders' => $completedOrders,
            'totalSpent' => $totalSpent,
            'menuCategories' => $menuCategories,
        ]);
    }

    private function predictEtaWithPython(Order $order): array
    {
        $restaurant = $order->restaurant;
        $driver = $order->deliveryDriver;

        $payload = [
            'restaurant_latitude' => (float) $restaurant->latitude,
            'restaurant_longitude' => (float) $restaurant->longitude,

            'customer_latitude' => (float) $order->delivery_latitude,
            'customer_longitude' => (float) $order->delivery_longitude,

            'driver_latitude' => $driver?->current_latitude
                ? (float) $driver->current_latitude
                : null,

            'driver_longitude' => $driver?->current_longitude
                ? (float) $driver->current_longitude
                : null,

            'preparation_time_minutes' => (int) ($restaurant->preparation_time_minutes ?? 20),
            'fulfillment_status' => $order->fulfillment_status ?? 'pending',
            'average_speed_kmh' => 25,

            'placed_at' => optional($order->placed_at)->toIso8601String(),
            'accepted_at' => optional($order->accepted_at)->toIso8601String(),
            'prepared_at' => optional($order->prepared_at)->toIso8601String(),
            'dispatched_at' => optional($order->dispatched_at)->toIso8601String(),
            'delivered_at' => optional($order->delivered_at)->toIso8601String(),
        ];

        $process = new Process([
            'python3',
            base_path('ai/eta_predictor.py'),
            json_encode($payload),
        ]);

        $process->setTimeout(10);
        $process->run();

        if (! $process->isSuccessful()) {
            return [
                'distance_km' => null,
                'delivery_duration_minutes' => null,
                'remaining_preparation_minutes' => null,
                'elapsed_minutes' => null,
                'predicted_eta_minutes' => null,
                'delay_risk' => 'Unknown',
                'location_source' => 'unknown',
                'order_stage' => 'AI prediction failed',
                'fulfillment_status' => $order->fulfillment_status ?? 'unknown',
                'explanation' => 'Python AI ETA prediction failed.',
                'customer_update_message' => 'We could not generate a smart delivery update at this time.',
            ];
        }

        $result = json_decode($process->getOutput(), true);

        if (! is_array($result) || isset($result['error'])) {
            return [
                'distance_km' => null,
                'delivery_duration_minutes' => null,
                'remaining_preparation_minutes' => null,
                'elapsed_minutes' => null,
                'predicted_eta_minutes' => null,
                'delay_risk' => 'Unknown',
                'location_source' => 'unknown',
                'order_stage' => 'AI prediction failed',
                'fulfillment_status' => $order->fulfillment_status ?? 'unknown',
                'explanation' => 'AI ETA prediction returned invalid data.',
                'customer_update_message' => 'We could not generate a smart delivery update at this time.',
            ];
        }

        return array_merge([
            'distance_km' => null,
            'delivery_duration_minutes' => null,
            'remaining_preparation_minutes' => null,
            'elapsed_minutes' => null,
            'predicted_eta_minutes' => null,
            'delay_risk' => 'Unknown',
            'location_source' => 'unknown',
            'order_stage' => 'AI prediction unavailable',
            'fulfillment_status' => $order->fulfillment_status ?? 'unknown',
            'explanation' => 'AI ETA prediction is not available yet.',
            'customer_update_message' => 'Smart delivery update is not available yet.',
        ], $result);
    }

    private function attachRecommendationReasons(Collection $recommendedItems, array $aiInsights): Collection
    {
        $favoriteCategory = $aiInsights['favorite_category'] ?? null;
        $preferredRestaurant = $aiInsights['preferred_restaurant'] ?? null;

        return $recommendedItems->map(function ($item) use ($favoriteCategory, $preferredRestaurant) {
            if (method_exists($item, 'loadMissing')) {
                $item->loadMissing('restaurant');
            }

            $itemCategory = $item->category ?? null;
            $restaurantName = $item->restaurant->name ?? null;
            $preparationTime = $item->preparation_time_minutes ?? null;

            if (
                $favoriteCategory &&
                $favoriteCategory !== 'Not enough data yet' &&
                $itemCategory &&
                strtolower($itemCategory) === strtolower($favoriteCategory)
            ) {
                $item->recommendation_reason = "Recommended because {$favoriteCategory} is your favorite category.";
                return $item;
            }

            if (
                $preferredRestaurant &&
                $preferredRestaurant !== 'Not enough data yet' &&
                $restaurantName &&
                strtolower($restaurantName) === strtolower($preferredRestaurant)
            ) {
                $item->recommendation_reason = "Recommended because you ordered from {$restaurantName} before.";
                return $item;
            }

            if ($preparationTime !== null && (int) $preparationTime <= 10) {
                $item->recommendation_reason = "Recommended because it has a short preparation time of {$preparationTime} minutes.";
                return $item;
            }

            if (! empty($item->is_featured)) {
                $item->recommendation_reason = 'Recommended because it is a featured FastBites meal.';
                return $item;
            }

            if ($restaurantName) {
                $item->recommendation_reason = "Recommended because it is popular from {$restaurantName}.";
                return $item;
            }

            if ($itemCategory) {
                $item->recommendation_reason = "Recommended because {$itemCategory} matches your food preferences.";
                return $item;
            }

            $item->recommendation_reason = 'Recommended based on your previous orders and food preferences.';

            return $item;
        });
    }

    private function resolveDisplayName(object $user): string
    {
        if (isset($user->full_name) && filled($user->full_name)) {
            return $user->full_name;
        }

        if (isset($user->name) && filled($user->name)) {
            return $user->name;
        }

        $firstName = $user->first_name ?? null;
        $lastName = $user->last_name ?? null;

        $displayName = trim(($firstName ?? '') . ' ' . ($lastName ?? ''));

        if (filled($displayName)) {
            return $displayName;
        }

        return 'Customer';
    }

    private function calculateProfileCompletion(object $user): int
    {
        $fields = Collection::make([
            $user->first_name ?? null,
            $user->last_name ?? null,
            $user->email ?? null,
            $user->phone_number ?? null,
            $user->address ?? ($user->address_line_1 ?? null),
        ]);

        $completedFields = $fields->filter(fn ($value) => filled($value))->count();

        return (int) round(($completedFields / $fields->count()) * 100);
    }
}