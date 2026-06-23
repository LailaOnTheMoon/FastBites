<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Customer Dashboard
                </h2>
                <p class="text-sm text-gray-500">
                    Track your orders, account details, and recent activity in one place.
                </p>
            </div>

            <div class="relative">
                <button
                    id="customer-menu-button"
                    type="button"
                    class="inline-flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-semibold text-gray-700 transition hover:bg-gray-100"
                    onclick="document.getElementById('customer-menu').classList.toggle('hidden')"
                >
                    <span>{{ $displayName }}</span>

                    <svg
                        class="h-4 w-4"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div
                    id="customer-menu"
                    class="hidden absolute right-0 z-50 mt-2 w-48 rounded-xl border border-gray-100 bg-white p-2 shadow-lg"
                >
                    <a
                        href="{{ route('profile.edit') }}"
                        class="block rounded-lg px-3 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50"
                    >
                        Manage Profile
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button
                            type="submit"
                            class="w-full rounded-lg px-3 py-2 text-left text-sm font-semibold text-red-600 hover:bg-red-50"
                        >
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto flex max-w-7xl flex-col gap-6 sm:px-6 lg:px-8">

            <section class="overflow-hidden rounded-2xl bg-gradient-to-r from-orange-500 via-amber-500 to-yellow-400 px-6 py-8 text-white shadow-sm">
                <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
                    <div class="space-y-3">
                        <span class="inline-flex w-fit rounded-full bg-white/20 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em]">
                            FastBites
                        </span>

                        <div class="space-y-2">
                            <h1 class="text-3xl font-bold sm:text-4xl">Welcome back, {{ $displayName }}</h1>
                            <p class="max-w-2xl text-sm text-white/90 sm:text-base">
                                Your customer dashboard keeps your profile, orders, and payment progress easy to follow.
                            </p>
                        </div>
                    </div>

                    <div class="grid gap-3 sm:grid-cols-2">
                        <div class="rounded-2xl bg-white/15 px-4 py-3 backdrop-blur-sm">
                            <p class="text-xs uppercase tracking-[0.2em] text-white/70">Profile completion</p>
                            <p class="mt-2 text-2xl font-semibold">{{ $profileCompletion }}%</p>
                        </div>

                        <div class="rounded-2xl bg-white/15 px-4 py-3 backdrop-blur-sm">
                            <p class="text-xs uppercase tracking-[0.2em] text-white/70">Member email</p>
                            <p class="mt-2 text-sm font-medium">{{ $user->email }}</p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
                <article class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-100">
                    <p class="text-sm font-medium text-gray-500">Total Orders</p>
                    <p class="mt-3 text-3xl font-semibold text-gray-900">{{ $totalOrders }}</p>
                    <p class="mt-2 text-sm text-gray-500">All orders linked to this customer account.</p>
                </article>

                <article class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-100">
                    <p class="text-sm font-medium text-gray-500">Active Orders</p>
                    <p class="mt-3 text-3xl font-semibold text-gray-900">{{ $activeOrders }}</p>
                    <p class="mt-2 text-sm text-gray-500">Orders still being prepared, packed, or delivered.</p>
                </article>

                <article class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-100">
                    <p class="text-sm font-medium text-gray-500">Completed Orders</p>
                    <p class="mt-3 text-3xl font-semibold text-gray-900">{{ $completedOrders }}</p>
                    <p class="mt-2 text-sm text-gray-500">Successfully finished orders on your account.</p>
                </article>

                <article class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-100">
                    <p class="text-sm font-medium text-gray-500">Total Paid</p>
                    <p class="mt-3 text-3xl font-semibold text-gray-900">${{ number_format($totalSpent, 2) }}</p>
                    <p class="mt-2 text-sm text-gray-500">Sum of payments recorded as paid.</p>
                </article>
            </section>

            {{-- AI Recommendations Section --}}
            <section class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100">
                <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Recommended For You</h3>
                        <p class="mt-1 text-sm text-gray-500">
                            Personalized meals based on your taste, favorite categories, and order history.
                        </p>
                    </div>

                    <span class="inline-flex w-fit rounded-full bg-orange-100 px-3 py-1 text-xs font-semibold text-orange-700">
                        AI Suggestions
                    </span>
                </div>

                @if(isset($recommendedItems) && $recommendedItems->isNotEmpty())
                    <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                        @foreach($recommendedItems as $item)
                            <article class="overflow-hidden rounded-2xl border border-orange-100 bg-orange-50/40 shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                                @if($item->image_path)
                                    <img
                                        src="{{ asset('storage/' . $item->image_path) }}"
                                        alt="{{ $item->name }}"
                                        class="h-36 w-full object-cover"
                                    >
                                @else
                                    <div class="flex h-36 w-full items-center justify-center bg-gradient-to-r from-orange-500 to-yellow-400 text-3xl font-bold text-white">
                                        {{ strtoupper(substr($item->name, 0, 1)) }}
                                    </div>
                                @endif

                                <div class="p-4">
                                    <span class="inline-flex rounded-full bg-white px-3 py-1 text-xs font-semibold text-orange-700 ring-1 ring-orange-100">
                                        {{ $item->category ?? 'Popular' }}
                                    </span>

                                    <h4 class="mt-3 line-clamp-1 text-base font-semibold text-gray-900">
                                        {{ $item->name }}
                                    </h4>

                                    <p class="mt-1 line-clamp-1 text-sm text-gray-500">
                                        {{ $item->restaurant->name ?? 'FastBites Restaurant' }}
                                    </p>

                                    <div class="mt-4 flex items-center justify-between">
                                        <strong class="text-gray-900">
                                            ${{ number_format((float) $item->base_price, 2) }}
                                        </strong>

                                        @if($item->preparation_time_minutes)
                                            <span class="rounded-full bg-white px-3 py-1 text-xs font-medium text-gray-600">
                                                {{ $item->preparation_time_minutes }} min
                                            </span>
                                        @endif
                                    </div>

                                    <p class="mt-3 text-xs text-gray-500">
    {{ $item->recommendation_reason ?? 'Suggested based on your taste and order history.' }}
