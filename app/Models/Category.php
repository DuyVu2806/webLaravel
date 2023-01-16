<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    protected $table = 'category';

    protected $fillable = ['name','status'];

    public function prod()
    {
        return $this->BelongsTo(Product::class,'id','category_id');
    }
    
}
