<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'FastBites') }} — Fast Food, Faster Delivery</title>

    <!-- Modern font -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css'])
</head>
<body class="welcome-page">
    <div class="layout">
        <header class="topbar">
            <div></div>
            <div class="brand">FastBites</div>
            <button class="menu-btn" aria-label="Open menu">
                <span></span>
            </button>
        </header>

        <main class="hero">
            <div class="logo-stack">
                <div class="logo-mark">
                    <div class="logo-text">FB</div>
                </div>
                <div class="meta">
                    <div class="chip">Lightning delivery</div>
                    <div class="chip">Hot. Fast. Fresh.</div>
                    <div class="chip">Powered by local kitchens</div>
                </div>
            </div>

            <div class="hero-card">
                <div class="eyebrow">Your city, your cravings · delivered</div>
                <h1>Fast food that moves at your speed.</h1>
                <p class="subhead">
                    Discover top local restaurants, track riders live, and get meals in under 30 minutes with FastBites—built for the way you actually eat.
                </p>
                <div class="cta-stack">
    <a class="glass-btn primary" href="{{ route('login') }}">Login</a>
    <a class="glass-btn primary" href="{{ route('register') }}">Sign Up</a>
<a class="glass-btn primary" href="{{ route('admin.dashboard') }}">Go to Dashboard</a></div>

                <div class="features">
                    <div class="feature-card">
                        <div class="feature-icon">⏱️</div>
                        <div>
                            <div class="feature-title">15–30 min avg ETA</div>
                            <div class="feature-copy">Predictive dispatch keeps your cravings on schedule.</div>
                        </div>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">🍔</div>
                        <div>
                            <div class="feature-title">Curated picks</div>
                            <div class="feature-copy">Hand-picked burgers, bowls, and bites from local legends.</div>
                        </div>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">📍</div>
                        <div>
                            <div class="feature-title">Live tracking</div>
                            <div class="feature-copy">Follow your courier with real-time updates and smart alerts.</div>
                        </div>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">💳</div>
                        <div>
                            <div class="feature-title">Secure checkout</div>
                            <div class="feature-copy">Encrypted payments with Apple Pay, cards, and cashless tips.</div>
                        </div>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">🌟</div>
                        <div>
                            <div class="feature-title">Trust at a glance</div>
                            <div class="feature-copy">Ratings, photos, and chef notes keep choices effortless.</div>
                        </div>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">⚡</div>
                        <div>
                            <div class="feature-title">Always-on support</div>
                            <div class="feature-copy">Chat with support right inside the app when you need help.</div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <div class="footer">
            &copy; {{ date('Y') }} FastBites. Delivering happiness, one meal at a time.
        </div>
    </div>
</body>
</html>
