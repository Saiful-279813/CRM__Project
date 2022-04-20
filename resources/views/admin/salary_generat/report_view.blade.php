@extends('layouts.admin')
@section('salary') active mm-active @endsection
@section('salaryReport') active @endsection
@section('content')
  {{-- breadcrumb --}}
  <div class="row">
      <div class="col-12">
          <div class="page-title-box d-flex align-items-center justify-content-between">
              <h4 class="mb-0 font-size-18">Employee Salary Report</h4>
              <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                      <li class="breadcrumb-item active">Employee Salary Report</li>
                  </ol>
              </div>
          </div>
      </div>
  </div>
  {{-- main work --}}
  <div class="row">
    <div class="col-lg-12">

          <div class="card">
            <div class="card-header custom-card-header">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="card-title card_top_title"><i class="fab fa-gg-circle"></i> View Employee Salary Report</h3>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="{{ route('salary-report') }}" class="btn btn-md btn-primary waves-effect card_top_button"><i class="fa fa-th"></i> Salary Report Generat </a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="card-body">
              {{-- do work --}}
              <div class="row">
                <div class="col-md-2">
                  <div class="form-group custom_form_group">
                      <div class="text-center">
                        <img src="{{ asset($data->profile_photo) }}" alt="" class="img-fluid" style="border-radius:50%; width:100px">
                      </div>
                  </div>
                </div>
                <div class="col-md-8">
                    <table class="table table-bordered table-striped table-hover dt-responsive nowrap custom_view_table">
                        <tr>
                          <td>Salary Month</td>
                          <td>:</td>
                          <td>{{$data->month_name}}==={{ $data->slh_year }}</td>
                        </tr>

                        <tr>
                          <td>Employee</td>
                          <td>:</td>
                          <td>{{$data->employee_name}}({{ $data->ID_Number }})</td>
                        </tr>

                        <tr>
                          <td>Basic Salary</td>
                          <td>:</td>
                          <td>{{$data->basic_amount}} TK</td>
                        </tr>
                        <tr>
                          <td>Mobile Allowance</td>
                          <td>:</td>
                          <td>{{$data->mobile_allowance}} TK</td>
                        </tr>
                        <tr>
                          <td>Medical Allowance</td>
                          <td>:</td>
                          <td>{{$data->medical_allowance}} TK</td>
                        </tr>
                        <tr>
                          <td>House Allowance</td>
                          <td>:</td>
                          <td>{{$data->house_allowance}} TK</td>
                        </tr>
                        <tr>
                          <td>Others Allowance</td>
                          <td>:</td>
                          <td>{{$data->others_allowance}} TK</td>
                        </tr>
                        <tr>
                          <td>Total Salary</td>
                          <td>:</td>
                          <td>{{$data->total_salary}} TK</td>
                        </tr>
                        <tr>
                          <td>Incrment</td>
                          <td>:</td>
                          <td>{{$data->increment_no}}(Total Incrment) <br> {{ $data->increment_amount }}TK (Total Amount) </td>
                        </tr>
                        <tr>
                          <td>Advance</td>
                          <td>:</td>
                          <td>{{$data->slh_advance}}(Total Advance) <br> {{ $data->slh_advance_amount }}TK (Total Amount) </td>
                        </tr>

                        <tr>
                          <td>Commision</td>
                          <td>:</td>
                          <td>{{ $data->slh_commision }} (Total Commision) <br> {{ $data->slh_commision_amount }}TK (Total Amount)  </td>
                        </tr>

                        <tr>
                          <td>Overtime Amount</td>
                          <td>:</td>
                          <td>{{$data->slh_overtime_amount}} TK</td>
                        </tr>
                        <tr>
                          <td>Deduction Amount</td>
                          <td>:</td>
                          <td>{{$data->deduction_amount}} TK</td>
                        </tr>
                        <tr>
                          <td>Working Days</td>
                          <td>:</td>
                          <td>{{$data->slh_total_working_days}}</td>
                        </tr>
                        <tr>
                          <td>Salary Processing Date</td>
                          <td>:</td>
                          <td>{{$data->slh_salary_date}}</td>
                        </tr>
                        <tr>
                          <td>Salary Status</td>
                          <td>:</td>
                          <td>{{$data->status}}</td>
                        </tr>

                    </table>
                </div>
              </div>

              {{-- do work --}}
            </div>
            {{-- <div class="card-footer card_footer_button text-center">
                <a href="#" class="btn btn-primary waves-effect">PDF Or Print</a>
            </div> --}}
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
