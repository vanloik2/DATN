<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    
    protected $table = 'menus';

    protected $fillable = [
        'name',
        'parent_id',
        'thumb',
        'slug',
        'active',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function vouchers()
    {
        return $this->hasMany(Voucher::class);
    }
}
