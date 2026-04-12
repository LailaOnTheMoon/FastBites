<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeliveryDriver extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'restaurant_id',
        'user_id',
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'license_number',
        'vehicle_type',
        'vehicle_registration_number',
        'employment_status',
        'availability_status',
        'rating',
        'hired_at',
        'terminated_at',
        'current_latitude',
        'current_longitude',
        'emergency_contact_name',
        'emergency_contact_phone',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'rating' => 'decimal:2',
            'hired_at' => 'datetime',
            'terminated_at' => 'datetime',
            'current_latitude' => 'decimal:7',
            'current_longitude' => 'decimal:7',
        ];
    }

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function orderTrackings(): HasMany
    {
        return $this->hasMany(OrderTracking::class);
    }

    public function getFullNameAttribute(): string
    {
        return trim("{$this->first_name} {$this->last_name}");
    }
}
