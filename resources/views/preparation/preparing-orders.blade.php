<x-guest-layout>
  <div class="auth-shell">
    <div class="auth-card text-center">
      <!-- العنوان الرئيسي -->
      <h1 class="mb-6">In Preparation</h1>

      <!-- اسم الزبون -->
      <div class="form-group">
        <label for="customer">Customer Name</label>
        <input type="text" id="customer" class="input" placeholder="Enter customer's name">
      </div>

      <!-- حالة التحضير -->
      <div class="status-box preparing">
        Preparing
      </div>

      <!-- المؤقت -->
      <div id="timer" class="timer-box">
        00:00:00
      </div>

      <!-- حالة جاهز -->
      <div class="status-box prepared">
        Prepared
      </div>
    </div>
  </div>

  <!-- JavaScript للعداد -->
  <script>
    let seconds = 0;
    let minutes = 0;
    let hours = 0;

    function updateTimer() {
      seconds++;
      if (seconds === 60) {
        seconds = 0;
        minutes++;
      }
      if (minutes === 60) {
        minutes = 0;
        hours++;
      }
      if (hours === 12) {
        hours = 0;
        minutes = 0;
        seconds = 0;
      }

      // تنسيق العرض hh:mm:ss
      const formatted =
        String(hours).padStart(2, '0') + ":" +
        String(minutes).padStart(2, '0') + ":" +
        String(seconds).padStart(2, '0');

      document.getElementById("timer").textContent = formatted;
    }

    setInterval(updateTimer, 1000); // يحدث كل ثانية
  </script>
</x-guest-layout>