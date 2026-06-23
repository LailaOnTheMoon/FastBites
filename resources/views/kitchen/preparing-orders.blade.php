@extends('layouts.kitchen')

@section('title', 'Preparing Orders')

@section('content')
    <header class="topbar">
        <div class="topbar-copy">
            <h1>Preparing Orders</h1>
            <p>Orders currently being cooked or assembled inside the kitchen.</p>
        </div>
    </header>

    <section class="panel orders-panel">
        <div class="panel-header panel-header-stack">
            <div>
                <h3>Preparation Board</h3>
                <p>{{ $orders->count() }} active preparation orders.</p>
            </div>
        </div>

        <div class="table-wrap">
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>Ticket</th>
                        <th>Customer</th>
                        <th>Restaurant</th>
                        <th>Order Type</th>
                        <th>Started At</th>
                        <th>Kitchen Note</th>
                        <th>AI Kitchen Advice</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($orders as $order)
                        @php
                            $aiAdvice = $order->kitchen_ai_advice ?? [
                                'label' => 'Keep Preparing',
                                'message' => 'Continue preparing this order and update the status when it is ready.',
                                'priority' => 'Medium',
                            ];

                            $priorityClass = strtolower($aiAdvice['priority'] ?? 'medium');
                        @endphp

                        <tr>
                            <td>{{ $order->order_number }}</td>
                            <td>{{ $order->customer_name }}</td>
                            <td>{{ $order->restaurant_name }}</td>
                            <td>{{ ucfirst($order->order_type) }}</td>
                            <td>{{ $order->accepted_at ? \Carbon\Carbon::parse($order->accepted_at)->format('h:i A') : '-' }}</td>
                            <td>{{ $order->special_instructions ?: 'No notes' }}</td>

                            <td>
                                <div class="ai-advice-box {{ $priorityClass }}">
                                    <div class="ai-advice-top">
                                        <strong>{{ $aiAdvice['label'] ?? 'Keep Preparing' }}</strong>
                                        <span>{{ $aiAdvice['priority'] ?? 'Medium' }}</span>
                                    </div>

                                    <p>{{ $aiAdvice['message'] ?? 'Continue preparing this order and update the status when it is ready.' }}</p>
                                </div>
                            </td>

                            <td>
                                <span class="status-pill pending">Preparing</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">No preparing orders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <style>
        .ai-advice-box {
            min-width: 220px;
            border-radius: 14px;
            padding: 12px;
            border: 1px solid #e5e7eb;
            background: #f9fafb;
        }

        .ai-advice-box.high {
            background: #fee2e2;
            border-color: #fecaca;
            color: #991b1b;
        }

        .ai-advice-box.medium {
            background: #fffbeb;
            border-color: #fde68a;
            color: #92400e;
        }

        .ai-advice-box.low {
            background: #ecfdf5;
            border-color: #bbf7d0;
            color: #166534;
        }

        .ai-advice-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
        }

        .ai-advice-top strong {
            font-size: 13px;
        }

        .ai-advice-top span {
            border-radius: 999px;
            padding: 4px 8px;
            background: rgba(255, 255, 255, 0.65);
            font-size: 11px;
            font-weight: 700;
        }

        .ai-advice-box p {
            margin: 8px 0 0;
            font-size: 12px;
            line-height: 1.5;
        }
    </style>
@endsection