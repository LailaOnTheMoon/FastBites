<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Driver GPS Tracking</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            margin: 0;
            padding: 24px;
        }

        .card {
            max-width: 520px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 20px;
            padding: 24px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .08);
        }

        h1 {
            margin-top: 0;
            color: #111827;
        }

        p {
            color: #4b5563;
            line-height: 1.6;
        }

        label {
            display: block;
            margin-top: 18px;
            margin-bottom: 8px;
            font-weight: bold;
            color: #374151;
        }

        input {
            width: 100%;
            box-sizing: border-box;
            padding: 12px;
            border: 1px solid #d1d5db;
            border-radius: 12px;
            font-size: 16px;
        }

        button {
            margin-top: 20px;
            width: 100%;
            border: none;
            border-radius: 12px;
            padding: 14px;
            background: #f97316;
            color: white;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
        }

        button.stop {
            background: #dc2626;
        }

        .status {
            margin-top: 18px;
            padding: 14px;
            border-radius: 12px;
            background: #fff7ed;
            color: #9a3412;
            font-weight: bold;
        }

        .status.good {
            background: #ecfdf5;
            color: #166534;
        }

        .status.warning {
            background: #fef3c7;
            color: #92400e;
        }

        .status.danger {
            background: #fee2e2;
            color: #991b1b;
        }

        .data {
            margin-top: 18px;
            line-height: 1.9;
            color: #374151;
            background: #f9fafb;
            border-radius: 14px;
            padding: 14px;
        }

        .accuracy-box {
            margin-top: 14px;
            padding: 12px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: bold;
            background: #f9fafb;
            color: #374151;
        }

        .accuracy-good {
            background: #ecfdf5;
            color: #166534;
        }

        .accuracy-medium {
            background: #fef3c7;
            color: #92400e;
        }

        .accuracy-low {
            background: #fee2e2;
            color: #991b1b;
        }

        .small {
            margin-top: 12px;
            color: #6b7280;
            font-size: 13px;
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>Driver GPS Tracking</h1>

        <p>
            Keep this page open while delivering the order.
            Your real GPS location will update automatically in FastBites.
        </p>

        <label for="driver_id">Driver ID</label>
        <input id="driver_id" type="number" value="1">

        <button id="start_button" onclick="startTracking()">Start GPS Tracking</button>
        <button id="stop_button" class="stop" onclick="stopTracking()" style="display: none;">Stop Tracking</button>

        <div id="status" class="status">
            Waiting to start...
        </div>

        <div class="data">
            <div>Latitude: <strong id="lat">-</strong></div>
            <div>Longitude: <strong id="lng">-</strong></div>
            <div>Accuracy: <strong id="accuracy">-</strong></div>
            <div>Last Update: <strong id="last_update">-</strong></div>
        </div>

        <div id="accuracy_message" class="accuracy-box">
            GPS accuracy status will appear here.
        </div>

        <p class="small">
            Note: GPS works best on HTTPS or localhost. Mobile GPS usually gives better accuracy than a laptop.
        </p>
    </div>

    <script>
        let watchId = null;
        let lastSentAt = 0;

        function startTracking() {
            const status = document.getElementById('status');

            if (!navigator.geolocation) {
                status.textContent = 'GPS is not supported by this browser.';
                status.className = 'status danger';
                return;
            }

            status.textContent = 'Requesting GPS permission...';
            status.className = 'status';

            watchId = navigator.geolocation.watchPosition(
                function (position) {
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;
                    const accuracy = position.coords.accuracy;

                    document.getElementById('lat').textContent = latitude.toFixed(7);
                    document.getElementById('lng').textContent = longitude.toFixed(7);
                    document.getElementById('accuracy').textContent = Math.round(accuracy) + ' meters';
                    document.getElementById('last_update').textContent = new Date().toLocaleTimeString();

                    updateAccuracyMessage(accuracy);

                    const now = Date.now();

                    // Send location every 10 seconds
                    if (now - lastSentAt >= 10000) {
                        lastSentAt = now;
                        sendLocation(latitude, longitude, accuracy);
                    }

                    status.textContent = 'GPS tracking is active.';
                    status.className = 'status good';

                    document.getElementById('start_button').style.display = 'none';
                    document.getElementById('stop_button').style.display = 'block';
                },
                function (error) {
                    status.textContent = 'GPS error: ' + error.message;
                    status.className = 'status danger';
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
            }

            document.getElementById('status').textContent = 'GPS tracking stopped.';
            document.getElementById('status').className = 'status warning';

            document.getElementById('start_button').style.display = 'block';
            document.getElementById('stop_button').style.display = 'none';
        }

        function updateAccuracyMessage(accuracy) {
            const accuracyMessage = document.getElementById('accuracy_message');
            const roundedAccuracy = Math.round(accuracy);

            if (accuracy <= 100) {
                accuracyMessage.textContent = `GPS Accuracy: Good (${roundedAccuracy} meters).`;
                accuracyMessage.className = 'accuracy-box accuracy-good';
            } else if (accuracy <= 1000) {
                accuracyMessage.textContent = `GPS Accuracy: Medium (${roundedAccuracy} meters). Mobile GPS is recommended for better tracking.`;
                accuracyMessage.className = 'accuracy-box accuracy-medium';
            } else {
                accuracyMessage.textContent = `GPS Accuracy: Low (${roundedAccuracy} meters). This location may be inaccurate. Please use a mobile device with GPS.`;
                accuracyMessage.className = 'accuracy-box accuracy-low';
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
                console.log('Location updated:', data);
            })
            .catch(error => {
                console.error('Location update failed:', error);

                const status = document.getElementById('status');
                status.textContent = 'Location update failed. Check console.';
                status.className = 'status danger';
            });
        }
    </script>
</body>
</html>