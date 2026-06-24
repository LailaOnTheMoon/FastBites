import sys
import json
import math
from datetime import datetime, timezone


def parse_datetime(value):
    if not value:
        return None

    try:
        value = value.replace("Z", "+00:00")
        parsed = datetime.fromisoformat(value)

        if parsed.tzinfo is None:
            parsed = parsed.replace(tzinfo=timezone.utc)

        return parsed
    except Exception:
        return None


def elapsed_minutes_since(value):
    parsed = parse_datetime(value)

    if parsed is None:
        return 0

    now = datetime.now(timezone.utc)
    elapsed_seconds = (now - parsed).total_seconds()

    return max(0, math.floor(elapsed_seconds / 60))


def distance_km(lat1, lng1, lat2, lng2):
    earth_radius_km = 6371

    d_lat = math.radians(lat2 - lat1)
    d_lng = math.radians(lng2 - lng1)

    a = (
        math.sin(d_lat / 2) ** 2
        + math.cos(math.radians(lat1))
        * math.cos(math.radians(lat2))
        * math.sin(d_lng / 2) ** 2
    )

    c = 2 * math.atan2(math.sqrt(a), math.sqrt(1 - a))

    return earth_radius_km * c


def calculate_duration_minutes(distance, average_speed_kmh):
    if average_speed_kmh <= 0:
        average_speed_kmh = 25

    return max(1, math.ceil((distance / average_speed_kmh) * 60))


