@extends('layouts.backend_master')
@section('content')
{{-- @section('order') active @endsection --}}

@if($order->status == 'Pending')
  @section('newOrder') active @endsection
@endif


<div class="row bread_part">
    <div class="col-sm-12 bread_col">
        <h4 class="pull-left page-title bread_title">View Order</h4>
        <ol class="breadcrumb pull-right">
            <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="active">View Order</li>
        </ol>
    </div>
</div>
{{-- do work --}}
<div class="row">
  <div class="col-lg-12">
      <div class="card">
        {{-- card header --}}
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col-md-8">
                  <div class="invoice">
                      <p style="margin-bottom: 5px;"> <strong>Invoice No : </strong> {{ $order->invoice_no }}  </p>
                      <p style="margin-bottom: 5px;"> <strong>Order No : </strong> {{ $order->order_number }} </p>
                  </div>
                </div>
                <div class="col-md-4">
                    <div class="logo" style="text-align:right">
                        <img style="width:160px; height: 100px" src="{{ asset('contents/common') }}/logo/logo.png" alt="">
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
              {{-- order information --}}
              <div class="col-md-6">
                <ul class="list-group">
                    <li class="list-group-item active text-center" style="background: #162025; color: #fff; font-weight: bold">Invoice Information</li>
                    <li class="list-group-item">
                        <strong>Name:</strong> {{ $order->name }}
                    </li>
                    <li class="list-group-item">
                        <strong>Phone:</strong>
                        {{ $order->phone }}
                    </li>
                    <li class="list-group-item">
                        <strong>Email:</strong>
                        {{ $order->email }}
                    </li>
                    <li class="list-group-item">
                        <strong>Post Code:</strong>
                        {{ $order->post_code }}
                    </li>
                    <li class="list-group-item">
                        <strong>Order Date:</strong>
                        {{ $order->order_date }}
                    </li>
                    <li class="list-group-item">
                        <strong> Address :</strong>
                        {{ $order->division }}, {{ $order->district }}, {{ $order->thana }}
                    </li>
                    <li class="list-group-item">
                        <strong> Post Code :</strong>
                        {{ $order->post_code }}
                    </li>
                    <li class="list-group-item">
                        <strong> Notes :</strong>
                        {{ $order->notes }}
                    </li>
                </ul>
              </div>
              {{-- order information --}}
              <div class="col-md-6">
                {{-- do work --}}
                <ul class="list-group">
                    <li class="list-group-item active text-center" style="background: #162025; color: #fff; font-weight: bold">Order Information</li>
                    <li class="list-group-item">
                        <strong>Name:</strong> {{ $order->user->name }}
                    </li>
                    <li class="list-group-item">
                        <strong>Phone:</strong>
                        {{ $order->user->phone == NULL ? 'Not Entry' : $order->user->phone }}
                    </li>
                    <li class="list-group-item">
                        <strong>Payment By:</strong>
                        {{ $order->payment_method }}
                    </li>
                    <li class="list-group-item">
                        <strong>TNX Id:</strong>
                        {{ $order->transaction_id }}
                    </li>

                    <li class="list-group-item">
                        <strong>Order Total:</strong>
                        {{ $order->amount }}Tk
                    </li>

                    <li class="list-group-item">
                        <strong>Order Status:</strong>
                        <span class="badge badge-pill badge-primary">{{ $order->status }}</span>
                    </li>

                    <li class="list-group-item" style="display:flex; justify-content: space-between; align-items:center">
                        @if ($order->status == 'Pending')
                        <a href="{{ route('order.confirm',$order->id) }}" class="m-2 btn btn-block btn-success" id="confirm">Confirm Order</a>
                        <a href="{{ route('pendingToCancel',$order->id) }}" class="m-2 btn btn-block btn-danger" id="cancel">Cancel Order</a>
                        @elseif($order->status == 'Confirm')
                        <a href="{{ route('confirm-to-sale',$order->id) }}" class="m-2 btn btn-block btn-success" id="sale">Sale</a>
                        @endif
                        @if ($order->status != 'Pending')
                          <a href="" style="margin:0" class="btn btn-block btn-danger m-2" id="processing"><i class="fas fa-download"></i></a>
                        @endif
                    </li>

                </ul>
                {{-- do work --}}
              </div>
            </div>

        </div>
        <div class="card-body">
          <div class="table-responsive">
              <table id="alltableinfo" class="table table-bordered custom_table mb-0">
                  <thead>
                      <tr>
                          <th>
                              <label for="">Image</label>
                          </th>
                          <th>
                              <label for="">Poduct Name</label>
                          </th>

                          <th>
                              <label for="">Poduct Code</label>
                          </th>

                          <th>
                              <label for="">Price</label>
                          </th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach ($orderItems as $item)
                      <tr>
                        <td><img src="{{ asset($item->product->product_thambnail) }}" height="50px;" width="50px;" alt="imga"></td>
                        <td>
                            <div style="width:210px"><strong>{{ $item->product->product_name }}</strong>
                            </div>
                        </td>

                        <td>
                            <strong>{{ $item->product->product_code }}</strong>
                        </td>

                        <td>
                            <strong>৳{{ $item->price }} X {{ $item->qty }} ({{ $item->price * $item->qty }})</strong>
                            <br>
                            <strong>৳{{ ($item->price * $item->qty) - $item->order->amount }}(Discount)</strong>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
              </table>
          </div>
        </div>
        {{-- card body --}}
        {{-- card footer --}}
      </div>
  </div>
</div>
{{-- do work --}}
@endsection
