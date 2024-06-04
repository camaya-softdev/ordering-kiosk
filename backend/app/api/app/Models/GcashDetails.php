<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GcashDetails extends Model
{
    use HasFactory;

    protected $fillable = ['image', 'number','outlet_id'];


}
