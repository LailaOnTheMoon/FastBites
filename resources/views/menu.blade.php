<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Menu — FastBites</title>

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --orange: #EC6426;
            --amber: #F8A91F;
            --dark: #1c1a1a;
            --light: rgba(255, 255, 255, 0.9);
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.18);
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
            padding: 24px 18px 40px;
        }

        .container {
            max-width: 920px;
            margin: 0 auto;
        }

        .title {
            text-align: center;
            font-size: clamp(2.3rem, 4vw, 3rem);
            font-weight: 800;
            color: var(--amber);
            margin: 0;
            margin-bottom: 10px;
            text-shadow: 0 8px 18px rgba(0, 0, 0, 0.25);
        }

        .subtitle {
            text-align: center;
            font-size: 1.1rem;
            font-weight: 600;
            margin-top: 0;
            margin-bottom: 28px;
            opacity: 0.9;
        }

        .menu {
            display: grid;
            gap: 18px;
        }

        .menu-item {
            background: var(--light);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            display: grid;
            grid-template-columns: 100px 1fr auto;
            gap: 18px;
            padding: 18px 18px 18px 16px;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .menu-item::before {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(248, 169, 31, 0.15);
            pointer-events: none;
        }

        .menu-item * {
            position: relative;
            z-index: 1;
        }

        .menu-item img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 16px;
            border: 2px solid rgba(255, 255, 255, 0.8);
            box-shadow: 0 10px 22px rgba(0, 0, 0, 0.15);
        }

        .menu-item-info {
            display: grid;
            gap: 6px;
        }

        .menu-item-name {
            font-size: 1.2rem;
            font-weight: 700;
            margin: 0;
        }

        .menu-item-desc {
            margin: 0;
            font-size: 0.95rem;
            opacity: 0.75;
        }

        .menu-item-meta {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 12px;
        }

        .price {
            font-weight: 700;
            font-size: 1.05rem;
            color: var(--dark);
        }

        .controls {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .controls input[type="number"] {
            width: 64px;
            padding: 6px 10px;
            border: 1px solid rgba(0, 0, 0, 0.18);
            border-radius: 12px;
            font-size: 1rem;
            text-align: center;
        }

        .controls label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 600;
            cursor: pointer;
            user-select: none;
        }

        .controls input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: var(--orange);
        }

        .total-box {
            background: rgba(255, 255, 255, 0.95);
            border-radius: var(--radius);
            padding: 16px 18px;
            margin-top: 26px;
            box-shadow: var(--shadow);
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 18px;
        }

        .total-label {
            font-size: 1rem;
            font-weight: 700;
            color: var(--dark);
        }

        .total-amount {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--orange);
        }

        @media (max-width: 650px) {
            .menu-item {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .menu-item-meta {
                justify-content: center;
            }

            .controls {
                justify-content: center;
                flex-wrap: wrap;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="title">FastBites</h1>
        <p class="subtitle">La Piazza Trattoria</p>

        <div class="total-box" style="margin-bottom: 26px;">
            <span class="total-label">Order total</span>
            <span class="total-amount" id="orderTotalTop">$0.00</span>
        </div>

        <div class="menu">
            <div class="menu-item">
                <img src="https://via.placeholder.com/120?text=Pizza" alt="Margherita Pizza">
                <div class="menu-item-info">
                    <h2 class="menu-item-name">Margherita Pizza</h2>
                    <p class="menu-item-desc">Classic tomato, fresh mozzarella, and basil on a stone-fired crust.</p>
                    <div class="menu-item-meta">
                        <span class="price">$14.99</span>
                        <div class="controls">
                            <label>
                                <input type="checkbox" name="selected[]" value="margherita">
                                Select
                            </label>
                            <input type="number" min="1" value="1" placeholder="Qty">
                        </div>
                    </div>
                </div>
            </div>

            <div class="menu-item">
                <img src="https://via.placeholder.com/120?text=Burger" alt="Truffle Burger">
                <div class="menu-item-info">
                    <h2 class="menu-item-name">Truffle Burger</h2>
                    <p class="menu-item-desc">Juicy beef patty, melted cheese, and truffle aioli on a brioche bun.</p>
                    <div class="menu-item-meta">
                        <span class="price">$18.50</span>
                        <div class="controls">
                            <label>
                                <input type="checkbox" name="selected[]" value="truffle-burger">
                                Select
                            </label>
                            <input type="number" min="1" value="1" placeholder="Qty">
                        </div>
                    </div>
                </div>
            </div>

            <div class="menu-item">
                <img src="https://via.placeholder.com/120?text=Sushi" alt="Salmon Roll">
                <div class="menu-item-info">
                    <h2 class="menu-item-name">Salmon Roll</h2>
                    <p class="menu-item-desc">Fresh salmon, avocado, and cucumber rolled with sushi rice.</p>
                    <div class="menu-item-meta">
                        <span class="price">$12.00</span>
                        <div class="controls">
                            <label>
                                <input type="checkbox" name="selected[]" value="salmon-roll">
                                Select
                            </label>
                            <input type="number" min="1" value="1" placeholder="Qty">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        function parsePrice(text) {
            return parseFloat(text.replace(/[^0-9.]/g, '')) || 0;
        }

        function updateTotal() {
            const items = document.querySelectorAll('.menu-item');
            let total = 0;

            items.forEach(item => {
                const checkbox = item.querySelector('input[type="checkbox"]');
                const qtyInput = item.querySelector('input[type="number"]');
                const priceEl = item.querySelector('.price');

                if (!checkbox || !qtyInput || !priceEl) return;

                if (!checkbox.checked) return;

                const price = parsePrice(priceEl.textContent);
                const qty = Math.max(1, Number(qtyInput.value) || 1);

                total += price * qty;
            });

            const totalEl = document.getElementById('orderTotal');
            const totalTopEl = document.getElementById('orderTotalTop');

            if (totalEl) {
                totalEl.textContent = `$${total.toFixed(2)}`;
            }

            if (totalTopEl) {
                totalTopEl.textContent = `$${total.toFixed(2)}`;
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.menu-item input[type="checkbox"], .menu-item input[type="number"]').forEach(el => {
                el.addEventListener('input', updateTotal);
            });
            updateTotal();
        });
    </script>
</body>
</html>
