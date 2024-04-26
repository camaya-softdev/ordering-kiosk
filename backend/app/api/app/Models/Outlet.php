<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    protected $fillable = ['name', 'image','status'];

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
