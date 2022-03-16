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
          @if(Session::has('store_success'))
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
        <form class="form-horizontal" method="post" action="{{ route('customers.store') }}" enctype="multipart/form-data" id="customer_form">
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

                <div class="form-group row custom_form_group">
                    <label class="col-sm-3 control-label">Name:<span class="req_star">*</span></label>
                    <div class="col-sm-7">
                      <input type="text" placeholder="Name" class="form-control" name="customer_name" value="{{old('customer_name')}}">
                      <span class="text-danger error-text customer_name_error"></span>
                    </div>
                </div>

                <div class="form-group row custom_form_group">
                    <label class="col-sm-3 control-label">Father Name:<span class="req_star">*</span></label>
                    <div class="col-sm-7">
                      <input type="text" placeholder="Father Name" class="form-control" name="customer_father" value="{{old('customer_father')}}">
                      <span class="text-danger error-text customer_father_error"></span>
                    </div>
                </div>

                <div class="form-group row custom_form_group">
                    <label class="col-sm-3 control-label">Phone Number:<span class="req_star">*</span></label>
                    <div class="col-sm-7">
                      <input type="text" placeholder="Phone" class="form-control" name="customer_phone" value="{{old('customer_phone')}}">
                      <span class="text-danger error-text customer_phone_error"></span>
                    </div>
                </div>

                <div class="form-group row custom_form_group">
                    <label class="col-sm-3 control-label">Email Address:</label>
                    <div class="col-sm-7">
                      <input type="email" placeholder="Email" class="form-control" name="customer_email" value="{{old('customer_email')}}">
                    </div>
                </div>

                <div class="form-group row custom_form_group">
                    <label class="col-sm-3 control-label">Total Cost:<span class="req_star">*</span></label>
                    <div class="col-sm-7">
                      <input type="text" placeholder="Amount" class="form-control" name="total_cost" value="{{old('total_cost')}}">
                      <span class="text-danger error-text total_cost_error"></span>
                    </div>
                </div>

                <div class="form-group row custom_form_group">
                    <label class="col-sm-3 control-label">Payment:<span class="req_star">*</span></label>
                    <div class="col-sm-7">
                      <input type="text" placeholder="Amount" class="form-control" name="payment" value="{{old('payment')}}">
                      <span class="text-danger error-text payment_error"></span>
                    </div>
                </div>

                <div class="form-group row custom_form_group">
                    <label class="col-sm-3 control-label">Due:<span class="req_star">*</span></label>
                    <div class="col-sm-7">
                      <input type="text" placeholder="Amount" class="form-control" name="due" value="{{old('due')}}">
                      <span class="text-danger error-text due_error"></span>
                    </div>
                </div>

                <div class="form-group row custom_form_group">
                    <label class="col-sm-3 control-label">Apply Date:<span class="req_star">*</span></label>
                    <div class="col-sm-7">
                      <input type="date" class="form-control" name="apply_date" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                      <span class="text-danger error-text apply_date_error"></span>
                    </div>
                </div>

                <div class="form-group row custom_form_group">
                    <label class="col-sm-3 control-label">Address:<span class="req_star">*</span></label>
                    <div class="col-sm-7">
                      <textarea name="customer_address" rows="8" cols="80" class="form-control" placeholder="Address Here...">{{ old('customer_address') }}</textarea>
                      <span class="text-danger error-text apply_date_error"></span>
                    </div>
                </div>

                <div class="form-group row mb-3">
                  <label class="col-sm-3 control-label">Photo:<span class="req_star">*</span></label>
                  <div class="col-sm-4">
                    <div class="input-group">
                        <span class="input-group-btn">
                            <span class="btn btn-default btn-file btnu_browse">
                                Browse… <input type="file" name="customer_photo" id="imgInp">
                            </span>
                        </span>
                        <input type="text" class="form-control" readonly>
                    </div>
                    <img id="img-upload"/>
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

@section('scripts')
    <script type="text/javascript">
      /* ================ do work ================ */
      $(function(){
        
      });
      /* ================ do work ================ */
    </script>
@endsection
