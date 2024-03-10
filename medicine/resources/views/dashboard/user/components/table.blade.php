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
        <tr>
            <td>
                <input type="checkbox" value="" class="input-text checkBoxItem">
            </td>
            <td>
                <span class="image img-cover"><img src="{{ asset('storage/images/users/elysia3.jpeg') }}" alt=""></span>
            </td>
            <td>
                <div class="user-item name"><strong>Họ và tên:</strong> Dat tran</div>
                <div class="user-item email"><strong>Email:</strong> dat@gmail.com</div>
                <div class="user-item name"><strong>Phone:</strong> 123456789</div>
                <div class="user-item name"><strong>Giới tính:</strong> Nam</div>
            </td>
            <td>
                {{-- <div class="address-item name"><strong>Địa chỉ:</strong> 168 Cộng Hòa</div>
                <div class="address-item email"><strong>Phường:</strong> 13</div>
                <div class="address-item name"><strong>Quận:</strong> Tân bình</div>
                <div class="address-item name"><strong>Thành phố:</strong> Hồ Chí Minh</div> --}}
                168 Cộng Hòa, phường 13, quận Tân Bình, Hồ Chí Minh
            </td>
            <td class="text-center">
                <input type="checkbox" class="js-switch"  checked>
            </td>
            <td class="text-center">
                <a href="" class="btn btn-success"><i class="fa fa-edit"></i></a>
                <a href="" class="btn btn-danger"><i class="fa fa-trash"></i></a>
            </td>

        </tr>
    </tbody>
</table>

