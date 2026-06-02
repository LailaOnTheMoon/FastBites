<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fast Bites - Premium Food Delivery</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Favicon -->
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
            overflow-x: hidden;
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
            max-width: 1400px;
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
        }

        .logo-img {
            width: 48px;
            height: 48px;
            object-fit: contain;
        }

        .logo-text {
            font-size: 1.5rem;
            font-weight: 700;
            color: #FF8C00;
            font-family: 'Poppins', sans-serif;
        }

        nav {
            display: flex;
            gap: 3rem;
            align-items: center;
        }

        nav a {
            text-decoration: none;
            color: #555;
            font-weight: 500;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            position: relative;
        }

        nav a:hover,
        nav a.active {
            color: #FF8C00;
        }

        nav a::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: #FF8C00;
            transition: width 0.3s ease;
        }

        nav a:hover::after,
        nav a.active::after {
            width: 100%;
        }

        .cta-btn {
            background: linear-gradient(135deg, #FF8C00 0%, #FF7A00 100%);
            color: white;
            padding: 0.75rem 1.75rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(255, 140, 0, 0.3);
            border: none;
            cursor: pointer;
        }

        .cta-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 140, 0, 0.4);
        }

        /* ========== HERO SECTION ========== */
        .hero {
            max-width: 1400px;
            margin: 0 auto;
            padding: 4rem 2rem;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }

        .hero-content h1 {
            font-family: 'Poppins', sans-serif;
            font-size: 3.5rem;
            font-weight: 800;
            color: #1a1a1a;
            margin-bottom: 1rem;
            line-height: 1.2;
            letter-spacing: -1px;
        }

        .hero-content .subtitle {
            color: #FF8C00;
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 1rem;
        }

        .hero-content p {
            color: #666;
            font-size: 1.1rem;
            line-height: 1.7;
            margin-bottom: 2rem;
            max-width: 500px;
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .btn-primary {
            background: linear-gradient(135deg, #FF8C00 0%, #FF7A00 100%);
            color: white;
            padding: 1rem 2rem;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 700;
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 6px 20px rgba(255, 140, 0, 0.3);
            border: none;
            cursor: pointer;
        }

        .btn-primary:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 30px rgba(255, 140, 0, 0.4);
        }

        .hero-image {
            position: relative;
            height: 500px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .glow {
            position: absolute;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(255, 140, 0, 0.2) 0%, transparent 70%);
            border-radius: 50%;
            filter: blur(40px);
        }

        .hero-image img {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 400px;
            object-fit: contain;
            filter: drop-shadow(0 20px 40px rgba(0, 0, 0, 0.15));
            transition: transform 0.5s ease;
        }

        .hero-image img:hover {
            transform: scale(1.1) rotate(-5deg);
        }

        /* ========== POPULAR DISHES SECTION ========== */
        .section {
            max-width: 1400px;
            margin: 0 auto;
            padding: 4rem 2rem;
        }

        .section-header {
            margin-bottom: 3rem;
        }

        .section-header h2 {
            font-family: 'Poppins', sans-serif;
            font-size: 2.5rem;
            font-weight: 800;
            color: #1a1a1a;
            letter-spacing: -0.5px;
        }

        .section-header h2 .highlight {
            color: #FF8C00;
        }

        .dishes-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }

        .dish-card {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            overflow: hidden;
        }

        .dish-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 12px 40px rgba(255, 140, 0, 0.15);
        }

        .dish-image {
            width: 100%;
            height: 220px;
            background: linear-gradient(135deg, #FFF8F0 0%, rgba(255, 140, 0, 0.05) 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            margin-bottom: 1rem;
        }

        .dish-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .dish-card:hover .dish-image img {
            transform: scale(1.08);
        }

        .dish-name {
            font-family: 'Poppins', sans-serif;
            font-size: 1.2rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 0.5rem;
        }

        .dish-price {
            font-family: 'Poppins', sans-serif;
            font-size: 1.4rem;
            font-weight: 700;
            color: #FF8C00;
        }

        /* ========== FEATURES SECTION ========== */
        .features-section {
            background: linear-gradient(135deg, #FFF8F0 0%, rgba(255, 140, 0, 0.05) 100%);
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .feature-card {
            background: white;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            text-align: center;
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 30px rgba(255, 140, 0, 0.15);
        }

        .feature-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .feature-card h3 {
            font-family: 'Poppins', sans-serif;
            font-size: 1.3rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 0.75rem;
        }

        .feature-card p {
            color: #666;
            line-height: 1.6;
        }

        /* ========== CATEGORIES SECTION ========== */
        .categories-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }

        .category-card {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            text-align: center;
            transition: all 0.3s ease;
            overflow: hidden;
            position: relative;
        }

        .category-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, #FF8C00 0%, #FF7A00 100%);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s ease;
        }

        .category-card:hover::before {
            transform: scaleX(1);
        }

        .category-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 30px rgba(255, 140, 0, 0.15);
        }

        .category-image {
            width: 100%;
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
        }

        .category-image img {
            width: 120px;
            height: 120px;
            object-fit: contain;
        }

        .category-card h3 {
            font-family: 'Poppins', sans-serif;
            font-size: 1.4rem;
            font-weight: 700;
            color: #1a1a1a;
        }

        /* ========== TESTIMONIALS SECTION ========== */
        .testimonials-section {
            background: linear-gradient(135deg, #FFF8F0 0%, rgba(255, 140, 0, 0.05) 100%);
        }

        .testimonial-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .testimonial-card {
            background: white;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border-left: 4px solid #FF8C00;
        }

        .testimonial-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 30px rgba(255, 140, 0, 0.15);
        }

        .testimonial-text {
            color: #666;
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 1rem;
            font-style: italic;
        }

        .testimonial-author {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            color: #1a1a1a;
        }

        .rating {
            color: #FFD580;
            margin-bottom: 0.5rem;
            font-size: 1.1rem;
        }

        /* ========== FOOTER ========== */
        footer {
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
            color: white;
            padding: 3rem 2rem;
            margin-top: 4rem;
        }

        .footer-content {
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .footer-section h3 {
            font-family: 'Poppins', sans-serif;
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: #FF8C00;
        }

        .footer-section p,
        .footer-section a {
            color: #ccc;
            font-size: 0.9rem;
            line-height: 1.8;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-section a:hover {
            color: #FF8C00;
        }

        .footer-bottom {
            max-width: 1400px;
            margin: 0 auto;
            text-align: center;
            padding-top: 2rem;
            border-top: 1px solid #444;
            color: #999;
            font-size: 0.9rem;
        }

        /* ========== RESPONSIVE ========== */
        @media (max-width: 768px) {
            .navbar-container {
                padding: 1rem 1.5rem;
                flex-wrap: wrap;
            }

            nav {
                display: none;
            }

            .hero {
                grid-template-columns: 1fr;
                gap: 2rem;
                padding: 2rem 1.5rem;
            }

            .hero-content h1 {
                font-size: 2.2rem;
            }

            .hero-image {
                height: 300px;
            }

            .section {
                padding: 2rem 1.5rem;
            }

            .section-header h2 {
                font-size: 1.8rem;
            }

            .dishes-grid,
            .categories-grid,
            .features-grid,
            .testimonial-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

<!-- ================= NAVBAR ================= -->
<header>
    <div class="navbar-container">
        <div class="logo-section">
            <img src="{{ asset('images/logo.png') }}" alt="Fast Bites Logo" class="logo-img">
            <span class="logo-text">Fast Bites</span>
        </div>

        <nav class="hidden md:flex">
    <a href="/" class="active">Home</a>

    @auth
        <a href="/restaurants">Browse</a>
    @else
        <a href="/login">Browse</a>
    @endauth

    <a href="/about">About</a>
    <a href="/contact">Contact</a>
</nav>

        <button class="cta-btn" onclick="window.location.href='{{ route('login') }}'">Order Now</button>
    </div>
</header>

<!-- ================= HERO SECTION ================= -->
<section class="hero">
    <div class="hero-content">
        <p class="subtitle">Welcome to</p>
        <h1>Fast Bites <br>Enjoy <span style="background: linear-gradient(135deg, #FF8C00 0%, #FF7A00 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Your Food</span></h1>
        <p>Delicious meals, refreshing drinks, and sweet desserts delivered fast to your door. Order from top-rated restaurants in your area.</p>
        <div class="hero-buttons">
            <button class="btn-primary" onclick="window.location.href='{{ route('login') }}'">Order Now</button>
        </div>
    </div>

    <div class="hero-image">
        <div class="glow"></div>
        <img src="{{ asset('images/pizza.png') }}" alt="Pizza">
    </div>
</section>

<!-- ================= POPULAR DISHES SECTION ================= -->
<section class="section">
    <div class="section-header">
        <h2>Our Popular <span class="highlight">Dishes</span></h2>
    </div>

    <div class="dishes-grid">
        <div class="dish-card">
            <div class="dish-image">
                <img src="{{ asset('images/shwrma.jpg') }}" alt="Shawarma">
            </div>
            <h3 class="dish-name">Shawarma</h3>
            <p class="dish-price">$10.00</p>
        </div>

        <div class="dish-card">
            <div class="dish-image">
                <img src="{{ asset('images/salad.jpg') }}" alt="Avocado Salad">
            </div>
            <h3 class="dish-name">Avocado Salad</h3>
            <p class="dish-price">$8.50</p>
        </div>

        <div class="dish-card">
            <div class="dish-image">
                <img src="{{ asset('images/dessert6.jpg') }}" alt="Orange Cake">
            </div>
            <h3 class="dish-name">Orange Cake</h3>
            <p class="dish-price">$7.99</p>
        </div>

        <div class="dish-card">
            <div class="dish-image">
                <img src="{{ asset('images/smoothie3.jpg') }}" alt="Fruit Mix">
            </div>
            <h3 class="dish-name">Fruit Mix Smoothie</h3>
            <p class="dish-price">$5.99</p>
        </div>
    </div>
</section>

<!-- ================= FEATURES SECTION ================= -->
<section class="section features-section">
    <div class="section-header">
        <h2>Why Choose <span class="highlight">Fast Bites</span></h2>
    </div>

    <div class="features-grid">
        <div class="feature-card">
            <div class="feature-icon">⚡</div>
            <h3>Fast Delivery</h3>
            <p>Get your food delivered hot and fresh within minutes of ordering.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">🍔</div>
            <h3>Quality Food</h3>
            <p>We partner with trusted restaurants using premium ingredients.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">🥤</div>
            <h3>Wide Variety</h3>
            <p>Food, desserts, and drinks all in one convenient platform.</p>
        </div>
    </div>
</section>

<!-- ================= CATEGORIES SECTION ================= -->
<section class="section">
    <div class="section-header">
        <h2>Browse by <span class="highlight">Category</span></h2>
    </div>

    <div class="categories-grid">
        <div class="category-card">
            <div class="category-image">
                <img src="{{ asset('images/burger.png') }}" alt="Food">
            </div>
            <h3>Food & Meals</h3>
        </div>

        <div class="category-card">
            <div class="category-image">
                <img src="{{ asset('images/dessert4.png') }}" alt="Desserts">
            </div>
            <h3>Desserts</h3>
        </div>

        <div class="category-card">
            <div class="category-image">
                <img src="{{ asset('images/smoothie1.png') }}" alt="Drinks">
            </div>
            <h3>Drinks & Beverages</h3>
        </div>
    </div>
</section>

<!-- ================= TESTIMONIALS SECTION ================= -->
<section class="section testimonials-section">
    <div class="section-header">
        <h2>What Our <span class="highlight">Customers Say</span></h2>
    </div>

    <div class="testimonial-grid">
        <div class="testimonial-card">
            <div class="rating">⭐⭐⭐⭐⭐</div>
            <p class="testimonial-text">"Best burger I've ever had! Super fast delivery and excellent customer service. Highly recommended!"</p>
            <div class="testimonial-author">— Sarah M.</div>
        </div>

        <div class="testimonial-card">
            <div class="rating">⭐⭐⭐⭐⭐</div>
            <p class="testimonial-text">"Desserts are absolutely amazing and very fresh! The whole experience from ordering to delivery was seamless."</p>
            <div class="testimonial-author">— Ahmed K.</div>
        </div>

        <div class="testimonial-card">
            <div class="rating">⭐⭐⭐⭐⭐</div>
            <p class="testimonial-text">"Love the smoothies! The variety of options is incredible and the quality is consistently excellent."</p>
            <div class="testimonial-author">— Lina R.</div>
        </div>
    </div>
</section>

<!-- ================= FOOTER ================= -->
<footer>
    <div class="footer-content">
        <div class="footer-section">
            <h3>Fast Bites</h3>
            <p>Delicious food delivered fast. Your favorite restaurants, one app away.</p>
        </div>

        <div class="footer-section">
            <h3>Quick Links</h3>
            <a href="/">Home</a>
            <a href="/restaurants">Browse Restaurants</a>
            <a href="/about">About Us</a>
            <a href="/contact">Contact</a>
        </div>

        <div class="footer-section">
            <h3>Support</h3>
            <a href="#">FAQ</a>
            <a href="#">Terms & Conditions</a>
            <a href="#">Privacy Policy</a>
            <a href="#">Help Center</a>
        </div>

        <div class="footer-section">
            <h3>Contact</h3>
            <p>Email: info@fastbites.com</p>
            <p>Phone: +1 (555) 123-4567</p>
            <p>Available 24/7</p>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; 2026 Fast Bites. All rights reserved. | Crafted for food lovers.</p>
    </div>
</footer>

</body>
</html>