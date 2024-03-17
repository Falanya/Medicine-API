<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Account Information</h2>
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
                    <div class="form-horizontal">
                        <div class="form-group"><label class="col-sm-2 control-label">Email</label>

                            <div class="col-sm-10">
                                <input type="text" value="{{ $auth->email }}" class="form-control" placeholder="Input email" disabled>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Fullname</label>
                            <div class="col-sm-10">
                                <input name="fullname" value="{{ $auth->fullname }}" type="text" class="form-control" placeholder="Input fullname" disabled>
                                @error('fullname') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Phone</label>
                            <div class="col-sm-10">
                                <input name="phone" value="{{ $auth->phone }}" type="text" class="form-control" placeholder="Input phone" disabled>
                                @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Birthday</label>
                            <div class="col-sm-10">
                                <input name="birthday" value="{{ $auth->birthday }}" type="date" class="form-control" id="birthday" name="birthday" disabled>
                                <span><strong>Format: Month/Day/Year</strong></span>
                                @error('birthday') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Gender</label>
                            <div class="col-sm-10">
                                <select name="gender" id="gender" class="form-control" disabled>
                                    <option value="1" {{ $auth->gender == 1 ? 'selected' : '' }}>Nam</option>
                                    <option value="0" {{ $auth->gender == 0 ? 'selected' : '' }}>Nữ</option>
                                </select>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Address</label>

                            <div class="col-sm-10">
                                <input name="address" value="{{ $auth->address }}" type="text" placeholder="Input address" class="form-control" disabled>
                                @error('address') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>