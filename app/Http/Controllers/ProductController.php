<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $title = '';
        if(request('product_category')) {
            $product_category = ProductCategory::firstWhere('slug', request('product_category'));
            $title = ' in ' . $product_category->name;
        }

        return view('products.index', [
            "title" => "All Products" . $title,
            "products" => Product::latest()->filter(request(['search', 'product_category']))->paginate(9)->withQueryString(),
            "product_categories" => ProductCategory::all()
        ]);
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->first();
        return view('products.show', compact('product'), [
            "title" => "Single product"
        ]);
    }

    public function order(Request $request, $id)
    {
        $product = Product::where('id', $id)->first();
        $order_date = Carbon::now();

        $this->validate($request, [
            'order_quantity' => ['required', 'numeric']
        ]);

        if($request->order_quantity > $product->stock)
        {
            return redirect('order/'.$id);
        }

        $check_order = Order::where('user_id', Auth::user()->id)->where('status', 0)->first();
        if(empty($check_order))
        {
            $order = new Order;
            $order->user_id = Auth::user()->id;
            $order->order_date = $order_date;
            $order->status = 0;
            $order->total_price = 0;
            $order->save();
        }

        $new_order = Order::where('user_id', Auth::user()->id)->where('status', 0)->first();

        $check_order_details = OrderDetails::where('product_id', $product->id)->where('order_id', $new_order->id)->first();
        if(empty($check_order_details))
        {
            $order_details = new OrderDetails;
            $order_details->product_id = $product->id;
            $order_details->order_id = $new_order->id;
            $order_details->total_product = $request->order_quantity;
            $order_details->total_price = $product->price*$request->order_quantity;
            $order_details->save();
        }else
        {
            $order_details = OrderDetails::where('product_id', $product->id)->where('order_id', $new_order->id)->first();
            $order_details->total_product = $order_details->total_product+$request->order_quantity;
            
            $new_price_order_details = $product->price*$request->order_quantity;
            $order_details->total_price = $order_details->total_price+$new_price_order_details;
            $order_details->update();
        }

        $order = Order::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $order->total_price = $order->total_price+$product->price*$request->order_quantity;
        $order->update();

        return redirect('products/'.$product->slug)->with('success', 'Your order has been added to the cart!');
    }
}