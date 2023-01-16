<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomePageController extends Controller
{
    public function home()
    {
        $product = new Product();
        $title = 'Trang chủ';
        $listProducts = $product->getAllProduct();
        $listProducts2 = $product->getAllProduct(2);
        $listCategory = Category::all();
        return view('customer.home',compact('title','listProducts2', 'listProducts','listCategory'));
    }
    public function products(){
        $title = 'Sản Phẩm';
        $listProducts = Product::orderBy('created_at','desc');
        $key = request()->keyword;
        if(!empty($key)){
            $listProducts = $listProducts->where('name','like','%'.$key.'%');
        }
        if(!empty(request()->price1)){
            $listProducts = $listProducts->where('price','<=',500000);
        }
        if(!empty(request()->price2)){
            $listProducts = $listProducts->where('price','>',500000)->where('price','<=',2000000);
        }
        if(!empty(request()->price3)){
            $listProducts = $listProducts->where('price','>',2000000)->where('price','<=',5000000);
        }
        if(!empty(request()->price4)){
            $listProducts = $listProducts->where('price','>',5000000);
        }

        $listProducts = $listProducts->paginate(12)->withQueryString();
        $count = $listProducts->count();

        $listCategory = Category::all();
        return view('customer.products',compact('title','listProducts','listCategory','count','key'));
    }
    public function contact(){
        $title = 'Liên Hệ';
        return view('customer.contact',compact('title'));
    }

    public function productDetails($id)
    {
        $title = 'Chi tiết sản phẩm';
        
        $productdetails =Product::find($id);
        $category = Category::all();
        return view('customer.productDetails', compact('title','productdetails','category'));
    }

    public function about()
    {
        $title = 'Giới thiệu';
        return view('customer.about',compact('title'));
    }

    public function productListAjax()
    {
        $product = Product::select('name')->where('status','0')->get();

        $data= [];

        foreach ($product as $item) {
            $data[] = $item['name'];
        }

        return $data;
    }

    
    
}
