<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Danh sách loại sản phẩm</h5>
                <div class="ibox-tools">
                    <a href="{{ route('dashboard.products.create-product-type') }}" class="btn btn-primary">Tạo loại sản phẩm</a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <form action="" method="get">
                        <div class="col-sm-4">
                            <select name="object_status" class="input-m form-control input-s-m inline">
                                <option value="">Trạng thái</option>
                                <option value="show" {{ request()->object_status == 'show' ? 'selected' : '' }}>Hiện</option>
                                <option value="hidden" {{ request()->object_status == 'hidden' ? 'selected' : '' }}>Ẩn</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <select name="status" class="input-m form-control input-s-m inline">
                                <option value="">Tình trạng</option>
                                <option value="in-stock" {{ request()->status == 'in-stock' ? 'selected' : '' }}>Có sản phẩm</option>
                                <option value="sold-out" {{ request()->status == 'sold-out' ? 'selected' : '' }}>không có sản phẩm</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <div class="input-group">
                                <input name="keywords" type="search" placeholder="Từ khóa tìm kiếm" class="input-m form-control" value="{{ request()->keywords }}">
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Số sản phẩm thuộc loại</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($types as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->countProducts }}</td>
                            <td class="text-center">
                                <label class="switch">
                                    <input type="checkbox" data-type-id="{{ $item->id }}" {{ $item->object_status == 1 ? 'checked' : '' }}>
                                    <span class="slider round"></span>
                                </label>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('dashboard.products.edit-product-type', $item->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    {{ $types->appends(request()->query())->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('input[type="checkbox"]').on('change', function() {
            var typeId = $(this).data('type-id');
            var status = $(this).prop('checked') ? 1 : 0;

            $.ajax({
                url: '/dashboard/products/update-status-type/'+ typeId,
                method: 'PUT',
                data: {
                    _token: '{{ csrf_token() }}',
                    status: status
                },
                success: function(response) {
                    // Xử lý khi cập nhật thành công, nếu cần
                    console.log(response);
                    // Hiển thị thông báo thành công
                    Swal.fire({
                        toast: true,
                        icon: 'success',
                        title: response.message,
                        animation: true,
                        position: 'top-right',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer);
                            toast.addEventListener('mouseleave', Swal.resumeTimer);
                        }
                    });
                },
                error: function(xhr) {
                    // Xử lý khi có lỗi xảy ra, nếu cần
                    console.log(xhr.responseText);
                    // Hiển thị thông báo lỗi
                    Swal.fire({
                        toast: true,
                        icon: 'error',
                        title: xhr.responseText,
                        animation: true,
                        position: 'top-right',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer);
                            toast.addEventListener('mouseleave', Swal.resumeTimer);
                        }
                    });
                }
            });
        });
    });
</script>
