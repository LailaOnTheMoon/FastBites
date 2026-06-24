<x-app-layout>
    <div class="min-h-screen bg-[#fff3df] py-10">
        <div class="w-full px-4 sm:px-6 lg:px-8">

            {{-- Food Delivery App Shell --}}
<div class="grid min-h-screen w-full gap-0 overflow-hidden rounded-[2.5rem] bg-white shadow-2xl lg:grid-cols-[110px_1fr]">
                {{-- Left Sidebar --}}
                <aside class="hidden bg-white px-6 py-8 lg:flex lg:flex-col lg:items-center lg:justify-between">
                    <div class="space-y-8">
                        <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-orange-500 text-2xl text-white shadow-lg">
                            🏠
                        </div>

                        <nav class="flex flex-col items-center gap-6 text-xl text-gray-400">
                            <a href="{{ route('dashboard') }}" title="Dashboard" class="flex h-11 w-11 items-center justify-center rounded-2xl transition hover:bg-orange-50 hover:text-orange-500">
                                🏠
                            </a>

                            <a href="#recommended-menu" title="Recommended Menu" class="flex h-11 w-11 items-center justify-center rounded-2xl transition hover:bg-orange-50 hover:text-orange-500">
                                🍽️
                            </a>

                            <a href="#ai-food-insights" title="AI Food Insights" class="flex h-11 w-11 items-center justify-center rounded-2xl transition hover:bg-orange-50 hover:text-orange-500">
                                🤖
                            </a>

                            <a href="#recent-orders" title="Recent Orders" class="flex h-11 w-11 items-center justify-center rounded-2xl transition hover:bg-orange-50 hover:text-orange-500">
                                📋
                            </a>

                            <a href="#delivery-map-section" title="Live Tracking" class="flex h-11 w-11 items-center justify-center rounded-2xl transition hover:bg-orange-50 hover:text-orange-500">
                                🗺️
                            </a>
                        </nav>
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button
                            type="submit"
                            class="flex h-11 w-11 items-center justify-center rounded-2xl text-xl text-gray-400 transition hover:bg-red-50 hover:text-red-500"
                        >
                            ↪
                        </button>
                    </form>
                </aside>

                {{-- Main Content Area --}}
                <main class="w-full bg-[#f7f7fb] p-5 sm:p-8">
                    <div class="flex w-full flex-col gap-6">


            {{-- Top Dashboard Header --}}
<section class="grid gap-6 xl:grid-cols-[2fr_0.9fr]">
    {{-- Left Content --}}
    <div class="space-y-5">
        <div class="flex flex-col gap-4 rounded-[32px] bg-white p-6 shadow-sm sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">
                    Today Menu
                </h1>
                <p class="mt-1 text-sm text-gray-500">
                    Welcome back, {{ $displayName }}. Track your food, AI insights, and delivery updates.
                </p>
            </div>

            <div class="relative w-full sm:max-w-xs">
                <input
                    id="customer-menu-search"
                    type="text"
                    placeholder="Search by food name"
                    class="w-full rounded-full border border-gray-200 bg-gray-50 px-5 py-3 pr-10 text-sm text-gray-700 focus:border-orange-400 focus:outline-none"
                >

                <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400">
                    🔍
                </span>
            </div>
        </div>

        <div class="relative overflow-hidden rounded-[32px] bg-white p-5 shadow-sm">
            <div class="relative overflow-hidden rounded-[28px] bg-orange-50">
                <img
                    src="{{ asset('images/delivery-hero.png') }}"
                    alt="Food delivery"
                    class="h-64 w-full object-cover"
                >

                <div class="absolute left-[42%] top-1/2 max-w-sm -translate-y-1/2">
                    <h2 class="text-3xl font-bold text-gray-900">
                        Hello {{ $displayName }},
                    </h2>

                    <p class="mt-3 text-sm leading-6 text-gray-600">
                        Get smart recommendations and live delivery tracking for your latest orders.
                    </p>

                    <a
                        href="#delivery-map-section"
                        class="mt-5 inline-flex rounded-full bg-orange-500 px-6 py-3 text-sm font-bold text-white shadow-sm hover:bg-orange-600"
                    >
                        Track Order
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Right Customer Panel --}}
    <aside class="space-y-5">
        <div class="flex items-center justify-end gap-3 rounded-[32px] bg-white p-6 shadow-sm">
            <div class="flex h-12 w-12 items-center justify-center rounded-full bg-orange-100 text-sm font-bold text-orange-700">
                {{ strtoupper(substr($displayName, 0, 1)) }}
            </div>

            <div class="text-right">
                <p class="text-sm font-bold text-gray-900">
                    {{ $displayName }}
                </p>
                <p class="text-xs text-gray-500">
                    Customer
                </p>
            </div>
        </div>

        <div class="rounded-3xl bg-gradient-to-br from-orange-500 via-amber-500 to-yellow-400 p-6 text-white shadow-lg">
    <div class="flex items-center justify-between">
        <p class="text-sm font-semibold text-white">
            FastBites Card
        </p>

        <span class="rounded-full bg-white/20 px-3 py-1 text-xs font-bold text-white">
            ACTIVE
        </span>
    </div>

    <div class="mt-10">
        <p class="text-xs uppercase tracking-widest text-white/80">
            Total Paid
        </p>

        <p class="mt-2 text-4xl font-bold text-white">
            ₪{{ number_format($totalSpent, 2) }}
        </p>
    </div>

    <div class="mt-8 flex items-end justify-between">
        <div>
            <p class="text-xs text-white/80">
                Member
            </p>
            <p class="mt-1 text-sm font-semibold text-white">
                {{ $displayName }}
            </p>
            <p class="mt-1 text-xs text-white/80">
                {{ $user->email }}
            </p>
        </div>

        <div class="text-right">
            <p class="text-xs text-white/80">
                Orders
            </p>
            <p class="text-2xl font-bold text-white">
                {{ $totalOrders }}
            </p>
        </div>
    </div>
