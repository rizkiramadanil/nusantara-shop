<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\PostCategory;

class PostController extends Controller
{
    public function index()
    {
        $title = '';
        if(request('post_category')) {
            $post_category = PostCategory::firstWhere('slug', request('post_category'));
            $title = ' in ' . $post_category->name;
        }

        if(request('author')) {
            $author = User::firstWhere('username', request('author'));
            $title = ' by ' . $author->name;
        }

        return view('posts.index', [
            "title" => "All Posts" . $title,
            "posts" => Post::latest()->filter(request(['search', 'post_category', 'author']))->paginate(7)->withQueryString(),
            "post_categories" => PostCategory::all()
        ]);
    }

    public function show(Post $post)
    {
        return view('posts.show', [
            "title" => "Single Post",
            "post" => $post
        ]);
    }
}