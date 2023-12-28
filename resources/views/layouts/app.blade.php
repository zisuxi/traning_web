<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />


<head>
    <meta charset="utf-8">
    <link rel="icon" href="{{ asset('/assets/img/brand/favicon.ico') }}" type="image/x-icon" />
    <title>Dashlead - Admin Panel HTML Dashboard Template</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="{{ asset('/assets/plugins/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('/assets/plugins/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/plugins/typicons.font/typicons.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/plugins/feather/feather.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/css/custom-style.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/plugins/sidemenu/sidemenu.css') }}" rel="stylesheet">
    <!---Switcher css-->
    <link href="{{ asset('/assets/switcher/css/switcher.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/switcher/demo.css') }}" rel="stylesheet">
</head>

<body>
    <!-- Sidemenu -->
    <div class="main-sidebar main-sidebar-sticky side-menu ">
        <div class="sidemenu-logo">
            <a class="main-logo " href="{{ url('index.html') }}">
                <img src="{{ asset('/assets/img/brand/logo.png') }}" class="header-brand-img desktop-logo"
                    alt="logo">
                <img src="{{ asset('/assets/img/brand/icon.png') }}" class="header-brand-img icon-logo" alt="logo">
                <img src="{{ asset('/assets/img/brand/logo-light.png') }}"
                    class="header-brand-img desktop-logo theme-logo" alt="logo">
                <img src="{{ asset('/assets/img/brand/icon-light.png') }}"
                    class="header-brand-img icon-logo theme-logo" alt="logo">
            </a>
        </div>
        <div class="main-sidebar-body">
            <ul class="nav">
                <li class="nav-label">Dashboard</li>
                <li class="nav-item ">
                    <a class="nav-link" href="{{ url('dashboard') }}"><i class="fe fe-airplay e"></i><span
                            class="sidemenu-label ">Dashboard</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link with-sub" href="{{ url('#') }}"><i class="fa-solid fa-user"></i><span
                            class="sidemenu-label ">User </span><i class="angle fe fe-chevron-right"></i></a>
                    <ul class="nav-sub">
                        <li class="nav-sub-item">
                            <a class="nav-sub-link " href="{{ url('/user/create') }}">Add User</a>
                        </li>
                        <li class="nav-sub-item">
                            <a class="nav-sub-link" href="{{ url('/user') }}">View User</a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link with-sub " href=""><i class="fa fa-question-circle" aria-hidden="true"></i><span
                            class="sidemenu-label">Faq </span><i class="angle fe fe-chevron-right"></i></a>
                    <ul class="nav-sub">
                        <li class="nav-sub-item">
                            <a class="nav-sub-link " href="{{ url('/faq/create') }}">Add Faq</a>
                        </li>
                        <li class="nav-sub-item">
                            <a class="nav-sub-link " href="{{ url('/faq') }}">View Faq</a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link with-sub " href=""><i class="fa fa-video-camera" aria-hidden="true"></i>
                        <span
                            class="sidemenu-label">Vedio </span><i class="angle fe fe-chevron-right"></i></a>
                    <ul class="nav-sub">
                        <li class="nav-sub-item">
                            <a class="nav-sub-link " href="{{ url('/video/create') }}">Add vedio</a>
                        </li>
                        {{-- <li class="nav-sub-item">
                            <a class="nav-sub-link " href="{{ url('/faq') }}">View Faq</a>
                        </li> --}}

                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!-- End Sidemenu -->
    <!-- Main Content-->
    <div class="main-content side-content pt-0">
        <!-- Main Header-->
        <div class="main-header side-header sticky">
            <div class="container-fluid">
                <div class="main-header-left">
                    <a class="main-logo d-lg-none" href="{{ url('index.html') }}">
                        <img src="{{ asset('/assets/img/brand/logo.png') }}" class="header-brand-img desktop-logo"
                            alt="logo">
                        <img src="{{ asset('/assets/img/brand/icon.png') }}" class="header-brand-img icon-logo"
                            alt="logo">
                        <img src="{{ asset('/assets/img/brand/logo-light.png') }}"
                            class="header-brand-img desktop-logo theme-logo" alt="logo">
                        <img src="{{ asset('/assets/img/brand/icon-light.png') }}"
                            class="header-brand-img icon-logo theme-logo" alt="logo">
                    </a>
                    <a class="main-header-menu-icon  " href="{{ url('#') }}"
                        id="mainSidebarToggle"><span></span></a>
                </div>
                <div class="main-header-right">
                    <div class="dropdown d-md-flex">
                        <a class="nav-link icon full-screen-link">
                            <i class="fe fe-maximize fullscreen-button"></i>
                        </a>
                    </div>
                    <div class="dropdown main-profile-menu">
                        <a class="main-img-user" href="{{ url('#') }}"><img alt="avatar"
                                src="{{ asset('/assets/img/users/1.jpg') }}"></a>
                        <div class="dropdown-menu">

                            <a class="dropdown-item border-top" href="{{ url('#') }}">
                                <i class="fe fe-user"></i> My Profile
                            </a>

                            <a class="dropdown-item" href="{{ url('#') }}">
                                <i class="fe fe-edit"></i> Edit Profile
                            </a>
                            <hr>
                            <form method="POST" action="{{ route('logout') }}" style="margin: 0; padding: 0;">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    <i class="fas fa-sign-out mr-3"></i> {{ __('Sign Out') }}
                                </x-dropdown-link>
                            </form>
                            {{-- <i class="fe fe-power"></i> --}}


                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- End Main Header-->
        <div class="container-fluid">
            @yield('main-content')
        </div>

        <a href="{{ url('#top') }}" id="back-to-top"><i class="fe fe-arrow-up"></i></a>
        <script src="{{ asset('/assets/js/sweat@alert.js') }}"></script>
        <script src="{{ asset('/assets/plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('/assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('/assets/plugins/ionicons/ionicons.js') }}"></script>
        <script src="{{ asset('/assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>
        <script src="{{ asset('/assets/js/index.js') }}"></script>
        <script src="{{ asset('/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
        <script src="{{ asset('/assets/plugins/sidemenu/sidemenu.js') }}"></script>
        <script src="{{ asset('/assets/switcher/js/switcher.js') }}"></script>
        <script src="{{ asset('/assets/js/custom.js') }}"></script>
        @yield('script')

</body>

</html>