</p>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @else
                    <div class="mt-6 rounded-2xl border border-dashed border-orange-200 bg-orange-50/60 p-8 text-center">
                        <p class="text-sm font-medium text-gray-700">
                            No recommendations available yet.
                        </p>
                        <p class="mt-2 text-sm text-gray-500">
                            Once you place more orders, FastBites will suggest meals that match your taste.
                        </p>
                    </div>
                @endif
            </section>

            {{-- AI Insights Section --}}
            <section class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100">
                <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">AI Insights</h3>
                        <p class="mt-1 text-sm text-gray-500">
                            FastBites analyzes your order history to understand your food preferences.
                        </p>
                    </div>

                    <span class="inline-flex w-fit rounded-full bg-orange-100 px-3 py-1 text-xs font-semibold text-orange-700">
                        Smart Analysis
                    </span>
                </div>

                <div class="mt-6 grid gap-4 md:grid-cols-3">
                    <article class="rounded-2xl bg-orange-50 p-5 ring-1 ring-orange-100">
                        <p class="text-xs font-semibold uppercase tracking-wide text-orange-600">
                            Favorite Category
                        </p>
                        <p class="mt-3 text-xl font-bold text-gray-900">
                            {{ $aiInsights['favorite_category'] ?? 'Not enough data yet' }}
                        </p>
                    </article>

                    <article class="rounded-2xl bg-orange-50 p-5 ring-1 ring-orange-100">
                        <p class="text-xs font-semibold uppercase tracking-wide text-orange-600">
                            Preferred Restaurant
                        </p>
                        <p class="mt-3 text-xl font-bold text-gray-900">
                            {{ $aiInsights['preferred_restaurant'] ?? 'Not enough data yet' }}
                        </p>
                    </article>

                    <article class="rounded-2xl bg-orange-50 p-5 ring-1 ring-orange-100">
                        <p class="text-xs font-semibold uppercase tracking-wide text-orange-600">
                            Last Ordered Item
                        </p>
                        <p class="mt-3 text-xl font-bold text-gray-900">
                            {{ $aiInsights['last_ordered_item'] ?? 'No previous item found' }}
                        </p>
                    </article>
                </div>

                <div class="mt-5 rounded-2xl border border-dashed border-orange-200 bg-orange-50/60 p-4">
                    <p class="text-sm font-medium text-gray-700">
                        Recommendation Reason
                    </p>
                    <p class="mt-1 text-sm text-gray-500">
                        {{ $aiInsights['reason'] ?? 'Place more orders so FastBites can learn your preferences.' }}
                    </p>
                </div>
            </section>

            {{-- AI ETA & Delivery Map Section --}}
            @if(isset($latestTrackableOrder) && $latestTrackableOrder && $latestTrackableOrder->restaurant)
                <section
                    class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100"
                    id="delivery-map-section"
                    data-restaurant-lat="{{ $latestTrackableOrder->restaurant->latitude }}"
                    data-restaurant-lng="{{ $latestTrackableOrder->restaurant->longitude }}"
                    data-customer-lat="{{ $latestTrackableOrder->delivery_latitude }}"
                    data-customer-lng="{{ $latestTrackableOrder->delivery_longitude }}"
                    data-driver-lat="{{ $latestTrackableOrder->deliveryDriver?->current_latitude }}"
                    data-driver-lng="{{ $latestTrackableOrder->deliveryDriver?->current_longitude }}"
                    data-driver-accuracy="{{ $latestTrackableOrder->deliveryDriver?->current_location_accuracy }}"
                >
                    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">AI ETA & Delivery Map</h3>
                            <p class="mt-1 text-sm text-gray-500">
                                Python AI predicts delivery time using real restaurant, customer, and driver location data.
                            </p>
                        </div>

                        <span class="inline-flex w-fit rounded-full bg-orange-100 px-3 py-1 text-xs font-semibold text-orange-700">
                            Python AI + OpenStreetMap
                        </span>
                    </div>

                    {{-- Dynamic order info --}}
                    <div class="mt-5 grid gap-4 lg:grid-cols-3">
                        <article class="rounded-2xl bg-gray-50 p-5 ring-1 ring-gray-100">
                            <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Tracking Order</p>
                            <p class="mt-2 text-lg font-bold text-gray-900">
                                {{ $latestTrackableOrder->order_number ?? ('Order #' . $latestTrackableOrder->id) }}
                            </p>
                            <p class="mt-2 text-sm text-gray-500">
                                Current status:
                                <span class="font-semibold text-orange-600">
                                    {{ ucwords(str_replace('_', ' ', $latestTrackableOrder->fulfillment_status ?? 'pending')) }}
                                </span>
                            </p>
                        </article>

                        <article class="rounded-2xl bg-gray-50 p-5 ring-1 ring-gray-100">
                            <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Restaurant</p>
                            <p class="mt-2 text-lg font-bold text-gray-900">
                                {{ $latestTrackableOrder->restaurant->name ?? 'Restaurant' }}
                            </p>
                            <p class="mt-2 text-sm text-gray-500">
                                {{ $latestTrackableOrder->restaurant->address_line_1 ?? 'Restaurant address unavailable' }}
                            </p>
                        </article>

                        <article class="rounded-2xl bg-gray-50 p-5 ring-1 ring-gray-100">
                            <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Delivery Address</p>
                            <p class="mt-2 text-lg font-bold text-gray-900">
                                {{ $latestTrackableOrder->delivery_address_line_1 ?? 'Customer address' }}
                            </p>
                            <p class="mt-2 text-sm text-gray-500">
                                {{ $latestTrackableOrder->delivery_city ?? '' }}
                                {{ $latestTrackableOrder->delivery_country ?? '' }}
                            </p>
                        </article>
                    </div>

                    {{-- Python AI Results --}}
                    <div class="mt-5 grid gap-4 md:grid-cols-2 xl:grid-cols-6">
                        <article class="rounded-2xl bg-orange-50 p-5 ring-1 ring-orange-100">
                            <p class="text-xs font-semibold uppercase tracking-wide text-orange-600">Order Stage</p>
                            <p class="mt-3 text-xl font-bold text-gray-900">
                                {{ $aiEtaPrediction['order_stage'] ?? 'Calculating...' }}
                            </p>
                        </article>

                        <article class="rounded-2xl bg-orange-50 p-5 ring-1 ring-orange-100">
                            <p class="text-xs font-semibold uppercase tracking-wide text-orange-600">Remaining Preparation</p>
                            <p class="mt-3 text-xl font-bold text-gray-900">
                                @if(isset($aiEtaPrediction['remaining_preparation_minutes']) && $aiEtaPrediction['remaining_preparation_minutes'] !== null)
                                    {{ $aiEtaPrediction['remaining_preparation_minutes'] }} min
                                @else
                                    Calculating...
                                @endif
                            </p>
                        </article>

                        <article class="rounded-2xl bg-orange-50 p-5 ring-1 ring-orange-100">
                            <p class="text-xs font-semibold uppercase tracking-wide text-orange-600">Distance</p>
                            <p class="mt-3 text-2xl font-bold text-gray-900">
                                @if(isset($aiEtaPrediction['distance_km']) && $aiEtaPrediction['distance_km'] !== null)
                                    {{ number_format((float) $aiEtaPrediction['distance_km'], 2) }} km
                                @else
                                    Calculating...
                                @endif
                            </p>
                        </article>

                        <article class="rounded-2xl bg-orange-50 p-5 ring-1 ring-orange-100">
                            <p class="text-xs font-semibold uppercase tracking-wide text-orange-600">Delivery Duration</p>
                            <p class="mt-3 text-2xl font-bold text-gray-900">
                                @if(isset($aiEtaPrediction['delivery_duration_minutes']) && $aiEtaPrediction['delivery_duration_minutes'] !== null)
                                    {{ $aiEtaPrediction['delivery_duration_minutes'] }} min
                                @else
                                    Calculating...
                                @endif
                            </p>
                        </article>

                        <article class="rounded-2xl bg-orange-50 p-5 ring-1 ring-orange-100">
                            <p class="text-xs font-semibold uppercase tracking-wide text-orange-600">AI Estimated ETA</p>
                            <p class="mt-3 text-2xl font-bold text-gray-900">
                                @if(isset($aiEtaPrediction['predicted_eta_minutes']) && $aiEtaPrediction['predicted_eta_minutes'] !== null)
                                    {{ $aiEtaPrediction['predicted_eta_minutes'] }} min
                                @else
                                    Calculating...
                                @endif
                            </p>
                        </article>

                        <article class="rounded-2xl bg-orange-50 p-5 ring-1 ring-orange-100">
                            <p class="text-xs font-semibold uppercase tracking-wide text-orange-600">Delay Risk</p>
                            <p class="mt-3 text-2xl font-bold text-gray-900">
                                {{ $aiEtaPrediction['delay_risk'] ?? 'Unknown' }}
                            </p>
                        </article>
                    </div>

                    {{-- AI Explanation --}}
                    <div class="mt-5 rounded-2xl border border-dashed border-orange-200 bg-orange-50/60 p-5">
                        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm font-semibold text-gray-800">Python AI Explanation</p>
                                <p class="mt-1 text-sm text-gray-600">
                                    {{ $aiEtaPrediction['explanation'] ?? 'AI ETA prediction is not available yet.' }}
                                </p>
                            </div>

                            <span class="inline-flex w-fit rounded-full bg-white px-3 py-1 text-xs font-semibold text-orange-700 ring-1 ring-orange-100">
                                Source: {{ ucwords($aiEtaPrediction['location_source'] ?? 'unknown') }}
                            </span>
                        </div>
                    </div>

                    {{-- AI Customer Update --}}
