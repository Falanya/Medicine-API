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
    <?php
        $price = $pro->discount > 0 && $pro->discount < $pro->price ? $pro->discount : $pro->price
    ?>
    <div class="col-md-4 col-lg-4">
        <div class="thumbnail">
            <img src="{{ asset('storage/images/products/' . $pro->img) }}" alt="" width="300px" height="300px">
            <div class="caption text-center">
                <h4 class="ellipsis">{{ $pro->name }}</h4>
                <p style="color: blue">
                    Price: {{ number_format($price) }} đ
                </p>
                <p>
                    <a href="{{ route('home.product', $pro->id) }}" class="btn btn-success btn-xs">See detail</a>
                    <a onclick="AddCart({{$pro->id}})" href="javascript:" class="btn btn-success btn-xs">Add cart</a>
                </p>
            </div>
        </div>
    </div>
    @endforeach

    <script>
        function AddCart(id) {
            $.ajax({
                url: '/cart/add/'+id,
                type: 'GET',
            }).done(function(response) {
                console.log(response);
                // $("#change-quantity-cart").empty();
                // $("#change-quantity-cart").html(response);
                alertify.success('Add product to cart successfully!!!');
            });
        }
    </script>
</div>
{{
    $pros->links('pagination::bootstrap-4')
}}

@stop