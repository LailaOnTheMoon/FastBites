@extends('layouts.user-management')

@section('title', 'User Profiles')

@section('content')
    <header class="topbar">
        <div class="topbar-copy">
            <h1>User Profiles</h1>
            <p>Profile completeness, verification, and account quality overview.</p>
        </div>
    </header>

    <section class="dashboard-grid">
        <article class="panel">
            <div class="panel-header">
                <div>
                    <h3>Profile Quality</h3>
                    <p>Prepared profile metrics for the user management team.</p>
                </div>
            </div>
            <div class="revenue-list">
                <div class="revenue-item"><div class="revenue-meta"><span>Completed profiles</span><strong>91%</strong></div><div class="progress-track"><span class="progress-fill" style="width: 91%;"></span></div></div>
                <div class="revenue-item"><div class="revenue-meta"><span>Verified contacts</span><strong>88%</strong></div><div class="progress-track"><span class="progress-fill" style="width: 88%;"></span></div></div>
                <div class="revenue-item"><div class="revenue-meta"><span>Profiles needing updates</span><strong>19%</strong></div><div class="progress-track"><span class="progress-fill" style="width: 19%;"></span></div></div>
            </div>
        </article>

        <article class="panel">
            <div class="panel-header">
                <div>
                    <h3>Verification Notes</h3>
                    <p>Static notes for profile review.</p>
                </div>
            </div>
            <ul class="status-legend">
                <li><span class="legend-dot orange"></span>12 restaurant contacts are missing profile photos.</li>
                <li><span class="legend-dot amber"></span>7 support accounts need phone verification.</li>
                <li><span class="legend-dot yellow"></span>4 admin profiles require role review.</li>
            </ul>
        </article>
    </section>
@endsection
