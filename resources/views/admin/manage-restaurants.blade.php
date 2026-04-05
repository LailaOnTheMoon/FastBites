@extends('layouts.admin')

@section('title', 'Manage Restaurants')

@section('content')
    @php
        $restaurants = [
            ['branch' => 'Downtown Branch', 'city' => 'Amman', 'manager' => 'Layla Sami', 'status' => 'Active', 'schedule' => '06:00 AM - 11:00 PM'],
            ['branch' => 'Airport Hub', 'city' => 'Zarqa', 'manager' => 'Rami Adel', 'status' => 'Active', 'schedule' => '24 Hours'],
            ['branch' => 'City Mall', 'city' => 'Irbid', 'manager' => 'Nada Hasan', 'status' => 'Maintenance', 'schedule' => '10:00 AM - 12:00 AM'],
            ['branch' => 'North Station', 'city' => 'Salt', 'manager' => 'Fadi Omar', 'status' => 'Active', 'schedule' => '08:00 AM - 10:00 PM'],
        ];
    @endphp

    <header class="topbar">
        <div class="topbar-copy">
            <h1>Manage Restaurants</h1>
            <p>Review assigned branches, operating schedules, and current branch status.</p>
        </div>
        <div class="topbar-actions">
            <a href="{{ route('admin.dashboard') }}" class="quick-action-button">Back to Dashboard</a>
        </div>
    </header>

    <section class="stats-grid">
        <article class="stat-card"><div class="stat-copy"><h2>28</h2><p>Total Branches</p></div></article>
        <article class="stat-card"><div class="stat-copy"><h2>24</h2><p>Active Today</p></div></article>
        <article class="stat-card"><div class="stat-copy"><h2>3</h2><p>Need Attention</p></div></article>
        <article class="stat-card"><div class="stat-copy"><h2>11</h2><p>City Coverage</p></div></article>
    </section>

    <section class="panel orders-panel">
        <div class="panel-header panel-header-stack">
            <div>
                <h3>Branch Directory</h3>
                <p>Static overview of restaurant records prepared for the admin area.</p>
            </div>
        </div>
        <div class="table-wrap">
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>Branch</th>
                        <th>City</th>
                        <th>Manager</th>
                        <th>Status</th>
                        <th>Schedule</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($restaurants as $restaurant)
                        <tr>
                            <td>{{ $restaurant['branch'] }}</td>
                            <td>{{ $restaurant['city'] }}</td>
                            <td>{{ $restaurant['manager'] }}</td>
                            <td><span class="status-pill {{ $restaurant['status'] === 'Maintenance' ? 'canceled' : 'delivered' }}">{{ $restaurant['status'] }}</span></td>
                            <td>{{ $restaurant['schedule'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
