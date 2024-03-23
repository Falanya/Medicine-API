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
                    {{ $products->links('pagination::bootstrap-4') }}
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
