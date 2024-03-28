<?php
$total = 0;
foreach($details->details as $item) {
    $total += $item->quantity * $item->price;
}
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>
            Đơn hàng {{ $details->tracking_number }}
            @if($details->status == 1)
            <span><small class="text-danger">Đã duyệt</small></span>
            @elseif($details->status == 2)
            <span><small class="text-danger">Đang vận chuyển</small></span>
            @elseif($details->status == 0)
            <span><small class="text-danger">Chưa xác minh</small></span>

            @elseif($details->status == 3)
            <span><small class="text-danger">Đã hoàn thành</small></span>
            @elseif($details->status == 4)
            <span><small class="text-danger">Bị hủy</small></span>
            @endif
        </h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard.index') }}">Home</a>
            </li>
            <li>
                <a>Quản lý đơn hàng</a>
            </li>
            <li class="active">
                <strong>Đơn hàng {{ $details->tracking_number }}</strong>
            </li>
        </ol>
    </div>
</div>
<div class="m-t-md">
    @if($details->status == 1)
    <a onclick="" href="{{ route('dashboard.orders.change-status', [$details->tracking_number,'status'=>2]) }}" class="btn btn-primary button-shipping">Vận chuyển</a>
    <a onclick="" href="{{ route('dashboard.orders.change-status', [$details->tracking_number,'status'=>4]) }}" class="btn btn-primary bg-danger button-cancel">Hủy đơn</a>
    @elseif($details->status == 0)
    <a onclick="" href="{{ route('dashboard.orders.change-status', [$details->tracking_number,'status'=>4]) }}" class="btn btn-primary bg-danger button-cancel">Hủy đơn</a>
    @elseif($details->status == 2)
    <a onclick="" href="{{ route('dashboard.orders.change-status', [$details->tracking_number,'status'=>3]) }}" class="btn btn-primary button-complete">Hoàn thành</a>
    <a onclick="" href="{{ route('dashboard.orders.change-status', [$details->tracking_number,'status'=>4]) }}" class="btn btn-primary bg-danger button-cancel">Hủy đơn</a>
    @endif
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('.button-shipping').click(function (event) {
            event.preventDefault();
            var href = $(this).attr('href');
            swal({
                title: "Bạn chắc chứ?",
                text: "Chuyển trạng thái đơn hàng sang Đang vận chuyển!!!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, proceed!",
                closeOnConfirm: false
            }, function (isConfirm) {
                if (isConfirm) {
                    window.location.href = href;
                }
            });
        });

        $('.button-complete').click(function (event) {
            event.preventDefault();
            var href = $(this).attr('href');
            swal({
                title: "Bạn chắc chứ?",
                text: "Chuyển trạng thái đơn hàng sang Đã hoàn thành!!!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, proceed!",
                closeOnConfirm: false
            }, function (isConfirm) {
                if (isConfirm) {
                    window.location.href = href;
                }
            });
        });

        $('.button-cancel').click(function (event) {
            event.preventDefault();
            var href = $(this).attr('href');
            swal({
                title: "Bạn chắc chứ?",
                text: "Chuyển đơn hàng sang trạng thái Bị hủy!!!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, proceed!",
                closeOnConfirm: false
            }, function (isConfirm) {
                if (isConfirm) {
                    window.location.href = href;
                }
            });
        });
    });
</script>

