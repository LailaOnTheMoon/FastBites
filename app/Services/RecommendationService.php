<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\MenuItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class RecommendationService
{
    public function forCustomer(Customer $customer, int $limit = 8): Collection
    {
        /*
        |--------------------------------------------------------------------------
        | 1. Get customer favorite categories
        |--------------------------------------------------------------------------
        */
        $favoriteCategories = OrderItem::query()
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('menu_items', 'order_items.menu_item_id', '=', 'menu_items.id')
            ->where('orders.customer_id', $customer->id)
            ->whereNotNull('menu_items.category')
            ->select('menu_items.category', DB::raw('COUNT(*) as total_orders'))
            ->groupBy('menu_items.category')
            ->orderByDesc('total_orders')
            ->limit(3)
            ->pluck('menu_items.category');

        /*
        |--------------------------------------------------------------------------
        | 2. Get customer favorite restaurants
        |--------------------------------------------------------------------------
        */
        $favoriteRestaurants = Order::query()
            ->where('customer_id', $customer->id)
            ->whereNotNull('restaurant_id')
            ->select('restaurant_id', DB::raw('COUNT(*) as total_orders'))
            ->groupBy('restaurant_id')
            ->orderByDesc('total_orders')
            ->limit(3)
            ->pluck('restaurant_id');

        /*
        |--------------------------------------------------------------------------
        | 3. Get items the customer already ordered
        |--------------------------------------------------------------------------
        */
        $alreadyOrderedItemIds = OrderItem::query()
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.customer_id', $customer->id)
            ->pluck('order_items.menu_item_id')
            ->filter()
            ->unique();

        /*
        |--------------------------------------------------------------------------
        | 4. Recommend based on favorite categories and restaurants
        |--------------------------------------------------------------------------
        */
        $personalizedItems = MenuItem::query()
            ->with('restaurant')
            ->where('is_available', true)
            ->whereNotIn('id', $alreadyOrderedItemIds)
            ->where(function ($query) use ($favoriteCategories, $favoriteRestaurants) {
                if ($favoriteCategories->isNotEmpty()) {
                    $query->whereIn('category', $favoriteCategories);
                }

                if ($favoriteRestaurants->isNotEmpty()) {
                    $query->orWhereIn('restaurant_id', $favoriteRestaurants);
                }
            })
            ->orderByDesc('is_featured')
            ->limit($limit)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | 5. If not enough data, fallback to popular items
        |--------------------------------------------------------------------------
        */
        if ($personalizedItems->count() < $limit) {
            $remaining = $limit - $personalizedItems->count();

            $popularItems = MenuItem::query()
                ->with('restaurant')
                ->where('is_available', true)
                ->whereNotIn('id', $personalizedItems->pluck('id'))
                ->whereNotIn('id', $alreadyOrderedItemIds)
                ->withCount('orderItems')
                ->orderByDesc('order_items_count')
                ->orderByDesc('is_featured')
                ->limit($remaining)
                ->get();

            $personalizedItems = $personalizedItems->merge($popularItems);
        }

        /*
        |--------------------------------------------------------------------------
        | 6. Final fallback for new customers
        |--------------------------------------------------------------------------
        */
        if ($personalizedItems->isEmpty()) {
            return MenuItem::query()
                ->with('restaurant')
                ->where('is_available', true)
                ->orderByDesc('is_featured')
                ->latest()
                ->limit($limit)
                ->get();
        }

        return $personalizedItems;
    }

    public function insightsForCustomer(Customer $customer): array
    {
        /*
        |--------------------------------------------------------------------------
        | 1. Favorite category based on previous order items
        |--------------------------------------------------------------------------
        */
        $favoriteCategory = OrderItem::query()
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('menu_items', 'order_items.menu_item_id', '=', 'menu_items.id')
            ->where('orders.customer_id', $customer->id)
            ->whereNotNull('menu_items.category')
            ->select('menu_items.category', DB::raw('COUNT(*) as total_orders'))
            ->groupBy('menu_items.category')
            ->orderByDesc('total_orders')
            ->value('menu_items.category');

        /*
        |--------------------------------------------------------------------------
        | 2. Preferred restaurant based on order frequency
        |--------------------------------------------------------------------------
        */
        $preferredRestaurant = Order::query()
            ->join('restaurants', 'orders.restaurant_id', '=', 'restaurants.id')
            ->where('orders.customer_id', $customer->id)
            ->whereNotNull('orders.restaurant_id')
            ->select('restaurants.name', DB::raw('COUNT(*) as total_orders'))
            ->groupBy('restaurants.name')
            ->orderByDesc('total_orders')
            ->value('restaurants.name');

        /*
        |--------------------------------------------------------------------------
        | 3. Last ordered item
        |--------------------------------------------------------------------------
        */
        $lastOrderedItem = OrderItem::query()
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.customer_id', $customer->id)
            ->orderByDesc('orders.placed_at')
            ->value('order_items.item_name');

        /*
        |--------------------------------------------------------------------------
        | 4. Human-readable recommendation reason
        |--------------------------------------------------------------------------
        */
        $reason = ($favoriteCategory || $preferredRestaurant)
            ? 'Recommendations are based on your previous orders, favorite category, and preferred restaurant.'
            : 'Place more orders so FastBites can learn your preferences.';

        return [
            'favorite_category' => $favoriteCategory ?? 'Not enough data yet',
            'preferred_restaurant' => $preferredRestaurant ?? 'Not enough data yet',
            'last_ordered_item' => $lastOrderedItem ?? 'No previous item found',
            'reason' => $reason,
        ];
    }
}