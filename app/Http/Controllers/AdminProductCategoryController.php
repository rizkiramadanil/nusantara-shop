<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.product_categories.index', [
            'product_categories' => ProductCategory::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.product_categories.create', [
            "product_categories" => ProductCategory::all()
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
            'name' => ['required'],
            'slug' => ['required', 'unique:product_categories'],
            'image' => ['image', 'file', 'max:5120']
        ]);

        if($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('productcategory-images');
        }

        ProductCategory::create($validatedData);

        return redirect('/dashboard/product_categories')->with('success', 'New product category has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductCategory  $product_category
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCategory $product_category)
    {
        return view('dashboard.product_categories.show', [
            'product_category' => $product_category
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductCategory  $product_category
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductCategory $product_category)
    {
        return view('dashboard.product_categories.edit', [
            'product_category' => $product_category,
            'product_categories' => ProductCategory::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductCategory  $product_category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductCategory $product_category)
    {
        $rules = [
            'name' => ['required'],
            'image' => ['image', 'file', 'max:5120']
        ];

        if($request->slug != $product_category->slug) {
            $rules['slug'] = ['required', 'unique:product_categories'];
        }

        $validatedData = $request->validate($rules);

        if($request->file('image')) {
            if($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('productcategory-images');
        }

        ProductCategory::where('id', $product_category->id)
            ->update($validatedData);

        return redirect('/dashboard/product_categories')->with('success', 'Product category has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductCategory  $product_category
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductCategory $product_category)
    {
        if($product_category->image) {
            Storage::delete($product_category->image);
        }

        Product::where('product_category_id', $product_category->id)->delete();
        ProductCategory::destroy($product_category->id);

        return redirect('/dashboard/product_categories')->with('success', 'Product category has been deleted!');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(ProductCategory::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
