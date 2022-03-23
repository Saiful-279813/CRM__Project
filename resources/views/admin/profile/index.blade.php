@extends('layouts.admin')
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
  {{-- response massage --}}
  <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8">
          @if(Session::has('user_info_update'))
            <div class="alert alert-success alertsuccess" role="alert">
               <strong>Successfully!</strong> Update User Information.
            </div>
          @endif

          @if(Session::has('success__image__upload'))
            <div class="alert alert-success alertsuccess" role="alert">
               <strong>Successfully!</strong> Update User Image.
            </div>
          @endif

          @if(Session::has('error'))
            <div class="alert alert-warning alerterror" role="alert">
               <strong>Opps!</strong> please try again.
            </div>
          @endif
      </div>
      <div class="col-md-2"></div>
  </div>
  {{-- response massage --}}

  <div class="row">
    {{-- form part --}}
    <div class="col-lg-3">
      {{-- do work --}}
      <div class="card">
        <ul class="list-group list-group-flush">
          <li class="list-group-item text-center">
            @if(Auth::user()->upload_photo_path == NULL)
              <img src="{{asset('uploads/avatar/avatar-black.png')}}" alt="" style="width:100px; height:100px; border-radius: 50%; border:1px solid #333">
            @else
              <img src="{{ asset(Auth::user()->upload_photo_path) }}" alt="" style="width:100px; height:100px; border-radius: 50%; border:1px solid #333">
            @endif
          </li>
          <li class="list-group-item">
            <a class="dropdown-item custom_dropdown-item" href="{{ route('admin.profile') }}"><i class="md fas fa-home mr-2"></i>Home</a>
          </li>
          <li class="list-group-item">
            <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="dropdown-item custom_dropdown-item"><i class="md fas fa-power-off mr-2"></i> Logout</a>
          </li>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>


        </ul>
      </div>
      {{-- do work --}}
    </div>

    <div class="col-lg-9">
      <div class="row">
        {{-- information --}}
        <div class="col-md-12">
          {{-- do work --}}
          <form class="form-horizontal" id="brandFrom" method="post" action="{{ route('auth-user-info-update') }}" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h3 class="card-title card_top_title"><i class="fab fa-gg-circle"></i> Save & Change Your Information </h3>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="card-body card_form">

                  <div class="form-group row custom_form_group{{ $errors->has('name') ? ' has-error' : '' }}">
                      <label class="col-sm-3 control-label">Name:<span class="req_star">*</span></label>
                      <div class="col-sm-7">
                        <input type="text" placeholder="Enter Your Name" class="form-control" name="name" value="{{ Auth::user()->name }}" required>
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
                        <input type="email" placeholder="Enter Your Email" class="form-control" name="email" value="{{ Auth::user()->email }}" required>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                      </div>
                  </div>

                  <div class="form-group row custom_form_group{{ $errors->has('phone') ? ' has-error' : '' }}">
                      <label class="col-sm-3 control-label">Phone:<span class="req_star">*</span></label>
                      <div class="col-sm-7">
                        <input type="text" placeholder="Enter Your Phone" class="form-control" name="phone" value="{{ Auth::user()->phone }}" required max="11">
                        @if ($errors->has('phone'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                        @endif
                      </div>
                  </div>

                </div>
                <div class="card-footer card_footer_button text-center">
                    <button type="submit" class="btn btn-primary waves-effect">UPDATES</button>
                </div>
            </div>
          </form>
          {{-- do work --}}
        </div>
        {{-- password --}}
        <div class="col-md-12">
          {{-- do work --}}
          <form class="form-horizontal" id="brandFrom" method="post" action="{{ route('auth-user-password-update') }}" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h3 class="card-title card_top_title"><i class="fab fa-gg-circle"></i> Save & Change Your Password </h3>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="card-body card_form">

                  <div class="form-group row custom_form_group">
                      <label class="col-sm-3 control-label">Old Password:<span class="req_star">*</span></label>
                      <div class="col-sm-7">
                        <input type="password" placeholder="********" class="form-control" name="old_password" value="" required>
                      </div>
                  </div>

                  <div class="form-group row custom_form_group{{ $errors->has('new_password') ? ' has-error' : '' }}">
                      <label class="col-sm-3 control-label">Password:<span class="req_star">*</span></label>
                      <div class="col-sm-7">
                        <input type="password" placeholder="********" class="form-control" name="new_password" required>
                        @if ($errors->has('new_password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('new_password') }}</strong>
                            </span>
                        @endif
                      </div>
                  </div>

                  <div class="form-group row custom_form_group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                      <label class="col-sm-3 control-label">Confirm Password:<span class="req_star">*</span></label>
                      <div class="col-sm-7">
                        <input type="password" placeholder="********" class="form-control" name="password_confirmation" required>
                        @if ($errors->has('password_confirmation'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                      </div>
                  </div>

                </div>
                <div class="card-footer card_footer_button text-center">
                    <button type="submit" class="btn btn-primary waves-effect">UPDATES</button>
                </div>
            </div>
          </form>
          {{-- do work --}}
        </div>
        {{-- photo --}}
        <div class="col-md-12">
          {{-- do work --}}
          <form class="form-horizontal" id="brandFrom" method="post" action="{{ route('auth-user-image-update') }}" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h3 class="card-title card_top_title"><i class="fab fa-gg-circle"></i> Save & Change Your Photo </h3>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="card-body card_form">

                  <div class="form-group row custom_form_group">
                      <label class="col-sm-3 control-label">Banner Image:<span class="req_star">*</span></label>
                      <div class="col-sm-4">
                        <div class="input-group mb-2">
                            <span class="input-group-btn">
                                <span class="btn btn-default btn-file btnu_browse">
                                    Browse… <input type="file" name="image" id="imgInp3" accept="image/x-png,image/gif,image/jpeg" onchange="mainThambUrl(this)" required="Please Chose Image">
                                </span>
                            </span>
                            <input type="text" class="form-control" readonly>
                        </div>
                        <img src="" id="mainThmb">
                      </div>
                      <div class="col-md-3">
                        <img src="{{ asset(Auth::user()->upload_photo_path) }}" alt="No Image" width="150" height="150">
                      </div>
                  </div>

                </div>
                <div class="card-footer card_footer_button text-center">
                    <button type="submit" class="btn btn-primary waves-effect">UPLOADS</button>
                </div>
            </div>
          </form>
          {{-- do work --}}
        </div>
      </div>
    </div>
    {{-- form part --}}
   </div>
  {{-- do work --}}
@endsection
