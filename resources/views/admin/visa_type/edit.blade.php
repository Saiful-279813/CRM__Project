@extends('layouts.admin')
@section('admin') active mm-active @endsection
@section('visa-type') active @endsection
@section('content')
  {{-- breadcrumb --}}
  <div class="row">
      <div class="col-12">
          <div class="page-title-box d-flex align-items-center justify-content-between">
              <h4 class="mb-0 font-size-18">Visa Type</h4>
              <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                      <li class="breadcrumb-item active">Visa Type</li>
                  </ol>
              </div>
          </div>
      </div>
  </div>
  {{-- response massege --}}
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
  {{-- main work --}}
  <div class="row">
    <div class="col-lg-12">
        <form class="form-horizontal" method="post" action="{{ route('visa-type.update',$data->visa_type_id) }}" enctype="multipart/form-data" id="customerForm">
          @csrf
          @method('put')
          <div class="card">
            <div class="card-header custom-card-header">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="card-title card_top_title"><i class="fab fa-gg-circle"></i> Edit Visa Type</h3>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="{{ route('visa-type.index') }}" class="btn btn-md btn-primary waves-effect card_top_button"><i class="fa fa-th"></i> Visa Type List </a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="card-body card_form">
              <div class="form-group custom_form_group row">
                  <label class="control-label col-md-3">Visa Type Name:<span class="req_star">*</span></label>
                  <div class="col-md-7">
                      <input type="text" placeholder="Visa Type Name" class="form-control" name="visa_type_name" value="{{ $data->visa_type_name }}" required data-parsley-pattern="[a-zA-Z_ ]+$" data-parsley-length="[3,50]" data-parsley-trigger="keyup">
                      @error('visa_type_name')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                  </div>
              </div>
              <div class="form-group custom_form_group row">
                  <label class="control-label col-md-3">Visa Type Remarks:<span class="req_star">*</span></label>
                  <div class="col-md-7">
                      <textarea rows="8" cols="80" placeholder="Visa Type Remarks" class="form-control" name="visa_type_remarks" required data-parsley-pattern="[a-zA-Z_ ]+$" data-parsley-length="[3,200]" data-parsley-trigger="keyup">{{ $data->visa_type_remarks }}</textarea>

                      @error('visa_type_remarks')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                  </div>
              </div>
            </div>

            <div class="card-footer card_footer_button text-center">
                <button type="submit" class="btn btn-primary waves-effect">UPDATE</button>
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
