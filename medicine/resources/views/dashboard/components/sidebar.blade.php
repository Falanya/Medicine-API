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
                <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">Quản lý sản phẩm</span>
                    <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="{{ route('dashboard.products.list-products') }}">Sản phẩm</a></li>
                    <li><a href="{{ route('dashboard.products.list-types') }}">Loại sản phẩm</a></li>
                </ul>
            </li>
            <li>
                <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">Quản lý đơn hàng</span>
                    <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="{{ route('dashboard.orders.index') }}">Danh sách đơn hàng</a></li>
                </ul>
            </li>
            <li>
                <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">Quản lý voucher</span>
                    <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="{{ route('dashboard.promotions.index') }}">Danh sách voucher</a></li>
                </ul>
            </li>
            <li>
                <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">Chatbox</span>
                    <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="{{ route('dashboard.chats.index') }}">Inbox</a></li>
                </ul>
            </li>
        </ul>

    </div>
</nav>
