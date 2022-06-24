@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>Single Product</h2>
    </div>

    <div class="col-lg-11">
        <a href="/dashboard/products" class="btn btn-success">Back to all products</a>
        <a href="/dashboard/products/{{ $product->slug }}/edit" class="btn btn-warning" style="color: white">Edit</a>
        <form action="/dashboard/products/{{ $product->slug }}" method="post" class="d-inline">
            @method('delete')
            @csrf
            <button class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
        </form>
    </div>

    <div class="row">
        <div class="col-lg-11">
            <table class="table table-borderless">
                <tr>
                    <td rowspan="9" class="text-center">
                    @if ($product->image)
                        <div style="width: 300px; height: 300px;">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->slug }}" class="img-fluid">
                        </div>
                    @else
                        <div style="width: 300px; height: 300px;">
                            <img src="/assets/images/no-image-product.png" alt="{{ $product->slug }}" class="rounded">
                        </div>
                    @endif
                    
                    </td>
                </tr>
                <tr>
                    <th colspan="2"><h4>{{ $product->title }}</h4></th>
                </tr>
                <tr>
                    <th style="font-weight: 600">Category</th>
                    <td style="font-weight: 400">{{ $product->product_category->name }}</td>
                </tr>
                <tr>
                    <th style="font-weight: 600">Price</th>
                    <td style="font-weight: 400">Rp {{ number_format($product->price) }}</td>
                </tr>
                <tr>
                    <th style="font-weight: 600">Stock</th>
                    <td style="font-weight: 400">{{ $product->stock }}</td>
                </tr>
                <tr>
                    <th style="font-weight: 600">Weight</th>
                    <td style="font-weight: 400">{{ $product->weight }} grams</td>
                </tr>
                <tr>
                    <th style="font-weight: 600">Detail</th>
                    <td>
                        <article>
                            {!! $product->detail !!}
                        </article>
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endsection