@extends('layouts.backend_master')
@section('content')
  {{-- breadcrumb --}}
  <div class="row bread_part">
      <div class="col-sm-12 bread_col">
          <h4 class="pull-left page-title bread_title">Dashboard</h4>
          <ol class="breadcrumb pull-right">
              <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
              <li class="active">User Part</li>

          </ol>
      </div>
  </div>
  {{-- breadcrumb --}}
  <div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="card-title card_top_title"><i class="fab fa-gg-circle mr-2"></i>All User</h3>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="{{ route('users.create') }}" class="btn btn-md btn-primary waves-effect card_top_button"><i class="fa fa-plus-circle mr-2"></i>Create New User</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                      {{-- error throgh --}}
                      @if ($message = Session::get('success'))
                      <div class="alert alert-success" role="alert">
                        <p>{{ $message }}</p>
                      </div>
                      @endif
                      {{-- error throgh --}}
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table id="alltableinfo" class="table table-bordered custom_table mb-0">
                                <thead>
                                    <tr>
                                      <th>No</th>
                                      <th>Name</th>
                                      <th>Email</th>
                                      <th>Roles</th>
                                      <th>Action</th>
                                    </tr>
                                </thead>
                                {{-- main work --}}
                                <tbody>
                                   @foreach ($data as $key => $user)
                                   <tr>
                                     <td>{{ ++$i }}</td>
                                     <td>{{ $user->name }}</td>
                                     <td>{{ $user->email }}</td>
                                     <td>
                                       @if(!empty($user->getRoleNames()))
                                         @foreach($user->getRoleNames() as $v)
                                            <label class="badge badge-success">{{ $v }}</label>
                                         @endforeach
                                       @endif
                                     </td>
                                     <td>
                                        {{-- <a class="btn btn-info btn-sm" href="{{ route('users.show',$user->id) }}"><i class="fas fa-eye"></i></a> --}}
                                        <a class="btn btn-primary btn-sm" href="{{ route('users.edit',$user->id) }}"><i class="fas fa-edit"></i></a>
                                         {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                                             <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                         {!! Form::close() !!}
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
@endsection
