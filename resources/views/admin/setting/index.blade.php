@extends('layouts.backend_master')
@section('content')

<div class="row bread_part">
    <div class="col-sm-12 bread_col">
        <h4 class="pull-left page-title bread_title">Settings</h4>
        <ol class="breadcrumb pull-right">
            <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="active">Settings</li>
        </ol>
    </div>
</div>

{{-- response massage --}}
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        @if(Session::has('success_update'))
          <div class="alert alert-success alertsuccess" role="alert">
             <strong>Successfully!</strong> Update Setting Information.
          </div>
        @endif

        @if(Session::has('success_update_about_page'))
          <div class="alert alert-success alertsuccess" role="alert">
             <strong>Successfully!</strong> Update About Page Information.
          </div>
        @endif

        @if(Session::has('success_update_logo'))
          <div class="alert alert-success alertsuccess" role="alert">
             <strong>Successfully!</strong> Save & Change Main Logo.
          </div>
        @endif

        @if(Session::has('success_update_favicon'))
          <div class="alert alert-success alertsuccess" role="alert">
             <strong>Successfully!</strong> Save & Change Favicon.
          </div>
        @endif

        @if(Session::has('success_update_default'))
          <div class="alert alert-success alertsuccess" role="alert">
             <strong>Successfully!</strong> Save & Change Default Image.
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
      <form class="form-horizontal" id="brandFrom" method="post" action="{{ route('setting.information.update') }}" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="card-title card_top_title"><i class="fab fa-gg-circle"></i> Update Setting Information</h3>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="card-body card_form">

              <div class="form-group row custom_form_group{{ $errors->has('site_name') ? ' has-error' : '' }}">
                  <label class="col-sm-3 control-label">Site Name:<span class="req_star">*</span></label>
                  <div class="col-sm-7">
                    <input type="text" placeholder="Input Site Name" class="form-control" name="site_name" value="{{ $data->site_name }}" required>
                    @if ($errors->has('site_name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('site_name') }}</strong>
                        </span>
                    @endif
                  </div>
              </div>

              <div class="form-group row custom_form_group">
                  <label class="col-sm-3 control-label">Site Title:<span class="req_star">(Optional)</span></label>
                  <div class="col-sm-7">
                    <input type="text" placeholder="Input Site Title" class="form-control" name="site_title" value="{{ $data->site_title }}">
                  </div>
              </div>

              <div class="form-group row custom_form_group">
                  <label class="col-sm-3 control-label">Contact Number 1:<span class="req_star">(Optional)</span></label>
                  <div class="col-sm-7">
                    <input type="text" placeholder="Input Contact Number" class="form-control" name="phone" value="{{ $data->phone }}">
                  </div>
              </div>

              <div class="form-group row custom_form_group">
                  <label class="col-sm-3 control-label">Contact Number 2:<span class="req_star">(Optional)</span></label>
                  <div class="col-sm-7">
                    <input type="text" placeholder="Input Contact Number" class="form-control" name="phone2" value="{{ $data->phone2 }}">
                  </div>
              </div>

              <div class="form-group row custom_form_group">
                  <label class="col-sm-3 control-label">Email Address 1:<span class="req_star">(Optional)</span></label>
                  <div class="col-sm-7">
                    <input type="text" placeholder="Input Email Address" class="form-control" name="email" value="{{ $data->email }}">
                  </div>
              </div>

              <div class="form-group row custom_form_group">
                  <label class="col-sm-3 control-label">Email Address 2:<span class="req_star">(Optional)</span></label>
                  <div class="col-sm-7">
                    <input type="text" placeholder="Input Email Address" class="form-control" name="email2" value="{{ $data->email2 }}">
                  </div>
              </div>

              <div class="form-group row custom_form_group">
                  <label class="col-sm-3 control-label">Address:<span class="req_star">(Optional)</span></label>
                  <div class="col-sm-7">
                    <textarea name="address" rows="8" cols="80" class="form-control" placeholder="Input Company Adress">{{ $data->address }}</textarea>
                  </div>
              </div>

              <div class="form-group row custom_form_group">
                  <label class="col-sm-3 control-label">Website Link:<span class="req_star">(Optional)</span></label>
                  <div class="col-sm-7">
                    <input type="text" class="form-control" placeholder="Input Website Link" name="website_link" value="{{ $data->website_link }}">
                  </div>
              </div>

              <div class="form-group row custom_form_group">
                  <label class="col-sm-3 control-label">Copyright Name:<span class="req_star">(Optional)</span></label>
                  <div class="col-sm-7">
                    <input type="text" placeholder="Input Copyright Name" class="form-control" name="copyright_name" value="{{ $data->copyright_name }}">
                  </div>
              </div>

              <div class="form-group row custom_form_group">
                  <label class="col-sm-3 control-label">Copyright Massege:<span class="req_star">(Optional)</span></label>
                  <div class="col-sm-7">
                    <input type="text" placeholder="Input Copyright Massege" class="form-control" name="copyright_message" value="{{ $data->copyright_message }}">
                  </div>
              </div>

              <div class="form-group row custom_form_group">
                  <label class="col-sm-3 control-label">Copyright Url:<span class="req_star">(Optional)</span></label>
                  <div class="col-sm-7">
                    <input type="text" placeholder="Input Copyright Url" class="form-control" name="copyright_url" value="{{ $data->copyright_url }}">
                  </div>
              </div>

              <div class="form-group row custom_form_group">
                  <label class="col-sm-3 control-label">Design Develop By Name:<span class="req_star">(Optional)</span></label>
                  <div class="col-sm-7">
                    <input type="text" placeholder="Input Name" class="form-control" name="design_develop_by_name" value="{{ $data->design_develop_by_name }}">
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
{{-- image --}}
<div class="row">
    {{-- form part --}}
    <div class="col-lg-4">
      <form class="form-horizontal" id="brandFrom" method="post" action="{{ route('setting.logo.update') }}" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="card-title card_top_title"><i class="fab fa-gg-circle"></i> Main Logo </h3>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="card-body card_form">
              <div class="row">
                <div class="col-md-7">
                  <div class="form-group custom_form_group">
                      <label class="control-label">Main Logo:<span class="req_star">*</span></label>
                      <div class="">
                        <div class="input-group mb-2">
                            <span class="input-group-btn">
                                <span class="btn btn-default btn-file btnu_browse">
                                    Browse… <input type="file" name="logoimage" id="imgInp3" accept="image/x-png,image/gif,image/jpeg" onchange="mainThambUrl(this)" required="Please Chose Image">
                                </span>
                            </span>
                            <input type="text" class="form-control" readonly>
                        </div>
                        <img src="" id="mainThmb">
                      </div>
                  </div>
                </div>
                {{-- show image --}}
                <input type="hidden" name="oldLogo" value="{{ $data->logo }}">
                <div class="col-md-5">
                    <img src="{{ asset($data->logo) }}" alt="No Logo" style="width:100%">
                </div>
                {{-- show image --}}
              </div>

            </div>
            <div class="card-footer card_footer_button text-center">
                <button type="submit" class="btn btn-primary waves-effect">SAVE & CHANGE</button>
            </div>
        </div>
      </form>
    </div>
    {{-- form part --}}
    {{-- form part --}}
    <div class="col-lg-4">
      <form class="form-horizontal" id="brandFrom" method="post" action="{{ route('setting.default-image.update') }}" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="card-title card_top_title"><i class="fab fa-gg-circle"></i> Default Image </h3>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="card-body card_form">
              <div class="row">
                <div class="col-md-7">
                  <div class="form-group custom_form_group">
                      <label class="control-label">Default Image:<span class="req_star">*</span></label>
                      <div class="">
                        <div class="input-group mb-2">
                            <span class="input-group-btn">
                                <span class="btn btn-default btn-file btnu_browse">
                                    Browse… <input type="file" name="default_image" accept="image/x-png,image/gif,image/jpeg" onchange="mainThambUrl2(this)" required="Please Chose Image">
                                </span>
                            </span>
                            <input type="text" class="form-control" readonly>
                        </div>
                        <img src="" id="mainThmb2">
                      </div>
                  </div>
                </div>
                {{-- show image --}}
                <input type="hidden" name="oldDefaultImage" value="{{ $data->default_image }}">
                <div class="col-md-5">
                    <img src="{{ asset($data->default_image) }}" alt="No Default Image" style="width:100%">
                </div>
                {{-- show image --}}
              </div>

            </div>
            <div class="card-footer card_footer_button text-center">
                <button type="submit" class="btn btn-primary waves-effect">SAVE & CHANGE</button>
            </div>
        </div>
      </form>
    </div>
    {{-- form part --}}
    {{-- form part --}}
    <div class="col-lg-4">
      <form class="form-horizontal" id="brandFrom" method="post" action="{{ route('setting.fav_icon.update') }}" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="card-title card_top_title"><i class="fab fa-gg-circle"></i> Fav Icon </h3>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="card-body card_form">
              <div class="row">
                <div class="col-md-7">
                  <div class="form-group custom_form_group">
                      <label class="control-label">Fav Icon:<span class="req_star">*</span></label>
                      <div class="">
                        <div class="input-group mb-2">
                            <span class="input-group-btn">
                                <span class="btn btn-default btn-file btnu_browse">
                                    Browse… <input type="file" name="fav_icon" accept="image/x-png,image/gif,image/jpeg" onchange="mainThambUrl3(this)" required="Please Chose Image">
                                </span>
                            </span>
                            <input type="text" class="form-control" readonly>
                        </div>
                        <img src="" id="mainThmb3">
                      </div>
                  </div>
                </div>
                {{-- show image --}}
                <input type="hidden" name="oldFavicon" value="{{ $data->fav_icon }}">
                <div class="col-md-5">
                    <img src="{{ asset($data->fav_icon) }}" alt="No Favicon" style="width:100%">
                </div>
                {{-- show image --}}
              </div>

            </div>
            <div class="card-footer card_footer_button text-center">
                <button type="submit" class="btn btn-primary waves-effect">SAVE & CHANGE</button>
            </div>
        </div>
      </form>
    </div>
    {{-- form part --}}
</div>

{{-- **************** About Part **************** --}}
<div class="row">
    {{-- form part --}}
    <div class="col-lg-12">
      <form class="form-horizontal" id="aboutFrom" method="post" action="{{ route('about.information.update') }}" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="card-title card_top_title"><i class="fab fa-gg-circle"></i> Update About Page Information</h3>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="card-body card_form">

              <div class="form-group row custom_form_group{{ $errors->has('ab_page_title') ? ' has-error' : '' }}">
                  <label class="col-sm-3 control-label">Title:<span class="req_star">*</span></label>
                  <div class="col-sm-7">
                    <input type="text" placeholder="Input Title" class="form-control" name="ab_page_title" value="{{ $data->ab_page_title }}" required>
                    @if ($errors->has('ab_page_title'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('ab_page_title') }}</strong>
                        </span>
                    @endif
                  </div>
              </div>

              <div class="form-group row custom_form_group{{ $errors->has('ab_page_description') ? ' has-error' : '' }}">
                  <label class="col-sm-3 control-label">Description:<span class="req_star">*</span></label>
                  <div class="col-sm-7">
                    <textarea name="ab_page_description" class="form-control" rows="8" cols="80" placeholder="About Page Description">{{ $data->ab_page_description }}</textarea>
                    @if ($errors->has('ab_page_description'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('ab_page_description') }}</strong>
                        </span>
                    @endif
                  </div>
              </div>

              <div class="form-group row custom_form_group">
                  <label class="col-md-3 control-label">About Page Thumbnail:<span class="req_star">*</span></label>
                  <div class="col-md-4">
                    <div class="input-group mb-2">
                        <span class="input-group-btn">
                            <span class="btn btn-default btn-file btnu_browse">
                                Browse… <input type="file" name="ab_page_image" accept="image/x-png,image/gif,image/jpeg" onchange="mainThambUrl5(this)" required="Please Chose Image">
                            </span>
                        </span>
                        <input type="text" class="form-control" readonly>
                    </div>
                    <img src="" id="mainThmb5">
                  </div>
                  <input type="hidden" name="oldab_page_image" value="{{ $data->ab_page_image }}">
                  <div class="col-md-3">
                    <img src="{{ asset($data->ab_page_image) }}" alt="" width="150">
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
{{-- **************** About Part **************** --}}
@endsection
{{-- form validation activation --}}
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#brandFrom').parsley();
        });

        $(document).ready(function() {
            $('#aboutFrom').parsley();
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

        // show image
        function mainThambUrl5(input){
          if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e){
                $('#mainThmb5').attr('src',e.target.result).width(150)
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
