@extends('layouts.fontend_master')
@section('hot-deals') active @endsection
@section('content')
{{-- do work --}}
<main class="main">
    {{-- breadcumb --}}
    <div class="page-header mt-30 mb-50">
      <div class="page-header breadcrumb-wrap">
          <div class="container">
              <div class="breadcrumb">
                  <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a> <span></span> Hot Deals
              </div>
          </div>
      </div>
    </div>
    {{-- breadcumb --}}
    <div class="container mb-30">
        <div class="row flex-row-reverse">
            <div class="col-lg-4-5">
                <div class="shop-product-fillter">
                    <div class="totall-product">
                        <p>We found <strong class="text-brand">{{ $pcount }}</strong> items for you!</p>
                    </div>
                </div>
                {{-- product --}}
                <div class="row product-grid">
                  @foreach ($hotOffer as $data)
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="product-cart-wrap mb-30">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="{{ route('product-details',[$data->id,$data->product_slug]) }}">
                                        <img class="default-img" src="{{ asset($data->product_thambnail) }}" alt="">
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="Add To Wishlist" class="action-btn" id="{{ $data->id }}" onclick="addToWishlist(this.id)" ><i class="fi-rs-heart"></i></a>
                                    <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{ $data->id }}" onclick="productView(this.id)"><i class="fi-rs-eye"></i></a>
                                </div>
                                <div class="product-badges product-badges-position product-badges-mrg">
                                    <span class="hot">Hot</span>
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a href="{{ route('category-wise.product',[$data->category->id,$data->category->category_slug]) }}">{{ Str::limit($data->category->category_name,12) }}</a>
                                </div>
                                <h2><a href="{{ route('product-details',[$data->id,$data->product_slug]) }}">{{ Str::limit($data->product_name,12) }}</a></h2>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 90%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (4.0)</span>
                                </div>
                                <div>
                                    <span class="font-small text-muted">By <a href="{{ route('brand-wise.product',[$data->brand->id,$data->brand->brand_slug]) }}">{{ Str::limit($data->brand->brand_name,12) }}</a></span>
                                </div>
                                <div class="product-card-bottom">
                                    @if($data->discount_price > 0)
                                      <div class="product-price">
                                          <span>৳ {{ $data->selling_price - $data->discount_price }}</span>
                                          <span class="old-price">৳{{ $data->selling_price }}</span>
                                      </div>
                                    @else
                                      <div class="product-price">
                                          <span>৳{{ $data->selling_price }}</span>
                                      </div>
                                    @endif
                                    <div class="add-cart">
                                        <a class="add" id="{{ $data->id }}" onclick="addToCart(this.id)"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  @endforeach
                </div>
                <!--product grid-->
                <div class="pagination-area mt-20 mb-20">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-start">
                            {{-- <li class="page-item">
                                <a class="page-link" href="#"><i class="fi-rs-arrow-small-left"></i></a>
                            </li> --}}

                            {{ $hotOffer->links() }}
                        </ul>
                    </nav>
                </div>
                <!--End Deals-->
            </div>
            {{-- sidebar --}}
            <div class="col-lg-1-5 primary-sidebar sticky-sidebar">
                <div class="sidebar-widget widget-category-2 mb-30">
                    <h5 class="section-title style-1 mb-30">Category</h5>
                    <ul>
                      @foreach ($brand as $data)
                        @if ($data->product->count() > 0)
                        <li>
                            <a href="{{ route('brand-wise.product',[$data->id,$data->brand_slug]) }}">
                              @if ($data->brand_image == NULL)
                                <img src="{{ asset('contents/fontend') }}/assets/imgs/theme/icons/category-1.svg" alt="">
                              @else
                                <img src="{{ asset($data->brand_image) }}" alt="">
                              @endif
                                {{ Str::limit($data->brand_name,7) }}
                              </a>
                            <span class="count" >{{ $data->product->count() }}</span>
                        </li>
                        @endif
                      @endforeach
                    </ul>
                </div>
                {{-- new Prouduct --}}
                <div class="sidebar-widget product-sidebar mb-30 p-30 bg-grey border-radius-10">
                    <h5 class="section-title style-1 mb-30">New products</h5>
                    @foreach ($newProduct as $data)
                    <div class="single-post clearfix">
                        <div class="image">
                            <img src="{{ asset($data->product_thambnail) }}" alt="#">
                        </div>
                        <div class="content pt-10">
                            <h5 style="font-size:15px"><a href="{{ route('product-details',[$data->id,$data->product_slug]) }}">{{ Str::limit($data->product_name,15) }}</a></h5>

                            <p class="price mb-0 mt-5">৳{{ $data->selling_price }}</p>
                            <div class="product-rate">
                                <div class="product-rating" style="width: 90%"></div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</main>
{{-- do work --}}
@endsection
