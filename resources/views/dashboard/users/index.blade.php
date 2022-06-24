@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h2>Users</h2>
    </div>

    @if (session()->has('success'))
      <div class="alert alert-success col-lg-8" role="alert">
        {{ session('success') }}
      </div>
    @endif

    <div class="table-responsive col-lg-6">
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Name</th>
            <th scope="col">Username</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $user->name }}</td>
              <td>{{ $user->username }}</td>
              <td>
                  <a href="/dashboard/users/{{ $user->username }}" class="badge bg-info"><span data-feather="eye"></span></a>
                  <form action="/dashboard/users/{{ $user->username }}" method="post" class="d-inline">
                    @method('delete')
                    @csrf
                    <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"><span data-feather="trash"></span></button>
                  </form>
              </td>
            </tr>   
            @endforeach
        </tbody>
      </table>
    </div>
@endsection