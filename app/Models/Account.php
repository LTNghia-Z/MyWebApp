<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Account extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'accounts'; // Tên bảng
    protected $primaryKey = 'id'; // Khóa chính

    protected $fillable = [
        'username',
        'email',
        'password',
        'address',
        'phone'
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'address' => 'array', // Chuyển JSON về mảng PHP
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'account_id', 'id');
    }
}
