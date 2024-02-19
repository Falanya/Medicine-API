@extends('admin.admin')

@section('main')

<div class="container">

    <table class="table table-hover">
        <thead>
            <tr>
                <th>Loại API</th>
                <th>Tên API</th>
                <th>Link API</th>
                <th>Trạng thái</th>
            </tr>
        </thead>
        <tbody>
            {{-- Người dùng --}}
            <tr>
                <td rowspan="14">
                    <h2>Users</h2>
                </td>
                <td>Đăng ký (POST)</td>
                <td>/api/users/register</td>
                <td>OK</td>
            </tr>

            <tr>
                <td>Xác nhận email khi đăng kí (GET)</td>
                <td>/api/users/verify-account/{email}</td>
                <td>OK</td>
            </tr>

            <tr>
                <td>Đăng nhập (POST)</td>
                <td>/api/users/login</td>
                <td>OK</td>
            </tr>

            <tr>
                <td>Đăng xuất (POST)</td>
                <td>/api/users/logout</td>
                <td>OK</td>
            </tr>

            <tr>
                <td>Xóa tất cả tokens (POST)</td>
                <td>/api/users/delete-all-tokens</td>
                <td>OK</td>
            </tr>

            <tr>
                <td>Hiển thị thông tin (GET)</td>
                <td>/api/users/profile</td>
                <td>OK</td>
            </tr>

            <tr>
                <td>Thay đổi thông tin (PUT)</td>
                <td>/api/users/change-profile</td>
                <td>OK</td>
            </tr>

            <tr>
                <td>Hiển thị địa chỉ (GET)</td>
                <td>/api/users/address</td>
                <td>OK</td>
            </tr>

            <tr>
                <td>Thêm mới địa chỉ (POST)</td>
                <td>/api/users/address</td>
                <td>OK</td>
            </tr>

            <tr>
                <td>Sửa địa chỉ (PUT)</td>
                <td>/api/users/edit-address/{id}</td>
                <td>OK</td>
            </tr>

            <tr>
                <td>Xóa 1 địa chỉ (POST)</td>
                <td>/api/users/delete-address/{id}</td>
                <td>OK</td>
            </tr>

            <tr>
                <td>Xóa tất cả địa chỉ (POST)</td>
                <td>/api/users/delete-all-address</td>
                <td>OK</td>
            </tr>

            <tr>
                <td>Quên mật khẩu (?)</td>
                <td>/api/users/....</td>
                <td>Unknown</td>
            </tr>

            <tr>
                <td>Reset password (?)</td>
                <td>/api/users/....</td>
                <td>Unknown</td>
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            {{-- Giỏ hàng --}}
            <tr>
                <td rowspan="6">
                    <h2>Cart</h2>
                </td>
                <td>Hiển thị giỏ hàng (GET)</td>
                <td>/api/carts/cart</td>
                <td>OK</td>
            </tr>

            <tr>
                <td>Thêm sản phẩm vào giỏ hàng (GET)</td>
                <td>/api/carts/add/{id}</td>
                <td>OK</td>
            </tr>

            <tr>
                <td>Thêm 1 sản phẩm trong giỏ hàng (GET)</td>
                <td>/api/carts/plus-1/{id}</td>
                <td>OK</td>
            </tr>

            <tr>
                <td>Trừ 1 sản phẩm trong giỏ hàng (GET)</td>
                <td>/api/carts/minus-1/{id}</td>
                <td>OK</td>
            </tr>

            <tr>
                <td>Xóa 1 sản phẩm trong giỏ hàng (GET)</td>
                <td>/api/carts/delete/{id}</td>
                <td>OK</td>
            </tr>

            <tr>
                <td>Xóa tất cả sản phẩm trong giỏ hàng (GET)</td>
                <td>/api/carts/clear</td>
                <td>OK</td>
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            {{-- Đặt hàng và quản lý đơn hàng của người dùng --}}
            <tr>
                <td rowspan="4">
                    <h2>Order</h2>
                </td>
                <td>Hiển thị lịch sử đơn hàng (GET)</td>
                <td>/api/orders/history</td>
                <td>OK</td>
            </tr>

            <tr>
                <td>Checkout (GET)</td>
                <td>/api/orders/checkout</td>
                <td>OK</td>
            </tr>

            <tr>
                <td>Tiến hành đặt hàng (POST)</td>
                <td>/api/orders/post-checkout</td>
                <td>OK</td>
            </tr>

            <tr>
                <td>Xem chi tiết đơn hàng (GET)</td>
                <td>/api/orders/detail/{id}</td>
                <td>OK</td>
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            {{-- Sản phẩm --}}
            <tr>
                <td rowspan="7">
                    <h2>Products</h2>
                </td>
                <td>Hiển thị sản phẩm (GET)</td>
                <td>/api/prods/products</td>
                <td>OK</td>
            </tr>

            <tr>
                <td>Hiển thị sản phẩm theo loại (GET)</td>
                <td>/api/prods/productsByType/{id}</td>
                <td>OK</td>
            </tr>

            <tr>
                <td>Thêm sản phẩm (POST)</td>
                <td>/api/prods/product</td>
                <td>OK</td>
            </tr>

            <tr>
                <td>Xóa sản phẩm (DELETE)</td>
                <td>/api/prods/delProduct/{id}</td>
                <td>DIED</td>
            </tr>

            <tr>
                <td>Hiển thị loại sản phẩm (GET)</td>
                <td>/api/prodTypes/productType</td>
                <td>OK</td>
            </tr>

            <tr>
                <td>Thêm loại sản phẩm (POST)</td>
                <td>/api/prodTypes/productType</td>
                <td>OK</td>
            </tr>

            <tr>
                <td>Xóa loại sản phẩm (DELETE)</td>
                <td>/api/prodTypes/delProductType/{id}</td>
                <td>OK</td>
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            {{-- Carts --}}


            {{-- Orders --}}
        </tbody>
    </table>

</div>

@stop