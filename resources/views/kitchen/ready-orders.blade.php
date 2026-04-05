@extends('layouts.kitchen')

@section('title', 'Ready Orders')

@section('content')
    @php
        $orders = [
            ['ticket' => 'KT-2079', 'runner' => 'Omar', 'items' => 'Wrap Combo', 'packed' => '10:40 AM', 'destination' => 'Pickup Counter'],
            ['ticket' => 'KT-2080', 'runner' => 'Lina', 'items' => 'Family Meal Box', 'packed' => '10:44 AM', 'destination' => 'Delivery Shelf'],
            ['ticket' => 'KT-2081', 'runner' => 'Noor', 'items' => 'Pasta Duo', 'packed' => '10:48 AM', 'destination' => 'Delivery Shelf'],
            ['ticket' => 'KT-2082', 'runner' => 'Sami', 'items' => 'Salad Pack', 'packed' => '10:52 AM', 'destination' => 'Pickup Counter'],
        ];
    @endphp

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
                <p>Static sample of orders ready for collection.</p>
            </div>
        </div>
        <div class="table-wrap">
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>Ticket</th>
                        <th>Runner</th>
                        <th>Items</th>
                        <th>Packed At</th>
                        <th>Destination</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order['ticket'] }}</td>
                            <td>{{ $order['runner'] }}</td>
                            <td>{{ $order['items'] }}</td>
                            <td>{{ $order['packed'] }}</td>
                            <td>{{ $order['destination'] }}</td>
                            <td><span class="status-pill delivered">Ready</span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
