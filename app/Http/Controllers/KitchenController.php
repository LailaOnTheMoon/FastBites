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

        $kitchenAiCoordination = $this->buildKitchenAiCoordination();

        return view('kitchen.dashboard', [
            'newOrdersCount' => $newOrdersCount,
            'preparingCount' => $preparingCount,
            'readyCount' => $readyCount,
            'completedTodayCount' => $completedTodayCount,
            'priorityOrders' => $priorityOrders,
            'restaurantsRunning' => $restaurantsRunning,
            'specialInstructionAlerts' => $specialInstructionAlerts,
            'averagePrepDuration' => $averagePrepDuration ? round($averagePrepDuration) : 0,
            'kitchenAiCoordination' => $kitchenAiCoordination,
        ]);
    }

    public function newOrders()
    {
        $orders = $this->kitchenOrdersBaseQuery()
            ->where('orders.fulfillment_status', 'pending')
            ->orderByDesc('orders.placed_at')
            ->get();

        $orders = $this->attachKitchenAiAdvice($orders);

        return view('kitchen.new-orders', compact('orders'));
    }

    public function preparingOrders()
    {
        $orders = $this->kitchenOrdersBaseQuery()
            ->where('orders.fulfillment_status', 'preparing')
            ->orderByDesc('orders.accepted_at')
            ->get();

        $orders = $this->attachKitchenAiAdvice($orders);

        return view('kitchen.preparing-orders', compact('orders'));
    }

    public function readyOrders()
    {
        $orders = $this->kitchenOrdersBaseQuery()
            ->where('orders.fulfillment_status', 'ready')
            ->orderByDesc('orders.prepared_at')
            ->get();

        $orders = $this->attachKitchenAiAdvice($orders);

        return view('kitchen.ready-orders', compact('orders'));
    }

    public function completedOrders()
    {
        $orders = $this->kitchenOrdersBaseQuery()
            ->whereIn('orders.fulfillment_status', ['completed', 'delivered'])
            ->orderByDesc('orders.updated_at')
            ->get();

        $orders = $this->attachKitchenAiAdvice($orders);

        return view('kitchen.completed-orders', compact('orders'));
    }

    private function buildKitchenAiCoordination(): array
    {
        $baseQuery = $this->kitchenOrdersBaseQuery();

        $pendingOrders = (clone $baseQuery)
            ->where('orders.fulfillment_status', 'pending')
            ->count();

        $preparingOrders = (clone $baseQuery)
            ->where('orders.fulfillment_status', 'preparing')
            ->count();

        $readyOrders = (clone $baseQuery)
            ->where('orders.fulfillment_status', 'ready')
            ->count();

        $oldestPendingOrder = (clone $baseQuery)
            ->where('orders.fulfillment_status', 'pending')
            ->whereNotNull('orders.placed_at')
            ->orderBy('orders.placed_at')
            ->first();

        $averagePreparationTime = (clone $baseQuery)
            ->whereNotNull('restaurants.preparation_time_minutes')
            ->avg('restaurants.preparation_time_minutes');

        $averagePreparationTime = $averagePreparationTime
            ? round($averagePreparationTime)
            : 20;

        $recommendedAction = 'Kitchen is stable. Continue monitoring incoming orders.';
        $priorityLevel = 'Low';
        $reason = 'There are no urgent kitchen coordination issues right now.';

        if ($oldestPendingOrder) {
            $waitingMinutes = now()->diffInMinutes($oldestPendingOrder->placed_at);

            if ($waitingMinutes >= 10) {
    $waitingText = $waitingMinutes >= 60
        ? 'more than 1 hour'
        : round($waitingMinutes) . ' minutes';

    $recommendedAction = 'Start preparing the oldest pending order immediately.';
    $priorityLevel = 'High';
    $reason = "Order {$oldestPendingOrder->order_number} has been pending for {$waitingText}.";
} elseif ($pendingOrders > 0) {
                $recommendedAction = 'Accept new pending orders and start preparation soon.';
                $priorityLevel = 'Medium';
                $reason = "There are {$pendingOrders} pending orders waiting for kitchen confirmation.";
            }
        }

        if ($preparingOrders >= 3) {
            $recommendedAction = 'Focus on completing preparing orders before accepting more.';
            $priorityLevel = 'High';
            $reason = "There are {$preparingOrders} orders currently being prepared.";
        }

        if ($readyOrders >= 3) {
            $recommendedAction = 'Coordinate with drivers to pick up ready orders quickly.';
            $priorityLevel = 'Medium';
            $reason = "There are {$readyOrders} ready orders waiting for pickup.";
        }

        return [
            'recommended_action' => $recommendedAction,
            'priority_level' => $priorityLevel,
            'reason' => $reason,
            'pending_orders' => $pendingOrders,
            'preparing_orders' => $preparingOrders,
            'ready_orders' => $readyOrders,
            'average_preparation_time' => $averagePreparationTime,
        ];
    }

    private function attachKitchenAiAdvice($orders)
    {
        return $orders->map(function ($order) {
            $order->kitchen_ai_advice = $this->buildKitchenAiAdviceForOrder($order);

            return $order;
        });
    }

    private function buildKitchenAiAdviceForOrder($order): array
    {
        $status = $order->fulfillment_status ?? 'unknown';
        $preparationTime = (int) ($order->preparation_time_minutes ?? 20);

        $waitingMinutes = null;

        if (! empty($order->placed_at)) {
            $waitingMinutes = now()->diffInMinutes($order->placed_at);
        }

        if ($status === 'pending') {
    if ($waitingMinutes !== null && $waitingMinutes >= 10) {
        $waitingText = $waitingMinutes >= 60
            ? 'more than 1 hour'
            : round($waitingMinutes) . ' minutes';

        return [
            'label' => 'Start Now',
            'message' => "This order has been pending for {$waitingText}. Start preparing immediately.",
            'priority' => 'High',
        ];
    }

    return [
        'label' => 'Accept Soon',
        'message' => "Estimated preparation time is {$preparationTime} minutes. Accept and start soon.",
        'priority' => 'Medium',
    ];
}

        if ($status === 'preparing') {
            return [
                'label' => 'Keep Preparing',
                'message' => "Continue preparing. Expected preparation duration is about {$preparationTime} minutes.",
                'priority' => 'Medium',
            ];
        }

        if ($status === 'ready') {
            return [
                'label' => 'Driver Pickup',
                'message' => 'Food is ready. Coordinate pickup with the assigned driver.',
                'priority' => 'Medium',
            ];
        }

        if (in_array($status, ['completed', 'delivered'], true)) {
            return [
                'label' => 'Completed',
                'message' => 'Order is completed. No kitchen action is required.',
                'priority' => 'Low',
            ];
        }

        return [
            'label' => 'Monitor',
            'message' => 'Monitor this order and update its kitchen status when needed.',
            'priority' => 'Low',
        ];
    }
}