</div>
    </aside>
</section>

            {{-- Customer Quick Stats --}}
<section class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
    <article class="rounded-3xl bg-white p-5 shadow-sm ring-1 ring-orange-100">
        <div class="flex items-center gap-4">
            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-orange-100 text-orange-600">
                <span class="text-xl font-bold">🧾</span>
            </div>

            <div>
                <p class="text-sm font-medium text-gray-500">Total Orders</p>
                <p class="mt-1 text-3xl font-bold text-gray-900">{{ $totalOrders }}</p>
            </div>
        </div>

        <p class="mt-4 text-sm text-gray-500">
            All orders linked to your customer account.
        </p>
    </article>

    <article class="rounded-3xl bg-white p-5 shadow-sm ring-1 ring-orange-100">
        <div class="flex items-center gap-4">
            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-100 text-amber-600">
                <span class="text-xl font-bold">🚚</span>
            </div>

            <div>
                <p class="text-sm font-medium text-gray-500">Active Orders</p>
                <p class="mt-1 text-3xl font-bold text-gray-900">{{ $activeOrders }}</p>
            </div>
        </div>

        <p class="mt-4 text-sm text-gray-500">
            Orders still being prepared, packed, or delivered.
        </p>
    </article>

    <article class="rounded-3xl bg-white p-5 shadow-sm ring-1 ring-orange-100">
        <div class="flex items-center gap-4">
            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-green-100 text-green-600">
                <span class="text-xl font-bold">✅</span>
            </div>

            <div>
                <p class="text-sm font-medium text-gray-500">Completed Orders</p>
                <p class="mt-1 text-3xl font-bold text-gray-900">{{ $completedOrders }}</p>
            </div>
        </div>

        <p class="mt-4 text-sm text-gray-500">
            Successfully finished orders on your account.
        </p>
    </article>

    <article class="rounded-3xl bg-white p-5 shadow-sm ring-1 ring-orange-100">
        <div class="flex items-center gap-4">
            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-yellow-100 text-yellow-600">
                <span class="text-xl font-bold">💳</span>
            </div>

            <div>
                <p class="text-sm font-medium text-gray-500">Total Paid</p>
                <p class="mt-1 text-3xl font-bold text-gray-900">
                    ₪{{ number_format($totalSpent, 2) }}
                </p>
            </div>
        </div>

        <p class="mt-4 text-sm text-gray-500">
            Sum of payments recorded as paid.
        </p>
    </article>
</section>

{{-- Menu Category --}}
<section class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-orange-100">
    <div class="flex items-center justify-between">
        <h3 class="text-2xl font-bold text-gray-900">
            Menu Category
        </h3>

        <a href="{{ url('/restaurants') }}" class="inline-flex items-center gap-2 text-sm font-bold text-orange-500">
            View All
            <span class="flex h-6 w-6 items-center justify-center rounded-full bg-orange-500 text-xs text-white">
                ›
            </span>
        </a>
    </div>

    @if(isset($menuCategories) && $menuCategories->isNotEmpty())
        <div class="mt-6 grid grid-cols-[repeat(auto-fit,minmax(170px,1fr))] gap-4">
            @foreach($menuCategories as $index => $category)
                @php
                    $categoryName = $category['name'] ?? 'Category';

                    $categoryIcon = match(strtolower($categoryName)) {
                        'pizza' => '🍕',
                        'burger', 'burgers' => '🍔',
                        'hotdog', 'hot dog' => '🌭',
                        'taco', 'tacos' => '🌮',
                        'snack', 'snacks' => '🍟',
                        'drink', 'drinks', 'juice', 'juices' => '🥤',
                        'pasta' => '🍝',
                        'salad', 'salads' => '🥗',
                        'dessert', 'desserts' => '🍰',
                        default => '🍽️',
                    };

                    $isFirst = $index === 0;

                    $categoryMenuUrl = match(strtolower($categoryName)) {
                        'desserts', 'dessert' => url('/menu'),
                        'drink', 'drinks', 'juice', 'juices' => url('/menu3'),
                        default => url('/menu2'),
                    };
                @endphp

                <article data-searchable="{{ strtolower($categoryName) }}" class="{{ $isFirst ? 'bg-orange-500 text-white' : 'bg-white text-gray-900 ring-1 ring-gray-100' }} rounded-3xl p-5 text-center shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                    <div class="{{ $isFirst ? 'bg-white' : 'bg-orange-50' }} mx-auto flex h-14 w-14 items-center justify-center rounded-full text-2xl">
                        {{ $categoryIcon }}
                    </div>

                    <p class="mt-4 font-bold">
                        {{ $categoryName }}
                    </p>

                    <p class="{{ $isFirst ? 'text-white/80' : 'text-gray-400' }} mt-1 text-xs">
                        {{ $category['count'] ?? 0 }} items
                    </p>

                    <a href="{{ $categoryMenuUrl }}" class="{{ $isFirst ? 'bg-white text-orange-500' : 'bg-orange-500 text-white' }} mx-auto mt-4 flex h-7 w-7 items-center justify-center rounded-full text-sm font-bold" title="Open category menu">
                        ›
                    </a>
                </article>
            @endforeach
        </div>
    @else
        <div class="mt-6 rounded-3xl border border-dashed border-orange-200 bg-orange-50 p-6 text-center">
            <p class="text-sm font-semibold text-gray-700">
                No menu categories available yet.
            </p>
        </div>
    @endif
