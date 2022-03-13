@extends('layouts.backend_master')
@section('content')

<div class="row bread_part">
    <div class="col-sm-12 bread_col">
        <h4 class="pull-left page-title bread_title">Report</h4>
        <ol class="breadcrumb pull-right">
            <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="active">Report</li>
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
    <div class="col-lg-6">
      <form class="form-horizontal" id="brandFrom" method="post" action="{{ route('selling-report') }}" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="card-title card_top_title"><i class="fab fa-gg-circle"></i> Selling Report</h3>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="card-body card_form">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group custom_form_group">
                      <label class="control-label">Form Date:<span class="req_star">*</span></label>
                      <div>
                        <input type="date" class="form-control" name="formDate" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                      </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group custom_form_group">
                      <label class="control-label">To Date:<span class="req_star">*</span></label>
                      <div>
                        <input type="date" class="form-control" name="toDate" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                      </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer card_footer_button text-center">
                <button type="submit" class="btn btn-primary waves-effect">PROCESS</button>
            </div>
        </div>
      </form>
    </div>
    {{-- form part --}}
    {{-- form part --}}
    <div class="col-lg-6">
      <form class="form-horizontal" id="brandFrom2" method="post" action="{{ route('reject-report') }}" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="card-title card_top_title"><i class="fab fa-gg-circle"></i> Return Report</h3>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="card-body card_form">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group custom_form_group">
                      <label class="control-label">Form Date:<span class="req_star">*</span></label>
                      <div>
                        <input type="date" class="form-control" name="formDate" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                      </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group custom_form_group">
                      <label class="control-label">To Date:<span class="req_star">*</span></label>
                      <div>
                        <input type="date" class="form-control" name="toDate" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                      </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer card_footer_button text-center">
                <button type="submit" class="btn btn-primary waves-effect">PROCESS</button>
            </div>
        </div>
      </form>
    </div>
    {{-- form part --}}
</div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#brandFrom').parsley();
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#brandFrom2').parsley();
        });
    </script>
@endsection
