@extends('layouts.kitchen')

@section('title', 'New Orders')

@section('content')
    <header class="topbar">
        <div class="topbar-copy">
            <h1>New Orders</h1>
            <p>Fresh orders waiting to be accepted into the kitchen workflow.</p>
        </div>
    </header>

    <section class="panel orders-panel">
        <div class="panel-header panel-header-stack">
            <div>
                <h3>Incoming Queue</h3>
                <p>{{ $orders->count() }} newly placed kitchen orders.</p>
            </div>
        </div>

        <div class="table-wrap">
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>Ticket</th>
                        <th>Customer</th>
                        <th>Restaurant</th>
                        <th>Order Type</th>
                        <th>Placed At</th>
                        <th>Kitchen Note</th>
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
                            <td>{{ $order->placed_at ? \Carbon\Carbon::parse($order->placed_at)->format('h:i A') : '-' }}</td>
                            <td>{{ $order->special_instructions ?: 'No notes' }}</td>
                            <td>
                                <span class="status-pill pending">New</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">No new orders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection