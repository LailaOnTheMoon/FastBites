<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class SuperAdminController extends Controller
{
    public function dashboard()
{
    $totalRevenue = DB::table('orders')->sum('total_amount');
    $totalOrders = DB::table('orders')->count();
    $activeCustomers = DB::table('customers')->count();
    $averageOrderValue = $totalOrders > 0 ? DB::table('orders')->avg('total_amount') : 0;

    $liveOrders = DB::table('orders')
        ->whereIn('fulfillment_status', ['pending', 'preparing', 'ready'])
        ->count();

    $totalAdmins = DB::table('users')
        ->whereIn('account_type', ['super_admin', 'admin'])
        ->count();

    $totalRestaurants = DB::table('restaurants')->count();

    $operationsReadiness = $totalRestaurants > 0
        ? round((DB::table('restaurants')->where('is_active', true)->count() / $totalRestaurants) * 100)
        : 0;

    $adminCoverage = $totalRestaurants > 0
        ? min(100, round(($totalAdmins / $totalRestaurants) * 100))
        : 0;

    $restaurantCompliance = $totalRestaurants > 0
        ? round((DB::table('restaurants')->whereNotNull('manager_user_id')->count() / $totalRestaurants) * 100)
        : 0;

    $recentOrders = DB::table('orders')
        ->join('restaurants', 'orders.restaurant_id', '=', 'restaurants.id')
        ->select(
            'orders.order_number',
            'orders.customer_name',
            'orders.payment_status',
            'orders.total_amount',
            'orders.fulfillment_status',
            'restaurants.name as restaurant_name',
            'orders.created_at'
        )
        ->latest('orders.created_at')
        ->limit(8)
        ->get();

    // Pie chart: order types
    $deliveryCount = DB::table('orders')->where('order_type', 'delivery')->count();
    $pickupCount = DB::table('orders')->where('order_type', 'pickup')->count();
    $otherCount = DB::table('orders')
        ->whereNotIn('order_type', ['delivery', 'pickup'])
        ->count();

    $orderTypeChart = [
        'labels' => ['Delivery', 'Pickup', 'Other'],
        'values' => [$deliveryCount, $pickupCount, $otherCount],
    ];

    // Bar chart: last 5 weeks revenue
    $weeklySalesRaw = DB::table('orders')
        ->selectRaw('WEEK(created_at) as week_number, SUM(total_amount) as total_sales')
        ->groupByRaw('WEEK(created_at)')
        ->orderByRaw('WEEK(created_at) DESC')
        ->limit(5)
        ->get()
        ->reverse()
        ->values();

    $weeklySalesChart = [
        'labels' => $weeklySalesRaw->map(fn($row) => 'Week ' . $row->week_number)->values(),
        'values' => $weeklySalesRaw->map(fn($row) => round($row->total_sales, 2))->values(),
    ];

    return view('super-admin.dashboard', compact(
        'totalRevenue',
        'totalOrders',
        'activeCustomers',
        'averageOrderValue',
        'liveOrders',
        'totalAdmins',
        'totalRestaurants',
        'recentOrders',
        'operationsReadiness',
        'adminCoverage',
        'restaurantCompliance',
        'orderTypeChart',
        'weeklySalesChart'
    ));
}

    public function manageAdmins()
    {
        $admins = DB::table('users')
            ->whereIn('account_type', ['super_admin', 'admin'])
            ->latest()
            ->get();

        $totalAdmins = $admins->count();
        $activeAdmins = $admins->count();
        $underReview = 0;
        $regionalLeads = $admins->where('account_type', 'admin')->count();

        return view('super-admin.manage-admins', compact(
            'admins',
            'totalAdmins',
            'activeAdmins',
            'underReview',
            'regionalLeads'
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
                'restaurants.created_at',
                'users.first_name as manager_first_name',
                'users.last_name as manager_last_name'
            )
            ->latest('restaurants.created_at')
            ->get();

        return view('super-admin.manage-restaurants', compact('restaurants'));
    }

    public function userManagement()
    {
        $customersCount = DB::table('customers')->count();
        $restaurantAccounts = DB::table('restaurants')->count();
        $adminAccounts = DB::table('users')
            ->whereIn('account_type', ['super_admin', 'admin'])
            ->count();
        $supportAgents = DB::table('users')
            ->whereIn('account_type', ['user_manager', 'kitchen_manager'])
            ->count();

        $missingPhoneCustomers = DB::table('customers')->whereNull('phone_number')->count();
        $duplicateEmails = DB::table('customers')
            ->select('email')
            ->whereNotNull('email')
            ->groupBy('email')
            ->havingRaw('COUNT(*) > 1')
            ->count();

        return view('super-admin.user-management', compact(
            'customersCount',
            'restaurantAccounts',
            'adminAccounts',
            'supportAgents',
            'missingPhoneCustomers',
            'duplicateEmails'
        ));
    }

    public function systemReports()
    {
        $weeklyRevenue = DB::table('orders')->sum('total_amount');

        $deliveredOrders = DB::table('orders')
            ->whereNotNull('placed_at')
            ->whereNotNull('delivered_at')
            ->get();

        $avgDeliveryMinutes = 0;
        if ($deliveredOrders->count() > 0) {
            $totalMinutes = $deliveredOrders->sum(function ($order) {
                return abs(strtotime($order->delivered_at) - strtotime($order->placed_at)) / 60;
            });
            $avgDeliveryMinutes = round($totalMinutes / $deliveredOrders->count(), 1);
        }

        $refundedOrders = DB::table('orders')->where('payment_status', 'refunded')->count();
        $totalOrders = DB::table('orders')->count();
        $refundRate = $totalOrders > 0 ? round(($refundedOrders / $totalOrders) * 100, 1) : 0;

        $totalRestaurants = DB::table('restaurants')->count();
        $activeRestaurants = DB::table('restaurants')->where('is_active', true)->count();
        $platformUptime = $totalRestaurants > 0 ? round(($activeRestaurants / $totalRestaurants) * 100, 1) : 0;

        $supportReporting = $totalOrders > 0
            ? round((DB::table('orders')->whereIn('fulfillment_status', ['delivered', 'ready'])->count() / $totalOrders) * 100)
            : 0;

        $complianceReporting = $totalRestaurants > 0
            ? round((DB::table('restaurants')->whereNotNull('manager_user_id')->count() / $totalRestaurants) * 100)
            : 0;

        return view('super-admin.system-reports', compact(
            'platformUptime',
            'weeklyRevenue',
            'avgDeliveryMinutes',
            'refundRate',
            'supportReporting',
            'complianceReporting'
        ));
    }
}