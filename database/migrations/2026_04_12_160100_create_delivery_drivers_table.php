<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('delivery_drivers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restaurant_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('user_id')->nullable()->unique()->constrained()->nullOnDelete();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->nullable()->unique();
            $table->string('phone_number', 30);
            $table->string('license_number')->nullable()->unique();
            $table->string('vehicle_type')->nullable();
            $table->string('vehicle_registration_number')->nullable();
            $table->string('employment_status')->default('active');
            $table->string('availability_status')->default('offline');
            $table->decimal('rating', 3, 2)->default(0);
            $table->timestamp('hired_at')->nullable();
            $table->timestamp('terminated_at')->nullable();
            $table->decimal('current_latitude', 10, 7)->nullable();
            $table->decimal('current_longitude', 10, 7)->nullable();
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_phone', 30)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['restaurant_id', 'employment_status']);
            $table->index(['availability_status', 'employment_status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('delivery_drivers');
    }
};
