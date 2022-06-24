@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>Create New Product</h2>
      </div>

      <div class="col-lg-8">
          <form method="post" action="/dashboard/products" class="mb-5" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label for="title" class="form-label">Title</label>
              <input type="text" class="form-control @error ('title') is-invalid @enderror" id="title" name="title" autofocus required value="{{ old('title') }}">
              @error('title')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="slug" class="form-label">Slug</label>
              <input type="text" class="form-control @error ('slug') is-invalid @enderror" id="slug" name="slug" required value="{{ old('slug') }}">
              @error('slug')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="product_category" class="form-label">Category</label>
              <select class="form-select" name="product_category_id">
                @foreach ($product_categories as $product_category)
                  @if (old('product_category_id') == $product_category->id)
                    <option value="{{ $product_category->id }}"selected>{{ $product_category->name }}</option>
                  @else
                    <option value="{{ $product_category->id }}">{{ $product_category->name }}</option>
                  @endif
                @endforeach
              </select>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="text" class="form-control @error ('price') is-invalid @enderror" id="price" name="price" required value="{{ old('price') }}">
                @error('price')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="text" class="form-control @error ('stock') is-invalid @enderror" id="stock" name="stock" required value="{{ old('stock') }}">
                @error('stock')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="weight" class="form-label">Weight</label>
                <input type="text" class="form-control @error ('weight') is-invalid @enderror" id="weight" name="weight" required value="{{ old('weight') }}">
                @error('weight')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
            </div>
            <div class="mb-3">
              <label for="image" class="form-label">Product Image</label>
              <img class="img-preview img-fluid mb-3 col-sm-5">
              <input class="form-control @error ('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()">
              @error('image')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="detail" class="form-label">Detail</label>
              <input id="detail" type="hidden" name="detail" value="{{ old('detail') }}">
              <trix-editor input="detail"></trix-editor>
              @error('detail')
                <small class="text-danger">{{ $message }}</small>  
              @enderror
            </div>

            <button type="submit" class="btn btn-primary">Create Product</button>
          </form>
      </div>

      <script>
          const title = document.querySelector('#title');
          const slug = document.querySelector('#slug');

          title.addEventListener('change', function() {
            fetch('/dashboard/products/checkSlug?title=' + title.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
          });

          document.addEventListener('trix-file-accept', function(e) {
            e.preventDefault();
          });

          function previewImage() {
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
              imgPreview.src = oFREvent.target.result;
            }
          }
      </script>
@endsection