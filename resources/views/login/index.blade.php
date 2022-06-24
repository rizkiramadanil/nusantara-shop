@extends('layouts.main')

@section('main-body')
    <!-- Page Content -->
    <div class="header-text">
      <div style="padding-top: 120px"></div>
    </div>
    <div class="container" style="padding-bottom: 130px">
      <div class="section-heading">
        <h2>Login Form</h2>
      </div>
      <div class="row justify-content-center">
        <div class="col-lg-4">
          @if(session()->has('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif
      
          @if(session()->has('error'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif
      
          <main class="form-signin">
            <form action="/login" method="post">
              @csrf
              <div class="form-floating">
                <input type="email" name="email" class="form-control rounded-top @error('email') is-invalid @enderror" id="email" placeholder="Email" required value="{{ old('email') }}">
                <label for="email">Email</label>
                @error('email')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                @enderror
              </div>
              <div class="form-floating">
                <input type="password" name="password" class="form-control rounded-bottom" id="password" placeholder="Password" required>
                <label for="password">Password</label>
              </div>
              <button class="w-100 btn btn-lg btn-dark" type="submit" style="margin-top: 10px">Login</button>
            </form>
            <small class="d-block text-center mt-3">Don't have an account? <a href="/register" class="text-decoration-none" style="color: #f33f3f; font-weight: 500">Register now</a></small>
        </main>
        </div>
      </div>
    </div>
@endsection