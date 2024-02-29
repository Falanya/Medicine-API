@extends('main')

@section('main')

<h2>Order checkout</h2>
<div class="container">

    <div class="row">
        <div class="col-md-5">
            <div class="panel panel-info">
                <div class="panel-body">
                    <form action="" method="POST" role="form">
                        @csrf
                        <legend>Your Info</legend>

                        <div class="form-group select-wrap">
                            <label for="">Address</label>
                            <select name="address_id" id="input" class="form-control" required="required">
                                @foreach ($address as $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->receiver_name }}-{{ $item->phone }}-{{ $item->address }}
                                </option>
                                @endforeach
                            </select>
                            @error('address') <small> {{ $message }} </small> @enderror
                        </div>

                        <hr>

                        <div class="form-group">
                            <label for="textarea" class="control-label">Note</label>
                            <textarea name="note" id="textarea" class="form-control" rows="3"></textarea>
                            @error('note') <small> {{ $message }} </small> @enderror
                        </div>

                        <button type="submit" onclick="return confirm('Would you like to confirm this order?')"
                            class="btn btn-sm btn-primary">Cofirm your order</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <table class="table table-hover">
                <thead>
                    <tr>
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
                        $totalAmount += $price*$item->quantity;
                    @endphp
                    <tr>
                        <td>
                            <img src="{{ asset('storage/images/products/' . $item->product->img) }}" alt="" width="100">
                        </td>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ number_format($price) }}</td>
                        <td>
                            {{ $item->quantity }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <h3>Total Price: {{ number_format($totalAmount) }}</h3>
        </div>
    </div>
</div>

</div>


@stop