<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Dashboard for Software and Website" name="description" />
        <meta content="Nishad" name="author" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>CRM :: Dashboard</title>
        <link rel="shortcut icon" href="{{asset('contents/admin')}}/assets/images/favicon.svg">
        <link rel="stylesheet" href="{{asset('contents/admin')}}/assets/css/bootstrap.min.css" id="bootstrap-style"/>
        <link rel="stylesheet" href="{{asset('contents/admin')}}/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css"/>
        <link rel="stylesheet" href="{{asset('contents/admin')}}/assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css">

        <link rel="stylesheet" href="{{asset('contents/admin')}}/assets/css/icons.min.css"/>
        <link rel="stylesheet" href="{{asset('contents/admin')}}/assets/css/app.min.css" id="app-style"/>
        <link rel="stylesheet" href="{{asset('contents/admin')}}/assets/css/select2.min.css"/>
        <link rel="stylesheet" href="{{asset('contents/admin')}}/assets/toastr/toastr.css"/>
        <link rel="stylesheet" href="{{asset('contents/admin')}}/assets/css/style.css"/>
        <link rel="stylesheet" href="{{asset('contents/admin')}}/assets/css/custom.css"/>
        @yield('styles')
        <script src="{{asset('contents/admin')}}/assets/libs/jquery/jquery.min.js"></script>
    </head>
    <body data-sidebar="dark">
        <div id="layout-wrapper">
            @include('layouts.include.topbar')
            @include('layouts.include.menu')
            <div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </div>
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                Copyright © 2021 | All rights reserved by Dashboard.
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-right d-none d-sm-block">
                                    Development by Soft It Care.
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <script src="{{asset('contents/admin')}}/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="{{asset('contents/admin')}}/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="{{asset('contents/admin')}}/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="{{asset('contents/admin')}}/assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
        <script src="{{asset('contents/admin')}}/assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="{{asset('contents/admin')}}/assets/libs/simplebar/simplebar.min.js"></script>

        <script src="{{asset('contents/admin')}}/assets/toastr/toastr.min.js"></script>
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
        <script src="{{asset('contents/admin')}}/assets/libs/node-waves/waves.min.js"></script>
        <script src="{{asset('contents/admin')}}/assets/js/pages/dashboard.init.js"></script>
        <!-- sweet alert -->
        <script src="{{asset('contents/admin')}}/assets/sweetalert/sweetalert.min.js"></script>
        <script src="{{asset('contents/admin')}}/assets/sweetalert/code.js"></script>
        <script src="{{asset('contents/admin')}}/assets/js/select2.min.js"></script>
        <script type="text/javascript">
          $(document).ready(function() {
            $('#search_select').select2();
            $('#search_select2').select2();
            $('#search_select3').select2();
            $('#search_select4').select2();
          });
        </script>
        <!-- form validation -->
        <script src="{{asset('contents/admin')}}/assets/js/parsley.min.js"></script>
        <script src="{{asset('contents/admin')}}/assets/js/app.js"></script>
        <script src="{{asset('contents/admin')}}/assets/js/custom.js"></script>
        @yield('scripts')
    </body>
</html>
