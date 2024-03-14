@extends('main')

@section('main')

<h2 style="font-weight: 700">My Cart</h2>
<div class="container">
    <div class="col-md-4 col-lg-8">
        @if($count_cart > 0)
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalAmount = 0;
                @endphp
                @foreach ($carts as $item)
                @php
                    $price = $item->product->discount > 0 && $item->product->discount < $item->product->price ? $item->product->discount : $item->product->price;
                    $totalAmount += $price * $item->quantity;
                @endphp
                <tr>
                    <td scope="row">{{ $loop->index + 1 }}</td>
                    <td>
                        <img src="{{ asset('storage/images/products/' . $item->product->img) }}" alt="" width="100">
                    </td>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $price }}</td>
                    <td>
                        <form action="{{ route('cart.update', $item->product->id) }}" method="GET">
                            <input type="number" min="1" value="{{ $item->quantity }}" name="quantity" style="width: 50px; text-align: center">
                            <button><i class="fa fa-save"></i></button>
                        </form>
                    </td>
                    <td>
                        
                        <form action="{{ route('cart.delete', $item->product_id) }}" method="POST" role="form">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-primary" onclick="return confirm('Do you want to remove this product from your cart?')"><i class="fas fa-trash"></i></button>
                        </form>
                        
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div>
            <h3>Total amount: {{ number_format($totalAmount) }}</h3>
            
            <form action="{{ route('cart.clear') }}" method="POST" role="form">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-sm btn-primary" onclick="return confirm('Do you want to remove all products from your cart?')">Delete All</button>
                <a href="{{ route('order.checkout') }}" id="edit_productType" class="btn btn-sm btn-primary">Proceed to Order</a>
            </form>
            
        </div>
        @else
        <h1>Your cart hasn't products, please add products</h1>
        @endif
    </div>
</div>


@stop