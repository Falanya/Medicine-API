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
                    <li class="active"><a data-toggle="tab" href="#tab-1"> Product info</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-4"> Images</a></li>
                </ul>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane active">
                        <div class="panel-body">

                            <fieldset class="form-horizontal">
                                <form method="POST" action="{{ route('dashboard.products.post-edit-product', $details->id) }}">
                                    @csrf
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Name:</label>
                                        <div class="col-sm-10">
                                            <input type="text" id="nameProduct" value="{{ $details->name }}" name="name" class="form-control" placeholder="Tên sản phẩm" onkeyup="ChangeToSlug()">
                                            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>
                                    </div>
                                    {{-- <div class="form-group">
                                        <label class="col-sm-2 control-label">Slug</label>
                                        <div class="col-sm-10">
                                            <input type="text" id="slug" value="{{ $details->slug }}" name="slug" class="form-control" placeholder="Slug sản phẩm">
                                        </div>
                                    </div> --}}
                                    <input type="hidden" id="slug" value="{{ $details->slug }}" name="slug" class="form-control" placeholder="Slug sản phẩm">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Loại:</label>
                                        <div class="col-sm-10">
                                            <select name="type_id" id="input" class="form-control">
                                                @foreach($types as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('type_id') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Thông tin:</label>
                                        <div class="col-sm-10">
                                            <input name="info" type="text" value="{{ $details->info }}" class="form-control" placeholder="Nhập thông tin">
                                            @error('info') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Mô tả:</label>
                                        <div class="col-sm-10">
                                            <input name="describe" value="{{ $details->describe }}" type="text" class="form-control" placeholder="Nhập mô tả">
                                            @error('describe') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Số lượng:</label>
                                        <div class="col-sm-10">
                                            <input name="quantity" value="{{ $details->quantity }}" type="text" class="form-control" placeholder="Nhập số lượng">
                                            @error('quantity') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Giá:</label>
                                        <div class="col-sm-10">
                                            <input name="price"value="{{ $details->price }}" type="text" class="form-control" placeholder="Nhập giá">
                                            @error('price') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Giá giảm(nếu có, không thì để 0):</label>
                                        <div class="col-sm-10">
                                            <input name="discount" value="{{ $details->discount }}" type="text" class="form-control" placeholder="Nhập giá">
                                            @error('discount') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                        <div class="col-sm-4 col-sm-offset-2">
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
                                <table class="table table-bordered table-stripped">
                                    <thead>
                                        <tr>
                                            <th>
                                                Image preview
                                            </th>
                                            <th>
                                                Image url
                                            </th>
                                            <th>
                                                Sort order
                                            </th>
                                            <th>
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <img src="{{ asset('img/gallery/2s.jpg') }}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" disabled
                                                    value="http://mydomain.com/images/image1.png">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" value="1">
                                            </td>
                                            <td>
                                                <button class="btn btn-white"><i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="{{ asset('img/gallery/1s.jpg') }}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" disabled
                                                    value="http://mydomain.com/images/image2.png">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" value="2">
                                            </td>
                                            <td>
                                                <button class="btn btn-white"><i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="{{ asset('img/gallery/3s.jpg') }}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" disabled
                                                    value="http://mydomain.com/images/image3.png">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" value="3">
                                            </td>
                                            <td>
                                                <button class="btn btn-white"><i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="{{ asset('img/gallery/4s.jpg') }}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" disabled
                                                    value="http://mydomain.com/images/image4.png">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" value="4">
                                            </td>
                                            <td>
                                                <button class="btn btn-white"><i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="{{ asset('img/gallery/5s.jpg') }}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" disabled
                                                    value="http://mydomain.com/images/image5.png">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" value="5">
                                            </td>
                                            <td>
                                                <button class="btn btn-white"><i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="{{ asset('img/gallery/6s.jpg') }}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" disabled
                                                    value="http://mydomain.com/images/image6.png">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" value="6">
                                            </td>
                                            <td>
                                                <button class="btn btn-white"><i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="{{ asset('img/gallery/7s.jpg') }}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" disabled
                                                    value="http://mydomain.com/images/image7.png">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" value="7">
                                            </td>
                                            <td>
                                                <button class="btn btn-white"><i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
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
