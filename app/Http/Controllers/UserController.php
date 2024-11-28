<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\OrderItem;
use App\Models\Transaction;
use App\Models\User;



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

    public function address_edit($id)
    {
        $address = Address::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('address-edit', compact('address'));
    }

    public function address_update(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'phone' => 'required|numeric|digits:11',
            'zip' => 'required|numeric|digits:6',
            'state' => 'required',
            'city' => 'required',
            'address' => 'required',
            'locality' => 'required',
            'landmark' => 'required',
        ]);

        $address = Address::where('id', $request->id)
                         ->where('user_id', Auth::id())
                         ->firstOrFail();

        $address->name = $request->name;
        $address->phone = $request->phone;
        $address->zip = $request->zip;
        $address->state = $request->state;
        $address->city = $request->city;
        $address->address = $request->address;
        $address->locality = $request->locality;
        $address->landmark = $request->landmark;
        $address->save();

        return redirect()->route('user.index')->with('success', 'Address updated successfully');
    }
}
