<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment — FastBites</title>

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <article class="login-card">
            <header class="header">
                <h1>FastBites</h1>
                <p>Welcome back — sign in to continue to your dashboard.</p>
            </header>

            <form id="loginForm" autocomplete="off">
                <h2>Premium Account Access</h2>
                <p>Securely login with your credentials in a warm, premium interface.</p>

                <div class="field">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="you@example.com" required>
                </div>

                <div class="field">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="••••••••" required>
                </div>

                <button type="submit" class="btn-login">Log In</button>
            </form>
        </article>
    </div>

<script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
