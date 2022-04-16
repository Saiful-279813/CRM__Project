@extends('layouts.admin')
@section('employee') active mm-active @endsection
@section('listEmployee') active @endsection
@section('content')
  {{-- breadcrumb --}}
  <div class="row">
      <div class="col-12">
          <div class="page-title-box d-flex align-items-center justify-content-between">
              <h4 class="mb-0 font-size-18">Employee</h4>
              <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                      <li class="breadcrumb-item active">Employee</li>
                  </ol>
              </div>
          </div>
      </div>
  </div>
  <div class="row">
    <div class="col-lg-12">

          <div class="card">
            <div class="card-header custom-card-header">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="card-title card_top_title"><i class="fab fa-gg-circle"></i> Create New Employee</h3>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="{{ route('employee.index') }}" class="btn btn-md btn-primary waves-effect card_top_button"><i class="fa fa-th"></i> All Employee List </a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="card-body">
              <div class="col-md-10 m-auto">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group custom_form_group">
                          <label class="control-label">Employee Photo</label>
                          <div class="">
                            <img src="{{ asset($data->profile_photo) }}" alt="" class="img-fluid" style="">
                          </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group custom_form_group">
                          <label class="control-label">NID Photo</label>
                          <div class="">
                            <img src="{{ asset($data->nid_photo) }}" alt="" class="img-fluid" style="">
                          </div>
                      </div>
                    </div>
                  </div>
              </div>
              {{-- do work --}}
              <div class="col-md-8 m-auto">
                  <table class="table table-bordered table-striped table-hover dt-responsive nowrap custom_view_table">
                      <tr>
                        <td>Employee Name</td>
                        <td>:</td>
                        <td> {{ $data->employee_name }} ({{ $data->ID_Number }})</td>
                      </tr>

                      <tr>
                        <td>Father Name</td>
                        <td>:</td>
                        <td> {{ $data->employee_father }} </td>
                      </tr>

                      <tr>
                        <td>Mother Name</td>
                        <td>:</td>
                        <td> {{ $data->employee_mother }} </td>
                      </tr>

                      <tr>
                        <td>Mobile Number</td>
                        <td>:</td>
                        <td> {{ $data->mobile_no }} </td>
                      </tr>

                      <tr>
                        <td>Email Address</td>
                        <td>:</td>
                        <td> {{ $data->email == NULL ? 'Not Assigned' : $data->email }} </td>
                      </tr>

                      <tr>
                        <td>Blood Group</td>
                        <td>:</td>
                        <td> {{ $data->blood->name }} </td>
                      </tr>

                      <tr>
                        <td>NID</td>
                        <td>:</td>
                        <td> {{ $data->nid }} </td>
                      </tr>

                      <tr>
                        <td>Date Of Birth</td>
                        <td>:</td>
                        <td> {{ $data->date_of_birth }} </td>
                      </tr>

                      <tr>
                        <td>Present Address</td>
                        <td>:</td>
                        <td> {{ $data->present_address }} </td>
                      </tr>

                      <tr>
                        <td>Permanent Address</td>
                        <td>:</td>
                        <td> {{ $data->parmanent_address }} </td>
                      </tr>

                      <tr>
                        <td>Department</td>
                        <td>:</td>
                        <td> {{ $data->department->title }} </td>
                      </tr>

                      <tr>
                        <td>Designation</td>
                        <td>:</td>
                        <td> {{ $data->designation->title }} </td>
                      </tr>

                      <tr>
                        <td>Employee Type</td>
                        <td>:</td>
                        <td> {{ $data->employeeType->title }} </td>
                      </tr>

                      <tr>
                        <td>Maritus Status</td>
                        <td>:</td>
                        <td> {{ $data->maritus_status == 1 ? 'Marrid' : 'Unmarrid' }} </td>
                      </tr>

                      <tr>
                        <td>Gender</td>
                        <td>:</td>
                        <td> {{ $data->gender }} </td>
                      </tr>

                      <tr>
                        <td>Joining Date</td>
                        <td>:</td>
                        <td> {{ $data->joining_date }} </td>
                      </tr>

                      <tr>
                        <td>Confirmation Date</td>
                        <td>:</td>
                        <td> {{ $data->confirmation_date == NULL ? 'Not Assigned' : $data->confirmation_date }} </td>
                      </tr>

                      <tr>
                        <td>Appointment Date</td>
                        <td>:</td>
                        <td> {{ $data->appointment_date == NULL ? 'Not Assigned' : $data->appointment_date }} </td>
                      </tr>

                      <tr>
                        <td>Job Status</td>
                        <td>:</td>
                        <td> {{ $data->job_status }} </td>
                      </tr>

                      <tr>
                        <td>Create By </td>
                        <td>:</td>
                        <td> {{ $data->creator->name }} </td>
                      </tr>

                      <tr>
                        <td>Create Time</td>
                        <td>:</td>
                        <td>{{$data->created_at->format('d-m-Y | h:i:s A')}}</td>
                      </tr>



                  </table>
              </div>
            </div>
            <div class="card-footer card_footer_button text-center">
                <a href="#" class="btn btn-primary waves-effect">PDF Or Print</a>
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

      function nidUrl(input){
        if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function(e){
              $('#nidShow').attr('src',e.target.result).width(150)
                    .height(150);
          };
          reader.readAsDataURL(input.files[0]);


        }
      }
      /* ================ do work ================ */
    </script>
@endsection
