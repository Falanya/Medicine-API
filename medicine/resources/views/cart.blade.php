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
                        <input type="number" min="1" value="{{ $item->quantity }}" name="quantities[{{ $item->id }}]" class="quantity-input" style="width: 50px; text-align: center">
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
        <button type="button" class="btn btn-primary" id="saveQuantitiesBtn">Save Quantities</button>
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Bắt sự kiện khi nút "Save Quantities" được nhấn
        document.getElementById('saveQuantitiesBtn').addEventListener('click', function () {
            // Tạo một object để lưu trữ số lượng sản phẩm mới
            var quantities = {};

            // Lặp qua mỗi input và lưu số lượng vào object
            var quantityInputs = document.querySelectorAll('.quantity-input');
            quantityInputs.forEach(function (input) {
                var productId = input.getAttribute('name').match(/\d+/)[0];
                quantities[productId] = input.value;
            });

            // Gửi yêu cầu Ajax
            fetch('{{ url('/cart/save-quantities') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ quantities: quantities })
            })
            .then(response => {
                if (response.ok) {
                    // Xử lý phản hồi thành công
                    Toastify({
                        text: 'Quantities updated successfully',
                        duration: 3000, // Thời gian hiển thị thông báo (đơn vị: miligiây)
                        gravity: 'top', // Vị trí hiển thị của thông báo
                        style: {
                            background: 'linear-gradient(to right, #00b09b, #96c93d)', // Màu nền của thông báo
                        }
                    }).showToast();
                    // Cập nhật giao diện nếu cần
                } else {
                    // Xử lý phản hồi lỗi
                    Toastify({
                        text: 'Failed to update quantities',
                        duration: 3000,
                        gravity: 'top',
                        style: {
                            background: '#ff6347',
                        }
                    }).showToast();
                }
            })
            .catch(error => {
                // Xử lý lỗi khi gửi yêu cầu
                Toastify({
                    text: 'An error occurred',
                    duration: 3000,
                    gravity: 'top',
                    style: {
                        background: '#ff6347',
                    }
                }).showToast();
                console.error('An error occurred:', error);
            });
        });
    });
</script>

@stop
