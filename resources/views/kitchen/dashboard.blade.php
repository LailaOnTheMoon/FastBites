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

    {{-- ================== AI Kitchen Coordination ================== --}}
    <section class="ai-kitchen-panel">
        <div class="panel-header">
            <div>
                <h3>AI Kitchen Coordination</h3>
                <p>Smart recommendation for the current kitchen workload.</p>
            </div>

            <span class="ai-priority-badge {{ strtolower($kitchenAiCoordination['priority_level'] ?? 'low') }}">
                {{ $kitchenAiCoordination['priority_level'] ?? 'Low' }} Priority
            </span>
        </div>

        <div class="ai-kitchen-action">
            <span>Recommended Kitchen Action</span>
            <strong>
                {{ $kitchenAiCoordination['recommended_action'] ?? 'Kitchen is stable. Continue monitoring incoming orders.' }}
            </strong>
            <p>
                {{ $kitchenAiCoordination['reason'] ?? 'There are no urgent kitchen coordination issues right now.' }}
            </p>
        </div>

        <div class="ai-kitchen-grid">
            <article>
                <span>Pending Orders</span>
                <strong>{{ $kitchenAiCoordination['pending_orders'] ?? 0 }}</strong>
            </article>

            <article>
                <span>Preparing Orders</span>
                <strong>{{ $kitchenAiCoordination['preparing_orders'] ?? 0 }}</strong>
            </article>

            <article>
                <span>Ready Orders</span>
                <strong>{{ $kitchenAiCoordination['ready_orders'] ?? 0 }}</strong>
            </article>

            <article>
                <span>Avg Prep Time</span>
                <strong>{{ $kitchenAiCoordination['average_preparation_time'] ?? 20 }} min</strong>
            </article>
        </div>
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

    <style>
        .ai-kitchen-panel {
            margin-top: 24px;
            background: #ffffff;
            border-radius: 24px;
            padding: 24px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 18px 45px rgba(15, 23, 42, 0.06);
        }

        .ai-priority-badge {
            display: inline-flex;
            align-items: center;
            border-radius: 999px;
            padding: 8px 14px;
            font-size: 12px;
            font-weight: 700;
            border: 1px solid #e5e7eb;
        }

        .ai-priority-badge.low {
            background: #ecfdf5;
            color: #166534;
            border-color: #bbf7d0;
        }

        .ai-priority-badge.medium {
            background: #fffbeb;
            color: #92400e;
            border-color: #fde68a;
        }

        .ai-priority-badge.high {
            background: #fee2e2;
            color: #991b1b;
            border-color: #fecaca;
        }

        .ai-kitchen-action {
            margin-top: 18px;
            border-radius: 18px;
            padding: 18px;
            background: linear-gradient(135deg, #fff7ed, #ffffff);
            border: 1px dashed #fdba74;
        }

        .ai-kitchen-action span {
            display: block;
            font-size: 12px;
            font-weight: 700;
            color: #f97316;
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        .ai-kitchen-action strong {
            display: block;
            margin-top: 8px;
            font-size: 22px;
            color: #111827;
        }

        .ai-kitchen-action p {
            margin: 10px 0 0;
            color: #6b7280;
            line-height: 1.6;
        }

        .ai-kitchen-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 16px;
            margin-top: 18px;
        }

        .ai-kitchen-grid article {
            border-radius: 18px;
            padding: 18px;
            background: #f9fafb;
            border: 1px solid #e5e7eb;
        }

        .ai-kitchen-grid span {
            display: block;
            font-size: 12px;
            font-weight: 700;
            color: #f97316;
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        .ai-kitchen-grid strong {
            display: block;
            margin-top: 8px;
            font-size: 22px;
            color: #111827;
        }

        @media (max-width: 900px) {
            .ai-kitchen-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 640px) {
            .ai-kitchen-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection