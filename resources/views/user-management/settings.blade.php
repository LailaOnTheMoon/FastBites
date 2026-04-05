@extends('layouts.user-management')

@section('title', 'User Management Settings')

@section('content')
    <header class="topbar">
        <div class="topbar-copy">
            <h1>Settings</h1>
            <p>Review moderation preferences, profile defaults, and reporting rules.</p>
        </div>
    </header>

    <section class="dashboard-grid">
        <article class="panel">
            <div class="panel-header">
                <div>
                    <h3>Moderation Defaults</h3>
                    <p>Static settings summary for the user management team.</p>
                </div>
            </div>
            <div class="summary-row">
                <div class="summary-card"><strong>Profile Review SLA</strong><span>Within 24 hours</span></div>
                <div class="summary-card"><strong>Escalation Rule</strong><span>High priority reports first</span></div>
                <div class="summary-card"><strong>Email Alerts</strong><span>Enabled for account changes</span></div>
                <div class="summary-card"><strong>Access Audits</strong><span>Weekly on Sunday</span></div>
            </div>
        </article>

        <article class="panel">
            <div class="panel-header">
                <div>
                    <h3>Workflow Notes</h3>
                    <p>Shared reminders for the current review cycle.</p>
                </div>
            </div>
            <ul class="status-legend">
                <li><span class="legend-dot orange"></span>Confirm profile changes before closing reports.</li>
                <li><span class="legend-dot amber"></span>Keep access review notes aligned with admin policies.</li>
                <li><span class="legend-dot yellow"></span>Prepare weekly report exports before Friday noon.</li>
            </ul>
        </article>
    </section>
@endsection
