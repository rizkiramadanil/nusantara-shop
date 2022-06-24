@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>Single Post Category</h2>
    </div>

    <div class="col-lg-5">
        <a href="/dashboard/post_categories" class="btn btn-success">Back to all post category</a>
        <a href="/dashboard/post_categories/{{ $post_category->slug }}/edit" class="btn btn-warning" style="color: white">Edit</a>
        <form action="/dashboard/post_categories/{{ $post_category->slug }}" method="post" class="d-inline">
            @method('delete')
            @csrf
            <button class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
        </form>
    </div>

    <div class="row">
        <div class="col-lg-5">
            @if ($post_category->image)
                <div class="card bg-dark text-white mt-3" style="width: 300px; height: 300px;">
                    <img src="{{ asset('storage/' . $post_category->image) }}" class="card-img" alt="{{ $post_category->name }}">
                    <div class="card-img-overlay d-flex align-items-center p-0">
                        <h5 class="card-title text-center flex-fill p-4 fs-3" style="background-color: rgba(0, 0, 0, 0.7)">{{ $post_category->name }}</h5>
                    </div>
                </div>
            @else
                <div class="card bg-dark text-white mt-3" style="width: 300px; height: 300px;">
                    <img src="/assets/images/no-image-category.png" class="card-img" alt="{{ $post_category->name }}">
                    <div class="card-img-overlay d-flex align-items-center p-0">
                        <h5 class="card-title text-center flex-fill p-4 fs-3" style="background-color: rgba(0, 0, 0, 0.7)">{{ $post_category->name }}</h5>
                    </div>
                </div>
            @endif
        </div>
        </div>
@endsection