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

@include('dashboard.users.components.table')

