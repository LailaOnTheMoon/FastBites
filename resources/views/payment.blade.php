<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment — FastBites</title>

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --main-bg: #F6E8D5;
            --corner-glow: #F5C57A;
            --card-bg: #F3DFC4;
            --button-gradient: linear-gradient(90deg, #F26A21 0%, #F8B11A 100%);
            --text-dark: #4f3f2f;
            --text-muted: #6f5c47;
            --input-bg: #fffdf9;
            --radius: 25px;
            --shadow-soft: 0 12px 28px rgba(41, 18, 3, 0.15);
            --shadow-deep: 0 18px 40px rgba(30, 19, 6, 0.24);
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Space Grotesk', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            color: var(--text-dark);
            background: radial-gradient(circle at 15% 25%, rgba(245,197,122,0.35) 0%, transparent 45%),
                        radial-gradient(circle at 85% 85%, rgba(245,197,122,0.30) 0%, transparent 48%),
                        var(--main-bg);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            width: min(420px, calc(100% - 32px));
            margin: 0;
        }

        .header {
            text-align: center;
            margin-bottom: 22px;
        }

        .header h1 {
            margin: 0;
            font-size: clamp(1.9rem, 6vw, 2.6rem);
            font-weight: 800;
            color: #8d5b2f;
            letter-spacing: 0.04em;
        }

        .header p {
            margin: 10px 0 0;
            font-size: 1rem;
            color: var(--text-muted);
        }

        .login-card {
            background: var(--card-bg);
            border-radius: var(--radius);
            box-shadow: var(--shadow-deep);
            padding: 30px 26px 28px;
            border: 1px solid rgba(255, 255, 255, 0.45);
            backdrop-filter: blur(4px);
            color: var(--text-dark);
        }

        .login-card h2 {
            margin: 0 0 16px;
            font-size: 1.75rem;
            letter-spacing: 0.02em;
        }

        .login-card p {
            margin: 0 0 20px;
            font-size: 0.97rem;
            color: var(--text-muted);
        }

        .field {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 16px;
        }

        .field label {
            font-weight: 500;
            color: #8a664a;
            font-size: 0.9rem;
        }

        .field input {
            width: 100%;
            border: 1px solid rgba(131, 92, 50, 0.25);
            border-radius: 14px;
            padding: 13px 14px;
            font-size: 1rem;
            background: var(--input-bg);
            color: #483424;
            box-shadow: 0 8px 16px rgba(31, 15, 5, 0.07);
            transition: border .2s ease, box-shadow .2s ease;
        }

        .field input:focus {
            outline: none;
            border-color: #f26a21;
            box-shadow: 0 0 0 4px rgba(242,106,33,0.12);
        }

        .btn-login {
            width: 100%;
            border: none;
            border-radius: 16px;
            padding: 14px 0;
            color: #ffffff;
            font-size: 1.05rem;
            font-weight: 700;
            cursor: pointer;
            background: var(--button-gradient);
            box-shadow: 0 12px 24px rgba(242, 106, 33, 0.35);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 28px rgba(242, 106, 33, 0.42);
        }

        .btn-login:active {
            transform: translateY(0px);
            box-shadow: 0 9px 18px rgba(242, 106, 33, 0.35);
        }

        @media (max-width: 620px) {
            .login-card {
                padding: 24px;
            }

            .field input {
                font-size: 0.98rem;
            }
        }

    </style>
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

    <script>
        document.getElementById('loginForm').addEventListener('submit', (e) => {
            e.preventDefault();

            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value;

            if (!email || !password) {
                alert('Please fill in both email and password.');
                return;
            }

            // Temporary behavior; implement actual authentication endpoint logic.
            alert(`Signed in with ${email}. Redirecting...`);
            // window.location.href = '/dashboard';
        });
    </script>
</body>
</html>
