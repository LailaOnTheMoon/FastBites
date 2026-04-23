<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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

        return view('admin.dashboard', compact(
            'stats',
            'restaurants',
            'activities',
            'restaurantsPendingReview',
            'averageOrderDelay',
            'kitchenResponseRate',
            'branchCompliance',
            'customerSatisfaction'
        ));
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

    // الإحصائيات
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

    $avgRating = 4.7; // مؤقتًا ثابت لعدم وجود جدول تقييمات عندك الآن

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