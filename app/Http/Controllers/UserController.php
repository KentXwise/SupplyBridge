<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index');
    }
    public function orders(){
        $orders = Order::class->where('user_id',Auth::user()->id)->orderBy('created_at','DESC')->paginate(10);
        return view ('user.orders',compact('orders'));
    }
    public function order_details($order_id){
        $order = Order::where('user_id', Auth:user()->id->('id',$order_id)->first();
        if($order){
            $orderItems = OrderItem::where('order_id',$order_id)->orderBy('id')->paginate(12);
            $transaction = Transaction::where('order_id',$order_id)->first();
            return view('user.order_details',compact('order'));
        }else{
            return redirect()->route('login');
        }
       
    }
}
