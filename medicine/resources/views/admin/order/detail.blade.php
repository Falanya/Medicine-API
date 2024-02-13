@extends('admin.admin')

@section('main')

<a href="{{ route('admin.order_index') }}" class="btn btn-sm btn-primary">Back</a>
<hr>
<h2 style="font-weight: 700">Order Detail</h2>
<a href="{{ route('admin.order_update', $order->id) }}?status=2" class="btn btn-danger" onclick="return confirm('Are you sure?')">Complete</a>
<a href="{{ route('admin.order_update', $order->id) }}?status=3" class="btn btn-danger" onclick="return confirm('Are you sure?')">Cancel</a>
<div class="container">
    <div class="col-md-4 col-lg-8">

        <h3>Customer Infomation</h3>
        
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Receiver name</th>
                    <th>{{ $order->address->receiver_name }}</th>
                </tr>

                <tr>
                    <th>Email</th>
                    <th>{{ $auth->email }}</th>
                </tr>

                <tr>
                    <th>Phone</th>
                    <th>{{ $order->address->phone }}</th>
                </tr>

                <tr>
                    <th>Receiver name</th>
                    <th>{{ $order->address->address }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                </tr>
            </tbody>
        </table>
        
        <h3>Product detail</h3>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Image</th>
                    <th>Product name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->details as $item)
                <tr>
                    <td scope="row">{{ $loop->index + 1 }}</td>
                    <td>
                        <img src="{{ asset('storage/images/products/' . $item->product->img) }}" alt="" width="100">
                    </td>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->price) }}</td>
                    <td>{{ number_format($item->quantity * $item->price) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <h3>Total price: {{ number_format($order->totalPrice) }}</h3>
    </div>
</div>

@stop