@extends('layouts.backend_master')
@section('content')

<div class="row bread_part">
    <div class="col-sm-12 bread_col">
        <h4 class="pull-left page-title bread_title">Others Banner</h4>
        <ol class="breadcrumb pull-right">
            <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="active">Others Banner</li>
        </ol>
    </div>
</div>

{{-- response massage --}}
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        @if(Session::has('success_special'))
          <div class="alert alert-success alertsuccess" role="alert">
             <strong>Successfully!</strong> Update Special Banner Information.
          </div>
        @endif

        @if(Session::has('success_newslatter'))
          <div class="alert alert-success alertsuccess" role="alert">
             <strong>Successfully!</strong> Update Newslatter Banner Information.
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
      <form class="form-horizontal" id="brandFrom" method="post" action="{{ route('specialBanner.update') }}" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="card-title card_top_title"><i class="fab fa-gg-circle"></i> Update Special Offer Banner</h3>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="card-body card_form">

              <div class="form-group row custom_form_group{{ $errors->has('special_offer_banner_title') ? ' has-error' : '' }}">
                  <label class="col-sm-3 control-label">Special Banner Title:<span class="req_star">*</span></label>
                  <div class="col-sm-7">
                    <input type="text" placeholder="Input Special Banner Title" class="form-control" name="special_offer_banner_title" value="{{ $data->special_offer_banner_title }}" required>
                    @if ($errors->has('special_offer_banner_title'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('special_offer_banner_title') }}</strong>
                        </span>
                    @endif
                  </div>
              </div>

              <div class="form-group row custom_form_group{{ $errors->has('special_offer_banner') ? ' has-error' : '' }}">
                  <label class="col-md-3 control-label">Special Banner:<span class="req_star">*</span></label>
                  <div class="col-md-4">
                    <div class="input-group mb-2">
                        <span class="input-group-btn">
                            <span class="btn btn-default btn-file btnu_browse">
                                Browse… <input type="file" name="special_offer_banner" id="imgInp3" accept="image/x-png,image/gif,image/jpeg" onchange="mainThambUrl(this)">
                            </span>
                        </span>
                        <input type="text" class="form-control" readonly>
                    </div>
                    <img src="" id="mainThmb">
                  </div>
                  <div class="col-md-3">
                    <img src="{{ asset($data->special_offer_banner) }}" alt="No Banner" style="width:100%">
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
{{-- newslatter banner --}}
<div class="row">
    {{-- form part --}}
    <div class="col-lg-12">
      <form class="form-horizontal" id="newslatter" method="post" action="{{ route('newslatterBanner.update') }}" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="card-title card_top_title"><i class="fab fa-gg-circle"></i> Update Newslatter Banner</h3>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="card-body card_form">

              <div class="form-group row custom_form_group{{ $errors->has('newslatter_banner_title') ? ' has-error' : '' }}">
                  <label class="col-sm-3 control-label">Newslatter Banner Title:<span class="req_star">*</span></label>
                  <div class="col-sm-7">
                    <input type="text" placeholder="Input Newslatter Banner Title" class="form-control" name="newslatter_banner_title" value="{{ $data->newslatter_banner_title }}" required>
                    @if ($errors->has('newslatter_banner_title'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('newslatter_banner_title') }}</strong>
                        </span>
                    @endif
                  </div>
              </div>

              <div class="form-group row custom_form_group">
                  <label class="col-sm-3 control-label">Newslatter Banner Content:<span class="req_star">*</span></label>
                  <div class="col-sm-7">
                    <input type="text" placeholder="Input Newslatter Banner Content" class="form-control" name="newslatter_banner_content" value="{{ $data->newslatter_banner_content }}">
                  </div>
              </div>

              <div class="form-group row custom_form_group">
                  <label class="col-sm-3 control-label">Newslatter Banner Url:<span class="req_star">*</span></label>
                  <div class="col-sm-7">
                    <input type="text" placeholder="Input Newslatter Banner Url" class="form-control" name="newslatter_banner_url" value="{{ $data->newslatter_banner_url }}">
                  </div>
              </div>

              <div class="form-group row custom_form_group{{ $errors->has('newslatter_banner') ? ' has-error' : '' }}">
                  <label class="col-md-3 control-label">Newslatter Banner:<span class="req_star">*</span></label>
                  <div class="col-md-4">
                    <div class="input-group mb-2">
                        <span class="input-group-btn">
                            <span class="btn btn-default btn-file btnu_browse">
                                Browse… <input type="file" name="newslatter_banner" id="imgInp3" accept="image/x-png,image/gif,image/jpeg" onchange="mainThambUrl2(this)">
                            </span>
                        </span>
                        <input type="text" class="form-control" readonly>
                    </div>
                    <img src="" id="mainThmb2">
                  </div>
                  <div class="col-md-3">
                    <img src="{{ asset($data->newslatter_banner) }}" alt="No Banner" style="width:100%">
                  </div>
              </div>
              {{-- banner background --}}
              <div class="form-group row custom_form_group{{ $errors->has('newslatter_banner_backgournd') ? ' has-error' : '' }}">
                  <label class="col-md-3 control-label">Newslatter Background Banner :<span class="req_star">*</span></label>
                  <div class="col-md-4">
                    <div class="input-group mb-2">
                        <span class="input-group-btn">
                            <span class="btn btn-default btn-file btnu_browse">
                                Browse… <input type="file" name="newslatter_banner_backgournd" id="imgInp3" accept="image/x-png,image/gif,image/jpeg" onchange="mainThambUrl3(this)">
                            </span>
                        </span>
                        <input type="text" class="form-control" readonly>
                    </div>
                    <img src="" id="mainThmb3">
                  </div>
                  <div class="col-md-3">
                    <img src="{{ asset($data->newslatter_banner_backgournd) }}" alt="No Banner" style="width:100%">
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

        $(document).ready(function() {
            $('#newslatter').parsley();
        });

        // show image
        function mainThambUrl2(input){
          if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e){
                $('#mainThmb2').attr('src',e.target.result).width(150)
                      .height(120);
            };
            reader.readAsDataURL(input.files[0]);
          }
        }

        function mainThambUrl3(input){
          if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e){
                $('#mainThmb3').attr('src',e.target.result).width(150)
                      .height(120);
            };
            reader.readAsDataURL(input.files[0]);
          }
        }
    </script>
@endsection