def predict_eta(data):
    status = data.get("fulfillment_status", "pending")

    restaurant_lat = float(data["restaurant_latitude"])
    restaurant_lng = float(data["restaurant_longitude"])

    customer_lat = float(data["customer_latitude"])
    customer_lng = float(data["customer_longitude"])

    driver_lat = data.get("driver_latitude")
    driver_lng = data.get("driver_longitude")

    preparation_time = int(data.get("preparation_time_minutes", 20))
    average_speed_kmh = float(data.get("average_speed_kmh", 25))

    placed_at = data.get("placed_at")
    accepted_at = data.get("accepted_at")
    prepared_at = data.get("prepared_at")
    dispatched_at = data.get("dispatched_at")
    delivered_at = data.get("delivered_at")

    restaurant_to_customer_distance = distance_km(
        restaurant_lat,
        restaurant_lng,
        customer_lat,
        customer_lng
    )

    restaurant_to_customer_duration = calculate_duration_minutes(
        restaurant_to_customer_distance,
        average_speed_kmh
    )

    location_source = "restaurant"
    distance = restaurant_to_customer_distance
    delivery_duration = restaurant_to_customer_duration
    remaining_preparation_time = preparation_time
    order_stage = "Order received"
    elapsed_minutes = 0

    if status == "pending":
        order_stage = "Waiting for restaurant confirmation"

        elapsed_minutes = elapsed_minutes_since(placed_at)

        remaining_preparation_time = max(
            0,
            preparation_time - elapsed_minutes
        )

        distance = restaurant_to_customer_distance
        delivery_duration = restaurant_to_customer_duration
        location_source = "restaurant"

        predicted_eta = remaining_preparation_time + delivery_duration

        explanation = (
            "The order is pending. ETA is calculated using the real elapsed time "
            "since the order was placed, the remaining preparation time, and the "
            "estimated delivery time from the restaurant to the customer."
        )

    elif status == "accepted":
        order_stage = "Restaurant accepted the order"

        start_time = accepted_at or placed_at
        elapsed_minutes = elapsed_minutes_since(start_time)

        remaining_preparation_time = max(
            0,
            preparation_time - elapsed_minutes
        )

        distance = restaurant_to_customer_distance
        delivery_duration = restaurant_to_customer_duration
        location_source = "restaurant"

        predicted_eta = remaining_preparation_time + delivery_duration

        explanation = (
            "The restaurant accepted the order. ETA is calculated using the elapsed "
            "time since acceptance, the remaining preparation time, and the delivery "
            "duration from the restaurant to the customer."
        )

    elif status == "preparing":
        order_stage = "Food is being prepared"

        start_time = accepted_at or placed_at
        elapsed_minutes = elapsed_minutes_since(start_time)

        remaining_preparation_time = max(
            0,
            preparation_time - elapsed_minutes
        )

        distance = restaurant_to_customer_distance
        delivery_duration = restaurant_to_customer_duration
        location_source = "restaurant"

        predicted_eta = remaining_preparation_time + delivery_duration

        explanation = (
            "The food is being prepared. ETA decreases based on the real elapsed "
            "time since preparation started or since the order was accepted."
        )

    elif status == "ready":
        order_stage = "Food is ready for pickup"

        elapsed_minutes = elapsed_minutes_since(prepared_at)

        remaining_preparation_time = 0
        distance = restaurant_to_customer_distance
        delivery_duration = restaurant_to_customer_duration
        location_source = "restaurant"

        predicted_eta = delivery_duration

        explanation = (
            "The food is ready, so preparation time is zero. ETA is based on the "
            "delivery duration from the restaurant to the customer."
        )

    elif status == "dispatched":
        order_stage = "Order is with the driver"

        remaining_preparation_time = 0

        if driver_lat is not None and driver_lng is not None:
            driver_lat = float(driver_lat)
            driver_lng = float(driver_lng)

            distance = distance_km(
                driver_lat,
                driver_lng,
                customer_lat,
                customer_lng
            )

            original_delivery_duration = calculate_duration_minutes(
                distance,
                average_speed_kmh
            )

            elapsed_minutes = elapsed_minutes_since(dispatched_at)

            delivery_duration = max(
                0,
                original_delivery_duration - elapsed_minutes
            )

            predicted_eta = delivery_duration
            location_source = "driver"

            explanation = (
                "The order is with the driver. ETA is calculated using the driver's "
                "real current location, the customer location, and the elapsed time "
                "since dispatch."
            )
        else:
            distance = restaurant_to_customer_distance

            original_delivery_duration = restaurant_to_customer_duration
            elapsed_minutes = elapsed_minutes_since(dispatched_at)

            delivery_duration = max(
                0,
                original_delivery_duration - elapsed_minutes
            )

            predicted_eta = delivery_duration
            location_source = "restaurant"

            explanation = (
                "The order is dispatched, but driver location is unavailable. ETA "
                "uses restaurant-to-customer distance and elapsed time since dispatch."
            )

    elif status in ["delivered", "completed"]:
        order_stage = "Order delivered"

        elapsed_minutes = elapsed_minutes_since(delivered_at)

        remaining_preparation_time = 0
        distance = 0
        delivery_duration = 0
        predicted_eta = 0
        location_source = "delivered"

        explanation = (
            "The order has already been delivered, so the ETA is zero."
        )

    else:
        order_stage = "Unknown order stage"

        elapsed_minutes = elapsed_minutes_since(placed_at)

        remaining_preparation_time = max(
            0,
            preparation_time - elapsed_minutes
        )

        distance = restaurant_to_customer_distance
        delivery_duration = restaurant_to_customer_duration
        predicted_eta = remaining_preparation_time + delivery_duration
        location_source = "restaurant"

        explanation = (
            "The order status is unknown. ETA is estimated using elapsed time, "
            "remaining preparation time, and delivery duration."
        )

    if status in ["delivered", "completed"]:
        delay_risk = "None"
    elif predicted_eta <= 15:
        delay_risk = "Low"
    elif predicted_eta <= 30:
        delay_risk = "Medium"
    else:
        delay_risk = "High"

    if status == "pending":
        customer_update_message = (
            f"Your order has been received and is waiting for restaurant confirmation. "
            f"The estimated arrival time is {predicted_eta} minutes."
        )

    elif status == "accepted":
        customer_update_message = (
            f"The restaurant accepted your order. Preparation is expected to continue for "
            f"{remaining_preparation_time} minutes, and the estimated arrival time is "
            f"{predicted_eta} minutes."
        )

    elif status == "preparing":
        customer_update_message = (
            f"Your food is being prepared. About {remaining_preparation_time} minutes of "
            f"preparation remain, and the estimated arrival time is {predicted_eta} minutes."
        )

    elif status == "ready":
        customer_update_message = (
            f"Your food is ready for pickup. The estimated delivery time from the restaurant "
            f"to your location is {predicted_eta} minutes."
        )

    elif status == "dispatched":
        if location_source == "driver":
            customer_update_message = (
                f"Your driver is on the way. The driver is about {round(distance, 2)} km away, "
                f"and the estimated arrival time is {predicted_eta} minutes."
            )
        else:
            customer_update_message = (
                f"Your order is on the way, but the live driver location is not available. "
                f"The estimated arrival time is {predicted_eta} minutes."
            )

    elif status in ["delivered", "completed"]:
        customer_update_message = (
            "Your order has been delivered successfully. Thank you for ordering from FastBites."
        )

    else:
        customer_update_message = (
            f"Your order is being processed. The estimated arrival time is {predicted_eta} minutes."
        )

    return {
        "distance_km": round(distance, 2),
        "delivery_duration_minutes": delivery_duration,
        "remaining_preparation_minutes": remaining_preparation_time,
        "elapsed_minutes": elapsed_minutes,
        "predicted_eta_minutes": predicted_eta,
        "delay_risk": delay_risk,
        "location_source": location_source,
        "order_stage": order_stage,
        "fulfillment_status": status,
        "explanation": explanation,
        "customer_update_message": customer_update_message,
    }


if __name__ == "__main__":
    try:
        raw_input = sys.argv[1]
        data = json.loads(raw_input)

        result = predict_eta(data)

        print(json.dumps(result))
    except Exception as error:
        print(json.dumps({
            "error": str(error),
            "distance_km": None,
            "delivery_duration_minutes": None,
            "remaining_preparation_minutes": None,
            "elapsed_minutes": None,
            "predicted_eta_minutes": None,
            "delay_risk": "Unknown",
            "location_source": "unknown",
            "order_stage": "AI prediction failed",
            "fulfillment_status": "unknown",
            "explanation": "AI ETA prediction failed.",
            "customer_update_message": "We could not generate a smart delivery update at this time."
        }))