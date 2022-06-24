@extends('layouts.main')

@section('main-body')
    <div class="header-text">
      <div style="padding-top: 120px"></div>
    </div>
    <div class="container" style="padding-bottom: 130px">
      <div class="section-heading">
          <h2>Edit Profile</h2>
      </div>
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <form method="post" action="/user/{{ $user->username }}" class="mb-5" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input type="text" class="form-control @error ('name') is-invalid @enderror" id="name" name="name" required value="{{ old('name', $user->name) }}">
              @error('name')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control @error ('username') is-invalid @enderror" id="username" name="username" required value="{{ old('username', $user->username) }}">
                @error('username')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control @error ('email') is-invalid @enderror" id="email" name="email" required value="{{ old('email', $user->email) }}">
                @error('email')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control @error ('password') is-invalid @enderror" id="password" name="password">
                @error('password')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
            </div>
            <div class="mb-3">
              <label for="password-confirm" class="form-label">Confirm Password</label>
              <input type="password" name="password_confirmation" class="form-control" id="password-confirm">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control @error ('address') is-invalid @enderror" id="address" name="address" required value="{{ old('address', $user->address) }}">
                @error('address')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="phonenumber" class="form-label">Phone Number</label>
                <input type="text" class="form-control @error ('phonenumber') is-invalid @enderror" id="phonenumber" name="phonenumber" required value="{{ old('phonenumber', $user->phonenumber) }}">
                @error('phonenumber')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
            </div>
            <div class="mb-3">
              <label for="image" class="form-label">User Image</label>
              <input type="hidden" name="oldImage" value="{{ $user->image }}">
              @if ($user->image)
                <img src="{{ asset('storage/' . $user->image) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block">
              @else
                <img class="img-preview img-fluid mb-3 col-sm-5">
              @endif
              <input class="form-control @error ('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()">
              @error('image')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <a href="/user" class="btn btn-success">Back to Profile</a>
            <button type="submit" class="btn btn-main">Update Profile</button>
          </form>
        </div>
      </div>
    </div>  

  <script>
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