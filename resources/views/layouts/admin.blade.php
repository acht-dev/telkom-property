<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    @yield('style')
    @include('includes.style')
</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <div class="app-header header-shadow">
            <div class="app-header__logo">
                <div class="logo-src"></div>
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                            data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            {{-- START: Header Mobile --}}
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            {{-- END: Header Mobile --}}

            {{-- START: Header Menu --}}
            <div class="app-header__menu">
                <span>
                    <button type="button"
                        class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>
            {{-- END: Header Menu --}}

            {{-- START: Header Content --}}
            <div class="app-header__content">
                <div class="app-header-right">
                    <div class="widget-content-right header-user-info ml-3">
                        <button type="button" class="btn-shadow p-1 btn btn-primary btn-sm">
                            <a class="" href="{{ route('logout') }}" style="text-decoration: none;"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="text-white pr-1 pl-1 fa fa-sign-out-alt"></i>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </button>
                    </div>
                </div>
            </div>
            {{-- END: Header Content --}}
        </div>

        {{-- START: Main Content --}}
        <div class="app-main">
            <div class="app-sidebar sidebar-shadow">
                <div class="app-header__logo">
                    <div class="logo-src"></div>
                    <div class="header__pane ml-auto">
                        <div>
                            <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                                data-class="closed-sidebar">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="app-header__mobile-menu">
                    <div>
                        <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="app-header__menu">
                    <span>
                        <button type="button"
                            class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                            <span class="btn-icon-wrapper">
                                <i class="fa fa-ellipsis-v fa-w-6"></i>
                            </span>
                        </button>
                    </span>
                </div>
                {{-- START: Side Nav --}}
                <div class="scrollbar-sidebar">
                    <div class="app-sidebar__inner">
                        <ul class="vertical-nav-menu">
                            <li class="app-sidebar__heading">Dashboards</li>
                            <li class="nav-link active">
                                <a href="{{ route('dashboard') }}">
                                    <i class="metismenu-icon fa fa-rocket"></i>
                                    Beranda
                                </a>
                            </li>
                            <li class="nav-link active">
                                <a href="{{ route('security.index') }}">
                                    <i class="metismenu-icon fa fa-lock"></i>
                                    Data Security
                                </a>
                            </li>
                            <li class="nav-link active">
                                <a href="{{ route('daily.index') }}">
                                    <i class="metismenu-icon fa fa-clock"></i>
                                    Data Harian
                                </a>
                            </li>
                            {{-- <li class="nav-link active">
                                <a href="{{ route('data-apar.index') }}">
                                    <i class="metismenu-icon fa fa-file"></i>
                                    Data APAR
                                </a>
                            </li> --}}
                        </ul>
                    </div>
                </div>
                {{-- END: Side Nav --}}
            </div>
            <div class="app-main__outer">
                <div class="app-main__inner">
                    <div class="app-page-title">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading">
                                @yield('main-title')
                            </div>
                        </div>
                    </div>

                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            @yield('main-content')
                        </div>
                    </div>
                </div>
                <div class="app-wrapper-footer">
                    <div class="app-footer">
                        <div class="app-footer__inner">
                            <div class="mx-auto">
                                Copyright &copy; 2020 Eprayogia
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- END: Main Content --}}
    </div>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    @include('includes.script')

    @yield('script')
</body>

</html>

@yield('modal')