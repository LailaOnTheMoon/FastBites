<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('extra_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restaurant_id')->constrained()->cascadeOnDelete();
            $table->foreignId('menu_item_id')->constrained()->cascadeOnDelete();
            $table->string('group_name')->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('option_type')->default('addon');
            $table->boolean('is_required')->default(false);
            $table->boolean('allows_quantity')->default(false);
            $table->unsignedTinyInteger('min_selectable')->default(0);
            $table->unsignedTinyInteger('max_selectable')->nullable();
            $table->unsignedTinyInteger('max_quantity')->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->json('metadata')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['menu_item_id', 'is_active', 'sort_order']);
            $table->index(['restaurant_id', 'option_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('extra_options');
    }
};
