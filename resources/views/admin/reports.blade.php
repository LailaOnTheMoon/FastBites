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
        <article class="stat-card"><div class="stat-copy"><h2>$58K</h2><p>Weekly Revenue</p></div></article>
        <article class="stat-card"><div class="stat-copy"><h2>93%</h2><p>Service SLA</p></div></article>
        <article class="stat-card"><div class="stat-copy"><h2>4.7/5</h2><p>Avg Rating</p></div></article>
        <article class="stat-card"><div class="stat-copy"><h2>11</h2><p>Escalations</p></div></article>
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
                    <div class="revenue-meta"><span>Revenue target completion</span><strong>82%</strong></div>
                    <div class="progress-track"><span class="progress-fill" style="width: 82%;"></span></div>
                </div>
                <div class="revenue-item">
                    <div class="revenue-meta"><span>Order fulfillment rate</span><strong>89%</strong></div>
                    <div class="progress-track"><span class="progress-fill" style="width: 89%;"></span></div>
                </div>
                <div class="revenue-item">
                    <div class="revenue-meta"><span>Shift readiness</span><strong>94%</strong></div>
                    <div class="progress-track"><span class="progress-fill" style="width: 94%;"></span></div>
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
                <li><span class="legend-dot orange"></span>Airport Hub exceeded dinner-hour sales target.</li>
                <li><span class="legend-dot amber"></span>City Mall showed the highest prep delay rate.</li>
                <li><span class="legend-dot yellow"></span>Downtown Branch retained the top review score.</li>
                <li><span class="legend-dot cream"></span>North Station needs staffing adjustment next week.</li>
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
                <div class="summary-card"><strong>Daily Summary</strong><span>Ready for export</span></div>
                <div class="summary-card"><strong>Branch Audit</strong><span>Generated at 11:20 AM</span></div>
            </div>
        </article>
    </section>
@endsection
