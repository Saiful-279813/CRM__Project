@extends('layouts.backend_master')
@section('subcategory') active @endsection
@section('subcategoryChild') active @endsection
@section('content')

<div class="row bread_part">
    <div class="col-sm-12 bread_col">
        <h4 class="pull-left page-title bread_title">Edit Second Category</h4>
        <ol class="breadcrumb pull-right">
            <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="active">Second Category</li>
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
      <form class="form-horizontal" id="categoryFrom" method="post" action="{{ route('subcategory.update') }}" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="card-title card_top_title"><i class="fab fa-gg-circle"></i> Edit Second Category</h3>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="{{ route('subcategory.index') }}" class="btn btn-md btn-primary waves-effect card_top_button"><i class="fa fa-th"></i> Second Category List</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="card-body card_form">

              <input type="hidden" name="id" value="{{ $data->id }}">

              <div class="form-group row custom_form_group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                  <label class="col-sm-3 control-label">Category Name:<span class="req_star">*</span></label>
                  <div class="col-sm-7">
                    <select class="form-control" name="category_id" required data-parsley-trigger="keyup">
                      <option value="">Select Category</option>
                      @foreach ($category as $catg)
                        <option value="{{ $catg->id }}" {{ $catg->id == $data->category_id ? 'selected' : '' }}>{{ $catg->category_name }}</option>
                      @endforeach
                    </select>

                    @if ($errors->has('category_id'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('category_id') }}</strong>
                        </span>
                    @endif
                  </div>
              </div>

              <div class="form-group row custom_form_group{{ $errors->has('subcategory_name') ? ' has-error' : '' }}">
                  <label class="col-sm-3 control-label">Sub Category Name:<span class="req_star">*</span></label>
                  <div class="col-sm-7">
                    <input type="text" placeholder="Input Sub Category Name" class="form-control" name="subcategory_name" value="{{ $data->subcategory_name }}" required data-parsley-trigger="keyup">
                    @if ($errors->has('subcategory_name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('subcategory_name') }}</strong>
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
            $('#categoryFrom').parsley();
        });
    </script>
@endsection
