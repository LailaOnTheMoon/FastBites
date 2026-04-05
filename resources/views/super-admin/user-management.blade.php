@extends('layouts.super-admin')

@section('title', 'Super Admin User Management')

@section('content')
    <header class="topbar">
        <div class="topbar-copy">
            <h1>User Management Overview</h1>
            <p>Platform-level summary of users, moderation needs, and service access patterns.</p>
        </div>
    </header>

    <section class="dashboard-grid">
        <article class="panel">
            <div class="panel-header">
                <div>
                    <h3>User Segments</h3>
                    <p>Static segmentation blocks for the super admin view.</p>
                </div>
            </div>
            <div class="summary-row">
                <div class="summary-card"><strong>18,420</strong><span>Customers</span></div>
                <div class="summary-card"><strong>126</strong><span>Restaurant accounts</span></div>
                <div class="summary-card"><strong>58</strong><span>Admin accounts</span></div>
                <div class="summary-card"><strong>34</strong><span>Support agents</span></div>
            </div>
        </article>

        <article class="panel">
            <div class="panel-header">
                <div>
                    <h3>Moderation Queue</h3>
                    <p>Static list of account review categories.</p>
                </div>
            </div>
            <ul class="status-legend">
                <li><span class="legend-dot orange"></span>12 profile verification issues waiting review.</li>
                <li><span class="legend-dot amber"></span>07 duplicate-account checks in progress.</li>
                <li><span class="legend-dot yellow"></span>04 privilege escalation requests pending.</li>
            </ul>
        </article>

        <article class="panel">
            <div class="panel-header">
                <div>
                    <h3>Access Policies</h3>
                    <p>Prepared summary cards for future controls.</p>
                </div>
            </div>
            <div class="summary-row">
                <div class="summary-card"><strong>2FA</strong><span>Required for admin roles</span></div>
                <div class="summary-card"><strong>Session Rules</strong><span>24-hour timeout</span></div>
            </div>
        </article>
    </section>
@endsection
