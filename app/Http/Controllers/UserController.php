<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\OrderItem;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;



class UserController extends Controller
{
    public function index()
    {
        return view('user.index');
    }
    public function orders(){
        $orders = Order::where('user_id', Auth::user()->id)->orderBy('created_at','DESC')->paginate(10);
        return view ('user.orders',compact('orders'));
    }
    public function order_details($order_id){
        $order = Order::where('user_id', Auth::user()->id)->where('id', $order_id)->first();
        if($order){
            $orderItems = OrderItem::where('order_id',$order_id)->orderBy('id')->paginate(12);
            $transaction = Transaction::where('order_id',$order_id)->first();
            return view('user.order-details',compact('order','orderItems','transaction'));
        }else{
            return redirect()->route('login');
        }
       
    }
    public function order_cancel(Request $request)
    {
        $order = Order::find($request->order_id);
        $order->status = 'canceled';
        $order->canceled_date = now();
        $order->save();
    
        return redirect()->route('user.orders')->with('success', 'Order canceled successfully.');
    }

    public function account_details(Request $request)
    {

    }
}
