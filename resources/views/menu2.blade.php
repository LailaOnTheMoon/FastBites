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
    <p class="subtitle">BiteRush Kitchen</p>

    <div class="total-box" style="margin-bottom: 26px;">
      <span class="total-label">Order total</span>
      <span class="total-amount" id="orderTotalTop">$0.00</span>
    </div>

    <div class="menu">

      <div class="menu">

        <div class="menu-item">
          <img src="https://source.unsplash.com/120x120/?pizza" alt="Pizza">
          <div class="menu-item-info">
            <h2 class="menu-item-name">Classic Pizza</h2>
            <p class="menu-item-desc">Cheesy pizza with tomato sauce and fresh basil.</p>
            <div class="menu-item-meta">
              <span class="price">$12.99</span>
              <div class="controls">
                <label><input type="checkbox" name="selected[]" value="pizza"> Select</label>
                <input type="number" min="1" value="1">
              </div>
            </div>
          </div>
        </div>

        <div class="menu-item">
          <img src="images/beefburger.jpg" alt="Burger">
          <div class="menu-item-info">
            <h2 class="menu-item-name">Beef Burger</h2>
            <p class="menu-item-desc">Juicy beef burger with cheese and special sauce.</p>
            <div class="menu-item-meta">
              <span class="price">$10.99</span>
              <div class="controls">
                <label><input type="checkbox" name="selected[]" value="burger"> Select</label>
                <input type="number" min="1" value="1">
              </div>
            </div>
          </div>
        </div>

        <div class="menu-item">
          <img src="images/chicken.png" alt="Crispy Chicken">
          <div class="menu-item-info">
            <h2 class="menu-item-name">Crispy Chicken</h2>
            <p class="menu-item-desc">Golden crispy chicken with crunchy coating.</p>
            <div class="menu-item-meta">
              <span class="price">$11.49</span>
              <div class="controls">
                <label><input type="checkbox" name="selected[]" value="crispy"> Select</label>
                <input type="number" min="1" value="1">
              </div>
            </div>
          </div>
        </div>

        <div class="menu-item">
          <img src="images/salad.png" alt="Salad">
          <div class="menu-item-info">
            <h2 class="menu-item-name">Salad</h2>
            <p class="menu-item-desc">Fresh mixed greens with your choice of dressing.</p>
            <div class="menu-item-meta">
              <span class="price">$8.99</span>
              <div class="controls">
                <label><input type="checkbox" name="selected[]" value="salad"> Select</label>
                <input type="number" min="1" value="1">
              </div>
            </div>
          </div>
        </div>

        <div class="menu-item">
          <img src="images/shawarma.png" alt="Shawarma">
          <div class="menu-item-info">
            <h2 class="menu-item-name">Shawarma</h2>
            <p class="menu-item-desc">Fried meat wrapped in a warm flatbread.</p>
            <div class="menu-item-meta">
              <span class="price">$10.49</span>
              <div class="controls">
                <label><input type="checkbox" name="selected[]" value="shawarma"> Select</label>
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