<div class="mt-5 rounded-2xl border border-orange-200 bg-orange-50 p-5">
    <div class="flex flex-col gap-2 sm:flex-row sm:items-start sm:justify-between">
        <div>
            <p class="text-sm font-semibold text-orange-700">
                Smart Customer Update
            </p>

            <p class="mt-2 text-sm leading-6 text-gray-700">
                {{ $aiEtaPrediction['customer_update_message'] ?? 'Smart delivery update is not available yet.' }}
            </p>
        </div>

        <span class="inline-flex w-fit rounded-full bg-white px-3 py-1 text-xs font-semibold text-orange-700 ring-1 ring-orange-100">
            AI Message
        </span>
    </div>
</div>

{{-- Order Timeline --}}
@php
    $currentStatus = $latestTrackableOrder->fulfillment_status ?? null;

    $orderTimelineSteps = [
        [
            'label' => 'Order Placed',
            'description' => 'Your order has been received by FastBites.',
            'statuses' => ['pending', 'preparing', 'ready', 'dispatched', 'delivered', 'completed'],
        ],
        [
            'label' => 'Kitchen Preparing',
            'description' => 'The restaurant is preparing your food.',
            'statuses' => ['preparing', 'ready', 'dispatched', 'delivered', 'completed'],
        ],
        [
            'label' => 'Ready for Pickup',
            'description' => 'Your order is packed and ready for handoff.',
            'statuses' => ['ready', 'dispatched', 'delivered', 'completed'],
        ],
        [
            'label' => 'Driver Dispatched',
            'description' => 'The driver is on the way to your location.',
            'statuses' => ['dispatched', 'delivered', 'completed'],
        ],
        [
            'label' => 'Delivered',
            'description' => 'Your order has been delivered successfully.',
            'statuses' => ['delivered', 'completed'],
        ],
    ];
