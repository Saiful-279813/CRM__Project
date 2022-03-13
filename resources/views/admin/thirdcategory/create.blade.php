@extends('layouts.backend_master')
@section('thirdcategory') active @endsection
@section('thirdcategoryChild') active @endsection
@section('content')

<div class="row bread_part">
    <div class="col-sm-12 bread_col">
        <h4 class="pull-left page-title bread_title">Add New Third Category</h4>
        <ol class="breadcrumb pull-right">
            <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="active">Add New Third Category</li>
        </ol>
    </div>
</div>

{{-- response massage --}}
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        @if(Session::has('success_store'))
          <div class="alert alert-success alertsuccess" role="alert">
             <strong>Successfully!</strong> Added Third Category.
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
      <form class="form-horizontal" id="categoryFrom" method="post" action="{{ route('thirdcategory.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="card-title card_top_title"><i class="fab fa-gg-circle"></i> Add Third New Category</h3>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="{{ route('thirdcategory.index') }}" class="btn btn-md btn-primary waves-effect card_top_button"><i class="fa fa-th"></i> Third Category List</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="card-body card_form">

              <div class="form-group row custom_form_group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                  <label class="col-sm-3 control-label">Category Name:<span class="req_star">*</span></label>
                  <div class="col-sm-7">
                    <select class="form-control" name="category_id" required data-parsley-trigger="keyup">
                      <option value="">Select Category</option>
                      @foreach ($category as $data)
                        <option value="{{ $data->id }}">{{ $data->category_name }}</option>
                      @endforeach
                    </select>

                    @if ($errors->has('category_id'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('category_id') }}</strong>
                        </span>
                    @endif
                  </div>
              </div>

              <div class="form-group row custom_form_group{{ $errors->has('subcategory_id') ? ' has-error' : '' }}">
                  <label class="col-sm-3 control-label">Second Category Name:<span class="req_star">*</span></label>
                  <div class="col-sm-7">
                    <select class="form-control" name="subcategory_id" required data-parsley-trigger="keyup">
                      <option value="">Select Second Category</option>

                    </select>

                    @if ($errors->has('subcategory_id'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('subcategory_id') }}</strong>
                        </span>
                    @endif
                  </div>
              </div>

              <div class="form-group row custom_form_group{{ $errors->has('thirdcategory_name') ? ' has-error' : '' }}">
                  <label class="col-sm-3 control-label">Third Category Name:<span class="req_star">*</span></label>
                  <div class="col-sm-7">
                    <input type="text" placeholder="Input Third Category Name" class="form-control" name="thirdcategory_name" value="{{old('thirdcategory_name')}}" required data-parsley-trigger="keyup">
                    @if ($errors->has('thirdcategory_name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('thirdcategory_name') }}</strong>
                        </span>
                    @endif
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
                      }else{
                        $('select[name="subcategory_id"]').empty();
                        $('select[name="subcategory_id"]').append('<option value="">Select Second Category</option>');
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
      });

    </script>
    {{-- ajax call --}}
@endsection
