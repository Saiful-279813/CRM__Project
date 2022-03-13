@extends('layouts.fontend_master')
@section('styles')
  {{-- <link href="{{asset('contents/admin')}}/assets/css/style.css" rel="stylesheet" type="text/css" /> --}}
  <style media="screen">
    .status_order {
      background: #3BB77E;
      color: #fff;
      padding: 5px;
      border-radius: 5px;
      margin-left: 10px;
    }

    .list-group-item.active {
    	background-color: #3BB77E;
    	border-color: #3BB77E;
    }
  </style>
@endsection

@section('content')
{{-- do work --}}
<main class="main pages">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Order Details
            </div>
        </div>
    </div>

    {{-- response massage --}}
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            @if(Session::has('success_store'))
              <div class="alert alert-success alertsuccess" role="alert">
                 <strong>Successfully!</strong> Change Your Profile.
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

    <div class="page-content pt-50 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 m-auto">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="dashboard-menu">
                                <ul class="nav flex-column" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('user.dashboard') }}"><i class="fi-rs-settings-sliders mr-10"></i>Dashboard</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active"><i class="fi-rs-shopping-bag mr-10"></i>Orders</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="tab-content account dashboard-content pl-50">
                                {{-- order details --}}
                                <div>
                                    <div class="card">
                                      {{-- do work --}}
                                      <div class="row">
                                          <div class="col-md-6">
                                              <ul class="list-group">
                                                  <li class="list-group-item active text-center">Shipping Information</li>
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
                                                      <strong>Address:</strong>
                                                      {{ $order->division }}, {{ $order->district }}, {{ $order->thana }}
                                                  </li>

                                                  <li class="list-group-item">
                                                      <strong>Post Code:</strong>
                                                      {{ $order->post_code }}
                                                  </li>
                                                  <li class="list-group-item">
                                                      <strong>Order Date:</strong>
                                                      {{ $order->order_date }}
                                                  </li>
                                              </ul>
                                          </div>

                                          <div class="col-md-6">
                                              <ul class="list-group">
                                                  <li class="list-group-item active text-center">Order Information</li>
                                                  <li class="list-group-item">
                                                      <strong>Name:</strong> {{ $order->user->name }}
                                                  </li>
                                                  <li class="list-group-item">
                                                      <strong>Email:</strong>
                                                      {{ $order->user->email }}
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
                                                      <strong>Invoice No:</strong>
                                                      {{ $order->invoice_no }}
                                                  </li>
                                                  <li class="list-group-item">
                                                      <strong>Total Amount:</strong>
                                                      {{ $order->amount }}৳
                                                  </li>

                                                  <li class="list-group-item">
                                                      <strong>Order Status:</strong>
                                                      <span class="status_order">{{ $order->status }}</span> <br>

                                                  </li>

                                                  @php
                                                  $order_r = App\Models\Order::where('id',$order->id)->where('return_reason','=',NULL)->first();
                                                  @endphp

                                                  @if (!$order_r)
                                                  <li class="list-group-item">
                                                      <span class="badge badge-pill badge-warning" style="background: red; text:white;">You Have Send a Return Request</span>
                                                  </li>
                                                  @endif
                                              </ul>
                                          </div>

                                          <div class="row mt-3">
                                              <div class="col-md-12 m-auto">
                                                  <div class="table-responsive">
                                                      <table class="table">
                                                          <thead>
                                                              <tr style="background: #E9EBEC;">
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
                                                                @if ($order->status == 'Sale')
                                                                  <th>
                                                                      <label for="">Review</label>
                                                                  </th>
                                                                @endif
                                                              </tr>
                                                          </thead>
                                                          <tbody>
                                                              @foreach ($orderItem as $item)
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

                                                                  @if ($order->status == 'Sale')
                                                                  <td>
                                                                      <a href="{{ route('review-create',$item->product_id) }}">write a review</a>
                                                                  </td>
                                                                  @endif

                                                              </tr>
                                                              @endforeach
                                                          </tbody>
                                                      </table>
                                                  </div>
                                              </div>
                                          </div>

                                      </div>
                                      {{-- do work --}}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
