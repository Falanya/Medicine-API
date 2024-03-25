<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Danh sách thành viên</h5>
                <div class="ibox-tools">
                    <a href="{{ route('dashboard.users.create') }}" class="btn btn-primary">Tạo tài khoản nhân viên</a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <form action="" method="get">
                        <div class="col-sm-3">
                            <select name="status" class="input-m form-control input-s-m inline">
                                <option value="">Trạng thái</option>
                                <option value="active" {{ request()->status == 'active' ? 'selected' : '' }}>Còn hoạt động</option>
                                <option value="locked" {{ request()->status == 'locked' ? 'selected' : '' }}>Bị khóa</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <select name="email_verify" class="input-m form-control input-s-m inline">
                                <option value="">Kích hoạt</option>
                                <option value="verified" {{ request()->email_verify == 'verified' ? 'selected' : '' }}>Đã kích hoạt</option>
                                <option value="not-verified" {{ request()->email_verify == 'not-verified' ? 'selected' : '' }}>Chưa kích hoạt</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <select name="role_id" class="input-m form-control input-s-m inline">
                                <option value="">Phân quyền</option>
                                <option value="member" {{ request()->role_id == 'member' ? 'selected' : '' }}>Member</option>
                                <option value="staff" {{ request()->role_id == 'staff' ? 'selected' : '' }}>Nhân viên</option>
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
                            <th class="text-center">ID</th>
                            <th class="text-center">Thông tin</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Trạng thái</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $key => $item)
                        <tr>
                            <td class="text-center">{{ $item->id }}</td>
                            <td>
                                <p><strong>Fullname:</strong> {{ $item->fullname }}</p>
                                <p><strong>Giới tính:</strong> {{ $item->gender == 1 ? 'Nam' : 'Nữ' }}</p>
                                <p><strong>Phone:</strong> {{ $item->phone }}</p>
                                <p><strong>Ngày sinh:</strong> {{ $item->birthday }}
                            </td>
                            <td>
                                <p>{{ $item->email }}</p>
                                @if($item->email_verified_at == null)
                                    <small class="text-danger">{{ $item->statusVerify }}</small>
                                @endif
                            </td>
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
                    {{ $users->appends(request()->query())->links('pagination::bootstrap-4') }}
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
                url: '/dashboard/users/update-status/' + userId,
                method: 'PUT',
                data: {
                    _token: '{{ csrf_token() }}',
                    status: status
                },
                success: function(response) {
                    // Xử lý khi cập nhật thành công, nếu cần
                    console.log(response);
                    // Hiển thị thông báo với icon tương ứng
                    var icon = response.success ? 'success' : 'error';
                    Swal.fire({
                        toast: true,
                        icon: icon,
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
