<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Danh sách sản phẩm</h5>
                <div class="ibox-tools">
                    <a href="{{ route('dashboard.products.create-product') }}" class="btn btn-primary">Tạo sản phẩm</a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <form action="" method="get">
                        <div class="col-sm-3">
                            <select name="status" class="input-m form-control input-s-m inline">
                                <option value="">Trạng thái</option>
                                <option value="show" {{ request()->status == 'show' ? 'selected' : '' }}>Hiện</option>
                                <option value="hidden" {{ request()->status == 'hidden' ? 'selected' : '' }}>Ẩn</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <select name="type_product" class="input-m form-control input-s-m inline">
                                <option value="">Loại sản phẩm</option>
                                @foreach($types as $item)
                                    <option value="{{ $item->slug }}" {{ request()->type_product == $item->slug ? 'selected' : '' }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <select name="object_status" class="input-m form-control input-s-m inline">
                                <option value="">Tình trạng</option>
                                <option value="in-stock" {{ request()->object_status == 'in-stock' ? 'selected' : '' }}>Còn hàng</option>
                                <option value="sold-out" {{ request()->object_status == 'sold-out' ? 'selected' : '' }}>Hết hàng</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
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
                            <td>{{ $item->id }}</td>
                            <td class="text-center">
                                <img src="{{ asset('storage/images/products/'.$item->img) }}" alt="" width="100px" height="100px">
                            </td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->productTypes->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td class="text-center">
                                <label class="switch">
                                    <input type="checkbox" data-product-id="{{ $item->id }}" {{ $item->status == 1 ? 'checked' : '' }}>
                                    <span class="slider round"></span>
                                </label>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('dashboard.products.product-details', $item->id) }}" class="btn btn-primary"><i class="fa fa-folder-open"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    {{ $products->appends(request()->query())->links('pagination::bootstrap-4') }}
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
            var productId = $(this).data('product-id');
            var status = $(this).prop('checked') ? 1 : 0;

            $.ajax({
                url: '/dashboard/products/update-status-product/'+ productId,
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