</section>

{{-- AI Recommendations Section --}}
<section id="recommended-menu" class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-orange-100">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h3 class="text-2xl font-bold text-gray-900">Recommended Menu 🍽️</h3>
            <p class="mt-1 text-sm text-gray-500">
                Personalized meals based on your taste, favorite categories, and order history.
            </p>
        </div>

        <a href="#recommended-menu" class="inline-flex w-fit rounded-full bg-orange-100 px-4 py-2 text-xs font-bold text-orange-700 transition hover:bg-orange-200">
            AI Suggestions
        </a>
    </div>

    @if(isset($recommendedItems) && $recommendedItems->isNotEmpty())
        <div class="mt-6 grid grid-cols-[repeat(auto-fit,minmax(240px,1fr))] gap-5">
            @foreach($recommendedItems as $item)
                @php
                    $category = strtolower($item->category ?? '');

                    $menuUrl = match ($category) {
                        'desserts', 'dessert' => url('/menu'),
                        'drinks', 'drink' => url('/menu3'),
                        default => url('/menu2'),
                    };
                @endphp

                <article data-searchable="{{ strtolower(($item->name ?? '') . ' ' . ($item->category ?? '') . ' ' . ($item->restaurant->name ?? '')) }}" class="group overflow-hidden rounded-3xl border border-orange-100 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-xl">
                    <div class="relative">
                        @if($item->image_path)
                            <img
                                src="{{ asset($item->image_path) }}"
                                alt="{{ $item->name }}"
                                class="h-44 w-full object-cover"
                            >
                        @else
                            <div class="flex h-44 w-full items-center justify-center bg-gradient-to-r from-orange-500 to-yellow-400 text-5xl font-bold text-white">
                                {{ strtoupper(substr($item->name, 0, 1)) }}
                            </div>
                        @endif

                        <span class="absolute left-4 top-4 inline-flex rounded-full bg-white/90 px-3 py-1 text-xs font-bold text-orange-700 shadow-sm">
                            {{ $item->category ?? 'Popular' }}
                        </span>

                        <span class="absolute right-4 top-4 inline-flex h-9 w-9 items-center justify-center rounded-full bg-white text-orange-600 shadow-sm">
                            ★
                        </span>
                    </div>

                    <div class="p-5">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <h4 class="line-clamp-1 text-lg font-bold text-gray-900">
                                    {{ $item->name }}
                                </h4>

                                <p class="mt-1 line-clamp-1 text-sm text-gray-500">
                                    {{ $item->restaurant->name ?? 'FastBites Restaurant' }}
                                </p>
                            </div>

                            <strong class="text-lg font-bold text-orange-600">
                                ₪{{ number_format((float) $item->base_price, 2) }}
                            </strong>
                        </div>

                        <div class="mt-4 flex items-center justify-between">
                            @if($item->preparation_time_minutes)
                                <span class="rounded-full bg-orange-50 px-3 py-1 text-xs font-semibold text-orange-700">
                                    {{ $item->preparation_time_minutes }} min
                                </span>
                            @else
                                <span class="rounded-full bg-orange-50 px-3 py-1 text-xs font-semibold text-orange-700">
                                    Fast prep
                                </span>
                            @endif

                            <a href="{{ $menuUrl }}" class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-orange-500 text-lg font-bold text-white shadow-sm transition hover:bg-orange-600" title="Open item menu">
                                +
                            </a>
                        </div>

                        <p class="mt-4 rounded-2xl bg-gray-50 p-3 text-xs leading-5 text-gray-500">
                            {{ $item->recommendation_reason ?? 'Suggested based on your taste and order history.' }}
                        </p>
                    </div>
                </article>
            @endforeach
        </div>
    @else
        <div class="mt-6 rounded-3xl border border-dashed border-orange-200 bg-orange-50/60 p-8 text-center">
            <p class="text-sm font-semibold text-gray-700">
                No recommendations available yet.
            </p>
            <p class="mt-2 text-sm text-gray-500">
                Once you place more orders, FastBites will suggest meals that match your taste.
            </p>
        </div>
    @endif
