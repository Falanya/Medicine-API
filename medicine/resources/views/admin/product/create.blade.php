@extends('admin.admin')

@section('main')

<h1>Create Product</h1>
<hr>
<form action="{{ route('product.store') }}" method="POST" role="form">
    @csrf
        <div class="col-md-4">

            <div class="form-group">
                <label for="">Product Name</label>
                <input type="text" class="form-control" name='name' placeholder="Input product name">
            </div>
    
            <div class="form-group">
                <label for="">Product Type</label>
                <input type="text" class="form-control" name='type_id' placeholder="Input product type">
            </div>
    
            <div class="form-group">
                <label for="">Describe</label>
                <input type="text" class="form-control" name='describe' placeholder="Input describe">
            </div>
    
            <div class="form-group">
                <label for="">Info</label>
                <input type="text" class="form-control" name='info' placeholder="Input info">
            </div>
    
            <div class="form-group">
                <label for="">Price</label>
                <input type="text" class="form-control" name='price' placeholder="Input price">
            </div>
    
            <div class="form-group">
                <label for="">Image</label>
                <input type="text" class="form-control" name='img' placeholder="Input image">
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
    
            </div>
    
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    
    </form>

@stop