<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Menu — FastBites</title>

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

</head>
<style>
    .total-box {
  width: fit-content;
  min-width: 260px;

  margin: 30px auto 18px;

  padding: 16px 22px;

  border-radius: 18px;
}

.btn-next {
  width: 220px;

  display: block;

  margin: 0 auto;

  padding: 14px 18px;

  border-radius: 18px;
} </style>
<body class="welcome-page">
    <div class="container">
        <h1 class="title">FastBites</h1>
        <p class="subtitle">Sugar Bloom Dessert Lab</p>
        <div class="menu">
    <div class="menu-item">
        <img src="images/dessert6.jpg" alt="Orange Cake">
        <div class="menu-item-info">
            <h2 class="menu-item-name">Orange Cake</h2>
            <p class="menu-item-desc">Soft sponge cake with fresh orange flavor.</p>
            <div class="menu-item-meta">
                <span class="price">$6.99</span>
                <div class="controls">
                    <label><input type="checkbox" name="selected[]" value="orange_cake"> Select</label>
                    <input type="number" min="1" value="1">
                </div>
            </div>
        </div>
    </div>

    <div class="menu-item">
        <img src="images/blueberrycake.jpg" alt="Blueberry Cake">
        <div class="menu-item-info">
            <h2 class="menu-item-name">Blueberry Cake</h2>
            <p class="menu-item-desc">Creamy cake with fresh blueberry topping.</p>
            <div class="menu-item-meta">
                <span class="price">$7.49</span>
                <div class="controls">
                    <label><input type="checkbox" name="selected[]" value="blueberry_cake"> Select</label>
                    <input type="number" min="1" value="1">
                </div>
            </div>
        </div>
    </div>

    <div class="menu-item">
        <img src="images/chocholatecake.jpg" alt="Chocolate Cake">
        <div class="menu-item-info">
            <h2 class="menu-item-name">Chocolate Cake</h2>
            <p class="menu-item-desc">Rich chocolate cake for chocolate lovers.</p>
            <div class="menu-item-meta">
                <span class="price">$8.99</span>
                <div class="controls">
                    <label><input type="checkbox" name="selected[]" value="chocolate_cake"> Select</label>
                    <input type="number" min="1" value="1">
                </div>
            </div>
        </div>
    </div>

</div>
        </div>

    </div>
<div class="total-box" style="margin-top: 30px;">
    <span class="total-label">Final Total</span>
    <span class="total-amount" id="finalTotal">$0.00</span>
</div>

<button class="btn-next" onclick="goToOrderPage()">
    Next
</button>

<script>
const checkboxes = document.querySelectorAll('input[type="checkbox"]');
const totalElement = document.getElementById('finalTotal');
const finalElement = document.getElementById('finalTotal');

function calculateTotal() {

    let total = 0;

    document.querySelectorAll('.menu-item').forEach(item => {

        const checkbox = item.querySelector('input[type="checkbox"]');
        const quantity = item.querySelector('input[type="number"]');

        const priceText = item.querySelector('.price').innerText;
        const price = parseFloat(priceText.replace('$', ''));

        if (checkbox.checked) {
            total += price * parseInt(quantity.value);
        }
    });

    totalElement.innerText = `$${total.toFixed(2)}`;
}

checkboxes.forEach(box => {
    box.addEventListener('change', calculateTotal);
});

document.querySelectorAll('input[type="number"]').forEach(input => {
    input.addEventListener('input', calculateTotal);
});
</script>
<script>
function calculateTotal() {

    let total = 0;

    document.querySelectorAll('.menu-item').forEach(item => {

        const checkbox = item.querySelector('input[type="checkbox"]');
        const quantity = item.querySelector('input[type="number"]');

        const priceText = item.querySelector('.price').innerText;
        const price = parseFloat(priceText.replace('$', ''));

        if (checkbox.checked) {
            total += price * parseInt(quantity.value);
        }
    });

    totalElement.innerText = `$${total.toFixed(2)}`;
    finalElement.innerText = `$${total.toFixed(2)}`;
}

checkboxes.forEach(box => {
    box.addEventListener('change', calculateTotal);
});

document.querySelectorAll('input[type="number"]').forEach(input => {
    input.addEventListener('input', calculateTotal);
});

function goToOrderPage() {

    let orders = [];
    let total = 0;

    document.querySelectorAll('.menu-item').forEach(item => {

        const checkbox = item.querySelector('input[type="checkbox"]');

        if (checkbox.checked) {

            const name = item.querySelector('.menu-item-name').innerText;
            const quantity = item.querySelector('input[type="number"]').value;

            const priceText = item.querySelector('.price').innerText;
            const price = parseFloat(priceText.replace('$', ''));

            total += price * quantity;

            orders.push({
                name: name,
                quantity: quantity,
                price: price
            });
        }
    });

    localStorage.setItem('orders', JSON.stringify(orders));
    localStorage.setItem('total', total.toFixed(2));

    window.location.href = "/orderdetailes";
}
</script>
</body>
</html>