</section>

            {{-- AI Insights Section --}}
<section id="ai-food-insights" class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-orange-100">
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h3 class="text-2xl font-bold text-gray-900">
                AI Food Insights
            </h3>

            <p class="mt-1 text-sm text-gray-500">
                FastBites analyzes your order history to understand your food preferences.
            </p>
        </div>

        <a href="#ai-food-insights" class="inline-flex w-fit rounded-full bg-orange-100 px-4 py-2 text-xs font-bold text-orange-700 transition hover:bg-orange-200">
            Smart Analysis
        </a>
    </div>

    @php
        /*
            AI Food Insights should only display menu items and restaurants
            that currently exist in the real FastBites menu.
            This prevents old database orders such as "Margherita Pizza"
            from appearing after the menu was updated.
        */
        $availableRecommendedItems = collect($recommendedItems ?? [])->filter();

        $availableItemNames = $availableRecommendedItems
            ->pluck('name')
            ->filter()
            ->values();

        $availableRestaurantNames = $availableRecommendedItems
            ->map(fn ($item) => $item->restaurant->name ?? null)
            ->filter()
            ->unique()
            ->values();

        $favoriteCategory = $aiInsights['favorite_category'] ?? 'Not enough data yet';
        $preferredRestaurant = $aiInsights['preferred_restaurant'] ?? 'Not enough data yet';
        $lastOrderedItem = $aiInsights['last_ordered_item'] ?? 'No previous item found';
        $insightReason = $aiInsights['reason'] ?? 'Place more orders so FastBites can learn your preferences.';

        $fallbackItem = $availableRecommendedItems
            ->first(fn ($item) => strtolower($item->category ?? '') === strtolower($favoriteCategory));

        $fallbackItem = $fallbackItem ?: $availableRecommendedItems->first();

        if ($availableItemNames->isNotEmpty() && ! $availableItemNames->contains($lastOrderedItem)) {
            $lastOrderedItem = $fallbackItem->name ?? $availableItemNames->first();
        }

        if ($availableRestaurantNames->isNotEmpty() && ! $availableRestaurantNames->contains($preferredRestaurant)) {
            $preferredRestaurant = $fallbackItem->restaurant->name ?? $availableRestaurantNames->first();
        }

        $favoriteCategoryIcon = match(strtolower($favoriteCategory)) {
            'pizza' => '🍕',
            'burger', 'burgers' => '🍔',
            'chicken' => '🍗',
            'shawarma' => '🌯',
            'drinks', 'drink', 'juice', 'juices' => '🥤',
            'salad', 'salads' => '🥗',
            'dessert', 'desserts' => '🍰',
            default => '🍽️',
        };

        $insightCards = [
            [
                'label' => 'Favorite Category',
                'value' => $favoriteCategory,
                'description' => 'Your most frequent food category.',
                'icon' => $favoriteCategoryIcon,
                'bg' => 'from-orange-50 to-white',
                'icon_bg' => 'bg-orange-100',
            ],
            [
                'label' => 'Preferred Restaurant',
                'value' => $preferredRestaurant,
                'description' => 'The restaurant you order from most.',
                'icon' => '🏪',
                'bg' => 'from-amber-50 to-white',
                'icon_bg' => 'bg-amber-100',
            ],
            [
                'label' => 'Last Ordered Item',
                'value' => $lastOrderedItem,
                'description' => 'The latest available item related to your order history.',
                'icon' => '🍽️',
                'bg' => 'from-yellow-50 to-white',
                'icon_bg' => 'bg-yellow-100',
            ],
        ];
    @endphp

    <div class="mt-6 grid gap-5 md:grid-cols-3">
        @foreach($insightCards as $card)
            <article class="rounded-3xl bg-gradient-to-br {{ $card['bg'] }} p-5 ring-1 ring-orange-100 transition hover:-translate-y-1 hover:shadow-md">
                <div class="flex items-start justify-between gap-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl {{ $card['icon_bg'] }} text-xl">
                        {{ $card['icon'] }}
                    </div>

                    <span class="rounded-full bg-white px-3 py-1 text-xs font-bold text-orange-600 ring-1 ring-orange-100">
                        AI
                    </span>
                </div>

                <p class="mt-4 text-xs font-bold uppercase tracking-wide text-orange-600">
                    {{ $card['label'] }}
                </p>

                <p class="mt-3 text-xl font-bold text-gray-900">
                    {{ $card['value'] }}
                </p>

                <p class="mt-2 text-sm text-gray-500">
                    {{ $card['description'] }}
                </p>
            </article>
        @endforeach
    </div>

    <div class="mt-6 rounded-3xl bg-orange-50 p-5 ring-1 ring-orange-100">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
            <div>
                <p class="text-sm font-bold text-orange-700">
                    Recommendation Reason
                </p>

                <p class="mt-2 text-sm leading-6 text-gray-600">
                    {{ $insightReason }}
                </p>
            </div>

            <a href="#recommended-menu" class="inline-flex w-fit rounded-full bg-white px-3 py-1 text-xs font-bold text-orange-700 ring-1 ring-orange-100 transition hover:bg-orange-50">
                AI Logic
            </a>
        </div>
    </div>
