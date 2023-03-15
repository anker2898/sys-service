<!doctype html>
<html lang="es" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo constant("SYS") ?></title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo constant("URL") ?>/assets/images/favicon.ico" />

    <!-- Library / Plugin Css Build -->
    <link rel="stylesheet" href="<?php echo constant("URL") ?>/assets/css/core/libs.min.css" />

    <!-- Aos Animation Css -->
    <link rel="stylesheet" href="<?php echo constant("URL") ?>/assets/vendor/aos/dist/aos.css" />

    <!-- Hope Ui Design System Css -->
    <link rel="stylesheet" href="<?php echo constant("URL") ?>/assets/css/hope-ui.min.css?v=2.0.0" />

    <!-- Custom Css -->
    <link rel="stylesheet" href="<?php echo constant("URL") ?>/assets/css/custom.min.css?v=2.0.0" />

    <!-- Dark Css -->
    <link rel="stylesheet" href="<?php echo constant("URL") ?>/assets/css/dark.min.css" />

    <!-- Customizer Css -->
    <link rel="stylesheet" href="<?php echo constant("URL") ?>/assets/css/customizer.min.css" />

    <!-- RTL Css -->
    <link rel="stylesheet" href="<?php echo constant("URL") ?>/assets/css/rtl.min.css" />


</head>

