@extends('layouts.kitchen')

@section('title', 'FastBites Kitchen Dashboard')

@section('content')
    @php
        $stats = [
            ['value' => '18', 'label' => 'New Orders'],
            ['value' => '11', 'label' => 'Preparing'],
            ['value' => '9', 'label' => 'Ready'],
            ['value' => '42', 'label' => 'Completed Today'],
        ];
    @endphp

    <header class="topbar">
        <div class="topbar-copy">
            <h1>Kitchen Dashboard</h1>
            <p>Monitor the kitchen queue and keep every order moving through the line.</p>
        </div>
    </header>

    <section class="stats-grid">
        @foreach ($stats as $stat)
            <article class="stat-card">
                <div class="stat-copy">
                    <h2>{{ $stat['value'] }}</h2>
                    <p>{{ $stat['label'] }}</p>
                </div>
            </article>
        @endforeach
    </section>

    <section class="dashboard-grid">
        <article class="panel">
            <div class="panel-header">
                <div>
                    <h3>Shift Priorities</h3>
                    <p>Quick view of what the kitchen team should focus on now.</p>
                </div>
            </div>
            <div class="summary-row">
                <div class="summary-card"><strong>5 orders</strong><span>Need prep start in the next 10 minutes</span></div>
                <div class="summary-card"><strong>3 stations</strong><span>Running at full capacity</span></div>
                <div class="summary-card"><strong>2 alerts</strong><span>Special instructions waiting confirmation</span></div>
                <div class="summary-card"><strong>14 min</strong><span>Average prep duration</span></div>
            </div>
        </article>

        <article class="panel">
            <div class="panel-header">
                <div>
                    <h3>Queue Navigation</h3>
                    <p>Open the order stage pages from here.</p>
                </div>
            </div>
            <ul class="status-legend">
                <li><span class="legend-dot orange"></span><a href="{{ route('kitchen.new-orders') }}">New Orders</a></li>
                <li><span class="legend-dot amber"></span><a href="{{ route('kitchen.preparing-orders') }}">Preparing Orders</a></li>
                <li><span class="legend-dot yellow"></span><a href="{{ route('kitchen.ready-orders') }}">Ready Orders</a></li>
                <li><span class="legend-dot cream"></span><a href="{{ route('kitchen.completed-orders') }}">Completed Orders</a></li>
            </ul>
        </article>

        <article class="panel">
            <div class="panel-header">
                <div>
                    <h3>Kitchen Notes</h3>
                    <p>Shift reminders for the current team.</p>
                </div>
            </div>
            <ul class="status-legend">
                <li><span class="legend-dot orange"></span>Prioritize delivery batches due within 15 minutes.</li>
                <li><span class="legend-dot amber"></span>Flag missing items before moving an order to ready.</li>
                <li><span class="legend-dot yellow"></span>Keep completed queue updated for handoff accuracy.</li>
            </ul>
        </article>
    </section>
@endsection