@endphp

<div class="mt-5 rounded-2xl border border-blue-200 bg-white p-5">
    <div class="flex flex-col gap-2 sm:flex-row sm:items-start sm:justify-between">
        <div>
            <p class="text-sm font-semibold text-blue-700">
                Order Timeline
            </p>
            <p class="mt-1 text-sm text-gray-500">
                Follow your order progress from placement to delivery.
            </p>
        </div>

        <span class="inline-flex w-fit rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700 ring-1 ring-blue-100">
            Live Status
        </span>
    </div>

    <div class="mt-5 grid gap-3 sm:grid-cols-5">
        @foreach($orderTimelineSteps as $step)
            @php
                $isCompleted = in_array($currentStatus, $step['statuses'], true);
            @endphp

            <div class="rounded-2xl border p-4 {{ $isCompleted ? 'border-green-200 bg-green-50' : 'border-gray-200 bg-gray-50' }}">
                <div class="flex items-center gap-2">
                    <span class="flex h-7 w-7 items-center justify-center rounded-full text-sm font-bold {{ $isCompleted ? 'bg-green-600 text-white' : 'bg-gray-200 text-gray-500' }}">
                        {{ $isCompleted ? '✓' : '○' }}
                    </span>

                    <p class="text-sm font-semibold {{ $isCompleted ? 'text-green-800' : 'text-gray-500' }}">
                        {{ $step['label'] }}
                    </p>
                </div>

                <p class="mt-3 text-xs leading-5 {{ $isCompleted ? 'text-green-700' : 'text-gray-500' }}">
                    {{ $step['description'] }}
                </p>
            </div>
        @endforeach
    </div>
