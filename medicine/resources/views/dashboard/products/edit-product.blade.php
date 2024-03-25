<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Sửa sản phẩm</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">Home</a>
            </li>
            <li>
                <a>Quản lý sản phẩm</a>
            </li>
            <li class="active">
                <strong>{{ $details->name }}</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight ecommerce">

    <div class="row">
        <div class="col-lg-12">
            <div class="tabs-container">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#tab-1">Thông tin sản phẩm</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-4">Ảnh mô tả</a></li>
                </ul>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane active">
                        <div class="panel-body">

                            <fieldset class="form-horizontal">
                                <form id="productForm" method="POST" action="{{ route('dashboard.products.post-edit-product', $details->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Name:</label>
                                        <div class="col-sm-10">
                                            <input type="text" id="nameProduct" value="{{ $details->name }}" name="name" class="form-control" placeholder="Tên sản phẩm" onkeyup="ChangeToSlug()">
                                            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>
                                    </div>
                                    <input type="hidden" id="slug" value="{{ $details->slug }}" name="slug" class="form-control" placeholder="Slug sản phẩm">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Loại:</label>
                                        <div class="col-sm-10">
                                            <select name="type_id" id="input" class="form-control">
                                                @foreach($types as $item)
                                                    <option value="{{ $item->id }}" {{ $item->id == $details->type_id ? 'selected' : '' }}>{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('type_id') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Thông tin:</label>
                                        <div class="col-sm-10">
                                            <input id="info" name="info" type="text" value="{{ $details->info }}" class="form-control" placeholder="Nhập thông tin">
                                            @error('info') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Mô tả:</label>
                                        <div class="col-sm-10">
                                            <input id="describe" name="describe" value="{{ $details->describe }}" type="text" class="form-control" placeholder="Nhập mô tả">
                                            @error('describe') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Số lượng:</label>
                                        <div class="col-sm-10">
                                            <input id="quantity" name="quantity" value="{{ $details->quantity }}" type="text" class="form-control" placeholder="Nhập số lượng">
                                            @error('quantity') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Giá:</label>
                                        <div class="col-sm-10">
                                            <input id="price" name="price"value="{{ $details->price }}" type="text" class="form-control" placeholder="Nhập giá">
                                            @error('price') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Giá giảm(nếu có, không thì để 0):</label>
                                        <div class="col-sm-10">
                                            <input id="discount" name="discount" value="{{ $details->discount }}" type="text" class="form-control" placeholder="Nhập giá">
                                            @error('discount') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Ảnh đại diện:</label>
                                        <div class="col-sm-10">
                                            <img id="currentImage" src="{{ asset('storage/images/products/'.$details->img) }}" alt="Current Image" style="max-width: 200px;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Tải lên ảnh mới:</label>
                                        <div class="col-sm-10">
                                            <input name="img" type="file" class="form-control" placeholder="Image" onchange="previewImage(event)">
                                            @error('img') <small>{{ $message }}</small> @enderror
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                        <div class="col-sm-4 col-sm-offset-2">
                                            <button type="button" onclick="cancelEdit()" class="btn btn-danger">Hủy bỏ</button>
                                            <button onclick="return confirm('Bạn chắc chứ?')" class="btn btn-primary button-create" type="submit">Xác nhận</button>
                                        </div>
                                    </div>
                                </form>


                            </fieldset>

                        </div>
                    </div>
                    <div id="tab-4" class="tab-pane">
                        <div class="panel-body">

                            <div class="table-responsive">
                                <div class="ibox-title">
                                    <div class="ibox-tools">
                                        <button id="saveOrdersBtn" class="btn btn-primary">Lưu thứ tự hiển thị</button>
                                    </div>
                                </div>
                                <table class="table table-bordered table-stripped">

                                    <thead>
                                        <tr>
                                            <th>
                                                Ảnh mô tả
                                            </th>
                                            <th>
                                                Đường dẫn
                                            </th>
                                            <th>
                                                Thứ tự
                                            </th>
                                            <th>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($details->img_details as $item)
                                            <tr>
                                                <td class="text-center">
                                                    <img src="{{ asset('storage/images/products/'.$item->img) }}" style="max-width: 100px">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" disabled
                                                        value="{{ asset('storage/images/products/'.$item->img) }}">
                                                </td>
                                                <td>
                                                    <input type="text" min="1" class="form-control order-input" name="orders[{{ $item->id }}]" value="{{ $item->sort_order }}">
                                                </td>
                                                <td>
                                                    <button class="btn btn-white bg-success"><i class="fa fa-save"></i></button>
                                                    <button class="btn btn-white bg-danger"><i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function ChangeToSlug()
    {
        var nameProduct, slug;

        //Lấy text từ thẻ input title
        nameProduct = document.getElementById("nameProduct").value;

        //Đổi chữ hoa thành chữ thường
        slug = nameProduct.toLowerCase();

        //Đổi ký tự có dấu thành không dấu
        slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
        slug = slug.replace(/đ/gi, 'd');
        //Xóa các ký tự đặt biệt
        slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
        //Đổi khoảng trắng thành ký tự gạch ngang
        slug = slug.replace(/ /gi, " - ");
        //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
        //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
        slug = slug.replace(/\-\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-/gi, '-');
        slug = slug.replace(/\-\-/gi, '-');
        //Xóa các ký tự gạch ngang ở đầu và cuối
        slug = '@' + slug + '@';
        slug = slug.replace(/\@\-|\-\@|\@/gi, '');
        //In slug ra textbox có id “slug”
        document.getElementById('slug').value = slug;
    }
</script>
<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function () {
            var output = document.getElementById('currentImage');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }

    function cancelEdit() {
        var form = document.getElementById('productForm');
        form.reset();

        // Lấy các giá trị ban đầu của các trường input
        var name = "{{ $details->name }}";
        var slug = "{{ $details->slug }}";
        var type_id = "{{ $details->type_id }}";
        var info = "{{ $details->info }}";
        var describe = "{{ $details->describe }}";
        var quantity = "{{ $details->quantity }}";
        var price = "{{ $details->price }}";
        var discount = "{{ $details->discount }}";
        var imgPath = "{{ asset('storage/images/products/'.$details->img) }}";

        // Gán các giá trị ban đầu cho các trường input
        document.getElementById('nameProduct').value = name;
        document.getElementById('slug').value = slug;
        document.getElementById('input').value = type_id;
        document.getElementById('info').value = info;
        document.getElementById('describe').value = describe;
        document.getElementById('quantity').value = quantity;
        document.getElementById('price').value = price;
        document.getElementById('discount').value = discount;

        // Khôi phục lại ảnh hiện tại
        var currentImage = document.getElementById('currentImage');
        currentImage.src = imgPath;
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('saveOrdersBtn').addEventListener('click', function (event) {
            event.preventDefault();

            var orders = {};
            var quantityInputs = document.querySelectorAll('.order-input');
            quantityInputs.forEach(function (input) {
                var imgId = input.getAttribute('name').match(/\d+/)[0];
                orders[imgId] = input.value;
            });

            fetch('{{ url('/dashboard/products/update-sort-order-img-details') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ orders: orders })
            })
            .then(response => {
                if (response.ok) {
                    return response.json(); // Chuyển đổi dữ liệu JSON thành đối tượng JavaScript
                } else {
                    throw new Error('Network response was not ok');
                }
            })
            .then(data => {
                // Hiển thị thông báo thành công
                Swal.fire({
                    toast: true,
                    icon: 'success',
                    title: data.message,
                    animation: true,
                    position: 'top-right',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer);
                        toast.addEventListener('mouseleave', Swal.resumeTimer);
                    }
                });
            })
            .catch(error => {
                // Hiển thị thông báo lỗi
                Swal.fire({
                    toast: true,
                    icon: 'error',
                    title: 'Đã xảy ra lỗi',
                    animation: true,
                    position: 'top-right',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer);
                        toast.addEventListener('mouseleave', Swal.resumeTimer);
                    }
                });
                console.error('An error occurred:', error);
            });
        });
    });
</script>
