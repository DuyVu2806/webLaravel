<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{

    protected $table = 'comment';

    protected $fillable = [ 'product_id','customer_id','reply_id','content'];

    public function cus()
    {
        return $this->hasOne(Customer::class,'id','customer_id');
    }
    public function replies()
    {
        return $this->hasMany(Comment::class,'reply_id','id');
    }

    public function prod()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }
    public function cust()
    {
        return $this->belongsTo(Customer::class,'customer_id','id');
    }

}
