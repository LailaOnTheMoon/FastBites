const slider = document.getElementById('slider');

const sliderSlides = [
    {
        image: '/images/delivery.jpg',
        title: 'Fast Delivery',
        text: 'Fresh & Hot, delivered fast',
        buttonText: 'Order Now',
    },
    {
        image: '/images/sweet.jpg',
        title: 'Sweet Desserts',
        text: 'Cold & tasty treats',
        buttonText: 'Order Now',
    },
    {
        image: '/images/drinks.jpg',
        title: 'Refreshing Drinks',
        text: 'Stay cool with our smoothies',
        buttonText: 'Order Now',
    },
];

let currentIndex = 0;

function createSlide(slide) {
    const slideElement = document.createElement('div');
    slideElement.className = 'w-full h-[500px] flex-shrink-0 relative';
    slideElement.innerHTML = `
        <img src="${slide.image}" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/40 flex flex-col justify-center items-center text-white text-center">
            <h1 class="text-5xl font-bold mb-4">${slide.title}</h1>
            <p class="mb-6">${slide.text}</p>
            <button class="bg-orange-500 px-6 py-2 rounded-full hover:scale-105 transition">${slide.buttonText}</button>
        </div>
    `;
    return slideElement;
}

function renderSlides() {
    if (!slider) {
        return;
    }

    slider.innerHTML = '';
    sliderSlides.forEach(slide => {
        slider.appendChild(createSlide(slide));
    });
}

function updateSlide() {
    if (!slider) {
        return;
    }

    slider.style.transform = `translateX(-${currentIndex * 100}%)`;
}

function nextSlide() {
    currentIndex = (currentIndex + 1) % sliderSlides.length;
    updateSlide();
}

if (slider && sliderSlides.length) {
    renderSlides();
    setInterval(nextSlide, 3000);
}

/* ===== FADE IN ANIMATION ===== */
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('show');
        }
    });
});

document.querySelectorAll('.fade-in').forEach(el => {
    observer.observe(el);
});
function parsePrice(text) {
            return parseFloat(text.replace(/[^0-9.]/g, '')) || 0;
        }

        function updateTotal() {
            const items = document.querySelectorAll('.menu-item');
            let total = 0;

            items.forEach(item => {
                const checkbox = item.querySelector('input[type="checkbox"]');
                const qtyInput = item.querySelector('input[type="number"]');
                const priceEl = item.querySelector('.price');

                if (!checkbox || !qtyInput || !priceEl) return;

                if (!checkbox.checked) return;

                const price = parsePrice(priceEl.textContent);
                const qty = Math.max(1, Number(qtyInput.value) || 1);

                total += price * qty;
            });

            const totalEl = document.getElementById('orderTotal');
            const totalTopEl = document.getElementById('orderTotalTop');

            if (totalEl) {
                totalEl.textContent = `$${total.toFixed(2)}`;
            }

            if (totalTopEl) {
                totalTopEl.textContent = `$${total.toFixed(2)}`;
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.menu-item input[type="checkbox"], .menu-item input[type="number"]').forEach(el => {
                el.addEventListener('input', updateTotal);
            });
            updateTotal();
        });
          document.getElementById('loginForm').addEventListener('submit', (e) => {
            e.preventDefault();

            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value;

            if (!email || !password) {
                alert('Please fill in both email and password.');
                return;
            }

            // Temporary behavior; implement actual authentication endpoint logic.
            alert(`Signed in with ${email}. Redirecting...`);
            // window.location.href = '/dashboard';
        });