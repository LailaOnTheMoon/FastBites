@extends('layouts.super-admin')

@section('title', 'Manage Restaurants')

@section('content')
    <header class="topbar">
        <div class="topbar-copy">
            <h1>Manage Restaurants</h1>
            <p>Super admin overview for branch expansion, activation, and operating status.</p>
        </div>
    </header>

    <section class="panel orders-panel">
        <div class="panel-header panel-header-stack">
            <div>
                <h3>Restaurant Registry</h3>
                <p>Dynamic list prepared for the platform management area.</p>
            </div>
        </div>

        <div class="table-wrap">
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>Restaurant</th>
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
                            <td>{{ trim(($restaurant->manager_first_name ?? '') . ' ' . ($restaurant->manager_last_name ?? '')) ?: 'N/A' }}</td>
                            <td>
                                <span class="status-pill {{ $restaurant->is_active ? 'delivered' : 'pending' }}">
                                    {{ $restaurant->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>{{ $restaurant->address_line_1 }}</td>
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