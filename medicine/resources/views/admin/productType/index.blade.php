@extends('admin.admin')

@section('main')

<h1>Product Type</h1>
<hr>
<a href="{{ route('productType.create') }}" class="btn btn-success">Thêm mới</a>
<table class="table table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($proTypes as $proType)
        <tr>
            <td>{{ $proType -> id }}</td>
            <td>{{ $proType -> name }}</td>
            <td>
                <form action="{{ route('productType.destroy', $proType->id) }}" method="post">
                    @csrf @method('DELETE')
                    <a href="{{ route('productType.edit', $proType -> id) }}" class="btn btn-sm btn-primary">Sửa</a>
                    <button class="btn btn-sm btn-primary">Xóa</button>
                </form>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{$proTypes->links()}}

@stop