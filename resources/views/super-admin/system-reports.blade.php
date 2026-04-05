@extends('layouts.super-admin')

@section('title', 'System Reports')

@section('content')
    <header class="topbar">
        <div class="topbar-copy">
            <h1>System Reports</h1>
            <p>Executive reporting hub for platform stability, revenue, and operational trends.</p>
        </div>
    </header>

    <section class="stats-grid">
        <article class="stat-card"><div class="stat-copy"><h2>98.7%</h2><p>Platform Uptime</p></div></article>
        <article class="stat-card"><div class="stat-copy"><h2>$145K</h2><p>Weekly Revenue</p></div></article>
        <article class="stat-card"><div class="stat-copy"><h2>7.4 min</h2><p>Avg Delivery Time</p></div></article>
        <article class="stat-card"><div class="stat-copy"><h2>3.1%</h2><p>Refund Rate</p></div></article>
    </section>

    <section class="dashboard-grid">
        <article class="panel">
            <div class="panel-header">
                <div>
                    <h3>Executive Highlights</h3>
                    <p>Prepared bullets for the reporting area.</p>
                </div>
            </div>
            <ul class="status-legend">
                <li><span class="legend-dot orange"></span>Revenue remained above target for four consecutive weeks.</li>
                <li><span class="legend-dot amber"></span>Refund spikes were isolated to two branches.</li>
                <li><span class="legend-dot yellow"></span>User retention improved after delivery ETA updates.</li>
            </ul>
        </article>

        <article class="panel">
            <div class="panel-header">
                <div>
                    <h3>Prepared Exports</h3>
                    <p>Static list of report packages.</p>
                </div>
            </div>
            <div class="summary-row">
                <div class="summary-card"><strong>Operations Pack</strong><span>Generated 09:00 AM</span></div>
                <div class="summary-card"><strong>Finance Pack</strong><span>Generated 09:15 AM</span></div>
                <div class="summary-card"><strong>User Trends</strong><span>Generated 09:30 AM</span></div>
                <div class="summary-card"><strong>Branch Health</strong><span>Generated 09:45 AM</span></div>
            </div>
        </article>

        <article class="panel">
            <div class="panel-header">
                <div>
                    <h3>KPI Coverage</h3>
                    <p>Static completion levels for executive KPIs.</p>
                </div>
            </div>
            <div class="revenue-list">
                <div class="revenue-item"><div class="revenue-meta"><span>Revenue reporting</span><strong>100%</strong></div><div class="progress-track"><span class="progress-fill" style="width: 100%;"></span></div></div>
                <div class="revenue-item"><div class="revenue-meta"><span>Support reporting</span><strong>86%</strong></div><div class="progress-track"><span class="progress-fill" style="width: 86%;"></span></div></div>
                <div class="revenue-item"><div class="revenue-meta"><span>Compliance reporting</span><strong>79%</strong></div><div class="progress-track"><span class="progress-fill" style="width: 79%;"></span></div></div>
            </div>
        </article>
    </section>
@endsection