<body class="  ">
    <!-- loader Start -->
    <div id="loading">
        <div class="loader simple-loader">
            <div class="loader-body"></div>
        </div>
    </div>
    <!-- loader END -->

    <aside class="sidebar sidebar-default sidebar-white sidebar-base navs-rounded-all ">
        <div class="sidebar-header d-flex align-items-center justify-content-start">
            <a href="<?php echo constant("URL") ?>" class="navbar-brand">

                <!--Logo start-->
                <div class="logo-main">
                    <div class="logo-normal">
                        <svg class=" icon-30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2" transform="rotate(-45 -0.757324 19.2427)" fill="currentColor" />
                            <rect x="7.72803" y="27.728" width="28" height="4" rx="2" transform="rotate(-45 7.72803 27.728)" fill="currentColor" />
                            <rect x="10.5366" y="16.3945" width="16" height="4" rx="2" transform="rotate(45 10.5366 16.3945)" fill="currentColor" />
                            <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2" transform="rotate(45 10.5562 -0.556152)" fill="currentColor" />
                        </svg>
                    </div>
                    <div class="logo-mini">
                        <svg class=" icon-30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2" transform="rotate(-45 -0.757324 19.2427)" fill="currentColor" />
                            <rect x="7.72803" y="27.728" width="28" height="4" rx="2" transform="rotate(-45 7.72803 27.728)" fill="currentColor" />
                            <rect x="10.5366" y="16.3945" width="16" height="4" rx="2" transform="rotate(45 10.5366 16.3945)" fill="currentColor" />
                            <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2" transform="rotate(45 10.5562 -0.556152)" fill="currentColor" />
                        </svg>
                    </div>
                </div>
                <!--logo End-->

                <h4 class="logo-title"><?php echo constant("SYS-SHORT") ?></h4>
            </a>
            <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
                <i class="icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4.25 12.2744L19.25 12.2744" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M10.2998 18.2988L4.2498 12.2748L10.2998 6.24976" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </i>
            </div>
        </div>
        <div class="sidebar-body pt-0 data-scrollbar">
            <div class="sidebar-list">
                <!-- Sidebar Menu Start -->
                <ul class="navbar-nav iq-main-menu" id="sidebar-menu">
                    <li class="nav-item static-item">
                        <a class="nav-link static-item disabled" href="#" tabindex="-1">
                            <span class="default-icon">Menu</span>
                            <span class="mini-icon">-</span>
                        </a>
                    </li>
                    <?php $links = $_SESSION['user']['PRIVILEGIOS']; ?>
                    <?php foreach ($links as $link) { ?>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="<?php echo constant("URL") . $link['path'] ?>">
                                <i class="icon">
                                    <?php echo $link['icon'] ?>
                                </i>
                                <span class="item-name"><?php echo $link['label'] ?></span>
                            </a>
                        </li>
                    <?php } ?>
                    <li>
                        <hr class="hr-horizontal">
                    </li>
                </ul>
                <!-- Sidebar Menu End -->
            </div>
        </div>
        <div class="sidebar-footer"></div>
    </aside>
    <main class="main-content">
        <div class="position-relative iq-banner">
            <!--Nav Start-->
            <nav class="nav navbar navbar-expand-lg navbar-light iq-navbar">
                <div class="container-fluid navbar-inner">
                    <a href="<?php echo constant("URL") ?>" class="navbar-brand">
                        <!--Logo start-->
                        <div class="logo-main">
                            <div class="logo-normal">
                                <svg class="text-primary icon-30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2" transform="rotate(-45 -0.757324 19.2427)" fill="currentColor" />
                                    <rect x="7.72803" y="27.728" width="28" height="4" rx="2" transform="rotate(-45 7.72803 27.728)" fill="currentColor" />
                                    <rect x="10.5366" y="16.3945" width="16" height="4" rx="2" transform="rotate(45 10.5366 16.3945)" fill="currentColor" />
                                    <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2" transform="rotate(45 10.5562 -0.556152)" fill="currentColor" />
                                </svg>
                            </div>
                            <div class="logo-mini">
                                <svg class="text-primary icon-30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2" transform="rotate(-45 -0.757324 19.2427)" fill="currentColor" />
                                    <rect x="7.72803" y="27.728" width="28" height="4" rx="2" transform="rotate(-45 7.72803 27.728)" fill="currentColor" />
                                    <rect x="10.5366" y="16.3945" width="16" height="4" rx="2" transform="rotate(45 10.5366 16.3945)" fill="currentColor" />
                                    <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2" transform="rotate(45 10.5562 -0.556152)" fill="currentColor" />
                                </svg>
                            </div>
                        </div>
                        <!--logo End-->

                        <h4 class="logo-title"><?php echo constant("SYS-SHORT") ?></h4>
                    </a>
                    <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
                        <i class="icon">
                            <svg width="20px" class="icon-20" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z" />
                            </svg>
                        </i>
                    </div>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon">
                            <span class="mt-2 navbar-toggler-bar bar1"></span>
                            <span class="navbar-toggler-bar bar2"></span>
                            <span class="navbar-toggler-bar bar3"></span>
                        </span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="mb-2 navbar-nav ms-auto align-items-center navbar-list mb-lg-0">
                            <li class="nav-item dropdown">
                                <a class="py-0 nav-link d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="<?php echo constant("URL") ?>/assets/images/avatars/01.png" alt="User-Profile" class="theme-color-default-img img-fluid avatar avatar-50 avatar-rounded">
                                    <img src="<?php echo constant("URL") ?>/assets/images/avatars/avtar_1.png" alt="User-Profile" class="theme-color-purple-img img-fluid avatar avatar-50 avatar-rounded">
                                    <img src="<?php echo constant("URL") ?>/assets/images/avatars/avtar_2.png" alt="User-Profile" class="theme-color-blue-img img-fluid avatar avatar-50 avatar-rounded">
                                    <img src="<?php echo constant("URL") ?>/assets/images/avatars/avtar_4.png" alt="User-Profile" class="theme-color-green-img img-fluid avatar avatar-50 avatar-rounded">
                                    <img src="<?php echo constant("URL") ?>/assets/images/avatars/avtar_5.png" alt="User-Profile" class="theme-color-yellow-img img-fluid avatar avatar-50 avatar-rounded">
                                    <img src="<?php echo constant("URL") ?>/assets/images/avatars/avtar_3.png" alt="User-Profile" class="theme-color-pink-img img-fluid avatar avatar-50 avatar-rounded">
                                    <div class="caption ms-3 d-none d-md-block ">
                                        <h6 class="mb-0 caption-title"><?php echo $_SESSION['user']['NOMBRES'] ?></h6>
                                        <p class="mb-0 caption-sub-title">Usuario de <?php echo constant("SYS-SHORT") ?></p>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="<?php echo constant("URL") ?>/login/close">Cerrar sesi&oacute;n</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav> <!-- Nav Header Component Start -->
            <!--Nav End-->
            <div class="iq-navbar-header" style="height: 215px;">
                <div class="container-fluid iq-container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="flex-wrap d-flex justify-content-between align-items-center">
                                <div>
                                    <h1><?php echo $this->title ?></h1>
                                    <p><?php echo $this->subtitle ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="iq-header-img">
                    <img src="<?php echo constant("URL") ?>/assets/images/dashboard/top-header.png" alt="header" class="theme-color-default-img img-fluid w-100 h-100 animated-scaleX">
                    <img src="<?php echo constant("URL") ?>/assets/images/dashboard/top-header1.png" alt="header" class="theme-color-purple-img img-fluid w-100 h-100 animated-scaleX">
                    <img src="<?php echo constant("URL") ?>/assets/images/dashboard/top-header2.png" alt="header" class="theme-color-blue-img img-fluid w-100 h-100 animated-scaleX">
                    <img src="<?php echo constant("URL") ?>/assets/images/dashboard/top-header3.png" alt="header" class="theme-color-green-img img-fluid w-100 h-100 animated-scaleX">
                    <img src="<?php echo constant("URL") ?>/assets/images/dashboard/top-header4.png" alt="header" class="theme-color-yellow-img img-fluid w-100 h-100 animated-scaleX">
                    <img src="<?php echo constant("URL") ?>/assets/images/dashboard/top-header5.png" alt="header" class="theme-color-pink-img img-fluid w-100 h-100 animated-scaleX">
                </div>
            </div>
        </div>
        <div class="conatiner-fluid content-inner mt-n5 py-0">