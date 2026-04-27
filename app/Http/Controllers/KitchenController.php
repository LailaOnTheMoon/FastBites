<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KitchenController extends Controller
{
    protected function kitchenOrdersBaseQuery()
    {
        $userId = Auth::id();

        return DB::table('orders')
            ->join('restaurants', 'orders.restaurant_id', '=', 'restaurants.id')
            ->leftJoin('customers', 'orders.customer_id', '=', 'customers.id')
            ->select(
                'orders.id',
                'orders.order_number',
                'orders.order_type',
                'orders.fulfillment_status',
                'orders.payment_status',
                'orders.total_amount',
                'orders.customer_name',
                'orders.customer_email',
                'orders.customer_phone_number',
                'orders.special_instructions',
                'orders.status_notes',
                'orders.placed_at',
                'orders.accepted_at',
                'orders.prepared_at',
                'orders.delivered_at',
                'orders.created_at',
                'restaurants.id as restaurant_id',
                'restaurants.name as restaurant_name',
                'restaurants.manager_user_id',
                'restaurants.preparation_time_minutes'
            )
            ->where('restaurants.manager_user_id', $userId);
    }

    public function dashboard()
    {
        $baseQuery = $this->kitchenOrdersBaseQuery();

        $newOrdersCount = (clone $baseQuery)
            ->where('orders.fulfillment_status', 'pending')
            ->count();

        $preparingCount = (clone $baseQuery)
            ->where('orders.fulfillment_status', 'preparing')
            ->count();

        $readyCount = (clone $baseQuery)
            ->where('orders.fulfillment_status', 'ready')
            ->count();

        $completedTodayCount = (clone $baseQuery)
            ->whereIn('orders.fulfillment_status', ['completed', 'delivered'])
            ->whereDate('orders.updated_at', today())
            ->count();

        $priorityOrders = (clone $baseQuery)
            ->where('orders.fulfillment_status', 'pending')
            ->whereNotNull('orders.placed_at')
            ->where('orders.placed_at', '<=', now()->subMinutes(10))
            ->count();

        $specialInstructionAlerts = (clone $baseQuery)
            ->whereIn('orders.fulfillment_status', ['pending', 'preparing'])
            ->where(function ($query) {
                $query->whereNotNull('orders.special_instructions')
                      ->where('orders.special_instructions', '!=', '');
            })
            ->count();

        $restaurantsRunning = DB::table('restaurants')
            ->where('manager_user_id', Auth::id())
            ->where('is_active', true)
            ->count();

        $averagePrepDuration = DB::table('orders')
            ->join('restaurants', 'orders.restaurant_id', '=', 'restaurants.id')
            ->where('restaurants.manager_user_id', Auth::id())
            ->where('orders.fulfillment_status', 'preparing')
            ->whereNotNull('orders.accepted_at')
            ->selectRaw('AVG(TIMESTAMPDIFF(MINUTE, orders.accepted_at, NOW())) as avg_minutes')
            ->value('avg_minutes');

        return view('kitchen.dashboard', [
            'newOrdersCount' => $newOrdersCount,
            'preparingCount' => $preparingCount,
            'readyCount' => $readyCount,
            'completedTodayCount' => $completedTodayCount,
            'priorityOrders' => $priorityOrders,
            'restaurantsRunning' => $restaurantsRunning,
            'specialInstructionAlerts' => $specialInstructionAlerts,
            'averagePrepDuration' => $averagePrepDuration ? round($averagePrepDuration) : 0,
        ]);
    }

    public function newOrders()
    {
        $orders = $this->kitchenOrdersBaseQuery()
            ->where('orders.fulfillment_status', 'pending')
            ->orderByDesc('orders.placed_at')
            ->get();

        return view('kitchen.new-orders', compact('orders'));
    }

    public function preparingOrders()
    {
        $orders = $this->kitchenOrdersBaseQuery()
            ->where('orders.fulfillment_status', 'preparing')
            ->orderByDesc('orders.accepted_at')
            ->get();

        return view('kitchen.preparing-orders', compact('orders'));
    }

    public function readyOrders()
    {
        $orders = $this->kitchenOrdersBaseQuery()
            ->where('orders.fulfillment_status', 'ready')
            ->orderByDesc('orders.prepared_at')
            ->get();

        return view('kitchen.ready-orders', compact('orders'));
    }

    public function completedOrders()
    {
        $orders = $this->kitchenOrdersBaseQuery()
            ->whereIn('orders.fulfillment_status', ['completed', 'delivered'])
            ->orderByDesc('orders.updated_at')
            ->get();

        return view('kitchen.completed-orders', compact('orders'));
    }
}