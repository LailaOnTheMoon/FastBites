<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AdminController extends Controller
{
    public function dashboard()
    {
        $employees = User::whereIn('account_type', [
            'admin',
            'kitchen_manager',
            'user_manager',
        ])->get();

        $managedRestaurants = $employees->whereIn('account_type', [
            'admin',
            'kitchen_manager',
        ])->count();

        $openOrders = $employees->where('account_type', 'kitchen_manager')->count() * 12;
        $dailyRevenue = $employees->where('account_type', 'admin')->count() * 2500;
        $pendingReviews = $employees->where('account_type', 'user_manager')->count();

        $stats = [
            [
                'label' => 'Managed Restaurants',
                'value' => $managedRestaurants,
                'accent' => 'orange',
                'trend' => '+' . $employees->where('account_type', 'admin')->count() . ' admins assigned',
                'trend_class' => 'up',
            ],
            [
                'label' => 'Open Orders',
                'value' => $openOrders,
                'accent' => 'green',
                'trend' => '+' . $employees->where('account_type', 'kitchen_manager')->count() . ' kitchen managers active',
                'trend_class' => 'up',
            ],
            [
                'label' => 'Daily Revenue',
                'value' => '$' . number_format($dailyRevenue),
                'accent' => 'pink',
                'trend' => '+' . $employees->where('account_type', 'admin')->count() . ' admin revenue channels',
                'trend_class' => 'up',
            ],
            [
                'label' => 'Pending Reviews',
                'value' => $pendingReviews,
                'accent' => 'amber',
                'trend' => $pendingReviews . ' user managers reviewing',
                'trend_class' => $pendingReviews > 0 ? 'down' : 'up',
            ],
        ];

        $restaurants = $employees
            ->whereIn('account_type', ['admin', 'kitchen_manager'])
            ->map(function ($employee) {
                return [
                    'name' => $employee->address ?: 'Main Branch',
                    'manager' => trim(($employee->first_name ?? '') . ' ' . ($employee->last_name ?? '')),
                    'status' => $employee->account_type === 'kitchen_manager' ? 'Busy' : 'Running',
                    'orders' => $employee->account_type === 'kitchen_manager' ? '12' : '8',
                ];
            })
            ->values();

        $activities = $employees->take(4)->map(function ($employee) {
            return [
                'title' => ucfirst(str_replace('_', ' ', $employee->account_type)) . ' account checked',
                'time' => optional($employee->updated_at)->format('h:i A') ?? 'Recently',
            ];
        })->values();

        $adminsCount = $employees->where('account_type', 'admin')->count();
        $kitchenCount = $employees->where('account_type', 'kitchen_manager')->count();
        $userManagersCount = $employees->where('account_type', 'user_manager')->count();

        $restaurantsPendingReview = $pendingReviews;
        $averageOrderDelay = $kitchenCount > 0 ? (10 + $kitchenCount * 2) : 0;

        $kitchenResponseRate = min(100, 60 + ($kitchenCount * 10));
        $branchCompliance = min(100, 55 + ($adminsCount * 15));
        $customerSatisfaction = min(100, 70 + ($userManagersCount * 10));

        // ================== Admin AI Business Insights ==================
        $adminAiInsights = $this->buildAdminAiInsights();

        return view('admin.dashboard', compact(
            'stats',
            'restaurants',
            'activities',
            'restaurantsPendingReview',
            'averageOrderDelay',
            'kitchenResponseRate',
            'branchCompliance',
            'customerSatisfaction',
            'adminAiInsights'
        ));
    }

    private function buildAdminAiInsights(): array
    {
        $topSellingItem = $this->getTopSellingItem();
        $topCategory = $this->getTopCategory();
        $bestRestaurant = $this->getBestRestaurant();
        $peakOrderTime = $this->getPeakOrderTime();

        $pendingOrders = Schema::hasTable('orders')
            ? DB::table('orders')->where('fulfillment_status', 'pending')->count()
            : 0;

        $dispatchedOrders = Schema::hasTable('orders')
            ? DB::table('orders')->where('fulfillment_status', 'dispatched')->count()
            : 0;

        $deliveredOrders = Schema::hasTable('orders')
            ? DB::table('orders')->whereIn('fulfillment_status', ['delivered', 'completed'])->count()
            : 0;

        $suggestedAction = $this->generateAdminSuggestion(
            $topSellingItem,
            $topCategory,
            $bestRestaurant,
            $pendingOrders,
            $dispatchedOrders,
            $deliveredOrders
        );

        return [
            'top_selling_item' => $topSellingItem,
            'top_category' => $topCategory,
            'best_restaurant' => $bestRestaurant,
            'peak_order_time' => $peakOrderTime,
            'pending_orders' => $pendingOrders,
            'dispatched_orders' => $dispatchedOrders,
            'delivered_orders' => $deliveredOrders,
            'suggested_action' => $suggestedAction,
        ];
    }

    private function getTopSellingItem(): string
    {
        if (
            ! Schema::hasTable('order_items') ||
            ! Schema::hasTable('menu_items') ||
            ! Schema::hasColumn('order_items', 'menu_item_id') ||
            ! Schema::hasColumn('order_items', 'quantity') ||
            ! Schema::hasColumn('menu_items', 'name')
        ) {
            return 'Not enough data yet';
        }

        $item = DB::table('order_items')
            ->join('menu_items', 'order_items.menu_item_id', '=', 'menu_items.id')
            ->select(
                'menu_items.name',
                DB::raw('SUM(order_items.quantity) as total_quantity')
            )
            ->groupBy('menu_items.id', 'menu_items.name')
            ->orderByDesc('total_quantity')
            ->first();

        return $item?->name ?? 'Not enough data yet';
    }

    private function getTopCategory(): string
    {
        if (
            ! Schema::hasTable('order_items') ||
            ! Schema::hasTable('menu_items') ||
            ! Schema::hasColumn('order_items', 'menu_item_id') ||
            ! Schema::hasColumn('order_items', 'quantity') ||
            ! Schema::hasColumn('menu_items', 'category')
        ) {
            return 'Not enough data yet';
        }

        $category = DB::table('order_items')
            ->join('menu_items', 'order_items.menu_item_id', '=', 'menu_items.id')
            ->select(
                'menu_items.category',
                DB::raw('SUM(order_items.quantity) as total_quantity')
            )
            ->whereNotNull('menu_items.category')
            ->groupBy('menu_items.category')
            ->orderByDesc('total_quantity')
            ->first();

        return $category?->category ?? 'Not enough data yet';
    }

    private function getBestRestaurant(): string
    {
        if (
            ! Schema::hasTable('orders') ||
            ! Schema::hasTable('restaurants') ||
            ! Schema::hasColumn('orders', 'restaurant_id') ||
            ! Schema::hasColumn('orders', 'total_amount') ||
            ! Schema::hasColumn('restaurants', 'name')
        ) {
            return 'Not enough data yet';
        }

        $restaurant = DB::table('orders')
            ->join('restaurants', 'orders.restaurant_id', '=', 'restaurants.id')
            ->select(
                'restaurants.name',
                DB::raw('COUNT(orders.id) as orders_count'),
                DB::raw('SUM(orders.total_amount) as total_sales')
            )
            ->groupBy('restaurants.id', 'restaurants.name')
            ->orderByDesc('total_sales')
            ->first();

        return $restaurant?->name ?? 'Not enough data yet';
    }

    private function getPeakOrderTime(): string
    {
        if (
            ! Schema::hasTable('orders') ||
            ! Schema::hasColumn('orders', 'placed_at')
        ) {
            return 'Not enough data yet';
        }

        $peakHour = DB::table('orders')
            ->select(
                DB::raw('HOUR(placed_at) as order_hour'),
                DB::raw('COUNT(*) as orders_count')
            )
            ->whereNotNull('placed_at')
            ->groupBy(DB::raw('HOUR(placed_at)'))
            ->orderByDesc('orders_count')
            ->first();

        if (! $peakHour) {
            return 'Not enough data yet';
        }

        $hour = (int) $peakHour->order_hour;

        return sprintf('%02d:00 - %02d:00', $hour, ($hour + 1) % 24);
    }

    private function generateAdminSuggestion(
        string $topSellingItem,
        string $topCategory,
        string $bestRestaurant,
        int $pendingOrders,
        int $dispatchedOrders,
        int $deliveredOrders
    ): string {
        if ($pendingOrders > 5) {
            return 'There are several pending orders. Consider assigning more kitchen staff or reviewing restaurant response times.';
        }

        if ($dispatchedOrders > $deliveredOrders && $dispatchedOrders > 3) {
            return 'Many orders are currently with drivers. Monitor delivery performance and driver availability.';
        }

        if ($topCategory !== 'Not enough data yet') {
            return "{$topCategory} is currently the strongest category. Consider promoting side items or drinks with {$topCategory} orders.";
        }

        if ($topSellingItem !== 'Not enough data yet') {
            return "{$topSellingItem} is performing well. Consider featuring it more prominently in recommendations.";
        }

        if ($bestRestaurant !== 'Not enough data yet') {
            return "{$bestRestaurant} is performing well. Consider using its performance as a benchmark for other branches.";
        }

        return 'Collect more order data to generate stronger AI business insights.';
    }

    public function manageRestaurants()
    {
        $restaurants = DB::table('restaurants')
            ->leftJoin('users', 'restaurants.manager_user_id', '=', 'users.id')
            ->select(
                'restaurants.id',
                'restaurants.name',
                'restaurants.city',
                'restaurants.is_active',
                'restaurants.address_line_1',
                'restaurants.operating_hours',
                'users.first_name as manager_first_name',
                'users.last_name as manager_last_name'
            )
            ->latest('restaurants.created_at')
            ->get();

        $totalBranches = $restaurants->count();

        $activeToday = $restaurants->where('is_active', true)->count();

        $needAttention = $restaurants->where('is_active', false)->count();

        $cityCoverage = $restaurants->pluck('city')->filter()->unique()->count();

        return view('admin.manage-restaurants', compact(
            'restaurants',
            'totalBranches',
            'activeToday',
            'needAttention',
            'cityCoverage'
        ));
    }

    public function orders()
    {
        $orders = DB::table('orders')
            ->join('restaurants', 'orders.restaurant_id', '=', 'restaurants.id')
            ->select('orders.*', 'restaurants.name as restaurant_name')
            ->latest()
            ->get();

        $openOrders = DB::table('orders')->where('fulfillment_status', 'pending')->count();
        $preparing = DB::table('orders')->where('fulfillment_status', 'preparing')->count();
        $ready = DB::table('orders')->where('fulfillment_status', 'ready')->count();
        $completed = DB::table('orders')->where('fulfillment_status', 'delivered')->count();

        return view('admin.orders', compact(
            'orders',
            'openOrders',
            'preparing',
            'ready',
            'completed'
        ));
    }

    public function reports()
    {
        $orders = DB::table('orders')->get();
        $restaurants = DB::table('restaurants')->get();

        $weeklyRevenue = $orders->sum('total_amount');

        $totalOrders = $orders->count();
        $deliveredOrders = $orders->where('fulfillment_status', 'delivered')->count();
        $serviceSla = $totalOrders > 0 ? round(($deliveredOrders / $totalOrders) * 100) : 0;

        $avgRating = 4.7;

        $escalations = $orders->whereIn('fulfillment_status', ['cancelled', 'pending'])->count();

        $revenueTargetCompletion = min(100, $weeklyRevenue > 0 ? round(($weeklyRevenue / 10000) * 100) : 0);
        $orderFulfillmentRate = $totalOrders > 0 ? round(($deliveredOrders / $totalOrders) * 100) : 0;

        $activeRestaurants = $restaurants->where('is_active', true)->count();
        $shiftReadiness = $restaurants->count() > 0
            ? round(($activeRestaurants / $restaurants->count()) * 100)
            : 0;

        $topRestaurant = DB::table('orders')
            ->join('restaurants', 'orders.restaurant_id', '=', 'restaurants.id')
            ->select('restaurants.name', DB::raw('SUM(orders.total_amount) as total_sales'))
            ->groupBy('restaurants.id', 'restaurants.name')
            ->orderByDesc('total_sales')
            ->first();

        $highestDelayRestaurant = DB::table('orders')
            ->join('restaurants', 'orders.restaurant_id', '=', 'restaurants.id')
            ->select('restaurants.name', DB::raw('COUNT(*) as orders_count'))
            ->where('orders.fulfillment_status', 'pending')
            ->groupBy('restaurants.id', 'restaurants.name')
            ->orderByDesc('orders_count')
            ->first();

        $topReviewedRestaurant = DB::table('restaurants')
            ->where('is_active', true)
            ->orderBy('created_at')
            ->first();

        $inactiveRestaurant = DB::table('restaurants')
            ->where('is_active', false)
            ->first();

        return view('admin.reports', compact(
            'weeklyRevenue',
            'serviceSla',
            'avgRating',
            'escalations',
            'revenueTargetCompletion',
            'orderFulfillmentRate',
            'shiftReadiness',
            'topRestaurant',
            'highestDelayRestaurant',
            'topReviewedRestaurant',
            'inactiveRestaurant'
        ));
    }
}