<!--End category slider-->
@php
  $secondbanner = App\Models\SecondBanner::orderBy('id','DESC')->limit(3)->get();
@endphp
<section class="banners mb-25">
    <div class="container">
        <div class="row">
          @foreach ($secondbanner as $data)


            <div class="col-lg-4 col-md-6">
                <div class="banner-img wow animate__animated animate__fadeInUp" data-wow-delay="0">
                    <img src="{{ asset($data->image_path) }}" alt="">
                    <div class="banner-text">
                        <h4>{{ $data->title }}</h4>
                        <a href="{{ route('shop') }}" class="btn btn-xs">Shop Now <i class="fi-rs-arrow-small-right"></i></a>
                    </div>
                </div>
            </div>
          @endforeach
        </div>
    </div>
</section>
<!--End banners-->
