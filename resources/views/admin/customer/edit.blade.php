@extends('layouts.admin')
@section('customer') active mm-active @endsection
@section('customerList') active @endsection
@section('content')
  {{-- breadcrumb --}}
  <div class="row">
      <div class="col-12">
          <div class="page-title-box d-flex align-items-center justify-content-between">
              <h4 class="mb-0 font-size-18">Edit Customer</h4>
              <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                      <li class="breadcrumb-item active">Edit Customer</li>
                  </ol>
              </div>
          </div>
      </div>
  </div>
  {{-- response massege --}}
  <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8">
          @if(Session::has('edit_success'))
            <div class="alert alert-success alertsuccess" role="alert">
               <strong>Successfully!</strong> Update Customer Information.
            </div>
          @endif

          @if(Session::has('success_store_customer_photo'))
            <div class="alert alert-success alertsuccess" role="alert">
               <strong>Successfully!</strong> Save & Change Customer Photo.
            </div>
          @endif

          @if(Session::has('success_store_visa_photo'))
            <div class="alert alert-success alertsuccess" role="alert">
               <strong>Successfully!</strong> Save & Change Visa Photo.
            </div>
          @endif

          @if(Session::has('success_store_passport_photo'))
            <div class="alert alert-success alertsuccess" role="alert">
               <strong>Successfully!</strong> Save & Change Passport Photo.
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
        <form class="form-horizontal" method="post" action="{{ route('customers.update') }}" enctype="multipart/form-data" id="customerForm">
          @csrf
          <div class="card">
            <div class="card-header custom-card-header">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="card-title card_top_title"><i class="fab fa-gg-circle"></i> Create New Customer</h3>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="{{ route('customers.index') }}" class="btn btn-md btn-primary waves-effect card_top_button"><i class="fa fa-th"></i> All Customer List </a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="card-body card_form">
                <div class="row">
                  <div class="form-group custom_form_group col-md-8 m-auto">
                      <label class="control-label">Customer Id No:<span class="req_star">*</span></label>
                      <div class="">
                        <input type="hidden" name="customer_id" value="{{ $data->customer_id }}">
                          <input type="text" placeholder="{{ $data->customer_id_number }}" class="form-control" disabled>
                      </div>
                  </div>
                </div>

                <div class="row">
                  <div class="form-group custom_form_group col-md-6">
                      <label class="control-label">Name:<span class="req_star">*</span></label>
                      <div class="">
                          <input type="text" placeholder="Name" class="form-control" name="customer_name" value="{{ $data->customer_name }}" required data-parsley-pattern="[a-zA-Z_ ]+$" data-parsley-length="[3,50]" data-parsley-trigger="keyup">
                          @error('customer_name')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                  <div class="form-group custom_form_group col-md-6">
                      <label class="control-label">Father Name:<span class="req_star">*</span></label>
                      <div class="">
                          <input type="text" placeholder="Father Name" class="form-control" name="customer_father" value="{{ $data->customer_father }}" required data-parsley-pattern="[a-zA-Z_ ]+$" data-parsley-length="[3,50]" data-parsley-trigger="keyup">
                          @error('customer_father')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                </div>

                <div class="row">
                  <div class="form-group custom_form_group col-md-6">
                      <label class=" control-label">Phone Number:<span class="req_star">*</span></label>
                      <div class="">
                          <input type="text" placeholder="Phone" class="form-control" name="customer_phone" value="{{ $data->customer_phone }}" required data-parsley-pattern="[0-9]+$" data-parsley-length="[11,15]" data-parsley-trigger="keyup">
                          @error('customer_phone')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>

                  <div class="form-group custom_form_group col-md-6">
                      <label class="control-label">Email Address:</label>
                      <div class="">
                          <input type="email" placeholder="Email" class="form-control" name="customer_email" value="{{ $data->customer_email }}" data-parsley-length="[10,50]" data-parsley-trigger="keyup">
                      </div>
                  </div>
                </div>

                <div class="row">
                  <div class="form-group custom_form_group col-md-6">
                      <label class="control-label">Address:<span class="req_star">*</span></label>
                      <div class="">
                          <input type="text" class="form-control" placeholder="Address Here..." name="customer_address" value="{{ $data->customer_address }}" required data-parsley-pattern="[a-zA-Z0-9_- ]+$" data-parsley-length="[10,255]"
                            data-parsley-trigger="keyup">
                      </div>
                      @error('customer_address')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                  </div>

                  <div class="form-group custom_form_group col-md-6">
                      <label class="control-label">Apply Date:<span class="req_star">*</span></label>
                      <div class="">
                          <input type="date" class="form-control" name="apply_date" value="{{ $data->apply_date == NULL ? Carbon\Carbon::now()->format('Y-m-d') : $data->apply_date }}" required>
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-6 m-auto mb-3">
                    <label class="col-form-label col_form_label">Refference Officer:</label>
                    <div class="">
                        <select class="form-control search_select" name="employee_id" id="search_select2" required>
                          <option value="">Select Officer</option>
                          @foreach ($employee as $empl)
                            <option value="{{ $empl->employee_id }}" {{ $empl->employee_id == $data->employee_id ? 'selected' : '' }}>{{ $empl->employee_name }}</option>
                          @endforeach
                        </select>
                        @error('employee_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                  </div>
                </div>
                <hr>
                {{-- visa information --}}
                <div class="row">
                  <div class="form-group custom_form_group col-md-6 m-auto">
                      <label class="control-label">Place Of Country:<span class="req_star">*</span></label>
                      <div class="">
                          <select class="form-control" name="place_country_id" id="search_select" required>
                            <option value="">Select Country</option>
                            @foreach ($country as $ctry)
                              <option value="{{ $ctry->country_id }}" {{ $data->place_country_id == $ctry->country_id ? 'selected' : '' }}>{{ $ctry->name }}</option>
                            @endforeach
                          </select>
                          @error('place_country_id')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                  <div class="form-group custom_form_group col-md-6 m-auto">
                      <label class="control-label">Visa Type:<span class="req_star">*</span></label>
                      <div class="">
                          <select class="form-control" name="visa_type_id" id="search_select3" required>
                            <option value="">Select Visa Type</option>
                            @foreach ($visaType as $vsType)
                              <option value="{{ $vsType->visa_type_id }}" {{ $vsType->visa_type_id == $data->visa_type_id ? 'selected' : '' }}>{{ $vsType->visa_type_name }}</option>
                            @endforeach
                          </select>
                          @error('visa_type_id')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group custom_form_group col-md-6">
                      <label class=" control-label">Visa Name:<span class="req_star">*</span></label>
                      <div class="">
                          <input type="text" placeholder="Visa Name" class="form-control" name="visa_name" value="{{ $data->visa_name }}" required data-parsley-pattern="[a-zA-Z0-9_-]+$" data-parsley-length="[1,200]" data-parsley-trigger="keyup">
                          @error('visa_name')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                  <div class="form-group custom_form_group col-md-6">
                      <label class=" control-label">Visa Remarks:<span class="req_star">*</span></label>
                      <div class="">
                          <input type="text" placeholder="Remarks..." class="form-control" name="visa_remarks" value="{{ $data->visa_remarks }}" required data-parsley-pattern="[a-zA-Z0-9_-]+$" data-parsley-length="[1,220]" data-parsley-trigger="keyup">
                          @error('visa_remarks')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group custom_form_group col-md-6">
                      <label class=" control-label">From Date:<span class="req_star">*</span></label>
                      <div class="">
                          <input type="date" class="form-control" name="from_date" value="{{ $data->from_date == NULL ? Carbon\Carbon::now()->format('Y-m-d') : $data->from_date}}" required>
                          @error('from_date')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                  <div class="form-group custom_form_group col-md-6">
                      <label class=" control-label">To Date:<span class="req_star">*</span></label>
                      <div class="">
                          <input type="date" class="form-control" name="to_date" value="{{ $data->to_date == NULL ? Carbon\Carbon::now()->format('Y-m-d') : $data->to_date }}" required>
                          @error('to_date')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group custom_form_group col-md-4">
                      <label class=" control-label">Visa Number:<span class="req_star">*</span></label>
                      <div class="">
                          <input type="text" placeholder="Visa Number" class="form-control" name="visa_number" value="{{ $data->visa_number }}" required data-parsley-pattern="[a-zA-Z0-9_-]+$" data-parsley-length="[11,15]" data-parsley-trigger="keyup">
                          @error('visa_number')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                  <div class="form-group custom_form_group col-md-4">
                      <label class=" control-label">Passport Number:<span class="req_star">*</span></label>
                      <div class="">
                          <input type="text" placeholder="Passport Number" class="form-control" name="passport_number" value="{{ $data->passport_number }}" required data-parsley-pattern="[a-zA-Z0-9_-]+$" data-parsley-length="[11,15]" data-parsley-trigger="keyup">
                          @error('passport_number')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                  <div class="form-group custom_form_group col-md-4">
                      <label class=" control-label">Passport Location:<span class="req_star">*</span></label>
                      <div class="">
                          <input type="text" placeholder="PP Location" class="form-control" name="pp_location" value="{{ $data->pp_location }}" required data-parsley-pattern="[a-zA-Z0-9_- ]+$" data-parsley-length="[1,220]" data-parsley-trigger="keyup">
                          @error('pp_location')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group custom_form_group col-md-3">
                      <label class=" control-label">Vecxin:<span class="req_star">*</span></label>
                      <div class="">
                          <select class="form-control" name="vecxin" required>
                            <option value="">Select Yes Or No</option>
                            <option value="1" {{ $data->vecxin == 1 ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ $data->vecxin == 0 ? 'selected' : '' }}>No</option>
                          </select>

                          @error('vecxin')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                  <div class="form-group custom_form_group col-md-3">
                      <label class=" control-label">PC:<span class="req_star">*</span></label>
                      <div class="">
                          <select class="form-control" name="PC" required>
                              <option value="">Select Yes Or No</option>
                              <option value="1" {{ $data->PC == 1 ? 'selected' : '' }}>Yes</option>
                              <option value="0" {{ $data->PC == 0 ? 'selected' : '' }}>No</option>
                          </select>
                          @error('PC')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                  <div class="form-group custom_form_group col-md-3">
                      <label class=" control-label">Medical:<span class="req_star">*</span></label>
                      <div class="">
                          <select class="form-control" name="medical" required>
                              <option value="">Select Yes Or No</option>
                              <option value="1" {{ $data->medical == 1 ? 'selected' : '' }}>Yes</option>
                              <option value="0" {{ $data->medical == 0 ? 'selected' : '' }}>No</option>
                          </select>
                          @error('medical')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                  <div class="form-group custom_form_group col-md-3">
                      <label class=" control-label">Medical Date:<span class="req_star">*</span></label>
                      <div class="">
                          <input type="date" name="madical_date" class="form-control" value="{{ $data->madical_date == NULL ? Carbon\Carbon::now()->format('Y-m-d') : $data->madical_date }}">
                          @error('madical_date')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group custom_form_group col-md-3">
                      <label class=" control-label">Report:<span class="req_star">*</span></label>
                      <div class="">
                          <select class="form-control" name="report" required>
                            <option value="">Select Status</option>
                            <option value="PENDING" {{ $data->report == 'PENDING' ? 'selected' : '' }}>PENDING</option>
                            <option value="FIT" {{ $data->report == 'FIT' ? 'selected' : '' }}>FIT</option>
                            <option value="UNFIT" {{ $data->report == 'UNFIT' ? 'selected' : '' }}>UNFIT</option>
                          </select>

                          @error('report')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                  <div class="form-group custom_form_group col-md-3">
                      <label class=" control-label">Visa Online:<span class="req_star">*</span></label>
                      <div class="">
                          <select class="form-control" name="visa_online" required>
                              <option value="">Select Yes Or No</option>
                              <option value="1" {{ $data->visa_online == '1' ? 'selected' : '' }}>Yes</option>
                              <option value="0" {{ $data->visa_online == '0' ? 'selected' : '' }}>No</option>
                          </select>
                          @error('visa_online')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                  <div class="form-group custom_form_group col-md-3">
                      <label class=" control-label">Visa:<span class="req_star">*</span></label>
                      <div class="">
                          <select class="form-control" name="visa" required>
                              <option value="">Select Yes Or No</option>
                              <option value="1" {{ $data->visa == '1' ? 'selected' : '' }}>Yes</option>
                              <option value="0" {{ $data->visa == '0' ? 'selected' : '' }}>No</option>
                          </select>
                          @error('visa')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                  <div class="form-group custom_form_group col-md-3">
                      <label class=" control-label">Training:<span class="req_star">*</span></label>
                      <div class="">
                          <select class="form-control" name="training" required>
                              <option value="">Select Yes Or No</option>
                              <option value="1" {{ $data->training == '1' ? 'selected' : '' }}>Yes</option>
                              <option value="0" {{ $data->training == '0' ? 'selected' : '' }}>No</option>
                          </select>
                          @error('training')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group custom_form_group col-md-4">
                      <label class=" control-label">Manpower:<span class="req_star">*</span></label>
                      <div class="">
                          <select class="form-control" name="manpower" required>
                              <option value="">Select Yes Or No</option>
                              <option value="1" {{ $data->manpower == '1' ? 'selected' : '' }}>Yes</option>
                              <option value="0" {{ $data->manpower == '0' ? 'selected' : '' }}>No</option>
                          </select>
                          @error('manpower')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                  <div class="form-group custom_form_group col-md-4">
                      <label class=" control-label">Ticket:<span class="req_star">*</span></label>
                      <div class="">
                          <select class="form-control" name="ticket" required>
                              <option value="">Select Yes Or No</option>
                              <option value="1" {{ $data->ticket == '1' ? 'selected' : '' }}>Yes</option>
                              <option value="0" {{ $data->ticket == '0' ? 'selected' : '' }}>No</option>
                          </select>
                          @error('ticket')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                  <div class="form-group custom_form_group col-md-4">
                      <label class=" control-label">Work Name:<span class="req_star">*</span></label>
                      <div class="">
                          <input type="text" class="form-control" placeholder="Work Name..." name="work" value="{{ $data->work }}" required data-parsley-pattern="[a-zA-Z0-9_- ]+$" data-parsley-length="[1,220]" data-parsley-trigger="keyup">
                          @error('work')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                </div>
                {{-- visa information --}}
            </div>
            <div class="card-footer card_footer_button text-center">
                <button type="submit" class="btn btn-primary waves-effect">UPDATE</button>
            </div>
          </div>
          {{-- visa form --}}
        </form>
    </div>
    {{-- Image Modify --}}
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body card_form">
              {{-- Image --}}
              <div class="row">
                <div class="form-group custom_form_group col-md-4">
                  <form class="" action="{{ route('customer-photo',$data->customer_id) }}" method="post" enctype="multipart/form-data">
                      @csrf
                    <input type="hidden" name="old_customer_photo" value="{{ $data->customer_photo }}">
                    <div class="show_image">
                      <img src="{{ asset($data->customer_photo) }}" style="width:100%; height: 150px; border:1px solid #ddd;" alt="">
                    </div>
                    <hr>
                    <label class=" control-label">Customer Image:<span class="req_star">*</span></label>
                    <div class="row">
                        {{-- do work --}}
                        <div class="col-sm-12">
                          <div class="input-group">
                              <span class="input-group-btn">
                                  <span class="btn btn-default btn-file btnu_browse">
                                      Browse… <input type="file" name="customer_photo" onchange="customer_photoUrl(this)">
                                  </span>
                              </span>
                              <input type="text" class="form-control" readonly>
                          </div>
                          <img src="" id="customer_photoShow" style="margin:10px 0px">
                        </div>
                        {{-- do work --}}
                    </div>
                    <button type="submit" class="btn btn-primary waves-effect">SAVE & CHANGE</button>
                  </form>
                </div>



                <div class="form-group custom_form_group col-md-4">
                  <form class="" action="{{ route('customer-visa-image',$data->customer_id) }}" method="post" enctype="multipart/form-data">
                      @csrf
                    <input type="hidden" name="old_visa_photo" value="{{ $data->visa_image }}">
                    <div class="show_image">
                      <img src="{{ asset($data->visa_image) }}" style="width:100%; height: 150px; border:1px solid #ddd;" alt="">
                    </div>
                    <hr>
                    <label class=" control-label">Visa Image:<span class="req_star">*</span></label>
                    <div class="row">
                        {{-- do work --}}
                        <div class="col-sm-12">
                          <div class="input-group">
                              <span class="input-group-btn">
                                  <span class="btn btn-default btn-file btnu_browse">
                                      Browse… <input type="file" name="visa_image" onchange="visa_imageUrl(this)">
                                  </span>
                              </span>
                              <input type="text" class="form-control" readonly>
                          </div>
                          <img src="" id="visa_imageShow" style="margin:10px 0px">
                        </div>
                        {{-- do work --}}
                    </div>
                    <button type="submit" class="btn btn-primary waves-effect">SAVE & CHANGE</button>
                  </form>
                </div>
                <div class="form-group custom_form_group col-md-4">
                  <form class="" action="{{ route('customer-passport-image',$data->customer_id) }}" method="post" enctype="multipart/form-data">
                      @csrf
                      <input type="hidden" name="old_passport_image" value="{{ $data->passport_image }}">
                    <div class="show_image">
                      <img src="{{ asset($data->passport_image) }}" style="width:100%; height: 150px; border:1px solid #ddd;" alt="">
                    </div>
                    <hr>
                    <label class=" control-label">Passport Image:<span class="req_star">*</span></label>
                    <div class="row">
                        {{-- do work --}}
                        <div class="col-sm-12">
                          <div class="input-group">
                              <span class="input-group-btn">
                                  <span class="btn btn-default btn-file btnu_browse">
                                      Browse… <input type="file" name="passport_image" onchange="passport_imageUrl(this)">
                                  </span>
                              </span>
                              <input type="text" class="form-control" readonly>
                          </div>
                          <img src="" id="passport_imageShow" style="margin:10px 0px">
                        </div>
                        {{-- do work --}}
                    </div>
                    <button type="submit" class="btn btn-primary waves-effect">SAVE & CHANGE</button>
                  </form>
                </div>

              </div>
              {{-- Image --}}
            </div>
            {{-- visa information --}}
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

    {{-- for image --}}
    <script>
      function customer_photoUrl(input){
        if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function(e){
              $('#customer_photoShow').attr('src',e.target.result).width(150)
                    .height(150);
          };
          reader.readAsDataURL(input.files[0]);


        }
      }
      function visa_imageUrl(input){
        if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function(e){
              $('#visa_imageShow').attr('src',e.target.result).width(150)
                    .height(150);
          };
          reader.readAsDataURL(input.files[0]);


        }
      }
      function passport_imageUrl(input){
        if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function(e){
              $('#passport_imageShow').attr('src',e.target.result).width(150)
                    .height(150);
          };
          reader.readAsDataURL(input.files[0]);


        }
      }
    </script>
@endsection
