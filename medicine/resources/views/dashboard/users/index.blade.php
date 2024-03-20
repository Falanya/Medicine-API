<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Thành viên</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard.index') }}">Home</a>
            </li>
            <li>
                <a>Quản lý tài khoản</a>
            </li>
            <li class="active">
                <strong>Thành viên</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Danh sách thành viên</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-wrench"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#">Config option 1</a>
                        </li>
                        <li><a href="#">Config option 2</a>
                        </li>
                    </ul>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Thông tin</th>
                            <th>Email</th>
                            <th>Xác minh email</th>
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
                            <td><strong>{{ $item->statusVerify }}</strong></td>
                            <td></td>
                            <td class="text-center"><a class="btn btn-primary"><i class="fas fa-trash"></i></a></td>
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
