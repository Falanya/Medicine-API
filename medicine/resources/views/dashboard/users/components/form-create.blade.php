<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Thông tin tài khoản</small></h5>
                </div>
                <div class="ibox-content">
                    <form action="{{ route('dashboard.users.post_create') }}" method="POST" class="form-horizontal">
                        @csrf
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Fullname</label>
                            <div class="col-sm-10">
                                <input name="fullname" type="text" class="form-control">
                                @error('fullname') <small>{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                                <input name="email" type="text" class="form-control">
                                @error('email') <small>{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Giới tính</label>
                            <div class="col-sm-10">
                                <select name="gender" id="input" class="form-control" required="required">
                                    <option value="1">Nam</option>
                                    <option value="0">Nữ</option>
                                </select>
                                @error('gender') <small>{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Phone</label>
                            <div class="col-sm-10">
                                <input name="phone" type="text" class="form-control">
                                @error('phone') <small>{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Birthday</label>
                            <div class="col-sm-10">
                                <input name="birthday" type="date" class="form-control">
                                <span class="text-danger">Format: DD/MM/YYY</span>
                                @error('birthday') <small>{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-10">
                                <input name="password" type="password" class="form-control">
                                @error('password') <small>{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Confirm password</label>
                            <div class="col-sm-10">
                                <input name="confirm_password" type="password" class="form-control">
                                @error('confirm_password') <small>{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button onclick="return confirm('Bạn chắc chứ?')" class="btn btn-primary button-create" type="submit">Tạo người dùng</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
