<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Futami - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body id="page-top" style="background-color: #F2F6EB">
    @include('sweetalert::alert')
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion d-md-inline-block" id="sidebar"
            style="display: none">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center my-3" href="/">
                <img src="{{ asset('assets/img/futamilogo.png') }}" class="img-fluid" alt="">
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-3">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="/dashboard">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            @if (Auth::user()->role_id !== '1')
                <li class="nav-item {{ request()->is('dashboard/stok-langsung') ? 'active' : '' }}">
                    <a class="nav-link" href="/dashboard/stok-langsung">
                        <i class="fa-solid fa-robot"></i>
                        <span>Data Auto Scan</span></a>
                </li>
            @endif

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            @if (Auth::user()->role_id == 3)
                <li class="nav-item {{ request()->is('dashboard/user-data') ? 'active' : '' }}">
                    <a class="nav-link collapsed" href="/dashboard/user-data">
                        <i class="fa-solid fa-users"></i>
                        <span>User Data</span>
                    </a>
                </li>
            @endif


            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item {{ request()->is('dashboard/material-data') ? 'active' : '' }}">
                <a class="nav-link collapsed" href="/dashboard/material-data">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Material Data</span>
                </a>
            </li>
            @if (Auth::user()->role_id !== '1')
                <li class="nav-item {{ request()->is('dashboard/satuan-data') ? 'active' : '' }}">
                    <a class="nav-link collapsed" href="/dashboard/satuan-data">
                        <i class="fa-solid fa-universal-access"></i>
                        <span>BUn Data</span>
                    </a>
                </li>
            @endif
            <div class="dropdown mx-1">
                <button class="btn dropdown-toggle text-white" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fa-solid fa-qrcode text-white me-2"></i><span
                        class="ms-1 text-white">Pilih
                        Scan</span>
                </button>
                <ul class="dropdown-menu bg-success text-success-emphasis">
                    <li><a class="dropdown-item text-white" href="/dashboard/scan-langsung"><span>Scan Langsung</span>
                        </a></li>
                    <li><a class="dropdown-item text-white" href="/dashboard/scan-manual"><span>Scan Manual</span>
                        </a></li>
                </ul>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content" style="background-color: #F2F6EB">

                <!-- Topbar -->
                <nav class="navbar navbar-expand topbar mb-4 static-top shadow" style="background-color:#F2F6EB">

                    <label for="pilih"><i class="fas fa-bars mx-3 d-md-none"></i></label>
                    <input class="fa fa-bars" style="display: none" type="checkbox" checked role=""
                        id="pilih" onchange="sidebar()">

                    <!-- Topbar Search -->
                    @if (request()->is('dashboard/material-data'))
                        <form action="{{ route('dashboard.index') }}" method="get" id="search"
                            class="d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                            @csrf

                            <div class="input-group">
                                <input autofocus type="text" class="form-control bg-light border-0 small"
                                    name="search" placeholder="Cari No Material/Stok..." aria-label="Search"
                                    aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-success" type="submit">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                                <a class="btn btn-danger d-none d-md-inline" href="/dashboard/material-data">RESET</a>
                            </div>
                        </form>
                    @elseif(request()->is('dashboard/user-data'))
                        <form action="{{ route('user-index') }}" method="GET" id="search"
                            class="d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small" name="search"
                                    placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-success" type="submit">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                                <a class="btn btn-danger" href="/dashboard/user-data">RESET</a>
                            </div>
                        </form>
                    @elseif(request()->is('dashboard/stok-langsung'))
                        <form class="form-inline mr-auto ms-3" method="GET" id="search"
                            action="{{ route('dashboard-langsung') }}">
                            <div class="search-element d-flex">
                                <div class="">
                                    <input class="form-control" type="date" name="tanggal_awal"
                                        aria-label="Search" data-width="250">
                                    <input class="form-control" type="date" name="tanggal_selesai"
                                        aria-label="Search" data-width="250">
                                </div>
                                <button class="btn btn-success" type="submit"><i class="fas fa-search"></i></button>
                            </div>
                            <a class="btn btn-danger mx-2 d-none d-md-inline" href="/dashboard/stok-langsung">RESET</a>
                        </form>
                    @elseif(request()->is('dashboard'))
                        @if (Auth::user()->role_id !== '1')
                            <form class="form-inline mr-auto ms-3" method="GET" id="search"
                                action="{{ route('index-dashboard') }}">
                                <div class="search-element d-flex">
                                    <div class="">
                                        <input class="form-control" type="date" name="tanggal_awal"
                                            aria-label="Search">
                                        <input class="form-control" type="date" name="tanggal_selesai"
                                            aria-label="Search">
                                    </div>
                                    <button class="btn btn-success" type="submit"><i
                                            class="fas fa-search"></i></button>
                                </div>
                                <a class="btn btn-danger mx-2  d-none d-md-inline" href="/dashboard">RESET</a>
                            </form>
                        @endif
                    @endif


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto mr-3">
                        @if (Auth::user())
                            <li>
                                <div class="dropdown mx-4 ms-5 ms-md-3">
                                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                        aria-expanded="false"><i class="fa-solid fa-user me-2"></i><span
                                            class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                                    </button>
                                    <ul class="dropdown-menu bg-success text-success-emphasis">
                                        <li><span
                                                class="dropdown-item d-md-none text-white">{{ Auth::user()->name }}</span>
                                        </li>
                                        <li><a class="dropdown-item text-white" href="/"><i
                                                    class="fa-solid fa-house me-2"></i><span>Home</span> </a></li>
                                        <li><a class="dropdown-item text-white" href="/logout"><i
                                                    class="fa-solid fa-right-to-bracket me-2"></i><span>Logout</span>
                                            </a></li>
                                    </ul>
                                </div>
                            </li>
                        @endif

                    </ul>

                </nav>
                <!-- End of Topbar -->
                <div id="main" class="mx-2 mx-md-5">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>

    <script>
        function sidebar() {
            let pilih = document.getElementById("pilih")
            if (pilih.checked) {
                document.getElementById("sidebar").style.display = "none";
                document.getElementById("search").style.display = "";
            } else {
                document.getElementById("sidebar").style.display = "";
                document.getElementById("search").style.display = "none";


            }
        }
    </script>




</body>
