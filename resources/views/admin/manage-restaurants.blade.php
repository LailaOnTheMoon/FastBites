@extends('layouts.admin')

@section('title', 'Manage Restaurants')

@section('content')
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
        <article class="stat-card">
            <div class="stat-copy">
                <h2>{{ $totalBranches }}</h2>
                <p>Total Branches</p>
            </div>
        </article>

        <article class="stat-card">
            <div class="stat-copy">
                <h2>{{ $activeToday }}</h2>
                <p>Active Today</p>
            </div>
        </article>

        <article class="stat-card">
            <div class="stat-copy">
                <h2>{{ $needAttention }}</h2>
                <p>Need Attention</p>
            </div>
        </article>

        <article class="stat-card">
            <div class="stat-copy">
                <h2>{{ $cityCoverage }}</h2>
                <p>City Coverage</p>
            </div>
        </article>
    </section>

    <section class="panel orders-panel">
        <div class="panel-header panel-header-stack">
            <div>
                <h3>Branch Directory</h3>
                <p>Dynamic overview of restaurant records from the database.</p>
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
                        <th>Address</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($restaurants as $restaurant)
                        <tr>
                            <td>{{ $restaurant->name }}</td>
                            <td>{{ $restaurant->city }}</td>
                            <td>
                                {{ trim(($restaurant->manager_first_name ?? '') . ' ' . ($restaurant->manager_last_name ?? '')) ?: 'N/A' }}
                            </td>
                            <td>
                                <span class="status-pill {{ $restaurant->is_active ? 'delivered' : 'canceled' }}">
                                    {{ $restaurant->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>{{ $restaurant->address_line_1 ?? 'N/A' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">No restaurants found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection