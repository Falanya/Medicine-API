<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Account Setting</h2>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Information</h5>
                </div>
                <div class="ibox-content">
                    <form method="POST" action="{{ route('account.post-change-profile') }}" class="form-horizontal">
                        @csrf
                        <div class="form-group"><label class="col-sm-2 control-label">Email</label>

                            <div class="col-sm-10">
                                <input type="text" value="{{ $auth->email }}" class="form-control" placeholder="Input email" disabled>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Fullname</label>
                            <div class="col-sm-10">
                                <input name="fullname" value="{{ $auth->fullname }}" type="text" class="form-control" placeholder="Input fullname">
                                @error('fullname') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Phone</label>
                            <div class="col-sm-10">
                                <input name="phone" value="{{ $auth->phone }}" type="text" class="form-control" placeholder="Input phone">
                                @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Birthday</label>
                            <div class="col-sm-10">
                                <input name="birthday" value="{{ $auth->birthday }}" type="date" class="form-control" id="birthday" name="birthday">
                                <span><strong>Format: Month/Day/Year</strong></span>
                                @error('birthday') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Gender</label>
                            <div class="col-sm-10">
                                <select name="gender" id="gender" class="form-control">
                                    <option value="1" {{ $auth->gender == 1 ? 'selected' : '' }}>Nam</option>
                                    <option value="0" {{ $auth->gender == 0 ? 'selected' : '' }}>Nữ</option>
                                </select>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Confirm password</label>

                            <div class="col-sm-10">
                                <input name="password" type="password" placeholder="Input confirm password" class="form-control">
                                @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-primary" type="submit">Save changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Password</h5>
                </div>
                <div class="ibox-content">
                    <form method="POST" action="{{ route('account.post-change-password') }}" class="form-horizontal">
                        @csrf
                        <div class="form-group"><label class="col-sm-2 control-label">Old password</label>

                            <div class="col-sm-10">
                                <input name="old_password" type="password" class="form-control" placeholder="Input old password">
                                @error('old_password') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group"><label class="col-sm-2 control-label">New password</label>

                            <div class="col-sm-10">
                                <input name="new_password" type="password" class="form-control" placeholder="Input new password">
                                @error('new_password') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Confirm new password</label>

                            <div class="col-sm-10">
                                <input name="new_password_confirm" type="password" class="form-control" placeholder="Input confirm new password">
                                @error('new_password_confirm') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-primary" type="submit">Save changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>