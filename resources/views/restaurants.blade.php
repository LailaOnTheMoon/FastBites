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
        <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

</head>

<style>
  
.restaurants {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
  gap: 28px;
  margin-top: 40px;
}

.restaurant-card {
  background: white;
  border-radius: 24px;
  overflow: hidden;
  box-shadow: 0 10px 30px rgba(0,0,0,0.12);

  transition: 0.3s;
}

.restaurant-card:hover {
  transform: translateY(-8px);
}

.restaurant-card img {
  width: 100%;
  height: 240px;
  object-fit: cover;
  display: block;
}

.restaurant-name {
  font-size: 1.4rem;
  font-weight: 700;
  padding: 18px 18px 8px;
}

.restaurant-desc {
  padding: 0 18px 20px;
  color: #555;
  line-height: 1.6;
} 

.restaurant-link {
  text-decoration: none;
  color: inherit;
  display: block;
}
</style>

<body class="welcome-page">
  <div class="layout">
    <h1 class="title">FastBites</h1>

    <div class="restaurants">

  <div class="restaurant-card">
    <a href="/menu" class="restaurant-link">
    <img src="{{ asset('images/sweetshop.jpg') }}" alt="">
    <div class="restaurant-name">Sugar Bloom Dessert Lab</div>
    <div class="restaurant-desc">
      Decadent desserts crafted with love, from classic cakes to innovative treats.
    </div>
  </div></a>

  <div class="restaurant-card">
    <a href="/menu2" class="restaurant-link">
    <img src="{{ asset('images/pizzashop.jpg') }}" alt="">
    <div class="restaurant-name">BiteRush Kitchen</div>
    <div class="restaurant-desc">
      Wood-fired pizzas with authentic flavors from around the world.
      
  </div>
  </div></a>

  <div class="restaurant-card">
    <a href="/menu3" class="restaurant-link">
    <img src="{{ asset('images/drinkshop.jpg') }}" alt="">
    <div class="restaurant-name">Velvet Sip Bar</div>
    <div class="restaurant-desc">
      Best milkshaces and smoothies, blending fresh fruits and creamy indulgence in every sip.
    </div>
  </div></a>

</div>
  </div>
</body>

</html>
