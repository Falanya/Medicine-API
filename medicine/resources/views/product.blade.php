@extends('main')

@section('main')


<div class="row">
    
    <div class="col-md-6">
        <img src="{{asset('storage/images/products/' . $product->img) }}" alt="" style="width:100%">
    </div>

    <div class="col-md-6">
        <div class="caption">
            <h3>{{ $product->name }}</h3>
            <p style="color: blue">
                Price: {{ $product->price }} đ
            </p>
            <h4 style="font-weight: 700">Info:</h4>
            <p>{{ $product->info }}</p>
            <h4 style="font-weight: 700">Describe:</h4>
            <p>{{ $product->describe }}</p>
            <p>
                <a href="{{ route('cart.add', $product->id) }}" class="btn btn-success btn-xx">Add cart</a>
            </p>
        </div>
    </div>
</div>
<hr>
<h3>Comments</h3>

@if (auth()->check())
<form action="" method="POST" role="form">
    <div class="form-group">
        <textarea name="comment" class="form-control" rows="3" placeholder="Nội dung bình luận"></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@else
<div class="alert alert-primary" role="alert">
    <strong>Chưa đăng nhập, click vào đây</strong> <a href="{{ route('account.login') }}">Đăng nhập</a><strong> để bình luận</strong>
</div>

@endif
<hr>

<div class="media">
    <a class="pull-left" href="#">
        <img width="50" class="media-object" src="#" alt="Image">
    </a>
    <div class="media-body">
        <h4 class="media-heading">Nguyễn Văn A</h4>
        <p>Text goes here...</p>
        <p>
            <a href="" class="btn btn-primary btn-sm">Sửa</a>
            <a href="" class="btn btn-primary btn-sm">Xóa</a>
        </p>
    </div>
</div>

<div class="media">
    <a class="pull-left" href="#">
        <img width="50" class="media-object" src="#" alt="Image">
    </a>
    <div class="media-body">
        <h4 class="media-heading">Nguyễn Văn A</h4>
        <p>Text goes here...</p>
        <p>
            <a href="" class="btn btn-primary btn-sm">Sửa</a>
            <a href="" class="btn btn-primary btn-sm">Xóa</a>
        </p>
    </div>
</div>


@stop