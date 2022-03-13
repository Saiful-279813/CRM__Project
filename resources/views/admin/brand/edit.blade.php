@extends('layouts.backend_master')
@section('brand') active @endsection
@section('brandChild') active @endsection
@section('content')

<div class="row bread_part">
    <div class="col-sm-12 bread_col">
        <h4 class="pull-left page-title bread_title">Edit Brand</h4>
        <ol class="breadcrumb pull-right">
            <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="active">Edit Brand</li>
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
      <form class="form-horizontal" id="brandFrom" method="post" action="{{ route('brand.update',$data->id) }}" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="card-title card_top_title"><i class="fab fa-gg-circle"></i> Edit Brand</h3>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="{{ route('brand.index') }}" class="btn btn-md btn-primary waves-effect card_top_button"><i class="fa fa-th"></i> Brand List</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="card-body card_form">
              <input type="hidden" name="oldImage" value="{{ $data->brand_image }}">
              <div class="form-group row custom_form_group{{ $errors->has('brand_name') ? ' has-error' : '' }}">
                  <label class="col-sm-3 control-label">Brand Name:<span class="req_star">*</span></label>
                  <div class="col-sm-7">
                    <input type="text" placeholder="Input Brand Name" class="form-control" name="brand_name" value="{{ $data->brand_name }}" required data-parsley-trigger="keyup">
                    @if ($errors->has('brand_name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('brand_name') }}</strong>
                        </span>
                    @endif
                  </div>
              </div>

              <div class="form-group row custom_form_group">
                  <label class="col-sm-3 control-label">Brand Image:(Optional)</label>
                  <div class="col-sm-4">
                    <div class="input-group mb-2">
                        <span class="input-group-btn">
                            <span class="btn btn-default btn-file btnu_browse">
                                Browse… <input type="file" name="image" id="imgInp3" accept="image/x-png,image/gif,image/jpeg" onchange="mainThambUrl(this)">
                            </span>
                        </span>
                        <input type="text" class="form-control" readonly>
                    </div>
                    <img src="" id="mainThmb">
                  </div>
                  <div class="col-md-3">
                    <img src="{{ asset($data->brand_image) }}" alt="No Image" width="150" height="120">
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
