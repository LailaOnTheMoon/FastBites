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
                    <p>Dynamic segmentation blocks for the super admin view.</p>
                </div>
            </div>

            <div class="summary-row">
                <div class="summary-card"><strong>{{ $customersCount }}</strong><span>Customers</span></div>
                <div class="summary-card"><strong>{{ $restaurantAccounts }}</strong><span>Restaurant accounts</span></div>
                <div class="summary-card"><strong>{{ $adminAccounts }}</strong><span>Admin accounts</span></div>
                <div class="summary-card"><strong>{{ $supportAgents }}</strong><span>Support agents</span></div>
            </div>
        </article>

        <article class="panel">
            <div class="panel-header">
                <div>
                    <h3>Moderation Queue</h3>
                    <p>Dynamic list of account review categories.</p>
                </div>
            </div>

            <ul class="status-legend">
                <li><span class="legend-dot orange"></span>{{ $missingPhoneCustomers }} customer accounts missing phone number.</li>
                <li><span class="legend-dot amber"></span>{{ $duplicateEmails }} duplicate customer email groups found.</li>
                <li><span class="legend-dot yellow"></span>{{ $supportAgents }} support-related employee accounts active.</li>
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