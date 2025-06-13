<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?? 'Student Management System' ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/adminlte.min.css">
    <!-- DataTables -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <!-- Datepicker -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <!-- Dark Theme CSS -->
    <style>
    :root {
        --primary-dark: #0f172a;
        --secondary-dark: #1e293b;
        --accent-color: #7c3aed;
        --text-light: #f8fafc;
        --text-muted: #94a3b8;
    }

    body {
        background: linear-gradient(135deg, var(--primary-dark) 0%, var(--secondary-dark) 100%) !important;
        color: var(--text-light) !important;
    }

    .main-header.navbar {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%) !important;
        border-bottom: none !important;
    }

    .main-sidebar {
        background: var(--primary-dark) !important;
        border-right: 1px solid rgba(255, 255, 255, 0.1) !important;
    }

    .brand-link {
        border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
        background: rgba(0, 0, 0, 0.2) !important;
    }

    .nav-sidebar .nav-item>.nav-link {
        margin-bottom: 2px;
        color: var(--text-muted);
    }

    .nav-sidebar .nav-item>.nav-link:hover {
        background: rgba(255, 255, 255, 0.05);
    }

    .nav-sidebar .nav-item>.nav-link.active {
        background: linear-gradient(135deg, #4776E6 0%, #8E54E9 100%) !important;
        color: white !important;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .content-wrapper {
        background: transparent !important;
    }

    .card {
        background: var(--secondary-dark) !important;
        border: none !important;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1) !important;
        border-radius: 0.5rem !important;
        color: var(--text-light) !important;
    }

    .card-header {
        border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
        background: rgba(0, 0, 0, 0.2) !important;
    }

    .table {
        color: var(--text-light) !important;
    }

    .table-bordered {
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
    }

    .table-bordered th,
    .table-bordered td {
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
    }

    .form-control {
        background-color: rgba(0, 0, 0, 0.2) !important;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        color: var(--text-light) !important;
    }

    .form-control:focus {
        background-color: rgba(0, 0, 0, 0.3) !important;
        border-color: var(--accent-color) !important;
        box-shadow: 0 0 0 0.2rem rgba(124, 58, 237, 0.25) !important;
    }

    .dropdown-menu {
        background: var(--secondary-dark) !important;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
    }

    .dropdown-item {
        color: var(--text-light) !important;
    }

    .dropdown-item:hover {
        background: rgba(255, 255, 255, 0.1) !important;
    }

    .breadcrumb {
        background: transparent !important;
    }

    /* Custom scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }

    ::-webkit-scrollbar-track {
        background: var(--primary-dark);
    }

    ::-webkit-scrollbar-thumb {
        background: var(--accent-color);
        border-radius: 4px;
    }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed dark-mode">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"
                            style="color: rgba(255, 255, 255, 0.47); transition: color 0.2s;"
                            onmouseover="this.style.color='rgb(255, 255, 255)'"
                            onmouseout="this.style.color='rgba(255, 255, 255, 0.46)'">
                        </i></a>
                </li>
                <li class=" nav-item d-none d-sm-inline-block">
                    <a href="<?= site_url('/') ?>" class="nav-link"
                        style="color: rgba(255, 255, 255, 0.47); transition: color 0.2s;"
                        onmouseover="this.style.color='rgb(255, 255, 255)'"
                        onmouseout="this.style.color='rgba(255, 255, 255, 0.46)'">Home</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#"
                        style="color: rgba(255, 255, 255, 0.47); transition: color 0.2s;"
                        onmouseover="this.style.color='rgb(255, 255, 255)'"
                        onmouseout="this.style.color='rgba(255, 255, 255, 0.46'">
                        <i class="far fa-user" style="color: rgba(255, 255, 255, 0.47); transition: color 0.2s;"
                            onmouseover="this.style.color='rgb(255, 255, 255)'"
                            onmouseout="this.style.color='rgba(255, 255, 255, 0.46'">
                        </i>
                        <?= session()->get('username')  ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-user mr-2"></i> Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="<?= site_url('logout') ?>" class="dropdown-item">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="<?= site_url('/') ?>" class="brand-link">
                <span class="brand-text font-weight-light">Student Management</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="<?= site_url('/') ?>" class="nav-link <?= uri_string() == '' ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url('students') ?>"
                                class="nav-link <?= uri_string() == 'students' ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Students</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url('courses') ?>"
                                class="nav-link <?= uri_string() == 'courses' ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-book"></i>
                                <p>Courses</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url('grades') ?>"
                                class="nav-link <?= uri_string() == 'grades' ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-graduation-cap"></i>
                                <p>Grades</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url('attendance') ?>"
                                class="nav-link <?= uri_string() == 'attendance' ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-calendar-check"></i>
                                <p>Attendance</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>