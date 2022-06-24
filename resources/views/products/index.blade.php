@extends('layouts.main')

@section('main-body')
    <div class="page-heading products-heading header-text">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-content">
              <h4>new products</h4>
              <h2>Nusantara Shop Products</h2>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="products">
      <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading">
                    <h2 class="text-center mb-4">{{ $title }}</h2>
                    <div class="row justify-content-center mb-3">
                        <div class="col-md-6">
                            <form action="/products">
                                @if (request('product_category'))
                                    <input type="hidden" name="product_category" value="{{ request('product_category') }}">
                                @endif
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Search.." name="search" value="{{ request('search') }}">
                                    <button class="btn btn-secondary" type="submit">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            @if ($products->count())
            <div class="container">
                <div class="row">
                    @foreach ($products as $product)
                        <div class="col-lg-4 mb-1">
                            <div class="product-item card mb-2">
                                @if ($product->image)
                                    <div style="max-height: 150px; overflow:hidden;">
                                      <a href="{{ url('products') }}/{{ $product->slug }}">
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->slug }}" class="card-img-top">
                                      </a>
                                    </div>
                                @else
                                  <div>
                                    <a href="{{ url('products') }}/{{ $product->slug }}">
                                      <img src="/assets/images/no-image.png" class="card-img-top" alt="{{ $product->slug }}">
                                    </a>
                                  </div>
                                @endif
                                
                                <div class="down-content card-body">
                                <a href="{{ url('products') }}/{{ $product->slug }}"><h4>{{ $product->title }}</h4></a>
                                <h6>Rp {{ number_format($product->price) }}</h6>
                                <ul class="stars">
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li> | 5.0</li>
                                </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @else
            <div class="container">
                <div class="row justify-content-center" style="padding-bottom: 200px">
                    <p style="font-size: 18px; font-weight: 500">No product found</p>
                </div>
            </div>
            @endif

            <div class="col-md-12">
                {{ $products->links() }}
            </div>

            <div class="col-md-12 mt-5">
                <div class="section-heading">
                    <h2>Product Category</h2>
                </div>
                <div class="row">
                    @foreach ($product_categories as $product_category)
                    <div class="col-lg-3 mb-3">
                        <a href="/products?product_category={{ $product_category->slug }}">
                            @if ($product_category->image)
                                <div class="card bg-dark text-white" style="max-height: 260px; overflow:hidden;">
                                    <img src="{{ asset('storage/' . $product_category->image) }}" class="card-img" alt="{{ $product_category->name }}">
                                    <div class="card-img-overlay d-flex align-items-center p-0">
                                        <h5 class="card-title text-center flex-fill p-4 fs-3" style="background-color: rgba(0, 0, 0, 0.7)">{{ $product_category->name }}</h5>
                                    </div>
                                </div>
                            @else
                                <div class="card bg-dark text-white">
                                    <img src="/assets/images/no-image-category.png" class="card-img" alt="{{ $product_category->name }}">
                                    <div class="card-img-overlay d-flex align-items-center p-0">
                                        <h5 class="card-title text-center flex-fill p-4 fs-3" style="background-color: rgba(0, 0, 0, 0.7)">{{ $product_category->name }}</h5>
                                    </div>
                                </div>
                            @endif
                        </a>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
      </div>
    </div>
@endsection