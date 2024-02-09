<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>

<body>
    <section class="about_section">

        <div class="container">


            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Info</th>
                        <th>Describe</th>
                        <th>Price</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="list-products">
                    <tr>
                        <!-- <td></td> -->
                    </tr>
                </tbody>
            </table>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="list-productTypes">
                    <tr>
                        <!-- <td></td> -->

                    </tr>
                </tbody>
            </table>


        </div>
        <form action="" method="POST" role="form" id="formAdd">
            @csrf
            <legend>Form add new</legend>

            <div class="form-group">
                <label for="">Name</label>
                <input type="text" class="form-control" name="name" id="" placeholder="Input field">
            </div>



            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <form action="" method="POST" role="form" id="formLogin">
            @csrf
            <legend>Form login</legend>

            <div class="form-group">
                <label for="">Email</label>
                <input type="text" class="form-control" name="email" id="" placeholder="Input field">
            </div>

            <div class="form-group">
                <label for="">Password</label>
                <input type="text" class="form-control" name="password" id="" placeholder="Input field">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <form action="" method="POST" role="form" id="formRegister">
            @csrf
            <legend>Form register</legend>

            <div class="form-group">
                <label for="">Fullname</label>
                <input type="text" class="form-control" name="fullname" id="" placeholder="Input field">
            </div>

            <div class="form-group">
                <label for="">Email</label>
                <input type="text" class="form-control" name="email" id="" placeholder="Input field">
            </div>

            <div class="form-group">
                <label for="gender">Gender:</label>
                <select name="gender" id="input" class="form-control" required="required">
                    <option value="1">Male</option>
                    <option value="0">Female</option>
                </select>
            </div>

            <div class="form-group">
                <label for="">Password</label>
                <input type="text" class="form-control" name="password" id="" placeholder="Input field">
            </div>

            <div class="form-group">
                <label for="">Confirm password</label>
                <input type="text" class="form-control" name="password_confirm" id="" placeholder="Input field">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <form action="" method="POST" role="form" id="formAddProduct" enctype="multipart/form-data">
            @csrf
            <legend>Form add new</legend>

            <div class="form-group">
                <label for="">Name</label>
                <input type="text" class="form-control" name="name" id="" placeholder="Input field">
            </div>

            <div class="form-group">
                <label for="">Loại</label>
                <input type="text" class="form-control" name="type_id" id="" placeholder="Input field">
            </div>

            <div class="form-group">
                <label for="">Describe</label>
                <input type="text" class="form-control" name="describe" id="" placeholder="Input field">
            </div>

            <div class="form-group">
                <label for="">Info</label>
                <input type="text" class="form-control" name="info" id="" placeholder="Input field">
            </div>

            <div class="form-group">
                <label for="">Price</label>
                <input type="text" class="form-control" name="price" id="" placeholder="Input field">
            </div>

            <div class="form-group">
                <label for="img">Image:</label>
                <input type="file" id="img" name="img" accept="image/*" required>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </section>

    <script>
        load_data();
        function load_data() {
            $.get('http://127.0.0.1:8000/api/prods/products', function (res) {
                if (res.status_code == 200) {
                    let pros = res.data;
                    console.log(pros);
                    let _rows = '';
                    pros.forEach(function (item) {
                        _rows += '<tr>';
                        _rows += '<td>' + item.name + '</td>';
                        _rows += '<td>' + item.info + '</td>';
                        _rows += '<td>' + item.describe + '</td>';
                        _rows += '<td>' + item.price + '</td>';
                        _rows += '<td>' + item.status + '</td>';
                        _rows += '</tr>';
                    });
                    $('#list-products').html(_rows);
                }
            });

            $.get('http://127.0.0.1:8000/api/prodTypes/productType', function (res) {
                if (res.status_code == 200) {
                    let proTypes = res.data;
                    console.log(proTypes);
                    let _rows = '';
                    proTypes.forEach(function (item) {
                        _rows += '<tr>';
                        _rows += '<td>' + item.name + '</td>';
                        _rows += '<td></td';
                        _rows += '<td>';
                        _rows += '<a href="#" id="edit_productType" class="btn btn-sm btn-primary">Sửa</a>';
                        _rows += '<a href="#" id="delete_productType" class="btn btn-sm btn-primary btn-delete">Xóa</a>';
                        _rows += '</td>';
                        _rows += '</tr>';
                    });
                    $('#list-productTypes').html(_rows);
                }
            });
        }

        $('#formAdd').on('submit', function (ev) {
            ev.preventDefault();
            let formData = $('#formAdd').serialize();
            $.post('http://127.0.0.1:8000/api/prodTypes/productType', formData, function (res) {
                console.log(res);
                load_data();
            });
        });

        $('#formRegister').on('submit', function(ev){
            ev.preventDefault();
            let formRe = $('#formRegister').serialize();
            $.post('http://127.0.0.1:8000/api/users/register', formRe, function(res) {
                console.log(res);
                load_data();
            });
        });

        $('#formAddProduct').on('submit', function(ev){
            ev.preventDefault();
    
            let formProd = new FormData(this);

            $.ajax({
                url: 'http://127.0.0.1:8000/api/prods/product',
                type: 'POST',
                data: formProd,
                processData: false,  // Không xử lý dữ liệu
                contentType: false,  // Không thiết lập kiểu nội dung
                success: function(res) {
                console.log(res);
                load_data();
            },
            error: function(err) {
                console.error(err);
            }
        });
    });

    </script>
</body>

</html>