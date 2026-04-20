<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Settings — FastBites</title>

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="welcome-page">
    <div class="container">
        <header class="header">
            <h1>FastBites</h1>
            <p>Manage your account settings.</p>
        </header>

        <div class="profile-card">
            <h2>Profile Details</h2>

            <div class="detail-item">
                <span class="detail-label">Name</span>
                <span class="detail-value">{{ Auth::user()->full_name ?? 'John Doe' }}</span>
            </div>

            <div class="detail-item">
                <span class="detail-label">Phone</span>
                <span class="detail-value">{{ Auth::user()->phone_number ?? '+1 (555) 123-4567' }}</span>
            </div>

            <div class="detail-item">
                <span class="detail-label">Address</span>
                <span class="detail-value">{{ Auth::user()->address ?? '123 Main St' }}</span>
            </div>

            <div class="detail-item">
                <span class="detail-label">Account Type</span>
                <span class="detail-value">{{ Auth::user()->account_type ?? 'customer' }}</span>
            </div>

            <div class="detail-item">
                <span class="detail-label">Email</span>
                <span class="detail-value">{{ Auth::user()->email ?? 'john.doe@example.com' }}</span>
            </div>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout">Logout</button>
        </form>
    </div>
</body>
</html>
