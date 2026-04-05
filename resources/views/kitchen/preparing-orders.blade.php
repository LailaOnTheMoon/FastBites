@extends('layouts.kitchen')

@section('title', 'Preparing Orders')

@section('content')
    @php
        $orders = [
            ['ticket' => 'KT-2088', 'station' => 'Grill', 'items' => 'Double Burger Meal', 'chef' => 'Ahmad', 'started' => '10:56 AM'],
            ['ticket' => 'KT-2089', 'station' => 'Fry', 'items' => 'Crispy Chicken Box', 'chef' => 'Salem', 'started' => '10:58 AM'],
            ['ticket' => 'KT-2090', 'station' => 'Salad', 'items' => 'Healthy Bowl', 'chef' => 'Mona', 'started' => '11:00 AM'],
            ['ticket' => 'KT-2091', 'station' => 'Pizza', 'items' => 'Pepperoni Pizza', 'chef' => 'Yousef', 'started' => '11:03 AM'],
        ];
    @endphp

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
                <p>Static kitchen table for active preparation status.</p>
            </div>
        </div>
        <div class="table-wrap">
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>Ticket</th>
                        <th>Station</th>
                        <th>Items</th>
                        <th>Assigned Chef</th>
                        <th>Started At</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order['ticket'] }}</td>
                            <td>{{ $order['station'] }}</td>
                            <td>{{ $order['items'] }}</td>
                            <td>{{ $order['chef'] }}</td>
                            <td>{{ $order['started'] }}</td>
                            <td><span class="status-pill pending">Preparing</span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
