@extends('admin.admin')

@section('main')

<h1>Create Product</h1>
<hr>
<form action="{{ route('product.store') }}" method="POST" role="form" enctype="multipart/form-data">
    @csrf
    <div class="col-md-4">

        <div class="form-group">
            <label for="">Product Name</label>
            <input type="text" class="form-control" name='name' id="nameProduct" placeholder="Input product name" onkeyup="ChangeToSlug()">
            @error('name') <small> {{$message}} </small> @enderror
        </div>

        <div class="form-group">
            <label for="">Slug</label>
            <input type="text" class="form-control" name='slug' id="slug" placeholder="Input slug">
            @error('slug') <small> {{$message}} </small> @enderror
        </div>

        <div class="form-group">
            <label for="">Product Type</label>
            <select name="type_id" id="input" class="form-control" required="required">
                @foreach($proTypes as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
            @error('type_id') <small>{{$message}}</small> @enderror

        </div>

        <div class="form-group">
            <label for="">Describe</label>
            <input type="text" class="form-control" name='describe' placeholder="Input describe">
            @error('describe') <small>{{$message}}</small> @enderror
        </div>

        <div class="form-group">
            <label for="">Info</label>
            <input type="text" class="form-control" name='info' placeholder="Input info">
            @error('info') <small>{{$message}}</small> @enderror
        </div>

        <div class="form-group">
            <label for="">Price</label>
            <input type="text" class="form-control" name='price' placeholder="Input price">
            @error('price') <small>{{$message}}</small> @enderror
        </div>

        <div class="form-group">
            <label for="">Image</label>
            <input type="file" class="form-control" name='img' placeholder="Input image">
            @error('img') <small>{{$message}}</small> @enderror
        </div>

        <div class="form-group">
            <label for="">Image details</label>
            <input type="file" class="form-control" name='imgs[]' placeholder="Input image details" multiple>
            @error('imgs') <small>{{$message}}</small> @enderror
        </div>

        <div class="form-group">
            <label for="">Status</label>

            <div class="radio">
                <label>
                    <input type="radio" name="status" value="1" checked="checked">
                    Hiển thị
                </label>
            </div>

            <div class="radio">
                <label>
                    <input type="radio" name="status" value="0" checked="checked">
                    Tạm ẩn
                </label>
            </div>
            @error('status') <small>{{$message}}</small> @enderror

        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </div>

</form>

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

@stop