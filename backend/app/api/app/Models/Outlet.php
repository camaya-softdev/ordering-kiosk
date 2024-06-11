<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    protected $fillable = ['name', 'image','status','outlet_classification'];

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
    public function locations()
    {
        return $this->hasMany(Location::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
