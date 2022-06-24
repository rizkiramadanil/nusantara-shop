@extends('layouts.main')

@section('main-body')
    <div class="page-heading blog-heading header-text">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="text-content">
                <h4>new posts</h4>
                <h2>nusantara shop posts</h2>
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
                              <form action="/posts">
                                  @if (request('post_category'))
                                      <input type="hidden" name="post_category" value="{{ request('post_category') }}">
                                  @endif
                                  @if (request('author'))
                                      <input type="hidden" name="author" value="{{ request('author') }}">
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
  
              @if ($posts->count())
              <div class="product-item mb-3">
                  @if ($posts[0]->image)
                  <div style="max-height: 470px; overflow:hidden;">
                      <a href="/posts/{{ $posts[0]->slug }}"><img src="{{ asset('storage/' . $posts[0]->image) }}" alt="{{ $posts[0]->slug }}" class="img-fluid"></a>
                  </div>
                  @else
                      <a href="/posts/{{ $posts[0]->slug }}">
                        <div>
                            <img src="/assets/images/no-image-post.png" class="card-img-top" alt="{{ $posts[0]->slug }}">
                        </div>
                      </a>
                  @endif
                  
                  <div class="down-content text-center">
                  <a href="/posts/{{ $posts[0]->slug }}" class="text-decoration-none text-dark"><h3>{{ $posts[0]->title }}</h3></a>
                  <p>
                      <small class="text-muted">
                          By <a href="/posts?author={{ $posts[0]->author->username }}" style="font-weight: 400">{{ $posts[0]->author->name }}</a> in <a href="/posts?post_category={{ $posts[0]->post_category->slug }}" style="font-weight: 400">{{ $posts[0]->post_category->name }}</a> {{ $posts[0]->created_at->diffForHumans() }}
                      </small>
                  </p>
                  <p class="card-text">{{ $posts[0]->excerpt }}</p>
                  
                  </div>
              </div>
              <div class="container">
                  <div class="row">
                      @foreach ($posts->skip(1) as $post)
                          <div class="col-lg-4 mb-1">
                              <div class="product-item mb-2">
                                  <div class="position-absolute px-3 py-2" style="background-color: rgba(0, 0, 0, 0.8)"><a href="/posts?post_category={{ $post->post_category->slug }}" class="text-decoration-none text-white">{{ $post->post_category->name }}</a></div>
                                  @if ($post->image)
                                    <div style="max-height: 150px; overflow:hidden;">
                                    <a href="/posts/{{ $post->slug }}">
                                        
                                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->slug }}" class="img-fluid">
                                      </a>
                                    </div>
                                  @else
                                  <div>
                                    <a href="/posts/{{ $post->slug }}">
                                            <img src="/assets/images/no-image.png" class="card-img-top" alt="{{ $post->slug }}">
                                      </a>
                                    </div>
                                  @endif
                                  
                                  <div class="down-content">
                                        <a href="/posts/{{ $post->slug }}"><h4>{{ $post->title }}</h4></a>
                                        <p style="margin-bottom: 3px">
                                          <small class="text-muted">
                                              By <a href="/posts?author={{ $post->author->username }}" style="font-weight: 400">{{ $post->author->name }}</a> {{ $post->created_at->diffForHumans() }}
                                          </small>
                                      </p>
                                  <p class="card-text">{{ $post->excerpt }}</p>
                                  </div>
                              </div>
                          </div>
                      @endforeach
                  </div>
              </div>
              @else
              <div class="container">
                <div class="row justify-content-center">
                    <p style="font-size: 18px; font-weight: 500">No post found</p>
                </div>
              </div>
              @endif
              <div class="col-md-12">
                  {{ $posts->links() }}
              </div>

              <div class="col-md-12 mt-5">
                <div class="section-heading">
                    <h2>Post Category</h2>
                </div>
                <div class="row">
                    @foreach ($post_categories as $post_category)
                    <div class="col-lg-3 mb-3">
                        <a href="/posts?post_category={{ $post_category->slug }}">
                            @if ($post_category->image)
                                <div class="card bg-dark text-white" style="max-height: 260px; overflow:hidden;">
                                    <img src="{{ asset('storage/' . $post_category->image) }}" class="card-img" alt="{{ $post_category->name }}">
                                    <div class="card-img-overlay d-flex align-items-center p-0">
                                        <h5 class="card-title text-center flex-fill p-4 fs-3" style="background-color: rgba(0, 0, 0, 0.7)">{{ $post_category->name }}</h5>
                                    </div>
                                </div>
                            @else
                                <div class="card bg-dark text-white">
                                    <img src="/assets/images/no-image-category.png" class="card-img" alt="{{ $post_category->name }}">
                                    <div class="card-img-overlay d-flex align-items-center p-0">
                                        <h5 class="card-title text-center flex-fill p-4 fs-3" style="background-color: rgba(0, 0, 0, 0.7)">{{ $post_category->name }}</h5>
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