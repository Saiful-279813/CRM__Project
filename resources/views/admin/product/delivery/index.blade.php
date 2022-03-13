@extends('layouts.backend_master')
@section('content')

<div class="row bread_part">
    <div class="col-sm-12 bread_col">
        <h4 class="pull-left page-title bread_title">Delivery information List</h4>
        <ol class="breadcrumb pull-right">
            <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="active">Delivery information List</li>
        </ol>
    </div>
</div>

{{-- response massage --}}
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        @if(Session::has('success_delete'))
          <div class="alert alert-success alertsuccess" role="alert">
             <strong>Successfully!</strong> Delete Delivery information information.
          </div>
        @endif

        @if(Session::has('success_update'))
          <div class="alert alert-success alertsuccess" role="alert">
             <strong>Successfully!</strong> Update Delivery information information.
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
{{-- response massage --}}

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="card-title card_top_title"><i class="fab fa-gg-circle mr-2"></i>Delivery information List</h3>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="{{ route('pdelivery.create') }}" class="btn btn-md btn-primary waves-effect card_top_button"><i class="fa fa-plus-circle mr-2"></i>Add New Delivery information</a>
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
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Content</th>
                                        <th style="text-align:center">Manage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @forelse($all as $item)
                                    <tr>
                                        <td class="image_td">
                                          <img src="{{ asset($item->image) }}" alt="No Image" class="list_image">
                                        </td>
                                        <td>{{ $item->title == NULL ? 'NO Title' : $item->title }}</td>
                                        <td>{{ $item->content == NULL ? 'NO Content' : $item->content }}</td>
                                        <td>
                                            {{-- <a href="#" title="view"><i class="fa fa-plus-square fa-lg view_icon"></i></a> --}}
                                            <div class="action_section">
                                              <a href="{{ route('pdelivery.edit',$item->id) }}" title="edit"><i class="fa fa-pencil-square fa-lg edit_icon"></i></a>

                                              <a href="{{ route('pdelivery.delete',$item->id) }}" title="delete" id="delete"><i class="fas fa-trash-alt fa-lg delete_icon"></i></a>

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
