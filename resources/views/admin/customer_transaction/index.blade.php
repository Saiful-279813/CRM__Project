@extends('layouts.admin')
@section('content')
  {{-- breadcrumb --}}
  <div class="row">
      <div class="col-12">
          <div class="page-title-box d-flex align-items-center justify-content-between">
              <h4 class="mb-0 font-size-18">Customer Transaction</h4>
              <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                      <li class="breadcrumb-item active">Customer Transaction</li>
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
               <strong>Successfully!</strong> Save & Change Customer Transaction.
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

  <div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header custom-card-header">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="card-title card_top_title"><i class="fab fa-gg-circle mr-2"></i>All Customer Transaction </h3>
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
                                      <th>Customer</th>
                                      <th>Full Contact</th>
                                      <th>Total Pay</th>
                                      <th>Due To Admin</th>
                                      <th>Total Cost</th>
                                      <th>Action</th>
                                    </tr>
                                </thead>
                                {{-- main work --}}
                                <tbody>
                                   @forelse ($transaction as $data)
                                   <tr>
                                     <td> {{ $loop->iteration }} </td>
                                     <td> {{ $data->customer_id_number }} <br> {{ $data->customer_name }} </td>
                                     <td>{{ $data->full_contact }}</td>
                                     <td>{{ $data->total_pay }}</td>
                                     <td>{{ $data->due_to_admin }}</td>
                                     <td>{{ $data->cost }}</td>
                                     <td style="width:17%">
                                        <a class="btn btn-primary btn-sm" href="{{ route('customer-trnasaction.edit',$data->cust_trans_id) }}"><i class="fas fa-edit"></i></a>
                                        <a class="btn btn-success btn-sm" href="{{ route('customer-payment',$data->cust_trans_id) }}"><i class="fab fa-amazon-pay"></i></a>
                                     </td>
                                   </tr>
                                  @empty
                                    <p style="color:red">Customer Not Assigned!</p>
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
