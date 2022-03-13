{{-- php --}}
@php
  $setting = App\Models\Setting::where('id',1)->first();
@endphp
{{-- php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta content="" name="description" />
      <meta content="Obaida" name="author" />
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title> ::-- Sowaq --:: </title>
      <link rel="shortcut icon" type="image/x-icon" href="{{ asset($setting->fav_icon) }}">
      <link href="{{asset('contents/admin')}}/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
      <link href="{{asset('contents/admin')}}/assets/css/datatables.min.css" rel="stylesheet" type="text/css" />
      <link href="{{asset('contents/admin')}}/assets/css/icons.css" rel="stylesheet" type="text/css" />
      <link href="{{asset('contents/admin')}}/assets/css/all.min.css" rel="stylesheet" type="text/css" />
      <link href="{{asset('contents/admin')}}/plugins/summernote/summernote-bs4.css" rel="stylesheet" type="text/css" />
      <link href="{{asset('contents/admin')}}/assets/css/moltran.css" rel="stylesheet" type="text/css" />
      <link href="{{asset('contents/admin')}}/assets/css/taginput.css" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" href="{{asset('contents/common')}}/css/toastr.min.css">
      <link href="{{asset('contents/admin')}}/assets/css/chosen.css" rel="stylesheet" type="text/css" />
      <link href="{{asset('contents/admin')}}/assets/css/style.css" rel="stylesheet" type="text/css" />
      <script src="{{asset('contents/admin')}}/assets/js/modernizr.min.js"></script>
      {{-- dashboard css --}}
      <style media="screen">

      </style>
      @yield('styles')
      {{-- dashboard css --}}
  </head>
  <body class="fixed-left">
      <div id="wrapper">
          @include('layouts.back_include.topbar')
          <div class="left side-menu">
              <div class="sidebar-inner slimscrollleft">
                  <div class="user-details">
                      <div class="pull-left">
                          @if(Auth::user()->upload_photo_path == NULL)
                            <img class="thumb-md rounded-circle" src="{{ asset('contents/common') }}/logo/logo.png" alt="user-photo"/>
                          @else
                            <img class="thumb-md rounded-circle" src="{{ asset(Auth::user()->upload_photo_path) }}" alt="user-photo"/>
                          @endif
                      </div>
                      <div class="user-info">
                          <a href="{{ route('admin.profile') }}" class="topbar-in-dashboard">
                              {{ Auth::user()->name }}
                          </a>
                          <p class="text-muted m-0">Active</p>
                      </div>
                  </div>
                  @include('layouts.back_include.sidebar')
                  <div class="clearfix"></div>
              </div>
          </div>
          <div class="content-page">
              <div class="content">
                  <div class="container-fluid">
                      @yield('content')
                  </div>
              </div>
              <footer class="footer">
                   Soft It Care | Development by <a target="_blank" href="#">Saiful Islam</a>
              </footer>
          </div>
      </div>

      <script>
          var resizefunc = [];
      </script>
      <script src="{{asset('contents/admin')}}/assets/js/jquery.min.js"></script>
      <script src="{{asset('contents/admin')}}/assets/js/bootstrap.bundle.min.js"></script>
      <script src="{{asset('contents/admin')}}/assets/js/datatables.min.js"></script>
      <script src="{{asset('contents/admin')}}/assets/js/detect.js"></script>
      <script src="{{asset('contents/admin')}}/assets/js/fastclick.js"></script>
      <script src="{{asset('contents/admin')}}/assets/js/jquery.slimscroll.js"></script>
      <script src="{{asset('contents/admin')}}/assets/js/jquery.blockUI.js"></script>
      <script src="{{asset('contents/admin')}}/assets/js/waves.js"></script>
      <script src="{{asset('contents/admin')}}/assets/js/wow.min.js"></script>
      <script src="{{asset('contents/admin')}}/assets/js/jquery.nicescroll.js"></script>
      <script src="{{asset('contents/admin')}}/assets/js/jquery.scrollTo.min.js"></script>
      <!-- sweet alert -->
      <script src="{{asset('contents/admin')}}/assets/js/sweetalert/sweetalert.min.js"></script>
      <script src="{{asset('contents/admin')}}/assets/js/sweetalert/code.js"></script>
      <!-- sweet alert -->
      {{-- fontend validation --}}
      <script src="{{asset('contents/admin')}}/assets/js/jquery-validator/parsley.min.js"></script>
      <script src="{{asset('contents/admin')}}/assets/js/taginput.min.js"></script>
      {{-- fontend validation --}}
      <script src="{{asset('contents/admin')}}/plugins/moment/moment.min.js"></script>
      <script src="{{asset('contents/admin')}}/plugins/waypoints/lib/jquery.waypoints.js"></script>
      <script src="{{asset('contents/admin')}}/plugins/counterup/jquery.counterup.min.js"></script>
      <script src="{{asset('contents/admin')}}/plugins/flot-chart/jquery.flot.min.js"></script>
      <script src="{{asset('contents/admin')}}/plugins/flot-chart/jquery.flot.time.js"></script>
      <script src="{{asset('contents/admin')}}/plugins/flot-chart/jquery.flot.tooltip.min.js"></script>
      <script src="{{asset('contents/admin')}}/plugins/flot-chart/jquery.flot.resize.js"></script>
      <script src="{{asset('contents/admin')}}/plugins/flot-chart/jquery.flot.pie.js"></script>
      <script src="{{asset('contents/admin')}}/plugins/flot-chart/jquery.flot.selection.js"></script>
      <script src="{{asset('contents/admin')}}/plugins/flot-chart/jquery.flot.stack.js"></script>
      <script src="{{asset('contents/admin')}}/plugins/flot-chart/jquery.flot.crosshair.js"></script>
      <script src="{{asset('contents/admin')}}/assets/pages/jquery.todo.js"></script>
      <script src="{{asset('contents/admin')}}/assets/pages/jquery.dashboard.js"></script>
      <script src="{{asset('contents/admin')}}/assets/js/jquery.app.js"></script>
      <script src="{{asset('contents/admin')}}/plugins/summernote/summernote-bs4.js"></script>
      <script src="{{asset('contents/admin')}}/assets/js/chosen.jquery.js"></script>
      <script src="{{asset('contents/admin')}}/assets/js/jquery.printPage.js"></script>
      {{-- toastr massage --}}
      {{-- toaster massage --}}
      <script src="{{asset('contents/common')}}/js/toastr.min.js"></script>
      <script>
          @if (Session::has('message'))
              var type ="{{ Session::get('alert-type', 'info') }}"
              switch(type){
              case 'info':
              toastr.info(" {{ Session::get('message') }} ");
              break;

              case 'success':
              toastr.success(" {{ Session::get('message') }} ");
              break;

              case 'warning':
              toastr.warning(" {{ Session::get('message') }} ");
              break;

              case 'error':
              toastr.error(" {{ Session::get('message') }} ");
              break;
              }
          @endif

      </script>
      {{-- toastr massage --}}
      <script src="{{asset('contents/admin')}}/assets/js/axios.min.js"></script>
      <script type="text/javascript">
        // ajax header
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          })
        // ajax header
      </script>
      @yield('scripts')
      <script src="{{asset('contents/admin')}}/assets/js/custom.js"></script>
      {{-- show single image --}}
      <script type="text/javascript">
          // do work
          function mainThambUrl(input){
            if (input.files && input.files[0]) {
              var reader = new FileReader();
              reader.onload = function(e){
                  $('#mainThmb').attr('src',e.target.result).width(150)
                        .height(120);
              };
              reader.readAsDataURL(input.files[0]);
            }
          }
          // do work
          // multiple image
          $(document).ready(function(){
             $('#multiImg').on('change', function(){ //on file input change
                if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
                {
                    var data = $(this)[0].files; //this file data
                    $.each(data, function(index, file){ //loop though each file
                        if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                            var fRead = new FileReader(); //new filereader
                            fRead.onload = (function(file){ //trigger function on successful read
                            return function(e) {
                                var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(80)
                            .height(80); //create image element
                                $('#preview_img').append(img); //append image to output element
                            };
                            })(file);
                            fRead.readAsDataURL(file); //URL representing the file's data.
                        }
                    });

                }else{
                    alert("Your browser doesn't support File API!"); //if File API is absent
                }
             });
            });
          // multiple image
      </script>
      {{-- show single image --}}

  </body>
</html>
