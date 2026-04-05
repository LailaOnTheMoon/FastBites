@extends('layouts.super-admin')

@section('title', 'FastBites Super Admin Dashboard')

@section('content')
    @php
        $stats = [
            ['value' => '$145K', 'label' => 'Platform Revenue', 'accent' => 'green', 'trend' => '+9.4% this week', 'trend_class' => 'up'],
            ['value' => '312', 'label' => 'Live Orders', 'accent' => 'orange', 'trend' => '+24 in the last hour', 'trend_class' => 'up'],
            ['value' => '58', 'label' => 'Total Admins', 'accent' => 'pink', 'trend' => '3 pending approvals', 'trend_class' => 'down'],
            ['value' => '126', 'label' => 'Restaurants', 'accent' => 'blue', 'trend' => '+6 new locations', 'trend_class' => 'up'],
        ];
    @endphp

    <header class="topbar">
        <div class="topbar-copy">
            <div class="heading-row">
                <div>
                    <h1>Super Admin Dashboard</h1>
                    <p>Centralized view of platform health, admin coverage, and core operations.</p>
                </div>
                <a href="{{ route('super-admin.system-reports') }}" class="quick-action-button">View Reports</a>
            </div>
        </div>
        <div class="topbar-actions">
            <div class="profile-chip" aria-label="Profile">
                <div class="profile-avatar">
                    {{ strtoupper(substr(auth()->user()->first_name ?? 'S', 0, 1)) }}{{ strtoupper(substr(auth()->user()->last_name ?? 'A', 0, 1)) }}
                </div>
            </div>
        </div>
    </header>

    <section class="stats-grid">
        @foreach ($stats as $stat)
            <article class="stat-card enhanced-stat-card">
                <div class="stat-icon {{ $stat['accent'] }}">
                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 5.5A1.5 1.5 0 0 1 5.5 4h13A1.5 1.5 0 0 1 20 5.5v13a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 4 18.5zm2 0V11h5V6zm7 0v5h5V5.5zM6 13v5.5h5V13zm7 0v5.5h5V13z" /></svg>
                </div>
                <div class="stat-copy">
                    <h2>{{ $stat['value'] }}</h2>
                    <p>{{ $stat['label'] }}</p>
                    <span class="stat-trend {{ $stat['trend_class'] }}">{{ $stat['trend'] }}</span>
                </div>
            </article>
        @endforeach
    </section>

    <section class="dashboard-grid">
        <article class="panel">
            <div class="panel-header">
                <div>
                    <h3>Control Center</h3>
                    <p>Core platform areas requiring leadership attention.</p>
                </div>
            </div>
            <div class="summary-row">
                <div class="summary-card"><strong>12</strong><span>Regions actively monitored</span></div>
                <div class="summary-card"><strong>04</strong><span>Priority escalations</span></div>
                <div class="summary-card"><strong>19</strong><span>Pending admin reviews</span></div>
                <div class="summary-card"><strong>98.7%</strong><span>Service uptime</span></div>
            </div>
        </article>

        <article class="panel">
            <div class="panel-header">
                <div>
                    <h3>Platform Readiness</h3>
                    <p>Static KPIs for the super admin area.</p>
                </div>
            </div>
            <div class="revenue-list">
                <div class="revenue-item">
                    <div class="revenue-meta"><span>Operations readiness</span><strong>88%</strong></div>
                    <div class="progress-track"><span class="progress-fill" style="width: 88%;"></span></div>
                </div>
                <div class="revenue-item">
                    <div class="revenue-meta"><span>Admin staffing coverage</span><strong>73%</strong></div>
                    <div class="progress-track"><span class="progress-fill" style="width: 73%;"></span></div>
                </div>
                <div class="revenue-item">
                    <div class="revenue-meta"><span>Restaurant compliance</span><strong>91%</strong></div>
                    <div class="progress-track"><span class="progress-fill" style="width: 91%;"></span></div>
                </div>
            </div>
        </article>

        <article class="panel">
            <div class="panel-header">
                <div>
                    <h3>Leadership Notes</h3>
                    <p>Prepared items for follow-up.</p>
                </div>
            </div>
            <ul class="status-legend">
                <li><span class="legend-dot orange"></span>Approve two new regional admin assignments.</li>
                <li><span class="legend-dot amber"></span>Review restaurant activation queue for next week.</li>
                <li><span class="legend-dot yellow"></span>Finalize user management reporting template.</li>
            </ul>
        </article>
    </section>
@endsection
