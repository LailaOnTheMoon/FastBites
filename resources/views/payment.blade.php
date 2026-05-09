<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment — FastBites</title>

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
            <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

</head>
<body class="welcome-page">
<div class="container">

    <article class="login-card">

        <header class="header">
            <h1>FastBites</h1>
            <p>Select your preferred payment method to complete your order.</p>
        </header>

        <form id="paymentForm">

            <div class="field payment-option">
                <label>
                    <input type="radio" name="payment" value="cash">
                    Cash on Delivery
                </label>
            </div>

            <div class="field payment-option">
                <label>
                    <input type="radio" name="payment" value="card">
                    Pay with Card
                </label>
            </div>

            <button type="button" class="btn-next" onclick="continuePayment()">
                Next
            </button>

        </form>

    </article>

</div>

<script>

function continuePayment() {

    const selected = document.querySelector('input[name="payment"]:checked');

    if (!selected) {
        alert("Please select a payment method.");
        return;
    }

    if (selected.value === "cash") {

        alert("Thank you! Your order has been placed successfully.");

    } else if (selected.value === "card") {

        window.location.href = "/carddetailes";

    }
}

</script>

</body>
</html>
