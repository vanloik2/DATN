<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thumb extends Model
{
    use HasFactory;

    protected $fillable = ['thumb', 'product_id'];
}
