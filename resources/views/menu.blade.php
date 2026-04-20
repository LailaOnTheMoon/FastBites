<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Menu — FastBites</title>

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="welcome-page">
    <div class="container">
        <h1 class="title">FastBites</h1>
        <p class="subtitle">Sugar Bloom Dessert Lab</p>

        <div class="total-box" style="margin-bottom: 26px;">
            <span class="total-label">Order total</span>
            <span class="total-amount" id="orderTotalTop">$0.00</span>
        </div>

        <div class="menu">
            <div class="menu">

    <div class="menu-item">
        <img src="images/dessert6.jpg" alt="Orange Cake">
        <div class="menu-item-info">
            <h2 class="menu-item-name">Orange Cake</h2>
            <p class="menu-item-desc">Soft sponge cake with fresh orange flavor.</p>
            <div class="menu-item-meta">
                <span class="price">$6.99</span>
                <div class="controls">
                    <label><input type="checkbox" name="selected[]" value="orange_cake"> Select</label>
                    <input type="number" min="1" value="1">
                </div>
            </div>
        </div>
    </div>

    <div class="menu-item">
        <img src="images/blueberrycake.jpg" alt="Blueberry Cake">
        <div class="menu-item-info">
            <h2 class="menu-item-name">Blueberry Cake</h2>
            <p class="menu-item-desc">Creamy cake with fresh blueberry topping.</p>
            <div class="menu-item-meta">
                <span class="price">$7.49</span>
                <div class="controls">
                    <label><input type="checkbox" name="selected[]" value="blueberry_cake"> Select</label>
                    <input type="number" min="1" value="1">
                </div>
            </div>
        </div>
    </div>

    <div class="menu-item">
        <img src="images/chocholatecake.jpg" alt="Chocolate Cake">
        <div class="menu-item-info">
            <h2 class="menu-item-name">Chocolate Cake</h2>
            <p class="menu-item-desc">Rich chocolate cake for chocolate lovers.</p>
            <div class="menu-item-meta">
                <span class="price">$8.99</span>
                <div class="controls">
                    <label><input type="checkbox" name="selected[]" value="chocolate_cake"> Select</label>
                    <input type="number" min="1" value="1">
                </div>
            </div>
        </div>
    </div>

</div>
        </div>

    </div>

</body>
</html>
