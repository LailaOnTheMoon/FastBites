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
        <article class="stat-card"><div class="stat-copy"><h2>{{ $platformUptime }}%</h2><p>Platform Uptime</p></div></article>
        <article class="stat-card"><div class="stat-copy"><h2>${{ number_format($weeklyRevenue, 2) }}</h2><p>Weekly Revenue</p></div></article>
        <article class="stat-card"><div class="stat-copy"><h2>{{ $avgDeliveryMinutes }} min</h2><p>Avg Delivery Time</p></div></article>
        <article class="stat-card"><div class="stat-copy"><h2>{{ $refundRate }}%</h2><p>Refund Rate</p></div></article>
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
                <li><span class="legend-dot orange"></span>Revenue and order performance are calculated from live orders.</li>
                <li><span class="legend-dot amber"></span>Refund rate is based on orders marked as refunded.</li>
                <li><span class="legend-dot yellow"></span>Delivery time is measured from placed to delivered orders.</li>
            </ul>
        </article>

        <article class="panel">
            <div class="panel-header">
                <div>
                    <h3>Prepared Exports</h3>
                    <p>Dynamic reporting summaries for executive review.</p>
                </div>
            </div>

            <div class="summary-row">
                <div class="summary-card"><strong>Operations Pack</strong><span>Generated from live data</span></div>
                <div class="summary-card"><strong>Finance Pack</strong><span>Revenue and refunds</span></div>
                <div class="summary-card"><strong>User Trends</strong><span>Customers and support coverage</span></div>
                <div class="summary-card"><strong>Branch Health</strong><span>Restaurant activity status</span></div>
            </div>
        </article>

        <article class="panel">
            <div class="panel-header">
                <div>
                    <h3>KPI Coverage</h3>
                    <p>Dynamic completion levels for executive KPIs.</p>
                </div>
            </div>

            <div class="revenue-list">
                <div class="revenue-item">
                    <div class="revenue-meta">
                        <span>Revenue reporting</span>
                        <strong>100%</strong>
                    </div>
                    <div class="progress-track">
                        <span class="progress-fill" style="width: 100%;"></span>
                    </div>
                </div>

                <div class="revenue-item">
                    <div class="revenue-meta">
                        <span>Support reporting</span>
                        <strong>{{ $supportReporting }}%</strong>
                    </div>
                    <div class="progress-track">
                        <span class="progress-fill" style="width: {{ $supportReporting }}%;"></span>
                    </div>
                </div>

                <div class="revenue-item">
                    <div class="revenue-meta">
                        <span>Compliance reporting</span>
                        <strong>{{ $complianceReporting }}%</strong>
                    </div>
                    <div class="progress-track">
                        <span class="progress-fill" style="width: {{ $complianceReporting }}%;"></span>
                    </div>
                </div>
            </div>
        </article>
    </section>
@endsection