@extends('layouts.main')

@section('main-body')
    <div class="banner header-text">
      <div class="owl-banner owl-carousel">
        <div class="banner-item-01">
          <div class="text-content">
            <h4>Best Offer</h4>
            <h2>New Arrivals On Sale</h2>
          </div>
        </div>
        <div class="banner-item-02">
          <div class="text-content">
            <h4>Best Products</h4>
            <h2>Get your best products</h2>
          </div>
        </div>
        <div class="banner-item-03">
          <div class="text-content">
            <h4>Best Price</h4>
            <h2>Best product with best price</h2>
          </div>
        </div>
      </div>
    </div>

    <div class="latest-products">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2>Latest Products</h2>
              <a href="/products">view all products <i class="fa fa-angle-right"></i></a>
            </div>
          </div>

          @if ($products->count())
            <div class="container">
                <div class="row">
                    @foreach ($products as $product)
                        <div class="col-md-4 mb-1">
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
        </div>
      </div>
    </div>

    <div class="best-features">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2>About Nusantara Shop</h2>
            </div>
          </div>
          <div class="col-md-6">
            <div class="left-content">
              <h4>What is the Nusantara shop?</h4>
              <p>Nusantara Shop merupakan situs belanja online yang menjual produk-produk, jajanan, dan juga pakaian tradisional. Nusantara Shop ini memudahkan pelanggan untuk mencari dan membeli barang-barang, jajanan, dan pakaian tradisional. Selain itu Nusantara Shop ini juga menyediakan informasi seputar barang dan jajanan tradisonal yang bisa menambah pengetahuan pelanggan.</p>
              <h4>Our Team Members</h4>
              <ul class="featured-list">
                <li style="font-size: 15px">Audra Najmi Maghfira</li>
                <li style="font-size: 15px">Farhan Maulidani</li>
                <li style="font-size: 15px">Fitri Chairani</li>
                <li style="font-size: 15px">Muhammad Ilham</li>
                <li style="font-size: 15px">Rizki Ramadanil</li>
                <li style="font-size: 15px">Visra Handriani</li>
              </ul>
              <a href="/about" class="filled-button">Read More</a>
            </div>
          </div>
          <div class="col-md-6">
            <div class="right-image">
              <img src="assets/images/about.jpg" alt="">
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="call-to-action">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="inner-content">
              <div class="row">
                <div class="col-md-8">
                  <h4>Nusantara Shop Products</h4>
                  <p>Nusantara Shop menjual produk-produk tradisional berkualitas, terpercaya dan ramah di kantong.</p>
                </div>
                <div class="col-md-4">
                  <a href="/products" class="filled-button">Buy Now</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection

