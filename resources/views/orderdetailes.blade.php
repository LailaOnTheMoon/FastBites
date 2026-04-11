<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Order Details — FastBites</title>

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --button-start: #F26A21;
            --button-end: #F8B11A;
            --bg: #F6E8D5;
            --card: #F3DFC4;
            --glow: #F5C57A;
            --dark: #3d2a18;
            --light: rgba(255, 255, 255, 0.92);
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
            background: var(--bg);
            color: var(--dark);
            padding: 28px 18px 40px;
        }

        .container {
            max-width: 920px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            margin: 0;
            font-size: clamp(2.3rem, 4vw, 3rem);
            font-weight: 800;
            color: var(--button-end);
            letter-spacing: 0.04em;
        }

        .header p {
            margin: 10px 0 0;
            font-size: 1.05rem;
            opacity: 0.9;
        }

        .order-card {
            background: var(--light);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 22px 24px;
            margin-bottom: 26px;
        }

        .order-card h2 {
            margin: 0;
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--dark);
        }

        .order-meta {
            margin-top: 10px;
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            font-size: 0.95rem;
            color: rgba(28, 26, 26, 0.8);
        }

        .order-meta span {
            background: rgba(236, 100, 38, 0.15);
            padding: 6px 12px;
            border-radius: 12px;
            font-weight: 600;
        }

        .order-items {
            margin-top: 22px;
            display: grid;
            gap: 16px;
        }

        .item {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 14px;
            align-items: center;
            padding: 14px 16px;
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(236, 100, 38, 0.3);
        }

        .item-info {
            display: grid;
            gap: 8px;
        }

        .item-name {
            font-weight: 700;
            font-size: 1.07rem;
            margin: 0;
        }

        .item-meta {
            display: flex;
            gap: 10px;
            align-items: center;
            font-size: 0.9rem;
            color: rgba(28, 26, 26, 0.7);
        }

        .item-meta span {
            background: rgba(248, 169, 31, 0.18);
            padding: 4px 10px;
            border-radius: 10px;
        }

        .item-price {
            font-weight: 800;
            font-size: 1.1rem;
            color: var(--dark);
            text-align: right;
        }

        .order-total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 22px;
            padding: 16px 20px;
            border-radius: 18px;
            background: rgba(236, 100, 38, 0.18);
            border: 1px solid rgba(236, 100, 38, 0.35);
        }

        .order-total span {
            font-weight: 700;
            font-size: 1.1rem;
        }

        .btn-next {
            width: 100%;
            margin-top: 20px;
            padding: 14px 18px;
            border: none;
            border-radius: 18px;
            background: linear-gradient(135deg, var(--button-start), var(--button-end));
            color: white;
            font-weight: 800;
            font-size: 1.05rem;
            cursor: pointer;
            box-shadow: 0 16px 30px rgba(0, 0, 0, 0.15);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-next:hover {
            transform: translateY(-2px);
            box-shadow: 0 18px 34px rgba(0, 0, 0, 0.2);
        }

        @media (max-width: 720px) {
            .order-meta {
                flex-direction: column;
                align-items: flex-start;
            }

            .item {
                grid-template-columns: 1fr;
                text-align: left;
            }

            .item-price {
                text-align: left;
            }
        }
    </style>
</head>
<body>
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
