<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Ride extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'driver_id',
        'pickup_location',
        'dropoff_location',
        'fare',
        'status',
        'pickup_time',
        'dropoff_time',
    ];

    /**
     * Get the customer who created the ride.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    /**
     * Get the driver assigned to the ride.
     */
    public function driver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    /**
     * Get the payment for the ride.
     */
    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class, 'ride_id');
    }

    /**
     * Get the review for the ride.
     */
    public function review(): HasOne
    {
        return $this->hasOne(Review::class, 'ride_id');
    }
}
