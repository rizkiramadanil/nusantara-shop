@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>Single Post</h2>
    </div>

    <div class="col-lg-8">
        <a href="/dashboard/posts" class="btn btn-success">Back to all my posts</a>
        <a href="/dashboard/posts/{{ $post->slug }}/edit" class="btn btn-warning" style="color: white">Edit</a>
        <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="d-inline">
            @method('delete')
            @csrf
            <button class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
        </form>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <h3 class="mb-2 mt-2">{{ $post->title }}</h3>
            @if ($post->image)
                <div style="max-height: 340px; overflow:hidden;">
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

        </div>
    </div>
@endsection