@extends('layouts.admin')
@section('employee') active mm-active @endsection
@section('commision') active @endsection
@section('content')
  {{-- breadcrumb --}}
  <div class="row">
      <div class="col-12">
          <div class="page-title-box d-flex align-items-center justify-content-between">
              <h4 class="mb-0 font-size-18">Commision Payment</h4>
              <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                      <li class="breadcrumb-item active">Commision Payment</li>
                  </ol>
              </div>
          </div>
      </div>
  </div>
  {{-- response massege --}}
  <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8">
          @if(Session::has('requestSend'))
            <div class="alert alert-success alertsuccess" role="alert">
               <strong>Successfully!</strong> Send Your Request.
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
        <form class="form-horizontal" method="post" action="{{ route('commision.update',$data->id) }}" enctype="multipart/form-data" id="customerForm">
          @csrf
          @method('put')
          <div class="card">
            <div class="card-header custom-card-header">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="card-title card_top_title"><i class="fab fa-gg-circle"></i>Edit Commision Payment For Employee</h3>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="{{ route('commision.index') }}" class="btn btn-md btn-primary waves-effect card_top_button"><i class="fa fa-th"></i> Commision Payment List </a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="card-body card_form">

              <div class="form-group custom_form_group row">
                  <label class="control-label col-md-4">Employee Id:<span class="req_star">*</span></label>
                  <div class="col-md-5">
                      <select class="form-control search_select" name="employee_id" id="search_select" required>
                        <option value="">Select Employee</option>
                        @foreach ($employeeId as $employee)
                          <option value="{{ $employee->employee_id }}" {{ $employee->employee_id == $data->employee_id ? 'selected' : ''}}>{{ $employee->ID_Number }}</option>
                        @endforeach
                      </select>
                  </div>
              </div>

              <div class="form-group custom_form_group row">
                  <label class="control-label col-md-4">Commision Amount:<span class="req_star">*</span></label>
                  <div class="col-md-5">
                        <input type="text" placeholder="Amount" class="form-control" name="commision_amount" value="{{ $data->commision_amount }}" required data-parsley-pattern="[0-9]+$" min="0" data-parsley-length="[1,7]" data-parsley-trigger="keyup">
                        @error('commision_amount')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                  </div>
              </div>

              <div class="form-group custom_form_group row">
                  <label class="control-label col-md-4">Commision Reason:<span class="req_star">*</span></label>
                  <div class="col-md-5">

                        <textarea class="form-control" name="remarks" rows="4" cols="80" required placeholder="Commision Reason...">{{ $data->remarks }}</textarea>

                        @error('remarks')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                  </div>
              </div>

            </div>

            <div class="card-footer card_footer_button text-center">
                <button type="submit" class="btn btn-primary waves-effect">UPDATE</button>
            </div>
          </div>
          {{-- visa form --}}
        </form>
    </div>
  </div>
  {{-- main work --}}
@endsection
