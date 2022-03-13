@extends('layouts.backend_master')
@section('coupon') active @endsection
@section('couponChild') active @endsection

@section('content')

<div class="row bread_part">
    <div class="col-sm-12 bread_col">
        <h4 class="pull-left page-title bread_title">Edit Coupon</h4>
        <ol class="breadcrumb pull-right">
            <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="active">Edit Coupon</li>
        </ol>
    </div>
</div>

{{-- response massage --}}
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
{{-- response massage --}}

<div class="row">
    {{-- form part --}}
    <div class="col-lg-12">
      <form class="form-horizontal" id="brandFrom" method="post" action="{{ route('coupon.update',$data->id) }}" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="card-title card_top_title"><i class="fab fa-gg-circle"></i> Edit Coupon</h3>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="{{ route('coupon.index') }}" class="btn btn-md btn-primary waves-effect card_top_button"><i class="fa fa-th"></i> Coupon List</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="card-body card_form">

              <div class="form-group row custom_form_group{{ $errors->has('coupon_type') ? ' has-error' : '' }}">
                  <label class="col-sm-3 control-label">Coupon Type:<span class="req_star">*</span></label>
                  <div class="col-sm-7">
                    <select class="form-control" name="coupon_type" required data-parsley-trigger="keyup">
                      <option value="">Select Coupon Type</option>
                      <option value="1" {{ $data->coupon_type == 1 ? 'selected' : '' }}>Product Wise Coupon</option>
                      <option value="0" {{ $data->coupon_type == 0 ? 'selected' : '' }}>Order Wise Coupon</option>
                    </select>
                    @if ($errors->has('coupon_type'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('coupon_type') }}</strong>
                        </span>
                    @endif
                  </div>
              </div>

              <div class="form-group row custom_form_group{{ $errors->has('coupon_name') ? ' has-error' : '' }}">
                  <label class="col-sm-3 control-label">Coupon Name:<span class="req_star">*</span></label>
                  <div class="col-sm-7">
                    <input type="text" placeholder="Input Coupon Name" class="form-control" name="coupon_name" value="{{ $data->coupon_name }}" required data-parsley-trigger="keyup">
                    @if ($errors->has('coupon_name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('coupon_name') }}</strong>
                        </span>
                    @endif
                  </div>
              </div>

              <div class="form-group row custom_form_group{{ $errors->has('coupon_discount') ? ' has-error' : '' }}">
                  <label class="col-sm-3 control-label">Coupon Discount:<span class="req_star">*</span></label>
                  <div class="col-sm-7">
                    <input type="text" placeholder="Input Discount" class="form-control" name="coupon_discount" value="{{ $data->coupon_discount }}" required data-parsley-trigger="keyup" data-parsley-max="100">
                    @if ($errors->has('coupon_discount'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('coupon_discount') }}</strong>
                        </span>
                    @endif
                  </div>
              </div>

              <div class="form-group row custom_form_group{{ $errors->has('coupon_validity') ? ' has-error' : '' }}">
                  <label class="col-sm-3 control-label">Coupon Validity:<span class="req_star">*</span></label>
                  <div class="col-sm-7">
                    <input type="date" class="form-control" name="coupon_validity" value="{{ $data->coupon_validity }}" required data-parsley-trigger="keyup" min="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                    @if ($errors->has('coupon_validity'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('coupon_validity') }}</strong>
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
    {{-- form part --}}
</div>
@endsection
{{-- form validation activation --}}
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#brandFrom').parsley();
        });
    </script>
@endsection
