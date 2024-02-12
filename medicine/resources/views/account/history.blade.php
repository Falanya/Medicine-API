@extends('main')

@section('main')

<nav class="navbar navbar-inverse">
    <ul class="nav navbar-nav">
        <li>
            <a href="{{ route('account.profile') }}">Profile</a>
        </li>
        <li>
            <a href="{{ route('account.address') }}">Address</a>
        </li>
        <li>
            <a href="{{ route('account.change_password') }}">Password</a>
        </li>
        <li class="active">
            <a href="{{ route('order.history') }}">Orders</a>
        </li>
    </ul>
</nav>

<h2 style="font-weight: 700">My Order History</h2>
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
                        <span>Paid</span>
                        @elseif ($order->status == 3)
                        <span>Completed</span>
                        @elseif ($prder->status == 4)
                        <span>Cancelled</span>
                        @endif
                    </td>
                    <td>{{ number_format($order->totalPrice) }}</td>
                    <td>
                        <a href="{{ route('order.detail', $order->id) }}" class="btn btn-sm btn-primary">See detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@stop