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

    <style>
        :root {
            --orange: #EC6426;
            --amber: #F8A91F;
            --dark: #1c1a1a;
            --shadow-soft: 0 8px 24px rgba(0, 0, 0, 0.12);
            --radius-lg: 22px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Space Grotesk', 'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            color: var(--dark);
            background: var(--orange);
            position: relative;
            overflow-x: hidden;
            padding: 28px 18px 56px;
        }

        .layout {
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .title {
            text-align: center;
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 700;
            color: var(--amber);
            margin-bottom: 40px;
            text-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .restaurants {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 24px;
        }

        .restaurant-card {
            background: var(--amber);
            border-radius: var(--radius-lg);
            padding: 24px;
            box-shadow: var(--shadow-soft);
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            animation: fadeInUp 0.8s ease-out forwards;
            opacity: 0;
            transform: translateY(30px);
        }

        .restaurant-card:nth-child(1) { animation-delay: 0.1s; }
        .restaurant-card:nth-child(2) { animation-delay: 0.3s; }
        .restaurant-card:nth-child(3) { animation-delay: 0.5s; }

        .restaurant-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 16px 40px rgba(0, 0, 0, 0.2);
        }

        .restaurant-name {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 12px;
            color: var(--dark);
        }

        .restaurant-desc {
            font-size: 1rem;
            color: var(--dark);
            opacity: 0.8;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 600px) {
            .restaurants {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="layout">
        <h1 class="title">FastBites</h1>

        <div class="restaurants">
            <div class="restaurant-card">
                <div class="restaurant-name">Burger Haven</div>
                <div class="restaurant-desc">Juicy burgers with fresh ingredients, perfect for a quick bite.</div>
            </div>
            <div class="restaurant-card">
                <div class="restaurant-name">Pizza Palace</div>
                <div class="restaurant-desc">Wood-fired pizzas with authentic flavors from around the world.</div>
            </div>
            <div class="restaurant-card">
                <div class="restaurant-name">Taco Town</div>
                <div class="restaurant-desc">Spicy tacos and fresh salsas, a fiesta in every bite.</div>
            </div>
        </div>
    </div>
</body>
</html>
