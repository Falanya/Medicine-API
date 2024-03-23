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
                            <th>Tên</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($types as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td class="text-center">
                                <a href="{{ route('dashboard.products.edit-product-type', $item->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    {{ $types->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
