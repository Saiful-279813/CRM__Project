@extends('layouts.fontend_master')
@section('shop') active @endsection
@section('content')
{{-- do work --}}
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> {{ $product->product_name }}
            </div>
        </div>
    </div>
    <div class="container mb-30">
        <div class="row">
            <div class="col-xl-10 col-lg-12 m-auto">
                <div class="product-detail accordion-detail">
                    <div class="row mb-50 mt-30">
                        <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                            <div class="detail-gallery">
                                <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                                <!-- MAIN SLIDES -->
                                @php
                                  $multipleImage = App\Models\ProductImage::where('product_id',$product->id)->get();
                                @endphp
                                <div class="product-image-slider">
                                  @foreach ($multipleImage as $img)
                                    <figure class="border-radius-10">
                                        <img src="{{ asset($img->photo_name) }}" alt="product image">
                                    </figure>
                                  @endforeach
                                </div>
                                <!-- THUMBNAILS -->
                                <div class="slider-nav-thumbnails">
                                  @foreach ($multipleImage as $img)
                                    <div><img src="{{ asset($img->photo_name) }}" alt="product image"></div>
                                  @endforeach
                                </div>
                            </div>
                            <!-- End Gallery -->
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="detail-info pr-30 pl-30">
                                <span class="stock-status out-stock"> {{ $product->product_qty > 0 ? 'Available' : 'Sale Off' }}  </span>
                                <h2 class="title-detail">{{ $product->product_name }}</h2>
                                <div class="product-detail-rating">
                                    <div class="product-rate-cover text-end">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 90%"></div>
                                        </div>
                                        <span class="font-small ml-5 text-muted"> (32 reviews)</span>
                                    </div>
                                </div>
                                <div class="clearfix product-price-cover">
                                    <div class="product-price primary-color float-left">
                                      @if($product->discount_price > 0)
                                        {{-- do work --}}
                                        @php
                                           $amount = $product->selling_price - $product->discount_price;
                                           $discount = ($product->discount_price / 100);

                                        @endphp
                                        {{-- do work --}}
                                        <span class="current-price text-brand">৳{{ $product->selling_price - $product->discount_price }}</span>
                                        <span>
                                            <span class="save-price font-md color3 ml-15">{{ round($discount) }}% Off</span>
                                            <span class="old-price font-md ml-15">৳{{ $product->selling_price }}</span>
                                        </span>
                                      @else
                                        <span class="current-price text-brand">৳{{ $product->selling_price }}</span>
                                      @endif


                                    </div>
                                </div>
                                <div class="short-desc mb-30">
                                    <p class="font-lg">{{ $product->short_descp }}</p>
                                </div>
                                <div class="attr-detail attr-size mb-30">
                                    <strong class="mr-10">Size / Weight: </strong>
                                    <ul class="list-filter size-filter font-small">
                                      @foreach ($product_size as $size)
                                        <li><a href="#">{{ $size }}</a></li>
                                      @endforeach
                                    </ul>
                                </div>
                                <div class="detail-extralink mb-50">
                                    <div class="detail-qty border radius">
                                        <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                        <span class="qty-val">1</span>
                                        <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                    </div>
                                    <div class="product-extra-link2">
                                        <button type="submit" class="button button-add-to-cart"><i class="fi-rs-shopping-cart"></i>Add to cart</button>
                                        <a aria-label="Add To Wishlist" class="action-btn hover-up" id="{{ $product->id }}" onclick="addToWishlist(this.id)"><i class="fi-rs-heart"></i></a>
                                    </div>
                                </div>
                                <div class="font-xs">
                                    <ul class="mr-50 float-start">
                                        <li class="mb-5">SKU: <a href="#">{{ $product->product_code }}</a></li>
                                        <li class="mb-5">MFG: <span class="text-brand">{{ $relaseDate }}</span></li>
                                    </ul>
                                    <ul class="float-start">

                                        <li class="mb-5">Tags:
                                          @foreach ($product_tag as $tag) <a href="#" rel="tag">{{ $tag }}</a>, @endforeach

                                        <li>Stock:<span class="in-stock text-brand ml-5">{{ $product->product_qty }} Items In Stock</span></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Detail Info -->
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="tab-style3">
                            <ul class="nav nav-tabs text-uppercase">
                              @php
                                $reviewCount = App\Models\ProductReview::where('product_id', $product->id)->count();
                              @endphp
                                <li class="nav-item">
                                    <a class="nav-link active" id="Description-tab" data-bs-toggle="tab" href="#Description">Description</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="Reviews-tab" data-bs-toggle="tab" href="#Reviews">Reviews ({{ $reviewCount }})</a>
                                </li>
                            </ul>
                            <div class="tab-content shop_info_tab entry-main-content">
                                <div class="tab-pane fade show active" id="Description">
                                    <div class="">
                                        {!! $product->long_descp !!}
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="Reviews">
                                    <!--Comments-->
                                    <div class="comments-area">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <h4 class="mb-30">Customer questions & answers</h4>
                                                <div class="comment-list">
                                                  @php
                                                    $reviews = App\Models\ProductReview::with('user','product')->latest()->get();
                                                  @endphp

                                                  @foreach ($reviews as $data)
                                                    <div class="single-comment justify-content-between d-flex mb-30">
                                                        <div class="user d-flex">
                                                            <div class="thumb text-center">
                                                              @if($data->upload_photo_path == NULL)
                                                                <img src="{{ asset('contents/fontend') }}/assets/imgs/blog/author-2.png" alt="">
                                                              @else
                                                                <img src="{{ asset($data->upload_photo_path) }}" alt="">
                                                              @endif
                                                                <a href="#" class="font-heading text-brand d-block">{{ $data->user->name }}</a>
                                                            </div>
                                                            <div class="desc">
                                                                <div class="d-flex justify-content-between mb-10" >
                                                                    <div class="d-flex align-items-center">
                                                                        <span class="font-xs text-muted">
                                                                          {{ $data->created_at->format('d F Y') }}
                                                                        </span>
                                                                    </div>

                                                                    <div class="">
                                                                      @for($i=1; $i <= $data->rating; $i++)
                                                                        <i style="color: #FFC151; font-size:12px;" class="fas fa-star"></i>
                                                                      @endfor
                                                                    </div>
                                                                </div>
                                                                <p class="mb-10">{{ $data->comment }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                  @endforeach

                                                </div>
                                            </div>

                                            {{-- ******************** --}}
                                            <div class="col-lg-4">
                                                <h4 class="mb-30">Customer reviews</h4>
                                                @if (App\Models\ProductReview::where('product_id', $product->id)->first())
                                                  @php
                                                    $reviewProducts = App\Models\ProductReview::where('product_id', $product->id)
                                                                                ->where('status', 'approve')->latest()->get();
                                                    $rating = App\Models\ProductReview::where('product_id', $product->id)
                                                                                ->where('status', 'approve')
                                                                                ->avg('rating');
                                                    $avgRating = number_format($rating, 1);
                                                  @endphp
                                                <div class="d-flex mb-30 align-items-center">
                                                    <div class="">
                                                      @for ($i = 1; $i <= $avgRating; $i++)
                                                          <i style="color: #FFC151; font-size:11px;" class="fas fa-star{{ $i <= $avgRating ? '' : '-half' }}"></i>
                                                      @endfor
                                                    </div>
                                                    <h6 style="margin-left:10px">{{ count($reviewProducts) }} out of 5</h6>
                                                </div>
                                                <div class="progress">
                                                    <span>{{ count($reviewProducts) }} star</span>
                                                    <div class="progress-bar" role="progressbar" style="width: {{ $avgRating }}%" aria-valuenow="{{ $avgRating }}" aria-valuemin="0" aria-valuemax="100">{{ $avgRating }}%</div>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <!--comment form-->
                                    @auth
                                      <div class="comment-form">
                                          <h4 class="mb-15">Add a review</h4>
                                          <div class="row">
                                              <div class="col-lg-8 col-md-12">
                                                  <form class="form-contact comment_form" action="#" id="commentForm">
                                                      <div class="row">
                                                          <div class="col-12">
                                                              <div class="form-group">
                                                                  <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9" placeholder="Write Comment"></textarea>
                                                              </div>
                                                          </div>
                                                          <div class="col-sm-6">
                                                              <div class="form-group">
                                                                  <input class="form-control" name="name" id="name" type="text" placeholder="Name">
                                                              </div>
                                                          </div>
                                                          <div class="col-sm-6">
                                                              <div class="form-group">
                                                                  <input class="form-control" name="email" id="email" type="email" placeholder="Email">
                                                              </div>
                                                          </div>
                                                          <div class="col-12">
                                                              <div class="form-group">
                                                                  <input class="form-control" name="website" id="website" type="text" placeholder="Website">
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <div class="form-group">
                                                          <button type="submit" class="button button-contactForm">Submit Review</button>
                                                      </div>
                                                  </form>
                                              </div>
                                          </div>
                                      </div>
                                    @else
                                      <div class="comment-form">
                                          <div class="row">
                                              <div class="col-lg-8 col-md-12">
                                                <div class="form-group">
                                                    <a href="{{ route('login') }}" class="button button-contactForm review_form">Comment</a>
                                                </div>
                                              </div>
                                          </div>
                                      </div>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Related Product --}}
                    <div class="row mt-60">
                        <div class="col-12">
                            <h2 class="section-title style-1 mb-30">Related products</h2>
                        </div>
                        <div class="col-12">
                            <div class="row related-products">
                              @foreach ($relatedProducts as $data)
                                <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                                    <div class="product-cart-wrap hover-up">
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
                                        {{-- product content wrap --}}
                                        <div class="product-content-wrap">
                                            <div class="product-category">
                                                <a href="{{ route('category-wise.product',[$data->category->id,$data->category->category_slug]) }}">{{ Str::limit($data->category->category_name,12) }}</a>
                                            </div>
                                            <h2><a href="{{ route('product-details',[$data->id,$data->product_slug]) }}">{{ Str::limit($data->product_name,30) }}</a></h2>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
{{-- do work --}}
@endsection
