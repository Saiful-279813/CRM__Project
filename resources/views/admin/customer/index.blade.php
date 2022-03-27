@extends('layouts.admin')
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
  {{-- response massege --}}
  <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8">
          @if(Session::has('edit_success'))
            <div class="alert alert-success alertsuccess" role="alert">
               <strong>Successfully!</strong> Update Customer Information.
            </div>
          @endif

          @if(Session::has('delete_success'))
            <div class="alert alert-success alertsuccess" role="alert">
               <strong>Successfully!</strong> Delete Customer Information.
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
                        <h3 class="card-title card_top_title"><i class="fab fa-gg-circle mr-2"></i>All Customer</h3>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="{{ route('customers.create') }}" class="btn btn-md btn-primary waves-effect card_top_button"><i class="fa fa-plus-circle mr-2"></i>Create New Customer</a>
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
                                      <th>Image</th>
                                      <th>Name</th>
                                      <th>Phone</th>
                                      <th>Apply Date</th>
                                      <th>Action</th>
                                    </tr>
                                </thead>
                                {{-- main work --}}
                                <tbody>
                                   @forelse ($customers as $data)
                                   <tr>
                                     <td> {{ $loop->iteration }} </td>
                                     <td>
                                       @if($data->customer_photo == NULL)
                                         <img src="{{asset('contents/admin')}}/assets/images/users/avatar-black.png" alt="" width="100">
                                       @else
                                         <img src="{{ asset($data->customer_photo) }}" alt="" width="100">
                                       @endif
                                     </td>
                                     <td>{{ $data->customer_name }}</td>
                                     <td>{{ $data->customer_phone }}</td>
                                     <td>{{ $data->apply_date }}</td>
                                     <td style="width:17%">
                                        <a class="btn btn-info btn-sm" href="{{ route('customers.show',$data->customer_id) }}"><i class="fas fa-eye"></i></a>
                                        <a class="btn btn-primary btn-sm" href="{{ route('customers.edit',$data->customer_id) }}"><i class="fas fa-edit"></i></a>
                                        <a class="btn btn-danger btn-sm" id="delete" href="{{ route('customers.delete',$data->customer_id) }}"><i class="fas fa-trash-alt"></i></a>
                                        <a class="btn btn-success btn-sm" href="#"><i class="fas fa-download"></i></a>
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
