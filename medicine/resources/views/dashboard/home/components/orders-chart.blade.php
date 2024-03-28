<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Orders Chart</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <dv class="col-lg-12">
                        <div class="col-lg-9">
                            <div style="width: 900px; margin: auto;">
                                <canvas id="orders-chart"></canvas>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <ul class="stat-list">
                                <li>
                                    <h2 class="no-margins">{{ number_format(end($statistics_orders)['total_orders']) }}</h2>
                                    <small><strong>Total orders</strong></small>
                                </li>
                                <hr>
                                <li>
                                    <h2 class="no-margins ">{{ number_format(end($statistics_orders)['lastMonthCount']) }}</h2>
                                    <small><strong>Orders in last month</strong></small>

                                </li>
                                <hr>
                                <li>
                                    <h2 class="no-margins ">{{ number_format(end($statistics_orders)['count']) }}</h2>
                                    <small><strong>Orders in current month</strong></small>
                                </li>
                            </ul>
                        </div>
                    </dv>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    var ctx = document.getElementById('orders-chart').getContext('2d');
    var usersChart = new Chart(ctx,{
        type:'bar',
        data:{
            labels: {!! json_encode($orders_chart['labels']) !!},
            datasets: {!! json_encode($orders_chart['datasets']) !!}
        },
    });
</script>
