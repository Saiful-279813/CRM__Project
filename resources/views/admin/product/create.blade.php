@extends('layouts.backend_master')
@section('content')

<div class="row bread_part">
    <div class="col-sm-12 bread_col">
        <h4 class="pull-left page-title bread_title">Add New Product</h4>
        <ol class="breadcrumb pull-right">
            <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="active">Add New Product</li>
        </ol>
    </div>
</div>

{{-- response massage --}}
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        @if(Session::has('success_store'))
          <div class="alert alert-success alertsuccess" role="alert">
             <strong>Successfully!</strong> Added New Product.
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
      <form class="form-horizontal" id="categoryFrom" method="post" action="{{ route('products.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="card-title card_top_title"><i class="fab fa-gg-circle"></i> Add New Product</h3>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="{{ route('products.index') }}" class="btn btn-md btn-primary waves-effect card_top_button"><i class="fa fa-th"></i> Product List</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="card-body card_form">

              <div class="row">
                {{-- first column --}}
                <div class="col-md-6">
                  {{-- element --}}
                  <div class="form-group custom_form_group{{ $errors->has('brand_id') ? ' has-error' : '' }}">
                      <label class="control-label">Brand:<span class="req_star">*</span></label>
                      <div class="">
                        <select class="form-control" name="brand_id" required data-parsley-trigger="keyup">
                          <option value="">Select Brand</option>
                          @foreach ($brand as $data)
                            <option value="{{ $data->id }}">{{ $data->brand_name }}</option>
                          @endforeach
                        </select>

                        @if ($errors->has('brand_id'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('brand_id') }}</strong>
                            </span>
                        @endif
                      </div>
                  </div>
                  {{-- element --}}
                  <div class="form-group custom_form_group{{ $errors->has('subcategory_id') ? ' has-error' : '' }}">
                      <label class="control-label">Second Category:<span class="req_star">(Optional)</span></label>
                      <div class="">
                        <select class="form-control" name="subcategory_id">
                          <option value="">Select Second Category</option>

                        </select>

                        @if ($errors->has('subcategory_id'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('subcategory_id') }}</strong>
                            </span>
                        @endif
                      </div>
                  </div>
                  {{-- element --}}
                  <div class="form-group custom_form_group{{ $errors->has('product_name') ? ' has-error' : '' }}">
                      <label class="control-label">Product Name:<span class="req_star">*</span></label>
                      <div class="">
                        <input type="text" name="product_name" value="{{ old('product_name') }}" class="form-control" required data-parsley-trigger="keyup" placeholder="Input Product Name">

                        @if ($errors->has('product_name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('product_name') }}</strong>
                            </span>
                        @endif
                      </div>
                  </div>
                  {{-- element --}}
                  <div class="form-group custom_form_group{{ $errors->has('product_qty') ? ' has-error' : '' }}">
                      <label class="control-label">Product Quantity:<span class="req_star">*</span></label>
                      <div class="">
                        <input type="number" name="product_qty" value="{{ old('product_qty') }}" class="form-control" required="Input Integer Number(0-9)" data-parsley-trigger="keyup" data-parsley-pattern="[0-9]+$" placeholder="Input Product Quantity">

                        @if ($errors->has('product_qty'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('product_qty') }}</strong>
                            </span>
                        @endif
                      </div>
                  </div>
                  {{-- element --}}
                  <div class="form-group custom_form_group">
                      <label class="control-label">Product Size:<span class="req_star">*</span></label>
                      <div class="">
                        <input type="text" name="product_size" value="{{ old('product_size') }}" placeholder="Input Product Size" data-role="tagsinput">
                      </div>
                  </div>
                  {{-- element --}}
                  <div class="form-group custom_form_group{{ $errors->has('selling_price') ? ' has-error' : '' }}">
                      <label class="control-label">Selling Price:<span class="req_star">*</span></label>
                      <div class="">
                        <input type="number" name="selling_price" value="{{ old('selling_price') }}" class="form-control" required="Input Integer Number(0-9)" data-parsley-trigger="keyup" data-parsley-pattern="[0-9]+$" placeholder="Input Selling Price">

                        @if ($errors->has('selling_price'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('selling_price') }}</strong>
                            </span>
                        @endif
                      </div>
                  </div>
                  {{-- element --}}
                </div>
                {{-- second column --}}
                <div class="col-md-6">
                  {{-- element --}}
                  <div class="form-group custom_form_group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                      <label class="control-label">Category:<span class="req_star">*</span></label>
                      <div class="">
                        <select class="form-control" name="category_id" required data-parsley-trigger="keyup">
                          <option value="">Select Category</option>
                          @foreach ($category as $catg)
                            <option value="{{ $catg->id }}">{{ $catg->category_name }}</option>
                          @endforeach
                        </select>

                        @if ($errors->has('category_id'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('category_id') }}</strong>
                            </span>
                        @endif
                      </div>
                  </div>
                  {{-- element --}}
                  <div class="form-group custom_form_group{{ $errors->has('thirdcategory_id') ? ' has-error' : '' }}">
                      <label class="control-label">Third Category:<span class="req_star">(Optional)</span></label>
                      <div class="">
                        <select class="form-control" name="thirdcategory_id">
                          <option value="">Select Third Category</option>
                        </select>
                        @if ($errors->has('thirdcategory_id'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('thirdcategory_id') }}</strong>
                            </span>
                        @endif
                      </div>
                  </div>
                  {{-- element --}}
                  <div class="form-group custom_form_group{{ $errors->has('product_code') ? ' has-error' : '' }}">
                      <label class="control-label">Product Code:<span class="req_star">*</span></label>
                      <div class="">
                        <input type="text" name="product_code" value="{{ $code }}" class="form-control" required data-parsley-trigger="keyup" placeholder="Input Product Code">

                        @if ($errors->has('product_code'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('product_code') }}</strong>
                            </span>
                        @endif
                      </div>
                  </div>
                  {{-- element --}}
                  <div class="form-group custom_form_group{{ $errors->has('product_tags') ? ' has-error' : '' }}">
                      <label class="control-label">Product Tags:<span class="req_star">*</span></label>
                      <div class="">
                        <input type="text" name="product_tags" value="{{ old('product_tags') }}"  required data-parsley-trigger="keyup" placeholder="Input Product Tags" data-role="tagsinput">

                        @if ($errors->has('product_tags'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('product_tags') }}</strong>
                            </span>
                        @endif
                      </div>
                  </div>
                  {{-- element --}}
                  <div class="form-group custom_form_group">
                      <label class="control-label">Product Color:<span class="req_star">*</span></label>
                      <div class="">
                        <input type="text" name="product_color" value="{{ old('product_color') }}" placeholder="Input Product Color" data-role="tagsinput">
                      </div>
                  </div>
                  {{-- element --}}
                  <div class="form-group custom_form_group{{ $errors->has('discount_price') ? ' has-error' : '' }}">
                      <label class="control-label">Discount Price:<span class="req_star">*</span></label>
                      <div class="">
                        <input type="number" name="discount_price" value="{{ old('discount_price') }}" class="form-control" required="Input Integer Number(0-9)" data-parsley-trigger="keyup" data-parsley-pattern="[0-9]+$" placeholder="Input Discount Price">

                        @if ($errors->has('discount_price'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('discount_price') }}</strong>
                            </span>
                        @endif
                      </div>
                  </div>
                  {{-- element --}}
                </div>
                {{-- uniq --}}
                <div class="col-md-6 m-auto">
                  <div class="form-group custom_form_group">
                      <label class="control-label">Tax:<span class="req_star">(%)</span></label>
                      <div class="">
                        <input type="number" name="tax" value="{{ old('tax') }}" required data-parsley-trigger="keyup" data-parsley-max="100" class="form-control" placeholder="Input Tax">
                      </div>
                  </div>
                </div>
                {{-- end row --}}
              </div>
              {{-- Description --}}
              <hr>
              <div class="row">
                {{-- element --}}
                <div class="form-group col-md-6 custom_form_group">
                    <label class="control-label">Short Description:<span class="req_star">(Optional)</span></label>
                    <div class="">
                      <textarea name="short_descp" rows="8" cols="80" class="form-control" placeholder="Input Short Description">{{ old('short_descp') }}</textarea>
                    </div>
                </div>
                {{-- element --}}
                <div class="form-group col-md-6 custom_form_group">
                    <label class="control-label">Long Description:<span class="req_star">(Optional)</span></label>
                    <div class="">
                      <textarea name="long_descp" rows="8" cols="80" class="form-control" placeholder="Input Long Description">{{ old('long_descp') }}</textarea>
                    </div>
                </div>
                {{-- element --}}
              </div>

              <hr>
              {{-- image part --}}
              <div class="row">
                <div class="form-group custom_form_group col-md-4 {{ $errors->has('product_thambnail') ? ' has-error' : '' }}">
                    <label class="control-label">Product Thumbnail:<span class="req_star">*</span></label>
                    <div>
                      <div class="input-group mb-2">
                          <span class="input-group-btn">
                              <span class="btn btn-default btn-file btnu_browse">
                                  Browse… <input type="file" name="product_thambnail" id="imgInp3" accept="image/x-png,image/gif,image/jpeg" onchange="mainThambUrl(this)">
                              </span>
                          </span>
                          <input type="text" class="form-control" readonly>
                      </div>
                      <img src="" id="mainThmb">
                      {{-- error --}}
                      @if ($errors->has('product_thambnail'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('product_thambnail') }}</strong>
                          </span>
                      @endif
                      {{-- error --}}
                    </div>
                </div>
                <div class="col-md-2"></div>
                {{-- multiple image --}}
                <div class="form-group custom_form_group col-md-4">
                    <label class="control-label">Product Multiple Image</label>
                    <div>
                      <div class="input-group mb-2">
                          <span class="input-group-btn">
                              <span class="btn btn-default btn-file btnu_browse">
                                  Browse… <input type="file" name="multi_img[]" accept="image/x-png,image/gif,image/jpeg" value="{{ old('multi_img') }}" multiple id="multiImg">
                              </span>
                          </span>
                          <input type="text" class="form-control" readonly>
                      </div>
                    </div>
                    {{-- show image --}}
                    <div class="row multiImgshow" id="preview_img"></div>
                    {{-- show image --}}
                </div>
                <div class="col-md-2"></div>
                {{-- ****** --}}
              </div>
              <hr>
              {{-- checkbox --}}
              <div class="row">
                  <div class="col-md-10 m-auto">
                      <div class="row">
                        {{-- checkbox --}}
                        <div class="col-md-3">
                          <label class="ckbox">
                              <input type="checkbox" name="featured" value="1"><span class="ml-2"> Featured </span>
                          </label>
                        </div>
                        {{-- checkbox --}}
                        <div class="col-md-3">
                          <label class="ckbox">
                              <input type="checkbox" name="special_offer" value="1"><span class="ml-2"> Special Offer</span>
                          </label>
                        </div>
                        {{-- checkbox --}}
                        <div class="col-md-3">
                          <label class="ckbox">
                              <input type="checkbox" name="hot_deals" value="1"><span class="ml-2"> Hot Deals</span>
                          </label>
                        </div>
                        {{-- checkbox --}}
                        <div class="col-md-3">
                          <label class="ckbox">
                              <input type="checkbox" name="special_deals" value="1"><span class="ml-2"> Special Deals</span>
                          </label>
                        </div>
                        {{-- checkbox --}}
                      </div>
                  </div>
              </div>



            </div>
            <div class="card-footer card_footer_button text-center">
                <button type="submit" class="btn btn-primary waves-effect">SAVE</button>
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
            $('#categoryFrom').parsley();
        });
    </script>
    {{-- ajax call --}}
    <script type="text/javascript">
      $(document).ready(function() {
        // category wise subcategory
        $('select[name="category_id"]').on('change', function(){
            var category_id = $(this).val();
            if(category_id) {
                $.ajax({
                    url: "{{  url('/admin/subcategory/list') }}/"+category_id,
                    type:"GET",
                    dataType:"json",
                    success:function(data) {
                      if(data == ""){
                        $('select[name="subcategory_id"]').empty();
                        $('select[name="subcategory_id"]').append('<option value="">Sub Category Not Found!</option>');

                        $('select[name="thirdcategory_id"]').empty();
                        $('select[name="thirdcategory_id"]').append('<option value="">Third Category Not Found!</option>');
                      }else{
                        $('select[name="subcategory_id"]').empty();
                        $('select[name="subcategory_id"]').append('<option value="">Select Second Category</option>');

                        $('select[name="thirdcategory_id"]').empty();
                        $('select[name="thirdcategory_id"]').append('<option value="">Select Third Category</option>');
                        // data load
                        $.each(data, function(key, value){
                          $('select[name="subcategory_id"]').append('<option value="'+ value.id +'">' + value.subcategory_name + '</option>');
                         });
                        // data load
                      }
                    },
                });
            }
        });
        // subcategory wise thirdcategory
        $('select[name="subcategory_id"]').on('change', function(){
            var subcategory_id = $(this).val();
            if(subcategory_id) {
                $.ajax({
                    url: "{{  url('/admin/thirdcategory/list') }}/"+subcategory_id,
                    type:"GET",
                    dataType:"json",
                    success:function(data) {
                      if(data == ""){
                        $('select[name="thirdcategory_id"]').empty();
                        $('select[name="thirdcategory_id"]').append('<option value="">Third Category Not Found!</option>');
                      }else{
                        $('select[name="thirdcategory_id"]').empty();
                        $('select[name="thirdcategory_id"]').append('<option value="">Select Third Category</option>');
                        // data load
                        $.each(data, function(key, value){
                          $('select[name="thirdcategory_id"]').append('<option value="'+ value.id +'">' + value.thirdcategory_name + '</option>');
                         });
                        // data load
                      }
                    },
                });
            }
        });
        /* ++++++++++++++++++++++++++++++++ */
      });

    </script>
    {{-- ajax call --}}
@endsection
