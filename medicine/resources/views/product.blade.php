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
<form action="{{ route('home.post_comment', $product->id) }}" method="POST" role="form">
    @csrf
    <div class="form-group">
        <textarea name="comment" class="form-control" rows="3" placeholder="Nội dung bình luận" style="resize: none;"></textarea>
        @error('comment') <small>{{ $message }}</small> @enderror
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@else
<div class="alert alert-primary" role="alert">
    <strong>Chưa đăng nhập, click vào đây</strong> <a href="{{ route('account.login') }}">Đăng nhập</a><strong> để bình luận</strong>
</div>

@endif
<hr>

@foreach ($comments as $key => $item)

<div class="media">
    <div class="media-body">
        <h4 class="media-heading" style="font-weight: bold">{{ $item->user->fullname }} <small>{{ $item->created_at->format('d/m/Y') }}</small></h4>
        <p>{{ $item->comment }}</p>
        @if (auth()->id() == $item->user_id)
        <p class="text-right">
            <a href="" class="btn btn-primary btn-sm">Edit</a>
            <a href="" class="btn btn-primary btn-sm">Remove</a>
        </p>
        @endif
    </div>
    <hr>
</div>

@endforeach

@stop