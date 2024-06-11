<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    public static $STATUS_PENDING = 'pending';
    public static $STATUS_CONFIRMED = 'confirmed';
    public static $STATUS_CANCELLED = 'cancelled';
    public static $STATUS_VOIDED = 'voided';
    public static $STATUS_COMPLETED = 'completed';

    protected $fillable = [
        'customer_id',
        'reference_number',
        'status',
        'remarks',
        'dining_option',
        'payment_method',
        'location_number_id',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function locationNumber()
    {
        return $this->belongsTo(LocationNumber::class);
    }
}
