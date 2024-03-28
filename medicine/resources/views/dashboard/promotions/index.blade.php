<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Danh sách voucher</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">Home</a>
            </li>
            <li>
                <a>Quản lý voucher</a>
            </li>
            <li class="active">
                <strong>Danh sách voucher</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox-content m-b-sm border-bottom">
        <form action="" method="get">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="control-label" for="order_id">Code voucher</label>
                        <input type="text" name="code" value="{{ request()->code }}" placeholder="Code"
                            class="form-control">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="control-label" for="status">Tên voucher</label>
                        <input type="text" name="name" value="{{ request()->name }}" placeholder="Tên voucher"
                            class="form-control">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="control-label" for="customer">Loại</label>
                        <select name="type" id="input" class="form-control">
                            <option value="">Chọn loại</option>
                            <option value="fixed" {{ request()->type == 'fixed' ? 'selected' : '' }}>Fixed</option>
                            <option value="percent" {{ request()->type == 'percent' ? 'selected' : '' }}>Percent</option>
                        </select>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="control-label" for="date_added">Ngày bắt đầu</label>
                        <input type="date" name="starts_at" class="form-control" value="{{ request()->starts_at }}">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="control-label" for="date_modified">Ngày hết hạn</label>
                        <input type="date" name="expires_at" class="form-control" value="{{ request()->expires_at }}">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="control-label" for="amount">Trạng thái</label>
                        <select name="status" id="input" class="form-control">
                            <option value="">Chọn trạng thái</option>
                            <option value="hidden" {{ request()->status == 'hidden' ? 'selected' : '' }}>Ẩn</option>
                            <option value="show" {{ request()->status == 'show' ? 'selected' : ''}}>Hiện</option>
                            <option value="expired" {{ request()->status == 'expired' ? 'selected' : ''}}>Hết hạn</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="control-label" for="amount">Số tiền giảm</label>
                        <select name="discount_amount" id="input" class="form-control">
                            <option value="">Chọn mức tiền</option>
                            <option value="0_100000" {{ request()->discount_amount == '0_100000' ? 'selected' : '' }}>0 - 100,000</option>
                            <option value="100000_500000" {{ request()->discount_amount == '100000_500000' ? 'selected' : '' }}>100,000 - 500,000</option>
                            <option value="500000_1000000" {{ request()->discount_amount == '500000_1000000' ? 'selected' : '' }}>500,000 - 1,000,000</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="control-label" for="amount">Số tiền tối thiểu để giảm</label>
                        <select name="min_amount" id="input" class="form-control">
                            <option value="">Chọn mức tiền</option>
                            <option value="0_100000" {{ request()->min_amount == '0_100000' ? 'selected' : '' }}>0 - 100,000</option>
                            <option value="100000_500000" {{ request()->min_amount == '100000_500000' ? 'selected' : '' }}>100,000 - 500,000</option>
                            <option value="500000_1000000" {{ request()->min_amount == '500000_1000000' ? 'selected' : '' }}>500,000 - 1,000,000</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="control-label" for="amount" style="color: white">Tìm kiếm</label>
                        <button type="submit" class="btn btn-primary bg-primary form-control">Tìm kiếm</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Danh sách voucher</h5>
                    <div class="ibox-tools">
                        <a href="{{ route('dashboard.promotions.create') }}" class="btn btn-primary bg-primary">Tạo voucher mới</a>
                    </div>
                </div>
                <div class="ibox-content">

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Số tiền giảm</th>
                                <th>Số tiền tối thiểu</th>
                                <th>Loại</th>
                                <th>Trạng thái</th>
                                <th>Ngày bắt đầu</th>
                                <th>Ngày hết hạn</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($promotions as $item)
                                <tr>
                                    <td>{{ $item->code }}</td>
                                    <td>{{ $item->name }}</td>
                                    @if($item->type == 'percent')
                                    <td>{{ $item->discount_amount }}%</td>
                                    @elseif($item->type == 'fixed')
                                    <td>{{ number_format($item->discount_amount) }}</td>
                                    @endif
                                    <td>{{ number_format($item->min_amount) }}</td>
                                    <td>{{ $item->type }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>{{ $item->starts_at }}</td>
                                    <td>{{ $item->expires_at }}</td>
                                    <td class="text-center"><a class="btn btn-primary bg-primary" href="{{ route('dashboard.promotions.edit', $item->id) }}"><i class="fa fa-edit"></i></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                        {{ $promotions->appends(request()->query())->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
