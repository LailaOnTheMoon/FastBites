@extends('layouts.kitchen')

@section('title', 'New Orders')

@section('content')
    @php
        $orders = [
            ['ticket' => 'KT-2101', 'customer' => 'Mira Khaled', 'items' => 'Burger Combo x2', 'placed' => '11:05 AM', 'note' => 'No onions'],
            ['ticket' => 'KT-2102', 'customer' => 'Zaid Imad', 'items' => 'Chicken Wrap + Fries', 'placed' => '11:08 AM', 'note' => 'Extra sauce'],
            ['ticket' => 'KT-2103', 'customer' => 'Rana Sami', 'items' => 'Family Pizza Meal', 'placed' => '11:10 AM', 'note' => 'Large size'],
            ['ticket' => 'KT-2104', 'customer' => 'Tamer Naji', 'items' => 'Caesar Salad + Soup', 'placed' => '11:12 AM', 'note' => 'Serve hot'],
        ];
    @endphp

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
                <p>Static sample table for newly placed kitchen orders.</p>
            </div>
        </div>
        <div class="table-wrap">
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>Ticket</th>
                        <th>Customer</th>
                        <th>Items</th>
                        <th>Placed At</th>
                        <th>Kitchen Note</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order['ticket'] }}</td>
                            <td>{{ $order['customer'] }}</td>
                            <td>{{ $order['items'] }}</td>
                            <td>{{ $order['placed'] }}</td>
                            <td>{{ $order['note'] }}</td>
                            <td><span class="status-pill pending">New</span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
