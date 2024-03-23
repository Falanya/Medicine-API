<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Danh sách thành viên</h5>
                <div class="ibox-tools">
                    <a href="{{ route('dashboard.users.create') }}" class="btn btn-primary btn-m">Tạo thành viên quản trị</a>
                </div>
            </div>
            <div class="ibox-content">

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Thông tin</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $key => $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>
                                <p><strong>Fullname:</strong> {{ $item->fullname }}</p>
                                <p><strong>Giới tính:</strong> {{ $item->gender == 1 ? 'Nam' : 'Nữ' }}</p>
                                <p><strong>Phone:</strong> {{ $item->phone }}</p>
                                <p><strong>Ngày sinh:</strong> {{ $item->birthday }}
                            </td>
                            <td>{{ $item->email }}</td>
                            <td class="text-center">
                                <label class="switch">
                                    <input type="checkbox" data-user-id="{{ $item->id }}" {{ $item->status == 1 ? 'checked' : '' }}>
                                    <span class="slider round"></span>
                                </label>
                            </td>
                            <td class="text-center"><a href="{{ route('dashboard.users.delete', $item->id) }}" class="btn btn-primary"><i class="fas fa-trash"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-center" style="font-size: 15px">
                    {{ $users->links('pagination::bootstrap-4') }}
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
            var userId = $(this).data('user-id');
            var status = $(this).prop('checked') ? 1 : 0;

            $.ajax({
                url: '/dashboard/users/update-status/'+ userId,
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
