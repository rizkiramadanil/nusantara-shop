@extends('layouts.main')

@section('main-body')
    <div class="header-text">
        <div style="padding-top: 120px"></div>
    </div>
    <div class="container">
    <div class="row justify-content-center mb-5">
        @if (session()->has('success'))
          <div class="alert alert-success alert-dismissible fade show col-lg-11" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif
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
                  <th colspan="2"><h3>{{ $product->title }}</h3></th>
                </tr>
                <tr>
                  <th style="font-weight: 500">Category</th>
                  <td style="font-weight: 300">{{ $product->product_category->name }}</td>
                </tr>
                <tr>
                  <th style="font-weight: 500">Price</th>
                  <td style="font-weight: 300">Rp {{ number_format($product->price) }}</td>
                </tr>
                <tr>
                  <th style="font-weight: 500">Stock</th>
                  <td style="font-weight: 300">{{ $product->stock }}</td>
                </tr>
                <tr>
                  <th style="font-weight: 500">Weight</th>
                  <td style="font-weight: 300">{{ $product->weight }} grams</td>
                </tr>
                <tr>
                  <th style="font-weight: 500">Detail</th>
                  <td>
                      <article>
                          {!! $product->detail !!}
                      </article>
                  </td>
                </tr>
                <tr>
                    <th style="font-weight: 500">Quantity</th>
                    <td>
                        <form action="{{ url('products') }}/{{ $product->id }}" method="post">
                        @csrf
                            <input type="text" name="order_quantity" class="form-control @error('order_quantity') is-invalid @enderror" id="order_quantity" required>
                            @error('order_quantity')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <button type="submit" class="btn btn-main mt-3"><i class="fas fa-cart-plus"></i></i> Add to Cart</button>
                        </form>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    </div>
@endsection