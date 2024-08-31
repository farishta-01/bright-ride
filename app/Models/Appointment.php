<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'booking_date',
        'booking_time',
        'status',
        'user_id',
        'car_id',
        'confirmation_token',
    ];

    // Define the relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship with Car
    public function car()
    {
        return $this->belongsTo(Car::class);
    }
    protected static function booted()
    {
        static::creating(function ($appointment) {
            $appointment->confirmation_token = Str::random(32); // Generate a random token
        });
    }
}
