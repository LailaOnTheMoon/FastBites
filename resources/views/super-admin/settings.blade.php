@extends('layouts.super-admin')

@section('title', 'Super Admin Settings')

@section('content')
    <header class="topbar">
        <div class="topbar-copy">
            <h1>Settings</h1>
            <p>Platform-wide defaults, alert policies, and leadership preferences.</p>
        </div>
    </header>

    <section class="dashboard-grid">
        <article class="panel">
            <div class="panel-header">
                <div>
                    <h3>Platform Defaults</h3>
                    <p>Prepared static configuration cards.</p>
                </div>
            </div>
            <div class="summary-row">
                <div class="summary-card"><strong>Alert Threshold</strong><span>15 minutes delivery delay</span></div>
                <div class="summary-card"><strong>Weekly Reports</strong><span>Every Monday at 08:00 AM</span></div>
                <div class="summary-card"><strong>Audit Cycle</strong><span>Quarterly platform review</span></div>
                <div class="summary-card"><strong>Access Policy</strong><span>Strict for privileged roles</span></div>
            </div>
        </article>

        <article class="panel">
            <div class="panel-header">
                <div>
                    <h3>Security Notes</h3>
                    <p>Shared platform reminders.</p>
                </div>
            </div>
            <ul class="status-legend">
                <li><span class="legend-dot orange"></span>Review privileged access every 30 days.</li>
                <li><span class="legend-dot amber"></span>Keep incident export packages archived weekly.</li>
                <li><span class="legend-dot yellow"></span>Maintain consistency across regional alert rules.</li>
            </ul>
        </article>
    </section>
@endsection
