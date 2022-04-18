@extends('layouts.admin')
@section('content')
  {{-- breadcrumb --}}
  <div class="row">
      <div class="col-12">
          <div class="page-title-box d-flex align-items-center justify-content-between">
              <h4 class="mb-0 font-size-18">Month Work</h4>
              <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                      <li class="breadcrumb-item active">Month Work</li>
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
               <strong>Successfully!</strong> Added Employee Month Work Information.
            </div>
          @endif

          @if(Session::has('already_exist'))
            <div class="alert alert-success alerterror" role="alert">
               <strong>Opps!</strong> This Employee Month Work Information Alreay Assigned!.
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
        <form class="form-horizontal" method="post" action="{{ route('month-work.store') }}" enctype="multipart/form-data" id="customerForm">
          @csrf
          <div class="card">
            <div class="card-header custom-card-header">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="card-title card_top_title"><i class="fab fa-gg-circle"></i> Added Month Work Information</h3>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="card-body card_form">
                <div class="form-group custom_form_group row mb-3">
                    <label class="col-sm-4 col-form-label col_form_label">Employee Name:<span class="req_star">*</span></label>
                    <div class="col-sm-5">
                        <select class="form-control" name="employee_id" id="search_select2" required>
                          <option value="">----Select Employee----</option>
                          @foreach ($employeeId as $value)
                            <option value="{{ $value->employee_id }}">{{ $value->employee_name }}({{ $value->ID_Number }})</option>
                          @endforeach
                        </select>
                        @error('employee_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group custom_form_group row mb-3">
                    <label class="col-sm-4 col-form-label col_form_label">Month:<span class="req_star">*</span></label>
                    <div class="col-sm-5">
                      <select class="form-control" name="month_name" required id="search_select3">
                        <option value="">----Select Month----</option>
                        @foreach ($months as $month)
                          <option value="{{ $month->month_id }}">{{ $month->month_name }}</option>
                        @endforeach
                      </select>
                    </div>
                </div>

                <div class="form-group custom_form_group row mb-3">
                    <label class="col-sm-4 col-form-label col_form_label">Year:<span class="req_star">*</span></label>
                    <div class="col-sm-5">
                      <select class="form-control" name="year" required id="search_select4">
                        <option value="">----Select Year----</option>
                        @foreach ($years as $value)
                          <option value="{{ $value }}">{{ $value }}</option>
                        @endforeach
                      </select>
                    </div>
                </div>

                <div class="form-group custom_form_group row mb-3">
                    <label class="col-sm-4 col-form-label col_form_label">Overtime Amount:<span class="req_star">*</span></label>
                    <div class="col-sm-5">
                        <input type="text" placeholder="Amount..." class="form-control" name="overtime_amount" value="{{old('overtime_amount')}}" required data-parsley-pattern="[0-9]+$" data-parsley-length="[0,15]" data-parsley-trigger="keyup">
                        @error('overtime_amount')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group custom_form_group row mb-3">
                    <label class="col-sm-4 col-form-label col_form_label">Deduction Amount:<span class="req_star">*</span></label>
                    <div class="col-sm-5">
                        <input type="text" placeholder="Amount..." class="form-control" name="deduction_amount" value="{{old('deduction_amount')}}" required data-parsley-pattern="[0-9]+$" data-parsley-length="[0,15]" data-parsley-trigger="keyup">
                        @error('deduction_amount')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group custom_form_group row mb-3">
                    <label class="col-sm-4 col-form-label col_form_label">Work Days:<span class="req_star">*</span></label>
                    <div class="col-sm-5">
                        <input type="text" placeholder="Work Days" class="form-control" name="total_work_day" value="{{old('total_work_day')}}" required data-parsley-pattern="[0-9]+$" data-parsley-max="30" data-parsley-trigger="keyup">
                        @error('total_work_day')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
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
    </script>
@endsection
