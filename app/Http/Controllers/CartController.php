<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $order = Order::where('user_id', Auth::user()->id)->where('status', 0)->first();
        
        if(!empty($order))
        {
            $order_details = OrderDetails::where('order_id', $order->id)->get();

            return view('cart.check_out', compact('order', 'order_details'), [
                "title" => "Cart"
            ]);
        }

        return view('cart.check_out', compact('order'), [
            "title" => "Cart"
        ]);
    }

    public function delete($id)
    {
        $order_details = OrderDetails::where('id', $id)->first();

        $order = Order::where('id', $order_details->order_id)->first();
        $order->total_price = $order->total_price-$order_details->total_price;
        $order->update();

        $order_details->delete();

        return redirect('check_out');
    }

    public function confirm()
    {
        $user = User::where('id', Auth::user()->id)->first();

        if(empty($user->address))
        {
            return redirect('/user')->with('error', 'Your identity must be complete');
        }

        if(empty($user->phonenumber))
        {
            return redirect('/user')->with('error', 'Your order failed, your identity must be complete!');
        }

        $order = Order::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $order_id = $order->id;

        $order->status = 1;
        $order->update();

        $order_details = OrderDetails::where('order_id', $order_id)->get();
        foreach ($order_details as $order_detail) {
            $product = Product::where('id', $order_detail->product_id)->first();
            $product->stock = $product->stock-$order_detail->total_product;
            $product->update();
        }

        Alert::success('Success', 'Your order is successful!');
        return redirect('user/history/'.$order_id);
    }
}
