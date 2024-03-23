<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Chi tiết sản phẩm</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">Home</a>
            </li>
            <li>
                <a>Quản lý sản phẩm</a>
            </li>
            <li class="active">
                <strong>{{ $details->name }}</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox product-detail">
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="product-images">
                                <div>
                                    {{-- <div class="image-imitation">
                                        [IMAGE 1]
                                    </div> --}}
                                    <img src="{{ asset('storage/images/products/'.$details->img) }}" alt="" width="418px" height="438px">
                                </div>
                                @if($details->img_details->count() > 0)
                                    @foreach($details->img_details as $item)
                                        <div>
                                            <img src="{{ asset('storage/images/products/'.$item->img) }}" alt="" width="418px" height="438px">
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                        </div>
                        <div class="col-md-7">

                            <h2 class="font-bold m-b-xs">
                                {{ $details->name }}
                            </h2>
                            <div class="m-t-md">
                                <h2 class="product-main-price">Giá gốc: {{ number_format($details->price) }}</h2>
                                <h2 class="product-main-price">Giá giảm: {{ number_format($details->discount) }}</h2>
                            </div>
                            <hr>

                            <dl class="m-t-md">
                                <dt>Số lượng</dt>
                                {{ $details->quantity }}
                            </dl>

                            <h4>Thông tin sản phẩm</h4>

                            <div class="text-muted">
                                {{ $details->info }}
                            </div>
                            <dl class="m-t-md">
                                <dt>Mô tả</dt>
                                {{ $details->describe }}
                            </dl>
                            <dl class="m-t-md">
                                <dt>Trạng thái</dt>
                                {{ $details->status == 1 ? 'Hiện' : 'Ẩn' }}
                            </dl>
                            <hr>

                            <div>
                                <div class="btn-group">
                                    <a href="{{ route('dashboard.products.edit-product', $details->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></i>
                                        Sửa thông tin</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
