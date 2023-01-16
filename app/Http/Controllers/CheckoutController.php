<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $title = 'Thanh toán';
        $cartItem = Cart::where('users_id',Auth::guard('cus')->id())->get();
        return view('customer.checkout',compact('title','cartItem'));
    }

    public function placeOrder(Request $request)
    {
        $order = new Order();
        $order->user_id = Auth::guard('cus')->id();
        $order->name = $request->input('name');
        $order->email = $request->input('email');
        $order->phone = $request->input('phone');
        $order->province = $request->input('province');
        $order->address = $request->input('address');

        $total = 0;

        $cartitems_total = Cart::where('users_id',Auth::guard('cus')->id())->get();

        foreach ($cartitems_total as $item) {
            $total += $item->products->price;
        }

        $order->total_price = $total;

        $order->stracking_no = 'hello'.rand(1111,9999);
        
        $order->save();

        $order->id;

        $cartItem = Cart::where('users_id',Auth::guard('cus')->id())->get();
        foreach ($cartItem as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'prod_id' => $item->prod_id,
                'qty'=>$item->prod_qty,
                'price'=>$item->products->price
            ]);

        }

        $cartItem = Cart::where('users_id',Auth::guard('cus')->id())->get();
        Cart::destroy($cartItem);


        return redirect()->route('myOrder')->with('status',"Đặt hàng thành công");

    }
}
