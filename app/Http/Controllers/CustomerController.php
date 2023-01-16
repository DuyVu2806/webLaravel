<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    public function index()
    {
        $title ='Khách hàng';
        $listCustomer = Customer::all();
        return view('admin.customer.list',compact('title','listCustomer'));
    }
   public function login()
   { 
        $title = 'Đăng Nhập';
        return view('customer.login',compact('title'));

   }

   public function post_login(Request $request)
   {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:4',
    ],[
        'email.required' => 'Email không được để trống',
        'email.email' => 'Email không đúng định dạng',
        'password.required' => 'Mật khẩu không được để trống',
        'password.min' => 'Mật khẩu phải ít nhất 4 ký tự'
    ]);
    $login =  Auth::guard('cus')->attempt($request->only('email','password'),$request->has('remember'));
    if ($login) {
        return redirect()->route('home')->with('success','Đăng nhập thành công');
    }
    return redirect()->back()->with('error','Đăng nhập không thành công');
   }

   public function profile()
   {
        $title = 'Thông tin khách hàng';
        // dd(Auth::guard()->user()->id);
        $id = Auth::guard('cus')->user()->id;
        $customer = Customer::find($id);
        return view('customer.profile',compact('title','customer'));
        
        
   }
   public function post_profile(Request $request)
   {
    $id = Auth::guard('cus')->user()->id;
    $customer = Customer::find($id);

    $customer->name = $request->name;
    $customer->phone = $request->phone;
    $customer->address = $request->address;
    if($request->file('image')){
        $file= $request->file('image');
        $filename = $file->getClientOriginalName();
        $file-> move(public_path('assets/img/avatar'), $filename);
        $customer->image= $filename;
    }
    // $customer->image = $request->image;
    $customer->update();
    return redirect()->back();

   }

   public function change_password()
   {
        return view('customer.change_password');
   }

   public function myOrder()
   {
        $title = 'Đơn hàng';
        $orders = Order::where('user_id',Auth::guard('cus')->id())->orderBy('created_at','DESC')->get();
        return view('customer.order.index',compact('title','orders'));
   }

   public function viewOrder($id)
   {    $title ='Chi tiết';
        $orders = Order::where('id',$id)->where('user_id',Auth::guard('cus')->id())->first();
        return view('customer.order.viewOrder',compact('title','orders'));
   }

   public function delete($id)
   {
        $order = Order::find($id);
        $order->status = 3;
        $order->update();
        return redirect()->back();
   }

   public function register()
   {
        $title='Đăng ký';
        return view('customer.register',compact('title'));
   }

   public function post_register(Request $request)
   {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:customer',
            'phone' => 'required',
            'password' => 'required|min:4',
            'confirm_password' => 'required|same:password',
        ],[
            'name.required' => 'Họ tên không được để trống',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'phone.required' => 'Số điện thoại không được để trống',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu phải ít nhất 4 ký tự',
            'confirm_password.required' => 'Không được để trống',
            'confirm_password.same' => 'Không trùng khớp với mật khẩu'
        ]);
        $request->merge(['password' => bcrypt($request->password)]);
        
        $reg = Customer::create($request->all());

        if ($reg) {
            return redirect()->route('customer.login')->with('success','Đăng ký thành công');
        }

        return redirect()->back()->with('error','Đăng ký không thành công');
   }

   public function logout()
   {
    Auth::guard('cus')->logout();
    return redirect()->route('customer.login')->with('success','Đăng xuất thành công');
   }


}
