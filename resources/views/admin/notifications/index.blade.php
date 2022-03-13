@extends('layouts.backend_master')
@section('content')

<div class="row bread_part">
    <div class="col-sm-12 bread_col">
        <h4 class="pull-left page-title bread_title">User Contact Massege List</h4>
        <ol class="breadcrumb pull-right">
            <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="active">User Contact Massege List</li>
        </ol>
    </div>
</div>

{{-- response massage --}}
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        @if(Session::has('success_delete'))
          <div class="alert alert-success alertsuccess" role="alert">
             <strong>Successfully!</strong> Delete This Massege.
          </div>
        @endif
    </div>
    <div class="col-md-2"></div>
</div>
{{-- response massage --}}

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="card-title card_top_title"><i class="fab fa-gg-circle mr-2"></i>Massege List</h3>
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
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Subject</th>
                                        <th>Massege</th>
                                        <th style="text-align:center">Manage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @forelse($notifications as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->telephone }}</td>
                                        <td>{{ $item->subject }}</td>
                                        <td>
                                          <textarea name="name" rows="8" cols="80" style="width:120px; height: 100px">
                                            {{ $item->message }}
                                          </textarea>
                                        </td>
                                        <td>
                                            <div class="action_section">
                                              <a href="{{ route('contact-massage.delete',$item->id) }}" title="delete" id="delete"><i class="fas fa-trash-alt fa-lg delete_icon"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                  @empty
                                      <p class="data_not_found">Data Not Found</p>
                                  @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
