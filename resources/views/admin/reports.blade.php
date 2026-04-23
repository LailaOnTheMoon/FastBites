@extends('layouts.admin')

@section('title', 'Admin Reports')

@section('content')
    <header class="topbar">
        <div class="topbar-copy">
            <h1>Reports</h1>
            <p>Review service quality, revenue trends, and branch performance summaries.</p>
        </div>
    </header>

    <section class="stats-grid">
        <article class="stat-card">
            <div class="stat-copy">
                <h2>${{ number_format($weeklyRevenue, 2) }}</h2>
                <p>Weekly Revenue</p>
            </div>
        </article>

        <article class="stat-card">
            <div class="stat-copy">
                <h2>{{ $serviceSla }}%</h2>
                <p>Service SLA</p>
            </div>
        </article>

        <article class="stat-card">
            <div class="stat-copy">
                <h2>{{ $avgRating }}/5</h2>
                <p>Avg Rating</p>
            </div>
        </article>

        <article class="stat-card">
            <div class="stat-copy">
                <h2>{{ $escalations }}</h2>
                <p>Escalations</p>
            </div>
        </article>
    </section>

    <section class="dashboard-grid">
        <article class="panel">
            <div class="panel-header">
                <div>
                    <h3>Performance Summary</h3>
                    <p>Branch targets and operational KPIs.</p>
                </div>
            </div>

            <div class="revenue-list">
                <div class="revenue-item">
                    <div class="revenue-meta">
                        <span>Revenue target completion</span>
                        <strong>{{ $revenueTargetCompletion }}%</strong>
                    </div>
                    <div class="progress-track">
                        <span class="progress-fill" style="width: {{ $revenueTargetCompletion }}%;"></span>
                    </div>
                </div>

                <div class="revenue-item">
                    <div class="revenue-meta">
                        <span>Order fulfillment rate</span>
                        <strong>{{ $orderFulfillmentRate }}%</strong>
                    </div>
                    <div class="progress-track">
                        <span class="progress-fill" style="width: {{ $orderFulfillmentRate }}%;"></span>
                    </div>
                </div>

                <div class="revenue-item">
                    <div class="revenue-meta">
                        <span>Shift readiness</span>
                        <strong>{{ $shiftReadiness }}%</strong>
                    </div>
                    <div class="progress-track">
                        <span class="progress-fill" style="width: {{ $shiftReadiness }}%;"></span>
                    </div>
                </div>
            </div>
        </article>

        <article class="panel">
            <div class="panel-header">
                <div>
                    <h3>Reporting Highlights</h3>
                    <p>Key observations ready for follow-up.</p>
                </div>
            </div>

            <ul class="status-legend">
                <li>
                    <span class="legend-dot orange"></span>
                    {{ $topRestaurant?->name ?? 'No restaurant data' }} recorded the highest total sales.
                </li>
                <li>
                    <span class="legend-dot amber"></span>
                    {{ $highestDelayRestaurant?->name ?? 'No delayed branch' }} has the most pending orders.
                </li>
                <li>
                    <span class="legend-dot yellow"></span>
                    {{ $topReviewedRestaurant?->name ?? 'No active branch' }} remains one of the active branches.
                </li>
                <li>
                    <span class="legend-dot cream"></span>
                    {{ $inactiveRestaurant?->name ?? 'No inactive branch' }} may need admin review.
                </li>
            </ul>
        </article>

        <article class="panel">
            <div class="panel-header">
                <div>
                    <h3>Download Queue</h3>
                    <p>Prepared static exports for admins.</p>
                </div>
            </div>

            <div class="summary-row">
                <div class="summary-card">
                    <strong>Daily Summary</strong>
                    <span>Ready for export</span>
                </div>
                <div class="summary-card">
                    <strong>Branch Audit</strong>
                    <span>Generated from live data</span>
                </div>
            </div>
        </article>
    </section>
@endsection