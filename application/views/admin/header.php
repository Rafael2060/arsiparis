<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>SIMSTAHTI</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="<?php echo base_url('assets/img/favicon.png') ?>" rel="icon">
    <link href="<?php echo base_url('assets/img/apple-touch-icon.png') ?>" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/vendor/bootstrap-icons/bootstrap-icons.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/vendor/boxicons/css/boxicons.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/vendor/quill/quill.snow.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/vendor/quill/quill.bubble.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/vendor/remixicon/remixicon.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/vendor/simple-datatables/style.css') ?>" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?php echo base_url('assets/css/style.css') ?>" rel="stylesheet">

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 7 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>



    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo d-flex align-items-center">
                <img src="<?php echo base_url('assets/img/logo.png') ?>" alt="">
                <span class="d-none d-lg-block">SIMSTAHTI</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <div class="search-bar">
            <form class="search-form d-flex align-items-center" method="POST" action="#">
                <input type="text" name="query" placeholder="Search" title="Enter search keyword">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
            </form>
        </div><!-- End Search Bar -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li><!-- End Search Icon-->


                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="<?php echo base_url('assets/img/profile-img.jpg') ?>" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $this->session->userdata('username'); ?></span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6><?php echo $this->session->userdata('name') ?></h6>
                            <span><?php echo $this->session->userdata('role') ?></span>

                        </li>


                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="<?php echo base_url('User/show/') . $this->session->userdata('id') ?>">
                                <i class="bi bi-person"></i>
                                <span>Profile</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="<?php echo base_url('User/editPassword/') . $this->session->userdata('id') ?>">
                                <i class="bi bi-person"></i>
                                <span>Password</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <!-- <li>
                            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                                <i class="bi bi-gear"></i>
                                <span>Account Settings</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                                <i class="bi bi-question-circle"></i>
                                <span>Need Help?</span>
                            </a>
                        </li> -->
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="<?php echo base_url('Auth/logout'); ?>">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link " href="<?= base_url('Admin') ?>">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <?php if ($this->session->userdata('role_id') <> '1') : ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#surat-nav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-menu-button-wide"></i><span>Surat</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="surat-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="<?= base_url('SuratMasuk'); ?>">
                                <i class="bi bi-circle"></i><span>Surat Masuk</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('SuratKeluar'); ?>">
                                <i class="bi bi-circle"></i><span>Surat Keluar</span>
                            </a>
                        </li>

                        <li>

                            <a class="nav-link collapsed" data-bs-target="#surat-nav1" data-bs-toggle="collapse" href="#">
                                <i style="font-size:14px" class="bi bi-menu-button-wide"></i><span>Template</span><i class="bi bi-chevron-down ms-auto"></i>
                            </a>

                            <div style="margin-left:20px !important">
                                <ul id="surat-nav1" class="nav-content collapse " data-bs-parent="#surat-nav">

                                    <li>
                                        <a href="<?= base_url('SuratPerintah'); ?>">
                                            <i class="bi bi-circle"></i><span>Surat Perintah</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url('SuratNotaDinas'); ?>">
                                            <i class="bi bi-circle"></i><span>Surat Nota Dinas</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url('SuratPengantar'); ?>">
                                            <i class="bi bi-circle"></i><span>Surat Pengantar</span>
                                        </a>
                                    </li>
                                </ul>

                            </div>
                        </li>


                    </ul>

                    <a class="nav-link collapsed" href="<?= base_url('JenisSurat'); ?>">
                        <i class="bi bi-menu-button-wide"></i><span>Jenis Surat</span><i class=""></i>
                    </a>
                </li><!-- End Components Nav -->


                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#tahanan-nav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-journal-text"></i><span>Tahanan</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="tahanan-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="<?= base_url('Tahanan'); ?>">
                                <i class="bi bi-circle"></i><span>Tahanan</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('KategoriTahanan'); ?>">
                                <i class="bi bi-circle"></i><span>Kategori Tahanan</span>
                            </a>
                        </li>

                    </ul>
                </li><!-- End Forms Nav -->

            <?php else : ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="<?php echo base_url('User'); ?>">
                        <i class="bi bi-person"></i>
                        <span>User</span>
                    </a>
                </li><!-- End Profile Page Nav -->
            <?php endif; ?>


            <!-- <li class="nav-heading">Pages</li> -->

            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="<?php echo base_url('User'); ?>">
                    <i class="bi bi-person"></i>
                    <span>User</span>
                </a>
            </li> -->

            <!-- End Profile Page Nav -->

        </ul>

    </aside><!-- End Sidebar-->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('Admin') ?>">Home</a></li>
                    <li class="breadcrumb-item active"><?= $title ?></li>
                </ol>
            </nav>

            <?php if ($this->session->flashdata('message')) : ?>
                <div class="d-flex justify-content-center pb-0">
                    <!-- <div class="alert alert-primary alert-dismissible fade show" role="alert"> -->
                    <?php echo $this->session->flashdata('message'); ?>
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> -->
                    <!-- </div> -->
                </div>
            <?php endif; ?>

        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">






                        <!-- Reports -->
                        <div class="col-12">
                            <div class="card">

                                <div class="filter">
                                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">
                                            <h6>Filter</h6>
                                        </li>

                                        <li><a class="dropdown-item" href="#">Today</a></li>
                                        <li><a class="dropdown-item" href="#">This Month</a></li>
                                        <li><a class="dropdown-item" href="#">This Year</a></li>
                                    </ul>
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $title; ?></h5>