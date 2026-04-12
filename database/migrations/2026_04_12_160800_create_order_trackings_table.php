<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_trackings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('delivery_driver_id')->nullable()->constrained()->nullOnDelete();
            $table->string('status');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('location_label')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->timestamp('tracked_at')->useCurrent();
            $table->json('metadata')->nullable();
            $table->timestamps();

            $table->index(['order_id', 'tracked_at']);
            $table->index(['delivery_driver_id', 'tracked_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_trackings');
    }
};
