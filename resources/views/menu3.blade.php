<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Menu — FastBites</title>

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
            background-color: #FFF8F0;
            color: #1a1a1a;
        }

        /* ========== NAVBAR ========== */
        header {
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
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
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

        /* ========== HEADER SECTION ========== */
        .header-section {
            max-width: 1200px;
            margin: 0 auto;
            padding: 3rem 2rem;
            text-align: center;
            border-bottom: 1px solid rgba(255, 140, 0, 0.1);
        }

        .restaurant-name {
            font-family: 'Poppins', sans-serif;
            font-size: 2.5rem;
            font-weight: 800;
            color: #1a1a1a;
            margin-bottom: 0.5rem;
            letter-spacing: -0.5px;
        }

        .restaurant-subtitle {
            color: #FF8C00;
            font-size: 1.1rem;
            font-weight: 600;
        }

        .restaurant-desc {
            color: #777;
            margin-top: 1rem;
            font-size: 1rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        /* ========== MENU CONTAINER ========== */
        .menu-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 3rem 2rem;
        }

        .menu-header {
            margin-bottom: 2.5rem;
        }

        .menu-header h2 {
            font-family: 'Poppins', sans-serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 0.5rem;
        }

        .menu-header p {
            color: #999;
            font-size: 0.95rem;
        }

        /* ========== MENU ITEMS GRID ========== */
        .menu {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .menu-item {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .menu-item:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 40px rgba(255, 140, 0, 0.15);
        }

        .menu-item img {
            width: 100%;
            height: 240px;
            object-fit: cover;
            display: block;
            transition: transform 0.4s ease;
        }

        .menu-item:hover img {
            transform: scale(1.05);
        }

        .menu-item-info {
            padding: 1.8rem;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .menu-item-name {
            font-family: 'Poppins', sans-serif;
            font-size: 1.35rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 0.6rem;
            letter-spacing: -0.3px;
        }

        .menu-item-desc {
            color: #777;
            font-size: 0.95rem;
            line-height: 1.5;
            margin-bottom: 1.2rem;
            flex-grow: 1;
        }

        .menu-item-meta {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            padding-top: 1.2rem;
            border-top: 1px solid #f0f0f0;
        }

        .price {
            font-family: 'Poppins', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: #FF8C00;
        }

        .controls {
            display: flex;
            gap: 0.8rem;
            align-items: center;
        }

        .select-checkbox {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
            user-select: none;
        }

        .select-checkbox input[type="checkbox"] {
            width: 20px;
            height: 20px;
            cursor: pointer;
            accent-color: #FF8C00;
        }

        .select-checkbox label {
            cursor: pointer;
            font-weight: 500;
            color: #555;
            font-size: 0.9rem;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            background: #f5f5f5;
            border-radius: 8px;
            padding: 0.3rem;
            gap: 0.3rem;
        }

        .quantity-control button {
            background: none;
            border: none;
            width: 28px;
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #FF8C00;
            font-weight: 600;
            font-size: 1rem;
            transition: background 0.2s ease;
            border-radius: 4px;
        }

        .quantity-control button:hover {
            background: #eee;
        }

        .quantity-control input {
            width: 45px;
            border: none;
            background: transparent;
            text-align: center;
            font-weight: 600;
            color: #1a1a1a;
            font-size: 0.95rem;
        }

        .quantity-control input::-webkit-outer-spin-button,
        .quantity-control input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* ========== TOTAL BOX ========== */
        .total-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 4rem;
            padding-top: 3rem;
            border-top: 2px solid rgba(255, 140, 0, 0.1);
        }

        .total-box {
            background: linear-gradient(135deg, #FF8C00 0%, #FF7A00 100%);
            color: white;
            border-radius: 16px;
            padding: 2rem;
            min-width: 320px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 8px 24px rgba(255, 140, 0, 0.3);
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .total-box-content {
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
        }

        .total-label {
            font-size: 0.95rem;
            font-weight: 500;
            opacity: 0.95;
        }

        .total-amount {
            font-family: 'Poppins', sans-serif;
            font-size: 2rem;
            font-weight: 800;
            letter-spacing: -0.5px;
        }

        .item-count {
            background: rgba(255, 255, 255, 0.2);
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        /* ========== BUTTONS ========== */
        .button-section {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-bottom: 3rem;
            flex-wrap: wrap;
        }

        .btn-next {
            background: linear-gradient(135deg, #FF8C00 0%, #FF7A00 100%);
            color: white;
            border: none;
            padding: 1rem 2.5rem;
            border-radius: 12px;
            font-family: 'Poppins', sans-serif;
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 6px 20px rgba(255, 140, 0, 0.3);
            min-width: 200px;
        }

        .btn-next:hover:not(:disabled) {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(255, 140, 0, 0.4);
        }

        .btn-next:active:not(:disabled) {
            transform: translateY(-1px);
        }

        .btn-next:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .btn-continue {
            background: white;
            color: #FF8C00;
            border: 2px solid #FF8C00;
            padding: 1rem 2.5rem;
            border-radius: 12px;
            font-family: 'Poppins', sans-serif;
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            min-width: 200px;
        }

        .btn-continue:hover {
            background: #FFF8F0;
        }

        /* ========== RESPONSIVE ========== */
        @media (max-width: 768px) {
            .navbar-container {
                padding: 1rem 1.5rem;
            }

            .restaurant-name {
                font-size: 1.8rem;
            }

            .menu {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .total-box {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .button-section {
                flex-direction: column;
            }

            .btn-next,
            .btn-continue {
                width: 100%;
            }

            .header-section {
                padding: 2rem 1.5rem;
            }

            .menu-container {
                padding: 2rem 1.5rem;
            }
        }
    </style>
</head>
<body>

<!-- ================= NAVBAR ================= -->
<header>
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
            <span>Menu</span>
        </nav>
    </div>
</header>

<!-- ================= RESTAURANT HEADER ================= -->
<section class="header-section">
    <h1 class="restaurant-name">Velvet Sip Bar</h1>
    <p class="restaurant-subtitle">Premium Beverages & Refreshments</p>
    <p class="restaurant-desc">Indulge in our expertly crafted drinks and smoothies. From fresh fruit juices to premium coffee, every sip is an experience of pure refreshment and flavor.</p>
</section>

<!-- ================= MENU SECTION ================= -->
<section class="menu-container">
    <div class="menu-header">
        <h2>Our Signature Drinks</h2>
        <p>Select your favorite beverages</p>
    </div>

    <div class="menu">
        <!-- Menu Item 1 -->
        <div class="menu-item">
            <img src="{{ asset('images/smoothie3.jpg') }}" alt="Strawberry Drink">
            <div class="menu-item-info">
                <h3 class="menu-item-name">Strawberry Drink</h3>
                <p class="menu-item-desc">Fresh blended strawberry juice with ice. A refreshing burst of natural sweetness and vibrant flavors.</p>
                <div class="menu-item-meta">
                    <span class="price">₪12</span>
                    <div class="controls">
                        <div class="select-checkbox">
                            <input type="checkbox" name="selected[]" value="strawberry" id="strawberry">
                            <label for="strawberry">Select</label>
                        </div>
                        <div class="quantity-control">
                            <button onclick="decrementQty(this)">−</button>
                            <input type="number" min="1" value="1">
                            <button onclick="incrementQty(this)">+</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Menu Item 2 -->
        <div class="menu-item">
            <img src="{{ asset('images/mangojuice.jpg') }}" alt="Mango Juice">
            <div class="menu-item-info">
                <h3 class="menu-item-name">Mango Juice</h3>
                <p class="menu-item-desc">Sweet tropical mango fresh juice. Taste the essence of summer in every delicious glass.</p>
                <div class="menu-item-meta">
                    <span class="price">₪17</span>
                    <div class="controls">
                        <div class="select-checkbox">
                            <input type="checkbox" name="selected[]" value="mango" id="mango">
                            <label for="mango">Select</label>
                        </div>
                        <div class="quantity-control">
                            <button onclick="decrementQty(this)">−</button>
                            <input type="number" min="1" value="1">
                            <button onclick="incrementQty(this)">+</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Menu Item 3 -->
        <div class="menu-item">
            <img src="{{ asset('images/icedcoffee.jpg') }}" alt="Iced Coffee">
            <div class="menu-item-info">
                <h3 class="menu-item-name">Iced Coffee</h3>
                <p class="menu-item-desc">Cold brewed coffee served with ice and milk. Smooth, rich, and perfectly chilled for any time of day.</p>
                <div class="menu-item-meta">
                    <span class="price">₪15</span>
                    <div class="controls">
                        <div class="select-checkbox">
                            <input type="checkbox" name="selected[]" value="iced_coffee" id="iced_coffee">
                            <label for="iced_coffee">Select</label>
                        </div>
                        <div class="quantity-control">
                            <button onclick="decrementQty(this)">−</button>
                            <input type="number" min="1" value="1">
                            <button onclick="incrementQty(this)">+</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ================= TOTAL SECTION ================= -->
    <div class="total-section">
        <div class="total-box">
            <div class="total-box-content">
                <span class="total-label">Final Total</span>
                <span class="total-amount" id="finalTotal">₪0.00</span>
            </div>
            <div class="item-count">
                <span id="itemCount">0 Items</span>
            </div>
        </div>

        <div class="button-section">
            <button class="btn-next" id="nextBtn" onclick="goToOrderPage()" disabled>
                Proceed to Checkout
            </button>
            <button class="btn-continue" onclick="window.location.href='/restaurants'">
                Browse More
            </button>
        </div>
    </div>
</section>

<script>
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    const totalElement = document.getElementById('finalTotal');
    const itemCountElement = document.getElementById('itemCount');
    const nextBtn = document.getElementById('nextBtn');

    // ===== INCREMENT QUANTITY =====
    function incrementQty(btn) {
        const input = btn.parentElement.querySelector('input[type="number"]');
        input.value = Math.max(1, parseInt(input.value) + 1);
        calculateTotal();
    }

    // ===== DECREMENT QUANTITY =====
    function decrementQty(btn) {
        const input = btn.parentElement.querySelector('input[type="number"]');
        input.value = Math.max(1, parseInt(input.value) - 1);
        calculateTotal();
    }

    // ===== CALCULATE TOTAL (FIXED) =====
    function calculateTotal() {
        let total = 0;
        let itemCount = 0;

        document.querySelectorAll('.menu-item').forEach(item => {
            const checkbox = item.querySelector('input[type="checkbox"]');
            const quantityInput = item.querySelector('input[type="number"]');
            const priceText = item.querySelector('.price').innerText;

            // Extract price safely: remove all non-numeric characters except decimal
            const price = parseFloat(priceText.replace(/[^\d.]/g, '')) || 0;
            const qty = parseInt(quantityInput.value) || 1;

            if (checkbox.checked) {
                total += price * qty;
                itemCount += qty;
            }
        });

        totalElement.innerText = `₪${total.toFixed(2)}`;
        itemCountElement.innerText = `${itemCount} ${itemCount === 1 ? 'Item' : 'Items'}`;
        nextBtn.disabled = itemCount === 0;
    }

    // ===== EVENT LISTENERS =====
    checkboxes.forEach(box => {
        box.addEventListener('change', calculateTotal);
    });

    document.querySelectorAll('input[type="number"]').forEach(input => {
        input.addEventListener('input', calculateTotal);
    });

    // ===== GO TO ORDER PAGE =====
    function goToOrderPage() {
        let orders = [];
        let total = 0;

        document.querySelectorAll('.menu-item').forEach(item => {
            const checkbox = item.querySelector('input[type="checkbox"]');

            if (checkbox.checked) {
                const name = item.querySelector('.menu-item-name').innerText;
                const quantityInput = item.querySelector('input[type="number"]');
                const quantity = parseInt(quantityInput.value) || 1;
                const priceText = item.querySelector('.price').innerText;

                // Extract price safely: remove all non-numeric characters except decimal
                const price = parseFloat(priceText.replace(/[^\d.]/g, '')) || 0;

                total += price * quantity;

                orders.push({
                    name: name,
                    quantity: quantity,
                    price: price // Store as pure number, no currency symbol
                });
            }
        });

        if (orders.length > 0) {
            localStorage.setItem('orders', JSON.stringify(orders));
            localStorage.setItem('total', total.toFixed(2));
            window.location.href = "/orderdetailes";
        }
    }
</script>

</body>
</html>