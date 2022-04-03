@extends('layouts.admin')
@section('admin') active mm-active @endsection
@section('blood') active @endsection
@section('content')
  {{-- breadcrumb --}}
  <div class="row">
      <div class="col-12">
          <div class="page-title-box d-flex align-items-center justify-content-between">
              <h4 class="mb-0 font-size-18">Blood Group</h4>
              <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                      <li class="breadcrumb-item active">Blood Group</li>
                  </ol>
              </div>
          </div>
      </div>
  </div>
  {{-- response massege --}}
  <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8">
          @if(Session::has('success_store'))
            <div class="alert alert-success alertsuccess" role="alert">
               <strong>Successfully!</strong> Create New Blood Group.
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
        <form class="form-horizontal" method="post" action="{{ route('blood.store') }}" enctype="multipart/form-data" id="customerForm">
          @csrf

          <div class="card">
            <div class="card-header custom-card-header">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="card-title card_top_title"><i class="fab fa-gg-circle"></i> Create New Blood Group</h3>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="{{ route('blood.index') }}" class="btn btn-md btn-primary waves-effect card_top_button"><i class="fa fa-th"></i> Blood Group List </a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="card-body card_form">
                <div class="row">
                  <div class="form-group custom_form_group col-md-6 m-auto">
                      <label class="control-label">Blood Group Name:<span class="req_star">*</span></label>
                      <div class="">
                          <input type="text" placeholder="Blood Group Name" class="form-control" name="name" value="{{old('name')}}" required>
                          @error('name')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group custom_form_group col-md-6 m-auto">
                      <label class="control-label">Remarks:</label>
                      <div class="">
                          <textarea name="remarks" rows="8" cols="80" class="form-control" placeholder="Remarks Here...">{{ old('remarks') }}</textarea>
                          @error('remarks')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                </div>
                {{-- Image --}}
            </div>

              <div class="card-footer card_footer_button text-center">
                  <button type="submit" class="btn btn-primary waves-effect">SAVE</button>
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
@endsection
