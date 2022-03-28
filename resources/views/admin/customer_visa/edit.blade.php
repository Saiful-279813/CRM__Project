@extends('layouts.admin')
@section('customer') active mm-active @endsection
@section('customerVisa') active @endsection
@section('content')
  {{-- breadcrumb --}}
  <div class="row">
      <div class="col-12">
          <div class="page-title-box d-flex align-items-center justify-content-between">
              <h4 class="mb-0 font-size-18">Visa Information</h4>
              <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                      <li class="breadcrumb-item active">Visa Information</li>
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
               <strong>Successfully!</strong> Done First Step.
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
        <form class="form-horizontal" method="post" action="{{ route('customer-visa.edit',$data->customer_visa_id) }}" enctype="multipart/form-data" id="customerForm">
          @csrf

          <div class="card">
            <div class="card-header custom-card-header">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="card-title card_top_title"><i class="fab fa-gg-circle"></i> Visa Information</h3>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="{{ route('customer-visa.index') }}" class="btn btn-md btn-primary waves-effect card_top_button"><i class="fa fa-th"></i> Visa List </a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="card-body card_form">
                <div class="row">
                  <div class="form-group custom_form_group col-md-6 m-auto">
                      <label class="control-label">Visa Number:<span class="req_star">*</span></label>
                      <div class="">
                          <input type="text" placeholder="Visa Number" class="form-control" name="visa_number" value="{{ $data->visa_number }}" required data-parsley-pattern="[0-9]+$" min="0" data-parsley-length="[1,50]" data-parsley-trigger="keyup">
                          @error('visa_number')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                  <div class="form-group custom_form_group col-md-6 m-auto">
                      <label class="control-label">Passport Number:<span class="req_star">*</span></label>
                      <div class="">
                          <input type="text" placeholder="Passport Number" class="form-control" name="passport_number" value="{{ $data->passport_number }}" required data-parsley-pattern="[0-9]+$" min="0" data-parsley-length="[1,50]" data-parsley-trigger="keyup">
                          @error('passport_number')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group custom_form_group col-md-6 m-auto">
                      <label class="control-label">From Date:<span class="req_star">*</span></label>
                      <div class="">
                          <input type="date" class="form-control" name="from_date" value="{{ $data->from_date == "" ? Carbon\Carbon::now()->format('Y-m-d') : $data->from_date }}" required>
                          @error('from_date')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                  <div class="form-group custom_form_group col-md-6 m-auto">
                      <label class="control-label">To Date:<span class="req_star">*</span></label>
                      <div class="">
                          <input type="date" class="form-control" name="to_date" value="{{ $data->to_date == "" ? Carbon\Carbon::now()->format('Y-m-d') : $data->to_date }}" required>
                          @error('to_date')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                </div>
            </div>

              <div class="card-footer card_footer_button text-center">
                  <button type="submit" class="btn btn-primary waves-effect">SAVE</button>
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
