<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = ['name', 'location_code', 'outlet_id','status'];

    public function locationNumbers()
    {
        return $this->hasMany(LocationNumber::class);
    }
    public function outlet()
    {
        return $this->belongsTo(Outlet::class);
    }

}
