@extends('layouts.user-management')

@section('title', 'Edit Customer')

@section('content')
    <header class="topbar">
        <div class="topbar-copy">
            <h1>Edit Customer</h1>
            <p>Update customer account information.</p>
        </div>
    </header>

    <section class="panel orders-panel">
        <div class="panel-header panel-header-stack">
            <div>
                <h3>Edit User Form</h3>
                <p>Modify the selected customer details below.</p>
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

        <form method="POST" action="{{ route('user-management.update-user', $user->id) }}">
            @csrf
            @method('PUT')

            <div style="display:grid; grid-template-columns: repeat(2, minmax(0,1fr)); gap:16px;">
                <div>
                    <label>First Name</label>
                    <input type="text" name="first_name" value="{{ old('first_name', $user->first_name) }}" style="width:100%; padding:10px; border-radius:10px; border:1px solid #ddd;">
                </div>

                <div>
                    <label>Middle Name</label>
                    <input type="text" name="middle_name" value="{{ old('middle_name', $user->middle_name) }}" style="width:100%; padding:10px; border-radius:10px; border:1px solid #ddd;">
                </div>

                <div>
                    <label>Last Name</label>
                    <input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}" style="width:100%; padding:10px; border-radius:10px; border:1px solid #ddd;">
                </div>

                <div>
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" style="width:100%; padding:10px; border-radius:10px; border:1px solid #ddd;">
                </div>

                <div>
                    <label>Phone Number</label>
                    <input type="text" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" style="width:100%; padding:10px; border-radius:10px; border:1px solid #ddd;">
                </div>

                <div>
                    <label>Address</label>
                    <input type="text" name="address" value="{{ old('address', $user->address) }}" style="width:100%; padding:10px; border-radius:10px; border:1px solid #ddd;">
                </div>
            </div>

            <div style="margin-top:20px; display:flex; gap:12px;">
                <button type="submit" style="padding:10px 18px; border:none; border-radius:10px; background:#f59e0b; color:white; cursor:pointer;">
                    Update Customer
                </button>

                <a href="{{ route('user-management.all-users') }}"
                   style="padding:10px 18px; border-radius:10px; background:#eee; color:#333; text-decoration:none;">
                    Cancel
                </a>
            </div>
        </form>
    </section>
@endsection