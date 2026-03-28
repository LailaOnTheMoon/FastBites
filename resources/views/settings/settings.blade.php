<x-guest-layout>
  <div class="auth-shell">
    <div class="auth-card text-center">
      <!-- العنوان الرئيسي -->
      <h1 class="mb-6">Settings</h1>

      <!-- اسم المطبخ -->
      <div class="form-group">
        <label for="kitchen-name">Kitchen Name</label>
        <input type="text" id="kitchen-name" class="input" placeholder="Enter kitchen name">
      </div>

      <!-- رقم المطبخ وساعات العمل -->
      <div class="form-group">
        <label for="kitchen-info">Kitchen Number and Opening Hours</label>
        <input type="text" id="kitchen-info" class="input" placeholder="Enter number and hours">
      </div>

      <!-- الأقسام مع أيقونات -->
      <div class="sections">
        <button class="btn">🍰 Desserts</button>
        <button class="btn">☕ Beverages</button>
        <button class="btn">🍲 Meals</button>
      </div>

      <!-- إعدادات الحساب -->
      <div class="actions">
        <button class="btn change">Change Password</button>
        <button class="btn logout">Log Out</button>
      </div>
    </div>
  </div>
</x-guest-layout>