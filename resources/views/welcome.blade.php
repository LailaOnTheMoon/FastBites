<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fast Bites</title>

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
<header class="bg-white shadow-sm">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">

        <!-- Logo -->
        <div class="flex items-center gap-3">
            <img src="{{ asset('images/logo.png') }}"
     class="w-14 h-14 object-contain drop-shadow-md hover:scale-110 transition duration-300">
            <h1 class="text-xl font-bold text-orange-500">Fast Bites</h1>
        </div>

        <!-- Links -->
        <nav class="hidden md:flex gap-8 text-yellow-700">
            <a href="#" class="hover:text-orange-500">Home</a>
            <a href="#" class="hover:text-orange-500">Menu</a>
            <a href="#" class="hover:text-orange-500">About</a>
            <a href="#" class="hover:text-orange-500">Contact</a>
            <a href="#" class="hover:text-orange-500">Log In</a>
            
        </nav>

        <!-- Button -->
        <button class="bg-orange-500 text-white px-5 py-2 rounded-full hover:bg-orange-600 transition">
            Order Now
        </button>
    </div>
</header>


<!-- ================= HERO ================= -->
<section class="py-16">
    <div class="container mx-auto px-6 grid md:grid-cols-2 items-center gap-10">

        <!-- TEXT -->
        <div>
            <p class="text-orange-500 font-semibold mb-2">Welcome to</p>

            <h1 class="text-6xl md:text-7xl">
    Fast Bites <br>
    Enjoy 
    <span class="bg-gradient-to-r from-orange-400 to-orange-600 text-transparent bg-clip-text">
        Your Food
    </span>
</h1>

            <p class="text-gray-500 mt-4">
                Delicious meals, refreshing drinks, and sweet desserts delivered fast to your door.
            </p>

            <div class="mt-6 flex gap-4">
                <button class="bg-gradient-to-r from-orange-400 to-orange-600 text-white px-6 py-3 rounded-full shadow-lg hover:scale-105 transition">
    Order Now
</button>
            </div>
        </div>

    <div class="relative flex justify-center items-center">

    <!-- Glow خلفي -->
    <div class="absolute w-[420px] h-[420px] bg-orange-300 opacity-20 blur-3xl rounded-full"></div>

    <!-- Circle -->
    <div class="circle-bg w-[380px] h-[380px] relative flex items-center justify-center">

        <!-- Pizza -->
        <img src="{{ asset('images/pizza.png') }}"
             class="absolute w-[420px] float rotate-[-5deg] hover:rotate-0 hover:scale-140 transition duration-500 drop-shadow-2xl">

    </div>

</div>

</div>
    </div>
</section>


<!-- ================= POPULAR DISHES ================= -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-6">

        <h2 class="text-3xl font-bold text-gray-800 mb-4">
            Our Popular <span class="text-orange-500">Dishes</span>
        </h2>

<div class="grid md:grid-cols-4 gap-6 mt-4">
            <!-- Card -->
             <div class="fade-in" style="transition-delay: 0.1s">
            <div class="bg-light p-4 rounded-xl shadow hover:shadow-lg transition shadow fade-in">
                <img src="{{ asset('images/shawarma.jpg') }}"
                     class="rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition duration-300">
                <h3 class="font-semibold">Shawarma</h3>
                <p class="text-orange-500 font-bold">$10</p>
            </div>
        </div>


            <div class="fade-in" style="transition-delay: 0.1s">
            <div class="bg-light p-4 rounded-xl shadow hover:shadow-lg transition shadow fade-in">
                <img src="{{ asset('images/salad.jpg') }}"
                     class="rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition duration-300">
                <h3 class="font-semibold">Avocado Salad</h3>
                <p class="text-orange-500 font-bold">$6</p>
            </div></div>


            <div class="fade-in" style="transition-delay: 0.1s">
            <div class="bg-light p-4 rounded-xl shadow hover:shadow-lg transition shadow fade-in">
                <img src="{{ asset('images/dessert6.jpg') }}"
                     class="rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition duration-300">
                <h3 class="font-semibold">Orange Cake</h3>
                <p class="text-orange-500 font-bold">$7</p>
            </div>
            </div>

            <div class="fade-in" style="transition-delay: 0.1s">
            <div class="bg-light p-4 rounded-xl shadow hover:shadow-lg transition shadow fade-in">
                <img src="{{ asset('images/smoothie3.jpg') }}"
                     class="rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition duration-300">
                <h3 class="font-semibold">Fruit Mix</h3>
                <p class="text-orange-500 font-bold">$5</p>
            </div>

        </div>
    </div>
