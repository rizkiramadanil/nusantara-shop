<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetails;

class DashboardHistoryController extends Controller
{
    public function index()
    {
        $orders = Order::all()->where('status', '!=', 0);
        return view('dashboard.history.index', compact('orders'));
    }

    public function detail($id)
    {
        $order = Order::all()->first();
        $order_details = OrderDetails::all();

        return view('dashboard.history.detail', compact('order', 'order_details'));
    }
}
