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
    <p class="subtitle">Velvet Sip Bar</p>

    <div class="total-box" style="margin-bottom: 26px;">
      <span class="total-label">Order total</span>
      <span class="total-amount" id="orderTotalTop">$0.00</span>
    </div>

    <div class="menu">

     <div class="menu">

    <div class="menu-item">
        <img src="images/smoothie3.jpg" alt="Strawberry Drink">
        <div class="menu-item-info">
            <h2 class="menu-item-name">Strawberry Drink</h2>
            <p class="menu-item-desc">Fresh blended strawberry juice with ice.</p>
            <div class="menu-item-meta">
                <span class="price">$4.99</span>
                <div class="controls">
                    <label><input type="checkbox" name="selected[]" value="strawberry"> Select</label>
                    <input type="number" min="1" value="1">
                </div>
            </div>
        </div>
    </div>

    <div class="menu-item">
        <img src="images/mangojuice.jpg" alt="Mango Juice">
        <div class="menu-item-info">
            <h2 class="menu-item-name">Mango Juice</h2>
            <p class="menu-item-desc">Sweet tropical mango fresh juice.</p>
            <div class="menu-item-meta">
                <span class="price">$4.49</span>
                <div class="controls">
                    <label><input type="checkbox" name="selected[]" value="mango"> Select</label>
                    <input type="number" min="1" value="1">
                </div>
            </div>
        </div>
    </div>

    <div class="menu-item">
        <img src="images/icedcoffee.jpg" alt="Iced Coffee">
        <div class="menu-item-info">
            <h2 class="menu-item-name">Iced Coffee</h2>
            <p class="menu-item-desc">Cold brewed coffee served with ice and milk.</p>
            <div class="menu-item-meta">
                <span class="price">$3.99</span>
                <div class="controls">
                    <label><input type="checkbox" name="selected[]" value="iced_coffee"> Select</label>
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
