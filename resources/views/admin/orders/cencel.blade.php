@extends('layouts.backend_master')
@section('name')

@endsection
@section('content')

<div class="row bread_part">
    <div class="col-sm-12 bread_col">
        <h4 class="pull-left page-title bread_title">Cencel Order List</h4>
        <ol class="breadcrumb pull-right">
            <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="active">Cencel Order List</li>
        </ol>
    </div>
</div>

{{-- response massage --}}
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        @if(Session::has('confirm_success'))
          <div class="alert alert-success alertsuccess" role="alert">
             <strong>Successfully!</strong> Confirm This Order.
          </div>
        @endif

        @if(Session::has('success_delete'))
          <div class="alert alert-success alertsuccess" role="alert">
             <strong>Successfully!</strong> Delete Order information.
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
                        <h3 class="card-title card_top_title"><i class="fab fa-gg-circle mr-2"></i>New Order List</h3>
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
                                        <th>Order</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                        <th style="text-align:center">Manage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @forelse($orders as $order)
                                    <tr>
                                        <td>{{ $order->order_number }}</td>
                                        <td>{{ $order->order_date }}</td>
                                        <td>{{ $order->status }}</td>
                                        <td>৳ {{ $order->amount }} for {{ $order->orderItem->count() }} Items </td>
                                        <td>
                                            <div class="action_section">
                                              <a href="{{ route('order.confirm',$order->id) }}" title="view"><i class="fas fa-check-circle fa-lg view_icon"></i></a>
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
