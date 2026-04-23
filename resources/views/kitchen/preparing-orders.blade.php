@extends('layouts.kitchen')

@section('title', 'Preparing Orders')

@section('content')
    <header class="topbar">
        <div class="topbar-copy">
            <h1>Preparing Orders</h1>
            <p>Orders currently being cooked or assembled inside the kitchen.</p>
        </div>
    </header>

    <section class="panel orders-panel">
        <div class="panel-header panel-header-stack">
            <div>
                <h3>Preparation Board</h3>
                <p>{{ $orders->count() }} active preparation orders.</p>
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
                        <th>Started At</th>
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
                            <td>{{ $order->accepted_at ? \Carbon\Carbon::parse($order->accepted_at)->format('h:i A') : '-' }}</td>
                            <td>{{ $order->special_instructions ?: 'No notes' }}</td>
                            <td>
                                <span class="status-pill pending">Preparing</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">No preparing orders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection