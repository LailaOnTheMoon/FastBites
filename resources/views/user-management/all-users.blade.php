@extends('layouts.user-management')

@section('title', 'All Users')

@section('content')
    @php
        $users = [
            ['name' => 'Mira Khaled', 'email' => 'mira@example.com', 'role' => 'Customer', 'status' => 'Active'],
            ['name' => 'Rami Adel', 'email' => 'rami@example.com', 'role' => 'Restaurant Admin', 'status' => 'Active'],
            ['name' => 'Sara Jamal', 'email' => 'sara@example.com', 'role' => 'Support', 'status' => 'Review'],
            ['name' => 'Yousef Adel', 'email' => 'yousef@example.com', 'role' => 'Admin', 'status' => 'Active'],
        ];
    @endphp

    <header class="topbar">
        <div class="topbar-copy">
            <h1>All Users</h1>
            <p>Static user directory styled to match the dashboard workspace.</p>
        </div>
    </header>

    <section class="panel orders-panel">
        <div class="panel-header panel-header-stack">
            <div>
                <h3>User Directory</h3>
                <p>Preview of user listing layout for later expansion.</p>
            </div>
        </div>
        <div class="table-wrap">
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user['name'] }}</td>
                            <td>{{ $user['email'] }}</td>
                            <td>{{ $user['role'] }}</td>
                            <td><span class="status-pill {{ $user['status'] === 'Active' ? 'delivered' : 'pending' }}">{{ $user['status'] }}</span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
