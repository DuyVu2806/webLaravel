<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Auth;



class AjaxLoginController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email|exists:customer',
            'password' => 'required|min:4',
        ],[
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'email.exists' => 'Email Không có trong hệ thống',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu phải ít nhất 4 ký tự',
        ]);
        
        if($validator->passes()){
            $data = $request->only('email','password');
            $check_login = Auth::guard('cus')->attempt($data);
            if ($check_login) {
                if (Auth::guard('cus')->user()->status == 0) {
                    Auth::guard('cus')->logout();
                    return response()->json(['error'=>['Tài khoản của bạn chưa xác thực']]);
                }

                return response()->json(['data'=>Auth::guard('cus')->user()]);
            }
        }
        return response()->json(['error'=>$validator->errors()->all()]);
       
    }

    public function comment($productdetail_id, Request $res)
    {
        $customer_id = Auth::guard('cus')->user()->id;
        $validator = Validator::make($res->all(),[
            'content' => 'required',
        ],[
            'content.required' => 'Nội dung không được để trống',
        ]);

        if($validator->passes()){
            $data = [
                'customer_id' => $customer_id,
                'product_id' => $productdetail_id,
                'content' => $res->content,
                'reply_id' => $res->reply_id ? $res->reply_id : 0
            ];
            if ($comment = Comment::create($data)) {
                // return response()->json(['data'=>$comment]);
                $comments = Comment::where(['product_id' => $productdetail_id, 'reply_id'=> 0])->get();
                return view('customer.listComment',compact('comments'));
            }
        }
        return response()->json(['error'=>$validator->errors()->first()]);

    }
}
