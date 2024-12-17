<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'ride_id',
        'customer_id',
        'payment_method',
        'amount',
        'status',
    ];

    /**
     * Get the ride that this payment is for.
     */
    public function ride(): BelongsTo
    {
        return $this->belongsTo(Ride::class, 'ride_id');
    }

    /**
     * Get the customer who made the payment.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
}
