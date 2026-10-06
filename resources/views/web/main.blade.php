<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <title>@yield('title', 'Admin Dashboard')</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180"
        href="{{ asset('vendors/images/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ asset('vendors/images/favicon-32x32.png') }}">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('vendors/styles/core.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/styles/icon-font.min.css') }}">

    <!-- DataTables -->
    <link rel="stylesheet"
        href="{{ asset('src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('src/plugins/datatables/css/responsive.bootstrap4.min.css') }}">

    <!-- DeskApp -->
    <link rel="stylesheet" href="{{ asset('vendors/styles/style.css') }}">

    @stack('styles')

    <style>
        /* =====================================================
           MODERN ADMIN UI
        ===================================================== */

        body {
            font-family: 'Inter', sans-serif;
            background: #f5f7fb;
        }

        /* Header */
        .header {
            box-shadow: 0 1px 10px rgba(0, 0, 0, .05);
            background: #ffffff;
            z-index: 100;
        }

        .header .header-left {
            display: flex;
            align-items: center;
        }

        .header-search .form-control {
            border: 0;
            background: #f5f7fb;
            border-radius: 10px;
            height: 42px;
        }

        .header-search .search-icon {
            color: #7b8190;
        }

        /* Header right */
        .header-right {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .header-right > div {
            margin-left: 5px;
        }

        .dashboard-setting,
        .user-notification {
            width: 42px;
            height: 42px;
        }

        .dashboard-setting > div > a,
        .user-notification > div > a {
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            transition: .2s ease;
        }

        .dashboard-setting > div > a:hover,
        .user-notification > div > a:hover {
            background: #f1f4f9;
        }

        /* Notification */
        .notification-active {
            position: absolute;
            top: 7px;
            right: 6px;
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #ef4444;
            border: 2px solid #fff;
        }

        .notification-list {
            width: 360px;
        }

        .notification-list ul {
            padding: 0;
            margin: 0;
        }

        .notification-list li a {
            display: flex;
            gap: 12px;
            padding: 14px 16px;
            border-bottom: 1px solid #f0f2f5;
            transition: .2s ease;
        }

        .notification-list li a:hover {
            background: #f8fafc;
        }

        .notification-list img {
            width: 42px;
            height: 42px;
            object-fit: cover;
            border-radius: 50%;
        }

        .notification-list h3 {
            font-size: 13px;
            font-weight: 600;
            margin: 0 0 3px;
            color: #1f2937;
        }

        .notification-list p {
            font-size: 12px;
            line-height: 1.5;
            color: #7b8190;
            margin: 0;
        }

        /* User */
        .user-info-dropdown .dropdown-toggle {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 5px 10px;
            border-radius: 12px;
        }

        .user-info-dropdown .dropdown-toggle:hover {
            background: #f5f7fb;
        }

        .user-icon img {
            width: 38px;
            height: 38px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #e9edf3;
        }

        .user-name {
            font-size: 13px;
            font-weight: 600;
            color: #1f2937;
        }

        /* =====================================================
           SIDEBAR
        ===================================================== */

        .left-side-bar {
            background: #111827;
            box-shadow: 3px 0 15px rgba(0, 0, 0, .06);
        }

        .brand-logo {
            background: #111827;
            border-bottom: 1px solid rgba(255,255,255,.07);
        }

        .brand-logo img {
            max-height: 38px;
            max-width: 150px;
        }

        .sidebar-menu {
            padding: 18px 12px;
        }

        .sidebar-menu ul li {
            margin-bottom: 4px;
        }

        .sidebar-menu ul li a {
            border-radius: 9px;
            padding: 12px 14px;
            color: #9ca3af;
            transition: all .2s ease;
            font-size: 13px;
            font-weight: 500;
        }

        .sidebar-menu ul li a:hover {
            background: rgba(255,255,255,.07);
            color: #fff;
            transform: translateX(2px);
        }

        .sidebar-menu ul li.active > a {
            background: #2563eb;
            color: #fff;
            box-shadow: 0 5px 15px rgba(37,99,235,.25);
        }

        .sidebar-menu .micon {
            color: inherit;
            font-size: 18px;
        }

        .sidebar-menu .mtext {
            margin-left: 5px;
        }

        .sidebar-small-cap {
            color: #6b7280;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 700;
            padding: 18px 14px 8px;
        }

        .sidebar-menu .dropdown-divider {
            border-color: rgba(255,255,255,.07);
            margin: 15px 5px;
        }

        /* =====================================================
           CONTENT
        ===================================================== */

        .main-container {
            background: #f5f7fb;
            min-height: calc(100vh - 70px);
        }

        .page-header {
            background: transparent;
            padding-top: 10px;
        }

        .breadcrumb {
            background: transparent;
            padding: 0;
        }

        .breadcrumb-item {
            font-size: 12px;
        }

        /* Cards */
        .card-box,
        .pd-20.bg-white {
            border-radius: 14px;
            border: 1px solid #edf0f4;
            box-shadow: 0 3px 15px rgba(15, 23, 42, .04);
        }

        /* Buttons */
        .btn {
            border-radius: 8px;
            font-weight: 500;
        }

        .btn-primary {
            background: #2563eb;
            border-color: #2563eb;
        }

        .btn-primary:hover {
            background: #1d4ed8;
            border-color: #1d4ed8;
        }

        /* Tables */
        .table {
            background: #fff;
        }

        .table thead th {
            background: #f8fafc;
            color: #64748b;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: .4px;
            font-weight: 700;
            border-bottom: 1px solid #e5e7eb;
        }

        .table td {
            vertical-align: middle;
            color: #374151;
            font-size: 13px;
        }

        .table tbody tr:hover {
            background: #f8fafc;
        }

        /* Badge */
        .badge {
            border-radius: 20px;
            padding: 5px 9px;
            font-weight: 600;
            font-size: 10px;
        }

        /* Mobile */
        @media (max-width: 767px) {

            .user-name {
                display: none;
            }

            .notification-list {
                width: 300px;
            }

            .header-search {
                display: none;
            }

            .main-container {
                padding: 0;
            }
        }
    </style>
</head>

<body>

    <!-- =====================================================
         HEADER
    ====================================================== -->

    <div class="header">

        <div class="header-left">

            <!-- Mobile Menu -->
            <div class="menu-icon dw dw-menu"></div>

            <!-- Search Icon Mobile -->
            <div class="search-toggle-icon dw dw-search2"
                data-toggle="header_search">
            </div>

            <!-- Search -->
            <div class="header-search">

                <form>
                    <div class="form-group mb-0">

                        <i class="dw dw-search2 search-icon"></i>

                        <input type="text"
                            class="form-control search-input"
                            placeholder="Search...">

                    </div>
                </form>

            </div>

        </div>


        <div class="header-right">

            <!-- Settings -->
            <div class="dashboard-setting user-notification">

                <div class="dropdown">

                    <a href="javascript:;"
                        data-toggle="right-sidebar"
                        title="Settings">

                        <i class="dw dw-settings2"></i>

                    </a>

                </div>

            </div>


            <!-- Notifications -->
            <div class="user-notification">

                <div class="dropdown">

                    <a class="dropdown-toggle no-arrow"
                        href="#"
                        role="button"
                        data-toggle="dropdown">

                        <i class="icon-copy dw dw-notification"></i>

                        @if(isset($unreadNotifications) && $unreadNotifications > 0)
                            <span class="badge notification-active"></span>
                        @endif

                    </a>


                    <div class="dropdown-menu dropdown-menu-right">

                        <div class="notification-list mx-h-350 customscroll">

                            <ul>

                                <li>
                                    <a href="{{ route('notification.index') }}">

                                        <img src="{{ asset('vendors/images/img.jpg') }}"
                                            alt="Notification">

                                        <div>
                                            <h3>Notifications</h3>

                                            <p>
                                                View your latest notifications
                                                and updates.
                                            </p>
                                        </div>

                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('notification.create') }}">

                                        <img src="{{ asset('vendors/images/photo1.jpg') }}"
                                            alt="Send notification">

                                        <div>
                                            <h3>Send Notification</h3>

                                            <p>
                                                Send an announcement to agents.
                                            </p>
                                        </div>

                                    </a>
                                </li>

                            </ul>

                        </div>

                        <div class="text-center border-top p-2">

                            <a href="{{ route('notification.index') }}"
                                class="text-primary font-weight-600">

                                View all notifications

                            </a>

                        </div>

                    </div>

                </div>

            </div>


            <!-- User -->
            <div class="user-info-dropdown">

                <div class="dropdown">

                    <a class="dropdown-toggle"
                        href="#"
                        role="button"
                        data-toggle="dropdown">

                        <span class="user-icon">

                            <img
                                src="{{ auth()->user()->profile_photo_url ?? asset('vendors/images/photo1.jpg') }}"
                                alt="User">

                        </span>

                        <span class="user-name">
                            {{ auth()->user()->name ?? 'Administrator' }}
                        </span>

                    </a>


                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">

                        <a class="dropdown-item"
                            href="{{ route('admin.profile') }}">

                            <i class="dw dw-user1"></i>

                            Profile

                        </a>


                        <a class="dropdown-item"
                            href="#">

                            <i class="dw dw-settings2"></i>

                            Settings

                        </a>


                        <a class="dropdown-item"
                            href="#">

                            <i class="dw dw-help"></i>

                            Help

                        </a>


                        <div class="dropdown-divider"></div>


                        <form method="POST"
                            action="{{ route('logout') }}">

                            @csrf

                            <button type="submit"
                                class="dropdown-item">

                                <i class="dw dw-logout"></i>

                                Logout

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- =====================================================
         RIGHT SIDEBAR
    ====================================================== -->

    <div class="right-sidebar">

        <div class="sidebar-title">

            <h3 class="weight-600 font-16 text-blue">

                Layout Settings

                <span class="btn-block font-weight-400 font-12">
                    Customize your dashboard
                </span>

            </h3>

            <div class="close-sidebar"
                data-toggle="right-sidebar-close">

                <i class="icon-copy ion-close-round"></i>

            </div>

        </div>


        <div class="right-sidebar-body customscroll">

            <div class="right-sidebar-body-content">

                <h4 class="weight-600 font-18 pb-10">
                    Header Background
                </h4>

                <div class="sidebar-btn-group pb-30 mb-10">

                    <a href="javascript:void(0);"
                        class="btn btn-outline-primary header-white active">
                        White
                    </a>

                    <a href="javascript:void(0);"
                        class="btn btn-outline-primary header-dark">
                        Dark
                    </a>

                </div>


                <h4 class="weight-600 font-18 pb-10">
                    Sidebar Background
                </h4>

                <div class="sidebar-btn-group pb-30 mb-10">

                    <a href="javascript:void(0);"
                        class="btn btn-outline-primary sidebar-light">
                        White
                    </a>

                    <a href="javascript:void(0);"
                        class="btn btn-outline-primary sidebar-dark active">
                        Dark
                    </a>

                </div>


                <h4 class="weight-600 font-18 pb-10">
                    Menu Dropdown Icon
                </h4>

                <div class="sidebar-radio-group pb-30 mb-10">

                    <div class="custom-control custom-radio custom-control-inline">

                        <input type="radio"
                            id="sidebaricon-1"
                            name="menu-dropdown-icon"
                            class="custom-control-input"
                            value="icon-style-1"
                            checked>

                        <label class="custom-control-label"
                            for="sidebaricon-1">

                            <i class="fa fa-angle-down"></i>

                        </label>

                    </div>


                    <div class="custom-control custom-radio custom-control-inline">

                        <input type="radio"
                            id="sidebaricon-2"
                            name="menu-dropdown-icon"
                            class="custom-control-input"
                            value="icon-style-2">

                        <label class="custom-control-label"
                            for="sidebaricon-2">

                            <i class="ion-plus-round"></i>

                        </label>

                    </div>


                    <div class="custom-control custom-radio custom-control-inline">

                        <input type="radio"
                            id="sidebaricon-3"
                            name="menu-dropdown-icon"
                            class="custom-control-input"
                            value="icon-style-3">

                        <label class="custom-control-label"
                            for="sidebaricon-3">

                            <i class="fa fa-angle-double-right"></i>

                        </label>

                    </div>

                </div>


                <div class="reset-options pt-30 text-center">

                    <button class="btn btn-danger"
                        id="reset-settings">

                        Reset Settings

                    </button>

                </div>

            </div>

        </div>

    </div>


    <!-- =====================================================
         LEFT SIDEBAR
    ====================================================== -->

    <div class="left-side-bar">

        <!-- Logo -->

        <div class="brand-logo">

            <a href="{{ route('admin.home') }}">

                <img
                    src="{{ asset('vendors/images/deskapp-logo.svg') }}"
                    class="dark-logo"
                    alt="Logo">

                <img
                    src="{{ asset('vendors/images/deskapp-logo-white.svg') }}"
                    class="light-logo"
                    alt="Logo">

            </a>


            <div class="close-sidebar"
                data-toggle="left-sidebar-close">

                <i class="ion-close-round"></i>

            </div>

        </div>


        <!-- Navigation -->

        <div class="menu-block customscroll">

            <div class="sidebar-menu">

                <ul id="accordion-menu">


                    <!-- Dashboard -->

                    <li class="{{ request()->routeIs('admin.home') ? 'active' : '' }}">

                        <a href="{{ route('admin.home') }}"
                            class="dropdown-toggle no-arrow">

                            <span class="micon dw dw-house-1"></span>

                            <span class="mtext">
                                Dashboard
                            </span>

                        </a>

                    </li>


                    <!-- Agents -->

                    <li class="{{ request()->routeIs('agents.*') ? 'active' : '' }}">

                        <a href="{{ route('agents.index') }}"
                            class="dropdown-toggle no-arrow">

                            <span class="micon dw dw-group"></span>

                            <span class="mtext">
                                Registered Agents
                            </span>

                        </a>

                    </li>


                    <!-- Properties -->

                    <li class="{{ request()->routeIs('properties.index') ? 'active' : '' }}">

                        <a href="{{ route('properties.index') }}"
                            class="dropdown-toggle no-arrow">

                            <span class="micon dw dw-list"></span>

                            <span class="mtext">
                                Properties
                            </span>

                        </a>

                    </li>


                    <!-- Add Property -->

                    <li class="{{ request()->routeIs('properties.create') ? 'active' : '' }}">

                        <a href="{{ route('properties.create') }}"
                            class="dropdown-toggle no-arrow">

                            <span class="micon dw dw-add"></span>

                            <span class="mtext">
                                Add Property
                            </span>

                        </a>

                    </li>


                    <!-- Notifications -->

                    <li class="{{ request()->routeIs('notification.index') ? 'active' : '' }}">

                        <a href="{{ route('notification.index') }}"
                            class="dropdown-toggle no-arrow">

                            <span class="micon dw dw-notification"></span>

                            <span class="mtext">
                                Notifications
                            </span>

                        </a>

                    </li>


                    <!-- Send Notification -->

                    <li class="{{ request()->routeIs('notification.create') ? 'active' : '' }}">

                        <a href="{{ route('notification.create') }}"
                            class="dropdown-toggle no-arrow">

                            <span class="micon dw dw-message-1"></span>

                            <span class="mtext">
                                Send Notification
                            </span>

                        </a>

                    </li>


                    <!-- Settings -->

                    <li>

                        <a href="{{ route('admin.settings') }}"
                            class="dropdown-toggle no-arrow">

                            <span class="micon dw dw-settings"></span>

                            <span class="mtext">
                                Settings
                            </span>

                        </a>

                    </li>


                    <!-- Profile -->

                    <li class="{{ request()->routeIs('admin.profile') ? 'active' : '' }}">

                        <a href="{{ route('admin.profile') }}"
                            class="dropdown-toggle no-arrow">

                            <span class="micon dw dw-user"></span>

                            <span class="mtext">
                                Profile
                            </span>

                        </a>

                    </li>


                    <!-- Divider -->

                    <li>
                        <div class="dropdown-divider"></div>
                    </li>


                    <li>
                        <div class="sidebar-small-cap">
                            Account
                        </div>
                    </li>


                    <!-- Logout -->

                    <li>

                        <form method="POST"
                            action="{{ route('logout') }}">

                            @csrf

                            <button type="submit"
                                class="dropdown-toggle no-arrow w-100 text-left border-0 bg-transparent"
                                style="color: inherit;">

                                <span class="micon dw dw-logout"></span>

                                <span class="mtext">
                                    Logout
                                </span>

                            </button>

                        </form>

                    </li>

                </ul>

            </div>

        </div>

    </div>


    <!-- Mobile Overlay -->

    <div class="mobile-menu-overlay"></div>


    <!-- =====================================================
         MAIN CONTENT
    ====================================================== -->

    @yield('content')


    <!-- =====================================================
         JAVASCRIPT
    ====================================================== -->

    <script src="{{ asset('vendors/scripts/core.js') }}"></script>
    <script src="{{ asset('vendors/scripts/script.min.js') }}"></script>
    <script src="{{ asset('vendors/scripts/process.js') }}"></script>
    <script src="{{ asset('vendors/scripts/layout-settings.js') }}"></script>


    <!-- DataTables -->

    <script src="{{ asset('src/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>

    <script src="{{ asset('src/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('src/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>

    <script src="{{ asset('src/plugins/datatables/js/responsive.bootstrap4.min.js') }}"></script>


    <!-- DataTables Buttons -->

    <script src="{{ asset('src/plugins/datatables/js/dataTables.buttons.min.js') }}"></script>

    <script src="{{ asset('src/plugins/datatables/js/buttons.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('src/plugins/datatables/js/buttons.print.min.js') }}"></script>

    <script src="{{ asset('src/plugins/datatables/js/buttons.html5.min.js') }}"></script>

    <script src="{{ asset('src/plugins/datatables/js/buttons.flash.min.js') }}"></script>

    <script src="{{ asset('src/plugins/datatables/js/pdfmake.min.js') }}"></script>

    <script src="{{ asset('src/plugins/datatables/js/vfs_fonts.js') }}"></script>


    <script src="{{ asset('vendors/scripts/datatable-setting.js') }}"></script>


    @stack('scripts')

</body>

</html>