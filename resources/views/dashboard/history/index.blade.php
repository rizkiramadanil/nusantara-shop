@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h2>Order History</h2>
    </div>

    @if (session()->has('success'))
      <div class="alert alert-success col-lg-8" role="alert">
        {{ session('success') }}
      </div>
    @endif

    <div class="table-responsive col-lg-8">
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Order Date</th>
            <th scope="col">Username</th>
            <th scope="col">Status</th>
            <th scope="col">Total Price</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $order->order_date }}</td>
              <td>{{ $order->user->username }}</td>
              <td>
                  @if ($order->status == 1)
                  Order accepted
                  @else
                  Order completed
                  @endif
              </td>
              <td>Rp {{ number_format($order->total_price) }}</td>
              <td>
                  <a href="{{ url('/dashboard/history') }}/{{ $order->id }}" class="badge bg-info"><span data-feather="eye"></span></a>
              </td>
            </tr>   
            @endforeach
        </tbody>
      </table>
    </div>
@endsection