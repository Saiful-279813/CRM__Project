@php
  $newslatter = App\Models\OthersBanner::where('id',1)->first();
@endphp
@section('parsley-css')
  <style media="screen">
    .parsley-errors-list { margin-bottom: 0; }
    .parsley-errors-list li {
      color: red;
      font-size: 11px;
      font-weight: 600;
      margin-left: 10px;
      font-style: italic;
    }
  </style>
@endsection

<section class="newsletter mb-15 wow animate__animated animate__fadeIn">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="position-relative newsletter-inner" style="background: url({{ asset($newslatter->newslatter_banner_backgournd) }});">
                    <div class="newsletter-content">
                        <h2 class="mb-20">{{ $newslatter->newslatter_banner_title }}</h2>
                        <p class="mb-45">{{ $newslatter->newslatter_banner_content }}</span></p>
                        <form class="form-subcriber d-flex" id="newslatterForm">
                          @csrf
                            <input type="email" name="email" placeholder="Your emaill address" required>
                            <button class="btn" type="submit">Subscribe</button>
                        </form>
                    </div>
                    <img src="{{ asset($newslatter->newslatter_banner) }}" alt="newsletter">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="featured section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 mb-md-4 mb-xl-0">
                <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp" data-wow-delay="0">
                    <div class="banner-icon">
                        <img src="{{ asset('contents/fontend') }}/assets/imgs/theme/icons/icon-1.svg" alt="">
                    </div>
                    <div class="banner-text">
                        <h3 class="icon-box-title">Best prices & offers</h3>
                        <p>Orders $50 or more</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                    <div class="banner-icon">
                        <img src="{{ asset('contents/fontend') }}/assets/imgs/theme/icons/icon-2.svg" alt="">
                    </div>
                    <div class="banner-text">
                        <h3 class="icon-box-title">Free delivery</h3>
                        <p>24/7 amazing services</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                    <div class="banner-icon">
                        <img src="{{ asset('contents/fontend') }}/assets/imgs/theme/icons/icon-3.svg" alt="">
                    </div>
                    <div class="banner-text">
                        <h3 class="icon-box-title">Great daily deal</h3>
                        <p>When you sign up</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp" data-wow-delay=".3s">
                    <div class="banner-icon">
                        <img src="{{ asset('contents/fontend') }}/assets/imgs/theme/icons/icon-4.svg" alt="">
                    </div>
                    <div class="banner-text">
                        <h3 class="icon-box-title">Wide assortment</h3>
                        <p>Mega Discounts</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp" data-wow-delay=".4s">
                    <div class="banner-icon">
                        <img src="{{ asset('contents/fontend') }}/assets/imgs/theme/icons/icon-5.svg" alt="">
                    </div>
                    <div class="banner-text">
                        <h3 class="icon-box-title">Easy returns</h3>
                        <p>Within 30 days</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 d-xl-none">
                <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp" data-wow-delay=".5s">
                    <div class="banner-icon">
                        <img src="{{ asset('contents/fontend') }}/assets/imgs/theme/icons/icon-6.svg" alt="">
                    </div>
                    <div class="banner-text">
                        <h3 class="icon-box-title">Safe delivery</h3>
                        <p>Within 30 days</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@section('newslatter')
    <script type="text/javascript">
        $('#newslatterForm').submit(function(e){
          e.preventDefault();
          let email = $('input[name="email"]').val();
          let _token = $('input[name="_token"]').val();

          // do work
          if(email != ""){
            // do work
            $.ajax({
                type: 'POST',
                url: "{{ route('newslatter-store') }}",
                data: { email:email, _token:_token },
                dataType: 'json',
                success: function(data) {
                  $('input[name="email"]').val('');
                  //  start message
                  const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      showConfirmButton: false,
                      timer: 3000
                  })

                  if ($.isEmptyObject(data.error)) {
                      Toast.fire({
                          type: 'success',
                          title: data.success
                      })
                  } else {
                      Toast.fire({
                          type: 'error',
                          title: data.error
                      })
                  }
                  //  end message
                }
            })
            // do work
          }



        });
    </script>
@endsection

@section('persley_script')
  <script src="{{asset('contents/admin')}}/assets/js/jquery-validator/parsley.min.js"></script>
  <script>
      $(document).ready(function() {
          $('#newslatterForm').parsley();
      });
  </script>
@endsection
