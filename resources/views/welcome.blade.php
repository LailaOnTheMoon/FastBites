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

    <style>
        :root {
            --button-start: #F26A21;
            --button-end: #F8B11A;
            --bg: #F6E8D5;
            --card: #F3DFC4;
            --glow: #F5C57A;
            --light: #FDE3CF;
            --dark: #3d2a18;
            --glass: rgba(255, 255, 255, 0.26);
            --glass-border: rgba(255, 255, 255, 0.45);
            --shadow-strong: 0 20px 60px rgba(0, 0, 0, 0.18);
            --shadow-soft: 0 8px 24px rgba(0, 0, 0, 0.12);
            --radius-lg: 22px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Space Grotesk', 'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            color: var(--dark);
            background: var(--bg);
            position: relative;
            overflow-x: hidden;
            padding: 28px 18px 56px;
        }

        /* soft grain */
        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='160' height='160' viewBox='0 0 160 160'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.8' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='.08'/%3E%3C/svg%3E");
            pointer-events: none;
            mix-blend-mode: soft-light;
            z-index: 0;
        }

        .layout {
            max-width: 1180px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        /* Top bar */
        .topbar {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            align-items: center;
            width: 100%;
            margin-bottom: 32px;
        }

        .brand {
            justify-self: center;
            font-weight: 700;
            font-size: clamp(1.4rem, 2vw, 1.8rem);
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--dark);
        }

        .menu-btn {
            justify-self: end;
            width: 46px;
            height: 46px;
            border-radius: 14px;
            border: 1px solid var(--glass-border);
            background: var(--glass);
            backdrop-filter: blur(8px);
            box-shadow: var(--shadow-soft);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: transform 0.18s ease, box-shadow 0.18s ease, border-color 0.18s ease;
        }

        .menu-btn span,
        .menu-btn span::before,
        .menu-btn span::after {
            display: block;
            width: 18px;
            height: 2px;
            background: var(--dark);
            border-radius: 12px;
            position: relative;
            transition: transform 0.22s ease, width 0.22s ease;
        }

        .menu-btn span::before,
        .menu-btn span::after {
            content: "";
            position: absolute;
            left: 0;
        }

        .menu-btn span::before { top: -6px; }
        .menu-btn span::after { top: 6px; }

        .menu-btn:hover {
            transform: translateY(-2px);
            border-color: rgba(255, 255, 255, 0.42);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.22);
        }

        /* Hero */
        .hero {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 28px;
            align-items: center;
        }

        .hero-card {
            background: var(--card);
            border: 1px solid var(--glass-border);
            border-radius: 28px;
            padding: clamp(22px, 3vw, 32px);
            backdrop-filter: blur(18px);
            box-shadow: var(--shadow-strong);
            position: relative;
            overflow: hidden;
        }

        .hero-card::after {
            content: "";
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 20% 20%, rgba(245, 197, 122, 0.25), transparent 55%),
                        radial-gradient(circle at 80% 0%, rgba(245, 197, 122, 0.18), transparent 45%);
            pointer-events: none;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 14px;
            border-radius: 999px;
            border: 1px solid var(--glass-border);
            background: var(--glass);
            font-size: 0.88rem;
            letter-spacing: 0.01em;
        }

        h1 {
            font-size: clamp(2rem, 4vw, 2.8rem);
            line-height: 1.1;
            margin: 14px 0 10px;
            color: var(--dark);
        }

        .subhead {
            font-size: 1.02rem;
            color: var(--dark);
            max-width: 34ch;
            margin-bottom: 18px;
        }

        .cta-stack {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 12px;
    margin: 18px 0 10px;
    width: 100%;
}

.cta-stack a {
    width: 100%;
    text-align: center;
}


        .glass-btn {
            padding: 14px 18px;
            border-radius: var(--radius-lg);
            border: 1px solid var(--glass-border);
            background: var(--glass);
            color: var(--dark);
            font-weight: 700;
            font-size: 1rem;
            text-decoration: none;
            backdrop-filter: blur(12px);
            box-shadow: var(--shadow-soft);
            transition: transform 0.18s ease, box-shadow 0.18s ease, background 0.18s ease, border-color 0.18s ease;
            text-align: center;
            display : block;
        }
        

        .glass-btn:hover {
            transform: translateY(-2px);
            background: rgba(255, 255, 255, 0.18);
            border-color: rgba(255, 255, 255, 0.5);
            box-shadow: 0 18px 38px rgba(0, 0, 0, 0.24);
        }

        .glass-btn.primary {
            background: linear-gradient(120deg, var(--button-start), var(--button-end));
            color: white;
        }

        .glass-btn.primary:hover {
            background: linear-gradient(120deg, rgba(255, 255, 255, 0.26), rgba(255, 230, 200, 0.3));
        }

        .logo-stack {
            display: grid;
            gap: 18px;
            justify-items: center;
            text-align: center;
        }

        .logo-mark {
            width: clamp(140px, 22vw, 190px);
            aspect-ratio: 1;
            border-radius: 32px;
            background: linear-gradient(135deg, var(--button-start), var(--button-end));
            box-shadow: 0 24px 60px rgba(0, 0, 0, 0.28);
            display: grid;
            place-items: center;
            position: relative;
            overflow: hidden;
        }

        .logo-mark::after {
            content: "";
            position: absolute;
            inset: 12%;
            border-radius: 24px;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(12px);
        }

        .logo-text {
            position: relative;
            font-weight: 800;
            font-size: clamp(2rem, 4vw, 2.6rem);
            letter-spacing: 0.08em;
            color: var(--dark);
            text-shadow: 0 10px 24px rgba(0, 0, 0, 0.28);
        }

        .meta {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            justify-content: center;
            color: var(--dark);
            font-weight: 600;
        }

        .chip {
            padding: 8px 14px;
            background: var(--glass);
            border-radius: 12px;
            border: 1px solid var(--glass-border);
        }

        .features {
            margin-top: 46px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 16px;
        }

        .feature-card {
            background: var(--glass);
            border: 1px solid var(--glass-border);
            border-radius: 18px;
            padding: 16px 18px;
            backdrop-filter: blur(10px);
            box-shadow: var(--shadow-soft);
            color: var(--dark);
            display: flex;
            gap: 12px;
            align-items: flex-start;
            transition: transform 0.18s ease, box-shadow 0.18s ease, border-color 0.18s ease;
        }

        .feature-card:hover {
            transform: translateY(-4px);
            border-color: rgba(255, 255, 255, 0.36);
            box-shadow: 0 16px 38px rgba(0, 0, 0, 0.22);
        }

        .feature-icon {
            width: 44px;
            height: 44px;
            border-radius: 14px;
            background: var(--glass);
            display: grid;
            place-items: center;     
            font-size: 1.35rem;
        }

        .feature-title {
            margin: 2px 0 6px;
            font-weight: 700;
            font-size: 1rem;
        }

        .feature-copy {
            color: var(--dark);
            font-size: 0.94rem;
            line-height: 1.5;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            color: var(--dark);
            font-size: 0.95rem;
            opacity: 0.9;
        }

        @media (min-width: 900px) {
    body {
        padding: 42px 36px 72px;
    }
    .hero {
        grid-template-columns: 1.05fr 0.95fr;
        gap: 34px;
    }
}


        @media (max-width: 520px) {
            .topbar {
                grid-template-columns: auto 1fr auto;
            }
            .brand {
                justify-self: center;
            }
            h1 {
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body>
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
    <a class="glass-btn primary" href="{{ url('/dashboard') }}">Go to Dashboard</a>
</div>

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