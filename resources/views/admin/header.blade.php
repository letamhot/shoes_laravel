<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>
    <base href="{{ asset('') }}">

    <!-- add icon link -->
    <link rel="icon" href="image\asics.png" type="image/x-icon">

    <!-- Custom fonts for this template-->
    <link href="css/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="css/back-to-top.css" rel="stylesheet" type="text/css">

    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

    <!-- Custom styles for this template-->
    <link href="sb-admin-2/css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        #button::after {
            content: "";
        }
    </style>
    {{-- @stack('select2css') --}}
    @stack('select2-css')

    <!-- Font Awesome-->
    {{-- <link rel="stylesheet" href="source/assets/dest/css/font-awesome.min.css"> --}}
    <script src="js/ckeditor.js"></script>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>

                {{-- <img src="data:image;base64,{{Auth::user()->image}} " width="60px" height="60px"> --}}
                <div class="sidebar-brand-text mx-3">Chào,
                    {{ Auth::user()->name }}<sup></sup>
                </div>
            </a>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                List to data
            </div>

            <!-- Nav Item - Users -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('users.index') }}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Users</span></a>
            </li>


            <li class="nav-item">
                <a class="nav-link" href="{{ route('customer.index') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Customer</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('posts.index') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Post</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('type.index') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Type</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('product.index') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Product</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('producer.index') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Producer</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('bills.index') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Bills</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <a id="button"><i class="fas fa-arrow-up"></i>
            </a>