@extends('layouts.backend_master')
@section('banner') active @endsection
@section('bannerChild') active @endsection

@section('content')

<div class="row bread_part">
    <div class="col-sm-12 bread_col">
        <h4 class="pull-left page-title bread_title">Add New Banner</h4>
        <ol class="breadcrumb pull-right">
            <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="active">Add New Banner</li>
        </ol>
    </div>
</div>

{{-- response massage --}}
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        @if(Session::has('success_store'))
          <div class="alert alert-success alertsuccess" role="alert">
             <strong>Successfully!</strong> Added New Banner.
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
    <div class="col-lg-12">
      <form class="form-horizontal" id="brandFrom" method="post" action="{{ route('banner.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="card-title card_top_title"><i class="fab fa-gg-circle"></i> Add New Banner</h3>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="{{ route('banner.index') }}" class="btn btn-md btn-primary waves-effect card_top_button"><i class="fa fa-th"></i> Banner List</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="card-body card_form">

              <div class="form-group row custom_form_group">
                  <label class="col-sm-3 control-label">Banner Title:<span class="req_star">(Optional)</span></label>
                  <div class="col-sm-7">
                    <input type="text" placeholder="Input Banner Title" class="form-control" name="title" value="{{old('title')}}">
                  </div>
              </div>

              <div class="form-group row custom_form_group">
                  <label class="col-sm-3 control-label">Banner Content:<span class="req_star">(Optional)</span></label>
                  <div class="col-sm-7">
                    <input type="text" placeholder="Input Banner Content" class="form-control" name="description" value="{{old('description')}}">
                  </div>
              </div>

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
              </div>
            </div>
            <div class="card-footer card_footer_button text-center">
                <button type="submit" class="btn btn-primary waves-effect">UPLOADS</button>
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
