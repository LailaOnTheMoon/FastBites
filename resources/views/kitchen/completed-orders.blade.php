@extends('layouts.kitchen')

@section('title', 'Completed Orders')

@section('content')
    <header class="topbar">
        <div class="topbar-copy">
            <h1>Completed Orders</h1>
            <p>Orders fully prepared and handed off successfully.</p>
        </div>
    </header>

    <section class="panel orders-panel">
        <div class="panel-header panel-header-stack">
            <div>
                <h3>Completed Queue</h3>
                <p>{{ $orders->count() }} finished kitchen orders.</p>
            </div>
        </div>

        <div class="table-wrap">
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>Ticket</th>
                        <th>Customer</th>
                        <th>Restaurant</th>
                        <th>Handoff</th>
                        <th>Completed At</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr>
                            <td>{{ $order->order_number }}</td>
                            <td>{{ $order->customer_name }}</td>
                            <td>{{ $order->restaurant_name }}</td>
                            <td>{{ ucfirst($order->order_type) }}</td>
                            <td>
                                {{ $order->delivered_at ? \Carbon\Carbon::parse($order->delivered_at)->format('h:i A') : \Carbon\Carbon::parse($order->created_at)->format('h:i A') }}
                            </td>
                            <td>${{ number_format($order->total_amount, 2) }}</td>
                            <td>
                                <span class="status-pill delivered">Completed</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">No completed orders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection