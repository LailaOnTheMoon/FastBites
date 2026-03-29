@extends('layouts.admin')

@section('title', 'FastBites Customer Dashboard')

@section('content')
    <header class="topbar">
        <div class="topbar-copy">
            <div class="heading-row">
                <div>
                    <h1>Welcome, {{ Auth::user()->full_name }}</h1>
                    <p>Your customer dashboard is ready.</p>
                </div>
            </div>
        </div>
    </header>

    <section class="stats-grid">
        <article class="stat-card enhanced-stat-card">
            <div class="stat-copy">
                <h2>{{ Auth::user()->full_name }}</h2>
                <p>Account type: {{ ucwords(str_replace(['_','-'], ' ', Auth::user()->account_type)) }}</p>
                <span class="stat-trend up">Logged in as a customer</span>
            </div>
        </article>
    </section>
@endsection
