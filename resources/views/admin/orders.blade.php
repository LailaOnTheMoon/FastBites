@extends('layouts.admin')

@section('title', 'Admin Orders')

@section('content')
    @php
        $orders = [
            ['id' => 'ORD-10451', 'branch' => 'Downtown Branch', 'customer' => 'Mira Khaled', 'channel' => 'Delivery', 'status' => 'Pending', 'amount' => '$42'],
            ['id' => 'ORD-10452', 'branch' => 'Airport Hub', 'customer' => 'Zaid Imad', 'channel' => 'Pickup', 'status' => 'Preparing', 'amount' => '$18'],
            ['id' => 'ORD-10453', 'branch' => 'City Mall', 'customer' => 'Samar Nabil', 'channel' => 'Delivery', 'status' => 'Ready', 'amount' => '$33'],
            ['id' => 'ORD-10454', 'branch' => 'North Station', 'customer' => 'Omar Riad', 'channel' => 'Delivery', 'status' => 'Completed', 'amount' => '$27'],
        ];
    @endphp

    <header class="topbar">
        <div class="topbar-copy">
            <h1>Orders</h1>
            <p>Monitor order flow across the restaurants under admin supervision.</p>
        </div>
    </header>

    <section class="stats-grid">
        <article class="stat-card"><div class="stat-copy"><h2>146</h2><p>Open Orders</p></div></article>
        <article class="stat-card"><div class="stat-copy"><h2>38</h2><p>Preparing</p></div></article>
        <article class="stat-card"><div class="stat-copy"><h2>24</h2><p>Ready</p></div></article>
        <article class="stat-card"><div class="stat-copy"><h2>84</h2><p>Completed Today</p></div></article>
    </section>

    <section class="panel orders-panel">
        <div class="panel-header panel-header-stack">
            <div>
                <h3>Order Monitoring Table</h3>
                <p>Static sample of live order statuses for the admin dashboard.</p>
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
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order['id'] }}</td>
                            <td>{{ $order['branch'] }}</td>
                            <td>{{ $order['customer'] }}</td>
                            <td>{{ $order['channel'] }}</td>
                            <td>
                                <span class="status-pill {{ $order['status'] === 'Completed' || $order['status'] === 'Ready' ? 'delivered' : 'pending' }}">
                                    {{ $order['status'] }}
                                </span>
                            </td>
                            <td>{{ $order['amount'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
