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
                <span></span> Order Review
            </div>
        </div>
    </div>

    {{-- response massage --}}
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
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
                                        <a class="nav-link active"><i class="fi-rs-shopping-bag mr-10"></i>Orders Review</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-9">
                          <div class="tab-content account dashboard-content pl-50">
                              {{-- order details --}}
                              <div>
                                  <div class="card">
                                    <form action="{{ route('review-submit') }}" method="post">
                                      @csrf
                                      {{-- do work --}}
                                      <input type="hidden" name="product_id" value="{{ $id }}">
                                      <table class="table">
                                          <thead>
                                              <tr>
                                                  <th class="cell-label">&nbsp;</th>
                                                  <th style="text-align:center">1 star</th>
                                                  <th style="text-align:center">2 stars</th>
                                                  <th style="text-align:center">3 stars</th>
                                                  <th style="text-align:center">4 stars</th>
                                                  <th style="text-align:center">5 stars</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <tr>
                                                  <td class="cell-label" style="text-align:right"> <span style="font-weight:bold">Rating</span> </td>
                                                  <td style="text-align:center"><input style="height:20px" type="radio" name="rating" class="radio" value="1" checked></td>
                                                  <td style="text-align:center"><input style="height:20px" type="radio" name="rating" class="radio" value="2"></td>
                                                  <td style="text-align:center"><input style="height:20px" type="radio" name="rating" class="radio" value="3"></td>
                                                  <td style="text-align:center"><input style="height:20px" type="radio" name="rating" class="radio" value="4"></td>
                                                  <td style="text-align:center"><input style="height:20px" type="radio" name="rating" class="radio" value="5"></td>
                                              </tr>
                                          </tbody>
                                      </table>

                                      <div class="">
                                        <div class="form-group custom_form_group">
                                            <label class="control-label">Comments:<span class="req_star">(Optional)</span></label>
                                            <div>
                                              <textarea name="comment" class="form-control" style="height:200px" rows="20" cols="80" placeholder="Comment Here...." required>{{old('comment')}}</textarea>
                                            </div>
                                        </div>
                                      </div>

                                      <div class="action text-right">
                                          <button class="btn btn-primary btn-upper">SUBMIT REVIEW</button>
                                      </div>
                                      {{-- do work --}}
                                    </form>
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
