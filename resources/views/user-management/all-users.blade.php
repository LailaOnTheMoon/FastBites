@extends('layouts.user-management')

@section('title', 'All Users')

@section('content')

    <header class="topbar">
        <div class="topbar-copy">
            <h1>All Users</h1>
            <p>Static user directory styled to match the dashboard workspace.</p>
        </div>
    </header>

    <section class="panel orders-panel">
        <div class="panel-header panel-header-stack">
            <div>
                <h3>User Directory</h3>
                <p>Preview of user listing layout for later expansion.</p>
            </div>
        </div>
        @if(session('success'))
    <div style="margin-bottom: 16px; padding: 12px; border-radius: 12px; background: #e8f7e8; color: #166534;">
        {{ session('success') }}
    </div>
@endif
        <div class="table-wrap">
            <table class="orders-table">
                <thead>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Actions</th>
    </tr>
</thead>
                <tbody>
    @forelse($users as $user)
        <tr>
            <td>{{ $user->first_name }} {{ $user->last_name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->phone_number ?? 'N/A' }}</td>
            <td>{{ $user->address ?? 'N/A' }}</td>
            <td>
    <div style="display:flex; gap:10px; align-items:center;">
        <a href="{{ route('user-management.edit-user', $user->id) }}"
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

        <form action="{{ route('user-management.delete-user', $user->id) }}"
              method="POST"
              onsubmit="return confirm('Are you sure you want to delete this customer?');"
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
            <td colspan="5">No customers found.</td>
        </tr>
    @endforelse
</tbody>
            </table>
        </div>
    </section>
@endsection
