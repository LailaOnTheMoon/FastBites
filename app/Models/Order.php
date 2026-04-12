<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'restaurant_id',
        'customer_id',
        'delivery_driver_id',
        'order_number',
        'order_type',
        'fulfillment_status',
        'payment_status',
        'currency',
        'subtotal_amount',
        'tax_amount',
        'discount_amount',
        'delivery_fee',
        'service_fee',
        'tip_amount',
        'total_amount',
        'customer_name',
        'customer_email',
        'customer_phone_number',
        'delivery_recipient_name',
        'delivery_phone_number',
        'delivery_address_line_1',
        'delivery_address_line_2',
        'delivery_city',
        'delivery_state',
        'delivery_postal_code',
        'delivery_country',
        'delivery_latitude',
        'delivery_longitude',
        'placed_at',
        'accepted_at',
        'prepared_at',
        'dispatched_at',
        'delivered_at',
        'cancelled_at',
        'requested_delivery_at',
        'source',
        'special_instructions',
        'status_notes',
        'metadata',
    ];

    protected function casts(): array
    {
        return [
            'subtotal_amount' => 'decimal:2',
            'tax_amount' => 'decimal:2',
            'discount_amount' => 'decimal:2',
            'delivery_fee' => 'decimal:2',
            'service_fee' => 'decimal:2',
            'tip_amount' => 'decimal:2',
            'total_amount' => 'decimal:2',
            'delivery_latitude' => 'decimal:7',
            'delivery_longitude' => 'decimal:7',
            'placed_at' => 'datetime',
            'accepted_at' => 'datetime',
            'prepared_at' => 'datetime',
            'dispatched_at' => 'datetime',
            'delivered_at' => 'datetime',
            'cancelled_at' => 'datetime',
            'requested_delivery_at' => 'datetime',
            'metadata' => 'array',
        ];
    }

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function deliveryDriver(): BelongsTo
    {
        return $this->belongsTo(DeliveryDriver::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function trackings(): HasMany
    {
        return $this->hasMany(OrderTracking::class);
    }
}
