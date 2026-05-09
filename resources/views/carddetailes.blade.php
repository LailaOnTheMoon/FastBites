<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Card Details — FastBites</title>

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
      <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">


    
</head>
 <style>
        .payment-card {
            background: var(--glass);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-lg);
            backdrop-filter: blur(14px);
            box-shadow: var(--shadow-strong);
            padding: 32px;
            max-width: 520px;
            margin: 50px auto;
        }

        .payment-title {
            text-align: center;
            margin-bottom: 10px;
            font-size: 2rem;
            font-weight: 700;
            color: var(--button-end);
        }

        .payment-subtitle {
            text-align: center;
            margin-bottom: 30px;
            opacity: 0.8;
        }

        .field {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 18px;
        }

        .field label {
            font-weight: 600;
        }

        .field input {
            padding: 14px 16px;
            border-radius: 16px;
            border: 1px solid var(--glass-border);
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(8px);
            color: var(--dark);
            font-size: 1rem;
        }

        .field input:focus {
            outline: none;
            border-color: var(--button-start);
            box-shadow: 0 0 0 4px rgba(242,106,33,0.12);
        }

        .card-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .pay-btn {
            width: 100%;
            margin-top: 10px;
            padding: 15px;
            border: none;
            border-radius: 18px;
            background: linear-gradient(
                135deg,
                var(--button-start),
                var(--button-end)
            );
            color: white;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            box-shadow: var(--shadow-soft);
            transition: 0.2s;
        }

        .pay-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 16px 30px rgba(0,0,0,0.18);
        }

        @media (max-width: 600px) {
            .payment-card {
                padding: 24px;
            }

            .card-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
<body class="welcome-page">

    <div class="payment-card">

        <h1 class="payment-title">Card Payment</h1>

        <p class="payment-subtitle">
            Enter your card details securely to complete your order.
        </p>

        <form id="paymentForm">

    <div class="field">
        <label>Cardholder Name</label>
        <input type="text" placeholder="John Doe" required>
    </div>

    <div class="field">
        <label>Card Number</label>
        <input type="text" placeholder="1234 5678 9012 3456" required>
    </div>

    <div class="card-row">

        <div class="field">
            <label>Expiry Date</label>
            <input type="text" placeholder="MM/YY" required>
        </div>

        <div class="field">
            <label>CVV</label>
            <input type="password" placeholder="123" required>
        </div>

    </div>

    <button type="submit" class="pay-btn">
        Pay Now
    </button>

</form>

    </div>
<script>
document
    .getElementById("paymentForm")
    .addEventListener("submit", function(e) {

    e.preventDefault();

    alert("✅ Payment successful!\n\nYour order has been placed successfully.");

});
</script>
</body>
</html>
