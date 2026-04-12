@extends('layouts.admin')

@section('title', 'Edit Employee')

@section('content')
    <header class="topbar">
        <div class="topbar-copy">
            <h1>Edit Employee</h1>
            <p>Update employee account information from the admin panel.</p>
        </div>
    </header>

    @if ($errors->any())
        <div style="margin-bottom: 16px; padding: 12px; border-radius: 12px; background: #ffe5e5; color: #b42318;">
            <ul style="margin: 0; padding-left: 18px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section class="panel orders-panel">
        <div class="panel-header panel-header-stack">
            <div>
                <h3>Edit Employee Information</h3>
                <p>Modify the selected employee details below.</p>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.employees.update', $employee->id) }}">
            @csrf

            <div style="display:grid; grid-template-columns: repeat(2, minmax(0,1fr)); gap:16px;">
                <div>
                    <label>First Name</label>
                    <input
                        type="text"
                        name="first_name"
                        value="{{ old('first_name', $employee->first_name) }}"
                        style="width:100%; padding:10px; border-radius:10px; border:1px solid #ddd;"
                    >
                </div>

                <div>
                    <label>Middle Name</label>
                    <input
                        type="text"
                        name="middle_name"
                        value="{{ old('middle_name', $employee->middle_name) }}"
                        style="width:100%; padding:10px; border-radius:10px; border:1px solid #ddd;"
                    >
                </div>

                <div>
                    <label>Last Name</label>
                    <input
                        type="text"
                        name="last_name"
                        value="{{ old('last_name', $employee->last_name) }}"
                        style="width:100%; padding:10px; border-radius:10px; border:1px solid #ddd;"
                    >
                </div>

                <div>
                    <label>Email</label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email', $employee->email) }}"
                        style="width:100%; padding:10px; border-radius:10px; border:1px solid #ddd;"
                    >
                </div>

                <div>
                    <label>Phone Number</label>
                    <input
                        type="text"
                        name="phone_number"
                        value="{{ old('phone_number', $employee->phone_number) }}"
                        style="width:100%; padding:10px; border-radius:10px; border:1px solid #ddd;"
                    >
                </div>

                <div>
                    <label>Address</label>
                    <input
                        type="text"
                        name="address"
                        value="{{ old('address', $employee->address) }}"
                        style="width:100%; padding:10px; border-radius:10px; border:1px solid #ddd;"
                    >
                </div>

                <div>
                    <label>Account Type</label>
                    <select
                        name="account_type"
                        style="width:100%; padding:10px; border-radius:10px; border:1px solid #ddd;"
                    >
                        <option value="admin" {{ old('account_type', $employee->account_type) === 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="kitchen_manager" {{ old('account_type', $employee->account_type) === 'kitchen_manager' ? 'selected' : '' }}>Kitchen Manager</option>
                        <option value="user_manager" {{ old('account_type', $employee->account_type) === 'user_manager' ? 'selected' : '' }}>User Manager</option>
                    </select>
                </div>
            </div>

            <div style="margin-top:20px; display:flex; gap:12px;">
                <button
                    type="submit"
                    style="padding:10px 18px; border:none; border-radius:10px; background:#f59e0b; color:white; cursor:pointer;"
                >
                    Update Employee
                </button>

                <a
                    href="{{ route('admin.employees') }}"
                    style="padding:10px 18px; border-radius:10px; background:#eee; color:#333; text-decoration:none;"
                >
                    Cancel
                </a>
            </div>
        </form>
    </section>
@endsection