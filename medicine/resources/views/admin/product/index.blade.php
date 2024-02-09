@extends('admin.admin')

@section('main')
<h1>Product</h1>
<hr>
<a href="{{ route('product.create') }}" class="btn btn-success">Thêm mới</a>

<table class="table table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Type</th>
            <th>Describe</th>
            <th>Info</th>
            <th>Price</th>
            <th>Img</th>
            <th>Status</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($pros as $pro)
        <tr>
            <td>{{ $pro -> id }}</td>
            <td>{{ $pro -> name }}</td>
            <td>{{ $pro -> type_id }}</td>
            <td>{{ $pro -> describe }}</td>
            <td>{{ $pro -> info }}</td>
            <td>{{ $pro -> price }}</td>
            <td>{{ $pro -> img }}</td>
            <td>{{ $pro -> status == 0 ? 'Tạm ẩn' : 'Hiển thị' }}</td>
            <td>
                <form action="{{ route('product.destroy', $pro->id) }}" method="post">
                    @csrf @method('DELETE')
                    <a href="{{ route('product.edit', $pro->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <button type="submit" class="btn btn-primary" onclick="return confirm('Do you want to remove this product?')"><i class="fas fa-trash"></i></button>
                </form>
                
            </td>
        </tr>
        @endforeach

    </tbody>
</table>

@stop