@extends('layouts.super-admin')

@section('title', 'Manage Admins')

@section('content')
    @php
        $admins = [
            ['name' => 'Yousef Adel', 'role' => 'Regional Admin', 'region' => 'North', 'status' => 'Active'],
            ['name' => 'Sara Jamal', 'role' => 'Operations Admin', 'region' => 'Capital', 'status' => 'Active'],
            ['name' => 'Hadi Nimer', 'role' => 'Support Admin', 'region' => 'South', 'status' => 'Review'],
            ['name' => 'Dina Fares', 'role' => 'Regional Admin', 'region' => 'West', 'status' => 'Active'],
        ];
    @endphp

    <header class="topbar">
        <div class="topbar-copy">
            <h1>Manage Admins</h1>
            <p>Static admin directory for assignments, roles, and approval tracking.</p>
        </div>
    </header>

    <section class="stats-grid">
        <article class="stat-card"><div class="stat-copy"><h2>58</h2><p>Total Admins</p></div></article>
        <article class="stat-card"><div class="stat-copy"><h2>42</h2><p>Active Admins</p></div></article>
        <article class="stat-card"><div class="stat-copy"><h2>6</h2><p>Under Review</p></div></article>
        <article class="stat-card"><div class="stat-copy"><h2>10</h2><p>Regional Leads</p></div></article>
    </section>

    <section class="panel orders-panel">
        <div class="panel-header panel-header-stack">
            <div>
                <h3>Admin Roles Table</h3>
                <p>Prepared layout for future admin management flows.</p>
            </div>
        </div>
        <div class="table-wrap">
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Region</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($admins as $admin)
                        <tr>
                            <td>{{ $admin['name'] }}</td>
                            <td>{{ $admin['role'] }}</td>
                            <td>{{ $admin['region'] }}</td>
                            <td><span class="status-pill {{ $admin['status'] === 'Active' ? 'delivered' : 'pending' }}">{{ $admin['status'] }}</span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
