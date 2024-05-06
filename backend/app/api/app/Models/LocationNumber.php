<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocationNumber extends Model
{
    protected $fillable = ['name', 'location_id', 'status'];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
