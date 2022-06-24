@extends('layouts.main')

@section('main-body')
    <div class="header-text">
      <div style="padding-top: 120px"></div>
    </div>
    <div class="container" style="padding-bottom: 130px">
      <div class="section-heading">
          <h2>Profile</h2>
      </div>
      <div class="row justify-content-center">
        @if(session()->has('success'))
          <div class="alert alert-success alert-dismissible fade show col-lg-8" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif
        @if(session()->has('error'))
          <div class="alert alert-danger alert-dismissible fade show col-lg-8" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif
        <div class="col-lg-8">
          <table class="table table-borderless">
            <tr>
              <td rowspan="8" class="text-center">
                @if ($user->image)
                  <div style="width: 200px">
                    <img src="{{ asset('storage/' . $user->image) }}" alt="{{ $user->username }}" class="img-thumbnail rounded-circle">
                  </div>
                @else
                  <div style="width: 200px">
                    <img src="/assets/images/account-default.png" alt="{{ $user->username }}" class="img-thumbnail rounded-circle" style="width: 160px">
                  </div>
                @endif
                
              </td>
            </tr>
            <tr>
              <th>Name</th>
              <td>{{ $user->name }}</td>
            </tr>
            <tr>
              <th>Username</th>
              <td>{{ $user->username }}</td>
            </tr>
            <tr>
              <th>Email</th>
              <td>{{ $user->email }}</td>
            </tr>
            <tr>
              <th>Address</th>
              <td>{{ $user->address }}</td>
            </tr>
            <tr>
              <th>Phone Number</th>
              <td>{{ $user->phonenumber }}</td>
            </tr>
            <tr>
              <td colspan="2" class="text-right"><a href="/user/{{ $user->username }}/edit" class="btn btn-main" >Edit My profile</a></td>
            </tr>
          </table>
          
        </div>
      </div>
    </div>
@endsection