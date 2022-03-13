@extends('layouts.backend_master')
@section('content')
  {{-- breadcrumb --}}
  <div class="row bread_part">
      <div class="col-sm-12 bread_col">
          <h4 class="pull-left page-title bread_title">Dashboard</h4>
          <ol class="breadcrumb pull-right">
              <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
              <li class="active">User</li>
          </ol>
      </div>
  </div>
  {{-- breadcrumb --}}
  {{-- error throug --}}
  @if (count($errors) > 0)
    <div class="alert alert-danger">
      <strong>Whoops!</strong> There were some problems with your input.<br><br>
      <ul>
         @foreach ($errors->all() as $error)
           <li>{{ $error }}</li>
         @endforeach
      </ul>
    </div>
  @endif
  {{-- error throug --}}
  {{-- main work --}}
  <div class="row">
    <div class="col-lg-12">
        <form class="form-horizontal" method="post" action="{{ route('users.store') }}" enctype="multipart/form-data">
          @csrf
          <div class="card">
              <div class="card-header">
                  <div class="row">
                      <div class="col-md-8">
                          <h3 class="card-title card_top_title"><i class="fab fa-gg-circle"></i> Add New User</h3>
                      </div>
                      <div class="col-md-4 text-right">
                          <a href="{{ route('users.index') }}" class="btn btn-md btn-primary waves-effect card_top_button"><i class="fa fa-th"></i> All User List </a>
                      </div>
                      <div class="clearfix"></div>
                  </div>
              </div>
              <div class="card-body card_form">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        {{-- show error validation --}}
                        @if (count($errors) > 0)
                          <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                               @foreach ($errors->all() as $error)
                                 <li>{{ $error }}</li>
                               @endforeach
                            </ul>
                          </div>
                        @endif
                        {{-- show error validation --}}
                    </div>
                    <div class="col-md-2"></div>
                </div>

                <div class="form-group row custom_form_group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label class="col-sm-3 control-label">Name:<span class="req_star">*</span></label>
                    <div class="col-sm-7">
                      <input type="text" placeholder="Name" class="form-control" name="name" value="{{old('name')}}" required>
                      @if ($errors->has('name'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('name') }}</strong>
                          </span>
                      @endif
                    </div>
                </div>

                <div class="form-group row custom_form_group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label class="col-sm-3 control-label">Email:<span class="req_star">*</span></label>
                    <div class="col-sm-7">
                      <input type="email" placeholder="Email" class="form-control" name="email" value="{{old('email')}}" required>
                      @if ($errors->has('email'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('email') }}</strong>
                          </span>
                      @endif
                    </div>
                </div>

                <div class="form-group row custom_form_group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label class="col-sm-3 control-label">Password:<span class="req_star">*</span></label>
                    <div class="col-sm-7">
                      <input type="password" placeholder="Password" class="form-control" name="password" required>
                      @if ($errors->has('password'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('password') }}</strong>
                          </span>
                      @endif
                    </div>
                </div>

                <div class="form-group row custom_form_group{{ $errors->has('confirm-password') ? ' has-error' : '' }}">
                    <label class="col-sm-3 control-label">Confirm Password:<span class="req_star">*</span></label>
                    <div class="col-sm-7">
                      <input type="password" placeholder="Password" class="form-control" name="confirm-password" required>
                      @if ($errors->has('confirm-password'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('confirm-password') }}</strong>
                          </span>
                      @endif
                    </div>
                </div>

                <div class="form-group row custom_form_group{{ $errors->has('roles') ? ' has-error' : '' }}">
                    <label class="col-sm-3 control-label">Role:</label>
                    <div class="col-sm-7">
                      <select class="form-control" name="roles" required>
                        <option value="">Select Role</option>
                        @foreach ($roles as $role)
                          <option value="{{ $role }}">{{ $role }}</option>
                        @endforeach
                      </select>
                      @if ($errors->has('roles'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('roles') }}</strong>
                          </span>
                      @endif
                    </div>
                </div>
              </div>
              <div class="card-footer card_footer_button text-center">
                  <button type="submit" class="btn btn-primary waves-effect">SAVE</button>
              </div>
          </div>
        </form>
    </div>
  </div>
  {{-- main work --}}
@endsection
