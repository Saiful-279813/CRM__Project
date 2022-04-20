@extends('layouts.admin')
@section('content')
  {{-- breadcrumb --}}
  <div class="row">
      <div class="col-12">
          <div class="page-title-box d-flex align-items-center justify-content-between">
              <h4 class="mb-0 font-size-18">Salary Generat</h4>
              <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                      <li class="breadcrumb-item active">Salary Generat</li>
                  </ol>
              </div>
          </div>
      </div>
  </div>
  {{-- response massege --}}
  <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8">

          @if(Session::has('save_and_change'))
            <div class="alert alert-success alertsuccess" role="alert">
               <strong>Successfully!</strong> Save & Change Employee Salary Information.
            </div>
          @endif

          @if(Session::has('success_store_salary_history'))
            <div class="alert alert-success alertsuccess" role="alert">
               <strong>Successfully!</strong> Processing In Salary.
            </div>
          @endif

          @if(Session::has('error'))
            <div class="alert alert-warning alerterror" role="alert">
               <strong>Opps!</strong> please try again.
            </div>
          @endif

          @if(Session::has('salary_report_not_assigned'))
            <div class="alert alert-warning alerterror" role="alert">
               <strong>Opps!</strong> This Month Not Assigned Salary Report In Monthly Work History.
            </div>
          @endif

      </div>
      <div class="col-md-2"></div>
  </div>
  {{-- main work --}}
  <div class="row">
    <div class="col-lg-12">
        <form class="form-horizontal" method="post" action="{{ route('all-employee-salary-process') }}" enctype="multipart/form-data" id="customerForm">
          @csrf
          <div class="card">
            <div class="card-header custom-card-header">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="card-title card_top_title"><i class="fab fa-gg-circle"></i> All Employee Salary Generat</h3>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="card-body card_form">
                <div class="row">
                  <div class="form-group custom_form_group col-md-6 m-auto">
                      <label class="control-label">Month Name:<span class="req_star">*</span></label>
                      <div class="">
                        <select class="form-control" name="month_name" required id="search_select3">
                          <option value="">Select Month</option>
                          @foreach ($months as $month)
                            <option value="{{ $month->month_id }}">{{ $month->month_name }}</option>
                          @endforeach
                        </select>
                      </div>
                  </div>
                </div>

                <div class="row">
                  <div class="form-group custom_form_group col-md-6 m-auto">
                      <label class="control-label">Year:<span class="req_star">*</span></label>
                      <div class="">
                        <select class="form-control" name="year" required id="search_select4">
                          <option value="">Select Year</option>
                          @foreach ($years as $value)
                            <option value="{{ $value }}">{{ $value }}</option>
                          @endforeach
                        </select>
                      </div>
                  </div>
                </div>


            </div>

              <div class="card-footer card_footer_button text-center">
                  <button type="submit" class="btn btn-primary waves-effect">PROCESS</button>
              </div>
          </div>
          {{-- visa form --}}
        </form>
    </div>
  </div>
  {{-- Single Employee --}}

  {{-- <div class="row">
    <div class="col-lg-12">
        <form class="form-horizontal" method="post" action="#" enctype="multipart/form-data" id="customerForm">
          @csrf
          <div class="card">
            <div class="card-header custom-card-header">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="card-title card_top_title"><i class="fab fa-gg-circle"></i> Single Employee Salary Generat</h3>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="card-body card_form">

                <div class="row">
                  <div class="form-group custom_form_group col-md-6 m-auto">
                      <label class="control-label">Employee Id:<span class="req_star">*</span></label>
                      <div class="">
                        <select class="form-control search_select" name="employee_id" id="search_select" required>
                          <option value="">Select Employee</option>
                          @foreach ($employeeId as $data)
                            <option value="{{ $data->employee_id }}">{{ $data->ID_Number }}</option>
                          @endforeach
                        </select>
                      </div>
                  </div>
                </div>

                <div class="row">
                  <div class="form-group custom_form_group col-md-6 m-auto">
                      <label class="control-label">Month Name:<span class="req_star">*</span></label>
                      <div class="">
                        <select class="form-control" name="month_name" id="search_select2" required>
                          <option value="">Select Month</option>
                          @foreach ($months as $month)
                            <option value="{{ $month->month_id }}">{{ $month->month_name }}</option>
                          @endforeach
                        </select>
                      </div>
                  </div>
                </div>

                <div class="row">
                  <div class="form-group custom_form_group col-md-6 m-auto">
                      <label class="control-label">Year:<span class="req_star">*</span></label>
                      <div class="">
                        <select class="form-control" name="year" required id="search_select5">
                          <option value="">Select Year</option>
                          @foreach ($years as $value)
                            <option value="{{ $value }}">{{ $value }}</option>
                          @endforeach
                        </select>
                      </div>
                  </div>
                </div>


            </div>

              <div class="card-footer card_footer_button text-center">
                  <button type="submit" class="btn btn-primary waves-effect">PROCESS</button>
              </div>
          </div>
          {{-- visa form --}}
        {{-- </form> --}}
    {{-- </div> --}}
  {{-- </div> --}}
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
