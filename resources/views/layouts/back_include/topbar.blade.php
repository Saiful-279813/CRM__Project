@php
  $notificationCount = App\Models\ContactForm::count();
@endphp
<div class="topbar">
    <div class="topbar-left">
        <div class="text-center">
            <a href="{{ route('admin.dashboard') }}" class="logo"><i class="md md-terrain"></i> <span>Sowaq Admin</span></a>
        </div>
    </div>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <ul class="list-inline menu-left mb-0">
                <li class="float-left">
                    <a href="#" class="button-menu-mobile open-left">
                        <i class="fa fa-bars"></i>
                    </a>
                </li>
                {{-- <li class="hide-phone float-left">
                    <form role="search" class="navbar-form">
                        <input type="text" placeholder="Type here for search..." class="form-control search-bar">
                        <a href="#" class="btn btn-search"><i class="fa fa-search"></i></a>
                    </form>
                </li> --}}
            </ul>

            <ul class="nav navbar-right float-right list-inline">
                <li class="d-none d-sm-block">
                    <a href="#" id="btn-fullscreen" class="waves-effect waves-light"><i class="md md-crop-free"></i></a>
                </li>
                <li class="dropdown d-none d-sm-block">
                    <a href="{{ route('contact-massage') }}" class="waves-effect waves-light">
                          <i class="md md-notifications"></i>
                          <span class="badge badge-pill badge-xs badge-danger"> {{ $notificationCount }} </span>
                    </a>
                </li>
                <li class="dropdown open">
                    <a href="#" class="dropdown-toggle profile" data-toggle="dropdown" aria-expanded="true">
                      @if(Auth::user()->upload_photo_path == NULL)
                        <img class="thumb-md rounded-circle" src="{{ asset('contents/common') }}/logo/logo.png" alt="user-photo"/>
                      @else
                        <img class="thumb-md rounded-circle" src="{{ asset(Auth::user()->upload_photo_path) }}" alt="user-photo"/>
                      @endif

                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('admin.profile') }}" class="dropdown-item"><i class="md md-face-unlock mr-2"></i> Profile</a></li>
                        <li><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="dropdown-item"><i class="md md-settings-power mr-2"></i> Logout</a></li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</div>
