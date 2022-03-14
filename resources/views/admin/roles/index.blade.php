@extends('layouts.admin')
@section('content')
  {{-- breadcrumb --}}
  <div class="row">
      <div class="col-12">
          <div class="page-title-box d-flex align-items-center justify-content-between">
              <h4 class="mb-0 font-size-18"> User Role</h4>
              <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                      <li class="breadcrumb-item active">User Role</li>
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
               <strong>Successfully!</strong> Update User Role.
            </div>
          @endif

          @if(Session::has('delete_success'))
            <div class="alert alert-success alertsuccess" role="alert">
               <strong>Successfully!</strong> Delete User Role.
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
                        <h3 class="card-title card_top_title"><i class="fab fa-gg-circle mr-2"></i>All User Role</h3>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="{{ route('roles.create') }}" class="btn btn-md btn-primary waves-effect card_top_button"><i class="fa fa-plus-circle mr-2"></i>Create New User</a>
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
                                    <th>Name</th>
                                    <th>Action</th>
                                  </tr>
                              </thead>
                              {{-- main work --}}
                              <tbody>
                                 @foreach ($roles as $key => $role)
                                 <tr>
                                   <td>{{ ++$i }}</td>
                                   <td>{{ $role->name }}</td>
                                   <td>
                                      {{-- <a class="btn btn-info btn-sm" href="{{ route('users.show',$user->id) }}"><i class="fas fa-eye"></i></a> --}}
                                      @can('role-edit')
                                      <a class="btn btn-primary btn-sm" href="{{ route('roles.edit',$role->id) }}"><i class="fas fa-edit"></i></a>
                                      @endcan

                                      @can('role-delete')
                                       <a class="btn btn-danger btn-sm" id="delete" href="{{ route('roles.delete',$role->id) }}"><i class="fas fa-trash-alt"></i></a>
                                      @endcan
                                   </td>
                                 </tr>
                                 @endforeach
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
