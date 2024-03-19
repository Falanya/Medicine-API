<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> 
                    
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{ $auth->fullname }}</strong></span></span>
                    </a>
                    
                </div>
            </li>
            <li>
                <a><i class="fa fa-th-large"></i> <span class="nav-label">Information</span>
                    <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="{{ route('account.index') }}">Account Information</a></li>
                    <li><a href="{{ route('account.setting') }}">Account Settings</a></li>
                    <li><a href="#"> Login Devices</a></li>
                </ul>
            </li>

            <li>
                <a><i class="fa fa-th-large"></i> <span class="nav-label">Orders List</span>
                    <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="{{ route('order.index') }}">History</a></li>
                </ul>
            </li>
            
            <li>
                <a><i class="fa fa-th-large"></i> <span class="nav-label">MailBox</span>
                    <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="{{ route('account.index') }}">Compose email</a></li>
                    <li><a href="{{ route('account.index') }}">Inbox</a></li>
                </ul>
            </li>
        </ul>

    </div>
</nav>