<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Card Details — FastBites</title>

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

        .card-form {
            background: var(--light);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 28px 24px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: 700;
            font-size: 1rem;
            margin-bottom: 8px;
            color: var(--dark);
        }

        .form-group input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            font-size: 1rem;
            font-family: inherit;
            transition: border-color 0.2s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--amber);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .btn-next {
            width: 100%;
            margin-top: 24px;
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

        .security-note {
            margin-top: 16px;
            font-size: 0.9rem;
            opacity: 0.7;
            text-align: center;
        }

        @media (max-width: 500px) {
            .form-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="header">
            <h1>FastBites</h1>
            <p>Enter your card details securely.</p>
        </header>

        <form class="card-form" id="cardForm">
            <div class="form-group">
                <label for="cardNumber">Card Number</label>
                <input type="text" id="cardNumber" name="cardNumber" placeholder="1234 5678 9012 3456" maxlength="19" required>
            </div>

            <div class="form-group">
                <label for="cardName">Name on Card</label>
                <input type="text" id="cardName" name="cardName" placeholder="John Doe" required>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="expiry">Expiry Date</label>
                    <input type="text" id="expiry" name="expiry" placeholder="MM/YY" maxlength="5" required>
                </div>

                <div class="form-group">
                    <label for="cvv">CVV</label>
                    <input type="text" id="cvv" name="cvv" placeholder="123" maxlength="4" required>
                </div>
            </div>

            <button type="submit" class="btn-next">Next</button>

            <p class="security-note">🔒 Your payment information is encrypted and secure.</p>
        </form>
    </div>

    <script>
        // Format card number with spaces
        document.getElementById('cardNumber').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\s+/g, '').replace(/[^0-9]/gi, '');
            let formatted = value.match(/.{1,4}/g)?.join(' ') || '';
            e.target.value = formatted;
        });

        // Format expiry date
        document.getElementById('expiry').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length >= 2) {
                value = value.slice(0, 2) + '/' + value.slice(2, 4);
            }
            e.target.value = value;
        });

        // Basic form validation
        document.getElementById('cardForm').addEventListener('submit', function(e) {
            e.preventDefault();
            // Add your validation or submission logic here
            alert('Card details submitted!');
        });
    </script>
</body>
</html>
