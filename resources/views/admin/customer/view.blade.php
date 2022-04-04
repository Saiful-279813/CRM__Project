@extends('layouts.admin')
@section('customer') active mm-active @endsection
@section('customerList') active @endsection
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
                        <td>Full Contact</td>
                        <td>:</td>
                        <td>{{$data->full_contact}}</td>
                      </tr>
                      <tr>
                        <td>Total Payment</td>
                        <td>:</td>
                        <td>{{$data->total_pay}}</td>
                      </tr>
                      <tr>
                        <td>Total Due</td>
                        <td>:</td>
                        <td>{{$data->due_to_admin}}</td>
                      </tr>
                      <tr>
                        <td>Pay To Admin</td>
                        <td>:</td>
                        <td>{{$data->payment_to_admin}}</td>
                      </tr>
                      <tr>
                        <td>Total Cost</td>
                        <td>:</td>
                        <td>{{$data->cost}}</td>
                      </tr>
                      <tr>
                        <td>Officer Commision</td>
                        <td>:</td>
                        <td>{{$data->officer_commision}}</td>
                      </tr>
                      <tr>
                        <td>Agent Commision</td>
                        <td>:</td>
                        <td>{{$data->agent_commision}}</td>
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
                        <td>{{$data->name}}</td>
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
                        <td>Refference Officer</td>
                        <td>:</td>
                        <td>{{$data->employee_name}}</td>
                      </tr>

                  </table>
                  <hr>
              </div>
              <div class="col-md-10 m-auto">
                <div class="row">
                  <div class="col-md-2">
                    <p> <strong>Vecxin:</strong> {{ $data->vecxin == 1 ? 'Yes' : 'No' }} </p>
                  </div>
                  <div class="col-md-2">
                    <p> <strong>PC:</strong> {{ $data->PC == 1 ? 'Yes' : 'No' }} </p>
                  </div>
                  <div class="col-md-2">
                    <p style="margin:0"> <strong>Medical:</strong> {{ $data->medical == 1 ? 'Yes' : 'No' }} </p>
                    <p> <strong>Date:</strong> {{ $data->medical_date == NULL ? 'Not Assign' : $data->medical_date }} </p>
                  </div>
                  <div class="col-md-2">
                    <p> <strong>Report:</strong> {{ $data->report }} </p>
                  </div>
                  <div class="col-md-2">
                    <p> <strong>Visa Online:</strong> {{ $data->visa_online == 1 ? 'Yes' : 'No' }} </p>
                  </div>
                  <div class="col-md-2">
                    <p> <strong>Visa:</strong> {{ $data->visa == 1 ? 'Yes' : 'No' }} </p>
                  </div>
                </div>
                {{-- second row --}}
                <div class="row">
                  <div class="col-md-2">
                    <p> <strong>Training:</strong> {{ $data->training == 1 ? 'Yes' : 'No' }} </p>
                  </div>
                  <div class="col-md-2">
                    <p> <strong>Manpower:</strong> {{ $data->manpower == 1 ? 'Yes' : 'No' }} </p>
                  </div>
                  <div class="col-md-2">
                    <p> <strong>Ticket:</strong> {{ $data->ticket == 1 ? 'Yes' : 'No' }} </p>
                  </div>
                    <p> <strong>PP Location:</strong> {{ $data->pp_location }} </p>
                  </div>
                </div>
              </div>
              {{-- do work --}}
            </div>
            <div class="card-footer card_footer_button text-center">
                <a href="{{ route('customers.invoice',$data->customer_id) }}" class="btn btn-primary waves-effect">PDF Or Print</a>
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
