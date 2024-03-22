<?php
$total = 0;
foreach($details->details as $item) {
    $total += $item->quantity * $item->price;
}
?>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Đơn hàng {{ $details->tracking_number }}</h2>
        @if($details->status == 0)
            <h4>Trạng thái: Chưa xác minh email</h4>
        @elseif($details->status == 1)
            <h4>Trạng thái: Đã xác minh email</h4>
        @elseif($details->status == 2)
            <h4>Trạng thái: Đang vận chuyển</h4>
        @elseif($details->status == 3)
            <h4>Trạng thái: Đã hoàn thành</h4>
        @elseif($details->status == 4)
            <h4>Trạng thái: Đã bị hủy</h4>
        @endif
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('account.index') }}">Home</a>
            </li>
            <li>
                <a>Orders List</a>
            </li>
            <li>
                <a>History</a>
            </li>
            <li class="active">
                <strong>Mã vận đơn {{ $details->tracking_number }}</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Thông tin tài khoản</h5>
                </div>
                <div class="ibox-content">
                    <p><strong>Fullname:</strong> {{ $details->user->fullname }}</p>
                    <p><strong>Email:</strong> {{ $details->user->email }}</p>
                    <p><strong>Phone:</strong> {{ $details->user->phone }}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Thông tin nhận hàng</h5>
                </div>
                <div class="ibox-content">
                    <p><strong>Fullname:</strong> {{ $details->address->receiver_name }}</p>
                    <p><strong>Address:</strong> {{ $details->address->address }}</p>
                    <p><strong>Phone:</strong> {{ $details->address->phone }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <h4>Tổng đơn: {{ number_format($total) }}</h4>
                <h4>Giảm giá: {{ number_format($details->discountPrice) }}</h4>
                <hr/>
                <h4>Thành tiền: {{ number_format($details->totalPrice) }}</h4>
            </div>
        </div>
    </div>
    <div class="">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Thông tin sản phẩm</h5>
            </div>
            <div class="ibox-content">

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th></th>
                            <th>Tên</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                            <th>Tổng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($details->details as $item)
                        <tr>
                            <td>{{ $loop->index +1 }}</td>
                            <td class="text-center"><img src="{{ asset('storage/images/products/'.$item->product->img) }}" width="100px" height="100px"></td>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format($item->price) }}</td>
                            <td>{{ number_format($item->price * $item->quantity) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
