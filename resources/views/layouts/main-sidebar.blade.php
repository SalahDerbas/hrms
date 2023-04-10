<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Brand Logo -->
    <a href="{{route('home')}}" class="brand-link text-center">
        <img src="{{asset('assets/img/Logo.png')}}" alt="Logo"  style="opacity: .8; width:22px;height:22px;">
        <span class="brand-text font-weight-light ">{{ config('app.name', 'Laravel') }}</span>
    </a>


    <!-- Sidebar -->
    <div class="sidebar">

        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ Auth::user()->photo }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <span style="color: white;"> {{ Auth::user()->email ?? '' }}  </span>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="{{route('home')}}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            {{trans('trans.Dashboard')}}
                        </p>
                    </a>
                </li>

                @can('List_Users')
                <li class="nav-item">
                    <a href="{{route('Users.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            {{trans('trans.Users')}}
                        </p>
                    </a>
                </li>
                @endcan

                @can('Roles_and_Permissions')
                <li class="nav-item">
                    <a  class="nav-link">
                        <svg class="svg-inline--fa fa-shield-halved nav-icon" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="shield-halved" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-v-11246446=""><path class="" fill="currentColor" d="M256-.0078C260.7-.0081 265.2 1.008 269.4 2.913L457.7 82.79C479.7 92.12 496.2 113.8 496 139.1C495.5 239.2 454.7 420.7 282.4 503.2C265.7 511.1 246.3 511.1 229.6 503.2C57.25 420.7 16.49 239.2 15.1 139.1C15.87 113.8 32.32 92.12 54.3 82.79L242.7 2.913C246.8 1.008 251.4-.0081 256-.0078V-.0078zM256 444.8C393.1 378 431.1 230.1 432 141.4L256 66.77L256 444.8z"></path></svg>
                        <p>
                            {{trans('trans.Role_and_Permissions')}}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        @can('List_Roles')
                        <li class="nav-item">
                            <a href="{{ route('Roles.index') }}" class="nav-link">
                                <svg class="svg-inline--fa fa-user-check nav-icon" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="user-check" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" data-v-11246446=""><path class="" fill="currentColor" d="M274.7 304H173.3C77.61 304 0 381.6 0 477.3C0 496.5 15.52 512 34.66 512H413.3C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304zM224 256c70.7 0 128-57.31 128-128S294.7 0 224 0C153.3 0 96 57.31 96 128S153.3 256 224 256zM632.3 134.4c-9.703-9-24.91-8.453-33.92 1.266l-87.05 93.75l-38.39-38.39c-9.375-9.375-24.56-9.375-33.94 0s-9.375 24.56 0 33.94l56 56C499.5 285.5 505.6 288 512 288h.4375c6.531-.125 12.72-2.891 17.16-7.672l104-112C642.6 158.6 642 143.4 632.3 134.4z"></path></svg>
                                <p>{{trans('trans.Roles')}} </p>
                            </a>
                        </li>
                        @endcan

                        @can('List_Permissions')
                        <li class="nav-item">
                            <a href="{{ route('permissions') }}" class="nav-link">
                                <svg class="svg-inline--fa fa-user-shield nav-icon" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="user-shield" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" data-v-11246446=""><path class="" fill="currentColor" d="M622.3 271.1l-115.1-45.01c-4.125-1.629-12.62-3.754-22.25 0L369.8 271.1C359 275.2 352 285.1 352 295.1c0 111.6 68.75 188.8 132.9 213.9c9.625 3.75 18 1.625 22.25 0C558.4 489.9 640 420.5 640 295.1C640 285.1 633 275.2 622.3 271.1zM496 462.4V273.2l95.5 37.38C585.9 397.8 530.6 446 496 462.4zM224 256c70.7 0 128-57.31 128-128S294.7 0 224 0C153.3 0 96 57.31 96 128S153.3 256 224 256zM320.6 310.3C305.9 306.3 290.6 304 274.7 304H173.3C77.61 304 0 381.7 0 477.4C0 496.5 15.52 512 34.66 512H413.3c3.143 0 5.967-1.004 8.861-1.789C369.7 469.8 324.1 400.3 320.6 310.3z"></path></svg>
                                <p>
                                    {{trans('trans.Permissions')}}

                                </p>
                            </a>
                        </li>
                       @endcan

                    </ul>
                </li>
                @endcan


                @can('List_Push_Notifications')
                <li class="nav-item">
                    <a href="{{route('pushNotification')}}" class="nav-link">
                        <i class="nav-icon fa-regular fa-bell"></i>
                        <p>
                            {{trans('trans.Push_Notifications')}}
                        </p>
                    </a>
                </li>
                @endcan

                @can('Settings')
                <li class="nav-item">
                    <a href="{{route('setting')}}" class="nav-link">
                        <i class="nav-icon fa-solid fa-gears"></i>
                        <p>
                            {{trans('trans.Settings')}}
                        </p>
                    </a>
                </li>
                @endcan

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
