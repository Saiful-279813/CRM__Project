<section class="section-padding pb-5">
    <div class="container">
        <div class="section-title wow animate__animated animate__fadeIn">
            <h3 class="">Special Offer</h3>
        </div>
        <div class="row">
            <div class="col-lg-3 d-none d-lg-flex wow animate__animated animate__fadeIn">
                <div class="banner-img style-2" style=" background-image: url({{ $othersbanner->special_offer_banner }}) ">
                    <div class="banner-text">
                        <h2 class="mb-100">{{ $othersbanner->special_offer_banner_title }}</h2>
                        <a href="{{ route('shop') }}" class="btn btn-xs">Shop Now <i class="fi-rs-arrow-small-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-12 wow animate__animated animate__fadeIn" data-wow-delay=".4s">
                <div class="tab-content">
                  <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="tab-one-1">
                      <div class="carausel-4-columns-cover arrow-center position-relative">
                          <div class="slider-arrow slider-arrow-2 carausel-4-columns-arrow" id="carausel-4-columns-arrows"></div>
                          <div class="carausel-4-columns carausel-arrow-center" id="carausel-4-columns">
                            @foreach ($specialOffer as $data)
                              {{-- do work --}}
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
                      </div>
                  </div>
                </div>
                <!--End tab-content-->
            </div>
            <!--End Col-lg-9-->
        </div>
    </div>
</section>
