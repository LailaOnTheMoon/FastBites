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
            max-width: 720px;
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

        .payment-options {
            display: grid;
            gap: 20px;
            margin-bottom: 32px;
        }

        .option {
            background: var(--light);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 24px;
            display: flex;
            align-items: center;
            gap: 18px;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
            border: 2px solid transparent;
        }

        .option:hover {
            transform: translateY(-4px);
            box-shadow: 0 18px 40px rgba(0, 0, 0, 0.22);
        }

        .option.selected {
            border-color: var(--amber);
            background: rgba(248, 169, 31, 0.1);
        }

        .option input[type="radio"] {
            width: 20px;
            height: 20px;
            accent-color: var(--orange);
            margin: 0;
        }

        .option-content {
            flex: 1;
        }

        .option-title {
            font-size: 1.2rem;
            font-weight: 700;
            margin: 0;
        }

        .option-desc {
            margin: 6px 0 0;
            font-size: 0.95rem;
            opacity: 0.8;
        }

        .btn-next {
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

        .btn-next:hover {
            transform: translateY(-2px);
            box-shadow: 0 18px 34px rgba(0, 0, 0, 0.2);
        }

        .btn-next:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        @media (max-width: 600px) {
            .option {
                flex-direction: column;
                text-align: center;
                gap: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="header">
            <h1>FastBites</h1>
            <p>Choose your payment method to complete the order.</p>
        </header>

        <form id="paymentForm">
            <div class="payment-options">
                <label class="option" for="card">
                    <input type="radio" id="card" name="payment" value="card" required>
                    <div class="option-content">
                        <h3 class="option-title">Credit/Debit Card</h3>
                        <p class="option-desc">Secure and instant payment via card. Visa, Mastercard, and more accepted.</p>
                    </div>
                </label>

                <label class="option" for="cash">
                    <input type="radio" id="cash" name="payment" value="cash" required>
                    <div class="option-content">
                        <h3 class="option-title">Cash on Delivery</h3>
                        <p class="option-desc">Pay in cash when your order arrives. No card needed.</p>
                    </div>
                </label>
            </div>

            <button type="submit" class="btn-next" id="nextBtn" disabled>Next</button>
        </form>
    </div>

    <script>
        const options = document.querySelectorAll('.option');
        const nextBtn = document.getElementById('nextBtn');

        options.forEach(option => {
            option.addEventListener('click', () => {
                options.forEach(opt => opt.classList.remove('selected'));
                option.classList.add('selected');
                nextBtn.disabled = false;
            });
        });

        document.getElementById('paymentForm').addEventListener('submit', (e) => {
            e.preventDefault();
            const selected = document.querySelector('input[name="payment"]:checked');
            if (selected) {
                alert(`Payment method selected: ${selected.value}`);
                // Here you can redirect or submit to backend
            }
        });
    </script>
</body>
</html>
