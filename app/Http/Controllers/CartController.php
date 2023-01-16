<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addProduct(Request $request)
    {
        $product_id = $request->input('product_id');
        $product_qty = $request->input('product_qty');
        if (Auth::guard('cus')->check()) {
            $prod_check = Product::where('id',$product_id)->first();
            if ($prod_check) {
                if(Cart::where('prod_id',$product_id)->where('users_id',Auth::guard('cus')->id())->exists()){
                    return response()->json(['status'=> $prod_check->name." đã có trong giỏ"]);
                }else{
                    $cartItem = new Cart();
                    $cartItem->prod_id = $product_id;
                    $cartItem->users_id = Auth::guard('cus')->id();
                    $cartItem->prod_qty = $product_qty;
                    $cartItem->save();
                    return response()->json(['status'=> $prod_check->name." đã được thêm"]);
                }
            }
        }else{
            return response()->json(['status' => "Yêu cầu đăng nhập"]);
        }
    }

    public function add(Request $request)
    {
        $product_id = $request->input('product_id');
        $product_qty = $request->input('product_qty');
        if (Auth::guard('cus')->check()) {
            $prod_check = Product::where('id',$product_id)->first();
            if ($prod_check) {
                if(Cart::where('prod_id',$product_id)->where('users_id',Auth::guard('cus')->id())->exists()){
                    return response()->json(['status'=> $prod_check->name." đã có trong giỏ"]);
                }else{
                    $cartItem = new Cart();
                    $cartItem->prod_id = $product_id;
                    $cartItem->users_id = Auth::guard('cus')->id();
                    $cartItem->prod_qty = $product_qty;
                    $cartItem->save();
                    return response()->json(['status'=> $prod_check->name." đã được thêm"]);
                }
            }
        }else{
            return response()->json(['status' => "Yêu cầu đăng nhập"]);
        }
    }


    public function viewCart()
    {
        $title = 'Giỏ hàng';
        $cartItems = Cart::where('users_id',Auth::guard('cus')->id())->get();
        return view('customer.cart',compact('title','cartItems'));
    }

    public function deleteProduct(Request $request)
    {
        if (Auth::guard('cus')->check()) {
            $prod_id = $request->input('prod_id');
            if (Cart::where('prod_id',$prod_id)->where('users_id',Auth::guard('cus')->id())->exists()) {
                $cartItem = Cart::where('prod_id',$prod_id)->where('users_id',Auth::guard('cus')->id())->first();
                $cartItem->delete();
                return response()->json(['status'=>'Sản phẩm đã được xóa']);
            }
        }else{
            return response()->json(['status'=>'Yêu cầu đăng nhập']);
        }
        
    }

    public function updateCart(Request $request)
    {
        $prod_id  = $request->input('prod_id');
        $product_qty  = $request->input('prod_qty');

        if (Auth::guard('cus')->check()) {
            if (Cart::where('prod_id',$prod_id)->where('users_id',Auth::guard('cus')->id())->exists()) {
                $cart = Cart::where('prod_id',$prod_id)->where('users_id',Auth::guard('cus')->id())->first();
                $cart->prod_qty = $product_qty;
                $cart->update();
                return response()->json(['status'=>'Quantity update']);
            }
        }

    }

    
}
