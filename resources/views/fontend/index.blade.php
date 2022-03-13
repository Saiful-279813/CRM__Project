@extends('layouts.fontend_master')
@section('home') active @endsection
@section('content')
  {{-- do work --}}
  <main class="main">

      @include('fontend.include.banner')
      <!--End hero slider-->
      @include('fontend.include.feature_category')
      @include('fontend.include.secondbanner')

      <section class="product-tabs section-padding position-relative">
          <div class="container">
              <div class="section-title style-2 wow animate__animated animate__fadeIn">
                  <h3>Featured Products</h3>
                  <ul class="nav nav-tabs links" id="myTab" role="tablist">
                      <li class="nav-item" role="presentation">
                          <button class="nav-link active" id="nav-tab-one" data-bs-toggle="tab" data-bs-target="#tab-one" type="button" role="tab" aria-controls="tab-one" aria-selected="true">All</button>
                      </li>
                      @foreach ($category as $ftCatg)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="nav-tab-two{{ $ftCatg->id }}" data-bs-toggle="tab" data-bs-target="#tab-two{{ $ftCatg->id }}" type="button" role="tab" aria-controls="tab-two" aria-selected="false">{{ $ftCatg->category_name }}</button>
                        </li>
                      @endforeach
                  </ul>
              </div>
              <!--End nav-tabs-->
              <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                      <div class="row product-grid-4">
                        @foreach ($ftProduct as $data)
                          <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                              <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
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
                                        {{-- discount --}}
                                        @php
                                          $amount = $data->selling_price - $data->discount_price;
                                          $discount = ($amount / $data->selling_price) * 100;
                                        @endphp
                                        {{-- discount --}}
                                        @if($data->hot_deals == 1)
                                          <span class="hot">Hot</span>
                                        @elseif($data->discount_price == 0)
                                          <span class="new">New</span>
                                        @elseif($data->product_qty == 0)
                                          <span class="sale">Sale</span>
                                        @elseif($data->discount_price > 0)
                                          <span class="best">{{ round($discount) }}%</span>
                                        @endif

                                      </div>
                                  </div>

                                  <div class="product-content-wrap">
                                      <div class="product-category">
                                          <a href="{{ route('category-wise.product',[$data->category->id,$data->category->category_slug]) }}">{{ Str::limit($data->category->category_name,12) }}</a>
                                      </div>
                                      <h2><a href="{{ route('product-details',[$data->id,$data->product_slug]) }}">{{ Str::limit($data->product_name,30) }}</a></h2>
                                      <div class="product-rate-cover">
                                          {{-- <div class="product-rate d-inline-block">
                                              {
                                             <div class="product-rating" style="width: 90%"></div>
                                          </div> --}}
                                          {{-- do work --}}
                                          @if (App\Models\ProductReview::where('product_id', $data->id)->first())
                                              @php
                                                $reviewProducts = App\Models\ProductReview::where('product_id', $data->id)
                                                                            ->where('status', 'approve')->latest()->get();
                                                $rating = App\Models\ProductReview::where('product_id', $data->id)
                                                                            ->where('status', 'approve')
                                                                            ->avg('rating');
                                                $avgRating = number_format($rating, 1);
                                              @endphp
                                              {{-- <i class=""></i>
                                              <i class="fas fa-star-half"></i> --}}
                                              @for ($i = 1; $i <= 5; $i++)
                                                  <i style="color: #FFC151; font-size:13px;" class="fas fa-star{{ $i <= $avgRating ? '' : '-half' }}"></i>
                                              @endfor
                                                  <span class="font-small ml-5 text-muted"> ({{ count($reviewProducts) }})</span>
                                            @else
                                                <span class="font-small ml-5 text-muted"> No Review</span>
                                            @endif
                                          {{-- do work --}}
                                          <div class="rating">

                                          </div>

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
                          <!--end product card-->
                        @endforeach
                      </div>
                      <!--End product-grid-4-->
                  </div>
                  <!--En tab one-->
                  @foreach($category as $ftCatg)
                    <div class="tab-pane fade" id="tab-two{{ $ftCatg->id }}" role="tabpanel" aria-labelledby="tab-two{{ $ftCatg->id }}">
                      {{-- php --}}
                      @php
                          $catwiseProduct = App\Models\Product::where('category_id', $ftCatg->id)->orderBy('id', 'DESC')->get();
                      @endphp
                      {{-- php --}}
                      <div class="row product-grid-4">
                        @forelse ($catwiseProduct as $product)
                          <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                              <div class="product-cart-wrap mb-30">
                                  <div class="product-img-action-wrap">
                                      <div class="product-img product-img-zoom">
                                          <a href="shop-product-right.html">
                                              <img class="default-img" src="{{ asset($data->product_thambnail) }}" alt="">
                                          </a>
                                      </div>
                                      <div class="product-action-1">
                                          <a aria-label="Add To Wishlist" class="action-btn" id="{{ $data->id }}" onclick="addToWishlist(this.id)" ><i class="fi-rs-heart"></i></a>
                                          <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{ $data->id }}" onclick="productView(this.id)"><i class="fi-rs-eye"></i></a>
                                      </div>
                                      <div class="product-badges product-badges-position product-badges-mrg">
                                          {{-- discount --}}
                                          @php
                                            $amount = $data->selling_price - $data->discount_price;
                                            $discount = ($amount / $data->selling_price) * 100;

                                            // $amount = $data->selling_price * $data->discount_price;
                                            // $discount = ($amount / 100) / 100;
                                          @endphp
                                          {{-- discount --}}
                                          @if($data->hot_deals == 1)
                                            <span class="hot">Hot</span>
                                          @elseif($data->discount_price == 0)
                                            <span class="new">New</span>
                                          @elseif($data->product_qty == 0)
                                            <span class="sale">Sale</span>
                                          @elseif($data->discount_price > 0)
                                            <span class="best">{{ round($discount) }}%</span>
                                          @endif
                                      </div>
                                  </div>

                                  <div class="product-content-wrap">
                                      <div class="product-category">
                                          <a href="{{ route('category-wise.product',[$data->category->id,$data->category->category_slug]) }}">{{ Str::limit($data->category->category_name,12) }}</a>
                                      </div>
                                      <h2><a href="{{ route('product-details',[$data->id,$data->product_slug]) }}">{{ Str::limit($data->product_name,30) }}</a></h2>
                                      <div class="product-rate-cover">
                                          {{-- <div class="product-rate d-inline-block">
                                              {
                                             <div class="product-rating" style="width: 90%"></div>
                                          </div> --}}
                                          {{-- do work --}}
                                          @if (App\Models\ProductReview::where('product_id', $data->id)->first())
                                              @php
                                                $reviewProducts = App\Models\ProductReview::where('product_id', $data->id)
                                                                            ->where('status', 'approve')->latest()->get();
                                                $rating = App\Models\ProductReview::where('product_id', $data->id)
                                                                            ->where('status', 'approve')
                                                                            ->avg('rating');
                                                $avgRating = number_format($rating, 1);
                                              @endphp
                                              {{-- <i class=""></i>
                                              <i class="fas fa-star-half"></i> --}}
                                              @for ($i = 1; $i <= 5; $i++)
                                                  <i style="color: #FFC151; font-size:13px;" class="fas fa-star{{ $i <= $avgRating ? '' : '-half' }}"></i>
                                              @endfor
                                                  <span class="font-small ml-5 text-muted"> ({{ count($reviewProducts) }})</span>
                                            @else
                                                <span class="font-small ml-5 text-muted"> No Review</span>
                                            @endif
                                          {{-- do work --}}
                                          <div class="rating">

                                          </div>

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
                          @empty
                            <div class="col-md-12">
                              <p style="color: red">Product Not Assigned This Category</p>
                            </div>
                        @endforelse
                      </div>
                      <!--End product-grid-4-->
                  </div>
                  @endforeach
                  <!--En tab seven-->
              </div>
              <!--End tab-content-->
          </div>
      </section>
      <!--Products Tabs-->
      @include('fontend.include.special_offer')

      <!--End Deals-->
      <section class="section-padding mb-30">
          <div class="container">
              <div class="row">
                  {{-- hot deals --}}
                  <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 wow animate__animated animate__fadeInUp" data-wow-delay="0">
                      <h4 class="section-title style-1 mb-30 animated animated">Hot Deals</h4>
                      <div class="product-list-small animated animated">
                        @foreach ($hotOffer as $data)
                          <article class="row align-items-center hover-up">
                              <figure class="col-md-4 mb-0">
                                  <a href="{{ route('product-details',[$data->id,$data->product_slug]) }}"><img src="{{ asset($data->product_thambnail) }}" alt=""></a>
                              </figure>
                              <div class="col-md-8 mb-0">
                                  <h6>
                                      <a href="{{ route('product-details',[$data->id,$data->product_slug]) }}">{{ Str::limit($data->product_name,20) }}</a>
                                  </h6>
                                  <div class="product-rate-cover">
                                      {{-- <div class="product-rate d-inline-block">
                                          {
                                         <div class="product-rating" style="width: 90%"></div>
                                      </div> --}}
                                      {{-- do work --}}
                                      @if (App\Models\ProductReview::where('product_id', $data->id)->first())
                                          @php
                                            $reviewProducts = App\Models\ProductReview::where('product_id', $data->id)
                                                                        ->where('status', 'approve')->latest()->get();
                                            $rating = App\Models\ProductReview::where('product_id', $data->id)
                                                                        ->where('status', 'approve')
                                                                        ->avg('rating');
                                            $avgRating = number_format($rating, 1);
                                          @endphp
                                          {{-- <i class=""></i>
                                          <i class="fas fa-star-half"></i> --}}
                                          @for ($i = 1; $i <= 5; $i++)
                                              <i style="color: #FFC151; font-size:13px;" class="fas fa-star{{ $i <= $avgRating ? '' : '-half' }}"></i>
                                          @endfor
                                              <span class="font-small ml-5 text-muted"> ({{ count($reviewProducts) }})</span>
                                        @else
                                            <span class="font-small ml-5 text-muted"> No Review</span>
                                        @endif
                                      {{-- do work --}}
                                      <div class="rating">

                                      </div>

                                  </div>
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
                              </div>
                          </article>
                        @endforeach
                      </div>
                  </div>
                  {{-- Special offer --}}
                  <div class="col-xl-3 col-lg-4 col-md-6 mb-md-0 wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                      <h4 class="section-title style-1 mb-30 animated animated">Special Offer</h4>
                      <div class="product-list-small animated animated">
                        @foreach ($specialOffer as $data)
                          <article class="row align-items-center hover-up">
                              <figure class="col-md-4 mb-0">
                                  <a href="{{ route('product-details',[$data->id,$data->product_slug]) }}"><img src="{{ asset($data->product_thambnail) }}" alt=""></a>
                              </figure>
                              <div class="col-md-8 mb-0">
                                  <h6>
                                      <a href="{{ route('product-details',[$data->id,$data->product_slug]) }}">{{ Str::limit($data->product_name,20) }}</a>
                                  </h6>
                                  <div class="product-rate-cover">
                                      {{-- <div class="product-rate d-inline-block">
                                          {
                                         <div class="product-rating" style="width: 90%"></div>
                                      </div> --}}
                                      {{-- do work --}}
                                      @if (App\Models\ProductReview::where('product_id', $data->id)->first())
                                          @php
                                            $reviewProducts = App\Models\ProductReview::where('product_id', $data->id)
                                                                        ->where('status', 'approve')->latest()->get();
                                            $rating = App\Models\ProductReview::where('product_id', $data->id)
                                                                        ->where('status', 'approve')
                                                                        ->avg('rating');
                                            $avgRating = number_format($rating, 1);
                                          @endphp
                                          {{-- <i class=""></i>
                                          <i class="fas fa-star-half"></i> --}}
                                          @for ($i = 1; $i <= 5; $i++)
                                              <i style="color: #FFC151; font-size:13px;" class="fas fa-star{{ $i <= $avgRating ? '' : '-half' }}"></i>
                                          @endfor
                                              <span class="font-small ml-5 text-muted"> ({{ count($reviewProducts) }})</span>
                                        @else
                                            <span class="font-small ml-5 text-muted"> No Review</span>
                                        @endif
                                      {{-- do work --}}
                                      <div class="rating">

                                      </div>

                                  </div>
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
                              </div>
                          </article>
                        @endforeach
                      </div>
                  </div>
                  {{-- latest Product --}}
                  <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-lg-block wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                      <h4 class="section-title style-1 mb-30 animated animated">Recently added</h4>
                      <div class="product-list-small animated animated">
                        @foreach ($recently as $data)
                          <article class="row align-items-center hover-up">
                              <figure class="col-md-4 mb-0">
                                  <a href="{{ route('product-details',[$data->id,$data->product_slug]) }}"><img src="{{ asset($data->product_thambnail) }}" alt=""></a>
                              </figure>
                              <div class="col-md-8 mb-0">
                                  <h6>
                                      <a href="{{ route('product-details',[$data->id,$data->product_slug]) }}">{{ Str::limit($data->product_name,20) }}</a>
                                  </h6>
                                  <div class="product-rate-cover">
                                      {{-- <div class="product-rate d-inline-block">
                                          {
                                         <div class="product-rating" style="width: 90%"></div>
                                      </div> --}}
                                      {{-- do work --}}
                                      @if (App\Models\ProductReview::where('product_id', $data->id)->first())
                                          @php
                                            $reviewProducts = App\Models\ProductReview::where('product_id', $data->id)
                                                                        ->where('status', 'approve')->latest()->get();
                                            $rating = App\Models\ProductReview::where('product_id', $data->id)
                                                                        ->where('status', 'approve')
                                                                        ->avg('rating');
                                            $avgRating = number_format($rating, 1);
                                          @endphp
                                          {{-- <i class=""></i>
                                          <i class="fas fa-star-half"></i> --}}
                                          @for ($i = 1; $i <= 5; $i++)
                                              <i style="color: #FFC151; font-size:13px;" class="fas fa-star{{ $i <= $avgRating ? '' : '-half' }}"></i>
                                          @endfor
                                              <span class="font-small ml-5 text-muted"> ({{ count($reviewProducts) }})</span>
                                        @else
                                            <span class="font-small ml-5 text-muted"> No Review</span>
                                        @endif
                                      {{-- do work --}}
                                      <div class="rating">

                                      </div>

                                  </div>
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
                              </div>
                          </article>
                        @endforeach
                      </div>
                  </div>
                  {{-- Special Deals --}}
                  <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-xl-block wow animate__animated animate__fadeInUp" data-wow-delay=".3s">
                      <h4 class="section-title style-1 mb-30 animated animated">Special Deals</h4>
                      <div class="product-list-small animated animated">
                        @foreach ($specialDeals as $data)
                          <article class="row align-items-center hover-up">
                              <figure class="col-md-4 mb-0">
                                  <a href="{{ route('product-details',[$data->id,$data->product_slug]) }}"><img src="{{ asset($data->product_thambnail) }}" alt=""></a>
                              </figure>
                              <div class="col-md-8 mb-0">
                                  <h6>
                                      <a href="{{ route('product-details',[$data->id,$data->product_slug]) }}">{{ Str::limit($data->product_name,20) }}</a>
                                  </h6>
                                  <div class="product-rate-cover">
                                      {{-- <div class="product-rate d-inline-block">
                                          {
                                         <div class="product-rating" style="width: 90%"></div>
                                      </div> --}}
                                      {{-- do work --}}
                                      @if (App\Models\ProductReview::where('product_id', $data->id)->first())
                                          @php
                                            $reviewProducts = App\Models\ProductReview::where('product_id', $data->id)
                                                                        ->where('status', 'approve')->latest()->get();
                                            $rating = App\Models\ProductReview::where('product_id', $data->id)
                                                                        ->where('status', 'approve')
                                                                        ->avg('rating');
                                            $avgRating = number_format($rating, 1);
                                          @endphp
                                          {{-- <i class=""></i>
                                          <i class="fas fa-star-half"></i> --}}
                                          @for ($i = 1; $i <= 5; $i++)
                                              <i style="color: #FFC151; font-size:13px;" class="fas fa-star{{ $i <= $avgRating ? '' : '-half' }}"></i>
                                          @endfor
                                              <span class="font-small ml-5 text-muted"> ({{ count($reviewProducts) }})</span>
                                        @else
                                            <span class="font-small ml-5 text-muted"> No Review</span>
                                        @endif
                                      {{-- do work --}}
                                      <div class="rating">

                                      </div>

                                  </div>
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
                              </div>
                          </article>
                        @endforeach
                      </div>
                  </div>
              </div>
          </div>
      </section>
      <!--End 4 columns-->
  </main>
  {{-- do work --}}
@endsection

@section('footer_content')
    @include('layouts.font_include.newslatter')
@endsection
