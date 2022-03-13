@extends('layouts.fontend_master')
@section('parsley-css')
  <style media="screen">
    #error_massage_in_coupon {
      margin-left: 14px;
      font-size: 13px;
      font-weight: bold;
      color: red;
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
                    <span></span> Cart
                </div>
            </div>
        </div>
        <div class="container mb-20 mt-20">
            <div class="row">
                <div class="col-lg-8 mb-20">
                    <div class="d-flex justify-content-between align-items-center">
                      <div class="cart-action d-flex justify-content-between">
                          <a class="btn" href="{{ route('shop') }}"><i class="fi-rs-arrow-left mr-10"></i>Continue Shopping</a>
                      </div>
                        <h6 class="text-body"><a href="#" class="text-muted"><i class="fi-rs-trash mr-5"></i>Clear Cart</a></h6>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="table-responsive shopping-summery">
                        <table class="table table-wishlist">
                            <thead>
                                <tr class="main-heading">
                                    <th class="custome-checkbox start pl-30">
                                        <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox11" value="">
                                        <label class="form-check-label" for="exampleCheckbox11"></label>
                                    </th>
                                    <th scope="col" colspan="2">Product</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Subtotal</th>
                                    <th scope="col" class="end">Remove</th>
                                </tr>
                            </thead>
                            <tbody id="mainCartView"></tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="border p-md-4 cart-totals ml-30">
                        <div class="table-responsive">
                            <table class="table no-border">
                                <tbody id="couponCalField"></tbody>
                            </table>
                        </div>
                        <a href="{{ route('checkout') }}" class="btn mb-20 w-100">Proceed To CheckOut<i class="fi-rs-sign-out ml-15"></i></a>
                    </div>
                </div>
            </div>
            {{-- coupon calculation --}}
            <div class="row mt-20">

              {{-- shipping calculation --}}
                {{-- <div class="col-lg-7">
                    <div class="calculate-shiping p-40 border-radius-15 border">
                        <h4 class="mb-10">Calculate Shipping</h4>
                        <p class="mb-30"><span class="font-lg text-muted">Flat rate:</span><strong class="text-brand">5%</strong></p>
                        <form class="field_form shipping_calculator">
                            <div class="form-row">
                                <div class="form-group col-lg-12">
                                    <div class="custom_select">
                                        <select class="form-control select-active w-100">
                                            <option value="">United Kingdom</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row row">
                                <div class="form-group col-lg-6">
                                    <input required="required" placeholder="State / Country" name="name" type="text">
                                </div>
                                <div class="form-group col-lg-6">
                                    <input required="required" placeholder="PostCode / ZIP" name="name" type="text">
                                </div>
                            </div>
                        </form>
                    </div>
                </div> --}}
              {{-- shipping calculation --}}

                <div class="col-lg-5" id="couponField">
                    <div class="p-10">
                        <h4 class="mb-10">Apply Coupon</h4>
                        <p class="mb-30"><span class="font-lg text-muted">Using A Promo Code?</span></p>
                          <div class="d-flex justify-content-between">
                              <input class="font-medium mr-15 coupon" id="coupon_name" name="Coupon" placeholder="Enter Your Coupon" required>
                              <button class="btn" onclick="applyCoupon()"><i class="fi-rs-label mr-10"></i>Apply</button>
                          </div>
                          <div class="">
                            <p id="error_massage_in_coupon"></p>
                          </div>
                    </div>
                </div>
            </div>
            {{-- coupon calculation --}}
        </div>
    </main>
  {{-- do work --}}
@endsection
