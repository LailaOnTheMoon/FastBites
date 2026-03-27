@extends('layouts.admin')

@section('title', 'FastBites Admin Dashboard')

@section('content')
    @php
        $stats = [
            ['label' => 'Total Sales', 'value' => '$25,400', 'accent' => 'green', 'icon' => 'sales', 'trend' => '+8.4% vs last week', 'trend_class' => 'up'],
            ['label' => 'Total Orders', 'value' => '2,230', 'accent' => 'orange', 'icon' => 'orders', 'trend' => '+5.1% from yesterday', 'trend_class' => 'up'],
            ['label' => 'Active Users', 'value' => '3,458', 'accent' => 'pink', 'icon' => 'users', 'trend' => '+124 users today', 'trend_class' => 'up'],
            ['label' => 'Total Users', 'value' => '1,524', 'accent' => 'amber', 'icon' => 'group', 'trend' => '-1.2% churn this week', 'trend_class' => 'down'],
            ['label' => 'Total Stores', 'value' => '402', 'accent' => 'gold', 'icon' => 'store', 'trend' => '+12 new this quarter', 'trend_class' => 'up'],
            ['label' => 'Active Riders', 'value' => '86', 'accent' => 'blue', 'icon' => 'rider', 'trend' => '-3 riders vs yesterday', 'trend_class' => 'down'],
        ];

        $salesRevenue = [
            ['week' => 'Week 1', 'amount' => '$65,500', 'width' => 78],
            ['week' => 'Week 2', 'amount' => '$55,500', 'width' => 66],
            ['week' => 'Week 3', 'amount' => '$85,500', 'width' => 92],
            ['week' => 'Week 4', 'amount' => '$45,500', 'width' => 52],
            ['week' => 'Week 5', 'amount' => '$75,500', 'width' => 83],
        ];

        $recentOrders = [
            ['customer' => 'Maryam Nawas', 'order_id' => 'ORD16729873', 'store_id' => 'STNG456789', 'payment' => 'Cash on delivery', 'amount' => '$2,590', 'time' => '11:00 am', 'status' => 'Pending'],
            ['customer' => 'Ajeetha Murugan', 'order_id' => 'ORD16729874', 'store_id' => 'STNG456790', 'payment' => 'Online', 'amount' => '$145', 'time' => '10:56 am', 'status' => 'Canceled'],
            ['customer' => 'Rihaan', 'order_id' => 'ORD16729875', 'store_id' => 'STNG456791', 'payment' => 'Cash on delivery', 'amount' => '$895', 'time' => '10:52 am', 'status' => 'Pending'],
            ['customer' => 'Daemon', 'order_id' => 'ORD16729876', 'store_id' => 'STNG456792', 'payment' => 'Online', 'amount' => '$4,784', 'time' => '10:51 am', 'status' => 'Delivered'],
            ['customer' => 'Lina Ahmad', 'order_id' => 'ORD16729877', 'store_id' => 'STNG456793', 'payment' => 'Online', 'amount' => '$1,240', 'time' => '10:40 am', 'status' => 'Delivered'],
        ];
    @endphp

    <header class="topbar">
        <div class="topbar-copy">
            <div class="heading-row">
                <div>
                    <h1>Welcome, Super Admin</h1>
                    <p>Monitor the full FastBites system from one place.</p>
                </div>
                <a href="#" class="quick-action-button">Export Summary</a>
            </div>
        </div>

        <div class="topbar-actions">
            <label class="search-box" aria-label="Search">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M10 4a6 6 0 1 1 0 12 6 6 0 0 1 0-12m0-2a8 8 0 1 0 4.9 14.32l4.39 4.39 1.41-1.41-4.39-4.39A8 8 0 0 0 10 2" /></svg>
                <input type="text" placeholder="Search here..." />
            </label>

            <button class="icon-button" type="button" aria-label="Notifications">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 22a2.5 2.5 0 0 0 2.45-2h-4.9A2.5 2.5 0 0 0 12 22m6-6V11a6 6 0 1 0-12 0v5L4 18v1h16v-1z" /></svg>
            </button>

            <button class="icon-button" type="button" aria-label="Messages">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20 4H4a2 2 0 0 0-2 2v12l4-3h14a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2m0 9H6l-2 1.5V6h16z" /></svg>
            </button>

            <div class="profile-chip" aria-label="Profile image">
                <div class="profile-avatar">SA</div>
            </div>
        </div>
    </header>

    <section class="stats-grid">
        @foreach ($stats as $stat)
            <article class="stat-card enhanced-stat-card">
                <div class="stat-icon {{ $stat['accent'] }}">
                    @if ($stat['icon'] === 'sales')
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2 6.5 8H10v6a2 2 0 0 0 2 2h1a1 1 0 0 1 0 2H7v2h3v2h2v-2h1a3 3 0 0 0 0-6h-1v-6h3.5z" /></svg>
                    @elseif ($stat['icon'] === 'orders')
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M7 4h10l1 3h2v2h-1l-1.1 8.12A2 2 0 0 1 15.92 19H8.08a2 2 0 0 1-1.98-1.88L5 9H4V7h2zm1.02 5 .88 8h6.2l.88-8zM9 2h2v2H9zm4 0h2v2h-2z" /></svg>
                    @elseif ($stat['icon'] === 'users')
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M16 11a4 4 0 1 0-4-4 4 4 0 0 0 4 4m-8 1a3 3 0 1 0-3-3 3 3 0 0 0 3 3m8 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4" /></svg>
                    @elseif ($stat['icon'] === 'group')
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M9 11a4 4 0 1 0-4-4 4 4 0 0 0 4 4m6 1a3 3 0 1 0-3-3 3 3 0 0 0 3 3m0 2c-2.21 0-6.63 1.11-6.95 3.33A2 2 0 0 0 10 20h10v-.67C20 16.89 17.21 14 15 14M9 13c-2.67 0-8 1.34-8 4v3h7.5v-2.67c0-1.04.4-2 1.07-2.82A16.7 16.7 0 0 0 9 13" /></svg>
                    @elseif ($stat['icon'] === 'store')
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 4h16v4a3 3 0 0 1-3 3 2.96 2.96 0 0 1-2-.77A2.96 2.96 0 0 1 13 11a2.96 2.96 0 0 1-2-.77A2.96 2.96 0 0 1 9 11a3 3 0 0 1-3-3zm1 9h5v7H5zm7 0h7v7h-7z" /></svg>
                    @else
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 16a3 3 0 0 1 0-6h1.27A5 5 0 0 1 16 9h1a3 3 0 1 1 0 6h-1.1a4 4 0 0 1-7.8 0zm5 0a2 2 0 1 0 4 0zm-5.5-5a1.5 1.5 0 1 0 0 3A1.5 1.5 0 0 0 4.5 11M17 11a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3" /></svg>
                    @endif
                </div>

                <div class="stat-copy">
                    <h2>{{ $stat['value'] }}</h2>
                    <p>{{ $stat['label'] }}</p>
                    <span class="stat-trend {{ $stat['trend_class'] }}">{{ $stat['trend'] }}</span>
                </div>
            </article>
        @endforeach
    </section>

    <section class="dashboard-grid">
        <article class="panel timeline-panel">
            <div class="panel-header">
                <div>
                    <h3>Order Timeline</h3>
                    <p class="panel-subnote">Peak order activity happened in the final quarter.</p>
                </div>
                <select aria-label="Timeline year">
                    <option>2025</option>
                    <option>2024</option>
                    <option>2023</option>
                </select>
            </div>

            <div class="summary-row">
                <div class="summary-card">
                    <strong>470</strong>
                    <span>Dec Peak</span>
                </div>
                <div class="summary-card">
                    <strong>312 avg</strong>
                    <span>Monthly Orders</span>
                </div>
            </div>

            <div class="chart-wrap large-chart">
                <canvas id="orderTimelineChart"></canvas>
            </div>
        </article>

        <article class="panel revenue-panel">
            <div class="panel-header">
                <div>
                    <h3>Sales Revenue</h3>
                    <p class="panel-subnote">Week 3 is leading revenue performance this month.</p>
                </div>
                <select aria-label="Sales month">
                    <option>Mar</option>
                    <option>Feb</option>
                    <option>Jan</option>
                </select>
            </div>

            <div class="summary-row">
                <div class="summary-card">
                    <strong>$85,500</strong>
                    <span>Best Week</span>
                </div>
                <div class="summary-card">
                    <strong>+11.3%</strong>
                    <span>vs last month</span>
                </div>
            </div>

            <div class="revenue-list">
                @foreach ($salesRevenue as $item)
                    <div class="revenue-item">
                        <div class="revenue-meta">
                            <span>{{ $item['week'] }}</span>
                            <strong>{{ $item['amount'] }}</strong>
                        </div>
                        <div class="progress-track">
                            <span class="progress-fill" style="width: {{ $item['width'] }}%;"></span>
                        </div>
                    </div>
                @endforeach
            </div>
        </article>

        <article class="panel donut-panel">
            <div class="panel-header">
                <div>
                    <h3>User Status</h3>
                    <p class="panel-subnote">Retention is improving with stronger repeat behavior.</p>
                </div>
            </div>

            <div class="chart-wrap donut-chart-wrap">
                <canvas id="userStatusChart"></canvas>
            </div>

            <ul class="status-legend">
                <li><span class="legend-dot orange"></span>Active User</li>
                <li><span class="legend-dot amber"></span>Purchased User</li>
                <li><span class="legend-dot yellow"></span>New User</li>
                <li><span class="legend-dot cream"></span>Repurchased User</li>
            </ul>
        </article>
    </section>

    <section class="panel orders-panel">
        <div class="panel-header panel-header-stack">
            <div>
                <h3>Recently Placed Orders</h3>
                <p>See recently placed orders across the system.</p>
            </div>
            <a href="#" class="table-link">View All</a>
        </div>

        <div class="table-wrap">
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>Customer Name</th>
                        <th>Order ID</th>
                        <th>Store ID</th>
                        <th>Payment Mode</th>
                        <th>Amount</th>
                        <th>Delivery Time</th>
                        <th>Order Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recentOrders as $order)
                        <tr>
                            <td>{{ $order['customer'] }}</td>
                            <td>{{ $order['order_id'] }}</td>
                            <td>{{ $order['store_id'] }}</td>
                            <td>{{ $order['payment'] }}</td>
                            <td>{{ $order['amount'] }}</td>
                            <td>{{ $order['time'] }}</td>
                            <td>
                                <span class="status-pill {{ strtolower($order['status']) }}">
                                    {{ $order['status'] }}
                                </span>
                            </td>
                            <td><a href="#" class="row-action-link">Details</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        const timelineCanvas = document.getElementById('orderTimelineChart');

        if (timelineCanvas) {
            const timelineContext = timelineCanvas.getContext('2d');
            const timelineGradient = timelineContext.createLinearGradient(0, 0, 0, 280);

            timelineGradient.addColorStop(0, 'rgba(255, 151, 42, 0.34)');
            timelineGradient.addColorStop(1, 'rgba(255, 151, 42, 0.02)');

            new Chart(timelineCanvas, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        data: [120, 180, 170, 260, 240, 310, 290, 360, 335, 420, 390, 470],
                        borderColor: '#ff8f20',
                        backgroundColor: timelineGradient,
                        fill: true,
                        tension: 0.38,
                        borderWidth: 3,
                        pointRadius: 3.8,
                        pointHoverRadius: 4.6,
                        pointBackgroundColor: '#fff8f0',
                        pointBorderColor: '#ff8f20',
                        pointBorderWidth: 1.8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#2f2218',
                            padding: 10,
                            displayColors: false
                        }
                    },
                    scales: {
                        x: {
                            grid: { display: false, drawBorder: false },
                            border: { display: false },
                            ticks: {
                                color: '#9c856d',
                                font: { size: 12, family: 'Poppins' }
                            }
                        },
                        y: {
                            min: 0,
                            max: 500,
                            ticks: {
                                stepSize: 50,
                                color: '#9c856d',
                                font: { size: 12, family: 'Poppins' }
                            },
                            grid: {
                                color: 'rgba(234, 208, 176, 0.7)',
                                drawBorder: false
                            },
                            border: { display: false }
                        }
                    }
                }
            });
        }

        const userStatusCanvas = document.getElementById('userStatusChart');

        if (userStatusCanvas) {
            new Chart(userStatusCanvas, {
                type: 'doughnut',
                data: {
                    labels: ['Active User', 'Purchased User', 'New User', 'Repurchased User'],
                    datasets: [{
                        data: [34, 27, 21, 18],
                        backgroundColor: ['#ff952d', '#ffbb4f', '#ffd441', '#ffe5a7'],
                        borderWidth: 0,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '58%',
                    plugins: {
                        legend: { display: false }
                    }
                }
            });
        }
    </script>
@endpush
