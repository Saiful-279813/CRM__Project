@extends('layouts.admin')
@section('employee') active mm-active @endsection
@section('advancePay') active @endsection
@section('content')
  {{-- breadcrumb --}}
  <div class="row">
      <div class="col-12">
          <div class="page-title-box d-flex align-items-center justify-content-between">
              <h4 class="mb-0 font-size-18">Advance Payment List</h4>
              <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                      <li class="breadcrumb-item active">Advance Payment List</li>
                  </ol>
              </div>
          </div>
      </div>
  </div>
  {{-- response massege --}}
  <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8">
          @if(Session::has('advance_approve_success'))
            <div class="alert alert-success alertsuccess" role="alert">
               <strong>Successfully!</strong> Approve Advance Payment.
            </div>
          @endif
          @if(Session::has('delete_success'))
            <div class="alert alert-success alertsuccess" role="alert">
               <strong>Successfully!</strong> Delete This Advance Payment Information.
            </div>
          @endif

      </div>
      <div class="col-md-2"></div>
  </div>

  <div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header custom-card-header">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="card-title card_top_title"><i class="fab fa-gg-circle mr-2"></i>All Advance Payment</h3>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="{{ route('employee-advance-pay') }}" class="btn btn-md btn-primary waves-effect card_top_button"><i class="fa fa-plus-circle mr-2"></i>Advance Payment For Employee</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table id="alltableinfo" class="table table-bordered custom_table mb-0">
                                <thead>
                                    <tr>
                                      <th>No</th>
                                      <th>Date</th>
                                      <th>Employee</th>
                                      <th>Amount</th>
                                      <th>Remarks</th>
                                      <th>Status</th>
                                      <th>Action</th>
                                    </tr>
                                </thead>
                                {{-- main work --}}
                                <tbody>
                                   @forelse ($dataList as $data)
                                   <tr>
                                     <td> {{ $loop->iteration }} </td>
                                     <td> {{ $data->entry_date }} </td>
                                     <td> {{ $data->employee_name }} ({{ $data->ID_Number }}) <br> {{ $data->basic_amount }} (Basic Salary) </td>

                                     <td>{{ $data->adv_pay_amount }}</td>
                                     <td>{{ $data->adv_pay_remarks }}</td>
                                     <td><span class="badge bg-primary" style="color:#fff; font-weight:bold">{{ $data->status == 1 ? 'Approve' : 'Pending' }}</span></td>

                                     <td style="width:17%">
                                        @if($data->status == 0)
                                          <a class="btn btn-primary btn-sm" href="{{ route('employee-advance-pay-approve',$data->id) }}" id="confirm"><i class="fas fa-thumbs-up"></i></a>

                                          <a class="btn btn-warning btn-sm" href="{{ route('employee-advance-pay-delete',$data->id) }}" id="delete"><i class="fas fa-trash-alt"></i></a>
                                        @else
                                          ----
                                        @endif

                                     </td>

                                    </tr>
                                    @empty
                                      <p style="color:red">Data Not Assigned!</p>
                                    @endforelse
                                 </tbody>
                                {{-- main work --}}
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
  {{-- do work --}}
@endsection
