@extends('layouts.fontend_master')
@section('parsley-css')
  <style media="screen">
    .parsley-errors-list { margin-bottom: 0; }
    .parsley-errors-list li {
      color: red;
      font-size: 11px;
      font-weight: 600;
      margin-left: 10px;
      font-style: italic;
    }
  </style>
@endsection
@section('content')
  {{-- do work --}}
  <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Checkout
                </div>
            </div>
        </div>
        <div class="container mb-80 mt-50">
          <form method="post" action="{{ route('customer.checkout.store') }}" id="checkout">
            @csrf
            <div class="row">
                <div class="col-lg-7">
                    <div class="row">
                        <h4 class="mb-30">Billing Details</h4>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <input type="text" required="" name="name" placeholder="name *" value="{{ Auth::user()->name }}">
                            </div>
                            <div class="form-group col-lg-6">
                                <input type="text" required="" name="email" placeholder="Email *" value="{{ Auth::user()->email }}">
                            </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-lg-12">
                              <input type="text" name="phone" required="" value="{{ old('phone') }}" placeholder="Phone *">
                          </div>
                        </div>

                        <div class="row shipping_calculator">
                          <div class="form-group col-lg-6">
                              <div class="custom_select">
                                  <select class="form-control select-active" name="division" required="">
                                      <option value="">Select an Division...</option>
                                      <option value="Dhaka">Dhaka</option>
                                      <option value="Borishal">Borishal</option>
                                      <option value="Khulna">Khulna</option>
                                      <option value="Rangpur">Rangpur</option>
                                      <option value="Rajshahi">Rajshahi</option>
                                  </select>
                              </div>
                          </div>

                          <div class="form-group col-lg-6">
                              <input required="" type="text" name="district" placeholder="Input District Name*">
                          </div>
                        </div>

                        <div class="row">
                          <div class="form-group col-lg-6">
                              <input required="" type="text" name="thana" placeholder="Another Address*">
                          </div>
                          <div class="form-group col-lg-6">
                              <input required="" type="text" name="post_code" placeholder="Post Code">
                          </div>
                        </div>
                        <div class="form-group mb-30">
                            <textarea rows="5" placeholder="Additional information" name="notes"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="border p-40 cart-totals ml-30 mb-50">
                        <div class="d-flex align-items-end justify-content-between align-items-center mb-30">
                            <h4>Your Item {{ $cartQty }}</h4>
                            <div class="">
                              @if (Session::has('coupon'))
                                <h6 class="text-muted">Subtotal: <strong style="color:#333">৳{{ $cartTotal }}</strong> </h6>
                                <h6 class="text-muted">Coupon Name: <strong style="color:#333">{{ session()->get('coupon')['coupon_name'] }}
                                ({{ session()->get('coupon')['coupon_discount'] }}%)</strong> </h6>

                                <h6 class="text-muted">Discount Amount: <strong style="color:#333">৳{{ session()->get('coupon')['discount_amount'] }}</strong> </h6>
                                <h6 class="text-muted">Grand Total: <strong style="color:#333">৳{{ session()->get('coupon')['total_amount'] }}</strong> </h6>
                              @else
                                <h6 class="text-muted">Subtotal: <strong style="color:#333">৳{{ $cartTotal }}</strong> </h6>
                              @endif
                            </div>
                        </div>
                        <div class="divider-2 mb-30"></div>
                        <div class="table-responsive order_table checkout">
                            <table class="table no-border">
                                <tbody>
                                  @foreach ($carts as $item)
                                    <tr>
                                        <td class="image product-thumbnail"><img src="{{ $item->options->image }}" alt="#"></td>
                                        <td>
                                            <h6 class="w-160 mb-5"><a class="text-heading">{{ $item->name }}</a></h6>
                                            <div class="product-rate-cover">
                                                <div class="product-rate d-inline-block">
                                                    <div class="product-rating" style="width:90%">
                                                    </div>
                                                </div>
                                                <span class="font-small ml-5 text-muted"> (4.0)</span>
                                            </div>
                                        </td>
                                        <td>
                                            <h6 class="text-muted pl-20 pr-20">x {{ $item->qty }}</h6>
                                        </td>
                                        <td>
                                            <h4 class="text-brand">৳{{ $item->price }}</h4>
                                        </td>
                                    </tr>
                                  @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="payment ml-30">
                        <h4 class="mb-30">Payment</h4>
                        <div class="payment_option">
                            {{-- <div class="custome-radio">
                                <input class="form-check-input" required="" type="radio" name="payment_option" id="exampleRadios3" checked="" value="bankTranfer">
                                <label class="form-check-label" for="exampleRadios3" data-bs-toggle="collapse" data-target="#bankTranfer" aria-controls="bankTranfer">Direct Bank Transfer</label>
                            </div> --}}
                            <div class="custome-radio">
                                <input class="form-check-input" required="" type="radio" name="payment_option" id="exampleRadios4" checked value="cashOnDelivery">
                                <label class="form-check-label" for="exampleRadios4" data-bs-toggle="collapse" data-target="#checkPayment" aria-controls="checkPayment">Cash on delivery</label>
                            </div>
                            {{-- <div class="custome-radio">
                                <input class="form-check-input" required="" type="radio" name="payment_option" id="exampleRadios5" checked="" value="onlineGetway">
                                <label class="form-check-label" for="exampleRadios5" data-bs-toggle="collapse" data-target="#paypal" aria-controls="paypal">Online Getway</label>
                            </div> --}}
                        </div>
                        <button type="submit" class="btn btn-fill-out btn-block mt-30">Place an Order<i class="fi-rs-sign-out ml-15"></i></button>
                    </div>
                </div>
            </div>
          </form>
        </div>
    </main>
  {{-- do work --}}
@endsection
@section('persley_script')
  <script src="{{asset('contents/admin')}}/assets/js/jquery-validator/parsley.min.js"></script>
  <script>
      $(document).ready(function() {
          $('#checkout').parsley();
      });
  </script>
@endsection
