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

            <a
                href="{{ route('profile.edit') }}"
                class="inline-flex items-center justify-center rounded-md bg-gray-900 px-4 py-2 text-sm font-semibold text-white transition hover:bg-gray-800"
            >
                Manage Profile
            </a>
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
                                        <td class="py-4 pr-4 font-medium">{{ $order->order_number ?? 'Order #' . $order->id }}</td>
                                        <td class="py-4 pr-4">{{ optional($order->placed_at)->format('M d, Y h:i A') ?? 'Not recorded' }}</td>
                                        <td class="py-4 pr-4">
                                            <span class="inline-flex rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-800">
                                                {{ ucwords(str_replace('_', ' ', $order->fulfillment_status ?? 'pending')) }}
                                            </span>
                                        </td>
                                        <td class="py-4 font-medium text-gray-900">${{ number_format((float) $order->total_amount, 2) }}</td>
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
                                <dd class="text-right font-medium text-gray-900">{{ $user->phone_number ?? 'Add your phone number' }}</dd>
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
</x-app-layout>
