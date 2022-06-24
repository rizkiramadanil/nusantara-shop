@extends('layouts.main')

@section('main-body')
    <!-- Page Content -->
    <div class="header-text">
      <div style="padding-top: 120px"></div>
    </div>
    <div class="container" style="padding-bottom: 130px">
      <div class="section-heading">
        <h2>Register Form</h2>
      </div>
      <div class="row justify-content-center">
        <div class="col-lg-4">
          <main class="form-registration">
            <form action="/register" method="post">
              @csrf  
              <div class="form-floating">
                  <input type="text" name="name" class="form-control rounded-top @error('name') is-invalid @enderror"  id="name" placeholder="Nama" required value="{{ old('name') }}">
                  <label for="name">Name</label>
                  @error('name')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
              </div>
              <div class="form-floating">
                  <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="Username" required value="{{ old('username') }}">
                  <label for="username">Username</label>
                  @error('username')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
              </div>
              <div class="form-floating">
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email" required value="{{ old('email') }}">
                <label for="email">Email</label>
                @error('email')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                @enderror
              </div>
              <div class="form-floating">
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" required autocomplete="new-password">
                <label for="password">Password</label>
                @error('password')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                @enderror
              </div>
              <div class="form-floating">
                <input type="password" name="password_confirmation" class="form-control" id="password-confirm" placeholder="Confirm Password" required autocomplete="new-password">
                <label for="password-confirm">Confirm Password</label>
              </div>
              <div class="form-floating">
                <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" id="address" placeholder="Address" required value="{{ old('address') }}">
                <label for="address">Address</label>
                @error('address')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                @enderror
            </div>
              <div class="form-floating">
                <input type="text" name="phonenumber" class="form-control rounded-bottom @error('phonenumber') is-invalid @enderror" id="phonenumber" placeholder="Phone Number" required value="{{ old('phonenumber') }}">
                <label for="phonenumber">Phone Number</label>
                @error('phonenumber')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                @enderror
              </div>
              <button class="w-100 btn btn-lg btn-dark" type="submit" style="margin-top: 20px">Register</button>
            </form>
            <small class="d-block text-center mt-3">Already have an account? <a href="/login" class="text-decoration-none" style="color: #f33f3f; font-weight: 500">Login here</a></small>
        </main>
        </div>
      </div>
    </div>
@endsection