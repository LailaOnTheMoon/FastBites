<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class CustomerDashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $user = $request->user();

        $recentOrders = collect();
        $totalOrders = 0;
        $activeOrders = 0;
        $completedOrders = 0;
        $totalSpent = 0;

        if ($user instanceof Customer) {
            $ordersQuery = Order::query()->where('customer_id', $user->id);
            $paymentsQuery = Payment::query()->where('customer_id', $user->id);

            $recentOrders = $ordersQuery
                ->latest('placed_at')
                ->limit(5)
                ->get();

            $totalOrders = (clone $ordersQuery)->count();
            $activeOrders = (clone $ordersQuery)
                ->whereIn('fulfillment_status', ['pending', 'accepted', 'preparing', 'ready', 'dispatched'])
                ->count();
            $completedOrders = (clone $ordersQuery)
                ->whereIn('fulfillment_status', ['delivered', 'completed'])
                ->count();
            $totalSpent = (float) (clone $paymentsQuery)
                ->where('status', 'paid')
                ->sum('amount');
        }

        return view('customer.dashboard', [
            'user' => $user,
            'displayName' => $this->resolveDisplayName($user),
            'profileCompletion' => $this->calculateProfileCompletion($user),
            'recentOrders' => $recentOrders,
            'totalOrders' => $totalOrders,
            'activeOrders' => $activeOrders,
            'completedOrders' => $completedOrders,
            'totalSpent' => $totalSpent,
        ]);
    }

    private function resolveDisplayName(object $user): string
    {
        if (isset($user->full_name) && filled($user->full_name)) {
            return $user->full_name;
        }

        if (isset($user->name) && filled($user->name)) {
            return $user->name;
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
