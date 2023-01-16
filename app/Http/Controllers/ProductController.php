<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\ProductsRequests;
use App\Models\Order;
use App\Models\OrderItem;

class ProductController extends Controller
{

    public function index()
    {
        $title = 'Sản Phẩm';
        $listProducts = Product::all();
        $listProducts = Product::orderBy('created_at','desc');
        $key = request()->keyword;
        $key2 = request()->keyCate;
        if (!empty($key) ) {
            $listProducts = $listProducts->where('name','like','%'.$key.'%');
        }
        if(!empty($key2)){
            $listProducts = $listProducts->where('category_id','=',$key2);
        }
        $listProducts = $listProducts->paginate(8)->withQueryString();
        $count = $listProducts->count();
        $listCategory = Category::all();
        return view('admin.products.list',compact('title', 'listProducts','listCategory','count' ));
    }

    public function add()
    {
        $listCategory = Category::all();
        $title = 'Thêm sản phẩm';
        return view('admin.products.add',compact('title', 'listCategory'));
    }

    public function create(ProductsRequests $request)
    {
        $product = new Product();
        $product->name = $request->name;
        if($request->file('image')){
            $file= $request->file('image');
            $filename = $file->getClientOriginalName();
            $file-> move(public_path('assets/img'), $filename);
            $product['image']= $filename;
        }
        $product->price = $request->price;
        $product->status = $request->status;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->save();
        return redirect()->route('products.list');

    }


    public function edit($id)
    {
        $title = 'Sửa sản phẩm';
        $listCategory = Category::all();
        $product = Product::find($id);
        return view('admin.products.edit',compact('title','listCategory','product'));
    }

    public function update($id,Request $request)
    {
        $product = Product::find($id);
        $product->name = $request->name;
        if($request->file('image')){
            $file= $request->file('image');
            $filename = $file->getClientOriginalName();
            $file-> move(public_path('assets/img'), $filename);
            $product['image']= $filename;
        }
        $product->price = $request->price;
        $product->status = $request->status;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->created_at = date('Y-m-d H:i:s');
        $product->update();
        return redirect()->route('products.list');

    }

    public function destroy($id)
    {
        $deleted =Product::where('id', $id)->delete();
        $listProducts =Product::all();
        return redirect()->route('products.list',compact('listProducts'));
    }

    // Bill page admin

    public function list()
    {
        $bill = Order::orderBy('created_at','DESC')->get();
        return view('admin.bill.list',compact('bill'));
    }

    public function billedit($id,Request $request)
    {
        $orders = Order::find($id);
        $request->validate([
            'status' => 'integer'
        ],[
            'status' => 'Chọn tình trạng giao hàng'
        ]);
        $orders->status = $request->status;
        $orders->update();

        return redirect()->back();
    }


    public function billDetail($id)
    {
        $billDetail = Order::where('id',$id)->first();
        return view('admin.bill.detail',compact('billDetail'));
    }

    // public function addToCart($id)
    // {
    //    dd('addtocart'.$id);
    // }

    public function billDeleted($id)
    {
        Order::where('id', $id)->delete();
        OrderItem::where('order_id', $id)->delete();
        return redirect()->back();
    }
}
