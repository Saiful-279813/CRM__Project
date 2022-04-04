@extends('layouts.admin')
@section('content')
  {{-- breadcrumb --}}
  <div class="row">
      <div class="col-12">
          <div class="page-title-box d-flex align-items-center justify-content-between">
              <h4 class="mb-0 font-size-18">Expense Category</h4>
              <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                      <li class="breadcrumb-item active">Expense Category</li>
                  </ol>
              </div>
          </div>
      </div>
  </div>
  {{-- response massege --}}
  <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8">
          @if(Session::has('success_update'))
            <div class="alert alert-success alertsuccess" role="alert">
               <strong>Successfully!</strong> Update Expense Category.
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
                        <h3 class="card-title card_top_title"><i class="fab fa-gg-circle mr-2"></i>All Expense Category</h3>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="{{ route('expense-category.create') }}" class="btn btn-md btn-primary waves-effect card_top_button"><i class="fa fa-plus-circle mr-2"></i>Create Expense Category</a>
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
                                      <th>Category Name</th>
                                      <th>Remarks</th>
                                      <th>Action</th>
                                    </tr>
                                </thead>
                                {{-- main work --}}
                                <tbody>
                                   @forelse ($category as $data)
                                   <tr>
                                     <td> {{ $loop->iteration }} </td>
                                     <td>{{ $data->exp_cat_name }}</td>
                                     <td>{{ $data->exp_cat_remarks }}</td>
                                     <td style="width:17%">
                                        <a class="btn btn-success btn-sm" href="{{ route('expense-category.show',$data->exp_cat_id) }}"><i class="fas fa-eye"></i></a>
                                        <a class="btn btn-primary btn-sm" href="{{ route('expense-category.edit',$data->exp_cat_id) }}"><i class="fas fa-edit"></i></a>
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
