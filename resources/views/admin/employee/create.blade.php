@extends('layouts.admin')
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
  {{-- response massege --}}
  <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8">
          @if(Session::has('success_store'))
            <div class="alert alert-success alertsuccess" role="alert">
               <strong>Successfully!</strong> Create New Employee.
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
        <form class="form-horizontal" method="post" action="{{ route('employee.store') }}" enctype="multipart/form-data" id="customerForm">
          @csrf

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

            <div class="card-body card_form">
                <div class="row">
                  <div class="form-group custom_form_group col-md-6">
                      <label class="control-label">Employee Id No:<span class="req_star">*</span></label>
                      <div class="">
                          <input type="text" placeholder="{{ $employeeId }}" class="form-control" disabled>
                          <input type="hidden" class="form-control" name="ID_Number" value="{{ $employeeId }}">
                      </div>
                  </div>
                  <div class="form-group custom_form_group col-md-6">
                      <label class="control-label">Name:<span class="req_star">*</span></label>
                      <div class="">
                          <input type="text" placeholder="Name" class="form-control" name="employee_name" value="{{old('employee_name')}}" required>
                          @error('employee_name')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                </div>

                <div class="row">
                  <div class="form-group custom_form_group col-md-6">
                      <label class="control-label">Father Name:<span class="req_star">*</span></label>
                      <div class="">
                          <input type="text" placeholder="Father Name" class="form-control" name="employee_father" value="{{old('employee_father')}}" required>
                          @error('employee_father')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                  <div class="form-group custom_form_group col-md-6">
                      <label class="control-label">Mother Name:<span class="req_star">*</span></label>
                      <div class="">
                          <input type="text" placeholder="Mother Name" class="form-control" name="employee_mother" value="{{old('employee_mother')}}" required>
                          @error('employee_mother')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                </div>

                <div class="row">
                  <div class="form-group custom_form_group col-md-6">
                      <label class=" control-label">Mobile Number:<span class="req_star">*</span></label>
                      <div class="">
                          <input type="text" placeholder="Phone" class="form-control" name="mobile_no" value="{{old('mobile_no')}}" required>
                          @error('mobile_no')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>

                  <div class="form-group custom_form_group col-md-6">
                      <label class="control-label">Email Address:</label>
                      <div class="">
                          <input type="email" placeholder="Email" class="form-control" name="email" value="{{old('email')}}">
                      </div>
                  </div>
                </div>

                <div class="row">
                  <div class="form-group custom_form_group col-md-6">
                      <label class="control-label">NID Number:<span class="req_star">*</span></label>
                      <div class="">
                          <input type="text" placeholder="NID Number" class="form-control" name="nid" value="{{old('nid')}}" required>
                          @error('nid')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>

                  <div class="form-group custom_form_group col-md-6">
                      <label class="control-label">Blood Group:<span class="req_star">*</span></label>
                      <div class="">
                          <select class="form-control search_select" name="blood_group_id" id="search_select" required>
                            <option value="">Select Blood Gruop</option>
                            @foreach ($bloodGroup as $blood)
                              <option value="{{ $blood->blood_group_id }}">{{ $blood->name }}</option>
                            @endforeach
                          </select>
                          @error('payment')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                </div>

                <div class="row">
                  <div class="form-group custom_form_group col-md-6">
                      <label class="control-label">Present Address:<span class="req_star">*</span></label>
                      <div class="">
                          <input type="text" placeholder="Present Address" class="form-control" name="present_address" value="{{old('present_address')}}" required>
                          @error('present_address')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                  <div class="form-group custom_form_group col-md-6">
                      <label class="control-label">Permanent Address:<span class="req_star">*</span></label>
                      <div class="">
                          <input type="text" placeholder="Permanent Address" class="form-control" name="parmanent_address" value="{{old('parmanent_address')}}" required>
                          @error('parmanent_address')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                </div>

                <div class="row">
                  <div class="form-group custom_form_group col-md-6">
                      <label class="control-label">DOB:<span class="req_star">*</span></label>
                      <div class="">
                          <input type="date" class="form-control" name="date_of_birth" value="{{ Carbon\Carbon::now()->subYears(18)->format('Y-m-d') }}" max="{{ Carbon\Carbon::now()->subYears(18)->format('Y-m-d') }}" required>
                          @error('date_of_birth')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                  <div class="form-group custom_form_group col-md-6">
                      <label class="control-label">Marital Status:<span class="req_star">*</span></label>
                      <div class="">
                          <select class="form-control" name="maritus_status" required>
                            <option value="">Select Option</option>
                            <option value="1">Marrid</option>
                            <option value="0">Unmarrid</option>
                          </select>
                          @error('maritus_status')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                </div>

                <div class="row">
                  <div class="form-group custom_form_group col-md-6">
                      <label class="control-label">Gender:<span class="req_star">*</span></label>
                      <div class="">
                          <select class="form-control" name="gender" required>
                            <option value="">Select Option</option>
                            <option value="Female">Female</option>
                            <option value="Male">Male</option>
                            <option value="Other">Other</option>
                          </select>
                          @error('gender')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                  <div class="form-group custom_form_group col-md-6">
                      <label class="control-label">Joining Date:<span class="req_star">*</span></label>
                      <div class="">
                          <input type="date" class="form-control" name="joining_date" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" required>
                      </div>
                  </div>
                </div>

                <div class="row">
                  <div class="form-group custom_form_group col-md-6">
                      <label class="control-label">Designation:<span class="req_star">*</span></label>
                      <div class="">
                          <select class="form-control search_select" name="designation_id" id="search_select2" required>
                            <option value="">Select Designation</option>
                            @foreach ($designation as $desig)
                              <option value="{{ $desig->designation_id }}">{{ $desig->title }}</option>
                            @endforeach
                          </select>
                          @error('payment')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                  <div class="form-group custom_form_group col-md-6">
                      <label class="control-label">Department:<span class="req_star">*</span></label>
                      <div class="">
                          <select class="form-control search_select" name="department_id" id="search_select3" required>
                            <option value="">Select Department</option>
                            @foreach ($department as $depart)
                              <option value="{{ $depart->department_id }}">{{ $depart->title }}</option>
                            @endforeach
                          </select>
                          @error('department_id')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>

                </div>

                <div class="row">
                  <div class="form-group custom_form_group col-md-6 m-auto">
                      <label class="control-label">Employee Type:<span class="req_star">*</span></label>
                      <div class="">
                          <select class="form-control search_select" name="emp_type_id" id="search_select4" required>
                            <option value="">Select Employee Type</option>
                            @foreach ($employeeType as $type)
                              <option value="{{ $type->emp_type_id }}">{{ $type->title }}</option>
                            @endforeach
                          </select>
                          @error('emp_type_id')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                </div>

                <div class="row">
                  <div class="form-group col-md-6 mb-3">
                    <label class="col-form-label col_form_label">Photo:</label>
                    <div class="">
                      <div class="input-group">
                          <span class="input-group-btn">
                              <span class="btn btn-default btn-file btnu_browse">
                                  Browse… <input type="file" name="profile_photo" id="imgInp">
                              </span>
                          </span>
                          <input type="text" class="form-control" readonly>
                      </div>
                      <img id="img-upload"/>
                    </div>
                  </div>

                  <div class="form-group col-md-6 mb-3">
                    <label class="col-form-label col_form_label">NID Copy:</label>
                    <div class="">
                      <div class="input-group">
                          <span class="input-group-btn">
                              <span class="btn btn-default btn-file btnu_browse">
                                  Browse… <input type="file" name="nid_photo" onchange="nidUrl(this)">
                              </span>
                          </span>
                          <input type="text" class="form-control" readonly>
                      </div>
                      <img src="" id="nidShow" style="margin-top:10px">
                    </div>
                  </div>
                </div>


            </div>

              <div class="card-footer card_footer_button text-center">
                  <button type="submit" class="btn btn-primary waves-effect">NEXT</button>
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
    </script>
@endsection
