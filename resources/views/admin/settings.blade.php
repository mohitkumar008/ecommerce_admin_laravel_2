@extends('layouts.admin_layout.layout')
@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
      <div class="d-flex justify-content-between flex-wrap">
        <div class="d-flex align-items-end flex-wrap">
          <div class="me-md-3 me-xl-5">
            <h2>Settings</h2>
            <div class="d-flex">
              <i class="mdi mdi-home text-muted hover-cursor"></i>
              <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</p>
              <p class="text-primary mb-0 hover-cursor">Settings</p>
            </div>
            @if(session('update_pwd'))
              <span class="text-success mt-2">{{session('update_pwd')}}</span>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body dashboard-tabs p-0">
          <ul class="nav nav-tabs px-4" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Profile</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="change-password-tab" data-bs-toggle="tab" href="#change-password" role="tab" aria-controls="change-password" aria-selected="false">Change Password</a>
            </li>
          </ul>
          <div class="tab-content py-0 px-0">
            <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
              <div class="row">
                <div class="col-md-4 col-sm-12 grid-margin grid-margin-md-0 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Profile Information</h4>
                      <div class="profile-image text-center mb-5">
                        <img src="{{url('storage/media/'.$data->image.'')}}" class="rounded-circle" alt="profile">
                      </div>
                      <ul class="list-star">
                        <li><span><b>Name</b></span><span class="float-right">{{$data->name}}</span></li>
                        <li><span><b>Email</b></span><span class="float-right">{{$data->email}}</span></li>
                        <li><span><b>Role</b></span><span class="float-right">{{$data->type}}</span></li>
                        <li><span><b>Mobile</b></span><span class="float-right">{{$data->mobile}}</span></li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="col-md-8 col-sm-12 grid-margin grid-margin-md-0 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Update Profile</h4>
                      <form class="forms-sample" method="post" action="{{url('/admin/update-profile')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                          <label for="exampleInputName1">Name</label>
                          <input type="text" class="form-control" id="exampleInputName1" value="{{$data->name}}" name="admin_name" placeholder="Name">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputMobile1">Mobile</label>
                          <input type="tel" class="form-control" id="exampleInputMobile1" value="{{$data->mobile}}" name="admin_mobile" placeholder="Mobile">
                        </div>
                        <div class="form-group">
                          <label>File upload</label>
                          <input type="file" name="admin_image" class="file-upload-default">
                          <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled="" name="admin_image" placeholder="Upload Image">
                            <span class="input-group-append">
                              <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                            </span>
                          </div>
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Save changes</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="change-password" role="tabpanel" aria-labelledby="change-password-tab">
              <div class="card">
                <div class="card-body">
                  <form class="forms-sample" method="post" action="{{url('/admin/change-password')}}">
                    @csrf
                    <div class="form-group">
                      <label>Admin Email</label>
                      <input class="form-control" readonly="readonly" value="{{Auth::guard('admin')->user()->email}}">
                    </div>
                    <div class="form-group">
                      <label for="curr_pwd">Current Password</label>
                      <input type="password" class="form-control" name="curr_pwd" id="curr_pwd" placeholder="Current Password" autocomplete="off">
                      <span id="curr_pwd_err"></span>
                    </div>
                    <div class="form-group">
                      <label for="new_pwd">New Password</label>
                      <input type="password" class="form-control" name="new_pwd" id="new_pwd" placeholder="New Password" disabled>
                    </div>
                    <div class="form-group">
                      <label for="cnfrm_new_pwd">Confirm New Password</label>
                      <input type="password" class="form-control" name="cnfrm_new_pwd" id="cnfrm_new_pwd" placeholder="Confirm New Password" disabled>
                      <span id="cnfrm_pwd_err"></span>
                    </div>
                    <button type="submit" id="change_pass_btn" class="btn btn-primary me-2" disabled>Save</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('scripts')
<script src="{{url('admin_assets/js/file-upload.js')}}"></script>
@endsection