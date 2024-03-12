@include('dashboard.user.components.breadcrumb', ['title' => $config['seo']['index']['title']])
<div class="row mt20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>{{ $config['seo']['index']['table'] }}</h5>
                @include('dashboard.user.components.toolbox')
            </div>
            <div class="ibox-content">
                @include('dashboard.user.components.filter')
                @include('dashboard.user.components.table')
            </div>
        </div>
    </div>
</div>