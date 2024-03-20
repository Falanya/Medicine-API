<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> 
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> 
                            <span class="block m-t-xs"> 
                                <strong class="font-bold">{{ $auth->fullname }}</strong>
                            </span> 
                        </span> 
                    </a>
                </div>
                
            </li>
            <li>
                <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span>
                    <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="{{ route('dashboard.index') }}">Home</a></li>
                </ul>
            </li>
            <li>
                <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">Quản lý tài khoản</span>
                    <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="{{ route('dashboard.users.index') }}">Thành viên</a></li>
                    <li><a href="#">Nhóm thành viên</a></li>
                </ul>
            </li>
            <li>
                <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">Quản lý đơn hàng</span>
                    <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="{{ route('dashboard.orders.index') }}">Đã xác minh</a></li>
                    <li><a href="{{ route('dashboard.orders.index', ['status' => 2]) }}">Đang vận chuyển</a></li>
                    <li><a href="{{ route('dashboard.orders.index', ['status' => 3]) }}">Đã hoàn thành</a></li>
                    <li><a href="{{ route('dashboard.orders.index', ['status' => 4]) }}">Đã hủy</a></li>
                </ul>
            </li>
        </ul>

    </div>
</nav>