@extends('layouts.kitchen')

@section('title', 'Ready Orders')

@section('content')
    <header class="topbar">
        <div class="topbar-copy">
            <h1>Ready Orders</h1>
            <p>Orders packed and waiting for pickup or delivery handoff.</p>
        </div>
    </header>

    <section class="panel orders-panel">
        <div class="panel-header panel-header-stack">
            <div>
                <h3>Ready Queue</h3>
                <p>{{ $orders->count() }} orders ready for collection.</p>
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
                        <th>Packed At</th>
                        <th>Destination</th>
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
                            <td>{{ $order->prepared_at ? \Carbon\Carbon::parse($order->prepared_at)->format('h:i A') : '-' }}</td>
                            <td>{{ $order->order_type === 'pickup' ? 'Pickup Counter' : 'Delivery Handoff' }}</td>
                            <td>
                                <span class="status-pill delivered">Ready</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">No ready orders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection