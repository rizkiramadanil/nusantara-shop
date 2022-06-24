@extends('layouts.main')

@section('main-body')
    <!-- Page Content -->
    <div class="header-text">
        <div style="padding-top: 120px"></div>
    </div>
    <div class="container" style="padding-bottom: 190px">
        <div class="section-heading">
            <h2>Order History</h2>
        </div>
    <div class="row justify-content-center mb-5">
        <div class="col-lg-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="font-weight: 600">No</th>
                        <th style="font-weight: 600">Order Date</th>
                        <th style="font-weight: 600">Status</th>
                        <th style="font-weight: 600">Total Price</th>
                        <th style="font-weight: 600">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    @foreach ($orders as $order)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $order->order_date }}</td>
                        <td>
                            @if ($order->status == 1)
                            Order accepted
                            @else
                            Order completed
                            @endif
                        </td>
                        <td>Rp {{ number_format($order->total_price) }}</td>
                        <td>
                            <a href="{{ url('/user/history') }}/{{ $order->id }}" class="btn btn-main">Detail</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
@endsection