@extends('layouts.admin')
@section('customer') active mm-active @endsection
@section('customer_child') active @endsection
@section('content')
  {{-- breadcrumb --}}
  <div class="row">
      <div class="col-12">
          <div class="page-title-box d-flex align-items-center justify-content-between">
              <h4 class="mb-0 font-size-18">Customer</h4>
              <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                      <li class="breadcrumb-item active">Customer</li>
                  </ol>
              </div>
          </div>
      </div>
  </div>
  {{-- response massege --}}
  <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8">
          @if(Session::has('success_store'))
            <div class="alert alert-success alertsuccess" role="alert">
               <strong>Successfully!</strong> Create New Customer.
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
        <form class="form-horizontal" method="post" action="{{ route('customers.store') }}" enctype="multipart/form-data" id="customerForm">
          @csrf

          <div class="card">
            <div class="card-header custom-card-header">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="card-title card_top_title"><i class="fab fa-gg-circle"></i> Create New Customer</h3>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="{{ route('customers.index') }}" class="btn btn-md btn-primary waves-effect card_top_button"><i class="fa fa-th"></i> All Customer List </a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="card-body card_form">
                <div class="row">
                  <div class="form-group custom_form_group col-md-8 m-auto">
                      <label class="control-label">Customer Id No:<span class="req_star">*</span></label>
                      <div class="">
                          <input type="text" placeholder="{{ $customerIdNo }}" class="form-control" disabled>
                          <input type="hidden" class="form-control" name="customer_id_number" value="{{ $customerIdNo }}">
                      </div>
                  </div>
                </div>

                <div class="row">
                  <div class="form-group custom_form_group col-md-6">
                      <label class="control-label">Name:<span class="req_star">*</span></label>
                      <div class="">
                          <input type="text" placeholder="Name" class="form-control" name="customer_name" value="{{old('customer_name')}}" required data-parsley-pattern="[a-zA-Z_ ]+$" data-parsley-length="[3,50]" data-parsley-trigger="keyup">
                          @error('customer_name')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                  <div class="form-group custom_form_group col-md-6">
                      <label class="control-label">Father Name:<span class="req_star">*</span></label>
                      <div class="">
                          <input type="text" placeholder="Father Name" class="form-control" name="customer_father" value="{{old('customer_father')}}" required data-parsley-pattern="[a-zA-Z_ ]+$" data-parsley-length="[3,50]" data-parsley-trigger="keyup">
                          @error('customer_father')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                </div>

                <div class="row">
                  <div class="form-group custom_form_group col-md-6">
                      <label class=" control-label">Phone Number:<span class="req_star">*</span></label>
                      <div class="">
                          <input type="text" placeholder="Phone" class="form-control" name="customer_phone" value="{{old('customer_phone')}}" required data-parsley-pattern="[0-9]+$" data-parsley-length="[11,15]" data-parsley-trigger="keyup">
                          @error('customer_phone')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>

                  <div class="form-group custom_form_group col-md-6">
                      <label class="control-label">Email Address:</label>
                      <div class="">
                          <input type="email" placeholder="Email" class="form-control" name="customer_email" value="{{old('customer_email')}}" data-parsley-length="[10,50]" data-parsley-trigger="keyup">
                      </div>
                  </div>
                </div>

                <div class="row">
                  <div class="form-group custom_form_group col-md-6">
                      <label class="control-label">Total Cost:<span class="req_star">*</span></label>
                      <div class="">
                          <input type="text" placeholder="Amount" class="form-control" name="total_cost" value="{{old('total_cost')}}" required data-parsley-pattern="[0-9]+$" data-parsley-length="[1,15]" data-parsley-trigger="keyup">
                          @error('total_cost')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>

                  <div class="form-group custom_form_group col-md-6">
                      <label class="control-label">Payment:<span class="req_star">*</span></label>
                      <div class="">
                          <input type="text" placeholder="Amount" class="form-control" name="payment" value="{{old('payment')}}" required data-parsley-pattern="[0-9]+$" data-parsley-length="[1,15]" data-parsley-trigger="keyup">
                          @error('payment')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                </div>

                <div class="row">
                  <div class="form-group custom_form_group col-md-6">
                      <label class="control-label">Due:<span class="req_star">*</span></label>
                      <div class="">
                          <input type="text" placeholder="Amount" class="form-control" name="due" value="{{old('due')}}" required data-parsley-pattern="[0-9]+$" data-parsley-length="[1,15]" data-parsley-trigger="keyup">
                          @error('due')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>

                  <div class="form-group custom_form_group col-md-6">
                      <label class="control-label">Apply Date:<span class="req_star">*</span></label>
                      <div class="">
                          <input type="date" class="form-control" name="apply_date" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" required>
                      </div>
                  </div>
                </div>

                <div class="form-group custom_form_group">
                    <label class="control-label">Address:<span class="req_star">*</span></label>
                    <div class="">
                        <textarea name="customer_address" rows="8" cols="80" class="form-control" placeholder="Address Here..." required data-parsley-pattern="[a-zA-Z0-9]+$" data-parsley-length="[10,255]"
                          data-parsley-trigger="keyup">{{ old('customer_address') }}</textarea>
                        @error('customer_address')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                  <div class="form-group col-md-4 m-auto mb-3">
                    <label class="col-form-label col_form_label">Photo:</label>
                    <div class="">
                      <div class="input-group">
                          <span class="input-group-btn">
                              <span class="btn btn-default btn-file btnu_browse">
                                  Browse… <input type="file" name="pic" id="imgInp">
                              </span>
                          </span>
                          <input type="text" class="form-control" readonly>
                      </div>
                      <img id="img-upload"/>
                    </div>
                  </div>
                </div>
            </div>

              <div class="card-footer card_footer_button text-center">
                  <button type="submit" class="btn btn-primary waves-effect">NEXT</button>
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
