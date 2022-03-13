@extends('layouts.fontend_master')
@section('about') active @endsection
@section('content')

  @php
    $setting = App\Models\Setting::where('id',1)->first();
    $brand = App\Models\Brand::orderBy('id','DESC')->limit(10)->get();
  @endphp
{{-- do work --}}
<main class="main pages">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a> <span></span> About us
            </div>
        </div>
    </div>
    <div class="page-content pt-50">
        <div class="container">
            <div class="row">
                <div class="col-xl-10 col-lg-12 m-auto">
                    <section class="row align-items-center mb-50">
                        <div class="col-lg-6">
                            <img src="{{ asset($setting->ab_page_image) }}" alt="" class="border-radius-15 mb-md-3 mb-lg-0 mb-sm-4">
                        </div>
                        <div class="col-lg-6">
                            <div class="pl-25">
                                <h2 class="mb-30">{{ $setting->ab_page_title }}</h2>
                                <p class="mb-25">{{ $setting->ab_page_description }}</p>
                                <div class="carausel-3-columns-cover position-relative">
                                    <div id="carausel-3-columns-arrows"></div>
                                    <div class="carausel-3-columns" id="carausel-3-columns">
                                      @foreach ($brand as $data)
                                        @if($data->brand_image == NULL)
                                          <img src="{{ asset('contents/fontend') }}/assets/imgs/page/about-2.png" alt="">
                                        @else
                                          <img src="{{ asset($data->brand_image) }}" alt="">
                                        @endif
                                      @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</main>
{{-- do work --}}
@endsection
