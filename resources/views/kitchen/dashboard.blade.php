<x-guest-layout>
  <div class="auth-card text-center">
    <h1 class="mb-6">Kitchen Board <!--  >لوحة المطبخ  --></h1>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div class="sub-box"><a href="{{ route('kitchen.new-orders') }}" class="block text-decoration-none">New Orders Today<!-- الطلبات الجديدة اليوم--></a></div>
      <div class="sub-box">Orders Under Preparation<!-- الطلبات قيد التحضير  --></div>
      <div class="sub-box">Orders Ready for Delivery<!-- الطلبات الجاهزة للتوصيل  --></div>
      <div class="sub-box">Completed Orders <!-- الطلبات المكتملة  --></div>
    </div>
  </div>
</x-guest-layout>