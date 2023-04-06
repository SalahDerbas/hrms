<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li >

        <li class="nav-item" style="padding-right: 3px;">
            <a class="nav-link"  href="{{ route('home') }}" role="button" style="color:white;background-color:#343a40;height: 46px;"> {{trans('trans.Home')}} </a>
        </li >

        @can('Log_Viewer')
        <li class="nav-item">
            <a class="nav-link"  href="{{ route('logs') }}" target="_blank"  role="button" style="color:white;background-color:#343a40;height: 46px;"> {{trans('trans.Log_Viewer')}}   </a>
        </li >
       @endcan

    </ul>


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto" >

        <div class="btn-group mb-1">
            <button type="button" class="btn btn-light btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @if (App::getLocale() == 'ar')
                    {{ LaravelLocalization::getCurrentLocaleName() }}
                    <img src="{{ URL::asset('assets/img/EG.png') }}" alt="">
                @else
                    {{ LaravelLocalization::getCurrentLocaleName() }}
                    <img src="{{ URL::asset('assets/img/US.png') }}" alt="">
                @endif
            </button>
            <div class="dropdown-menu">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                        {{ $properties['native'] }}
                    </a>
                @endforeach
            </div>
        </div>


        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <img src="{{ Auth::user()->photo }}" class="img-circle " alt="User Image" width="20" height="20" style="margin-bottom: 4px;">
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                @can('Profile')
                <div class="dropdown-divider"></div>
                <a href="{{ route('getProfile') }}" class="dropdown-item">
                    <i class="fa-regular fa-id-badge" style="padding: 10px;"></i> {{trans('trans.Profile')}}
                </a>
                @endcan

                @can('Reset_Password')
                    <div class="dropdown-divider"></div>
                <a href="{{ route('resetPassword') }}" class="dropdown-item">
                    <i class="fa-solid fa-lock fa-id-badge" style="padding: 10px;"></i> {{trans('trans.Reset_Password')}}
                </a>
                @endcan

               @can('Settings')
                    <div class="dropdown-divider"></div>
                <a href="{{ route('setting') }}" class="dropdown-item">
                    <i class="fa-solid fa-gears" style="padding: 10px;"></i> {{trans('trans.Settings')}}
                </a>
                @endcan

                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa-solid fa-right-from-bracket" style="padding: 10px;"></i>  {{trans('trans.Logout')}}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>

            </div>
        </li>




        @can('Notifications')
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge">{{ Auth::user()->unreadnotifications->count() }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">{{ Auth::user()->unreadnotifications->count() }}  {{trans('trans.Notifications')}}</span>

{{--                Auth::user()->unreadNotifications->take(3)--}}
                @foreach(Auth::user()->unreadNotifications as $unreadnotification)
                    <a href="{{ url('/') }}/readNotification/{{$unreadnotification->id}}" class="dropdown-item" style="background: #3baaa8; color: #fff !important;">
                        <i class="fa fa-envelope mr-2"></i> {{ $unreadnotification->data['data'] }}
                        <span class="float-right text-sm text-white">{{ date('Y-m-d', strtotime($unreadnotification->created_at )) }}</span>
                        <br>
                        <i class="fa fa-user"></i> &nbsp; {{ $unreadnotification->data['firstname'] }}
                        <div class="dropdown-divider"></div>
                    </a>
                @endforeach

{{--                Auth::user()->readNotifications->take(2)--}}
                @foreach(Auth::user()->readNotifications as $readnotification)
                    <a href="#" class="dropdown-item">
                        <i class="fa fa-envelope mr-2"></i> {{ $readnotification->data['data'] }}
                        <span class="float-right text-sm text-dark">{{ date('Y-m-d', strtotime($readnotification->created_at )) }}</span>
                        <br>
                        <i class="fa fa-user"></i> &nbsp; {{ $readnotification->data['firstname'] }}
                    </a>
                    <div class="dropdown-divider"></div>
                @endforeach

                <div class="dropdown-divider"></div>
                <a href="{{ route('markallasread') }}" class="dropdown-item dropdown-footer">{{trans('trans.See_All_Notifications')}} </a>
            </div>
        </li>
        @endcan

        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>

    </ul>
</nav>
<!-- /.navbar -->
