@extends('layouts.main')

@section('main-body')
    <div class="header-text">
        <div style="padding-top: 120px"></div>
    </div>
    <div class="container" style="padding-bottom: 130px">
    <div class="row justify-content-center mb-5">
        <div class="col-lg-8">
            <h2 style="margin-bottom: 8px">{{ $post->title }}</h2>
            <p class="mb-3">By <a href="/posts?author={{ $post->author->username }}" style="font-weight: 400">{{ $post->author->name }}</a> in <a href="/posts?post_category={{ $post->post_category->slug }}" style="font-weight: 400">{{ $post->post_category->name }}</a></p>

            @if ($post->image)
                <div style="max-height: 300px; overflow:hidden;">
                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->slug }}" class="img-fluid">
                </div>
            @else
                <div>
                    <img src="/assets/images/no-image-post.png" alt="{{ $post->slug }}" class="img-fluid">
                </div>
            @endif

            <article class="my-3 fs-6">
                {!! $post->body !!}
            </article>

            <a href="/posts" class="mt-3">Back to posts</a>
        </div>
    </div>
    </div>
@endsection