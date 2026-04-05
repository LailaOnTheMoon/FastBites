@extends('layouts.super-admin')

@section('title', 'Super Admin Restaurants')

@section('content')
    @php
        $restaurants = [
            ['name' => 'Downtown Branch', 'region' => 'Capital', 'manager' => 'Layla Sami', 'status' => 'Active', 'health' => 'Stable'],
            ['name' => 'Airport Hub', 'region' => 'East', 'manager' => 'Rami Adel', 'status' => 'Active', 'health' => 'Busy'],
            ['name' => 'Sea View', 'region' => 'West', 'manager' => 'Hana Qasem', 'status' => 'Launch Prep', 'health' => 'Setup'],
            ['name' => 'Old Market', 'region' => 'North', 'manager' => 'Yara Tareq', 'status' => 'Paused', 'health' => 'Review'],
        ];
    @endphp

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
                <p>Static list prepared for the platform management area.</p>
            </div>
        </div>
        <div class="table-wrap">
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>Restaurant</th>
                        <th>Region</th>
                        <th>Manager</th>
                        <th>Status</th>
                        <th>Health</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($restaurants as $restaurant)
                        <tr>
                            <td>{{ $restaurant['name'] }}</td>
                            <td>{{ $restaurant['region'] }}</td>
                            <td>{{ $restaurant['manager'] }}</td>
                            <td><span class="status-pill {{ $restaurant['status'] === 'Active' ? 'delivered' : 'pending' }}">{{ $restaurant['status'] }}</span></td>
                            <td>{{ $restaurant['health'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
