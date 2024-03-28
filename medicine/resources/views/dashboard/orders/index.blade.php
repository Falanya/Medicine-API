<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Danh sách đơn hàng</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard.index') }}">Home</a>
            </li>
            <li>
                <a>Quản lý đơn hàng</a>
            </li>
            <li class="active">
                <strong>Danh sách đơn hàng</strong>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox-content m-b-sm border-bottom">
        <form action="">
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="control-label" for="order_id">Mã vận đơn</label>
                        <input type="text" id="order_id" name="tracking_number" value="{{ request()->tracking_number }}" placeholder="Order ID" class="form-control">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="control-label" for="order_id">Trạng thái</label>
                        <select name="status" class="input-m form-control input-s-m inline">
                            <option value="">Trạng thái</option>
                            <option value="not_verified" {{ request()->status == 'not_verified' ? 'selected' : '' }}>Chưa xác minh</option>
                            <option value="verified" {{ request()->status == 'verified' ? 'selected' : '' }}>Đã xác minh</option>
                            <option value="shipping" {{ request()->status == 'shipping' ? 'selected' : '' }}>Đang vận chuyển</option>
                            <option value="completed" {{ request()->status == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                            <option value="canceled" {{ request()->status == 'canceled' ? 'selected' : '' }}>Đã hủy</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="control-label" for="date_added">Ngày đặt hàng</label>
                        <input type="date" class="form-control" value="{{ request()->date }}" name="date">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="control-label" for="" style="color: white">Tìm kiếm</label>
                        <button type="submit" class="btn btn-primary bg-primary form-control">Tìm kiếm</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-content">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Mã vận đơn</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
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
                                @if($item->status == 1)
                                <td>Đã xác minh</td>
                                @elseif($item->status == 0)
                                <td><p>Chưa xác minh</p><p class="text-danger">{{ $item->statusVerify }}</p></td>
                                @elseif($item->status == 2)
                                <td>Đang vận chuyển</td>
                                @elseif($item->status == 3)
                                <td>Đã hoàn thành</td>
                                @elseif($item->status == 4)
                                <td>Đã hủy</td>
                                @endif
                                <td>{{ $item->created_at->format('d-m-Y H:i:s') }}</td>
                                <td>{{ $item->updated_at->format('d-m-Y H:i:s') }}</td>
                                <td class="text-center"><a href="{{ route('dashboard.orders.details', $item->tracking_number) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a></td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                    <div class="text-center">
                        {{ $orders->appends(request()->query())->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
