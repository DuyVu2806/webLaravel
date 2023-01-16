<?php

use App\Models\Cart;
use App\Models\Order;

    function Countcart($id)
    {
        $countCart  = Cart::where('users_id',$id)->count();
        return $countCart;
    }

    function CountMyOrder($id=0)
    {
        if ($id === 0) {
            $countOrder  = 0;
        }else{
            $countOrder  = Order::where('user_id',$id)->where('status','<>',3)->count();
        }
        return $countOrder;
    }

    function nameStatus($id){
        switch ($id) {
            case 0:
                $name = 'Đang giao hàng';
                $color = 'primary';
                return [
                    'name' => $name,
                    'color' => $color
                ];
                break;
            case 1:
                $name = 'Đang chuẩn bị hàng';
                $color = 'primary';
                return [
                    'name' => $name,
                    'color' => $color
                ];
                break;
            case 2:
                $name = 'Giao hàng thành công';
                $color = 'success';
                return [
                    'name' => $name,
                    'color' => $color
                ];
                break;
            case 3:
                $name = 'Đơn hàng bị hủy';
                $color = 'danger';
                return [
                    'name' => $name,
                    'color' => $color
                ];
                break;
        }
    }

?>