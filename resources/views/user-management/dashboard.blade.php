@extends('layouts.user-management')

@section('title', 'FastBites User Management Dashboard')

@section('content')
    @php
        $stats = [
            ['value' => '1,524', 'label' => 'Total Users'],
            ['value' => '248', 'label' => 'New Users'],
            ['value' => '87%', 'label' => 'Active Users'],
            ['value' => '34', 'label' => 'Reports Open'],
        ];
    @endphp

    <header class="topbar">
        <div class="topbar-copy">
            <h1>User Management Dashboard</h1>
            <p>Review user growth, profile quality, and account-related follow-ups.</p>
        </div>
        <div class="topbar-actions">
            <div class="profile-chip">
                <div class="profile-avatar">
                    {{ strtoupper(substr(auth()->user()->first_name ?? 'U', 0, 1)) }}{{ strtoupper(substr(auth()->user()->last_name ?? 'M', 0, 1)) }}
                </div>
            </div>
        </div>
    </header>

    <section class="stats-grid">
        @foreach ($stats as $stat)
            <article class="stat-card">
                <div class="stat-copy">
                    <h2>{{ $stat['value'] }}</h2>
                    <p>{{ $stat['label'] }}</p>
                </div>
            </article>
        @endforeach
    </section>

    <section class="dashboard-grid">
        <article class="panel">
            <div class="panel-header">
                <div>
                    <h3>Account Health</h3>
                    <p>Static summary for account operations.</p>
                </div>
            </div>
            <div class="summary-row">
                <div class="summary-card"><strong>96%</strong><span>Verified profiles</span></div>
                <div class="summary-card"><strong>21</strong><span>Escalated reports</span></div>
                <div class="summary-card"><strong>18</strong><span>Profiles under review</span></div>
                <div class="summary-card"><strong>12</strong><span>Role updates pending</span></div>
            </div>
        </article>

        <article class="panel">
            <div class="panel-header">
                <div>
                    <h3>Quick Access</h3>
                    <p>Jump to the user management sections.</p>
                </div>
            </div>
            <ul class="status-legend">
                <li><span class="legend-dot orange"></span><a href="{{ route('user-management.all-users') }}">All Users</a></li>
                <li><span class="legend-dot amber"></span><a href="{{ route('user-management.user-profiles') }}">User Profiles</a></li>
                <li><span class="legend-dot yellow"></span><a href="{{ route('user-management.user-reports') }}">User Reports</a></li>
                <li><span class="legend-dot cream"></span><a href="{{ route('user-management.settings') }}">Settings</a></li>
            </ul>
        </article>

        <article class="panel">
            <div class="panel-header">
                <div>
                    <h3>Team Notes</h3>
                    <p>Static reminders for the moderation and profile teams.</p>
                </div>
            </div>
            <ul class="status-legend">
                <li><span class="legend-dot orange"></span>Review flagged reports before end of shift.</li>
                <li><span class="legend-dot amber"></span>Keep profile verification backlog below 20.</li>
                <li><span class="legend-dot yellow"></span>Document repeated account issues for reports.</li>
            </ul>
        </article>
    </section>
@endsection
