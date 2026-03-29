@extends('layouts.admin')

@section('title', 'FastBites Super Admin Dashboard')

@section('content')
    <header class="topbar">
        <div class="topbar-copy">
            <div class="heading-row">
                <div>
                    <h1>Welcome, {{ Auth::user()->full_name }}</h1>
                    <p>Use this page to manage the entire FastBites platform.</p>
                </div>
            </div>
        </div>
    </header>

    <section class="dashboard-grid">
        <article class="panel">
            <div class="panel-header">
                <div>
                    <h3>Super Admin Overview</h3>
                    <p>Here is your system overview.</p>
                </div>
            </div>
            <div class="p-6 text-gray-900">
                <p>{{ Auth::user()->full_name }}, you are logged in as {{ ucwords(str_replace(['_','-'], ' ', Auth::user()->account_type)) }}.</p>
                <p>Everything on this page is styled like the admin dashboard.</p>
            </div>
        </article>
    </section>
@endsection
