@extends('layouts.super-admin')

@section('title', 'FastBites Super Admin Dashboard')

@section('content')
    <header class="topbar">
        <div class="topbar-copy">
            <h1>Super Admin Dashboard</h1>
            <p>Welcome back! Here's what's happening across the platform today.</p>
        </div>
        <div class="topbar-actions">
            <a href="{{ route('super-admin.system-reports') }}" class="quick-action-button">View Reports</a>
            <div class="profile-chip">
                <div class="profile-avatar">
                    {{ strtoupper(substr(auth()->user()->first_name ?? 'S', 0, 1)) }}{{ strtoupper(substr(auth()->user()->last_name ?? 'A', 0, 1)) }}
                </div>
            </div>
        </div>
    </header>

    <section class="stats-grid">
        <article class="stat-card enhanced-stat-card">
            <div class="stat-copy">
                <h2>${{ number_format($totalRevenue, 2) }}</h2>
                <p>Total Revenue</p>
                <span class="stat-trend up">Platform sales total</span>
            </div>
        </article>

        <article class="stat-card enhanced-stat-card">
            <div class="stat-copy">
                <h2>{{ $totalOrders }}</h2>
                <p>Total Orders</p>
                <span class="stat-trend up">{{ $liveOrders }} active now</span>
            </div>
        </article>

        <article class="stat-card enhanced-stat-card">
            <div class="stat-copy">
                <h2>{{ $activeCustomers }}</h2>
                <p>Active Customers</p>
                <span class="stat-trend up">Registered customer accounts</span>
            </div>
        </article>

        <article class="stat-card enhanced-stat-card">
            <div class="stat-copy">
                <h2>${{ number_format($averageOrderValue, 2) }}</h2>
                <p>Average Order Value</p>
                <span class="stat-trend up">Based on all orders</span>
            </div>
        </article>
    </section>

    <section class="charts-grid" style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
            <article class="panel chart-panel">
            <div class="panel-header">
                <div>
                    <h3>Sales Distribution</h3>
                    <p>Order type breakdown across the platform.</p>
                </div>
            </div>
            <div class="chart-box">
                <canvas id="salesPieChart"></canvas>
            </div>
        </article>

        <article class="panel chart-panel">
            <div class="panel-header">
                <div>
                    <h3>Sales Revenue</h3>
                    <p>Revenue trend for the last recorded weeks.</p>
                </div>
            </div>
            <div class="chart-box">
                <canvas id="salesBarChart"></canvas>
            </div>
        </article>
    </section>

    <section class="dashboard-grid" style="margin-top:20px;">
        <article class="panel">
            <div class="panel-header">
                <div>
                    <h3>Platform Readiness</h3>
                    <p>Live KPI coverage for operations and compliance.</p>
                </div>
            </div>

            <div class="revenue-list">
                <div class="revenue-item">
                    <div class="revenue-meta">
                        <span>Operations readiness</span>
                        <strong>{{ $operationsReadiness }}%</strong>
                    </div>
                    <div class="progress-track">
                        <span class="progress-fill" style="width: {{ $operationsReadiness }}%;"></span>
                    </div>
                </div>

                <div class="revenue-item">
                    <div class="revenue-meta">
                        <span>Admin staffing coverage</span>
                        <strong>{{ $adminCoverage }}%</strong>
                    </div>
                    <div class="progress-track">
                        <span class="progress-fill" style="width: {{ $adminCoverage }}%;"></span>
                    </div>
                </div>

                <div class="revenue-item">
                    <div class="revenue-meta">
                        <span>Restaurant compliance</span>
                        <strong>{{ $restaurantCompliance }}%</strong>
                    </div>
                    <div class="progress-track">
                        <span class="progress-fill" style="width: {{ $restaurantCompliance }}%;"></span>
                    </div>
                </div>
            </div>
        </article>

        <article class="panel">
            <div class="panel-header">
                <div>
                    <h3>Leadership Notes</h3>
                    <p>Prepared follow-up actions from live system data.</p>
                </div>
            </div>

            <ul class="status-legend">
                <li><span class="legend-dot orange"></span>Total restaurants on platform: {{ $totalRestaurants }}</li>
                <li><span class="legend-dot amber"></span>Total admin-level accounts: {{ $totalAdmins }}</li>
                <li><span class="legend-dot yellow"></span>Live orders requiring attention: {{ $liveOrders }}</li>
            </ul>
        </article>
    </section>

    <section class="panel orders-panel" style="margin-top: 20px;">
        <div class="panel-header panel-header-stack">
            <div>
                <h3>Recently Placed Orders</h3>
                <p>{{ $recentOrders->count() }} recent orders across the platform.</p>
            </div>
        </div>

        <div class="table-wrap">
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>Order #</th>
                        <th>Customer</th>
                        <th>Restaurant</th>
                        <th>Payment</th>
                        <th>Status</th>
                        <th>Amount</th>
                        <th>Placed At</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($recentOrders as $order)
                        <tr>
                            <td>{{ $order->order_number }}</td>
                            <td>{{ $order->customer_name }}</td>
                            <td>{{ $order->restaurant_name }}</td>
                            <td>
                                <span class="status-pill {{ $order->payment_status === 'paid' ? 'delivered' : 'pending' }}">
                                    {{ ucfirst($order->payment_status) }}
                                </span>
                            </td>
                            <td>
                                <span class="status-pill {{ in_array($order->fulfillment_status, ['delivered', 'ready']) ? 'delivered' : 'pending' }}">
                                    {{ ucfirst($order->fulfillment_status) }}
                                </span>
                            </td>
                            <td>${{ number_format($order->total_amount, 2) }}</td>
                            <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y - h:i A') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">No recent orders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const pieCtx = document.getElementById('salesPieChart');
    const barCtx = document.getElementById('salesBarChart');

    if (pieCtx) {
        new Chart(pieCtx, {
            type: 'pie',
            data: {
                labels: @json($orderTypeChart['labels']),
                datasets: [{
                    data: @json($orderTypeChart['values']),
                    backgroundColor: ['#5b9bd5', '#ed7d31', '#a5a5a5'],
                    borderColor: '#ffffff',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    }

    if (barCtx) {
        new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: @json($weeklySalesChart['labels']),
                datasets: [{
                    label: 'Revenue',
                    data: @json($weeklySalesChart['values']),
                    backgroundColor: '#4c6ef5'
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true
                    }
                }
            }
        });
    }
</script>
@endpush