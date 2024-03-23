<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Danh sách sản phẩm</h5>
                <div class="ibox-tools">
                    <a class="btn btn-primary">Tạo sản phẩm</a>
                </div>
            </div>
            <div class="ibox-content">

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Tên</th>
                            <th>Loại</th>
                            <th>Số lượng</th>
                            <th>Trạng thái</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $item)
                        <tr>
                            <td class="text-center">
                                <img src="{{ asset('storage/images/products/'.$item->img) }}" alt="" width="100px" height="100px">
                            </td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->productTypes->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->status == 1 ? 'Show' : 'Hidden' }}</td>
                            <td class="text-center">
                                <a href="{{ route('dashboard.products.product-details', $item->id) }}" class="btn btn-primary"><i class="fa fa-folder-open"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    {{ $products->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
