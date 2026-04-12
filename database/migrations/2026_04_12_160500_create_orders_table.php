<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restaurant_id')->constrained()->cascadeOnDelete();
            $table->foreignId('customer_id')->constrained()->restrictOnDelete();
            $table->foreignId('delivery_driver_id')->nullable()->constrained()->nullOnDelete();
            $table->string('order_number')->unique();
            $table->string('order_type')->default('delivery');
            $table->string('fulfillment_status')->default('pending');
            $table->string('payment_status')->default('unpaid');
            $table->string('currency', 3)->default('USD');
            $table->decimal('subtotal_amount', 10, 2)->default(0);
            $table->decimal('tax_amount', 10, 2)->default(0);
            $table->decimal('discount_amount', 10, 2)->default(0);
            $table->decimal('delivery_fee', 10, 2)->default(0);
            $table->decimal('service_fee', 10, 2)->default(0);
            $table->decimal('tip_amount', 10, 2)->default(0);
            $table->decimal('total_amount', 10, 2)->default(0);
            $table->string('customer_name');
            $table->string('customer_email')->nullable();
            $table->string('customer_phone_number', 30)->nullable();
            $table->string('delivery_recipient_name')->nullable();
            $table->string('delivery_phone_number', 30)->nullable();
            $table->string('delivery_address_line_1')->nullable();
            $table->string('delivery_address_line_2')->nullable();
            $table->string('delivery_city')->nullable();
            $table->string('delivery_state')->nullable();
            $table->string('delivery_postal_code', 20)->nullable();
            $table->string('delivery_country', 2)->nullable();
            $table->decimal('delivery_latitude', 10, 7)->nullable();
            $table->decimal('delivery_longitude', 10, 7)->nullable();
            $table->timestamp('placed_at')->nullable();
            $table->timestamp('accepted_at')->nullable();
            $table->timestamp('prepared_at')->nullable();
            $table->timestamp('dispatched_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->timestamp('requested_delivery_at')->nullable();
            $table->string('source')->default('app');
            $table->text('special_instructions')->nullable();
            $table->text('status_notes')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['restaurant_id', 'fulfillment_status', 'placed_at']);
            $table->index(['customer_id', 'created_at']);
            $table->index(['delivery_driver_id', 'fulfillment_status']);
            $table->index(['payment_status', 'fulfillment_status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
