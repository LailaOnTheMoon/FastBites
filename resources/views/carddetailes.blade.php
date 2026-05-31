<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Card Payment — FastBites</title>

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
            max-width: 520px;
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

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.6rem;
        }

        .form-group label {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            color: #1a1a1a;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-group input {
            padding: 1rem;
            border: 2px solid #f0f0f0;
            border-radius: 12px;
            background: #fafafa;
            font-family: 'Inter', sans-serif;
            font-size: 1rem;
            color: #1a1a1a;
            transition: all 0.3s ease;
        }

        .form-group input::placeholder {
            color: #ccc;
        }

        .form-group input:focus {
            outline: none;
            border-color: #FF8C00;
            background: white;
            box-shadow: 0 0 0 4px rgba(255, 140, 0, 0.1);
        }

        /* ========== TWO COLUMN FORM ========== */
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }

        /* ========== CARD DISPLAY ========== */
        .card-display {
            background: linear-gradient(135deg, #FF8C00 0%, #FF7A00 100%);
            border-radius: 16px;
            padding: 1.5rem;
            color: white;
            margin-bottom: 1.5rem;
            box-shadow: 0 8px 24px rgba(255, 140, 0, 0.3);
            min-height: 200px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .card-display-chip {
            font-size: 2rem;
            width: 50px;
        }

        .card-display-number {
            font-family: 'Courier New', monospace;
            font-size: 1.5rem;
            letter-spacing: 2px;
            margin: 1rem 0;
        }

        .card-display-info {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }

        .card-display-name {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .card-display-expiry {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        /* ========== SECURITY INFO ========== */
        .security-info {
            background: linear-gradient(135deg, rgba(255, 212, 128, 0.2) 0%, rgba(255, 212, 128, 0.1) 100%);
            border-left: 4px solid #FFD580;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            color: #666;
        }

        .security-info strong {
            color: #FF8C00;
        }

        /* ========== BUTTONS ========== */
        .button-group {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .btn-back {
            background: white;
            color: #FF8C00;
            border: 2px solid #FF8C00;
            padding: 1rem;
            border-radius: 12px;
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            flex: 1;
        }

        .btn-back:hover {
            background: #FFF8F0;
            transform: translateX(-2px);
        }

        .btn-pay {
            background: linear-gradient(135deg, #FF8C00 0%, #FF7A00 100%);
            color: white;
            border: none;
            padding: 1rem;
            border-radius: 12px;
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 6px 20px rgba(255, 140, 0, 0.3);
            flex: 1;
        }

        .btn-pay:hover:not(:disabled) {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(255, 140, 0, 0.4);
        }

        .btn-pay:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none;
        }

        /* ========== LOADING STATE ========== */
        .btn-pay.loading {
            position: relative;
            color: transparent;
        }

        .btn-pay.loading::after {
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

            .form-row {
                grid-template-columns: 1fr;
            }

            .button-group {
                flex-direction: column;
            }

            .btn-back,
            .btn-pay {
                width: 100%;
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
            <span>Card Payment</span>
        </nav>
    </div>
</header>

<!-- ================= MAIN CONTENT ================= -->
<div class="main-container">
    <!-- ========== PAYMENT CARD ========== -->
    <div class="payment-card">
        <!-- Card Header -->
        <div class="card-header">
            <h1>Card Payment</h1>
            <p>Enter your card details securely to complete your order</p>
        </div>

        <!-- Security Info -->
        <div class="security-info">
            <strong>🔒 Secure Payment</strong> — Your payment information is encrypted and secure.
        </div>

        <!-- Card Display -->
        <div class="card-display">
            <div class="card-display-chip">💳</div>
            <div class="card-display-number" id="cardNumberDisplay">•••• •••• •••• ••••</div>
            <div class="card-display-info">
                <div>
                    <div style="font-size: 0.75rem; opacity: 0.8; margin-bottom: 0.2rem;">Card Holder</div>
                    <div class="card-display-name" id="cardNameDisplay">YOUR NAME</div>
                </div>
                <div>
                    <div style="font-size: 0.75rem; opacity: 0.8; margin-bottom: 0.2rem;">Expires</div>
                    <div class="card-display-expiry" id="cardExpiryDisplay">MM/YY</div>
                </div>
            </div>
        </div>

        <!-- Payment Form -->
        <form class="payment-form" id="paymentForm">
            <!-- Cardholder Name -->
            <div class="form-group">
                <label>Cardholder Name</label>
                <input type="text" placeholder="John Doe" id="cardholderName" required oninput="updateCardDisplay()">
            </div>

            <!-- Card Number -->
            <div class="form-group">
                <label>Card Number</label>
                <input type="text" placeholder="1234 5678 9012 3456" id="cardNumber" maxlength="19" required oninput="formatCardNumber(this); updateCardDisplay()">
            </div>

            <!-- Expiry and CVV -->
            <div class="form-row">
                <div class="form-group">
                    <label>Expiry Date</label>
                    <input type="text" placeholder="MM/YY" id="expiryDate" maxlength="5" required oninput="formatExpiry(this); updateCardDisplay()">
                </div>

                <div class="form-group">
                    <label>CVV</label>
                    <input type="password" placeholder="123" id="cvv" maxlength="4" required  style="width:100%;">
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="button-group">
                <button type="button" class="btn-back" onclick="window.history.back()">
                    Cancel
                </button>
                <button type="submit" class="btn-pay" id="payBtn">
                    Pay Now
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    const paymentForm = document.getElementById('paymentForm');
    const payBtn = document.getElementById('payBtn');

    // Format card number with spaces
    function formatCardNumber(input) {
        let value = input.value.replace(/\s+/g, '').replace(/[^\d]/g, '');
        let formatted = '';
        for (let i = 0; i < value.length; i++) {
            if (i > 0 && i % 4 === 0) formatted += ' ';
            formatted += value[i];
        }
        input.value = formatted;
    }

    // Format expiry date
    function formatExpiry(input) {
        let value = input.value.replace(/\D/g, '');
        if (value.length >= 2) {
            value = value.slice(0, 2) + '/' + value.slice(2, 4);
        }
        input.value = value;
    }

    // Update card display
    function updateCardDisplay() {
        const cardNumber = document.getElementById('cardNumber').value;
        const cardholderName = document.getElementById('cardholderName').value;
        const expiryDate = document.getElementById('expiryDate').value;

        // Update number (show last 4 digits)
        const lastFour = cardNumber.replace(/\s/g, '').slice(-4);
        const masked = '•••• •••• •••• ' + lastFour;
        document.getElementById('cardNumberDisplay').textContent = masked || '•••• •••• •••• ••••';

        // Update name
        document.getElementById('cardNameDisplay').textContent = cardholderName || 'YOUR NAME';

        // Update expiry
        document.getElementById('cardExpiryDisplay').textContent = expiryDate || 'MM/YY';
    }

    // Handle form submission
    paymentForm.addEventListener('submit', function(e) {
        e.preventDefault();

        // Validate
        const cardNumber = document.getElementById('cardNumber').value.replace(/\s/g, '');
        const cvv = document.getElementById('cvv').value;

        if (cardNumber.length !== 16) {
            showError('Please enter a valid 16-digit card number');
            return;
        }

        if (cvv.length < 3) {
            showError('Please enter a valid CVV');
            return;
        }

        // Disable button and show loading
        payBtn.disabled = true;
        payBtn.classList.add('loading');

        // Simulate payment processing
        setTimeout(() => {
            payBtn.disabled = false;
            payBtn.classList.remove('loading');
            showSuccess('✅ Payment Successful!\n\nYour order has been placed successfully. You will receive a confirmation shortly.');
            
            // Redirect after success
            setTimeout(() => {
                window.location.href = '/order-confirmation';
            }, 2500);
        }, 2000);
    });

    function showError(message) {
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
            white-space: pre-line;
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