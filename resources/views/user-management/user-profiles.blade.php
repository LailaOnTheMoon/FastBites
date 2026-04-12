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
                <div class="revenue-item">
                    <div class="revenue-meta">
                        <span>Completed profiles</span>
                        <strong>{{ $completedProfilesPercent }}%</strong>
                    </div>
                    <div class="progress-track">
                        <span class="progress-fill" style="width: {{ $completedProfilesPercent }}%;"></span>
                    </div>
                </div>

                <div class="revenue-item">
                    <div class="revenue-meta">
                        <span>Verified contacts</span>
                        <strong>{{ $verifiedContactsPercent }}%</strong>
                    </div>
                    <div class="progress-track">
                        <span class="progress-fill" style="width: {{ $verifiedContactsPercent }}%;"></span>
                    </div>
                </div>

                <div class="revenue-item">
                    <div class="revenue-meta">
                        <span>Profiles needing updates</span>
                        <strong>{{ $profilesNeedingUpdates }}</strong>
                    </div>
                    <div class="progress-track">
                        <span class="progress-fill" style="width: 30%;"></span>
                    </div>
                </div>
            </div>
        </article>

        <article class="panel">
            <div class="panel-header">
                <div>
                    <h3>Verification Notes</h3>
                    <p>Dynamic notes for profile review.</p>
                </div>
            </div>

            <ul class="status-legend">
                <li><span class="legend-dot orange"></span>{{ $profilesNeedingUpdates }} profiles need data updates.</li>
                <li><span class="legend-dot amber"></span>{{ $verifiedContactsPercent }}% of users have verified contacts.</li>
                <li><span class="legend-dot yellow"></span>{{ $completedProfilesPercent }}% of user profiles are complete.</li>
            </ul>
        </article>
    </section>
@endsection