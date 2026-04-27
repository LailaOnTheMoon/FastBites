@extends('layouts.super-admin')

@section('title', 'Manage Admins')

@section('content')
    <header class="topbar">
        <div class="topbar-copy">
            <h1>Manage Admins</h1>
            <p>Admin directory for assignments, roles, and approval tracking.</p>
        </div>
    </header>

    <section class="stats-grid">
        <article class="stat-card"><div class="stat-copy"><h2>{{ $totalAdmins }}</h2><p>Total Admins</p></div></article>
        <article class="stat-card"><div class="stat-copy"><h2>{{ $activeAdmins }}</h2><p>Active Admins</p></div></article>
        <article class="stat-card"><div class="stat-copy"><h2>{{ $underReview }}</h2><p>Under Review</p></div></article>
        <article class="stat-card"><div class="stat-copy"><h2>{{ $regionalLeads }}</h2><p>Regional Leads</p></div></article>
    </section>

    <section class="panel orders-panel">
        <div class="panel-header panel-header-stack">
            <div>
                <h3>Admin Roles Table</h3>
                <p>Dynamic admin management directory.</p>
            </div>
        </div>

        <div class="table-wrap">
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Email</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($admins as $admin)
                        <tr>
                            <td>{{ $admin->first_name }} {{ $admin->last_name }}</td>
                            <td>{{ ucwords(str_replace('_', ' ', $admin->account_type)) }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>
                                <span class="status-pill delivered">Active</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">No admins found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection