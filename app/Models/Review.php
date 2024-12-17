<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'ride_id',
        'customer_id',
        'driver_id',
        'rating',
        'comment',
    ];

    /**
     * Get the ride associated with the review.
     */
    public function ride(): BelongsTo
    {
        return $this->belongsTo(Ride::class, 'ride_id');
    }

    /**
     * Get the customer who wrote the review.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id')->where(
            'role',
            'customer'
        );
    }

    /**
     * Get the driver who received the review.
     */
    public function driver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'driver_id')->where(
            'role',
            'driver'
        );
    }
}
