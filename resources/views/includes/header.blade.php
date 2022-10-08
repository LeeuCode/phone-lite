<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('Phone Lite') }} | @yield('title')</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- <link rel="stylesheet" href="dist/css/adminlte.min.rtl.css"> -->

    <!-- Bootstrap 4 RTL -->
    <link rel="stylesheet" href="{{ asset('dist/css/bootstrap.min.css') }}">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

    @yield('css')

    <!-- Custom style for RTL -->
    <link rel="stylesheet" href="{{ asset('dist/css/custom.css') }}">
</head>

<body class="sidebar-mini layout-fixed  sidebar-collapse">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                @include('components.top-menu')
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav mr-auto-navbav">
                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    @php
                        $itemsCount = App\Models\Item::where('store_balance', '<=', 5)->count();
                    @endphp
                    <a class="nav-link" href="{{ route('items.out-of-stock') }}">
                        <i class="fa fa-bell" aria-hidden="true"></i>
                        @if ($itemsCount > 0)
                            <span class="badge badge-danger navbar-badge">{{ $itemsCount }}</span>
                        @endif
                    </a>
                </li>

                <li class="nav-item dropdown">
                    @php
                        $installmentMonths = App\Models\InstallmentMonth::whereDate('renewal_date', '<=', date('Y-m-d'))
                            // ->where('state', 0)
                            ->limit(5)
                            ->get();
                        $monthsCount = count($installmentMonths);
                    @endphp
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fas fa-hand-holding"></i>
                        @if ($monthsCount > 0)
                            <span class="badge badge-danger navbar-badge">{{ $monthsCount }}</span>
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-header">{{ __('الاقساط المطلوب دفعها') }}</span>
                        <div class="dropdown-divider"></div>
                        @if ($monthsCount > 0)
                            @foreach ($installmentMonths as $installmentMonth)
                                <a href="#" class="dropdown-item">
                                    <!-- Message Start -->
                                    <div class="media">
                                        {{-- <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle"> --}}
                                        <div class="media-body">
                                            <h3 class="dropdown-item-title">
                                                <span class="text-primary">{{ __('دفع قسط') }}</span>
                                                {{ $installmentMonth->installment->customer->title }}
                                            </h3>
                                            <p class="text-sm"><strong class="text-primary">الصنف :</strong>
                                                {{ $installmentMonth->installment->item->title }}</p>
                                            <p class="text-sm text-muted">
                                                <i class="far fa-calendar-alt mr-1"></i>
                                                <strong
                                                    class="text-danger">{{ $installmentMonth->renewal_date }}</strong>
                                            </p>
                                        </div>
                                    </div>
                                    <!-- Message End -->
                                </a>
                                <div class="dropdown-divider"></div>
                            @endforeach
                            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                        @else
                            <i class="dropdown-item">{{ __('لا توجد اي اقساط مستحقه حتي الان') }}</i>
                        @endif
                    </div>

                </li>

                <li class="nav-item dropdown">
                    @php
                        $maintenancesMonths = App\Models\Maintenance::whereDate('delivery_date', '<=', date('Y-m-d'))
                            // ->where('state', 0)
                            ->limit(5)
                            ->get();
                        $monthsCount = count($maintenancesMonths);
                    @endphp
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fas fa-mobile-alt"></i>
                        @if ($monthsCount > 0)
                            <span class="badge badge-danger navbar-badge">{{ $monthsCount }}</span>
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-header">{{ __('اجهزة الصيانة المطلوب تسليمها') }}</span>
                        <div class="dropdown-divider"></div>
                        @if ($monthsCount > 0)
                            @foreach ($maintenancesMonths as $maintenance)
                                <a href="#" class="dropdown-item">
                                    <!-- Message Start -->
                                    <div class="media">
                                        {{-- <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle"> --}}
                                        <div class="media-body">
                                            <h3 class="dropdown-item-title">
                                                <span class="text-primary">{{ __('تسليم جهاز') }} : </span>
                                                {{ $maintenance->agent_name }}
                                            </h3>
                                            <p class="text-sm"><strong class="text-primary">الصنف : </strong>
                                                {{ $maintenance->types->title }}</p>
                                            <p class="text-sm text-muted">
                                                <i class="far fa-calendar-alt mr-1"></i>
                                                <strong class="text-danger">{{ $maintenance->delivery_date }}</strong>
                                            </p>
                                        </div>
                                    </div>
                                    <!-- Message End -->
                                </a>
                                <div class="dropdown-divider"></div>
                            @endforeach
                            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                        @else
                            <i class="dropdown-item">{{ __('لا يوجد اي جهاز صيانة للتسليم') }}</i>
                        @endif
                    </div>
                </li>

                <!-- Notifications Dropdown Menu -->
                {{-- <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li> --}}
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-user-circle"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-header">{{ auth()->user()->name }}</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dark-mode-nav dropdown-item change-mode" data-mode="dark">
                            <i class="fas fa-moon mr-2"></i>
                            {{ __('الوضع الليلي') }}
                        </a>
                        <a href="#" class="white-mode-nav dropdown-item change-mode d-none" data-mode="white">
                            <i class="fas fa-sun mr-2"></i>
                            {{ __('الوضع النهاري') }}
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('frm-logout').submit();"
                            class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i>
                            {{ __('تسجيل خروج') }}
                        </a>
                        <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        @include('includes.sidebar')
