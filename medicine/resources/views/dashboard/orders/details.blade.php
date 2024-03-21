<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>
            Đơn hàng {{ $details->tracking_number }}
            @if($details->status == 1)
            <span><small class="text-danger">Đã duyệt</small></span>
            @elseif($details->status == 2)
            <span><small class="text-danger">Đang vận chuyển</small></span>
            @elseif($details->status == 3)
            <span><small class="text-danger">Đã hoàn thành</small></span>
            @elseif($details->status == 4)
            <span><small class="text-danger">Bị hủy</small></span>
            @endif
        </h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard.index') }}">Home</a>
            </li>
            <li>
                <a>Quản lý đơn hàng</a>
            </li>
            <li class="active">
                <strong>Đơn hàng {{ $details->tracking_number }}</strong>
            </li>
        </ol>
    </div>
</div>
<div class="m-t-md">
    <a class="btn btn-primary button-shipping">Vận chuyển</a>
    <a class="btn btn-primary bg-danger button-cancel">Hủy đơn</a>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Border Table </h5>
                </div>
                <div class="ibox-content">

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Username</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Larry</td>
                                <td>the Bird</td>
                                <td>@twitter</td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Hover Table </h5>
                </div>
                <div class="ibox-content">

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Data</th>
                                <th>User</th>
                                <th>Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td><span class="pie">0.52,1.041</span></td>
                                <td>Samantha</td>
                                <td class="text-navy"> <i class="fa fa-level-up"></i> 40% </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td><span class="pie">226,134</span></td>
                                <td>Jacob</td>
                                <td class="text-warning"> <i class="fa fa-level-down"></i> -20% </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td><span class="pie">0.52/1.561</span></td>
                                <td>Damien</td>
                                <td class="text-navy"> <i class="fa fa-level-up"></i> 26% </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>