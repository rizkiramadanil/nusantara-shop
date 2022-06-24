@extends('layouts.main')

@section('main-body')
    <div class="header-text">
        <div style="padding-top: 120px"></div>
    </div>
    <div class="container">
        <div class="section-heading">
            <h2>Check Out</h2>
        </div>
    @if ((!empty($order))&&(count($order_details)!=0))
    <div class="row justify-content-center" style="padding-bottom: 86px">
        <div class="col-lg-12">
            <p class="mb-2" style="font-weight: 400">Order Date : {{ $order->order_date }}</p>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="font-weight: 600">No</th>
                        <th style="font-weight: 600">Image</th>
                        <th style="font-weight: 600">Product Name</th>
                        <th style="font-weight: 600">Quantity</th>
                        <th style="font-weight: 600">Price</th>
                        <th style="font-weight: 600">Total Price</th>
                        <th style="font-weight: 600">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    @foreach ($order_details as $order_detail)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>
                            @if ($order_detail->product->image)
                                <img src="{{ asset('storage/' . $order_detail->product->image) }}" alt="{{ $order_detail->product->slug }}" class="rounded" style="width: 80px; height: 80px;">
                            @else
                                <img src="/assets/images/no-image-product.png" alt="{{ $order_detail->product->slug }}" class="rounded" style="width: 80px; height: 80px;">
                            @endif
                        </td>
                        <td>{{ $order_detail->product->title }}</td>
                        <td>{{ $order_detail->total_product }}</td>
                        <td>Rp {{ number_format($order_detail->product->price) }}</td>
                        <td>Rp {{ number_format($order_detail->total_price) }}</td>
                        <td>
                            <form action="{{ url('check_out') }}/{{ $order_detail->id }}" method="post">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot class="border-bottom">
                    <tr>
                        <td colspan="5" style="font-weight: 550">Total Price</td>
                        <td colspan="2" style="font-weight: 550">Rp {{ number_format($order->total_price) }}</td>
                    </tr>
                </tfoot>
            </table>
            <div class="text-center">
                <a href="{{ url('confirm_check_out') }}" class="btn btn-success" onclick="return confirm('Are you sure?')">Check Out</a>
            </div>
        </div>
    </div>
    @else
    <div class="row justify-content-center" style="padding-bottom: 353px">
        <p style="font-size: 18px; font-weight: 500">Nothing product to check out</p>
    </div>
    @endif

    </div>
@endsection