</div>

@if(($latestTrackableOrder->fulfillment_status ?? null) === 'dispatched')

{{-- GPS Accuracy Warning --}}
@php
    $driverAccuracy = $latestTrackableOrder->deliveryDriver?->current_location_accuracy;

    if ($driverAccuracy !== null) {
        if ($driverAccuracy <= 100) {
            $gpsAccuracyStatus = 'Good';
            $gpsAccuracyMessage = 'Driver GPS location is reliable.';
            $gpsAccuracyClasses = 'border-green-200 bg-green-50 text-green-700';
            $gpsAccuracyBadgeClasses = 'bg-white text-green-700 ring-green-100';
        } elseif ($driverAccuracy <= 1000) {
            $gpsAccuracyStatus = 'Medium';
            $gpsAccuracyMessage = 'Driver location is acceptable, but mobile GPS is recommended for better tracking.';
            $gpsAccuracyClasses = 'border-yellow-200 bg-yellow-50 text-yellow-700';
            $gpsAccuracyBadgeClasses = 'bg-white text-yellow-700 ring-yellow-100';
        } else {
            $gpsAccuracyStatus = 'Low';
            $gpsAccuracyMessage = 'Driver location may be inaccurate. Please use mobile GPS for better live tracking.';
            $gpsAccuracyClasses = 'border-red-200 bg-red-50 text-red-700';
            $gpsAccuracyBadgeClasses = 'bg-white text-red-700 ring-red-100';
        }
    } else {
        $gpsAccuracyStatus = 'Unknown';
        $gpsAccuracyMessage = 'Driver GPS accuracy is not available yet.';
        $gpsAccuracyClasses = 'border-gray-200 bg-gray-50 text-gray-700';
        $gpsAccuracyBadgeClasses = 'bg-white text-gray-700 ring-gray-100';
    }
@endphp

<div class="mt-5 rounded-2xl border p-5 {{ $gpsAccuracyClasses }}">
    <div class="flex flex-col gap-2 sm:flex-row sm:items-start sm:justify-between">
        <div>
            <p class="text-sm font-semibold">
                GPS Accuracy Warning
            </p>

            <p class="mt-2 text-sm leading-6">
                Accuracy:
                <strong>
                    @if($driverAccuracy !== null)
                        {{ round($driverAccuracy) }} meters
                    @else
                        Not available
                    @endif
                </strong>
                — {{ $gpsAccuracyMessage }}
            </p>
        </div>

        <span class="inline-flex w-fit rounded-full px-3 py-1 text-xs font-semibold ring-1 {{ $gpsAccuracyBadgeClasses }}">
            {{ $gpsAccuracyStatus }}
        </span>
    </div>
