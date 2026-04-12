<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restaurant_id')->constrained()->cascadeOnDelete();
            $table->foreignId('menu_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->string('sku')->nullable();
            $table->string('category')->nullable();
            $table->string('item_type')->default('food');
            $table->string('image_path')->nullable();
            $table->decimal('base_price', 10, 2);
            $table->decimal('compare_at_price', 10, 2)->nullable();
            $table->decimal('cost_price', 10, 2)->nullable();
            $table->unsignedSmallInteger('preparation_time_minutes')->nullable();
            $table->unsignedSmallInteger('calories')->nullable();
            $table->unsignedTinyInteger('spice_level')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_available')->default(true);
            $table->boolean('inventory_tracking_enabled')->default(false);
            $table->integer('stock_quantity')->nullable();
            $table->json('dietary_labels')->nullable();
            $table->json('allergen_labels')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['menu_id', 'slug']);
            $table->index(['restaurant_id', 'is_available']);
            $table->index(['menu_id', 'category']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};
