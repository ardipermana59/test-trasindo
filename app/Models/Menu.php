<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'merchant_id',
        'menu_type_id',
        'name',
        'description',
        'photo_url',
        'price',
    ];

    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function type()
    {
        return $this->belongsTo(MenuType::class, 'menu_type_id');
    }
}
