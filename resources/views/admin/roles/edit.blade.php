@extends('layouts.backend_master')
@section('content')
  {{-- breadcrumb --}}
  <div class="row bread_part">
      <div class="col-sm-12 bread_col">
          <h4 class="pull-left page-title bread_title">Edit Role</h4>
          <ol class="breadcrumb pull-right">
              <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
              <li class="active">Edit Role</li>
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
        <form class="form-horizontal" method="post" action="{{ route('roles.update', $role->id) }}">
          @csrf
          @method('PATCH')
          <div class="card">
              <div class="card-header">
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
                      <input type="text" placeholder="Name" class="form-control" name="name" value="{{ $role->name }}" required>
                      @if ($errors->has('name'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('name') }}</strong>
                          </span>
                      @endif
                    </div>
                </div>

                <div class="form-group row custom_form_group{{ $errors->has('permission') ? ' has-error' : '' }}">
                    <label class="col-sm-3 control-label">Permission:</label>

                    <div class="col-sm-7">
                      @foreach($permission as $value)
                        <label>
                          {{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                          {{ $value->name }}
                         </label>
                      @endforeach
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
