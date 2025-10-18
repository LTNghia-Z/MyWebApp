<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $primaryKey = 'id';

    protected $fillable = [
        'account_id',
        'total_price',
        'status',
        'address',
        'phone'
    ];

    protected $casts = [
        'address' => 'array', // Tự động chuyển JSON thành mảng
    ];

    /**
     * 🔗 Một đơn hàng thuộc về một khách hàng (Account)
     */
    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id', 'id');
    }

    /**
     * 🍽️ Một đơn hàng có nhiều món ăn (OrderItem)
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }
}