</section>


           {{-- AI ETA & Delivery Map Section --}}
@if(isset($latestTrackableOrder) && $latestTrackableOrder && $latestTrackableOrder->restaurant)
    @php
        $currentStatus = $latestTrackableOrder->fulfillment_status ?? null;

        $orderStatusLabel = ucwords(str_replace('_', ' ', $currentStatus ?? 'pending'));

        $etaMinutes = $aiEtaPrediction['predicted_eta_minutes'] ?? null;
        $distanceKm = $aiEtaPrediction['distance_km'] ?? null;
        $deliveryDuration = $aiEtaPrediction['delivery_duration_minutes'] ?? null;
        $remainingPreparation = $aiEtaPrediction['remaining_preparation_minutes'] ?? null;
        $delayRisk = $aiEtaPrediction['delay_risk'] ?? 'Unknown';

        $riskClasses = match(strtolower($delayRisk)) {
            'low' => 'bg-green-50 text-green-700 ring-green-100',
            'medium' => 'bg-yellow-50 text-yellow-700 ring-yellow-100',
            'high' => 'bg-red-50 text-red-700 ring-red-100',
            default => 'bg-gray-50 text-gray-700 ring-gray-100',
        };

        $orderTimelineSteps = [
            [
                'label' => 'Order Placed',
                'description' => 'Your order has been received by FastBites.',
                'statuses' => ['pending', 'accepted', 'preparing', 'ready', 'dispatched', 'delivered', 'completed'],
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

    <section
        class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-orange-100"
        id="delivery-map-section"
        data-restaurant-lat="{{ $latestTrackableOrder->restaurant->latitude }}"
        data-restaurant-lng="{{ $latestTrackableOrder->restaurant->longitude }}"
        data-customer-lat="{{ $latestTrackableOrder->delivery_latitude }}"
        data-customer-lng="{{ $latestTrackableOrder->delivery_longitude }}"
        data-driver-lat="{{ $latestTrackableOrder->deliveryDriver?->current_latitude }}"
        data-driver-lng="{{ $latestTrackableOrder->deliveryDriver?->current_longitude }}"
        data-driver-accuracy="{{ $latestTrackableOrder->deliveryDriver?->current_location_accuracy }}"
    >
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h3 class="text-2xl font-bold text-gray-900">
                    Live Delivery Tracking
                </h3>
                <p class="mt-1 text-sm text-gray-500">
                    Python AI predicts delivery time using restaurant, customer, and driver location data.
                </p>
            </div>

            <span class="inline-flex w-fit rounded-full bg-orange-100 px-4 py-2 text-xs font-bold text-orange-700">
                Python AI + OpenStreetMap
            </span>
        </div>

        {{-- Main Tracking Layout --}}
        <div class="mt-6 grid gap-6 xl:grid-cols-[1.05fr_1.4fr]">
            {{-- Left Tracking Details --}}
            <div class="space-y-5">
                {{-- Order Info Cards --}}
                <div class="grid gap-4 sm:grid-cols-3 xl:grid-cols-1">
                    <article class="rounded-3xl bg-gradient-to-br from-orange-50 to-white p-5 ring-1 ring-orange-100">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-orange-100 text-xl">
                                📦
                            </div>

                            <span class="rounded-full bg-white px-3 py-1 text-xs font-bold text-orange-600 ring-1 ring-orange-100">
                                {{ $orderStatusLabel }}
                            </span>
                        </div>

                        <p class="mt-4 text-xs font-bold uppercase tracking-wide text-orange-600">
                            Tracking Order
                        </p>

                        <p class="mt-2 text-lg font-bold text-gray-900">
                            {{ $latestTrackableOrder->order_number ?? ('Order #' . $latestTrackableOrder->id) }}
                        </p>

                        <p class="mt-2 text-sm text-gray-500">
                            Current status:
                            <span class="font-bold text-orange-600">
                                {{ $orderStatusLabel }}
                            </span>
                        </p>
                    </article>

                    <article class="rounded-3xl bg-gradient-to-br from-amber-50 to-white p-5 ring-1 ring-orange-100">
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-100 text-xl">
                            🏪
                        </div>

                        <p class="mt-4 text-xs font-bold uppercase tracking-wide text-orange-600">
                            Restaurant
                        </p>

                        <p class="mt-2 text-lg font-bold text-gray-900">
                            {{ $latestTrackableOrder->restaurant->name ?? 'Restaurant' }}
                        </p>

                        <p class="mt-2 text-sm text-gray-500">
                            {{ $latestTrackableOrder->restaurant->address_line_1 ?? 'Restaurant address unavailable' }}
                        </p>
                    </article>

                    <article class="rounded-3xl bg-gradient-to-br from-yellow-50 to-white p-5 ring-1 ring-orange-100">
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-yellow-100 text-xl">
                            📍
                        </div>

                        <p class="mt-4 text-xs font-bold uppercase tracking-wide text-orange-600">
                            Delivery Address
                        </p>

                        <p class="mt-2 text-lg font-bold text-gray-900">
                            {{ $latestTrackableOrder->delivery_address_line_1 ?? 'Customer address' }}
                        </p>

                        <p class="mt-2 text-sm text-gray-500">
                            {{ $latestTrackableOrder->delivery_city ?? '' }}
                            {{ $latestTrackableOrder->delivery_country ?? '' }}
                        </p>
                    </article>
                </div>

                {{-- AI ETA Highlight --}}
                <div class="rounded-3xl bg-gradient-to-br from-orange-500 via-amber-500 to-yellow-400 p-6 text-white shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold uppercase tracking-widest text-white/80">
                                AI Estimated ETA
                            </p>

                            <p class="mt-3 text-4xl font-bold">
                                @if($etaMinutes !== null)
                                    {{ $etaMinutes }} min
                                @else
                                    ...
                                @endif
                            </p>
                        </div>

                        <div class="flex h-16 w-16 items-center justify-center rounded-3xl bg-white/20 text-3xl">
                            🛵
                        </div>
                    </div>

                    <p class="mt-5 text-sm leading-6 text-white/90">
                        {{ $aiEtaPrediction['customer_update_message'] ?? 'Smart delivery update is not available yet.' }}
                    </p>
                </div>
            </div>

            {{-- Right Map --}}
            <div class="rounded-3xl bg-orange-50 p-4 ring-1 ring-orange-100">
                <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <p class="text-lg font-bold text-gray-900">
                            Delivery Route Map
                        </p>
                        <p class="text-sm text-gray-500">
                            Restaurant, customer, and driver locations are shown on the map.
                        </p>
                    </div>

                    <a href="#delivery-map" class="inline-flex w-fit rounded-full bg-white px-3 py-1 text-xs font-bold text-orange-700 ring-1 ring-orange-100 transition hover:bg-orange-50">
                        Live Route
                    </a>
                </div>

                <div
                    id="delivery-map"
                    class="w-full overflow-hidden rounded-3xl border border-orange-100 bg-white shadow-sm"
                    style="height: 380px; min-height: 560px;"
                ></div>
            </div>
        </div>

        {{-- Python AI Results --}}
        <div class="mt-6 grid gap-4 md:grid-cols-2 xl:grid-cols-5">
            <article class="rounded-3xl bg-orange-50 p-5 ring-1 ring-orange-100">
                <p class="text-xs font-bold uppercase tracking-wide text-orange-600">
                    Order Stage
                </p>
                <p class="mt-3 text-lg font-bold text-gray-900">
                    {{ $aiEtaPrediction['order_stage'] ?? 'Calculating...' }}
                </p>
            </article>

            <article class="rounded-3xl bg-orange-50 p-5 ring-1 ring-orange-100">
                <p class="text-xs font-bold uppercase tracking-wide text-orange-600">
                    Preparation
                </p>
                <p class="mt-3 text-2xl font-bold text-gray-900">
                    @if($remainingPreparation !== null)
                        {{ $remainingPreparation }} min
                    @else
                        Calculating...
                    @endif
                </p>
            </article>

            <article class="rounded-3xl bg-orange-50 p-5 ring-1 ring-orange-100">
                <p class="text-xs font-bold uppercase tracking-wide text-orange-600">
                    Distance
                </p>
                <p class="mt-3 text-2xl font-bold text-gray-900">
                    @if($distanceKm !== null)
                        {{ number_format((float) $distanceKm, 2) }} km
                    @else
                        Calculating...
                    @endif
                </p>
            </article>

            <article class="rounded-3xl bg-orange-50 p-5 ring-1 ring-orange-100">
                <p class="text-xs font-bold uppercase tracking-wide text-orange-600">
                    Delivery Time
                </p>
                <p class="mt-3 text-2xl font-bold text-gray-900">
                    @if($deliveryDuration !== null)
                        {{ $deliveryDuration }} min
                    @else
                        Calculating...
                    @endif
                </p>
            </article>

            <article class="rounded-3xl p-5 ring-1 {{ $riskClasses }}">
                <p class="text-xs font-bold uppercase tracking-wide">
                    Delay Risk
                </p>
                <p class="mt-3 text-2xl font-bold">
                    {{ $delayRisk }}
                </p>
            </article>
        </div>

        {{-- Explanation + Customer Update --}}
        <div class="mt-6 grid gap-4 lg:grid-cols-2">
            <div class="rounded-3xl bg-orange-50/80 p-5 ring-1 ring-orange-100">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
                    <div>
                        <p class="text-sm font-bold text-orange-700">
                            Python AI Explanation
                        </p>

                        <p class="mt-2 text-sm leading-6 text-gray-600">
                            {{ $aiEtaPrediction['explanation'] ?? 'AI ETA prediction is not available yet.' }}
                        </p>
                    </div>

                    <span class="inline-flex w-fit rounded-full bg-white px-3 py-1 text-xs font-bold text-orange-700 ring-1 ring-orange-100">
                        Source: {{ ucwords($aiEtaPrediction['location_source'] ?? 'unknown') }}
                    </span>
                </div>
            </div>

            <div class="rounded-3xl bg-orange-50/80 p-5 ring-1 ring-orange-100">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
                    <div>
                        <p class="text-sm font-bold text-orange-700">
                            Smart Customer Update
                        </p>

                        <p class="mt-2 text-sm leading-6 text-gray-700">
                            {{ $aiEtaPrediction['customer_update_message'] ?? 'Smart delivery update is not available yet.' }}
                        </p>
                    </div>

                    <span class="inline-flex w-fit rounded-full bg-white px-3 py-1 text-xs font-bold text-orange-700 ring-1 ring-orange-100">
                        AI Message
                    </span>
                </div>
            </div>
        </div>

        {{-- Order Timeline --}}
        <div class="mt-6 rounded-3xl bg-white p-5 shadow-sm ring-1 ring-orange-100">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
                <div>
                    <p class="text-lg font-bold text-gray-900">
                        Order Timeline
                    </p>
                    <p class="mt-1 text-sm text-gray-500">
                        Follow your order progress from placement to delivery.
                    </p>
                </div>

                <span class="inline-flex w-fit rounded-full bg-orange-100 px-4 py-2 text-xs font-bold text-orange-700">
                    Live Status
                </span>
            </div>

            <div class="mt-6 grid gap-4 sm:grid-cols-2 xl:grid-cols-5">
                @foreach($orderTimelineSteps as $step)
                    @php
                        $isCompleted = in_array($currentStatus, $step['statuses'], true);
                    @endphp

                    <div class="rounded-3xl border p-4 {{ $isCompleted ? 'border-green-200 bg-green-50' : 'border-gray-200 bg-gray-50' }}">
                        <div class="flex items-center gap-3">
                            <span class="flex h-9 w-9 items-center justify-center rounded-2xl text-sm font-bold {{ $isCompleted ? 'bg-green-600 text-white' : 'bg-gray-200 text-gray-500' }}">
                                {{ $isCompleted ? '✓' : '○' }}
                            </span>

                            <p class="text-sm font-bold {{ $isCompleted ? 'text-green-800' : 'text-gray-500' }}">
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

        {{-- GPS Accuracy Warning --}}
        @if(($latestTrackableOrder->fulfillment_status ?? null) === 'dispatched')
            <div class="mt-6 rounded-3xl border p-5 {{ $gpsAccuracyClasses }}">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
                    <div>
                        <p class="text-sm font-bold">
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

                    <span class="inline-flex w-fit rounded-full px-3 py-1 text-xs font-bold ring-1 {{ $gpsAccuracyBadgeClasses }}">
                        {{ $gpsAccuracyStatus }}
                    </span>
                </div>
            </div>
        @endif
    </section>
@endif

{{-- Recent Orders + Account Snapshot --}}
<section id="recent-orders" class="grid gap-6 xl:grid-cols-[1.6fr_0.9fr]">
    {{-- Recent Orders --}}
    <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-orange-100">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h3 class="text-2xl font-bold text-gray-900">
                    Recent Orders
                </h3>
                <p class="mt-1 text-sm text-gray-500">
                    Your latest customer order activity appears here.
                </p>
            </div>

            <a href="#recent-orders" class="inline-flex w-fit rounded-full bg-orange-100 px-4 py-2 text-xs font-bold text-orange-700 transition hover:bg-orange-200">
                Order History
            </a>
        </div>

        <div class="mt-6 overflow-hidden rounded-3xl border border-orange-100">
            <table class="min-w-full divide-y divide-orange-100 text-sm">
                <thead class="bg-orange-50/70">
                    <tr class="text-left text-xs uppercase tracking-wide text-orange-600">
                        <th class="px-5 py-4 font-bold">Order</th>
                        <th class="px-5 py-4 font-bold">Placed</th>
                        <th class="px-5 py-4 font-bold">Status</th>
                        <th class="px-5 py-4 text-right font-bold">Total</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-orange-50 bg-white">
                    @forelse ($recentOrders as $order)
                        @php
                            $orderStatus = $order->fulfillment_status ?? 'pending';

                            $statusClasses = match($orderStatus) {
                                'delivered', 'completed' => 'bg-green-100 text-green-700',
                                'dispatched', 'ready' => 'bg-blue-100 text-blue-700',
                                'preparing', 'accepted' => 'bg-yellow-100 text-yellow-700',
                                'cancelled', 'failed' => 'bg-red-100 text-red-700',
                                default => 'bg-orange-100 text-orange-700',
                            };
                        @endphp

                        <tr class="text-gray-700 transition hover:bg-orange-50/40">
                            <td class="px-5 py-4 font-bold text-gray-900">
                                {{ $order->order_number ?? 'Order #' . $order->id }}
                            </td>

                            <td class="px-5 py-4 text-gray-500">
                                {{ optional($order->placed_at)->format('M d, Y h:i A') ?? 'Not recorded' }}
                            </td>

                            <td class="px-5 py-4">
                                <span class="inline-flex rounded-full px-3 py-1 text-xs font-bold {{ $statusClasses }}">
                                    {{ ucwords(str_replace('_', ' ', $orderStatus)) }}
                                </span>
                            </td>

                            <td class="px-5 py-4 text-right font-bold text-gray-900">
                                ₪{{ number_format((float) $order->total_amount, 2) }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-5 py-10 text-center">
                                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-orange-100 text-2xl">
                                    🧾
                                </div>

                                <p class="mt-4 text-sm font-bold text-gray-700">
                                    No orders yet.
                                </p>

                                <p class="mt-1 text-sm text-gray-500">
                                    Your recent customer orders will appear here.
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-6 rounded-3xl bg-orange-50 p-5 ring-1 ring-orange-100">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm font-bold text-orange-700">
                Orders Summary
            </p>
            <p class="mt-1 text-sm text-gray-600">
                You have {{ $totalOrders }} total orders, including {{ $completedOrders }} completed orders and {{ $activeOrders }} active orders.
            </p>
        </div>

        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white text-xl shadow-sm">
            🧾
        </div>
    </div>
</div>
        </div>
    </div>

    {{-- Right Side --}}
    <aside class="space-y-6">
        {{-- Account Snapshot --}}
        <section class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-orange-100">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-bold text-gray-900">
                    Account Snapshot
                </h3>

                <span class="flex h-10 w-10 items-center justify-center rounded-2xl bg-orange-100 text-sm font-bold text-orange-700">
                    {{ strtoupper(substr($displayName, 0, 1)) }}
                </span>
            </div>

            <dl class="mt-6 space-y-4 text-sm">
                <div class="flex items-start justify-between gap-4 rounded-2xl bg-orange-50/60 p-4">
                    <dt class="font-medium text-gray-500">Full name</dt>
                    <dd class="text-right font-bold text-gray-900">{{ $displayName }}</dd>
                </div>

                <div class="flex items-start justify-between gap-4 rounded-2xl bg-orange-50/60 p-4">
                    <dt class="font-medium text-gray-500">Email</dt>
                    <dd class="text-right font-bold text-gray-900">{{ $user->email }}</dd>
                </div>

                <div class="flex items-start justify-between gap-4 rounded-2xl bg-orange-50/60 p-4">
                    <dt class="font-medium text-gray-500">Phone</dt>
                    <dd class="text-right font-bold text-gray-900">
                        {{ $user->phone_number ?? 'Add your phone number' }}
                    </dd>
                </div>

                <div class="flex items-start justify-between gap-4 rounded-2xl bg-orange-50/60 p-4">
                    <dt class="font-medium text-gray-500">Address</dt>
                    <dd class="text-right font-bold text-gray-900">
                        {{ $user->address ?? $user->address_line_1 ?? 'Add your address' }}
                    </dd>
                </div>
            </dl>
        </section>

        {{-- Next Step --}}
        <section class="rounded-3xl bg-gradient-to-br from-orange-500 via-amber-500 to-yellow-400 p-6 text-white shadow-lg">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-bold">
                    Next Step
                </h3>

                <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white/20 text-2xl">
                    👤
                </span>
            </div>

            <p class="mt-4 text-sm leading-6 text-white/90">
                Keep your contact details up to date so FastBites can deliver orders and updates without delays.
            </p>

            <a
                href="{{ route('profile.edit') }}"
                class="mt-6 inline-flex rounded-full bg-white px-5 py-3 text-sm font-bold text-orange-600 shadow-sm transition hover:bg-orange-50"
            >
                Update profile
            </a>
        </section>
    </aside>
</section>
</div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('customer-menu-search');
        const searchableCards = document.querySelectorAll('[data-searchable]');

        if (!searchInput || searchableCards.length === 0) {
            return;
        }

        searchInput.addEventListener('input', function () {
            const keyword = searchInput.value.trim().toLowerCase();

            searchableCards.forEach(function (card) {
                const text = card.dataset.searchable || '';
                card.classList.toggle('hidden', keyword && !text.includes(keyword));
            });
        });
    });
</script>
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

            if (!section || !mapContainer) {
                return;
            }

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
                    warningBox.style.borderRadius = '18px';
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

            L.polyline(routePoints, {
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
                    </div>
                </main>
            </div>
        </div>
    </div>
</x-app-layout>