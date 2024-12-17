<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'role',
        'profile_photo',
        'vehicle_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    /**
     * Get the vehicle associated with the driver.
     */
    public function vehicle()
    {
        return $this->hasOne(Vehicle::class, 'driver_id');
    }

    /**
     * Get the rides created by the user (as a customer).
     */
    public function ridesAsCustomer()
    {
        return $this->hasMany(Ride::class, 'customer_id');
    }

    /**
     * Get the rides assigned to the user (as a driver).
     */
    public function ridesAsDriver()
    {
        return $this->hasMany(Ride::class, 'driver_id');
    }

    /**
     * Get the payments made by the user.
     */
    public function payments()
    {
        return $this->hasMany(Payment::class, 'customer_id');
    }

    /**
     * Get the wallet associated with the user.
     */
    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

    /**
     * Get the reviews written by the user (customers).
     */
    public function reviewsWritten()
    {
        return $this->hasMany(Review::class, 'customer_id');
    }

    /**
     * Get the reviews received by the user (drivers).
     */
    public function reviewsReceived()
    {
        return $this->hasMany(Review::class, 'driver_id');
    }
}
