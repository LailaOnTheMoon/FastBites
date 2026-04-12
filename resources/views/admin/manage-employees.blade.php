@extends('layouts.admin')

@section('title', 'Manage Employees')

@section('content')
    <header class="topbar">
        <div class="topbar-copy">
            <h1>Manage Employees</h1>
            <p>View, add, edit, and delete employee accounts from the admin panel.</p>
        </div>
        <div class="topbar-actions">
            <a href="{{ route('admin.employees.create') }}" class="quick-action-button">Add Employee</a>
        </div>
    </header>

    @if(session('success'))
        <div style="margin-bottom: 16px; padding: 12px; border-radius: 12px; background: #e8f7e8; color: #166534;">
            {{ session('success') }}
        </div>
    @endif

    <section class="stats-grid">
        <article class="stat-card">
            <div class="stat-copy">
                <h2>{{ $employees->count() }}</h2>
                <p>Total Employees</p>
            </div>
        </article>

        <article class="stat-card">
            <div class="stat-copy">
                <h2>{{ $employees->where('account_type', 'admin')->count() }}</h2>
                <p>Admins</p>
            </div>
        </article>

        <article class="stat-card">
            <div class="stat-copy">
                <h2>{{ $employees->where('account_type', 'kitchen_manager')->count() }}</h2>
                <p>Kitchen Managers</p>
            </div>
        </article>

        <article class="stat-card">
            <div class="stat-copy">
                <h2>{{ $employees->where('account_type', 'user_manager')->count() }}</h2>
                <p>User Managers</p>
            </div>
        </article>
    </section>

    <section class="panel orders-panel">
        <div class="panel-header panel-header-stack">
            <div>
                <h3>Employee Directory</h3>
                <p>All employee records stored in the users table.</p>
            </div>
        </div>

        <div class="table-wrap">
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($employees as $emp)
                        <tr>
                            <td>{{ $emp->first_name }} {{ $emp->last_name }}</td>
                            <td>{{ $emp->email }}</td>
                            <td>{{ ucwords(str_replace('_', ' ', $emp->account_type)) }}</td>
                            <td>{{ $emp->phone_number ?? 'N/A' }}</td>
                            <td>{{ $emp->address ?? 'N/A' }}</td>
                            <td>
                                <div style="display:flex; gap:10px; justify-content:flex-end; align-items:center;">
                                    <a href="{{ route('admin.employees.edit', $emp->id) }}"
                                       style="
                                            display:inline-block;
                                            padding:8px 14px;
                                            border-radius:10px;
                                            background:#f59e0b;
                                            color:white;
                                            text-decoration:none;
                                            font-size:14px;
                                            font-weight:600;
                                       ">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.employees.delete', $emp->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this employee?');"
                                          style="margin:0;">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                style="
                                                    padding:8px 14px;
                                                    border:none;
                                                    border-radius:10px;
                                                    background:#ef4444;
                                                    color:white;
                                                    font-size:14px;
                                                    font-weight:600;
                                                    cursor:pointer;
                                                ">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No employees found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection