@extends('layouts.admin')

@section('title', 'FastBites Admin Dashboard')

@section('content')
    @php
        $stats = [
            ['label' => 'Managed Restaurants', 'value' => '28', 'accent' => 'orange', 'trend' => '+3 this month', 'trend_class' => 'up'],
            ['label' => 'Open Orders', 'value' => '146', 'accent' => 'green', 'trend' => '+12 since morning', 'trend_class' => 'up'],
            ['label' => 'Daily Revenue', 'value' => '$8,420', 'accent' => 'pink', 'trend' => '+6.2% today', 'trend_class' => 'up'],
            ['label' => 'Pending Reviews', 'value' => '19', 'accent' => 'amber', 'trend' => '4 need attention', 'trend_class' => 'down'],
        ];

        $restaurants = [
            ['name' => 'Downtown Branch', 'manager' => 'Layla Sami', 'status' => 'Running', 'orders' => '42'],
            ['name' => 'Airport Hub', 'manager' => 'Rami Adel', 'status' => 'Busy', 'orders' => '35'],
            ['name' => 'City Mall', 'manager' => 'Nada Hasan', 'status' => 'Running', 'orders' => '27'],
            ['name' => 'North Station', 'manager' => 'Fadi Omar', 'status' => 'Needs Check', 'orders' => '18'],
        ];

        $activities = [
            ['title' => 'Kitchen coverage updated', 'time' => '10:30 AM'],
            ['title' => 'Restaurant menu audit submitted', 'time' => '09:15 AM'],
            ['title' => 'Order delay report reviewed', 'time' => '08:40 AM'],
            ['title' => 'Shift planning synced', 'time' => 'Yesterday'],
        ];
    @endphp

    <header class="topbar">
        <div class="topbar-copy">
            <div class="heading-row">
                <div>
                    <h1>Admin Dashboard</h1>
                    <p>Track restaurant operations, orders, and daily admin priorities.</p>
                </div>
                <a href="{{ route('admin.reports') }}" class="quick-action-button">Open Reports</a>
            </div>
        </div>
        <div class="topbar-actions">
            <div class="profile-chip" aria-label="Profile">
                <div class="profile-avatar">
                    {{ strtoupper(substr(auth()->user()->first_name ?? 'A', 0, 1)) }}{{ strtoupper(substr(auth()->user()->last_name ?? 'D', 0, 1)) }}
                </div>
            </div>
        </div>
    </header>

    <section class="stats-grid">
        @foreach ($stats as $stat)
            <article class="stat-card enhanced-stat-card">
                <div class="stat-icon {{ $stat['accent'] }}">
                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 5.5A1.5 1.5 0 0 1 5.5 4h13A1.5 1.5 0 0 1 20 5.5v13a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 4 18.5zm2 0V11h5V6zm7 0v5h5V5.5zM6 13v5.5h5V13zm7 0v5.5h5V13z" /></svg>
                </div>
                <div class="stat-copy">
                    <h2>{{ $stat['value'] }}</h2>
                    <p>{{ $stat['label'] }}</p>
                    <span class="stat-trend {{ $stat['trend_class'] }}">{{ $stat['trend'] }}</span>
                </div>
            </article>
        @endforeach
    </section>

    <section class="dashboard-grid">
        <article class="panel">
            <div class="panel-header">
                <div>
                    <h3>Restaurant Snapshot</h3>
                    <p>Quick operational overview across assigned branches.</p>
                </div>
            </div>
            <div class="table-wrap">
                <table class="orders-table">
                    <thead>
                        <tr>
                            <th>Restaurant</th>
                            <th>Manager</th>
                            <th>Status</th>
                            <th>Open Orders</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($restaurants as $restaurant)
                            <tr>
                                <td>{{ $restaurant['name'] }}</td>
                                <td>{{ $restaurant['manager'] }}</td>
                                <td><span class="status-pill {{ $restaurant['status'] === 'Needs Check' ? 'canceled' : 'delivered' }}">{{ $restaurant['status'] }}</span></td>
                                <td>{{ $restaurant['orders'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </article>

        <article class="panel">
            <div class="panel-header">
                <div>
                    <h3>Today Priorities</h3>
                    <p>Focus items for the current shift.</p>
                </div>
            </div>
            <div class="summary-row">
                <div class="summary-card">
                    <strong>07</strong>
                    <span>Restaurants pending review</span>
                </div>
                <div class="summary-card">
                    <strong>14 min</strong>
                    <span>Average order delay</span>
                </div>
            </div>
            <div class="revenue-list">
                <div class="revenue-item">
                    <div class="revenue-meta"><span>Kitchen response rate</span><strong>84%</strong></div>
                    <div class="progress-track"><span class="progress-fill" style="width: 84%;"></span></div>
                </div>
                <div class="revenue-item">
                    <div class="revenue-meta"><span>Branch compliance</span><strong>76%</strong></div>
                    <div class="progress-track"><span class="progress-fill" style="width: 76%;"></span></div>
                </div>
                <div class="revenue-item">
                    <div class="revenue-meta"><span>Customer satisfaction</span><strong>91%</strong></div>
                    <div class="progress-track"><span class="progress-fill" style="width: 91%;"></span></div>
                </div>
            </div>
        </article>

        <article class="panel">
            <div class="panel-header">
                <div>
                    <h3>Recent Activity</h3>
                    <p>Latest admin actions and updates.</p>
                </div>
            </div>
            <ul class="status-legend">
                @foreach ($activities as $activity)
                    <li><span class="legend-dot orange"></span>{{ $activity['title'] }} - {{ $activity['time'] }}</li>
                @endforeach
            </ul>
        </article>
    </section>
@endsection
