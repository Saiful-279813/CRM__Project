@extends('layouts.backend_master')
@section('content')

<div class="row bread_part">
    <div class="col-sm-12 bread_col">
        <h4 class="pull-left page-title bread_title">Product List</h4>
        <ol class="breadcrumb pull-right">
            <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="active">Product List</li>
        </ol>
    </div>
</div>

{{-- response massage --}}
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        @if(Session::has('success_delete'))
          <div class="alert alert-success alertsuccess" role="alert">
             <strong>Successfully!</strong> Delete Product information.
          </div>
        @endif

        @if(Session::has('success_update'))
          <div class="alert alert-success alertsuccess" role="alert">
             <strong>Successfully!</strong> Update Product information.
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
                        <h3 class="card-title card_top_title"><i class="fab fa-gg-circle mr-2"></i> Product List</h3>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="{{ route('products.create') }}" class="btn btn-md btn-primary waves-effect card_top_button"><i class="fa fa-plus-circle mr-2"></i>Add New Product</a>
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
                                        <th>Category</th>
                                        <th>Second Category</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th style="text-align:center">Manage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @forelse($data as $item)
                                    <tr>
                                        <td>{{ Str::words($item->category->category_name,15) }}</td>
                                        <td>{{ Str::words($item->subcategory->subcategory_name,15) }}</td>
                                        <td>{{ Str::words($item->product_name,15) }}</td>
                                        <td>
                                          <img src="{{ asset($item->product_thambnail) }}" alt="No Image" width="100" height="100">
                                        </td>
                                        <td>
                                            <div class="action_section">
                                              <a href="{{ route('products.show',$item->id) }}" title="view"><i class="fa fa-plus-square fa-lg view_icon"></i></a>
                                              <a href="{{ route('products.edit',$item->id) }}" title="edit"><i class="fa fa-pencil-square fa-lg edit_icon"></i></a>

                                              <a href="{{ route('products.delete',$item->id) }}" id="delete" class="delete_button"><i class="fas fa-trash-alt fa-lg delete_icon"></i></a>
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
