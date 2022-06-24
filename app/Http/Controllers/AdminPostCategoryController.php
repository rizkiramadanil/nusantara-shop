<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostCategory;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminPostCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.post_categories.index', [
            'post_categories' => PostCategory::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.post_categories.create', [
            'post_categories' => PostCategory::all()
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
            'slug' => ['required', 'unique:post_categories'],
            'image' => ['image', 'file', 'max:5120']
        ]);

        if($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('postcategory-images');
        }

        PostCategory::create($validatedData);

        return redirect('/dashboard/post_categories')->with('success', 'New post category has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PostCategory  $post_category
     * @return \Illuminate\Http\Response
     */
    public function show(PostCategory $post_category)
    {
        return view('dashboard.post_categories.show', [
            'post_category' => $post_category
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PostCategory  $post_category
     * @return \Illuminate\Http\Response
     */
    public function edit(PostCategory $post_category)
    {
        return view('dashboard.post_categories.edit', [
            'post_category' => $post_category,
            'post_categories' => PostCategory::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PostCategory  $post_category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PostCategory $post_category)
    {
        $rules = [
            'name' => ['required'],
            'image' => ['image', 'file', 'max:5120']
        ];

        if($request->slug != $post_category->slug) {
            $rules['slug'] = ['required', 'unique:post_categories'];
        }

        $validatedData = $request->validate($rules);

        if($request->file('image')) {
            if($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('postcategory-images');
        }

        PostCategory::where('id', $post_category->id)
            ->update($validatedData);

        return redirect('/dashboard/post_categories')->with('success', 'Post category has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PostCategory  $post_category
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostCategory $post_category)
    {
        if($post_category->image) {
            Storage::delete($post_category->image);
        }

        Post::where('post_category_id', $post_category->id)->delete();
        PostCategory::destroy($post_category->id);

        return redirect('/dashboard/post_categories')->with('success', 'Post category has been deleted!');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(PostCategory::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
