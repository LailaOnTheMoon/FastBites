@extends('layouts.user-management')

@section('title', 'Create User')

@section('content')
    <header class="topbar">
        <div class="topbar-copy">
            <h1>Create User</h1>
            <p>Add a new user account to the system.</p>
        </div>
    </header>

    <section class="panel orders-panel">
        <div class="panel-header panel-header-stack">
            <div>
                <h3>New User Form</h3>
                <p>Fill in the user details below.</p>
            </div>
        </div>

        @if ($errors->any())
            <div style="margin-bottom: 16px; padding: 12px; border-radius: 12px; background: #ffe5e5; color: #b42318;">
                <ul style="margin: 0; padding-left: 18px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('user-management.store-user') }}">
            @csrf

            <div style="display:grid; grid-template-columns: repeat(2, minmax(0,1fr)); gap:16px;">
                <div>
                    <label>First Name</label>
                    <input type="text" name="first_name" value="{{ old('first_name') }}" style="width:100%; padding:10px; border-radius:10px; border:1px solid #ddd;">
                </div>

                <div>
                    <label>Middle Name</label>
                    <input type="text" name="middle_name" value="{{ old('middle_name') }}" style="width:100%; padding:10px; border-radius:10px; border:1px solid #ddd;">
                </div>

                <div>
                    <label>Last Name</label>
                    <input type="text" name="last_name" value="{{ old('last_name') }}" style="width:100%; padding:10px; border-radius:10px; border:1px solid #ddd;">
                </div>

                <div>
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" style="width:100%; padding:10px; border-radius:10px; border:1px solid #ddd;">
                </div>

                <div>
                    <label>Phone Number</label>
                    <input type="text" name="phone_number" value="{{ old('phone_number') }}" style="width:100%; padding:10px; border-radius:10px; border:1px solid #ddd;">
                </div>

                <div>
                    <label>Address</label>
                    <input type="text" name="address" value="{{ old('address') }}" style="width:100%; padding:10px; border-radius:10px; border:1px solid #ddd;">
                </div>

                <div>
                    <label>Account Type</label>
                    <select name="account_type" style="width:100%; padding:10px; border-radius:10px; border:1px solid #ddd;">
                        <option value="">Select role</option>
                        <option value="super_admin" {{ old('account_type') == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                        <option value="admin" {{ old('account_type') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="kitchen_manager" {{ old('account_type') == 'kitchen_manager' ? 'selected' : '' }}>Kitchen Manager</option>
                        <option value="user_manager" {{ old('account_type') == 'user_manager' ? 'selected' : '' }}>User Manager</option>
                    </select>
                </div>

                <div>
                    <label>Password</label>
                    <input type="password" name="password" style="width:100%; padding:10px; border-radius:10px; border:1px solid #ddd;">
                </div>

                <div>
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation" style="width:100%; padding:10px; border-radius:10px; border:1px solid #ddd;">
                </div>
            </div>

            <div style="margin-top:20px; display:flex; gap:12px;">
                <button type="submit" class="nav-item active" style="border:none; cursor:pointer;">Create User</button>
                <a href="{{ route('user-management.all-users') }}" class="nav-item">Cancel</a>
            </div>
        </form>
    </section>
@endsection