</section>

   <!-- SLIDER -->
<div class="relative w-full h-[500px] overflow-hidden">

    <div id="slider" class="flex transition-transform duration-700"></div>

</div>

<section class="py-16 bg-[#FFF7ED] text-center">

    <h2 class="text-3xl font-bold mb-10">Why Choose Us</h2>

    <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">

        <div class="p-6 bg-white rounded-2xl shadow hover:shadow-xl transition">
            <h3 class="text-xl font-semibold mb-2">⚡ Fast Delivery</h3>
            <p>Get your food delivered hot and fresh in minutes.</p>
        </div>

        <div class="p-6 bg-white rounded-2xl shadow hover:shadow-xl transition">
            <h3 class="text-xl font-semibold mb-2">🍔 Quality Food</h3>
            <p>We use the best ingredients for maximum taste.</p>
        </div>

        <div class="p-6 bg-white rounded-2xl shadow hover:shadow-xl transition">
            <h3 class="text-xl font-semibold mb-2">🥤 Variety</h3>
            <p>Food, desserts, and drinks all in one place.</p>
        </div>

    </div>

</section>
<section class="py-16 text-center">

    <h2 class="text-3xl font-bold mb-10">Categories</h2>

    <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">

        <div class="relative group">
            <img src="{{ asset('images/burger.png') }}" class="mx-auto h-40 object-contain">
            <h3 class="mt-4 text-xl font-semibold">Food</h3>
        </div>

        <div class="relative group">
            <img src="{{ asset('images/dessert4.png') }}" class="mx-auto h-40 object-contain">
            <h3 class="mt-4 text-xl font-semibold">Desserts</h3>
        </div>

        <div class="relative group">
            <img src="{{ asset('images/smoothie1.png') }}" class="mx-auto h-40 object-contain">
            <h3 class="mt-4 text-xl font-semibold">Drinks</h3>
        </div>

    </div>

</section>
<section class="py-16 py-16 text-center text-center">

    <h2 class="text-3xl font-bold mb-10">What Our Customers Say</h2>

    <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">

        <div class="bg-white p-6 rounded-2xl shadow hover:shadow-xl transition">
            <p class="mb-4">"Best burger I’ve ever had! Super fast delivery."</p>
            <h4 class="font-semibold">— Sarah</h4>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow hover:shadow-xl transition">
            <p class="mb-4">"Desserts are amazing and very fresh!"</p>
            <h4 class="font-semibold">— Ahmed</h4>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow hover:shadow-xl transition">
            <p class="mb-4">"Love the smoothies, highly recommended!"</p>
            <h4 class="font-semibold">— Lina</h4>
        </div>

    </div>

</section>


<!-- ================= FOOTER ================= -->
<footer class="bg-orange-500 text-white py-10">
    <div class="container mx-auto px-6 text-center">

        <h2 class="text-2xl font-bold mb-3">Fast Bites</h2>

        <p class="text-sm opacity-90">
            Delicious food delivered fast. Fast Food, drinks, and desserts all in one place.
        </p>

        <div class="mt-4 flex justify-center gap-6">
            <a href="#" class="hover:underline">Privacy</a>
            <a href="#" class="hover:underline">Terms</a>
            <a href="#" class="hover:underline">Contact</a>
        </div>

        <p class="mt-6 text-sm opacity-80">
            © 2026 Fast Bites. All rights reserved.
        </p>

    </div>
</footer>

@vite(['resources/js/app.js'])
</body>
</html>