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
                <span>Payment: Card</span>
            </div>

            <div class="order-items">
                <div class="item">
                    <div class="item-info">
                        <p class="item-name">Margherita Pizza</p>
                        <div class="item-meta">
                            <span>Qty: 1</span>
                            <span>Prep: 10 min</span>
                        </div>
                    </div>
                    <div class="item-price">$14.99</div>
                </div>

                <div class="item">
                    <div class="item-info">
                        <p class="item-name">Truffle Burger</p>
                        <div class="item-meta">
                            <span>Qty: 1</span>
                            <span>Prep: 12 min</span>
                        </div>
                    </div>
                    <div class="item-price">$18.50</div>
                </div>

                <div class="item">
                    <div class="item-info">
                        <p class="item-name">Salmon Roll</p>
                        <div class="item-meta">
                            <span>Qty: 2</span>
                            <span>Prep: 8 min</span>
                        </div>
                    </div>
                    <div class="item-price">$24.00</div>
                </div>
            </div>

            <div class="order-total">
                <span>Total</span>
                <span>$57.49</span>
            </div>

            <button class="btn-next" type="button">Next</button>
        </div>
    </div>
</body>
</html>
