@extends('layouts.admin')
@section('employee') active mm-active @endsection
@section('salary') active @endsection
@section('content')
  {{-- breadcrumb --}}
  <div class="row">
      <div class="col-12">
          <div class="page-title-box d-flex align-items-center justify-content-between">
              <h4 class="mb-0 font-size-18">Employee Salary Information</h4>
              <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                      <li class="breadcrumb-item active">Employee Salary Information</li>
                  </ol>
              </div>
          </div>
      </div>
  </div>
  {{-- response massege --}}
  <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8">
          @if(Session::has('success_store_first_step'))
            <div class="alert alert-success alertsuccess" role="alert">
               <strong>Successfully!</strong> Done Fist Step.
            </div>
          @endif

          @if(Session::has('save_and_change'))
            <div class="alert alert-success alertsuccess" role="alert">
               <strong>Successfully!</strong> Save & Change Employee Salary Information.
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
        <form class="form-horizontal" method="post" action="{{ route('salary.update',$data->sdetails_id) }}" enctype="multipart/form-data" id="customerForm">
          @csrf
          @method('put')
          <div class="card">
            <div class="card-header custom-card-header">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="card-title card_top_title"><i class="fab fa-gg-circle"></i> Add Salary Information</h3>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="{{ route('salary.index') }}" class="btn btn-md btn-primary waves-effect card_top_button"><i class="fa fa-th"></i> All Salary List </a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="card-body card_form">
                <div class="row">
                  <div class="form-group custom_form_group col-md-6 m-auto">
                      <label class="control-label">Basic Salary:<span class="req_star">*</span></label>
                      <div class="">
                          <input type="text" placeholder="Amount" class="form-control" name="basic_amount" value="{{ $data->basic_amount }}" required data-parsley-pattern="[0-9]+$" min="0" data-parsley-length="[1,7]" data-parsley-trigger="keyup">
                          @error('basic_amount')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group custom_form_group col-md-6 m-auto">
                      <label class="control-label">Moblie Allowance:</label>
                      <div class="">
                          <input type="text" placeholder="Amount" class="form-control" name="mobile_allowance" value="{{ $data->mobile_allowance }}" required data-parsley-pattern="[0-9]+$" min="0" data-parsley-length="[1,7]" data-parsley-trigger="keyup">
                          @error('mobile_allowance')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group custom_form_group col-md-6 m-auto">
                      <label class="control-label">Othes Allowance:</label>
                      <div class="">
                          <input type="text" placeholder="Amount" class="form-control" name="others_allowance" value="{{ $data->others_allowance }}" required data-parsley-pattern="[0-9]+$" min="0" data-parsley-length="[1,7]" data-parsley-trigger="keyup">
                          @error('others_allowance')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                </div>
            </div>

              <div class="card-footer card_footer_button text-center">
                  <button type="submit" class="btn btn-primary waves-effect">SAVE & CHANGE</button>
              </div>
          </div>
          {{-- visa form --}}
        </form>
    </div>
  </div>
  {{-- main work --}}
@endsection

@section('scripts')
    <script type="text/javascript">
      /* ================ do work ================ */
      $(document).ready(function() {
          $('#customerForm').parsley();
      });
      /* ================ do work ================ */
    </script>
@endsection
