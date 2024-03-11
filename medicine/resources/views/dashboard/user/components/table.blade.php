<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>
                <input type="checkbox" value="" id="checkAll" class="input-text">
            </th>
            <th style="width: 90px;">Avatar</th>
            <th>Thông tin thành viên</th>
            <th>Địa chỉ</th>
            <th>Status</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @if(isset($users) && is_object($users))
            @foreach($users as $key => $item)
                <tr>
                    <td>
                        <input type="checkbox" value="" class="input-text checkBoxItem">
                    </td>
                    <td>
                        <span class="image img-cover"><img src="{{ asset('storage/images/users/elysia3.jpeg') }}" alt=""></span>
                    </td>
                    <td>
                        <div class="user-item id"><strong>ID:</strong> {{ $item->id }} </div>
                        <div class="user-item name"><strong>Họ và tên:</strong> {{ $item->fullname }} </div>
                        <div class="user-item email"><strong>Email:</strong> {{ $item->email }} </div>
                        <div class="user-item name"><strong>Giới tính:</strong> {{ $item->gender == 1 ? 'Nam' : 'Nữ' }} </div>
                    </td>
                    <td>
                        {{ $item->address }}
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="js-switch" {{ $item->object_status == 1 ? 'checked' : '' }}>
                    </td>
                    <td class="text-center">
                        <a href="" class="btn btn-success"><i class="fa fa-edit"></i></a>
                        <a href="" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
{{
    $users->links('pagination::bootstrap-4')
}}
