<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Restaurant extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'manager_user_id',
        'name',
        'slug',
        'description',
        'support_email',
        'support_phone',
        'cuisine_type',
        'logo_path',
        'cover_image_path',
        'tax_registration_number',
        'default_currency',
        'timezone',
        'minimum_order_amount',
        'delivery_fee',
        'service_fee',
        'preparation_time_minutes',
        'accepts_delivery',
        'accepts_pickup',
        'is_active',
        'address_line_1',
        'address_line_2',
        'city',
        'state',
        'postal_code',
        'country',
        'latitude',
        'longitude',
        'operating_hours',
        'metadata',
    ];

    protected function casts(): array
    {
        return [
            'minimum_order_amount' => 'decimal:2',
            'delivery_fee' => 'decimal:2',
            'service_fee' => 'decimal:2',
            'accepts_delivery' => 'boolean',
            'accepts_pickup' => 'boolean',
            'is_active' => 'boolean',
            'latitude' => 'decimal:7',
            'longitude' => 'decimal:7',
            'operating_hours' => 'array',
            'metadata' => 'array',
        ];
    }

    public function manager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'manager_user_id');
    }

    public function deliveryDrivers(): HasMany
    {
        return $this->hasMany(DeliveryDriver::class);
    }

    public function menus(): HasMany
    {
        return $this->hasMany(Menu::class);
    }

    public function menuItems(): HasMany
    {
        return $this->hasMany(MenuItem::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
