<h3>Hi: {{ $order->address->receiver_name }}</h3>

<h4>Your order detail</h4>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>STT</th>
        <th>Product name</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>SubTotal</th>
    </tr>
    <?php $total = 0 ?>
    @foreach($order->details as $detail)
    <tr>
        <th>{{ $loop->index + 1 }}</th>
        <th>{{ $detail->product->name }}</th>
        <th>{{ $detail->price }}</th>
        <th>{{ $detail->quantity }}</th>
        <th>{{ number_format($detail->price * $detail->quantity) }}</th>
    </tr>
    <?php $total += $detail->price * $detail->quantity ?>
    @endforeach
    <tr>
        <th colspan="4">Total price:</th>
        <th>{{ number_format($total) }}</th>
    </tr>

</table>

<p>
    <a href="{{ route('order.verify', $token) }}">Click here to verify your order!!!</a>
</p>