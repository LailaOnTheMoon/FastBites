<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Order Details — FastBites</title>

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #FFF8F0 0%, rgba(255, 140, 0, 0.05) 100%);
            color: #1a1a1a;
            min-height: 100vh;
        }

        /* ========== NAVBAR ========== */
        header.navbar {
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
            justify-content: space-between;
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
            width: 40px;
            height: 40px;
            object-fit: contain;
        }

        .logo-text {
            font-size: 1.3rem;
            font-weight: 700;
            color: #FF8C00;
            font-family: 'Poppins', sans-serif;
        }

        .breadcrumb {
            display: flex;
            gap: 0.5rem;
            align-items: center;
            color: #999;
            font-size: 0.9rem;
        }

        .breadcrumb a {
            color: #FF8C00;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .breadcrumb a:hover {
            color: #FF7A00;
        }

        .breadcrumb-separator {
            color: #ddd;
        }

        /* ========== MAIN CONTAINER ========== */
        .main-container {
            max-width: 900px;
            margin: 0 auto;
            padding: 3rem 2rem;
        }

        .page-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .page-header h1 {
            font-family: 'Poppins', sans-serif;
            font-size: 2.5rem;
            font-weight: 800;
            color: #1a1a1a;
            margin-bottom: 0.5rem;
            letter-spacing: -0.5px;
        }

        .page-header p {
            color: #777;
            font-size: 1.05rem;
            font-weight: 400;
        }

        /* ========== ORDER CARD ========== */
        .order-card {
            background: white;
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 2px solid #f5f5f5;
        }

        .order-number {
            font-family: 'Poppins', sans-serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: #1a1a1a;
        }

        .order-status {
            background: linear-gradient(135deg, #FFD580 0%, #FFC85C 100%);
            color: #1a1a1a;
            padding: 0.6rem 1.2rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: capitalize;
        }

        .order-meta {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            margin-bottom: 2rem;
            padding: 1.5rem;
            background: #f9f9f9;
            border-radius: 12px;
        }

        .meta-item {
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
        }

        .meta-label {
            font-size: 0.85rem;
            color: #999;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .meta-value {
            font-family: 'Poppins', sans-serif;
            font-size: 1.1rem;
            color: #1a1a1a;
            font-weight: 600;
            word-break: break-word;
        }

        .ai-message {
            color: #FF8C00;
            font-weight: 500;
        }

        /* ========== ORDER ITEMS ========== */
        .items-section {
            margin-bottom: 2rem;
        }

        .items-title {
            font-family: 'Poppins', sans-serif;
            font-size: 1.3rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 1rem;
        }

        .order-items {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.2rem;
            background: #f9f9f9;
            border-radius: 12px;
            transition: all 0.3s ease;
            border-left: 4px solid #FF8C00;
        }

        .item:hover {
            background: #f0f0f0;
            transform: translateX(4px);
        }

        .item-info {
            display: flex;
            flex-direction: column;
            gap: 0.3rem;
        }

        .item-name {
            font-family: 'Poppins', sans-serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: #1a1a1a;
        }

        .item-meta {
            font-size: 0.9rem;
            color: #999;
            display: flex;
            gap: 1rem;
        }

        .item-price {
            font-family: 'Poppins', sans-serif;
            font-size: 1.3rem;
            font-weight: 700;
            color: #FF8C00;
        }

        /* ========== ORDER TOTAL ========== */
        .total-section {
            background: linear-gradient(135deg, #FF8C00 0%, #FF7A00 100%);
            color: white;
            padding: 2rem;
            border-radius: 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            box-shadow: 0 8px 24px rgba(255, 140, 0, 0.3);
        }

        .total-label {
            font-size: 1rem;
            font-weight: 500;
            opacity: 0.95;
        }

        .total-amount {
            font-family: 'Poppins', sans-serif;
            font-size: 2.2rem;
            font-weight: 800;
            letter-spacing: -0.5px;
        }

        /* ========== BUTTONS ========== */
        .button-section {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-next {
            background: linear-gradient(135deg, #FF8C00 0%, #FF7A00 100%);
            color: white;
            border: none;
            padding: 1rem 2.5rem;
            border-radius: 12px;
            font-family: 'Poppins', sans-serif;
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 6px 20px rgba(255, 140, 0, 0.3);
            min-width: 200px;
        }

        .btn-next:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(255, 140, 0, 0.4);
        }

        .btn-next:active {
            transform: translateY(-1px);
        }

        .btn-back {
            background: white;
            color: #FF8C00;
            border: 2px solid #FF8C00;
            padding: 1rem 2.5rem;
            border-radius: 12px;
            font-family: 'Poppins', sans-serif;
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            min-width: 200px;
        }

        .btn-back:hover {
            background: #FFF8F0;
        }

        /* ========== LOADING STATE ========== */
        .loading {
            opacity: 0.6;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 0.6; }
            50% { opacity: 1; }
        }

        /* ========== RESPONSIVE ========== */
        @media (max-width: 768px) {
            .main-container {
                padding: 2rem 1.5rem;
            }

            .navbar-container {
                padding: 1rem 1.5rem;
            }

            .order-card {
                padding: 1.5rem;
            }

            .page-header h1 {
                font-size: 1.8rem;
            }

            .order-header {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }

            .order-meta {
                grid-template-columns: 1fr;
            }

            .total-section {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .button-section {
                flex-direction: column;
            }

            .btn-next,
            .btn-back {
                width: 100%;
            }

            .item {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.8rem;
            }
        }
    </style>
</head>
<body>

<!-- ================= NAVBAR ================= -->
<header class="navbar">
    <div class="navbar-container">
        <a href="/" class="logo-section">
            <img src="{{ asset('images/logo.png') }}" alt="Fast Bites Logo" class="logo-img">
            <span class="logo-text">Fast Bites</span>
        </a>
        <nav class="breadcrumb">
            <a href="/">Home</a>
            <span class="breadcrumb-separator">/</span>
            <a href="/restaurants">Restaurants</a>
            <span class="breadcrumb-separator">/</span>
            <span>Order Details</span>
        </nav>
    </div>
</header>

<!-- ================= MAIN CONTENT ================= -->
<div class="main-container">
    <!-- ========== PAGE HEADER ========== -->
    <div class="page-header">
        <h1>Order Summary</h1>
        <p>Review your order details before proceeding to payment</p>
    </div>

    <!-- ========== ORDER CARD ========== -->
    <div class="order-card">
        <!-- Order Header -->
        <div class="order-header">
            <div class="order-number">Order #0421</div>
            <div class="order-status">Preparing</div>
        </div>

        <!-- Order Meta Info -->
        <div class="order-meta">
            <div class="meta-item">
                <span class="meta-label">Status Update</span>
                <span class="meta-value ai-message" id="aiMessage">
                    <span class="loading">Loading update...</span>
                </span>
            </div>
            <div class="meta-item">
                <span class="meta-label">Delivery Distance</span>
                <span class="meta-value" id="deliveryDistance">1.2 mi away</span>
            </div>
        </div>

        <!-- Order Items -->
        <div class="items-section">
            <h2 class="items-title">Order Items</h2>
            <div class="order-items" id="orderItems">
                <div class="item loading">
                    <div class="item-name">Loading items...</div>
                </div>
            </div>
        </div>

        <!-- Order Total -->
        <div class="total-section">
            <div>
                <div class="total-label">Order Total</div>
            </div>
            <div class="total-amount" id="orderTotal">$0.00</div>
        </div>

        <!-- Action Buttons -->
        <div class="button-section">
            <button class="btn-back" onclick="window.history.back()">
                Go Back
            </button>
            <button class="btn-next" onclick="goToPaymentPage()">
                Proceed to Payment
            </button>
        </div>
    </div>
</div>

<script>
    // Load orders from localStorage
    const orders = JSON.parse(localStorage.getItem('orders')) || [];
    console.log(orders);
    const total = localStorage.getItem('total') || "0.00";

    const container = document.getElementById('orderItems');

    // Clear loading state
    container.innerHTML = '';

    // Populate order items
    if (orders.length > 0) {
        orders.forEach(item => {
            const itemElement = document.createElement('div');
            itemElement.className = 'item';
            itemElement.innerHTML = `
                <div class="item-info">
                    <p class="item-name">${item.name}</p>
                    <div class="item-meta">
                        <span>Quantity: ${item.quantity}</span>
                        <span>Unit Price: $${parseFloat(item.price).toFixed(2)}</span>
                    </div>
                </div>
                <div class="item-price">
                    $${(parseFloat(item.price) * parseInt(item.quantity)).toFixed(2)}
                </div>
            `;
            container.appendChild(itemElement);
        });
    } else {
        container.innerHTML = '<div style="text-align: center; padding: 2rem; color: #999;">No items in order</div>';
    }

    // Set total
    document.getElementById('orderTotal').innerText = `$${parseFloat(total).toFixed(2)}`;

    // Calculate ETA based on order complexity
    function calculateETA(orders) {
        let baseTime = 10; // Base preparation time in minutes
        let totalQuantity = 0;
        
        // Calculate total quantity
        orders.forEach(item => {
            totalQuantity += parseInt(item.quantity);
        });
        
        // Add 2 minutes per item for preparation
        let preparationTime = baseTime + (orders.length * 3);
        
        // Add 1 minute per quantity for cooking
        let cookingTime = totalQuantity * 1.5;
        
        // Total ETA
        let eta = Math.ceil(preparationTime + cookingTime);
        
        // Cap at maximum 45 minutes, minimum 10 minutes
        return Math.max(10, Math.min(eta, 45));
    }

    // Calculate delivery distance (in a real app, use geolocation or DB)
    function calculateDistance(orders) {
        // Base distance + variation based on order size
        const baseDistance = 0.8;
        const variation = (orders.length * 0.15); // 0.15 miles per item type
        const totalDistance = baseDistance + variation;
        
        return parseFloat(totalDistance.toFixed(2));
    }

    // Generate AI message with calculated values
    async function generateAIMessage() {
        const eta = calculateETA(orders);
        const distance = calculateDistance(orders);
        const status = "Preparing";

        // Update display immediately
        document.getElementById('deliveryDistance').innerText = `${distance} mi away`;

        try {
            const response = await fetch('/generate-ai-message', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    status: status,
                    eta: eta,
                    distance: distance,
                    itemCount: orders.length,
                    totalQuantity: orders.reduce((sum, item) => sum + parseInt(item.quantity), 0)
                })
            });

            const data = await response.json();
            
            if (data.message) {
                document.getElementById('aiMessage').innerText = data.message;
            } else {
                document.getElementById('aiMessage').innerText = `Your order is being prepared! ETA: ${eta} minutes.`;
            }
        } catch (error) {
            console.error('Error:', error);
            document.getElementById('aiMessage').innerText = `Your order is being prepared! ETA: ${eta} minutes.`;
        }
    }

    // Generate AI message on page load
    generateAIMessage();

    // Navigation function
    function goToPaymentPage() {
        window.location.href = "/payment";
    }
</script>
</body>
</html>