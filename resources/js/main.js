let currentIndex = 0;
const slider = document.getElementById('slider');

if (slider) {
    const totalSlides = slider.children.length;

    function updateSlide() {
        slider.style.transform = `translateX(-${currentIndex * 100}%)`;
    }

    function nextSlide() {
        currentIndex = (currentIndex + 1) % totalSlides;
        updateSlide();
    }

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