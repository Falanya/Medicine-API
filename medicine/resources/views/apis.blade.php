<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Title Page</title>

    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.3/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>

<body>

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
                    <td rowspan="7"><h2>Users</h2></td>
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
                    <td>Đăng xuất (?)</td>
                    <td>/api/users/....</td>
                    <td>Unknown</td>
                </tr>

                <tr>
                    <td>Quên mật khẩu (?)</td>
                    <td>/api/users/....</td>
                    <td>Unknown</td>
                </tr>

                <tr>
                    <td>Thay đổi thông tin (?)</td>
                    <td>/api/users/...</td>
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

                {{-- Sản phẩm --}}
                <tr>
                    <td rowspan="7"><h2>Products</h2></td>
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

</body>

</html>