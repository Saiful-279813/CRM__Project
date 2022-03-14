@extends('layouts.admin')
@section('admin') active mm-active @endsection
@section('userChild') active @endsection
@section('content')
  {{-- breadcrumb --}}
  <div class="row">
      <div class="col-12">
          <div class="page-title-box d-flex align-items-center justify-content-between">
              <h4 class="mb-0 font-size-18">Management User</h4>
              <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                      <li class="breadcrumb-item active">Management User</li>
                  </ol>
              </div>
          </div>
      </div>
  </div>
  {{-- response massege --}}
  <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8">
          @if(Session::has('error'))
            <div class="alert alert-warning alerterror" role="alert">
               <strong>Opps!</strong> please try again.
            </div>
          @endif
      </div>
      <div class="col-md-2"></div>
  </div>
  {{-- main work --}}
  <div class="row">
    <div class="col-lg-12">
        <form class="form-horizontal" method="post" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
          @csrf
          @method('PATCH')
          <div class="card">
              <div class="card-header custom-card-header">
                  <div class="row">
                      <div class="col-md-8">
                          <h3 class="card-title card_top_title"><i class="fab fa-gg-circle"></i> Edit User</h3>
                      </div>
                      <div class="col-md-4 text-right">
                          <a href="{{ route('users.index') }}" class="btn btn-md btn-primary waves-effect card_top_button"><i class="fa fa-th"></i> All User List </a>
                      </div>
                      <div class="clearfix"></div>
                  </div>
              </div>
              <div class="card-body card_form">
                <div class="form-group row custom_form_group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label class="col-sm-3 control-label">Name:<span class="req_star">*</span></label>
                    <div class="col-sm-7">
                      <input type="text" placeholder="Name" class="form-control" name="name" value="{{ $user->name }}" required>
                      @if ($errors->has('name'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('name') }}</strong>
                          </span>
                      @endif
                    </div>
                </div>

                <div class="form-group row custom_form_group{{ $errors->has('phone') ? ' has-error' : '' }}">
                    <label class="col-sm-3 control-label">Phone:<span class="req_star">*</span></label>
                    <div class="col-sm-7">
                      <input type="text" placeholder="Phone" class="form-control" name="phone" value="{{ $user->phone }}" required>
                      @if ($errors->has('phone'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('phone') }}</strong>
                          </span>
                      @endif
                    </div>
                </div>

                <div class="form-group row custom_form_group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label class="col-sm-3 control-label">Email:<span class="req_star">*</span></label>
                    <div class="col-sm-7">
                      <input type="email" placeholder="Email" class="form-control" name="email" value="{{ $user->email }}" required>
                      @if ($errors->has('email'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('email') }}</strong>
                          </span>
                      @endif
                    </div>
                </div>

                <div class="form-group row custom_form_group{{ $errors->has('roles') ? ' has-error' : '' }}">
                    <label class="col-sm-3 control-label">Role:<span class="req_star">*</span></label>
                    <div class="col-sm-7">
                      <select class="form-control" name="roles" required>
                        <option value="">Select Role</option>
                        @foreach ($roles as $role)
                          <option value="{{ $role }}" {{ $role == $userRole ? 'selected' : '' }}>{{ $role }}</option>
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
                  <button type="submit" class="btn btn-primary waves-effect">UPDATE</button>
              </div>
          </div>
        </form>
    </div>
  </div>
  {{-- main work --}}
@endsection
