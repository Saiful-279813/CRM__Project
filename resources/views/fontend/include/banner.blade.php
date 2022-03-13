{{-- php --}}
    @php
      $banner = App\Models\Banner::orderBy('id','DESC')->get();
    @endphp
{{-- php --}}
<section class="home-slider position-relative mb-30">
    <div class="container">
        <div class="home-slide-cover mt-30">
            <div class="hero-slider-1 style-4 dot-style-1 dot-style-1-position-1">
                @foreach ($banner as $ban)
                  <div class="single-hero-slider single-animation-wrap" style="background-image: url({{ asset($ban->image) }})">
                      <div class="slider-content">
                          <h1 class="display-2 mb-40"> {{ $ban->title }} </h1>
                          <p class="mb-65">{{ $ban->description }}</p>
                      </div>
                  </div>
                @endforeach
            </div>
            <div class="slider-arrow hero-slider-1-arrow"></div>
        </div>
    </div>
</section>
