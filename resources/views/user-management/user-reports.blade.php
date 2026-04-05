@extends('layouts.user-management')

@section('title', 'User Reports')

@section('content')
    @php
        $reports = [
            ['type' => 'Profile Issue', 'user' => 'Mira Khaled', 'priority' => 'Medium', 'status' => 'Open'],
            ['type' => 'Access Review', 'user' => 'Yousef Adel', 'priority' => 'High', 'status' => 'In Review'],
            ['type' => 'Duplicate Account', 'user' => 'Sara Jamal', 'priority' => 'Medium', 'status' => 'Open'],
            ['type' => 'Verification Delay', 'user' => 'Rami Adel', 'priority' => 'Low', 'status' => 'Resolved'],
        ];
    @endphp

    <header class="topbar">
        <div class="topbar-copy">
            <h1>User Reports</h1>
            <p>Track reported issues, reviews, and user account escalations.</p>
        </div>
    </header>

    <section class="panel orders-panel">
        <div class="panel-header panel-header-stack">
            <div>
                <h3>Reports Table</h3>
                <p>Static reporting layout for user-related cases.</p>
            </div>
        </div>
        <div class="table-wrap">
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>Report Type</th>
                        <th>User</th>
                        <th>Priority</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reports as $report)
                        <tr>
                            <td>{{ $report['type'] }}</td>
                            <td>{{ $report['user'] }}</td>
                            <td>{{ $report['priority'] }}</td>
                            <td><span class="status-pill {{ $report['status'] === 'Resolved' ? 'delivered' : 'pending' }}">{{ $report['status'] }}</span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
