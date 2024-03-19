<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>History</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('account.index') }}">Home</a>
            </li>
            <li>
                <a>Orders List</a>
            </li>
            <li class="active">
                <strong>History</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Order History</h5>
            </div>
            <div class="ibox-content">

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Total Price</th>
                            <th>Order date</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $key => $item)
                        <tr>
                            <td>{{ $item->tracking_number }}</td>
                            <td>{{ number_format($item->totalPrice) }}</td>
                            <td>{{ $item->created_at->format('d-m-y H:i:s') }}</td>
                            @if($item->status == 0)
                            <td>Not verified</td>
                            @elseif($item->status == 1)
                            <td>Verified</td>
                            @elseif($item->status == 2)
                            <td>Shipping</td>
                            @elseif($item->status == 3)
                            <td>Completed</td>
                            @elseif($item->status == 4)
                            <td>Canceled</td>
                            @endif
                            <td class="text-center"><a href="{{ route('order.details', $item->tracking_number) }}" class="btn btn-primary">See details</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-center" style="font-size: 15px">
                    {{ $orders->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>