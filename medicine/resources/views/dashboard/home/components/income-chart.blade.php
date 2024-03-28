<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Income Chart</h5>
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
                                <canvas id="income-chart"></canvas>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <ul class="stat-list">
                                <li>
                                    <h2 class="no-margins">{{ number_format(end($statistics_income)['total']) }}</h2>
                                    <small><strong>Total orders</strong></small>
                                </li>
                                <hr>
                                <li>
                                    <h2 class="no-margins ">{{ number_format(end($statistics_income)['lastMonthCount']) }}</h2>
                                    <small><strong>Orders in last month</strong></small>

                                </li>
                                <hr>
                                <li>
                                    <h2 class="no-margins ">{{ number_format(end($statistics_income)['total_current']) }}</h2>
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
    var ctx = document.getElementById('income-chart').getContext('2d');
    var usersChart = new Chart(ctx,{
        type:'bar',
        data:{
            labels: {!! json_encode($income_chart['labels']) !!},
            datasets: {!! json_encode($income_chart['datasets']) !!}
        },
    });
</script>
