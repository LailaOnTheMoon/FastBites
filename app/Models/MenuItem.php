<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'restaurant_id',
        'menu_id',
        'name',
        'slug',
        'description',
        'sku',
        'category',
        'item_type',
        'image_path',
        'base_price',
        'compare_at_price',
        'cost_price',
        'preparation_time_minutes',
        'calories',
        'spice_level',
        'is_featured',
        'is_available',
        'inventory_tracking_enabled',
        'stock_quantity',
        'dietary_labels',
        'allergen_labels',
        'metadata',
    ];

    protected function casts(): array
    {
        return [
            'base_price' => 'decimal:2',
            'compare_at_price' => 'decimal:2',
            'cost_price' => 'decimal:2',
            'is_featured' => 'boolean',
            'is_available' => 'boolean',
            'inventory_tracking_enabled' => 'boolean',
            'dietary_labels' => 'array',
            'allergen_labels' => 'array',
            'metadata' => 'array',
        ];
    }

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }

    public function extraOptions(): HasMany
    {
        return $this->hasMany(ExtraOption::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
