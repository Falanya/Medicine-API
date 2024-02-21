@extends('admin.admin')

@section('main')
<h1>Product</h1>
<hr>
<div class="row">
    <div class="col-md-2">
        <a href="{{ route('product.create') }}" class="btn btn-success">Add new</a>
    </div>
    <div class="col-md-6">
        <form action="{{ route('product.index') }}" method="GET" role="form" class="form-inline">
            <div class="form-group">
                <input type="text" name="search" class="form-control" id="" placeholder="Input product name" value="{{request('search')}}">
            </div>
            <button type="Search" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>


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
            <td>
                <img src="{{ asset('storage/images/products/'.$pro->img) }}" alt="" width="150px">
            </td>
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
<hr>
<div class="text-center">
    <ul class="pagination">
        
        @if ($pros->onFirstPage())
            <li class="disabled"><span>&laquo;</span></li>
        @else
            <li><a href="{{ $pros->appends(request()->all())->previousPageUrl() }}" rel="prev">&laquo;</a></li>
        @endif

        
        @if ($pros->currentPage() > 3)
            <li><span>...</span></li>
        @endif

        
        @for ($i = 1; $i <= $pros->lastPage(); $i++)
            @if ($i >= $pros->currentPage() - 2 && $i <= $pros->currentPage() + 2)
                <li class="{{ ($pros->currentPage() == $i) ? 'active' : '' }}">
                    <a href="{{ $pros->appends(request()->all())->url($i) }}">{{ $i }}</a>
                </li>
            @endif
        @endfor

        
        @if ($pros->currentPage() < $pros->lastPage() - 2)
            <li><span>...</span></li>
        @endif

        
        @if ($pros->hasMorePages())
            <li><a href="{{ $pros->appends(request()->all())->nextPageUrl() }}" rel="next">&raquo;</a></li>
        @else
            <li class="disabled"><span>&raquo;</span></li>
        @endif
    </ul>
</div>

@stop