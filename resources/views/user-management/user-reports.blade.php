@extends('layouts.user-management')

@section('title', 'User Reports')

@section('content')
    <header class="topbar">
        <div class="topbar-copy">
            <h1>User Reports</h1>
            <p>Track user-related issues based on current account data.</p>
        </div>
    </header>

    <section class="panel orders-panel">
        <div class="panel-header panel-header-stack">
            <div>
                <h3>Reports Table</h3>
                <p>Dynamic reporting summary derived from user records.</p>
            </div>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Report Type</th>
                        <th>Count</th>
                        <th>Priority</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Users Missing Phone</td>
                        <td>{{ $usersMissingPhone }}</td>
                        <td>Medium</td>
                        <td><span class="status-pill pending">Open</span></td>
                    </tr>
                    <tr>
                        <td>Users Missing Address</td>
                        <td>{{ $usersMissingAddress }}</td>
                        <td>Medium</td>
                        <td><span class="status-pill pending">Open</span></td>
                    </tr>
                    <tr>
                        <td>Unverified Accounts</td>
                        <td>{{ $usersUnverified }}</td>
                        <td>High</td>
                        <td><span class="status-pill canceled">In Review</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
@endsection