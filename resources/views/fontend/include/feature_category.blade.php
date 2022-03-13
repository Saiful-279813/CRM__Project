<section class="popular-categories section-padding">
    <div class="container wow animate__animated animate__fadeIn">
        <div class="section-title">
            <div class="title">
                <h3>Featured Categories</h3>
            </div>
            <div class="slider-arrow slider-arrow-2 flex-right carausel-10-columns-arrow" id="carausel-10-columns-arrows"></div>
        </div>
        <div class="carausel-10-columns-cover position-relative">
            <div class="carausel-10-columns" id="carausel-10-columns">
              @foreach ($category as $catg)
                {{-- @if ($catg->product->count() > 0) --}}
                <div class="card-2 bg-11 wow animate__animated animate__fadeInUp" data-wow-delay=".3s">
                    <figure class="img-hover-scale overflow-hidden">
                        <a href="{{ route('category-wise.product',[$catg->id,$catg->category_slug]) }}"><img src="{{ asset('contents/fontend') }}/assets/imgs/shop/cat-11.png" alt=""></a>
                    </figure>
                    <h6><a href="{{ route('category-wise.product',[$catg->id,$catg->category_slug]) }}">{{ Str::limit($catg->category_name,10) }}</a></h6>
                    <span>{{ $catg->product->count() }} items</span>
                </div>
                {{-- @endif --}}
              @endforeach
            </div>
        </div>
    </div>
</section>
