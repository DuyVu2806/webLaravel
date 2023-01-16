<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    protected $table = 'product';

    protected $fillTable = ['name','status','price','iamge','category_id',''];

    public function getAllProduct($id = 0)
    {
        if($id == 0){
            $product = DB::table($this->table)->orderBy('created_at','DESC')
            ->limit(8)
            ->get();
        } else{
            $product = DB::table($this->table)->orderBy('created_at','ASC')
            ->limit(8)
            ->get();
        }
        
        return $product;
    }

    public function getIdProduct($id)
    {
        return DB::select('SELECT * FROM '.$this->table.' WHERE id = ? ',[$id]);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class,'product_id','id');
    }

    public function cate()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }

    
}
