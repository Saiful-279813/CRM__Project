@extends('layouts.fontend_master')
@section('brand') active @endsection
@section('styles')
  <style media="screen">
    .breadcrumb {
      display: block;
    }

    .breadcrumb h4 {
    	color: #3BB77E;
    	font-weight: 600;
    }

    .product-cart-wrap {
    	height: 280px;
    }

    .product-cart-wrap .product-img-action-wrap {
    	padding: 20px 15px;
    	height: 130px;
    }


    .product-cart-wrap .product-img-action-wrap .product-img a img {
    	width: 100%;
      height: 100px;
    }

    .product-cart-wrap .product-content-wrap h2 a {
    	font-size: 14px;
    }

    .product-cart-wrap .product-content-wrap h2 {
    	margin-top: 10px;
    }


  </style>
@endsection
@section('content')
{{-- do work --}}
<main class="main pages">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="breadcrumb">
                <div class="row">
                  <div class="col-md-6">
                    <h4>All Brand</h4>
                  </div>
                  <div class="col-md-6" style="text-align:right">
                    <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a> <span></span> Brand
                  </div>
                </div>
            </div>
            </div>
          </div>
        </div>
    </div>
    <div class="page-content pt-50">
        <div class="container">
            <div class="row">
                <div class="col-xl-10 col-lg-12 m-auto">
                    {{-- do work --}}
                    <div class="row brand_wrap">
                      @php
                        $count = 0;
                      @endphp
                      @foreach ($brands as $data)
                        <div class="col-md-2">
                          <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".{{ $count }}s">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="{{ route('brand-wise.product',[$data->id,$data->brand_slug]) }}">
                                      @if ($data->brand_image == NULL)
                                        <img class="default-img" src="https://picsum.photos/200/300" alt="">
                                      @else
                                        <img class="default-img" src="{{ asset($data->brand_image) }}" alt="">
                                      @endif

                                    </a>
                                </div>
                            </div>
                            <div class="product-content-wrap">
                              <div class="product-category">
                                 <a href="#">Items({{ $data->product->count() }})</a>
                              </div>
                              <h2><a href="{{ route('brand-wise.product',[$data->id,$data->brand_slug]) }}">{{ Str::limit($data->brand_name) }}</a></h2>
                            </div>
                          </div>
                        </div>
                        @php
                          $count++;
                        @endphp
                      @endforeach

                    </div>
                    {{-- do work --}}
                </div>
            </div>
        </div>
    </div>
</main>
{{-- do work --}}
@endsection
