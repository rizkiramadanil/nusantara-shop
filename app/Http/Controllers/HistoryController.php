<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $orders = Order::where('user_id', Auth::user()->id)->where('status', '!=', 0)->get();
        return view('user.history.index', compact('orders'), [
            "title" => "Order History"
        ]);
    }

    public function detail($id)
    {
        $order = Order::where('id', $id)->first();
        $order_details = OrderDetails::where('order_id', $order->id)->get();

        return view('user.history.detail', compact('order', 'order_details'), [
            "title" => "Detail Order History"
        ]);
    }
}
