@extends('layouts.kitchen')

@section('title', 'Completed Orders')

@section('content')
    @php
        $orders = [
            ['ticket' => 'KT-2050', 'customer' => 'Huda Ali', 'handoff' => 'Delivery', 'completed' => '09:55 AM', 'duration' => '18 min'],
            ['ticket' => 'KT-2051', 'customer' => 'Karim Nader', 'handoff' => 'Pickup', 'completed' => '10:02 AM', 'duration' => '14 min'],
            ['ticket' => 'KT-2052', 'customer' => 'Raghad Fadi', 'handoff' => 'Delivery', 'completed' => '10:09 AM', 'duration' => '20 min'],
            ['ticket' => 'KT-2053', 'customer' => 'Nour Hatem', 'handoff' => 'Pickup', 'completed' => '10:16 AM', 'duration' => '13 min'],
        ];
    @endphp

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
                <p>Static archive-style table for finished orders.</p>
            </div>
        </div>
        <div class="table-wrap">
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>Ticket</th>
                        <th>Customer</th>
                        <th>Handoff</th>
                        <th>Completed At</th>
                        <th>Total Duration</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order['ticket'] }}</td>
                            <td>{{ $order['customer'] }}</td>
                            <td>{{ $order['handoff'] }}</td>
                            <td>{{ $order['completed'] }}</td>
                            <td>{{ $order['duration'] }}</td>
                            <td><span class="status-pill delivered">Completed</span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
