<x-guest-layout>
  <div class="auth-shell">
    <div class="auth-card">
      <!-- العنوان الرئيسي -->
      <h1 class="mb-6">New Orders</h1>

      <!-- اسم الزبون -->
      <div class="form-group">
        <label for="customer">Customer's Name</label>
        <input type="text" id="customer" class="input" placeholder="Enter customer's name">
      </div>

      <!-- نوع الطلب -->
      <div class="form-group">
        <label>Order Type</label>
        <div class="order-types">
          <button class="btn">Sweets</button>
          <button class="btn">Drinks</button>
          <button class="btn">Meals</button>
        </div>
      </div>

      <!-- وقت التوصيل المتوقع -->
      <div class="form-group">
        <label for="delivery">Estimated Delivery Time</label>
        <input type="time" id="delivery" class="input">
      </div>

      <!-- الكمية -->
      <div class="form-group">
        <label for="quantity">Quantity</label>
        <input type="number" id="quantity" class="input" min="1">
      </div>

      <!-- العناصر -->
      <div class="form-group">
        <label for="items">Items</label>
        <textarea id="items" class="input" rows="3" placeholder="List items here"></textarea>
      </div>

      <!-- الأزرار -->
      <div class="actions">
        <button class="btn accept">Accept</button>
        <button class="btn reject">Reject Order</button>
      </div>
    </div>
  </div>
</x-guest-layout>