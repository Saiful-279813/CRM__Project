@extends('layouts.admin')
@section('customer') active mm-active @endsection
@section('customer_child') active @endsection
@section('content')
  {{-- breadcrumb --}}
  <div class="row">
      <div class="col-12">
          <div class="page-title-box d-flex align-items-center justify-content-between">
              <h4 class="mb-0 font-size-18">Customer</h4>
              <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                      <li class="breadcrumb-item active">Customer</li>
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
                        <h3 class="card-title card_top_title"><i class="fab fa-gg-circle"></i> View Customer Information</h3>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="{{ route('customers.index') }}" class="btn btn-md btn-primary waves-effect card_top_button"><i class="fa fa-th"></i> All Customer List </a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="card-body">
              <div class="col-md-10 m-auto">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group custom_form_group">
                          <label class="control-label">Customer Photo</label>
                          <div class="">
                            <img src="{{ asset($data->customer_photo) }}" alt="" class="img-fluid" style="">
                          </div>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group custom_form_group">
                          <label class="control-label">Visa Image</label>
                          <div class="">
                            <img src="{{ asset($data->visa_image) }}" alt="" class="img-fluid" style="">
                          </div>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group custom_form_group">
                          <label class="control-label">Passport Image</label>
                          <div class="">
                            <img src="{{ asset($data->passport_image) }}" alt="" class="img-fluid" style="">
                          </div>
                      </div>
                    </div>
                  </div>
              </div>
              {{-- do work --}}
              <div class="col-md-8 m-auto">
                  <table class="table table-bordered table-striped table-hover dt-responsive nowrap custom_view_table">
                      <tr>
                        <td>ID Number</td>
                        <td>:</td>
                        <td>{{$data->customer_id_number}}</td>
                      </tr>
                      <tr>
                        <td>Name</td>
                        <td>:</td>
                        <td>{{$data->customer_name}}</td>
                      </tr>
                      <tr>
                        <td>Father Name</td>
                        <td>:</td>
                        <td>{{$data->customer_father}}</td>
                      </tr>
                      <tr>
                        <td>Phone Number</td>
                        <td>:</td>
                        <td>{{$data->customer_phone}}</td>
                      </tr>
                      <tr>
                        <td>Email Address</td>
                        <td>:</td>
                        <td>{{$data->customer_email == NULL ? 'Not Assign' : $data->customer_email}}</td>
                      </tr>
                      <tr>
                        <td>Address</td>
                        <td>:</td>
                        <td>{{$data->customer_address == NULL ? 'Not Assign' : $data->customer_address}}</td>
                      </tr>
                      <tr>
                        <td>Total Cost</td>
                        <td>:</td>
                        <td>{{$data->total_cost}}</td>
                      </tr>
                      <tr>
                        <td>Payment</td>
                        <td>:</td>
                        <td>{{$data->payment}}</td>
                      </tr>
                      <tr>
                        <td>Due</td>
                        <td>:</td>
                        <td>{{$data->due}}</td>
                      </tr>
                      <tr>
                        <td>Visa Number</td>
                        <td>:</td>
                        <td>{{$data->visa_number}}</td>
                      </tr>
                      <tr>
                        <td>Passport Number</td>
                        <td>:</td>
                        <td>{{$data->passport_number}}</td>
                      </tr>
                      <tr>
                        <td>Form Date</td>
                        <td>:</td>
                        <td>{{$data->from_date}}</td>
                      </tr>
                      <tr>
                        <td>To Date</td>
                        <td>:</td>
                        <td>{{$data->to_date}}</td>
                      </tr>
                      <tr>
                        <td>Visa Duration</td>
                        <td>:</td>
                        <td>{{$data->visa_duration}}</td>
                      </tr>
                      <tr>
                        <td>Place Of Issue</td>
                        <td>:</td>
                        <td>{{$data->place_of_issue}}</td>
                      </tr>
                      <tr>
                        <td>Visa Type</td>
                        <td>:</td>
                        <td>{{$data->visa_type}}</td>
                      </tr>
                      <tr>
                        <td>Visa Name</td>
                        <td>:</td>
                        <td>{{$data->visa_name}}</td>
                      </tr>
                      <tr>
                        <td>Visa Remarks</td>
                        <td>:</td>
                        <td>
                          <textarea class="form-control" rows="8" cols="80">{{$data->visa_remarks}}</textarea>
                        </td>
                      </tr>
                      <tr>
                        <td>Apply Date</td>
                        <td>:</td>
                        <td>{{$data->apply_date}}</td>
                      </tr>
                      <tr>
                        <td>Customer Creator</td>
                        <td>:</td>
                        <td>{{ $data->user->id == $data->customer_creator ? $data->user->name : 'Not Found!' }}</td>
                      </tr>

                  </table>
              </div>
              {{-- do work --}}
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
      /* ================ do work ================ */
    </script>
@endsection
