@extends('layouts.admin')

@section('title', 'FastBites Kitchen Manager Dashboard')

@section('content')
    <header class="topbar">
        <div class="topbar-copy">
            <div class="heading-row">
                <div>
                    <h1>Welcome, {{ Auth::user()->full_name }}</h1>
                    <p>Your kitchen manager dashboard is ready.</p>
                </div>
            </div>
        </div>
    </header>

    <section class="stats-grid">
        <article class="stat-card enhanced-stat-card">
            <div class="stat-copy">
                <h2>{{ Auth::user()->full_name }}</h2>
                <p>Account type: {{ ucwords(str_replace(['_','-'], ' ', Auth::user()->account_type)) }}</p>
                <span class="stat-trend up">Managing kitchen orders</span>
            </div>
        </article>
    </section>

    <section class="dashboard-grid">
        <article class="panel">
            <div class="panel-header">
                <div>
                    <h3>Kitchen Board</h3>
                    <p>Keep track of orders and preparation status.</p>
                </div>
            </div>

            <div class="p-6 text-gray-900">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="sub-box"><a href="{{ route('kitchen.new-orders') }}" class="block text-decoration-none">New Orders Today</a></div>
                    <div class="sub-box">Orders Under Preparation</div>
                    <div class="sub-box">Orders Ready for Delivery</div>
                    <div class="sub-box">Completed Orders</div>
                </div>
            </div>
        </article>
    </section>
@endsection