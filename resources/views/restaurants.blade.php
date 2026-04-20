<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Restaurants — FastBites</title>

    <!-- Modern font -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="welcome-page">
  <div class="layout">
    <h1 class="title">FastBites</h1>

    <div class="restaurants">
      <div class="restaurant-card">
        <div class="restaurant-name">Sugar Bloom Dessert Lab</div>
        <img src="images/sweetshop.jpg">
        <div class="restaurant-desc">Juicy burgers with fresh ingredients, perfect for a quick bite.</div>
      </div>
      <div class="restaurant-card">
        <div class="restaurant-name">BiteRush Kitchen</div>
        <img src="images/pizzashop.jpg">
        <div class="restaurant-desc">Wood-fired pizzas with authentic flavors from around the world.</div>
      </div>
      <div class="restaurant-card">
        <div class="restaurant-name">Velvet Sip Bar</div>
        <img src="images/drinkshop.jpg">
        <div class="restaurant-desc">Spicy tacos and fresh salsas, a fiesta in every bite.</div>
      </div>
    </div>
  </div>
</body>

</html>
</html>
