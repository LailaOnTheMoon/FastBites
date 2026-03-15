<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FastBites | Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --orange: #ffa500;
            --yellow: #ffd700;
            --glass-bg: rgba(255, 255, 255, 0.14);
            --glass-border: rgba(255, 255, 255, 0.28);
            --text-main: #1a1a1a;
            --text-subtle: rgba(26, 26, 26, 0.7);
            --shadow: 0 20px 50px rgba(0, 0, 0, 0.18);
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Poppins', 'Inter', system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
            color: var(--text-main);
            background: radial-gradient(circle at 20% 20%, rgba(255, 213, 102, 0.55), transparent 35%),
                        radial-gradient(circle at 80% 0%, rgba(255, 165, 0, 0.45), transparent 32%),
                        linear-gradient(135deg, #ffb347 0%, #ffcc33 40%, #ffd700 75%, #ffa500 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .accent {
            position: absolute;
            width: 380px;
            height: 380px;
            border-radius: 50%;
            filter: blur(90px);
            opacity: 0.65;
            z-index: 0;
        }

        .accent.orange { background: #ff9d2f; top: -120px; left: -80px; }
        .accent.yellow { background: #ffe27a; bottom: -120px; right: -60px; }

        .frame {
            position: relative;
            width: min(440px, 90vw);
            padding: 48px 40px 42px;
            border-radius: 28px;
            background: rgba(255, 255, 255, 0.22);
            border: 1px solid var(--glass-border);
            backdrop-filter: blur(18px);
            box-shadow: var(--shadow);
            z-index: 1;
            overflow: hidden;
        }

        .frame::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: inherit;
            padding: 1px;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.75), rgba(255, 255, 255, 0));
            mask: linear-gradient(#000, #000) content-box, linear-gradient(#000, #000);
            mask-composite: exclude;
            pointer-events: none;
        }

        .brand {
            text-align: center;
            margin-bottom: 28px;
        }

        .brand__name {
            letter-spacing: 0.4px;
            font-weight: 700;
            font-size: clamp(26px, 4vw, 32px);
        }

        .logo {
            width: 96px;
            height: 96px;
            margin: 0 auto 28px;
            border-radius: 24px;
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.85), rgba(255, 255, 255, 0.18));
            border: 1px solid var(--glass-border);
            backdrop-filter: blur(14px);
            box-shadow: 0 16px 30px rgba(255, 165, 0, 0.25), 0 10px 20px rgba(0, 0, 0, 0.12);
            display: grid;
            place-items: center;
            transition: transform 250ms ease, box-shadow 250ms ease;
        }

        .logo:hover {
            transform: translateY(-2px) scale(1.01);
            box-shadow: 0 22px 40px rgba(255, 165, 0, 0.32), 0 12px 22px rgba(0, 0, 0, 0.14);
        }

        .logo svg { width: 52px; height: 52px; }

        .form {
            display: grid;
            gap: 16px;
        }

        .input {
            width: 100%;
            padding: 14px 16px 14px 18px;
            border-radius: 18px;
            border: 1px solid var(--glass-border);
            background: var(--glass-bg);
            color: var(--text-main);
            font-size: 15px;
            outline: none;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(10px);
            transition: transform 180ms ease, box-shadow 220ms ease, border-color 200ms ease;
        }

        .input::placeholder { color: var(--text-subtle); }

        .input:focus {
            border-color: rgba(255, 255, 255, 0.75);
            box-shadow: 0 10px 25px rgba(255, 165, 0, 0.18);
            transform: translateY(-1px);
        }

        .btn {
            margin-top: 4px;
            width: 100%;
            padding: 14px 18px;
            border-radius: 18px;
            border: 1px solid var(--glass-border);
            background: linear-gradient(135deg, rgba(255, 168, 0, 0.8), rgba(255, 215, 0, 0.9));
            color: #1a1a1a;
            font-weight: 700;
            letter-spacing: 0.25px;
            cursor: pointer;
            backdrop-filter: blur(10px);
            box-shadow: 0 16px 30px rgba(255, 165, 0, 0.3), 0 8px 14px rgba(0, 0, 0, 0.12);
            transition: transform 180ms ease, box-shadow 220ms ease;
        }

        .btn:hover {
            transform: translateY(-2px) scale(1.01);
            box-shadow: 0 20px 36px rgba(255, 165, 0, 0.35), 0 10px 16px rgba(0, 0, 0, 0.14);
        }

        .btn:active { transform: translateY(0); }

        .helper {
            margin-top: 10px;
            text-align: center;
            font-size: 14px;
            color: var(--text-subtle);
        }

        .link-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-left: 6px;
            padding: 10px 14px;
            border-radius: 14px;
            border: 1px solid var(--glass-border);
            background: var(--glass-bg);
            color: var(--text-main);
            font-weight: 600;
            text-decoration: none;
            backdrop-filter: blur(10px);
            transition: transform 180ms ease, box-shadow 220ms ease, border-color 200ms ease;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.35), 0 10px 18px rgba(255, 165, 0, 0.18);
        }

        .link-btn:hover {
            border-color: rgba(255, 255, 255, 0.75);
            transform: translateY(-1px) scale(1.01);
            box-shadow: 0 14px 22px rgba(255, 165, 0, 0.24);
        }

        .link-btn span {
            display: inline-block;
            transform: translateY(1px);
        }

        @media (max-width: 640px) {
            .frame {
                padding: 36px 26px 32px;
                border-radius: 22px;
            }

            .logo { width: 84px; height: 84px; border-radius: 20px; }
            .logo svg { width: 46px; height: 46px; }
        }
    </style>
</head>
<body>
    <div class="accent orange"></div>
    <div class="accent yellow"></div>

    <div class="frame">
        <div class="brand">
            <div class="brand__name">FastBites</div>
        </div>

        <div class="logo" aria-hidden="true">
            <svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="10" y="18" width="44" height="22" rx="6" fill="url(#paint0)"/>
                <path d="M15 18h34" stroke="#ff9d2f" stroke-width="2.5" stroke-linecap="round" opacity="0.9"/>
                <path d="M16 40h32" stroke="#c06d00" stroke-width="2" stroke-linecap="round" opacity="0.65"/>
                <path d="M19 46c1.5-2 5-3 7-3h12c3 0 8 1 9 3" stroke="#e09b00" stroke-width="3" stroke-linecap="round"/>
                <circle cx="22" cy="46" r="4" fill="#1a1a1a"/>
                <circle cx="42" cy="46" r="4" fill="#1a1a1a"/>
                <defs>
                    <linearGradient id="paint0" x1="10" y1="18" x2="54" y2="40" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#ffd700" stop-opacity="0.92"/>
                        <stop offset="1" stop-color="#ffa500" stop-opacity="0.95"/>
                    </linearGradient>
                </defs>
            </svg>
        </div>

        <form method="POST" action="{{ route('login') }}" class="form">
            @csrf
            <input type="text" name="username" class="input" placeholder="Username" required autocomplete="username">
            <input type="password" name="password" class="input" placeholder="Password" required autocomplete="current-password">
            <button type="submit" class="btn">Sign In</button>
        </form>

        <div class="helper">
            Don't have an account?
            <a href="{{ route('register') }}" class="link-btn">
                <span>Sign Up</span>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5 12h14m0 0-5-5m5 5-5 5" stroke="#1a1a1a" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        </div>
    </div>
</body>
</html>
