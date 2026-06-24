@extends('layouts.admin')

@section('title', 'FastBites Admin Dashboard')

@section('content')
    <header class="topbar">
        <div class="topbar-copy">
            <div class="heading-row">
                <div>
                    <h1>Admin Dashboard</h1>
                    <p>Track restaurant operations, orders, and daily admin priorities.</p>
                </div>
                <a href="{{ route('admin.reports') }}" class="quick-action-button">Open Reports</a>
            </div>
        </div>

        <div class="topbar-actions">
            <div class="profile-chip" aria-label="Profile">
                <div class="profile-avatar">
                    {{ strtoupper(substr(auth()->user()->first_name ?? 'A', 0, 1)) }}{{ strtoupper(substr(auth()->user()->last_name ?? 'D', 0, 1)) }}
                </div>
            </div>
        </div>
    </header>

    <section class="stats-grid">
        @foreach ($stats as $stat)
            <article class="stat-card enhanced-stat-card">
                <div class="stat-icon {{ $stat['accent'] }}">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M4 5.5A1.5 1.5 0 0 1 5.5 4h13A1.5 1.5 0 0 1 20 5.5v13a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 4 18.5zm2 0V11h5V6zm7 0v5h5V5.5zM6 13v5.5h5V13zm7 0v5.5h5V13z" />
                    </svg>
                </div>

                <div class="stat-copy">
                    <h2>{{ $stat['value'] }}</h2>
                    <p>{{ $stat['label'] }}</p>
                    <span class="stat-trend {{ $stat['trend_class'] }}">{{ $stat['trend'] }}</span>
                </div>
            </article>
        @endforeach
    </section>

    {{-- ================== AI Business Insights ================== --}}
    <section class="ai-insights-panel">
        <div class="panel-header">
            <div>
                <h3>AI Business Insights</h3>
                <p>Smart analysis based on orders, restaurants, and customer demand.</p>
            </div>

            <span class="status-pill delivered">
                AI Analysis
            </span>
        </div>

        <div class="ai-insights-grid">
            <article class="ai-insight-card">
                <span>Top Selling Item</span>
                <strong>{{ $adminAiInsights['top_selling_item'] ?? 'Not enough data yet' }}</strong>
            </article>

            <article class="ai-insight-card">
                <span>Top Category</span>
                <strong>{{ $adminAiInsights['top_category'] ?? 'Not enough data yet' }}</strong>
            </article>

            <article class="ai-insight-card">
                <span>Best Restaurant</span>
                <strong>{{ $adminAiInsights['best_restaurant'] ?? 'Not enough data yet' }}</strong>
            </article>

            <article class="ai-insight-card">
                <span>Peak Order Time</span>
                <strong>{{ $adminAiInsights['peak_order_time'] ?? 'Not enough data yet' }}</strong>
            </article>
        </div>

        <div class="ai-suggestion-box">
            <span>Suggested Action</span>
            <p>{{ $adminAiInsights['suggested_action'] ?? 'Collect more order data to generate stronger AI business insights.' }}</p>
        </div>
    </section>

    <section class="dashboard-grid">
        <article class="panel">
            <div class="panel-header">
                <div>
                    <h3>Restaurant Snapshot</h3>
                    <p>Quick operational overview across assigned branches.</p>
                </div>
            </div>

            <div class="table-wrap">
                <table class="orders-table">
                    <thead>
                        <tr>
                            <th>Restaurant</th>
                            <th>Manager</th>
                            <th>Status</th>
                            <th>Open Orders</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($restaurants as $restaurant)
                            <tr>
                                <td>{{ $restaurant['name'] }}</td>
                                <td>{{ $restaurant['manager'] }}</td>
                                <td>
                                    <span class="status-pill {{ $restaurant['status'] === 'Needs Check' ? 'canceled' : 'delivered' }}">
                                        {{ $restaurant['status'] }}
                                    </span>
                                </td>
                                <td>{{ $restaurant['orders'] }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No restaurant activity available.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </article>

        <article class="panel">
            <div class="panel-header">
                <div>
                    <h3>Today Priorities</h3>
                    <p>Focus items for the current shift.</p>
                </div>
            </div>

            <div class="summary-row">
                <div class="summary-card">
                    <strong>{{ str_pad($restaurantsPendingReview, 2, '0', STR_PAD_LEFT) }}</strong>
                    <span>Restaurants pending review</span>
                </div>

                <div class="summary-card">
                    <strong>{{ $averageOrderDelay }} min</strong>
                    <span>Average order delay</span>
                </div>
            </div>

            <div class="revenue-list">
                <div class="revenue-item">
                    <div class="revenue-meta">
                        <span>Kitchen response rate</span>
                        <strong>{{ $kitchenResponseRate }}%</strong>
                    </div>

                    <div class="progress-track">
                        <span class="progress-fill" style="width: {{ $kitchenResponseRate }}%;"></span>
                    </div>
                </div>

                <div class="revenue-item">
                    <div class="revenue-meta">
                        <span>Branch compliance</span>
                        <strong>{{ $branchCompliance }}%</strong>
                    </div>

                    <div class="progress-track">
                        <span class="progress-fill" style="width: {{ $branchCompliance }}%;"></span>
                    </div>
                </div>

                <div class="revenue-item">
                    <div class="revenue-meta">
                        <span>Customer satisfaction</span>
                        <strong>{{ $customerSatisfaction }}%</strong>
                    </div>

                    <div class="progress-track">
                        <span class="progress-fill" style="width: {{ $customerSatisfaction }}%;"></span>
                    </div>
                </div>
            </div>
        </article>

        <article class="panel">
            <div class="panel-header">
                <div>
                    <h3>Recent Activity</h3>
                    <p>Latest admin actions and updates.</p>
                </div>
            </div>

            <ul class="status-legend">
                @forelse ($activities as $activity)
                    <li>
                        <span class="legend-dot orange"></span>
                        {{ $activity['title'] }} - {{ $activity['time'] }}
                    </li>
                @empty
                    <li>
                        <span class="legend-dot orange"></span>
                        No recent employee activity yet.
                    </li>
                @endforelse
            </ul>
        </article>
    </section>

    <style>
        .ai-insights-panel {
            margin-top: 24px;
            background: #ffffff;
            border-radius: 24px;
            padding: 24px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 18px 45px rgba(15, 23, 42, 0.06);
        }

        .ai-insights-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 16px;
            margin-top: 20px;
        }

        .ai-insight-card {
            border-radius: 18px;
            padding: 18px;
            background: linear-gradient(135deg, #fff7ed, #ffffff);
            border: 1px solid #fed7aa;
        }

        .ai-insight-card span {
            display: block;
            font-size: 12px;
            font-weight: 700;
            color: #f97316;
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        .ai-insight-card strong {
            display: block;
            margin-top: 10px;
            font-size: 20px;
            color: #111827;
        }

        .ai-suggestion-box {
            margin-top: 18px;
            border-radius: 18px;
            padding: 18px;
            background: #f9fafb;
            border: 1px dashed #fdba74;
        }

        .ai-suggestion-box span {
            display: block;
            font-size: 12px;
            font-weight: 700;
            color: #f97316;
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        .ai-suggestion-box p {
            margin: 8px 0 0;
            color: #374151;
            line-height: 1.6;
        }

        @media (max-width: 900px) {
            .ai-insights-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 640px) {
            .ai-insights-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection