@extends('layouts.fontend_master')
@section('contact') active
@endsection
@section('styles')
  <style media="screen">
    .invalid-feedback {
      display: block;
    }
  </style>
@endsection
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
@section('content')
{{-- do work --}}
<main class="main pages">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a> <span></span> Contact
            </div>
        </div>
    </div>
    <div class="page-content pt-50">

        <div class="container">
            <div class="row">
                <div class="col-xl-10 col-lg-12 m-auto">
                    <section class="mb-50">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="contact-from-area padding-20-row-col">
                                    <h5 class="text-brand mb-10">Send Your Massege</h5>
                                    <form class="contact-form-style mt-30" id="contact-form" action="{{ route('send-user.contact') }}" method="post">
                                      @csrf
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6">
                                                <div class="input-style mb-20{{ $errors->has('name') ? ' has-error' : '' }}">
                                                    <input name="name" placeholder="Enter Your  Name" type="text" required>
                                                    @if ($errors->has('name'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>

                                            </div>


                                            <div class="col-lg-6 col-md-6">
                                                <div class="input-style mb-20{{ $errors->has('email') ? ' has-error' : '' }}">
                                                    <input name="email" placeholder="Enter Your Email" type="email" required>
                                                    @if ($errors->has('email'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="input-style mb-20{{ $errors->has('telephone') ? ' has-error' : '' }}">
                                                    <input name="telephone" placeholder="Enter Your Phone" type="tel" required>
                                                    @if ($errors->has('telephone'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('telephone') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="input-style mb-20{{ $errors->has('subject') ? ' has-error' : '' }}">
                                                    <input name="subject" placeholder="Enter Your Subject" type="text" required>
                                                    @if ($errors->has('subject'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('subject') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12">
                                                <div class="textarea-style mb-30{{ $errors->has('message') ? ' has-error' : '' }}">
                                                    <textarea name="message" placeholder="Message Here... " required></textarea>
                                                    @if ($errors->has('message'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('message') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <button class="submit submit-auto-width" type="submit">Send message</button>
                                            </div>
                                        </div>
                                    </form>
                                    <p class="form-messege"></p>
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

@section('persley_script')
  <script src="{{asset('contents/admin')}}/assets/js/jquery-validator/parsley.min.js"></script>
  <script>
      $(document).ready(function() {
          $('#contact-form').parsley();
      });
  </script>
@endsection
