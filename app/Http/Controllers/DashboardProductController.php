<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.products.index', [
            'products' => Product::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.products.create', [
            'product_categories' => ProductCategory::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => ['required', 'max:255'],
            'slug' => ['required', 'unique:posts'],
            'product_category_id' => ['required'],
            'price' => ['required', 'numeric'],
            'stock' => ['required', 'numeric'],
            'weight' => ['required', 'numeric'],
            'image' => ['image', 'file', 'max:5120'],
            'detail' => ['required']
        ]);
        
        if($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('product-images');
        }

        Product::create($validatedData);

        return redirect('/dashboard/products')->with('success', 'New product has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('dashboard.products.show', [
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('dashboard.products.edit', [
            'product' => $product,
            'product_categories' => ProductCategory::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $rules = [
            'title' => ['required', 'max:255'],
            'product_category_id' => ['required'],
            'price' => ['required', 'numeric'],
            'stock' => ['required', 'numeric'],
            'weight' => ['required', 'numeric'],
            'image' => ['image', 'file', 'max:5120'],
            'detail' => ['required']
        ];

        if($request->slug != $product->slug) {
            $rules['slug'] = ['required', 'unique:products'];
        }

        $validatedData = $request->validate($rules);

        if($request->file('image')) {
            if($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('product-images');
        }

        Product::where('id', $product->id)
            ->update($validatedData);

        return redirect('/dashboard/products')->with('success', 'Product has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if($product->image) {
            Storage::delete($product->image);
        }
        
        Product::destroy($product->id);

        return redirect('/dashboard/products')->with('success', 'Product has been deleted!');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Product::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
