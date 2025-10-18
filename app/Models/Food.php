<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected $table = 'foods';
    protected $primaryKey = 'id';

    protected $fillable = [
        'food_name',
        'food_type',
        'food_price',
        'food_description',
        'food_image'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'food_id', 'id');
    }
}
