@extends('layouts.admin')
@section('content')
  {{-- breadcrumb --}}
  <div class="row">
      <div class="col-12">
          <div class="page-title-box d-flex align-items-center justify-content-between">
              <h4 class="mb-0 font-size-18">Income</h4>
              <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                      <li class="breadcrumb-item active">Income</li>
                  </ol>
              </div>
          </div>
      </div>
  </div>
  {{-- response massege --}}
  <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8">
          @if(Session::has('approve'))
            <div class="alert alert-success alertsuccess" role="alert">
               <strong>Successfully!</strong> Approve Income & Store In System.
            </div>
          @endif
          @if(Session::has('delete'))
            <div class="alert alert-success alertsuccess" role="alert">
               <strong>Successfully!</strong> Delete Income & Destroy In System.
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
                        <h3 class="card-title card_top_title"><i class="fab fa-gg-circle mr-2"></i>Pending Income</h3>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="{{ route('income.create') }}" class="btn btn-md btn-primary waves-effect card_top_button"><i class="fa fa-plus-circle mr-2"></i>Add Income</a>
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
                                      <th>Date</th>
                                      <th>Category Name</th>
                                      <th>Remarks</th>
                                      <th>Amount</th>
                                      <th>Action</th>
                                    </tr>
                                </thead>
                                {{-- main work --}}
                                <tbody>
                                   @forelse ($pendingIncome as $data)
                                   <tr>
                                     <td>{{ $data->income_date }}</td>
                                     <td>{{ $data->in_cat_name }}</td>
                                     <td>{{ $data->income_details }}</td>
                                     <td>{{ $data->income_amount }}</td>
                                     <td style="width:17%">
                                        <a class="btn btn-success btn-sm" id="approve" href="{{ route('approved-income',$data->income_id) }}"><i class="fas fa-thumbs-up"></i></a>

                                        @if($data->income_status == 0)
                                        <a class="btn btn-danger btn-sm" href="{{ route('delete-income',$data->income_id) }}" id="delete"><i class="fas fa-trash-alt"></i></a>
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
