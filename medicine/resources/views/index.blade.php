@extends('main')

@section('main')

<style>
    .ellipsis {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>


<div class="row">
    @foreach ($pros as $pro)
    <div class="col-md-4 col-lg-4">
        <div class="thumbnail">
            <img src="{{ asset('storage/images/products/' . $pro->img) }}" alt="" width="300px" height="300px">
            <div class="caption text-center">
                <h4 class="ellipsis">{{ $pro->name }}</h4>
                <p style="color: blue">
                    Price: {{ $pro->price }} đ
                </p>
                <p>
                    <a href="{{ route('home.product', $pro->id) }}" class="btn btn-success btn-xs">See detail</a>
                    <a href="{{ route('cart.add', $pro->id) }}" class="btn btn-success btn-xs">Add cart</a>
                </p>
            </div>
        </div>
    </div>
    @endforeach
</div>


@stop