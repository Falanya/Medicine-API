<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Tạo sản phẩm</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard.index') }}">Home</a>
            </li>
            <li>
                <a>Quản lý sản phẩm</a>
            </li>
            <li class="active">
                <strong>Tạo sản phẩm</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Điền thông tin sản phẩm</h5>
                </div>
                <div class="ibox-content">
                    <form id="productForm" method="POST" class="form-horizontal" action="{{ route('dashboard.products.post-create-product') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Tên</label>
                            <div class="col-sm-10">
                                <input type="text" id="nameProduct" name="name" class="form-control" placeholder="Điền tên sản phẩm" onkeyup="ChangeToSlug()">
                                @error('name') <small>{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <input type="hidden" id="slug" name="slug" class="form-control" placeholder="Slug">
                        @error('slug') <small>{{ $message }}</small> @enderror
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Loại sản phẩm</label>
                            <div class="col-sm-10">
                                <select name="type_id" id="input" class="form-control" required="required">
                                    @foreach($types as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('type_id') <small>{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Thông tin</label>
                            <div class="col-sm-10">
                                <textarea type="text" class="form-control" name="info" style="resize: none; height: 120px;" placeholder="Nhập thông tin"></textarea>
                                @error('info') <small>{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Mô tả</label>
                            <div class="col-sm-10">
                                <textarea type="text" class="form-control" name="describe" style="resize: none; height: 120px;" placeholder="Nhập mô tả"></textarea>
                                @error('describe') <small>{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Số lượng</label>
                            <div class="col-sm-10">
                                <input type="text" name="quantity" placeholder="Điền số lượng" class="form-control">
                                @error('quantity') <small>{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Giá</label>
                            <div class="col-sm-10">
                                <input type="text" name="price" placeholder="Điền giá" class="form-control">
                                @error('price') <small>{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Ảnh đại diện:</label>
                            <div class="col-sm-10">
                                <img id="currentImage" src="{{ asset('css/patterns/shattered.png') }}" alt="Current Image" style="max-width: 200px;">
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
                                <button class="btn btn-primary" type="submit">Xác nhận</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

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

        var imgPath = "{{ asset('css/patterns/shattered.png') }}";

        // Khôi phục lại ảnh hiện tại
        var currentImage = document.getElementById('currentImage');
        currentImage.src = imgPath;
    }
</script>
