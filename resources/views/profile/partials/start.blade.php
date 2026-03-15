<section class="fb-hero">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Manrope:wght@600;700&display=swap');

        .fb-hero {
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 2.5rem 1.5rem;
            background: radial-gradient(circle at 20% 20%, #ffd166 0, #ffb347 20%, transparent 45%),
                        radial-gradient(circle at 80% 10%, #ff914d 0, #ff6f3c 22%, transparent 48%),
                        linear-gradient(150deg, #ffdf8c 0%, #ffad42 35%, #ff7a2f 75%, #f95d40 100%);
            color: #2d1a04;
            font-family: 'Manrope', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            position: relative;
            overflow: hidden;
        }

        .fb-hero::before,
        .fb-hero::after {
            content: '';
            position: absolute;
            width: 28rem;
            height: 28rem;
            border-radius: 50%;
            filter: blur(70px);
            opacity: 0.35;
            z-index: 0;
        }

        .fb-hero::before { background: #fff2c9; top: -8rem; left: -10rem; }
        .fb-hero::after { background: #ff9a62; bottom: -10rem; right: -8rem; }

        .fb-shell {
            width: min(420px, 100%);
            background: rgba(255, 255, 255, 0.14);
            border: 1px solid rgba(255, 255, 255, 0.35);
            border-radius: 28px;
            box-shadow: 0 24px 60px rgba(255, 122, 47, 0.28), inset 0 1px 1px rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            padding: 2.75rem 2.1rem;
            position: relative;
            isolation: isolate;
        }

        .fb-topbar {
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            margin-bottom: 2.25rem;
        }

        .fb-menu {
            position: absolute;
            right: 0;
            top: 50%;
            translate: 0 -50%;
            width: 46px;
            height: 46px;
            border-radius: 14px;
            border: 1px solid rgba(255, 255, 255, 0.45);
            background: rgba(255, 255, 255, 0.16);
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.12), inset 0 1px 1px rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(12px);
            display: grid;
            place-items: center;
            cursor: pointer;
            transition: transform 180ms ease, box-shadow 220ms ease, background 180ms ease;
        }

        .fb-menu:hover { transform: translateY(-2px); background: rgba(255, 255, 255, 0.2); }
        .fb-menu:active { transform: translateY(1px) scale(0.98); }

        .fb-menu span {
            display: block;
            width: 18px;
            height: 2px;
            background: #2d1a04;
            border-radius: 999px;
            box-shadow: 0 6px #2d1a04, 0 -6px #2d1a04;
        }

        .fb-title {
            font-size: 1.8rem;
            font-weight: 800;
            letter-spacing: 0.04em;
            color: #2b1802;
            text-transform: uppercase;
            text-shadow: 0 12px 26px rgba(0, 0, 0, 0.15);
        }

        .fb-logo {
            width: 136px;
            height: 136px;
            border-radius: 32px;
            margin: 0 auto 1.8rem;
            background: conic-gradient(from 210deg, #ffdf8c 0deg, #ffb347 120deg, #ff7a2f 240deg, #ffdf8c 360deg);
            position: relative;
            box-shadow: 0 18px 45px rgba(249, 93, 64, 0.35), inset 0 1px 0 rgba(255, 255, 255, 0.85);
        }

        .fb-logo::after {
            content: '🚴‍♂️';
            position: absolute;
            inset: 0;
            display: grid;
            place-items: center;
            font-size: 4.25rem;
            text-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .fb-subtitle {
            text-align: center;
            font-size: 1rem;
            font-weight: 600;
            color: rgba(45, 26, 4, 0.75);
            margin-bottom: 1.5rem;
        }

        .fb-actions {
            display: flex;
            flex-direction: column;
            gap: 0.85rem;
            margin-top: 0.75rem;
        }

        .fb-btn {
            position: relative;
            width: 100%;
            padding: 0.95rem 1.1rem;
            border-radius: 18px;
            border: 1px solid rgba(255, 255, 255, 0.5);
            background: rgba(255, 255, 255, 0.16);
            color: #2d1a04;
            font-weight: 700;
            font-size: 1rem;
            letter-spacing: 0.01em;
            text-align: center;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.7), 0 16px 40px rgba(0, 0, 0, 0.14);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            cursor: pointer;
            transition: transform 160ms ease, box-shadow 200ms ease, border-color 200ms ease, background 200ms ease;
            overflow: hidden;
        }

        .fb-btn::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(120deg, rgba(255, 255, 255, 0.45), rgba(255, 255, 255, 0));
            opacity: 0;
            transition: opacity 200ms ease;
        }

        .fb-btn:hover {
            transform: translateY(-2px);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.9), 0 18px 44px rgba(249, 93, 64, 0.32);
            border-color: rgba(255, 255, 255, 0.7);
        }

        .fb-btn:hover::before { opacity: 1; }
        .fb-btn:active { transform: translateY(1px) scale(0.99); }

        .fb-btn--primary {
            background: rgba(255, 255, 255, 0.26);
            color: #1f1201;
        }

        .fb-floating {
            position: absolute;
            inset: -60px;
            pointer-events: none;
            opacity: 0.5;
        }

        .fb-chip {
            position: absolute;
            padding: 0.4rem 0.9rem;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.18);
            border: 1px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.12);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            font-size: 0.85rem;
            font-weight: 700;
            color: #2d1a04;
            animation: float 7s ease-in-out infinite;
        }

        .fb-chip:nth-child(1) { top: 12%; left: 10%; animation-delay: -1s; }
        .fb-chip:nth-child(2) { bottom: 8%; right: 16%; animation-delay: -2s; }
        .fb-chip:nth-child(3) { top: 26%; right: 10%; animation-delay: -3.2s; }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        @media (max-width: 480px) {
            .fb-shell { padding: 2.25rem 1.75rem; border-radius: 24px; }
            .fb-title { font-size: 1.6rem; }
            .fb-logo { width: 118px; height: 118px; border-radius: 26px; }
        }
    </style>

    <div class="fb-shell">
        <div class="fb-topbar">
            <div class="fb-title">FastBites</div>
            <button class="fb-menu" aria-label="Open menu">
                <span></span>
            </button>
        </div>

        <div class="fb-logo" aria-hidden="true"></div>
        <p class="fb-subtitle">Premium deliveries, crafted with speed and care.</p>

        <div class="fb-actions">
            <button class="fb-btn fb-btn--primary">Log In</button>
            <button class="fb-btn">Sign Up</button>
        </div>

        <div class="fb-floating" aria-hidden="true">
            <div class="fb-chip">15 min avg</div>
            <div class="fb-chip">New: Sunset Bowls</div>
            <div class="fb-chip">Live order tracking</div>
        </div>
    </div>
</section>
