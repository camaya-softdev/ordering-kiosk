<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'reference_number',
        'status',
        'remarks',
        'dining_option',
        'payment_method',
        'outlet_id',
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

    public function outlet()
    {
        return $this->belongsTo(Outlet::class);
    }

    public function locationNumber()
    {
        return $this->belongsTo(LocationNumber::class);
    }
}
