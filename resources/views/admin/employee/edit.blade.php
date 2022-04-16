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
  {{-- response massege --}}
  <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8">
          @if(Session::has('success_store'))
            <div class="alert alert-success alertsuccess" role="alert">
               <strong>Successfully!</strong> Create New Employee.
            </div>
          @endif

          @if(Session::has('success_update'))
            <div class="alert alert-success alertsuccess" role="alert">
               <strong>Successfully!</strong> Update Employee.
            </div>
          @endif

          @if(Session::has('updateNidPhoto'))
            <div class="alert alert-success alertsuccess" role="alert">
               <strong>Successfully!</strong> Save & Change Nid Copy.
            </div>
          @endif

          @if(Session::has('updateProfilePhoto'))
            <div class="alert alert-success alertsuccess" role="alert">
               <strong>Successfully!</strong> Save & Change Profile Photo.
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
        <form class="form-horizontal" method="post" action="{{ route('employee.update',$data->employee_id) }}" enctype="multipart/form-data" id="customerForm">
          @csrf
          @method('put')
          <div class="card">
            <div class="card-header custom-card-header">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="card-title card_top_title"><i class="fab fa-gg-circle"></i> Edit Employee Information</h3>
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
                          <input type="text" placeholder="{{ $data->ID_Number }}" class="form-control" disabled>
                          <input type="hidden" class="form-control" name="ID_Number" value="{{ $data->ID_Number }}">
                      </div>
                  </div>
                  <div class="form-group custom_form_group col-md-6">
                      <label class="control-label">Name:<span class="req_star">*</span></label>
                      <div class="">
                          <input type="text" placeholder="Name" class="form-control" name="employee_name" value="{{ $data->employee_name }}" required>
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
                          <input type="text" placeholder="Father Name" class="form-control" name="employee_father" value="{{ $data->employee_father }}" required>
                          @error('employee_father')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                  <div class="form-group custom_form_group col-md-6">
                      <label class="control-label">Mother Name:<span class="req_star">*</span></label>
                      <div class="">
                          <input type="text" placeholder="Mother Name" class="form-control" name="employee_mother" value="{{ $data->employee_mother }}" required>
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
                          <input type="text" placeholder="Phone" class="form-control" name="mobile_no" value="{{ $data->mobile_no }}" required>
                          @error('mobile_no')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>

                  <div class="form-group custom_form_group col-md-6">
                      <label class="control-label">Email Address:</label>
                      <div class="">
                          <input type="email" placeholder="Email" class="form-control" name="email" value="{{ $data->email }}">
                      </div>
                  </div>
                </div>

                <div class="row">
                  <div class="form-group custom_form_group col-md-6">
                      <label class="control-label">NID Number:<span class="req_star">*</span></label>
                      <div class="">
                          <input type="text" placeholder="NID Number" class="form-control" name="nid" value="{{ $data->nid }}" required>
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
                              <option value="{{ $blood->blood_group_id }}" {{ $blood->blood_group_id == $data->blood_group_id ? 'selected' : '' }}>{{ $blood->name }}</option>
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
                          <input type="text" placeholder="Present Address" class="form-control" name="present_address" value="{{ $data->present_address }}" required>
                          @error('present_address')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                  <div class="form-group custom_form_group col-md-6">
                      <label class="control-label">Permanent Address:<span class="req_star">*</span></label>
                      <div class="">
                          <input type="text" placeholder="Permanent Address" class="form-control" name="parmanent_address" value="{{ $data->parmanent_address }}" required>
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
                          <input type="date" class="form-control" name="date_of_birth" value="{{ $data->date_of_birth }}" max="{{ Carbon\Carbon::now()->subYears(18)->format('Y-m-d') }}" required>
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
                            <option value="1" {{ $data->maritus_status == 1 ? 'selected' : '' }}>Marrid</option>
                            <option value="0" {{ $data->maritus_status == 0 ? 'selected' : '' }}>Unmarrid</option>
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
                            <option value="Female" {{ $data->gender == 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Male" {{ $data->gender == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Other" {{ $data->gender == 'Other' ? 'selected' : '' }}>Other</option>
                          </select>
                          @error('gender')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                  <div class="form-group custom_form_group col-md-6">
                      <label class="control-label">Joining Date:<span class="req_star">*</span></label>
                      <div class="">
                          <input type="date" class="form-control" name="joining_date" value="{{ $data->joining_date }}" required>
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
                              <option value="{{ $desig->designation_id }}" {{ $desig->designation_id == $data->designation_id ? 'selected' : '' }}>{{ $desig->title }}</option>
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
                              <option value="{{ $depart->department_id }}" {{ $depart->department_id == $data->department_id ? 'selected' : '' }}>{{ $depart->title }}</option>
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
                              <option value="{{ $type->emp_type_id }}" {{ $type->emp_type_id == $data->emp_type_id ? 'selected' : '' }}>{{ $type->title }}</option>
                            @endforeach
                          </select>
                          @error('emp_type_id')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
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
  {{-- Image part --}}
  <div class="col-lg-12">
      <div class="card">
          <div class="card-body card_form">
            {{-- Image --}}
            <div class="row">
              <div class="form-group custom_form_group col-md-4">
                <form class="" action="{{ route('employee-profile-photo.change',$data->employee_id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                  <input type="hidden" name="old_profile_photo" value="{{ $data->profile_photo }}">
                  <div class="show_image">
                    <img src="{{ asset($data->profile_photo) }}" style="width:100%; height: 150px; border:1px solid #ddd;" alt="">
                  </div>
                  <hr>
                  <label class=" control-label">Profile Photo:<span class="req_star">*</span></label>
                  <div class="row">
                      {{-- do work --}}
                      <div class="col-sm-12">
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
                      {{-- do work --}}
                  </div>
                  <button type="submit" class="btn btn-primary waves-effect mt-2">SAVE & CHANGE</button>
                </form>
              </div>
              <div class="form-group custom_form_group col-md-4">
                <form class="" action="{{ route('employee-nid-photo.change',$data->employee_id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                  <input type="hidden" name="old_nid_photo" value="{{ $data->nid_photo }}">
                  <div class="show_image">
                    <img src="{{ asset($data->nid_photo) }}" style="width:100%; height: 150px; border:1px solid #ddd;" alt="">
                  </div>
                  <hr>
                  <label class=" control-label">NID Copy:<span class="req_star">*</span></label>
                  <div class="row">
                      {{-- do work --}}
                      <div class="col-sm-12">
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
                      {{-- do work --}}
                  </div>
                  <button type="submit" class="btn btn-primary waves-effect mt-2">SAVE & CHANGE</button>
                </form>
              </div>
            </div>
            {{-- Image --}}
          </div>
          {{-- visa information --}}
      </div>
    </div>

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
