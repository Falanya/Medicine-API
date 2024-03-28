<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Users Chart</h5>
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
                                <canvas id="users-chart"></canvas>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <ul class="stat-list">
                                <li>
                                    <h2 class="no-margins">{{ number_format(end($statistics_users)['total']) }}</h2>
                                    <small><strong>Total users</strong></small>
                                </li>
                                <hr>
                                <li>
                                    <h2 class="no-margins ">{{ number_format(end($statistics_users)['lastMonthCount']) }}</h2>
                                    <small><strong>Users in last month</strong></small>

                                </li>
                                <hr>
                                <li>
                                    <h2 class="no-margins ">{{ number_format(end($statistics_users)['count']) }}</h2>
                                    <small><strong>Users in current month</strong></small>
                                </li>
                            </ul>
                        </div>
                    </dv>
                </div>
            </div>
        </div>
    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1/dist/chart.umd.min.js"></script>
<script>
    var ctx = document.getElementById('users-chart').getContext('2d');
    var usersChart = new Chart(ctx,{
        type:'bar',
        data:{
            labels: {!! json_encode($users_chart['labels']) !!},
            datasets: {!! json_encode($users_chart['datasets']) !!}
        },
    });
</script>
