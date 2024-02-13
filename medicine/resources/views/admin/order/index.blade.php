@extends('admin.admin')

@section('main')

<h2 style="font-weight: 700">User Order List</h2>
<a href="{{ route('admin.order_index') }}?status=1" class="btn btn-danger">Verified</a>
<a href="{{ route('admin.order_index') }}?status=2" class="btn btn-danger">Complete</a>
<a href="{{ route('admin.order_index') }}?status=3" class="btn btn-danger">Cancel</a>
<hr>
<div class="container">
    <div class="col-md-4 col-lg-8">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Order date</th>
                    <th>Status</th>
                    <th>Total price</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td scope="row">{{ $loop->index + 1 }}</td>
                    <td>{{ $order->created_at->format('d/m/Y') }}</td>
                    <td>
                        @if ($order->status == 0)
                        <span>Not verified</span>
                        @elseif ($order->status == 1)
                        <span>Verified</span>
                        @elseif ($order->status == 2)
                        <span>Completed</span>
                        @elseif ($prder->status == 3)
                        <span>Cancelled</span>
                        @endif
                    </td>
                    <td>{{ number_format($order->totalPrice) }}</td>
                    <td>
                        <a href="{{ route('admin.order_detail', $order->id) }}" class="btn btn-sm btn-primary">See detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@stop