<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Fast Bites</title>

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

            <a href="/about" style="text-decoration:none; color:#555; font-weight:500;">About</a>

            <a href="/contact"
               style="text-decoration:none; color:#FF8C00; font-weight:500; border-bottom:2px solid #FF8C00; padding-bottom:4px;">
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
                <p class="text-orange-500 font-semibold mb-2">Get in touch</p>
                <h1 class="text-5xl md:text-6xl font-bold leading-tight">
                    Contact restaurants, ask questions, and order with confidence.
                </h1>
                <p class="text-gray-500 mt-6 max-w-xl">
                    Need to call a restaurant, send a message, or confirm your order? Fast Bites makes it easy to connect with restaurants and get answers fast.
                </p>
                <div class="mt-8 space-y-4">
                    <div class="rounded-3xl bg-white p-6 shadow-lg border border-orange-100">
                        <h2 class="text-xl font-semibold text-gray-800">Call restaurants directly</h2>
                        <p class="mt-3 text-gray-500">Tap the phone icon to speak with a restaurant team for special requests or menu guidance.</p>
                    </div>
                    <div class="rounded-3xl bg-white p-6 shadow-lg border border-orange-100">
                        <h2 class="text-xl font-semibold text-gray-800">Send messages instantly</h2>
                        <p class="mt-3 text-gray-500">Use our messaging tools to ask about ingredients, delivery times, or order updates.</p>
                    </div>
                </div>
            </div>

            <div class="rounded-[2rem] bg-gradient-to-br from-orange-400 via-orange-500 to-yellow-400 p-10 text-white shadow-2xl">
                <h2 class="text-3xl font-bold">Need help now?</h2>
                <p class="mt-4 text-orange-100">Open a call or message option for your favorite restaurant and get fast support for your order.</p>
                <div class="mt-10 grid gap-4">
                    <a href="tel:+1234567890" class="inline-flex items-center justify-center rounded-full bg-white/15 px-6 py-4 text-white font-semibold shadow-lg hover:bg-white/25 transition">
                        📞 Call a restaurant
                    </a>
                    <a href="sms:+1234567890" class="inline-flex items-center justify-center rounded-full bg-white/15 px-6 py-4 text-white font-semibold shadow-lg hover:bg-white/25 transition">
                        💬 Send a message
                    </a>
                    <a href="mailto:support@fastbites.example" class="inline-flex items-center justify-center rounded-full bg-white/15 px-6 py-4 text-white font-semibold shadow-lg hover:bg-white/25 transition">
                        ✉️ Email customer support
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-white">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-4xl font-bold mb-4">Restaurant support and order help</h2>
            <p class="text-gray-500 max-w-2xl mx-auto">Whether you want to update a request, check delivery status, or ask about menu options, our contact page gives you quick access to the right restaurant.</p>
            <div class="mt-12 grid md:grid-cols-3 gap-8">
                <div class="rounded-3xl bg-light p-8 shadow-lg">
                    <h3 class="text-2xl font-semibold text-gray-900">Quick action</h3>
                    <p class="mt-3 text-gray-500">Use the call and message buttons to reach restaurants at once.</p>
                </div>
                <div class="rounded-3xl bg-light p-8 shadow-lg">
                    <h3 class="text-2xl font-semibold text-gray-900">Order support</h3>
                    <p class="mt-3 text-gray-500">Get help with special requests, allergies, or meal substitutions.</p>
                </div>
                <div class="rounded-3xl bg-light p-8 shadow-lg">
                    <h3 class="text-2xl font-semibold text-gray-900">Fast replies</h3>
                    <p class="mt-3 text-gray-500">Restaurants can answers questions quickly so your food arrives just how you want it.</p>
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
