@extends('layouts.kitchen')

@section('title', 'Kitchen Dashboard')

@section('content')
    <header class="topbar">
        <div class="topbar-copy">
            <h1>Kitchen Dashboard</h1>
            <p>Monitor the kitchen queue and keep every order moving through the line.</p>
        </div>
    </header>

    <section class="stats-grid">
        <article class="stat-card">
            <div class="stat-copy">
                <h2>{{ $newOrdersCount }}</h2>
                <p>New Orders</p>
            </div>
        </article>

        <article class="stat-card">
            <div class="stat-copy">
                <h2>{{ $preparingCount }}</h2>
                <p>Preparing</p>
            </div>
        </article>

        <article class="stat-card">
            <div class="stat-copy">
                <h2>{{ $readyCount }}</h2>
                <p>Ready</p>
            </div>
        </article>

        <article class="stat-card">
            <div class="stat-copy">
                <h2>{{ $completedTodayCount }}</h2>
                <p>Completed Today</p>
            </div>
        </article>
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
                <div class="summary-card">
                    <strong>{{ $priorityOrders }} orders</strong>
                    <span>Need prep start in the next 10 minutes</span>
                </div>

                <div class="summary-card">
                    <strong>{{ $restaurantsRunning }} stations</strong>
                    <span>Running at full capacity</span>
                </div>

                <div class="summary-card">
                    <strong>{{ $specialInstructionAlerts }} alerts</strong>
                    <span>Special instructions waiting confirmation</span>
                </div>

                <div class="summary-card">
                    <strong>{{ $averagePrepDuration }} min</strong>
                    <span>Average prep duration</span>
                </div>
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
                <li><span class="legend-dot orange"></span>{{ $priorityOrders }} orders need immediate attention.</li>
                <li><span class="legend-dot amber"></span>{{ $specialInstructionAlerts }} orders have special instructions.</li>
                <li><span class="legend-dot yellow"></span>{{ $readyCount }} orders are waiting for pickup or delivery handoff.</li>
            </ul>
        </article>
    </section>
@endsection