@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>Profile - {{ $user->name }}</h2>
    </div>

    <div class="col-lg-6">
        <a href="/dashboard/users" class="btn btn-success">Back to all users</a>
        <form action="/dashboard/users/{{ $user->username }}" method="post" class="d-inline">
            @method('delete')
            @csrf
            <button class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
        </form>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <table class="table table-borderless mt-2">
            <tr>
                <td rowspan="7" class="text-center"><img src="/assets/images/account-default.png" alt="{{ $user->username }}" class="img-thumbnail rounded-circle" style="width: 150px"></td>
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
            </table>
            </div>
        </div>
@endsection