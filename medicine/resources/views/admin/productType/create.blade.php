@extends('admin.admin')

@section('main')

<h1>Create Product Type</h1>
<hr>
<form action="{{ route('productType.store') }}" method="POST" role="form">
    @csrf
    <div class="col-md-4">
        <div class="form-group">
            <label for="">Type Name</label>
            <input type="text" class="form-control" name='name' placeholder="Input type name">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </div>

</form>


@stop