@extends('dashbroad.index')

@section('content')

    <body class="g-sidenav-show  bg-gray-200">
        <aside
            class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark"
            id="sidenav-main">
            <div class="sidenav-header">
                <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                    aria-hidden="true" id="iconSidenav"></i>
                <a class="navbar-brand m-0" href="{{ route('home') }}">
                    <img src="{{ asset('assets/img/logo-ct.png') }}" class="navbar-brand-img h-100" alt="main_logo">
                    <span class="ms-1 font-weight-bold text-white">TRUONGBO</span>
                </a>
            </div>
            <hr class="horizontal light mt-0 mb-2">
            <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-white active bg-gradient-primary" href="./pages/dashboard.html">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">dashboard</i>
                            </div>
                            <span class="nav-link-text ms-1">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white " href="./pages/tables.html">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">table_view</i>
                            </div>
                            <span class="nav-link-text ms-1">Tables</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white " href="./pages/billing.html">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">receipt_long</i>
                            </div>
                            <span class="nav-link-text ms-1">Billing</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white " href="./pages/virtual-reality.html">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">view_in_ar</i>
                            </div>
                            <span class="nav-link-text ms-1">Virtual Reality</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white " href="./pages/notifications.html">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">notifications</i>
                            </div>
                            <span class="nav-link-text ms-1">Notifications</span>
                        </a>
                    </li>
                    <li class="nav-item mt-3">
                        <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Nhân sự
                        </h6>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white " href="{{ route('user.index') }}">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">person</i>
                            </div>
                            <span class="nav-link-text ms-1">Nhân viên</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white " href="./pages/sign-up.html">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">assignment</i>
                            </div>
                            <span class="nav-link-text ms-1">Lịch làm</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white " href="./pages/sign-up.html">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">money</i>
                            </div>
                            <span class="nav-link-text ms-1">Bảng lương</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="sidenav-footer position-absolute w-100 bottom-0 ">
                <div class="mx-3">
                    <!-- Custom theme -->
                    <div class="fixed-plugin">
                        <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
                            <i class="material-icons py-2">settings</i>
                        </a>
                        <div class="card shadow-lg">
                            <div class="card-header pb-0 pt-3">
                                <div class="float-start">
                                    <h5 class="mt-3 mb-0">Giao diện</h5>
                                    <p>Tùy chỉnh hiển thị giao diện.</p>
                                </div>
                                <div class="float-end mt-4">
                                    <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                                        <i class="material-icons">clear</i>
                                    </button>
                                </div>
                                <!-- End Toggle Button -->
                            </div>
                            <hr class="horizontal dark my-1">
                            <div class="card-body pt-sm-3 pt-0">
                                <!-- Sidebar Backgrounds -->
                                <div>
                                    <h6 class="mb-0">Sidebar Colors</h6>
                                </div>
                                <a href="javascript:void(0)" class="switch-trigger background-color">
                                    <div class="badge-colors my-2 text-start">
                                        <span class="badge filter bg-gradient-primary active" data-color="primary"
                                            onclick="sidebarColor(this)"></span>
                                        <span class="badge filter bg-gradient-dark" data-color="dark"
                                            onclick="sidebarColor(this)"></span>
                                        <span class="badge filter bg-gradient-info" data-color="info"
                                            onclick="sidebarColor(this)"></span>
                                        <span class="badge filter bg-gradient-success" data-color="success"
                                            onclick="sidebarColor(this)"></span>
                                        <span class="badge filter bg-gradient-warning" data-color="warning"
                                            onclick="sidebarColor(this)"></span>
                                        <span class="badge filter bg-gradient-danger" data-color="danger"
                                            onclick="sidebarColor(this)"></span>
                                    </div>
                                </a>
                                <!-- Sidenav Type -->
                                <div class="mt-3">
                                    <h6 class="mb-0">Sidenav Type</h6>
                                    <p class="text-sm">Lưu ý tránh chọn màu trùng với sidebar color.</p>
                                </div>
                                <div class="d-flex">
                                    <button class="btn bg-gradient-dark px-3 mb-2 active" data-class="bg-gradient-dark"
                                        onclick="sidebarType(this)">Dark</button>
                                    <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-transparent"
                                        onclick="sidebarType(this)">Transparent</button>
                                    <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-white"
                                        onclick="sidebarType(this)">White</button>
                                </div>
                                <p class="text-sm d-xl-none d-block mt-2">Bạn cần phải thay đổi sidenav chỉ hiển thị trên
                                    Desktop.
                                </p>
                                <!-- Navbar Fixed -->
                                <div class="mt-3 d-flex">
                                    <h6 class="mb-0">Navbar Fixed</h6>
                                    <div class="form-check form-switch ps-0 ms-auto my-auto">
                                        <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed"
                                            onclick="navbarFixed(this)">
                                    </div>
                                </div>
                                <hr class="horizontal dark my-3">
                                <div class="mt-2 d-flex">
                                    <h6 class="mb-0">Light / Dark</h6>
                                    <div class="form-check form-switch ps-0 ms-auto my-auto">
                                        <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version"
                                            onclick="darkMode(this)">
                                    </div>
                                </div>
                                <hr class="horizontal dark my-sm-4">
                                <div class="w-100 text-center">
                                    <h6 class="mt-3">Contact</h6>
                                    <a href="https://www.facebook.com/truonghocgioii" class="btn btn-dark mb-0 me-2"
                                        target="_blank">
                                        <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Nguyễn Quang Trường
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end custom -->
                </div>
            </div>
        </aside>
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            <!-- Navbar -->
            <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
                navbar-scroll="true">
                <div class="container-fluid py-1 px-3">
                    <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                        <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                            <div class="input-group input-group-outline">
                                <label class="form-label">Type here...</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <ul class="navbar-nav  justify-content-end">
                            <li class="nav-item d-flex align-items-center">
                                @if (Route::has('login'))
                                    <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                                        @auth
                                <li class="nav-item dropdown pe-2 d-flex align-items-center">
                                    <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <img class="avatar avatar-sm  me-3 border-radius-lg" alt="thumbnail avatar"
                                            src="{{ asset('assets/img/avatar/' . Auth::user()->avatar) }}">
                                        <b>{{ Auth::user()->name }}</b>
                                    </a>
                                    <ul class="dropdown-menu  dropdown-menu-end  px-4 py-3 me-sm-n1"
                                        aria-labelledby="dropdownMenuButton">
                                        <li class="mb-2">
                                            <a class="dropdown-item border-radius-md" href="{{ route('user.profile') }}">
                                                <div class="d-flex py-1">
                                                    <div class="my-auto">
                                                        <i class="material-icons me-3">people</i>
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="text-sm font-weight-normal mb-1">
                                                            <span class="font-weight-bold">Profile</span>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="mb-2">
                                            <a class="dropdown-item border-radius-md" href="{{ route('user.logout') }}">
                                                <div class="d-flex py-1">
                                                    <div class="my-auto">
                                                        <i class="material-icons me-3">logout</i>
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-right">
                                                        <h6 class="text-sm font-weight-normal mb-1">
                                                            <span class="font-weight-bold">Logout</span>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @else
                                <a href="{{ route('login') }}" class="nav-link text-body font-weight-bold px-0">
                                    <i class="fa fa-user me-sm-1"></i>
                                    <span class="d-sm-inline d-none">Sign In</span>
                                </a>
                            @endauth
                    </div>
                    @endif
                    </li>
                    <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item px-3 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-body p-0">
                            <i class="material-icons fixed-plugin-button-nav">settings</i>
                        </a>
                    </li>
                    <li class="nav-item dropdown pe-2 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="material-icons">notifications</i>
                        </a>
                        <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4"
                            aria-labelledby="dropdownMenuButton">
                            <li class="mb-2">
                                <a class="dropdown-item border-radius-md" href="javascript:;">
                                    <div class="d-flex py-1">
                                        <div class="my-auto">
                                            <img src="{{ asset('assets/img/team-2.jpg') }}"
                                                class="avatar avatar-sm  me-3 ">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="text-sm font-weight-normal mb-1">
                                                <span class="font-weight-bold">New message</span> from Laur
                                            </h6>
                                            <p class="text-xs text-secondary mb-0">
                                                <i class="fa fa-clock me-1"></i>
                                                13 minutes ago
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="mb-2">
                                <a class="dropdown-item border-radius-md" href="javascript:;">
                                    <div class="d-flex py-1">
                                        <div class="my-auto">
                                            <img src="{{ asset('assets/img/small-logos/logo-spotify.svg') }}"
                                                class="avatar avatar-sm bg-gradient-dark  me-3 ">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="text-sm font-weight-normal mb-1">
                                                <span class="font-weight-bold">New album</span> by Travis Scott
                                            </h6>
                                            <p class="text-xs text-secondary mb-0">
                                                <i class="fa fa-clock me-1"></i>
                                                1 day
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item border-radius-md" href="javascript:;">
                                    <div class="d-flex py-1">
                                        <div class="avatar avatar-sm bg-gradient-secondary  me-3  my-auto">
                                            <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1"
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                                <title>credit-card</title>
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF"
                                                        fill-rule="nonzero">
                                                        <g transform="translate(1716.000000, 291.000000)">
                                                            <g transform="translate(453.000000, 454.000000)">
                                                                <path class="color-background"
                                                                    d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z"
                                                                    opacity="0.593633743"></path>
                                                                <path class="color-background"
                                                                    d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z">
                                                                </path>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg>
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="text-sm font-weight-normal mb-1">
                                                Payment successfully completed
                                            </h6>
                                            <p class="text-xs text-secondary mb-0">
                                                <i class="fa fa-clock me-1"></i>
                                                2 days
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    </ul>
                </div>
                </div>
            </nav>
            <!-- End Navbar -->
            @yield('main')

        </main>
    </body>
@section('scriptadd')
    {{-- thêm script ở đây --}}
    @yield('scriptadd1')
@endsection
@endsection
