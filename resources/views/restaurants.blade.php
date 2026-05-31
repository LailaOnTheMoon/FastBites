<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fast Bites - Premium Food Delivery</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Theme -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#FF8C00',
                        secondary: '#FFD580',
                        light: '#FFF8F0',
                        dark: '#1a1a1a'
                    },
                    fontFamily: {
                        poppins: ['Poppins', 'sans-serif'],
                        inter: ['Inter', 'sans-serif']
                    }
                }
            }
        }
    </script>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <!-- Custom Styles -->
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
    align-items: center;
}

nav {
    flex: 1;
    display: flex;
    justify-content: center;
    gap: 3rem;
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
            width: 48px;
            height: 48px;
            object-fit: contain;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
            transition: transform 0.3s ease;
        }

        .logo-img:hover {
            transform: scale(1.08);
        }

        .logo-text {
            font-size: 1.5rem;
            font-weight: 700;
            color: #FF8C00;
            font-family: 'Poppins', sans-serif;
            letter-spacing: -0.5px;
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

        nav a:hover {
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

        nav a:hover::after {
            width: 100%;
        }

        .cta-btn {
            background: linear-gradient(135deg, #FF8C00 0%, #FF7A00 100%);
            color: white;
            padding: 0.65rem 1.5rem;
            border-radius: 8px;
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
            box-shadow: 0 6px 18px rgba(255, 140, 0, 0.4);
        }

        /* ========== HERO SECTION ========== */
        .hero {
            background: linear-gradient(135deg, #FFF8F0 0%, rgba(255, 140, 0, 0.05) 100%);
            padding: 4rem 2rem;
            text-align: center;
        }

        .hero-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .hero h1 {
            font-family: 'Poppins', sans-serif;
            font-size: 3rem;
            font-weight: 800;
            color: #1a1a1a;
            margin-bottom: 1rem;
            line-height: 1.2;
            letter-spacing: -1px;
        }

        .hero p {
            font-size: 1.1rem;
            color: #666;
            margin-bottom: 2.5rem;
            font-weight: 400;
            line-height: 1.6;
        }

        .hero-highlight {
            color: #FF8C00;
            font-weight: 700;
        }

        /* ========== RESTAURANTS SECTION ========== */
        .restaurants-section {
            max-width: 1200px;
            margin: 0 auto;
            padding: 4rem 2rem;
        }

        .section-header {
            text-align: center;
            margin-bottom: 3.5rem;
        }

        .section-header h2 {
            font-family: 'Poppins', sans-serif;
            font-size: 2.5rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 0.75rem;
        }

        .section-header p {
            color: #999;
            font-size: 1.05rem;
            font-weight: 400;
        }

        .restaurants-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(360px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .restaurant-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            height: 100%;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .restaurant-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 12px 40px rgba(255, 140, 0, 0.2);
        }

        .card-image-container {
            position: relative;
            height: 260px;
            overflow: hidden;
        }

        .restaurant-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.5s ease;
        }

        .restaurant-card:hover img {
            transform: scale(1.08);
        }

        .card-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            background: #FF8C00;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 12px rgba(255, 140, 0, 0.3);
        }

        .card-content {
            padding: 1.8rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .restaurant-name {
            font-family: 'Poppins', sans-serif;
            font-size: 1.4rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 0.6rem;
            letter-spacing: -0.5px;
        }

        .restaurant-desc {
            color: #777;
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 1.5rem;
            flex-grow: 1;
            font-weight: 400;
        }

        .card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1.2rem;
            border-top: 1px solid #f0f0f0;
        }

        .card-rating {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            color: #FF8C00;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .card-link {
            background: linear-gradient(135deg, #FF8C00 0%, #FF7A00 100%);
            color: white;
            padding: 0.6rem 1.3rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            white-space: nowrap;
        }

        .card-link:hover {
            transform: translateX(4px);
            box-shadow: 0 4px 12px rgba(255, 140, 0, 0.3);
        }

        /* ========== FOOTER ========== */
        footer {
            background: #1a1a1a;
            color: white;
            padding: 3rem 2rem 2rem;
            margin-top: 5rem;
        }

        .footer-content {
            max-width: 1200px;
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

        .footer-divider {
            height: 1px;
            background: #333;
            margin: 1.5rem 0;
        }

        .footer-bottom {
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
            padding-top: 1.5rem;
            border-top: 1px solid #333;
            font-size: 0.9rem;
            color: #999;
        }

        /* ========== RESPONSIVE ========== */
        @media (max-width: 768px) {
            nav {
                display: none;
            }

            .cta-btn {
                display: none;
            }

            .hero h1 {
                font-size: 2rem;
            }

            .section-header h2 {
                font-size: 1.8rem;
            }

            .restaurants-grid {
                grid-template-columns: 1fr;
            }

            .navbar-container {
                padding: 1rem 1.5rem;
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

        <nav class="hidden md:flex">
            <a href="/">Home</a>
            <a href="/restaurants">Browse Restaurants</a>
            <a href="/about">About Us</a>
            <a href="/contact">Contact</a>
        </nav>

    </div>
</header>

<!-- ================= HERO SECTION ================= -->

<!-- ================= RESTAURANTS SECTION ================= -->
<section class="restaurants-section">
    <div class="section-header">
        <h2>Featured Restaurants</h2>
        <p>Explore our handpicked selection of exceptional dining partners</p>
    </div>

    <div class="restaurants-grid">
        <!-- Restaurant 1 -->
        <div class="restaurant-card">
            <div class="card-image-container">
                <img src="{{ asset('images/sweetshop.jpg') }}" alt="Sugar Bloom Dessert Lab">
                <span class="card-badge">Featured</span>
            </div>
            <div class="card-content">
                <h3 class="restaurant-name">Sugar Bloom Dessert Lab</h3>
                <p class="restaurant-desc">Decadent desserts crafted with love, from classic cakes to innovative treats. Indulge in artisanal sweetness.</p>
                <div class="card-footer">
                    <div class="card-rating">★★★★★ 4.8</div>
                    <a href="/menu" class="card-link">View Menu</a>
                </div>
            </div>
        </div>

        <!-- Restaurant 2 -->
        <div class="restaurant-card">
            <div class="card-image-container">
                <img src="{{ asset('images/pizzashop.jpg') }}" alt="BiteRush Kitchen">
                <span class="card-badge">Trending</span>
            </div>
            <div class="card-content">
                <h3 class="restaurant-name">BiteRush Kitchen</h3>
                <p class="restaurant-desc">Wood-fired pizzas with authentic flavors from around the world. Taste the tradition in every bite.</p>
                <div class="card-footer">
                    <div class="card-rating">★★★★★ 4.9</div>
                    <a href="/menu2" class="card-link">View Menu</a>
                </div>
            </div>
        </div>

        <!-- Restaurant 3 -->
        <div class="restaurant-card">
            <div class="card-image-container">
                <img src="{{ asset('images/drinkshop.jpg') }}" alt="Velvet Sip Bar">
                <span class="card-badge">Popular</span>
            </div>
            <div class="card-content">
                <h3 class="restaurant-name">Velvet Sip Bar</h3>
                <p class="restaurant-desc">Best milkshakes and smoothies, blending fresh fruits and creamy indulgence in every sip. Refresh your taste buds.</p>
                <div class="card-footer">
                    <div class="card-rating">★★★★☆ 4.7</div>
                    <a href="/menu3" class="card-link">View Menu</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ================= FOOTER ================= -->
<footer>
    <div class="footer-content">
        <div class="footer-section">
            <h3>Fast Bites</h3>
            <p>Your trusted delivery partner for premium food experiences. Taste excellence delivered.</p>
        </div>
        <div class="footer-section">
            <h3>Quick Links</h3>
            <a href="/">Home</a>
            <a href="/restaurants">Restaurants</a>
            <a href="/about">About</a>
            <a href="/contact">Contact</a>
        </div>
        <div class="footer-section">
            <h3>Support</h3>
            <a href="/faq">FAQ</a>
            <a href="/terms">Terms & Conditions</a>
            <a href="/privacy">Privacy Policy</a>
            <a href="/help">Help Center</a>
        </div>
        <div class="footer-section">
            <h3>Contact</h3>
            <p>Email: info@fastbites.com</p>
            <p>Phone: +1 (555) 123-4567</p>
            <p>Available 24/7 for your orders</p>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2024 Fast Bites. All rights reserved. | Crafted with care for food lovers.</p>
    </div>
</footer>

</body>
</html>