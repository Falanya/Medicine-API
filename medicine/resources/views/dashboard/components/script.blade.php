<!-- Mainly scripts -->
<script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
<script src="{{ asset('js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

<!-- Flot -->
<script src="{{ asset('js/plugins/flot/jquery.flot.js') }}"></script>
<script src="{{ asset('js/plugins/flot/jquery.flot.tooltip.min.js') }}"></script>
<script src="{{ asset('js/plugins/flot/jquery.flot.spline.js') }}"></script>
<script src="{{ asset('js/plugins/flot/jquery.flot.resize.js') }}"></script>
<script src="{{ asset('js/plugins/flot/jquery.flot.pie.js') }}"></script>
<script src="{{ asset('js/plugins/flot/jquery.flot.symbol.js') }}"></script>
<script src="{{ asset('js/plugins/flot/jquery.flot.time.js') }}"></script>

<!-- Peity -->
<script src="{{ asset('js/plugins/peity/jquery.peity.min.js') }}"></script>
<script src="{{ asset('js/demo/peity-demo.js') }}"></script>

<!-- Custom and plugin javascript -->
<script src="{{ asset('js/inspinia.js') }}"></script>
<script src="{{ asset('js/plugins/pace/pace.min.js') }}"></script>

<!-- jQuery UI -->
<script src="{{ asset('js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

<!-- Jvectormap -->
<script src="{{ asset('js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
<script src="{{ asset('js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>

<!-- EayPIE -->
<script src="{{ asset('js/plugins/easypiechart/jquery.easypiechart.js') }}"></script>

<!-- Sparkline -->
<script src="{{ asset('js/plugins/sparkline/jquery.sparkline.min.js') }}"></script>

<!-- Sparkline demo data  -->
<script src="{{ asset('js/demo/sparkline-demo.js') }}"></script>

<!-- Sweet alert -->
<script src="{{ asset('js/plugins/sweetalert/sweetalert.min.js') }}"></script>

<!-- slick carousel-->
<script src="{{ asset('js/plugins/slick/slick.min.js') }}"></script>



{{-- <script>
    var ctx = document.getElementById('users-chart').getContext('2d');
    var usersChart = new Chart(ctx,{
        type:'bar',
        data:{
            labels: {!! json_encode($labels) !!},
            datasets: {!! json_encode($datasets) !!}
        },
    });
</script> --}}

{{-- <script>
    var ctx = document.getElementById('users-chart').getContext('2d');
    var usersChart = new Chart(ctx,{
        type:'bar',
        data:{
            labels: {!! json_encode($users_chart['labels']) !!},
            datasets: {!! json_encode($users_chart['datasets']) !!}
        },
    });

    var ctx = document.getElementById('orders-chart').getContext('2d');
    var usersChart = new Chart(ctx,{
        type:'bar',
        data:{
            labels: {!! json_encode($orders_chart['labels']) !!},
            datasets: {!! json_encode($orders_chart['datasets']) !!}
        },
    });

    var ctx = document.getElementById('income-chart').getContext('2d');
    var usersChart = new Chart(ctx,{
        type:'bar',
        data:{
            labels: {!! json_encode($income_chart['labels']) !!},
            datasets: {!! json_encode($income_chart['datasets']) !!}
        },
    });
</script> --}}












<script>
    $(document).ready(function () {
        $('.product-images').slick({
            dots: true
        });
    });

</script>

<!-- SUMMERNOTE -->
<script src="{{ asset('js/plugins/summernote/summernote.min.js') }}"></script>

<!-- Data picker -->
<script src="{{ asset('js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>

<script>
    $(document).ready(function () {

        $('.summernote').summernote();

        $('.input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });

    });
</script>


