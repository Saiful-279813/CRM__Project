@extends('layouts.admin')
@section('customer') active mm-active @endsection
@section('customerVisa') active @endsection
@section('styles')
  <style media="screen">
    .form-check-label{
      cursor: pointer;
    }
  </style>
@endsection
@section('content')
  {{-- breadcrumb --}}
  <div class="row">
      <div class="col-12">
          <div class="page-title-box d-flex align-items-center justify-content-between">
              <h4 class="mb-0 font-size-18">Visa Information</h4>
              <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                      <li class="breadcrumb-item active">Visa Information</li>
                  </ol>
              </div>
          </div>
      </div>
  </div>
  {{-- response massege --}}
  <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8">
          @if(Session::has('success_store_first_step'))
            <div class="alert alert-success alertsuccess" role="alert">
               <strong>Successfully!</strong> Done First Step.
            </div>
          @endif

          @if(Session::has('success_update'))
            <div class="alert alert-success alertsuccess" role="alert">
               <strong>Successfully!</strong> Save & Change Visa Information.
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
        <form class="form-horizontal" method="post" action="{{ route('customer-visa.updated',$data->customer_visa_id) }}" enctype="multipart/form-data" id="customerForm">
          @csrf
          <div class="card">
            <div class="card-header custom-card-header">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="card-title card_top_title"><i class="fab fa-gg-circle"></i> Visa Information</h3>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="{{ route('customer-visa.index') }}" class="btn btn-md btn-primary waves-effect card_top_button"><i class="fa fa-th"></i> Visa List </a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="card-body card_form">
                <div class="row">
                  <div class="form-group custom_form_group col-md-6 m-auto">
                      <label class="control-label">Visa Number:<span class="req_star">*</span></label>
                      <div class="">
                          <input type="text" placeholder="Visa Number" class="form-control" name="visa_number" value="{{ $data->visa_number }}" required data-parsley-pattern="[0-9]+$" min="0" data-parsley-length="[1,50]" data-parsley-trigger="keyup">
                          @error('visa_number')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                  <div class="form-group custom_form_group col-md-6 m-auto">
                      <label class="control-label">Passport Number:<span class="req_star">*</span></label>
                      <div class="">
                          <input type="text" placeholder="Passport Number" class="form-control" name="passport_number" value="{{ $data->passport_number }}" required data-parsley-pattern="[0-9]+$" min="0" data-parsley-length="[1,50]" data-parsley-trigger="keyup">
                          @error('passport_number')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                </div>
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
                          <select class="form-control" name="visa_type_id" id="search_select2" required>
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
                  <div class="form-group custom_form_group col-md-6 m-auto">
                      <label class="control-label">Visa Name:<span class="req_star">*</span></label>
                      <div class="">
                          <input type="text" placeholder="Visa Name..." class="form-control" name="visa_name" value="{{ $data->visa_name }}" required data-parsley-pattern="[a-zA-Z_ ]+$" data-parsley-length="[3,20]" data-parsley-trigger="keyup">
                          @error('visa_name')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                  <div class="form-group custom_form_group col-md-6 m-auto">
                      <label class="control-label">Medical:<span class="req_star">*</span></label>
                      <div class="">
                          <select class="form-control" name="medical" required>
                            <option value="1" {{ $data->medical == 1 ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ $data->medical == 0 ? 'selected' : '' }}>No</option>
                          </select>
                          @error('medical')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group custom_form_group col-md-6 m-auto">
                      <label class="control-label">Report:<span class="req_star">*</span></label>
                      <div class="">
                          <select class="form-control" name="report" required>
                            <option value="">Select Status</option>
                            <option value="FIT" {{ $data->report == 'FIT' ? 'selected' : '' }}>FIT</option>
                            <option value="UNFIT" {{ $data->report == 'UNFIT' ? 'selected' : '' }}>UNFIT</option>
                            <option value="Pending" {{ $data->report == 'Pending' ? 'selected' : '' }}>Pending</option>
                          </select>
                      </div>
                  </div>
                  <div class="form-group custom_form_group col-md-6 m-auto">
                      <label class="control-label">Medical Date:<span class="req_star">*</span></label>
                      <div class="">
                          <input type="date" class="form-control" name="madical_date" value="{{ $data->madical_date == "" ? Carbon\Carbon::now()->format('Y-m-d') : $data->madical_date }}" required>
                          @error('madical_date')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group custom_form_group col-md-6 m-auto">
                      <label class="control-label">From Date:<span class="req_star">*</span></label>
                      <div class="">
                          <input type="date" class="form-control" name="from_date" value="{{ $data->from_date == "" ? Carbon\Carbon::now()->format('Y-m-d') : $data->from_date }}" required>
                          @error('from_date')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                  <div class="form-group custom_form_group col-md-6 m-auto">
                      <label class="control-label">To Date:<span class="req_star">*</span></label>
                      <div class="">
                          <input type="date" class="form-control" name="to_date" value="{{ $data->to_date == "" ? Carbon\Carbon::now()->format('Y-m-d') : $data->to_date }}" required>
                          @error('to_date')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                </div>
                {{-- redio button --}}
                <div class="row">
                  <div class="form-group custom_form_group col-md-3">
                      <label class="control-label">Vacxin:<span class="req_star">*</span></label>
                      <div class="">
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="vecxin" id="vecxin_yes" {{ $data->vecxin == NULL ? 'checked' : '' }} {{ $data->vecxin == 1 ? 'checked' : '' }} value="1">
                          <label class="form-check-label" for="vecxin_yes">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="vecxin" id="vecxin_no" value="0" {{ $data->vecxin == 0 ? 'checked' : '' }}>
                          <label class="form-check-label" for="vecxin_no">No</label>
                        </div>
                      </div>
                  </div>
                  <div class="form-group custom_form_group col-md-3">
                      <label class="control-label">PC:<span class="req_star">*</span></label>
                      <div class="">
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="PC" id="PC_yes" checked value="1">
                          <label class="form-check-label" for="PC_yes">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="PC" id="PC_no" value="0">
                          <label class="form-check-label" for="PC_no">No</label>
                        </div>
                      </div>
                  </div>
                  <div class="form-group custom_form_group col-md-3">
                      <label class="control-label">Training:<span class="req_star">*</span></label>
                      <div class="">
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="training" id="training_yes" checked value="1">
                          <label class="form-check-label" for="training_yes">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="training" id="training_no" value="0">
                          <label class="form-check-label" for="training_no">No</label>
                        </div>
                      </div>
                  </div>
                  <div class="form-group custom_form_group col-md-3">
                      <label class="control-label">Manpower:<span class="req_star">*</span></label>
                      <div class="">
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="manpower" id="manpower_yes" checked value="1">
                          <label class="form-check-label" for="manpower_yes">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="manpower" id="manpower_no" value="0">
                          <label class="form-check-label" for="manpower_no">No</label>
                        </div>
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group custom_form_group col-md-3">
                      <label class="control-label">Ticket:<span class="req_star">*</span></label>
                      <div class="">
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="ticket" id="ticket_yes" checked value="1">
                          <label class="form-check-label" for="ticket_yes">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="ticket" id="ticket_no" value="0">
                          <label class="form-check-label" for="ticket_no">No</label>
                        </div>
                      </div>
                  </div>
                  <div class="form-group custom_form_group col-md-2">
                      <label class="control-label">Visa:<span class="req_star">*</span></label>
                      <div class="">
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="visa" id="visa_yes" checked value="1">
                          <label class="form-check-label" for="visa_yes">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="visa" id="visa_no" value="0">
                          <label class="form-check-label" for="visa_no">No</label>
                        </div>
                      </div>
                  </div>
                  {{-- remarks --}}
                  <div class="col-md-7">
                    <label class="control-label">Visa Remarks:<span class="req_star">*</span></label>
                    <div class="">
                        <textarea name="visa_remarks" rows="8" cols="80" placeholder="Visa Remarks Here..." class="form-control">{{ $data->visa_remarks }}</textarea>
                        @error('visa_remarks')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                  </div>


                </div>
                {{-- redio button --}}
                <div class="row">
                    <div class="col-md-6">
                      <div class="form-group custom_form_group">
                        <label class="control-label">Visa Image:</label>
                        <div class="row">
                          <div class="col-md-8">
                            <div class="input-group mb-2">
                                <span class="input-group-btn">
                                    <span class="btn btn-default btn-file btnu_browse">
                                        Browse… <input type="file" name="visa_image" id="imgInp">
                                    </span>
                                </span>
                                <input type="text" class="form-control" readonly>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <img id="img-upload" style="width:100%!important; margin-top:0"/>
                          </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group custom_form_group">
                        <label class="control-label">Passport Image:</label>
                        <div class="row">
                          <div class="col-md-8">
                            <div class="input-group mb-2">
                                <span class="input-group-btn">
                                    <span class="btn btn-default btn-file btnu_browse">
                                        Browse… <input type="file" name="passport_image" id="imgInp2">
                                    </span>
                                </span>
                                <input type="text" class="form-control" readonly>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <img id="img-upload2" style="width:100%!important; margin-top:0"/>
                          </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>

              <div class="card-footer card_footer_button text-center">
                  <button type="submit" class="btn btn-primary waves-effect">SAVE & CHANGE</button>
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
