@extends('layouts.admin')
@section('content')
  {{-- breadcrumb --}}
  <div class="row">
      <div class="col-12">
          <div class="page-title-box d-flex align-items-center justify-content-between">
              <h4 class="mb-0 font-size-18">Salary Report</h4>
              <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                      <li class="breadcrumb-item active">Salary Report</li>
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
        <form class="form-horizontal" method="post" action="{{ route('month_wise_salary_report') }}" id="customerForm">
          @csrf
          <div class="card">
            <div class="card-header custom-card-header">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="card-title card_top_title"><i class="fab fa-gg-circle"></i> All Employee Salary Report</h3>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="card-body card_form">
                <div class="row">
                  <div class="form-group custom_form_group col-md-6">
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

                  <div class="form-group custom_form_group col-md-6">
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

  <div class="row">
    <div class="col-lg-12">
      <div class="col-lg-12">
          <div class="card">
              <div class="card-header custom-card-header">
                  <div class="row">
                      <div class="col-md-8">
                          <h3 class="card-title card_top_title"><i class="fab fa-gg-circle mr-2"></i>All Blood Group</h3>
                      </div>
                      <div class="clearfix"></div>
                  </div>
              </div>

              @php
                if(Session::has('dataList')){
                  $reports = Session::get('dataList');
                } else {
                  $reports = array();
                }
              @endphp
              <div class="card-body">
                  <div class="row">
                      <div class="col-12">
                          <div class="table-responsive">
                              <table id="alltableinfo" class="table table-bordered custom_table mb-0">
                                  <thead>
                                      <tr>
                                        <th>No</th>
                                        <th>Employee</th>
                                        <th>Salary</th>
                                        <th>Advance</th>
                                        <th>Commision</th>
                                        <th>Action</th>
                                      </tr>
                                  </thead>


                                  {{-- main work --}}
                                  <tbody>
                                    @forelse ($reports as $data)
                                     <tr>
                                       <td style="width:5%">{{ $loop->iteration }}</td>
                                       <td style="width:30%">
                                         <img src="{{ asset($data->profile_photo) }}" alt="" width="70">
                                         <span> {{ $data->employee_name }} ({{ $data->ID_Number }}) </span>
                                       </td>
                                       <td>
                                         <span>{{ $data->basic_amount }}(Basic)</span> <br>
                                         <span>{{ $data->total_salary }}(Total)</span>
                                       </td>
                                       <td>
                                         <span>{{ $data->slh_advance }}(Duration)</span> <br>
                                         <span>{{ $data->slh_advance_amount }}(Total)</span>
                                       </td>
                                       <td>
                                         <span>{{ $data->slh_commision }}(Duration)</span> <br>
                                         <span>{{ $data->slh_commision_amount }}(Total)</span>
                                       </td>
                                       <td style="width:17%; text-align:center">
                                         <a class="btn btn-primary btn-sm" href="{{ route('salary-report-view',$data->slh_auto_id) }}"><i class="fas fa-eye"></i></a>
                                         {{-- <a class="btn btn-success btn-sm" href="{{ route('salary-report-download',$data->slh_auto_id) }}"><i class="fas fa-download"></i></a> --}}
                                       </td>
                                     </tr>
                                    @empty
                                      <p style="color:red">Data Not Found!</p>
                                    @endforelse

                                   </tbody>
                                  {{-- main work --}}
                              </table>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="card-footer card_footer">
                .
              </div>
          </div>
      </div>
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
