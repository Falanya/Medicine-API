<!-- Mainly scripts -->
<script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
<script src="{{ asset('js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('libary/libary.js') }}"></script>

<!-- jQuery UI -->
<script src="{{ asset('js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
@if(isset($config['js']) && is_array($config['js']))
    @foreach($config['js'] as $key => $val)
        <script src="{{ asset($val) }}"></script>
    @endforeach
@endif
