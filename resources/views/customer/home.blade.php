@extends('layouts.fontend_master')

@section('styles')
  <link href="{{asset('contents/admin')}}/assets/css/style.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
{{-- do work --}}
<main class="main pages">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Dashboard
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
                                        <a class="nav-link active" id="dashboard-tab" data-bs-toggle="tab" href="#dashboard" role="tab" aria-controls="dashboard" aria-selected="false"><i class="fi-rs-settings-sliders mr-10"></i>Dashboard</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="orders-tab" data-bs-toggle="tab" href="#orders" role="tab" aria-controls="orders" aria-selected="false"><i class="fi-rs-shopping-bag mr-10"></i>Orders</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="track-orders-tab" data-bs-toggle="tab" href="#track-orders" role="tab" aria-controls="track-orders" aria-selected="false"><i class="fi-rs-shopping-cart-check mr-10"></i>Track Your
                                            Order</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="address-tab" data-bs-toggle="tab" href="#address" role="tab" aria-controls="address" aria-selected="true"><i class="fi-rs-marker mr-10"></i>My Address</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="account-detail-tab" data-bs-toggle="tab" href="#account-detail" role="tab" aria-controls="account-detail" aria-selected="true"><i class="fi-rs-user mr-10"></i>Account details</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="page-login.html"><i class="fi-rs-sign-out mr-10"></i>Logout</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="tab-content account dashboard-content pl-50">
                                <div class="tab-pane fade active show" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="mb-0">Hello {{ Auth::user()->name }}</h3>
                                            <p> Welcome to our <strong>SOWAQ</strong>. </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="mb-0">Your Orders</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Order</th>
                                                            <th>Date</th>
                                                            <th>Status</th>
                                                            <th>Total</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                      @foreach ($orders as $order)
                                                        <tr>
                                                            <td>{{ $order->order_number }}</td>
                                                            <td>{{ $order->order_date }}</td>
                                                            <td>{{ $order->status }}</td>
                                                            <td>৳{{ $order->amount }} for <br> {{ $order->orderItem->count() }} Items </td>
                                                            <td><a href="{{ route('order-details',$order->id) }}" class="btn-small d-block">View</a></td>
                                                        </tr>
                                                      @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="track-orders" role="tabpanel" aria-labelledby="track-orders-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="mb-0">Orders tracking</h3>
                                        </div>
                                        <div class="card-body contact-from-area">
                                            <p>To track your order please enter your OrderID in the box below and press "Track" button. This was given to you on your receipt and in the confirmation email you should have received.</p>
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <form class="contact-form-style mt-30 mb-50" action="{{ route('track-order') }}" method="post">
                                                      @csrf
                                                        <div class="input-style mb-20">
                                                            <label>Invoice No</label>
                                                            <input name="invoice_no" placeholder="Invoice Number" type="text" required>
                                                        </div>
                                                        <button class="submit submit-auto-width" type="submit">Track</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="card mb-3 mb-lg-0">
                                                <div class="card-header">
                                                    <h3 class="mb-0">Billing Address</h3>
                                                </div>
                                                <div class="card-body">
                                                    <address>
                                                        3522 Interstate<br>
                                                        75 Business Spur,<br>
                                                        Sault Ste. <br>Marie, MI 49783
                                                    </address>
                                                    <p>New York</p>
                                                    <a href="#" class="btn-small">Edit</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5 class="mb-0">Shipping Address</h5>
                                                </div>
                                                <div class="card-body">
                                                    <address>
                                                        4299 Express Lane<br>
                                                        Sarasota, <br>FL 34249 USA <br>Phone: 1.941.227.4444
                                                    </address>
                                                    <p>Sarasota</p>
                                                    <a href="#" class="btn-small">Edit</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- UPDATE YOUR PROFILE --}}
                                <div class="tab-pane fade" id="account-detail" role="tabpanel" aria-labelledby="account-detail-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Update Your Profile</h5>
                                        </div>
                                        <div class="card-body">
                                            <form method="post" action="{{ route('customer-modify') }}" enctype="multipart/form-data">
                                               @csrf
                                                <div class="row">
                                                    <div class="form-group col-md-8">
                                                        <label>Name<span class="required">*</span></label>
                                                        <input required="" class="form-control" name="name" type="text" value="{{ Auth::user()->name }}">
                                                    </div>
                                                    <div class="form-group col-md-8">
                                                        <label>Email Address <span class="required">*</span></label>
                                                        <input required="" class="form-control" name="email" type="email" value="{{ Auth::user()->email }}">
                                                    </div>
                                                    <div class="form-group col-md-8">
                                                        <div class="row">
                                                          <div class="col-md-7">
                                                            <label>Image <span class="required">*</span></label>
                                                            <input class="form-control" name="image" type="file" onchange="mainThambUrl(this)">
                                                          </div>
                                                          <div class="col-md-5">
                                                              <img src="" id="mainThmb">
                                                          </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn btn-fill-out submit font-weight-bold" name="submit" value="Submit">Save Change</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
{{-- do work --}}

<script>
    function mainThambUrl(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#mainThmb').attr('src', e.target.result).width(150)
                    .height(120);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>


@endsection
