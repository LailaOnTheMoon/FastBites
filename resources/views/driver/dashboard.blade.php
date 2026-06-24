<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Driver Dashboard - FastBites</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Leaflet Map --}}
    <link
        rel="stylesheet"
        href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    />

    <script
        src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js">
    </script>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            color: #111827;
        }

        .page {
            max-width: 1180px;
            margin: 0 auto;
            padding: 24px;
        }

        .header {
            background: linear-gradient(135deg, #fff7ed, #ffffff);
            border-radius: 24px;
            padding: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .06);
        }

        .header h1 {
            margin: 0;
            font-size: 30px;
        }

        .header p {
            margin: 8px 0 0;
            color: #6b7280;
        }

        .badge {
            display: inline-flex;
            padding: 8px 14px;
            border-radius: 999px;
            background: #fff7ed;
            color: #ea580c;
            font-weight: bold;
            font-size: 13px;
            border: 1px solid #fed7aa;
        }

        .hidden {
            display: none;
        }

        .driver-menu-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .driver-menu-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: 1px solid #fed7aa;
            border-radius: 999px;
            background: #fff7ed;
            color: #ea580c;
            padding: 8px 14px;
            font-size: 13px;
            font-weight: bold;
            cursor: pointer;
        }

        .driver-menu {
            position: absolute;
            top: 44px;
            right: 0;
            z-index: 50;
            width: 230px;
            border-radius: 16px;
            background: white;
            border: 1px solid #e5e7eb;
            box-shadow: 0 14px 40px rgba(0, 0, 0, .12);
            padding: 10px;
        }

        .driver-menu-info {
            padding: 10px;
            border-radius: 12px;
            background: #f9fafb;
            color: #111827;
        }

        .driver-menu-info strong {
            display: block;
            font-size: 13px;
        }

        .driver-menu-info small {
            display: block;
            margin-top: 4px;
            color: #6b7280;
            font-size: 12px;
        }

        .driver-logout-button {
            margin-top: 10px;
            width: 100%;
            border: none;
            border-radius: 12px;
            padding: 11px 12px;
            background: #fee2e2;
            color: #dc2626;
            font-weight: bold;
            cursor: pointer;
            text-align: left;
        }

        .driver-logout-button:hover {
            background: #fecaca;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            gap: 18px;
            margin-top: 20px;
        }

        .card {
            background: #ffffff;
            border-radius: 22px;
            padding: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .05);
            border: 1px solid #e5e7eb;
        }

        .span-4 {
            grid-column: span 4;
        }

        .span-6 {
            grid-column: span 6;
        }

        .span-12 {
            grid-column: span 12;
        }

        .label {
            font-size: 12px;
            font-weight: bold;
            color: #f97316;
            text-transform: uppercase;
            letter-spacing: .05em;
            margin-bottom: 8px;
        }

        .value {
            font-size: 22px;
            font-weight: bold;
            color: #111827;
        }

        .muted {
            color: #6b7280;
            font-size: 14px;
            margin-top: 6px;
        }

        .status-box {
            margin-top: 14px;
            padding: 14px;
            border-radius: 14px;
            background: #fff7ed;
            color: #9a3412;
            font-weight: bold;
        }

        .status-box.good {
            background: #ecfdf5;
            color: #166534;
        }

        .status-box.warning {
            background: #fef3c7;
            color: #92400e;
        }

        .status-box.danger {
            background: #fee2e2;
            color: #991b1b;
        }

        input {
            width: 100%;
            box-sizing: border-box;
            margin-top: 8px;
            padding: 12px;
            border-radius: 12px;
            border: 1px solid #d1d5db;
            font-size: 15px;
        }

        button {
            border: none;
            border-radius: 12px;
            padding: 13px 16px;
            cursor: pointer;
            font-weight: bold;
            font-size: 14px;
        }

        .btn-primary {
            background: #f97316;
            color: white;
        }

        .btn-danger {
            background: #dc2626;
            color: white;
        }

        .btn-success {
            background: #16a34a;
            color: white;
        }

        .button-row {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 16px;
        }

        .button-row button {
            flex: 1;
            min-width: 160px;
        }

        #driver-map {
            height: 430px;
            width: 100%;
            border-radius: 18px;
            overflow: hidden;
            margin-top: 14px;
            border: 1px solid #e5e7eb;
        }

        .success-message {
            margin-top: 18px;
            padding: 14px;
            border-radius: 14px;
            background: #ecfdf5;
            color: #166534;
            font-weight: bold;
        }

        .empty {
            text-align: center;
            padding: 34px;
            color: #6b7280;
        }

        @media (max-width: 900px) {
            .span-4,
            .span-6,
            .span-12 {
                grid-column: span 12;
            }

            .header {
                flex-direction: column;
                align-items: flex-start;
            }
        }

            .active-orders-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
        margin-top: 14px;
    }

    .active-order-item {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 16px;
        padding: 16px;
        border: 1px solid #fed7aa;
        border-radius: 18px;
        background: #fff7ed;
    }

    .active-order-actions {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 8px;
        min-width: 150px;
    }

    .status-mini {
        display: inline-flex;
        width: fit-content;
        border-radius: 999px;
        padding: 6px 10px;
        font-size: 12px;
        font-weight: 700;
        text-transform: capitalize;
        background: #ffedd5;
        color: #c2410c;
        border: 1px solid #fdba74;
    }

    .status-mini.ready {
        background: #fef3c7;
        color: #92400e;
        border-color: #fcd34d;
    }

    .status-mini.dispatched {
        background: #dbeafe;
        color: #1d4ed8;
        border-color: #93c5fd;
    }

    .current-route-badge,
    .queued-route-badge {
        display: inline-flex;
        width: fit-content;
        border-radius: 999px;
        padding: 6px 10px;
        font-size: 11px;
        font-weight: 700;
    }

    .current-route-badge {
        background: #dcfce7;
        color: #166534;
        border: 1px solid #86efac;
    }

    .queued-route-badge {
        background: #f3f4f6;
        color: #4b5563;
        border: 1px solid #e5e7eb;
    }

    @media (max-width: 768px) {
        .active-order-item {
            flex-direction: column;
        }

        .active-order-actions {
            align-items: flex-start;
        }
    }

    .route-priority-box {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 16px;
    margin-top: 14px;
    padding: 18px;
    border-radius: 20px;
    border: 1px dashed #fb923c;
    background: linear-gradient(135deg, #fff7ed, #fffbeb);
}

.route-priority-meta {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 8px;
    min-width: 160px;
}

.route-priority-meta strong {
    font-size: 18px;
    color: #111827;
}

@media (max-width: 768px) {
    .route-priority-box {
        flex-direction: column;
    }

    .route-priority-meta {
        align-items: flex-start;
    }
}
    </style>
</head>
<body>
<div class="page">

    <div class="header">
        <div>
            <h1>Driver Dashboard</h1>
            <p>Manage your delivery order, update GPS location, and complete deliveries.</p>
        </div>

        <div class="driver-menu-wrapper">
            <button
                id="driver-menu-button"
                type="button"
                class="driver-menu-button"
                onclick="document.getElementById('driver-menu').classList.toggle('hidden')"
            >
                <span>
                    {{ $driver->first_name ?? 'Driver' }} {{ $driver->last_name ?? '' }}
                </span>

                <span>⌄</span>
            </button>

            <div id="driver-menu" class="driver-menu hidden">
                <div class="driver-menu-info">
                    <strong>{{ $driver->email ?? 'driver@fastbites.com' }}</strong>
                    <small>FastBites Driver</small>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="driver-logout-button">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid">
        {{-- Driver Info --}}
        <div class="card span-4">
            <div class="label">Driver</div>
            <div class="value">
                {{ $driver->first_name ?? 'Driver' }} {{ $driver->last_name ?? '' }}
            </div>
            <div class="muted">
                Phone: {{ $driver->phone_number ?? 'Not available' }}
            </div>
            <div class="muted">
                Status: {{ ucfirst($driver->availability_status ?? 'unknown') }}
            </div>
            <div class="muted">
                Vehicle: {{ $driver->vehicle_type ?? 'Not specified' }}
            </div>
        </div>

        {{-- Active Orders --}}
        <div class="card span-4">
            <div class="label">Active Orders</div>
            <div class="value">{{ $activeOrdersCount }}</div>
            <div class="muted">
                Orders currently ready or dispatched.
            </div>
        </div>

        {{-- Completed Orders --}}
        <div class="card span-4">
            <div class="label">Completed Orders</div>
            <div class="value">{{ $completedOrdersCount }}</div>
            <div class="muted">
                Delivered or completed orders.
            </div>
        </div>

        {{-- Current Order --}}
        <div class="card span-6">
            <div class="label">Current Delivery Order</div>

            @if($currentOrder)
                <div class="value">
                    {{ $currentOrder->order_number ?? ('ORD-' . $currentOrder->id) }}
                </div>

                <div class="muted">
                    Customer: {{ $currentOrder->customer_name ?? 'Customer' }}
                </div>

                <div class="muted">
                    Phone: {{ $currentOrder->customer_phone_number ?? 'Not available' }}
                </div>

                <div class="muted">
                    Address:
                    {{ $currentOrder->delivery_address_line_1 ?? $currentOrder->delivery_address ?? 'Not available' }}
                    {{ $currentOrder->delivery_city ? ', ' . $currentOrder->delivery_city : '' }}
                </div>

                <div class="muted">
                    Restaurant:
                    {{ $currentOrder->restaurant->name ?? 'Restaurant not available' }}
                </div>

                <div class="status-box">
                    Current Status: {{ ucfirst($currentOrder->fulfillment_status ?? 'unknown') }}
                </div>

                <div class="button-row">
                    @if($currentOrder->fulfillment_status === 'ready')
                        <form method="POST" action="{{ route('driver.orders.dispatched', $currentOrder) }}" style="flex: 1;">
                            @csrf
                            <button type="submit" class="btn-primary" style="width: 100%;">
                                Mark as Dispatched
                            </button>
                        </form>
                    @endif

                    @if($currentOrder->fulfillment_status === 'dispatched')
                        <form method="POST" action="{{ route('driver.orders.delivered', $currentOrder) }}" style="flex: 1;">
                            @csrf
                            <button type="submit" class="btn-success" style="width: 100%;">
                                Mark as Delivered
                            </button>
                        </form>
                    @endif
                </div>
            @else
                <div class="empty">
                    No active delivery order assigned to this driver.
                </div>
            @endif
        </div>

        {{-- AI Route Priority --}}
<div class="card span-12">
    <div class="label">AI Route Priority</div>

    @if(isset($recommendedNextOrder) && $recommendedNextOrder)
        <div class="route-priority-box">
            <div>
                <div class="value" style="font-size: 18px;">
                    Recommended Next Delivery:
                    {{ $recommendedNextOrder->order_number ?? ('ORD-' . $recommendedNextOrder->id) }}
                </div>

                <div class="muted">
                    Customer: {{ $recommendedNextOrder->customer_name ?? 'Customer' }}
                </div>

                <div class="muted">
                    Address:
                    {{ $recommendedNextOrder->delivery_address_line_1 ?? $recommendedNextOrder->delivery_address ?? 'Not available' }}
                    {{ $recommendedNextOrder->delivery_city ? ', ' . $recommendedNextOrder->delivery_city : '' }}
                </div>

                <div class="muted">
                    AI Reason:
                    {{ $recommendedNextOrder->route_priority_reason ?? 'Recommended based on active delivery priority.' }}
                </div>
            </div>

            <div class="route-priority-meta">
                <span class="status-mini {{ $recommendedNextOrder->fulfillment_status }}">
                    {{ ucfirst($recommendedNextOrder->fulfillment_status ?? 'unknown') }}
                </span>

                <span class="current-route-badge">
                    Best Next Route
                </span>

                <strong>
                    @if($recommendedNextOrder->route_distance_km !== null)
                        {{ number_format($recommendedNextOrder->route_distance_km, 2) }} km
                    @else
                        Distance unavailable
                    @endif
                </strong>
            </div>
        </div>
    @else
        <div class="empty">
            No route recommendation is available right now.
        </div>
    @endif
</div>

        {{-- Assigned Active Orders List --}}
<div class="card span-12">
    <div class="label">Assigned Active Orders</div>

    @if(isset($activeOrdersList) && $activeOrdersList->count() > 0)
        <div class="active-orders-list">
            @foreach($activeOrdersList as $order)
                <div class="active-order-item">
                    <div>
                        <div class="value" style="font-size: 16px;">
                            {{ $order->order_number ?? ('ORD-' . $order->id) }}
                        </div>

                        <div class="muted">
                            Customer: {{ $order->customer_name ?? 'Customer' }}
                        </div>

                        <div class="muted">
                            Address:
                            {{ $order->delivery_address_line_1 ?? $order->delivery_address ?? 'Not available' }}
                            {{ $order->delivery_city ? ', ' . $order->delivery_city : '' }}
                        </div>

                        <div class="muted">
                            Restaurant: {{ $order->restaurant->name ?? 'Restaurant not available' }}
                        </div>
                    </div>

                    <div class="active-order-actions">
                        <span class="status-mini {{ $order->fulfillment_status }}">
                            {{ ucfirst($order->fulfillment_status ?? 'unknown') }}
                        </span>

                        @if($currentOrder && $currentOrder->id === $order->id)
                            <span class="current-route-badge">
                                Current Map Route
                            </span>
                        @else
                            <span class="queued-route-badge">
                                Queued Delivery
                            </span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty">
            No assigned active orders are available.
        </div>
    @endif
</div>

        {{-- GPS Tracking --}}
        <div class="card span-6">
            <div class="label">Live GPS Tracking</div>
            <div class="value">Driver Location</div>

            <input id="driver_id" type="hidden" value="{{ $driver->id }}">

            <div class="button-row">
                <button id="start_button" class="btn-primary" onclick="startTracking()">
                    Start GPS Tracking
                </button>

                <button id="stop_button" class="btn-danger" onclick="stopTracking()" style="display: none;">
                    Stop Tracking
                </button>
            </div>

            <div id="gps_status" class="status-box">
                Waiting to start GPS tracking...
            </div>

            <div class="muted">
                Latitude: <strong id="lat">{{ $driver->current_latitude ?? '-' }}</strong>
            </div>

            <div class="muted">
                Longitude: <strong id="lng">{{ $driver->current_longitude ?? '-' }}</strong>
            </div>

            <div class="muted">
                Accuracy:
                <strong id="accuracy">
                    @if($driver->current_location_accuracy)
                        {{ round($driver->current_location_accuracy) }} meters
                    @else
                        -
                    @endif
                </strong>
            </div>

            <div class="muted">
                Last Update: <strong id="last_update">-</strong>
            </div>

            @php
    $driverAccuracy = $driver->current_location_accuracy;

    if ($driverAccuracy !== null) {
        if ($driverAccuracy <= 100) {
            $driverGpsStatus = 'Good';
            $driverGpsMessage = 'Your GPS location is accurate and reliable.';
            $driverGpsClass = 'good';
        } elseif ($driverAccuracy <= 1000) {
            $driverGpsStatus = 'Medium';
            $driverGpsMessage = 'Your GPS location is acceptable, but using a mobile phone is recommended.';
            $driverGpsClass = 'warning';
        } else {
            $driverGpsStatus = 'Low';
            $driverGpsMessage = 'Your GPS location is inaccurate. Please use a mobile device with GPS.';
            $driverGpsClass = 'danger';
        }
    } else {
        $driverGpsStatus = 'Unknown';
        $driverGpsMessage = 'Start GPS tracking to check your location accuracy.';
        $driverGpsClass = 'warning';
    }
@endphp

<div id="accuracy_message" class="status-box {{ $driverGpsClass }}">
    <div>
        GPS Accuracy: {{ $driverGpsStatus }}
    </div>

    <div style="margin-top: 6px; font-size: 13px; font-weight: normal;">
        @if($driverAccuracy !== null)
            Accuracy: {{ round($driverAccuracy) }} meters —
        @endif

        {{ $driverGpsMessage }}
    </div>
</div>
        </div>

        {{-- Map --}}
        <div class="card span-12">
            <div class="label">Delivery Map</div>
            <div class="value">Driver to Customer Route</div>

            <div id="driver-map"></div>
        </div>
    </div>
</div>

<script>
    let watchId = null;
    let lastSentAt = 0;

    function parseCoordinate(value) {
        const number = parseFloat(value);
        return Number.isNaN(number) ? null : number;
    }

    function hasValidLocation(location) {
        return location.latitude !== null && location.longitude !== null;
    }

    const driverData = {
        latitude: parseCoordinate(@json($driver->current_latitude)),
        longitude: parseCoordinate(@json($driver->current_longitude)),
    };

    const customerData = {
        latitude: parseCoordinate(@json($currentOrder && $currentOrder->delivery_latitude ? (float) $currentOrder->delivery_latitude : null)),
        longitude: parseCoordinate(@json($currentOrder && $currentOrder->delivery_longitude ? (float) $currentOrder->delivery_longitude : null)),
        label: @json($currentOrder ? ($currentOrder->delivery_address_line_1 ?? $currentOrder->delivery_address ?? 'Customer Delivery Location') : 'Customer Delivery Location')
    };

    const restaurantData = {
        latitude: parseCoordinate(@json($currentOrder && $currentOrder->restaurant && $currentOrder->restaurant->latitude ? (float) $currentOrder->restaurant->latitude : null)),
        longitude: parseCoordinate(@json($currentOrder && $currentOrder->restaurant && $currentOrder->restaurant->longitude ? (float) $currentOrder->restaurant->longitude : null)),
        label: @json($currentOrder && $currentOrder->restaurant ? ($currentOrder->restaurant->name ?? 'Restaurant Location') : 'Restaurant Location')
    };

    const defaultNablus = [32.2211, 35.2544];

    const nablusBounds = L.latLngBounds(
        [32.1750, 35.1900],
        [32.2850, 35.3350]
    );

    const map = L.map('driver-map', {
        zoomControl: true,
        scrollWheelZoom: true,
        maxBounds: nablusBounds,
        maxBoundsViscosity: 1.0,
        minZoom: 12,
        maxZoom: 19
    }).setView(defaultNablus, 14);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    let driverMarker = null;
    let customerMarker = null;
    let restaurantMarker = null;
    let routeLine = null;

    const driverIcon = L.divIcon({
        html: '<div style="background:#111827;color:white;width:36px;height:36px;border-radius:50%;display:flex;align-items:center;justify-content:center;border:3px solid #f97316;box-shadow:0 6px 16px rgba(0,0,0,.25);">🏍️</div>',
        className: '',
        iconSize: [36, 36],
        iconAnchor: [18, 18],
    });

    const customerIcon = L.divIcon({
        html: '<div style="background:#2563eb;color:white;width:36px;height:36px;border-radius:50%;display:flex;align-items:center;justify-content:center;border:3px solid white;box-shadow:0 6px 16px rgba(0,0,0,.20);">📍</div>',
        className: '',
        iconSize: [36, 36],
        iconAnchor: [18, 18],
    });

    const restaurantIcon = L.divIcon({
        html: '<div style="background:#f97316;color:white;width:36px;height:36px;border-radius:50%;display:flex;align-items:center;justify-content:center;border:3px solid white;box-shadow:0 6px 16px rgba(0,0,0,.20);">🏪</div>',
        className: '',
        iconSize: [36, 36],
        iconAnchor: [18, 18],
    });

    function setGpsStatus(message, className = 'status-box') {
        const status = document.getElementById('gps_status');
        if (!status) return;
        status.textContent = message;
        status.className = className;
    }

    function upsertMarker(existingMarker, coordinates, icon, popupText) {
        if (existingMarker) {
            existingMarker.setLatLng(coordinates);
            return existingMarker;
        }

        return L.marker(coordinates, { icon })
            .addTo(map)
            .bindPopup(popupText);
    }

    function drawMap() {
        const boundsPoints = [];
        const routePoints = [];

        if (hasValidLocation(restaurantData)) {
            const restaurantLatLng = [restaurantData.latitude, restaurantData.longitude];
            restaurantMarker = upsertMarker(
                restaurantMarker,
                restaurantLatLng,
                restaurantIcon,
                '<strong>Restaurant Location</strong><br>' + restaurantData.label
            );
            boundsPoints.push(restaurantLatLng);
        }

        if (hasValidLocation(customerData)) {
            const customerLatLng = [customerData.latitude, customerData.longitude];
            customerMarker = upsertMarker(
                customerMarker,
                customerLatLng,
                customerIcon,
                '<strong>Customer / Order Location</strong><br>' + customerData.label
            );
            boundsPoints.push(customerLatLng);
            routePoints.push(customerLatLng);
        }

        if (hasValidLocation(driverData)) {
            const driverLatLng = [driverData.latitude, driverData.longitude];
            const isDriverInsideNablus = nablusBounds.contains(driverLatLng);

            if (!isDriverInsideNablus) {
                setGpsStatus('Driver location is outside Nablus. GPS may be inaccurate.', 'status-box danger');
            }

            driverMarker = upsertMarker(
                driverMarker,
                driverLatLng,
                driverIcon,
                isDriverInsideNablus ? '<strong>Driver Location</strong>' : '<strong>Driver Location Outside Nablus</strong>'
            );

            boundsPoints.push(driverLatLng);
            routePoints.unshift(driverLatLng);
        }

        if (routeLine) {
            routeLine.remove();
            routeLine = null;
        }

        if (routePoints.length >= 2) {
            routeLine = L.polyline(routePoints, {
                color: '#f97316',
                weight: 5,
                opacity: 0.9
            }).addTo(map);
        }

        if (boundsPoints.length >= 2) {
            map.fitBounds(L.latLngBounds(boundsPoints), {
                padding: [50, 50],
                maxZoom: 15
            });
        } else if (boundsPoints.length === 1) {
            map.setView(boundsPoints[0], 15);
        } else {
            map.setView(defaultNablus, 14);
            setGpsStatus('No map coordinates are available for this order yet.', 'status-box warning');
        }
    }

    drawMap();

    function startTracking() {
        if (!navigator.geolocation) {
            setGpsStatus('GPS is not supported by this browser.', 'status-box danger');
            return;
        }

        setGpsStatus('Requesting GPS permission...', 'status-box');
        updateDriverStatus('available');

        watchId = navigator.geolocation.watchPosition(
            function (position) {
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;
                const accuracy = position.coords.accuracy;
                const browserLatLng = [latitude, longitude];
                const isInsideNablus = nablusBounds.contains(browserLatLng);
                const isReliable = isInsideNablus && accuracy <= 1000;

                document.getElementById('lat').textContent = latitude.toFixed(7);
                document.getElementById('lng').textContent = longitude.toFixed(7);
                document.getElementById('accuracy').textContent = Math.round(accuracy) + ' meters';
                document.getElementById('last_update').textContent = new Date().toLocaleTimeString();

                updateAccuracyMessage(accuracy, isInsideNablus);

                if (!isReliable) {
                    setGpsStatus('GPS reading ignored because it is outside Nablus or inaccurate. Use mobile GPS or update the driver location manually.', 'status-box danger');
                    drawMap();
                    return;
                }

                driverData.latitude = latitude;
                driverData.longitude = longitude;
                drawMap();

                const now = Date.now();

                if (now - lastSentAt >= 10000) {
                    lastSentAt = now;
                    sendLocation(latitude, longitude, accuracy);
                }

                setGpsStatus('GPS tracking is active.', 'status-box good');

                document.getElementById('start_button').style.display = 'none';
                document.getElementById('stop_button').style.display = 'inline-block';
            },
            function (error) {
                setGpsStatus('GPS error: ' + error.message, 'status-box danger');
            },
            {
                enableHighAccuracy: true,
                maximumAge: 5000,
                timeout: 10000
            }
        );
    }

    function stopTracking() {
        if (watchId !== null) {
            navigator.geolocation.clearWatch(watchId);
            watchId = null;
            updateDriverStatus('offline');
        }

        setGpsStatus('GPS tracking stopped.', 'status-box warning');

        document.getElementById('start_button').style.display = 'inline-block';
        document.getElementById('stop_button').style.display = 'none';
    }

    function updateAccuracyMessage(accuracy, isInsideNablus = true) {
        const accuracyMessage = document.getElementById('accuracy_message');
        if (!accuracyMessage) return;

        const roundedAccuracy = Math.round(accuracy);

        if (!isInsideNablus) {
            accuracyMessage.textContent = `GPS Accuracy: Low (${roundedAccuracy} meters). This location is outside Nablus and will not be saved.`;
            accuracyMessage.className = 'status-box danger';
        } else if (accuracy <= 100) {
            accuracyMessage.textContent = `GPS Accuracy: Good (${roundedAccuracy} meters).`;
            accuracyMessage.className = 'status-box good';
        } else if (accuracy <= 1000) {
            accuracyMessage.textContent = `GPS Accuracy: Medium (${roundedAccuracy} meters). Mobile GPS is recommended for better tracking.`;
            accuracyMessage.className = 'status-box warning';
        } else {
            accuracyMessage.textContent = `GPS Accuracy: Low (${roundedAccuracy} meters). This inaccurate location will not be saved.`;
            accuracyMessage.className = 'status-box danger';
        }
    }

    function sendLocation(latitude, longitude, accuracy) {
        const driverId = document.getElementById('driver_id').value;

        fetch("{{ route('driver.location.update') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                driver_id: driverId,
                latitude: latitude,
                longitude: longitude,
                accuracy: accuracy
            })
        })
        .then(response => response.json())
        .then(data => {
            console.log('Driver location updated:', data);
        })
        .catch(error => {
            console.error('Location update failed:', error);
            setGpsStatus('Location update failed. Check console.', 'status-box danger');
        });
    }

    document.addEventListener('click', function (event) {
        const button = document.getElementById('driver-menu-button');
        const menu = document.getElementById('driver-menu');

        if (!button || !menu) {
            return;
        }

        if (!button.contains(event.target) && !menu.contains(event.target)) {
            menu.classList.add('hidden');
        }
    });

    function updateDriverStatus(statusValue) {
        fetch("{{ route('driver.status.update') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                status: statusValue
            })
        })
        .then(response => response.json())
        .then(data => {
            console.log('Driver status updated:', data);
        })
        .catch(error => {
            console.error('Driver status update failed:', error);
        });
    }
</script>
</body>
</html>