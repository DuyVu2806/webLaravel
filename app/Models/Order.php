<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'province',
        'address',
        'status',
        'message',
        'stracking_no',
        'total_price'
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
