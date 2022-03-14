@extends('layouts.admin')
@section('admin') active mm-active @endsection
@section('role') active @endsection
@section('content')
  {{-- breadcrumb --}}
  <div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18"> User Role</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">User Role</li>
                </ol>
            </div>
        </div>
    </div>
  </div>
  {{-- response massege --}}
  <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8">
          @if(Session::has('store_success'))
            <div class="alert alert-success alertsuccess" role="alert">
               <strong>Successfully!</strong> Create New User Role.
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
  {{-- main work --}}
  <div class="row">
    <div class="col-lg-12">
        <form class="form-horizontal" method="post" action="{{ route('roles.store') }}" enctype="multipart/form-data">
          @csrf
          <div class="card">
              <div class="card-header custom-card-header">
                  <div class="row">
                      <div class="col-md-8">
                          <h3 class="card-title card_top_title"><i class="fab fa-gg-circle"></i> Add New Role</h3>
                      </div>
                      <div class="col-md-4 text-right">
                          <a href="{{ route('roles.index') }}" class="btn btn-md btn-primary waves-effect card_top_button"><i class="fa fa-th"></i> All Role List </a>
                      </div>
                      <div class="clearfix"></div>
                  </div>
              </div>
              <div class="card-body card_form">

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

                <div class="form-group row custom_form_group">
                    <label class="col-sm-3 control-label">Permission:</label>
                </div>

                <div class="form-group row custom_form_group{{ $errors->has('permission') ? ' has-error' : '' }}">
                    <div class="col-md-2"></div>
                    <div class="col-sm-10">
                      <div class="row">
                        @foreach($permission as $value)
                          <div class="col-md-3">
                            <label>
                              {{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                              {{ $value->name }}
                            </label>
                          </div>
                        @endforeach
                      </div>

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
