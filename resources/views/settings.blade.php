<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Settings — FastBites</title>

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --orange: #EC6426;
            --amber: #F8A91F;
            --dark: #1c1a1a;
            --light: rgba(255, 255, 255, 0.95);
            --shadow: 0 12px 30px rgba(0, 0, 0, 0.18);
            --radius: 20px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Space Grotesk', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: var(--orange);
            color: var(--dark);
            padding: 28px 18px 40px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 32px;
        }

        .header h1 {
            margin: 0;
            font-size: clamp(2.3rem, 4vw, 3rem);
            font-weight: 800;
            color: var(--amber);
            letter-spacing: 0.04em;
        }

        .header p {
            margin: 10px 0 0;
            font-size: 1.05rem;
            opacity: 0.9;
        }

        .profile-card {
            background: var(--light);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 28px 24px;
            margin-bottom: 24px;
        }

        .profile-card h2 {
            margin: 0 0 20px;
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--dark);
        }

        .detail-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        .detail-item:last-child {
            border-bottom: none;
        }

        .detail-label {
            font-weight: 600;
            font-size: 1rem;
            color: var(--dark);
        }

        .detail-value {
            font-size: 1rem;
            color: rgba(28, 26, 26, 0.8);
        }

        .btn-logout {
            width: 100%;
            padding: 16px 20px;
            border: none;
            border-radius: var(--radius);
            background: var(--amber);
            color: var(--dark);
            font-weight: 800;
            font-size: 1.1rem;
            cursor: pointer;
            box-shadow: 0 16px 30px rgba(0, 0, 0, 0.15);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-logout:hover {
            transform: translateY(-2px);
            box-shadow: 0 18px 34px rgba(0, 0, 0, 0.2);
        }

        @media (max-width: 500px) {
            .detail-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 4px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="header">
            <h1>FastBites</h1>
            <p>Manage your account settings.</p>
        </header>

        <div class="profile-card">
            <h2>Profile Details</h2>

            <div class="detail-item">
                <span class="detail-label">Name</span>
                <span class="detail-value">{{ Auth::user()->name ?? 'John Doe' }}</span>
            </div>

            <div class="detail-item">
                <span class="detail-label">Phone</span>
                <span class="detail-value">{{ Auth::user()->phone ?? '+1 (555) 123-4567' }}</span>
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
