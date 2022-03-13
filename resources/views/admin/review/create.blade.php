@extends('layouts.backend_master')
@section('styles')
  <style media="screen">
    .review_approve{
      font-size: 11px;
      font-weight: bold;
      line-height: 25px;
      padding: 0px 6px;
      margin-left: 5px;
      border-radius: 5px;
    }
  </style>
@endsection
@section('content')

<div class="row bread_part">
    <div class="col-sm-12 bread_col">
        <h4 class="pull-left page-title bread_title">Product Review List</h4>
        <ol class="breadcrumb pull-right">
            <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="active">Product Review List</li>
        </ol>
    </div>
</div>

{{-- response massage --}}
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        @if(Session::has('approve_success'))
          <div class="alert alert-success alertsuccess" role="alert">
             <strong>Successfully!</strong> Approve This Review.
          </div>
        @endif

        @if(Session::has('delete_success'))
          <div class="alert alert-success alertsuccess" role="alert">
             <strong>Successfully!</strong> Delete This Review.
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
                        <h3 class="card-title card_top_title"><i class="fab fa-gg-circle mr-2"></i>Product Review List</h3>
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
                                        <th>Product Image</th>
                                        <th>Customer Name</th>
                                        <th>Comment</th>
                                        <th>Rating</th>
                                        <th>status</th>
                                        <th style="text-align:center">Manage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @forelse($reviews as $review)
                                    <tr>
                                      <td>
                                        <img src="{{ asset($review->product->product_thambnail) }}" alt="" style="width: 100px;">
                                      </td>
                                      <td>{{ $review->user->name }}</td>
                                      <td>
                                          <textarea name="" id="" cols="40" disabled rows="2" style="padding: 10px">{{ $review->comment }}</textarea>
                                      </td>
                                      <td>{{ $review->rating }}
                                        @for ($i =1 ; $i <= 5 ; $i++)
                                            <span style="color: red; font-size:15px;" class="glyphicon glyphicon-star{{ ($i <= $review->rating) ? '' : '-empty' }}"></span>
                                        @endfor
                                      </td>
                                      <td>
                                          <span class="badg badge-pill badge-success">{{ $review->status }}</span>
                                          @if ($review->status == 'pending')
                                            <a href="{{ route('review-approve',$review->id) }}"  class="btn review_approve btn-sm btn-primary">Approve</a>
                                          @endif
                                      </td>
                                      <td>
                                        <a href="{{ route('review-delete',$review->id) }}" class="btn btn-sm btn-danger" id="delete" title="delete data"><i class="fa fa-trash"></i></a>
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
