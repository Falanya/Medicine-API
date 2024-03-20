<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        @if($request == 1)
        <h2>Đã xác minh</h2>
        @elseif($request == 2)
        <h2>Đang vận chuyển</h2>
        @elseif($request == 3)
        <h2>Đã hoàn thành</h2>
        @elseif($request == 4)
        <h2>Đã hủy</h2>
        @endif
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard.index') }}">Home</a>
            </li>
            <li>
                <a>Quản lý đơn hàng</a>
            </li>
            <li class="active">
                @if($request == 1)
                <strong>Đã xác minh</strong>
                @elseif($request == 2)
                <strong>Đang vận chuyển</strong>
                @elseif($request == 3)
                <strong>Đã hoàn thành</strong>
                @elseif($request == 4)
                <strong>Đã hủy</strong>
                @endif
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                @if($request == 1)
                <h5>Đơn đã xác minh</h5>
                @elseif($request == 2)
                <h5>Đơn đang vận chuyển</h5>
                @elseif($request == 3)
                <h5>Đơn đã hoàn thành</h5>
                @elseif($request == 4)
                <h5>Đơn đã hủy</h5>
                @endif
            </div>
            <div class="ibox-content">

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Mã vận đơn</th>
                            <th>Tổng tiền</th>
                            <th>Ngày đặt</th>
                            <th>Ngày cập nhật</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $item)
                        <tr>
                            <td>{{ $item->tracking_number }}</td>
                            <td>{{ number_format($item->totalPrice) }}</td>
                            <td>{{ $item->created_at->format('d-m-Y') }}</td>
                            <td>{{ $item->updated_at->format('d-m-Y') }}</td>
                            <td class="text-center"><a class="btn btn-primary"><i class="fa fa-edit"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>