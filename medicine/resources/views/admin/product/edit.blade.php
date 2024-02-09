@extends('admin.admin')

@section('main')

<h1>Edit Product</h1>
<hr>
<form action="{{ route('product.update', $product->id) }}" method="POST" role="form">
    @csrf @method('PUT')
        <div class="col-md-4">

            <div class="form-group">
                <label for="">Product Name</label>
                <input type="text" class="form-control" value="{{ $product->name }}" name='name' placeholder="Input product name">
            </div>
    
            <div class="form-group">
                <label for="">Product Type</label>
                <input type="text" class="form-control" value="{{ $product->type_id }}" name='type_id' placeholder="Input product type">
            </div>
    
            <div class="form-group">
                <label for="">Describe</label>
                <input type="text" class="form-control" value="{{ $product->describe }}" name='describe' placeholder="Input describe">
            </div>
    
            <div class="form-group">
                <label for="">Info</label>
                <input type="text" class="form-control" value="{{ $product->info }}" name='info' placeholder="Input info">
            </div>
    
            <div class="form-group">
                <label for="">Price</label>
                <input type="text" class="form-control" value="{{ $product->price }}" name='price' placeholder="Input price">
            </div>
    
            <div class="form-group">
                <label for="">Image</label>
                <input type="text" class="form-control" value="{{ $product->img }}" name='img' placeholder="Input image">
            </div>
    
            <div class="form-group">
                <label for="">Status</label>
    
                <div class="radio">
                    <label>
                        <input type="radio" name="status" value="1" {{$product->status == 1 ? 'checked' : '' }}>
                        Hiển thị
                    </label>
                </div>
    
                <div class="radio">
                    <label>
                        <input type="radio" name="status" value="0" {{$product->status == 0 ? 'checked' : '' }}>
                        Tạm ẩn
                    </label>
                </div>
    
            </div>
    
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    
    </form>

@stop