@extends('layouts.fontend_master')
@section('shop') active @endsection
@section('styles')
  <style media="screen">
    .scroll-element{
      height: 300px;
      overflow-y: scroll;
    }
  </style>
@endsection
@section('content')
{{-- do work --}}
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a> <span></span> Shop
            </div>
        </div>
    </div>

    <div class="container mb-30 mt-50">
        <div class="row flex-row-reverse">
            <div class="col-lg-4-5">
                <div class="shop-product-fillter">
                    <div class="totall-product">
                        <p>We found <strong class="text-brand">{{ $count }}</strong> items for you!</p>
                    </div>
                    <div class="sort-by-product-area">
                        <div class="sort-by-cover mr-10">
                            <div class="sort-by-product-wrap">
                                <div class="sort-by">
                                    <span><i class="fi-rs-apps"></i>Show:</span>
                                </div>
                                <div class="sort-by-dropdown-wrap">
                                    <span> 50 <i class="fi-rs-angle-small-down"></i></span>
                                </div>
                            </div>
                            <div class="sort-by-dropdown">
                                <ul>
                                    <li><a class="active" href="#">50</a></li>
                                    <li><a href="#">100</a></li>
                                    <li><a href="#">150</a></li>
                                    <li><a href="#">200</a></li>
                                    <li><a href="#">All</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="sort-by-cover">
                            {{-- do work --}}
                            <select class="form-control" name="" id="sortBy">
                                <option>Sort By Products</option>
                                <option value="priceLowtoHigh" {{ $sort == 'priceLowtoHigh' ? 'selected' : '' }}>Price:Lower to
                                    Higher</option>
                                <option value="priceHightoLow" {{ $sort == 'priceHightoLow' ? 'selected' : '' }}>Price:Higher
                                    to Lower</option>
                                <option value="nameAtoZ" {{ $sort == 'nameAtoZ' ? 'selected' : '' }}>Product Name:A to Z
                                </option>
                                <option value="nameZtoA" {{ $sort == 'nameZtoA' ? 'selected' : '' }}>Product Name:Z to A
                                </option>
                            </select>
                            {{-- do work --}}
                        </div>
                    </div>
                </div>
                <div class="row product-grid">
                    @foreach ($shopProduct as $product)
                        <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                            <div class="product-cart-wrap mb-30">
                                <div class="product-img-action-wrap">
                                    <div class="product-img product-img-zoom">
                                        <a href="#">
                                            <img class="default-img" src="{{ asset('contents/fontend') }}/assets/imgs/shop/product-1-1.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="product-action-1">
                                        <a aria-label="Add To Wishlist" class="action-btn" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                        <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                    </div>
                                    <div class="product-badges product-badges-position product-badges-mrg">
                                        <span class="hot">Hot</span>
                                    </div>
                                </div>
                                <div class="product-content-wrap">
                                    <div class="product-category">
                                        <a href="{{ route('category-wise.product',[$product->category->id,$product->category->category_slug]) }}">{{ Str::limit($product->category->category_name,12) }}</a>
                                    </div>
                                    <h2><a href="{{ route('product-details',[$product->id,$product->product_slug]) }}">{{ Str::limit($product->product_name,30) }}</a></h2>
                                    <div class="product-rate-cover">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 90%"></div>
                                        </div>
                                        <span class="font-small ml-5 text-muted"> (4.0)</span>
                                    </div>
                                    <div>
                                        <span class="font-small text-muted">By <a href="{{ route('brand-wise.product',[$product->brand->id,$product->brand->brand_slug]) }}">{{ Str::limit($product->brand->brand_name,12) }}</a></span>
                                    </div>
                                    <div class="product-card-bottom">
                                      @if($product->discount_price > 0)
                                        <div class="product-price">
                                            <span>৳ {{ $product->selling_price - $product->discount_price }}</span>
                                            <span class="old-price">৳{{ $product->selling_price }}</span>
                                        </div>
                                      @else
                                        <div class="product-price">
                                            <span>৳{{ $product->selling_price }}</span>
                                        </div>
                                      @endif


                                    </div>
                                    <div class="add-cart">
                                        <a class="add" id="{{ $product->id }}" onclick="addToCart(this.id)"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
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

                            {{ $shopProduct->appends($_GET)->links() }}
                        </ul>
                    </nav>
                </div>
            </div>
            {{-- sidebar --}}

              <div class="col-lg-1-5 primary-sidebar sticky-sidebar">
                {{-- category --}}
                <form action="{{ route('shop.filter') }}" method="POST">
                  @csrf
                  <div class="sidebar-widget widget-category-2 mb-30">
                      <h5 class="section-title style-1 mb-30">Category</h5>
                      {{-- do work --}}
                      <div class="list-group scroll-element">
                          <div class="list-group-item mb-10 mt-10">
                              <div class="custome-checkbox">
                                @if (!empty($_GET['category']))
                                    @php
                                        $filterCat = explode(',', $_GET['category']);
                                    @endphp
                                @endif

                                @foreach ($category as $catg)
                                  @if ($catg->product->count() > 0)
                                  <input class="form-check-input" type="checkbox" name="category[]" id="exampleCheckbox{{ $catg->id }}" value="{{ $catg->category_slug }}" @if (!empty($filterCat) && in_array($catg->category_slug, $filterCat)) checked @endif  onchange="this.form.submit();">
                                  <label class="form-check-label" for="exampleCheckbox{{ $catg->id }}"><span>{{ $catg->category_name }} ({{ $catg->product->count() }})</span></label>
                                  <br>
                                  @endif
                                @endforeach
                              </div>
                          </div>
                      </div>
                      {{-- do work --}}
                  </div>
                  {{-- brand --}}
                  <div class="sidebar-widget widget-category-2 mb-30">
                      <h5 class="section-title style-1 mb-30">Brand</h5>
                      {{-- do work --}}
                      <div class="list-group scroll-element">
                          <div class="list-group-item mb-10 mt-10">
                              <div class="custome-checkbox">
                                @if (!empty($_GET['brand']))
                                    @php
                                        $filterBrand = explode(',', $_GET['brand']);
                                    @endphp
                                @endif

                                @foreach ($brands as $bran)
                                  @if ($bran->product->count() > 0)
                                  <input class="form-check-input" type="checkbox" name="brand[]" id="exampleCheckbox{{ $bran->id }}" value="{{ $bran->brand_slug }}" @if (!empty($filterBrand) && in_array($bran->brand_slug, $filterBrand)) checked @endif  onchange="this.form.submit();">
                                  <label class="form-check-label" for="exampleCheckbox{{ $bran->id }}"><span>{{ $bran->brand_name }} ({{ $bran->product->count() }})</span></label>
                                  <br>
                                  @endif
                                @endforeach
                              </div>
                          </div>
                      </div>
                      {{-- do work --}}
                  </div>

                  <!-- Fillter By Price -->
                  <div class="sidebar-widget price_range range mb-30">
                      <h5 class="section-title style-1 mb-30">Fill by price</h5>
                      <div class="price-filter">
                          <div class="price-filter-inner">
                              <div id="slider-range" class="mb-20"></div>
                              <div class="d-flex justify-content-between">
                                  <div class="caption">From: <strong id="slider-range-value1" class="text-brand"></strong></div>
                                  <div class="caption">To: <strong id="slider-range-value2" class="text-brand"></strong></div>
                              </div>
                          </div>
                      </div>
                      <button type="submit" class="btn btn-sm btn-default mt-2"><i class="fi-rs-filter mr-5"></i> Fillter</button>
                  </div>
                  <!-- Product sidebar Widget -->
                 </form>
              </div>

        </div>
    </div>
</main>
{{-- do work --}}
@endsection

@section('filtering')
  {{-- price filtering --}}
  <script>
      $('#sortBy').change(function(e) {
          e.preventDefault();
          let sortBy = $('#sortBy').val();
          window.location = "{{ url('' . $route . '') }}?sort=" +sortBy;});
   </script>

  {{-- price filtering --}}
@endsection
