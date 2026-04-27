@extends('layouts.admin')

@section('title', 'Admin Orders')

@section('content')
    <header class="topbar">
        <div class="topbar-copy">
            <h1>Orders</h1>
            <p>Monitor order flow across the restaurants under admin supervision.</p>
        </div>
    </header>

    <section class="stats-grid">
        <article class="stat-card">
            <div class="stat-copy">
                <h2>{{ $openOrders }}</h2>
                <p>Open Orders</p>
            </div>
        </article>

        <article class="stat-card">
            <div class="stat-copy">
                <h2>{{ $preparing }}</h2>
                <p>Preparing</p>
            </div>
        </article>

        <article class="stat-card">
            <div class="stat-copy">
                <h2>{{ $ready }}</h2>
                <p>Ready</p>
            </div>
        </article>

        <article class="stat-card">
            <div class="stat-copy">
                <h2>{{ $completed }}</h2>
                <p>Completed Today</p>
            </div>
        </article>
    </section>

    <section class="panel orders-panel">
        <div class="panel-header panel-header-stack">
            <div>
                <h3>Order Monitoring Table</h3>
                <p>Dynamic live order statuses from the database.</p>
            </div>
        </div>

        <div class="table-wrap">
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Branch</th>
                        <th>Customer</th>
                        <th>Channel</th>
                        <th>Status</th>
                        <th>Payment</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr>
                            <td>{{ $order->order_number }}</td>
                            <td>{{ $order->restaurant_name }}</td>
                            <td>{{ $order->customer_name }}</td>
                            <td>{{ ucfirst($order->order_type) }}</td>
                            <td>
                                <span class="status-pill
                                    {{ in_array($order->fulfillment_status, ['delivered', 'ready']) ? 'delivered' : 'pending' }}">
                                    {{ ucfirst($order->fulfillment_status) }}
                                </span>
                            </td>
                            <td>
                                <span class="status-pill {{ $order->payment_status === 'paid' ? 'delivered' : 'pending' }}">
                                    {{ ucfirst($order->payment_status) }}
                                </span>
                            </td>
                            <td>${{ number_format($order->total_amount, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">No orders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection