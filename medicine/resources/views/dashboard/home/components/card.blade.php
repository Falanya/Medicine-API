<div class="row">
    <div class="col-lg-3">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                @if(end($statistics_income)['status'] == 'increase')
                <span class="label label-into pull-right">Monthly</span>
                @else
                <span class="label label-danger pull-right">Monthly</span>
                @endif
                <h5>Income</h5>
            </div>
            <div class="ibox-content">
                <h1 class="no-margins">{{ number_format(end($statistics_income)['total']) }}</h1>
                @if(end($statistics_income)['status'] == 'increase')
                <div class="stat-percent font-bold text-info">{{ end($statistics_income)['percent'] }}<i
                        class="fas fa-level-up-alt"></i></div>
                @elseif(end($statistics_income)['status'] == 'decrease')
                <div class="stat-percent font-bold text-danger">{{ end($statistics_income)['percent'] }}<i
                        class="fas fa-level-down-alt"></i></div>
                @endif
                <small>Total income</small>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                @if(end($statistics_orders)['status'] == 'increase')
                <span class="label label-success pull-right">Monthly</span>
                @elseif(end($statistics_orders)['status'] == 'decrease')
                <span class="label label-danger pull-right">Monthly</span>
                @endif
                <h5>Orders</h5>
            </div>
            <div class="ibox-content">
                <h1 class="no-margins">{{ number_format(end($statistics_orders)['total_orders']) }}</h1>
                @if(end($statistics_orders)['status'] == 'increase')
                <div class="stat-percent font-bold text-info">{{ end($statistics_orders)['percent'] }}<i
                        class="fas fa-level-up-alt"></i></div>
                @elseif(end($statistics_orders)['status'] == 'decrease')
                <div class="stat-percent font-bold text-danger">{{ end($statistics_orders)['percent'] }}<i
                        class="fas fa-level-down-alt"></i></div>
                @endif
                <small>Total orders</small>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                @if(end($statistics_users)['status'] == 'increase')
                <span class="label label-success pull-right">Monthly</span>
                @else
                <span class="label label-danger pull-right">Monthly</span>
                @endif
                <h5>Users</h5>
            </div>
            <div class="ibox-content">
                <h1 class="no-margins">{{ number_format(end($statistics_users)['total']) }}</h1>
                @if(end($statistics_users)['status'] == 'increase')
                <div class="stat-percent font-bold text-info">{{ end($statistics_users)['percent'] }}<i
                        class="fas fa-level-up-alt"></i></i>
                </div>
                @else
                <div class="stat-percent font-bold text-danger">{{ end($statistics_users)['percent'] }}<i
                        class="fas fa-level-down-alt"></i></i>
                </div>
                @endif
                <small>Total users</small>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <span class="label label-primary pull-right">Unknown</span>
                <h5>Unknown</h5>
            </div>
            <div class="ibox-content">
                <h1 class="no-margins">Unknown</h1>
                <div class="stat-percent font-bold text-navy">Unknown<i class="fas fa-level-up-alt"></i></i></div>
                <small>Unknown</small>
            </div>
        </div>
    </div>
</div>
