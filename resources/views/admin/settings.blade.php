@extends('layouts.admin')

@section('title', 'Admin Settings')

@section('content')
    <header class="topbar">
        <div class="topbar-copy">
            <h1>Settings</h1>
            <p>Review operational preferences, alert rules, and reporting defaults.</p>
        </div>
    </header>

    <section class="dashboard-grid">
        <article class="panel">
            <div class="panel-header">
                <div>
                    <h3>Operations Preferences</h3>
                    <p>Static configuration overview for the admin workspace.</p>
                </div>
            </div>
            <div class="summary-row">
                <div class="summary-card"><strong>Auto Alerts</strong><span>Enabled for order delays above 12 minutes</span></div>
                <div class="summary-card"><strong>Report Window</strong><span>Daily summary sent at 11:45 PM</span></div>
                <div class="summary-card"><strong>Escalation Path</strong><span>Restaurant manager then regional admin</span></div>
                <div class="summary-card"><strong>Shift Sync</strong><span>Every 30 minutes</span></div>
            </div>
        </article>

        <article class="panel">
            <div class="panel-header">
                <div>
                    <h3>Admin Notes</h3>
                    <p>Shared reminders for the operations team.</p>
                </div>
            </div>
            <ul class="status-legend">
                <li><span class="legend-dot orange"></span>Keep peak-hour monitoring active during weekends.</li>
                <li><span class="legend-dot amber"></span>Review branch outages before publishing weekly report.</li>
                <li><span class="legend-dot yellow"></span>Align kitchen staffing notes with restaurant managers.</li>
            </ul>
        </article>
    </section>
@endsection
