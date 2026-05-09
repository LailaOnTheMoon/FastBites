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

<header class="bg-white shadow-sm">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
        <div class="flex items-center gap-3">
            <img src="{{ asset('images/logo.png') }}" class="w-14 h-14 object-contain drop-shadow-md hover:scale-110 transition duration-300">
            <h1 class="text-xl font-bold text-orange-500">Fast Bites</h1>
        </div>

        <nav class="hidden md:flex gap-8 text-yellow-700">
            <a href="/" class="hover:text-orange-500">Home</a>
            <a href="/restaurants" class="hover:text-orange-500">Menu</a>
            <a href="/about" class="hover:text-orange-500">About</a>
            <a href="/contact" class="text-orange-500 font-semibold">Contact</a>
        </nav>

        <a href="{{ route('login') }}" class="bg-orange-500 text-white px-5 py-2 rounded-full hover:bg-orange-600 transition">Order Now</a>
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
