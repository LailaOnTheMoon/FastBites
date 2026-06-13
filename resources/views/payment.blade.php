<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment — FastBites</title>

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #FFF8F0 0%, rgba(255, 140, 0, 0.05) 100%);
            color: #1a1a1a;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ========== NAVBAR ========== */
        header.navbar {
            background: white;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .navbar-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }

        .logo-section {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            cursor: pointer;
        }

        .logo-img {
            width: 40px;
            height: 40px;
            object-fit: contain;
        }

        .logo-text {
            font-size: 1.3rem;
            font-weight: 700;
            color: #FF8C00;
            font-family: 'Poppins', sans-serif;
        }

        .breadcrumb {
            display: flex;
            gap: 0.5rem;
            align-items: center;
            color: #999;
            font-size: 0.9rem;
        }

        .breadcrumb a {
            color: #FF8C00;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .breadcrumb a:hover {
            color: #FF7A00;
        }

        .breadcrumb-separator {
            color: #ddd;
        }

        /* ========== MAIN CONTAINER ========== */
        .main-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem 2rem;
        }

        /* ========== PAYMENT CARD ========== */
        .payment-card {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 12px 48px rgba(0, 0, 0, 0.12);
            width: 100%;
            max-width: 500px;
        }

        .card-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .card-header h1 {
            font-family: 'Poppins', sans-serif;
            font-size: 2rem;
            font-weight: 800;
            color: #1a1a1a;
            margin-bottom: 0.75rem;
            letter-spacing: -0.5px;
        }

        .card-header p {
            color: #777;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
        }

        /* ========== PAYMENT FORM ========== */
        .payment-form {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .payment-options {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .payment-option {
            position: relative;
        }

        .payment-option input[type="radio"] {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        .payment-option label {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1.5rem;
            background: #f9f9f9;
            border: 2px solid transparent;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
            color: #555;
        }

        .payment-option input[type="radio"]:checked + label {
            background: linear-gradient(135deg, rgba(255, 140, 0, 0.1) 0%, rgba(255, 140, 0, 0.05) 100%);
            border-color: #FF8C00;
            color: #1a1a1a;
            font-weight: 600;
        }

        .payment-option input[type="radio"]:hover + label {
            border-color: #FFD580;
            background: #fafafa;
        }

        /* Custom Radio Button */
        .radio-custom {
            width: 24px;
            height: 24px;
            border: 2px solid #ddd;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            flex-shrink: 0;
        }

        .payment-option input[type="radio"]:checked + label .radio-custom {
            border-color: #FF8C00;
            background: #FF8C00;
            box-shadow: 0 0 0 4px rgba(255, 140, 0, 0.1);
        }

        .radio-custom::after {
            content: '✓';
            color: white;
            font-weight: bold;
            font-size: 14px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .payment-option input[type="radio"]:checked + label .radio-custom::after {
            opacity: 1;
        }

        /* ========== INFO BOX ========== */
        .info-box {
            background: linear-gradient(135deg, rgba(255, 212, 128, 0.2) 0%, rgba(255, 212, 128, 0.1) 100%);
            border-left: 4px solid #FFD580;
            padding: 1.2rem;
            border-radius: 8px;
            margin-bottom: 1rem;
        }

        .info-box p {
            color: #666;
            font-size: 0.9rem;
            line-height: 1.5;
            margin: 0;
        }

        .info-box strong {
            color: #FF8C00;
            font-weight: 600;
        }

        /* ========== BUTTONS ========== */
        .button-group {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
            flex-wrap: wrap;
        }

        .btn-back {
            background: white;
            color: #FF8C00;
            border: 2px solid #FF8C00;
            padding: 1rem 2rem;
            border-radius: 12px;
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            flex: 1;
            min-width: 150px;
        }

        .btn-back:hover {
            background: #FFF8F0;
            transform: translateX(-2px);
        }

        .btn-continue {
            background: linear-gradient(135deg, #FF8C00 0%, #FF7A00 100%);
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 12px;
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 6px 20px rgba(255, 140, 0, 0.3);
            flex: 1;
            min-width: 150px;
        }

        .btn-continue:hover:not(:disabled) {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(255, 140, 0, 0.4);
        }

        .btn-continue:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none;
        }

        /* ========== LOADING STATE ========== */
        .btn-continue.loading {
            position: relative;
            color: transparent;
        }

        .btn-continue.loading::after {
            content: '';
            position: absolute;
            width: 16px;
            height: 16px;
            top: 50%;
            left: 50%;
            margin-left: -8px;
            margin-top: -8px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* ========== PAYMENT METHOD ICONS ========== */
        .payment-icon {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        /* ========== RESPONSIVE ========== */
        @media (max-width: 768px) {
            .navbar-container {
                padding: 1rem 1.5rem;
            }

            .main-container {
                padding: 2rem 1.5rem;
                align-items: flex-start;
                margin-top: 1rem;
            }

            .payment-card {
                padding: 2rem;
            }

            .card-header h1 {
                font-size: 1.6rem;
            }

            .button-group {
                flex-direction: column;
            }

            .btn-back,
            .btn-continue {
                width: 100%;
                margin: 0;
            }

            .breadcrumb {
                display: none;
            }
        }
    </style>
</head>
<body>

<!-- ================= NAVBAR ================= -->
<header class="navbar">
    <div class="navbar-container">
        <a href="/" class="logo-section">
            <img src="{{ asset('images/logo.png') }}" alt="Fast Bites Logo" class="logo-img">
            <span class="logo-text">Fast Bites</span>
        </a>
        <nav class="breadcrumb">
            <a href="/">Home</a>
            <span class="breadcrumb-separator">/</span>
            <a href="/restaurants">Restaurants</a>
            <span class="breadcrumb-separator">/</span>
            <span>Payment</span>
        </nav>
    </div>
</header>

<!-- ================= MAIN CONTENT ================= -->
<div class="main-container">
    <!-- ========== PAYMENT CARD ========== -->
    <div class="payment-card">
        <!-- Card Header -->
        <div class="card-header">
            <h1>Payment Method</h1>
            <p>Select your preferred payment method to complete your order</p>
        </div>

        <!-- Payment Form -->
        <form class="payment-form" id="paymentForm">
            <!-- Info Box -->
            <div class="info-box">
                <p>Your order is ready! Choose a payment method to complete your purchase securely.</p>
            </div>

            <!-- Payment Options -->
            <div class="payment-options">
                <!-- Cash on Delivery Option -->
                <div class="payment-option">
                    <input type="radio" name="payment" value="cash" id="cash-option">
                    <label for="cash-option">
                        <div class="radio-custom"></div>
                        <div class="payment-icon">💵</div>
                        <div>
                            <div style="font-weight: 600; color: #1a1a1a;">Cash on Delivery</div>
                            <div style="font-size: 0.85rem; color: #999; margin-top: 0.2rem;">Pay when your order arrives</div>
                        </div>
                    </label>
                </div>

                <!-- Card Payment Option -->
                <div class="payment-option">
                    <input type="radio" name="payment" value="card" id="card-option">
                    <label for="card-option">
                        <div class="radio-custom"></div>
                        <div class="payment-icon">💳</div>
                        <div>
                            <div style="font-weight: 600; color: #1a1a1a;">Pay with Card</div>
                            <div style="font-size: 0.85rem; color: #999; margin-top: 0.2rem;">Secure online payment with debit or credit card</div>
                        </div>
                    </label>
                </div>

                <!-- Digital Wallet Option (Optional) -->
                <div class="payment-option">
                    <input type="radio" name="payment" value="wallet" id="wallet-option">
                    <label for="wallet-option">
                        <div class="radio-custom"></div>
                        <div class="payment-icon">📱</div>
                        <div>
                            <div style="font-weight: 600; color: #1a1a1a;">Digital Wallet</div>
                            <div style="font-size: 0.85rem; color: #999; margin-top: 0.2rem;">Fast checkout with your wallet app</div>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="button-group">
                <button type="button" class="btn-back" onclick="window.history.back()">
                    Go Back
                </button>
                <button type="button" class="btn-continue" id="continueBtn" onclick="continuePayment()">
                    Continue
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    const paymentForm = document.getElementById('paymentForm');
    const continueBtn = document.getElementById('continueBtn');
    const radioButtons = document.querySelectorAll('input[name="payment"]');

    // Enable/disable button based on selection
    radioButtons.forEach(radio => {
        radio.addEventListener('change', () => {
            continueBtn.disabled = false;
        });
    });

    function continuePayment() {
        const selected = document.querySelector('input[name="payment"]:checked');

        if (!selected) {
            showError("Please select a payment method.");
            return;
        }

        // Disable button during processing
        continueBtn.disabled = true;
        continueBtn.classList.add('loading');

        // Simulate processing
        setTimeout(() => {
            if (selected.value === "cash") {
                showSuccess("Thank you! Your order has been placed successfully. We'll collect payment upon delivery.");
                // setTimeout(() => {
                //     window.location.href = "/order-confirmation";
                // }, 2000);
            } else if (selected.value === "card") {
                window.location.href = "/carddetailes";
            } else if (selected.value === "wallet") {
                showSuccess("Redirecting to wallet payment...");
                // setTimeout(() => {
                //     window.location.href = "/wallet-payment";
                // }, 2000);
            }
        }, 500);
    }

    function showError(message) {
        // Create alert (you can replace with custom modal if needed)
        const tempDiv = document.createElement('div');
        tempDiv.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: #ff6b6b;
            color: white;
            padding: 1rem 1.5rem;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            z-index: 1000;
            animation: slideIn 0.3s ease;
            font-weight: 600;
        `;
        tempDiv.textContent = message;
        document.body.appendChild(tempDiv);
        setTimeout(() => tempDiv.remove(), 3000);
    }

    function showSuccess(message) {
        const tempDiv = document.createElement('div');
        tempDiv.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: #51cf66;
            color: white;
            padding: 1rem 1.5rem;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            z-index: 1000;
            animation: slideIn 0.3s ease;
            font-weight: 600;
        `;
        tempDiv.textContent = message;
        document.body.appendChild(tempDiv);
        setTimeout(() => tempDiv.remove(), 3000);
    }

    // Add slide-in animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideIn {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
    `;
    document.head.appendChild(style);
</script>

</body>
</html>