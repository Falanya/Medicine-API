@include('dashboard.user.components.breadcrumb', ['title' => $config['seo']['create']['title']])


<form action="" method="POST" role="form" class="box">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-5">
                <div class="panel-head">
                    <div class="panel-title">Thông tin chung</div>
                    <div class="panel-description">
                        <p>- Nhập thông tin chung của người dùng</p>
                        <p>- Lưu ý: dấu <span class="text-danger">(*)</span> là bắt buộc</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Email</label>
                                    <span class="text-danger">(*)</span>
                                    <input type="text" name="email" value="" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Họ và tên</label>
                                    <span class="text-danger">(*)</span>
                                    <input type="text" name="fullname" value="" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Nhóm thành viên</label>
                                    <span class="text-danger">(*)</span>
                                    <select name="role_id" id="" class="form-control">
                                        <option value="0">[Chọn nhóm thành viên]</option>
                                        <option value="1">Member</option>
                                        <option value="2">Quản trị viên</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Ngày sinh</label>
                                    <span class="text-danger">(*)</span>
                                    <input type="text" name="birthday" value="" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Mật khẩu</label>
                                    <span class="text-danger">(*)</span>
                                    <input type="password" name="password" value="" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Nhập lại mật khẩu</label>
                                    <span class="text-danger">(*)</span>
                                    <input type="password" name="confirm_password" value="" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row mb15">
                            <div class="col-lg-12">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Ảnh đại diện</label>
                                    <span class="text-danger">(*)</span>
                                    <input type="text" name="img" value="" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-lg-5">
                <div class="panel-head">
                    <div class="panel-title">Thông tin liên hệ</div>
                    <div class="panel-description">Nhập thông tin liên hệ của người dùng</div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Thành phố</label>
                                    <span class="text-danger">(*)</span>
                                    <select name="province_id" class="form-control setupSelect2 province">
                                        <option value="0">[Chọn thành phố]</option>
                                        @if(isset($provinces))
                                            @foreach($provinces as $province)
                                                <option value="{{ $province->code }}">{{ $province->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Quận/Huyện</label>
                                    <span class="text-danger">(*)</span>
                                    <select name="district_id" class="form-control setupSelect2 districts">
                                        <option value="0">[Chọn quận/huyện]</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Phường/Xã</label>
                                    <span class="text-danger">(*)</span>
                                    <select name="ward_id" class="form-control setupSelect2">
                                        <option value="0">[Chọn phường/xã]</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Địa chỉ</label>
                                    <span class="text-danger">(*)</span>
                                    <input type="text" name="address" value="" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Số điện thoại</label>
                                    <span class="text-danger">(*)</span>
                                    <input type="text" name="phone" value="" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mb15">
            <button class="btn btn-primary" type="submit" name="send" value="send">Lưu thông tin</button>
        </div>
    </div>
</form>
