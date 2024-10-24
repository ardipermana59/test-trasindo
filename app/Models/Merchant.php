<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_name',
        'address',
        'village',
        'district',
        'city',
        'province',
        'contact',
        'description',
    ];


    public function menus()
    {
        return $this->hasMany(Menu::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
