<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Order Details — FastBites</title>

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

</head>
<body class="welcome-page">
    <div class="container">
        <header class="header">
            <h1>FastBites</h1>
            <p>Your order details — sit back and relax while we prepare your meal.</p>
        </header>

        <div class="order-card">
            <h2>Order #0421</h2>
            <div class="order-meta">
                <span>Expected in 22–28 min</span>
                <span>Delivery: 1.2 mi</span>
            </div>

            <div class="order-items" id="orderItems"></div>

            <div class="order-total">
                <span id="orderTotal">$0.00</span>
            </div>

<button class="btn-next" onclick="goToPaymentPage()">
    Next
</button>
</div>
    </div>
    <script>
const orders = JSON.parse(localStorage.getItem('orders')) || [];
const total = localStorage.getItem('total') || "0.00";

const container = document.getElementById('orderItems');

orders.forEach(item => {

    container.innerHTML += `
        <div class="item">
            <div class="item-info">
                <p class="item-name">${item.name}</p>

                <div class="item-meta">
                    <span>Qty: ${item.quantity}</span>
                </div>
            </div>

            <div class="item-price">
                $${(item.price * item.quantity).toFixed(2)}
            </div>
        </div>
    `;
});

document.getElementById('orderTotal').innerText = `$${total}`;
</script>
<script>
function goToPaymentPage() {
    window.location.href = "/payment";
}
</script>
</body>
</html>
