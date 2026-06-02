<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Fast Bites</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

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
                        light: '#FFF8F0'
                    }
                }
            }
        }
    </script>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
</head>
<body class="bg-light font-sans">

<!-- ================= NAVBAR ================= -->
<header style="background: white; box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08); position: sticky; top: 0; z-index: 50;">
    <div style="max-width: 1400px; margin: 0 auto; padding: 1rem 2rem; display: flex; justify-content: space-between; align-items: center;">

        <div style="display: flex; align-items: center; gap: 0.75rem;">
            <img src="{{ asset('images/logo.png') }}" alt="Fast Bites Logo"
                 style="width: 48px; height: 48px; object-fit: contain;">
            <span style="font-size: 1.5rem; font-weight: 700; color: #FF8C00; font-family: 'Poppins', sans-serif;">
                Fast Bites
            </span>
        </div>

        <nav class="hidden md:flex" style="gap: 3rem; align-items: center;">
            <a href="/" style="text-decoration:none; color:#555; font-weight:500;">Home</a>

            @auth
                <a href="/restaurants" style="text-decoration:none; color:#555; font-weight:500;">Browse</a>
            @else
                <a href="/login" style="text-decoration:none; color:#555; font-weight:500;">Browse</a>
            @endauth

            <a href="/about" style="text-decoration:none; color:#FF8C00; font-weight:500; border-bottom:2px solid #FF8C00; padding-bottom:4px;">About</a>

            <a href="/contact"
               style="text-decoration:none; color:#555; font-weight:500;">
                Contact
            </a>
        </nav>

        <button onclick="window.location.href='{{ route('login') }}'"
                style="background: linear-gradient(135deg, #FF8C00 0%, #FF7A00 100%);
                       color: white;
                       padding: 0.75rem 1.75rem;
                       border-radius: 50px;
                       text-decoration: none;
                       font-weight: 600;
                       font-size: 0.9rem;
                       border: none;
                       cursor: pointer;
                       box-shadow: 0 4px 12px rgba(255, 140, 0, 0.3);">
            Order Now
        </button>

    </div>
</header>
<main>
    <section class="py-20">
        <div class="container mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">
            <div>
                <p class="text-orange-500 font-semibold mb-2">About Fast Bites</p>
                <h1 class="text-5xl md:text-6xl font-bold leading-tight">
                    Fresh meals, local restaurants, and fast delivery in one app.
                </h1>
                <p class="text-gray-500 mt-6 max-w-xl">
                    Fast Bites brings your favorite restaurants together with a simple ordering experience. We help customers discover delicious local kitchens, choose the best menu items, and get their meals delivered quickly.
                </p>
                <div class="mt-8 space-y-4">
                    <div class="rounded-3xl bg-white p-6 shadow-lg border border-orange-100">
                        <h2 class="text-xl font-semibold text-gray-800">Our mission</h2>
                        <p class="mt-3 text-gray-500">To make restaurant dining easy, fast, and delightful for every customer.</p>
                    </div>
                    <div class="rounded-3xl bg-white p-6 shadow-lg border border-orange-100">
                        <h2 class="text-xl font-semibold text-gray-800">What we offer</h2>
                        <p class="mt-3 text-gray-500">Restaurant discovery, curated menus, secure checkout, and same-day delivery from trusted local partners.</p>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="rounded-[2rem] bg-gradient-to-br from-orange-400 via-orange-500 to-yellow-400 p-8 text-white shadow-2xl">
                    <h2 class="text-3xl font-bold">Why customers love us</h2>
                    <p class="mt-4 text-orange-100">Quick order placement, fresh food, friendly restaurants, and live delivery updates.</p>
                </div>
                <div class="grid gap-6">
                    <div class="bg-white rounded-3xl p-6 shadow-lg">
                        <h3 class="text-xl font-semibold text-gray-900">Trusted restaurants</h3>
                        <p class="mt-3 text-gray-500">We partner with local restaurants that value quality ingredients and fast service.</p>
                    </div>
                    <div class="bg-white rounded-3xl p-6 shadow-lg">
                        <h3 class="text-xl font-semibold text-gray-900">Easy browsing</h3>
                        <p class="mt-3 text-gray-500">Filter menus, view popular dishes, and choose food that fits your cravings.</p>
                    </div>
                    <div class="bg-white rounded-3xl p-6 shadow-lg">
                        <h3 class="text-xl font-semibold text-gray-900">Flexible delivery</h3>
                        <p class="mt-3 text-gray-500">Order now for delivery at the best available time from restaurants nearby.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-[#FFF7ED]">
        <div class="container mx-auto px-6">
            <div class="text-center mb-10">
                <p class="text-orange-500 font-semibold mb-2">Restaurant partners</p>
                <h2 class="text-4xl font-bold">Meet the kitchens behind Fast Bites</h2>
                <p class="text-gray-500 mt-4 max-w-2xl mx-auto">From family-owned diners to trendy cafes, our restaurant network serves a wide range of flavors for every mood.</p>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white rounded-3xl p-8 shadow-lg">
                    <h3 class="text-2xl font-semibold text-gray-900">Bright Street Café</h3>
                    <p class="mt-3 text-gray-500">Fresh breakfast bowls, sandwiches, and coffee from a cozy local spot.</p>
                </div>
                <div class="bg-white rounded-3xl p-8 shadow-lg">
                    <h3 class="text-2xl font-semibold text-gray-900">Urban Grill</h3>
                    <p class="mt-3 text-gray-500">Bold flavors, juicy burgers, and grilled favorites made for comfort dining.</p>
                </div>
                <div class="bg-white rounded-3xl p-8 shadow-lg">
                    <h3 class="text-2xl font-semibold text-gray-900">Sweet & Spice</h3>
                    <p class="mt-3 text-gray-500">Delicious desserts, smoothies, and meals with a bright, creative twist.</p>
                </div>
            </div>
        </div>
    </section>
</main>

<footer class="bg-orange-500 text-white py-10 mt-10">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-2xl font-bold mb-3">Fast Bites</h2>
        <p class="text-sm opacity-90">Delicious food delivered fast. Fast Food, drinks, and desserts all in one place.</p>
    </div>
</footer>
</body>
</html>