</div>

@endif

                    {{-- Map --}}
                    <div
                        id="delivery-map"
                        class="mt-6 w-full overflow-hidden rounded-2xl border border-gray-200 shadow-sm"
                        style="height: 520px; min-height: 520px;"
                    ></div>
                </section>
            @endif

            <section class="grid gap-6 xl:grid-cols-[1.8fr_1fr]">
                <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Recent Orders</h3>
                            <p class="mt-1 text-sm text-gray-500">Your latest customer order activity appears here.</p>
                        </div>
                    </div>

                    <div class="mt-6 overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead>
                                <tr class="text-left text-xs uppercase tracking-wide text-gray-500">
                                    <th class="pb-3 pr-4 font-semibold">Order</th>
                                    <th class="pb-3 pr-4 font-semibold">Placed</th>
                                    <th class="pb-3 pr-4 font-semibold">Status</th>
                                    <th class="pb-3 font-semibold">Total</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-100">
                                @forelse ($recentOrders as $order)
                                    <tr class="text-gray-700">
                                        <td class="py-4 pr-4 font-medium">
                                            {{ $order->order_number ?? 'Order #' . $order->id }}
                                        </td>

                                        <td class="py-4 pr-4">
                                            {{ optional($order->placed_at)->format('M d, Y h:i A') ?? 'Not recorded' }}
                                        </td>

                                        <td class="py-4 pr-4">
                                            <span class="inline-flex rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-800">
                                                {{ ucwords(str_replace('_', ' ', $order->fulfillment_status ?? 'pending')) }}
                                            </span>
                                        </td>

                                        <td class="py-4 font-medium text-gray-900">
                                            ${{ number_format((float) $order->total_amount, 2) }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-8 text-center text-sm text-gray-500">
                                            No customer orders have been recorded for this account yet.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <aside class="space-y-6">
                    <section class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100">
                        <h3 class="text-lg font-semibold text-gray-900">Account Snapshot</h3>

                        <dl class="mt-5 space-y-4 text-sm">
                            <div class="flex items-start justify-between gap-4">
                                <dt class="text-gray-500">Full name</dt>
                                <dd class="text-right font-medium text-gray-900">{{ $displayName }}</dd>
                            </div>

                            <div class="flex items-start justify-between gap-4">
                                <dt class="text-gray-500">Email</dt>
                                <dd class="text-right font-medium text-gray-900">{{ $user->email }}</dd>
                            </div>

                            <div class="flex items-start justify-between gap-4">
                                <dt class="text-gray-500">Phone</dt>
                                <dd class="text-right font-medium text-gray-900">
                                    {{ $user->phone_number ?? 'Add your phone number' }}
                                </dd>
                            </div>

                            <div class="flex items-start justify-between gap-4">
                                <dt class="text-gray-500">Address</dt>
                                <dd class="text-right font-medium text-gray-900">
                                    {{ $user->address ?? $user->address_line_1 ?? 'Add your address' }}
                                </dd>
                            </div>
                        </dl>
                    </section>

                    <section class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100">
                        <h3 class="text-lg font-semibold text-gray-900">Next Step</h3>

                        <p class="mt-3 text-sm leading-6 text-gray-600">
                            Keep your contact details up to date so FastBites can deliver orders and updates without delays.
                        </p>

                        <a
                            href="{{ route('profile.edit') }}"
                            class="mt-5 inline-flex items-center rounded-md border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700 transition hover:border-gray-400 hover:text-gray-900"
                        >
                            Update profile
                        </a>
                    </section>
                </aside>
            </section>
        </div>
    </div>

    @if(isset($latestTrackableOrder) && $latestTrackableOrder && $latestTrackableOrder->restaurant)
        <link
            rel="stylesheet"
            href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        />

        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const section = document.getElementById('delivery-map-section');
                const mapContainer = document.getElementById('delivery-map');

                if (!section || !mapContainer) return;
                if (typeof L === 'undefined') {
                    console.error('Leaflet did not load. Check internet connection or CDN access.');
                    mapContainer.innerHTML = '<div style="height:520px;display:flex;align-items:center;justify-content:center;color:#6b7280;">Map library did not load.</div>';
                    return;
                }

                function parseCoordinate(value) {
                    const number = parseFloat(value);
                    return Number.isNaN(number) ? null : number;
                }

                const restaurantLat = parseCoordinate(section.dataset.restaurantLat);
                const restaurantLng = parseCoordinate(section.dataset.restaurantLng);
                const customerLat = parseCoordinate(section.dataset.customerLat);
                const customerLng = parseCoordinate(section.dataset.customerLng);
                const driverLat = parseCoordinate(section.dataset.driverLat);
                const driverLng = parseCoordinate(section.dataset.driverLng);

                if (restaurantLat === null || restaurantLng === null || customerLat === null || customerLng === null) {
                    return;
                }

                const restaurant = [restaurantLat, restaurantLng];
                const customer = [customerLat, customerLng];
                const hasDriverLocation = driverLat !== null && driverLng !== null;
                const driver = hasDriverLocation ? [driverLat, driverLng] : null;

                const nablusBounds = L.latLngBounds(
                    [32.1750, 35.1900],
                    [32.2850, 35.3350]
                );

                const map = L.map('delivery-map', {
                    zoomControl: true,
                    scrollWheelZoom: true,
                    maxBounds: nablusBounds,
                    maxBoundsViscosity: 1.0,
                    minZoom: 12,
                    maxZoom: 19
                });

                L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '&copy; OpenStreetMap contributors'
                }).addTo(map);

                L.marker(restaurant)
                    .addTo(map)
                    .bindPopup('<strong>Restaurant Location</strong>');

                L.marker(customer)
                    .addTo(map)
                    .bindPopup('<strong>Customer Delivery Location</strong>');

                L.circle(restaurant, {
                    color: '#f97316',
                    fillColor: '#fb923c',
                    fillOpacity: 0.25,
                    radius: 70
                }).addTo(map);

                L.circle(customer, {
                    color: '#2563eb',
                    fillColor: '#60a5fa',
                    fillOpacity: 0.20,
                    radius: 70
                }).addTo(map);

                let routePoints = [restaurant, customer];

                if (hasDriverLocation) {
                    const isDriverInsideNablus = nablusBounds.contains(driver);

if (!isDriverInsideNablus) {
    const warningBox = document.createElement('div');

    warningBox.style.marginTop = '16px';
    warningBox.style.padding = '14px';
    warningBox.style.borderRadius = '14px';
    warningBox.style.background = '#fee2e2';
    warningBox.style.color = '#991b1b';
    warningBox.style.fontWeight = '700';
    warningBox.style.fontSize = '13px';

    warningBox.textContent = 'Driver location is outside Nablus. GPS may be inaccurate.';

    mapContainer.parentNode.insertBefore(warningBox, mapContainer);
}

                    const driverIcon = L.divIcon({
                        className: 'real-driver-marker',
                        html: `
                            <div style="
                                width: 36px;
                                height: 36px;
                                border-radius: 9999px;
                                background: #111827;
                                color: white;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                font-size: 18px;
                                box-shadow: 0 8px 20px rgba(0,0,0,0.25);
                                border: 3px solid white;
                            ">
                                🛵
                            </div>
                        `,
                        iconSize: [36, 36],
                        iconAnchor: [18, 18],
                    });

                    const driverMarker = L.marker(driver, { icon: driverIcon })
                        .addTo(map)
                        .bindPopup('<strong>Real Driver Location</strong>');

                    routePoints = [driver, customer];

                    setTimeout(() => {
                        driverMarker.openPopup();
                    }, 500);
                }

                const routeLine = L.polyline(routePoints, {
                    color: '#f97316',
                    weight: 5,
                    opacity: 0.9
                }).addTo(map);

                const bounds = L.latLngBounds(routePoints);
                bounds.extend(restaurant);
                bounds.extend(customer);

                if (driver) {
                    bounds.extend(driver);
                }

                map.fitBounds(bounds, {
                    padding: [50, 50],
                    maxZoom: 15
                });

                setTimeout(() => {
                    map.invalidateSize();
                    map.fitBounds(bounds, {
                        padding: [50, 50],
                        maxZoom: 15
                    });
                }, 300);
            });
        </script>

        <script>
            setTimeout(function () {
                window.location.reload();
            }, 60000);
        </script>
    @endif

    <script>
        document.addEventListener('click', function (event) {
            const button = document.getElementById('customer-menu-button');
            const menu = document.getElementById('customer-menu');

            if (!button || !menu) {
                return;
            }

            if (!button.contains(event.target) && !menu.contains(event.target)) {
                menu.classList.add('hidden');
            }
        });
    </script>
</x-app-layout>