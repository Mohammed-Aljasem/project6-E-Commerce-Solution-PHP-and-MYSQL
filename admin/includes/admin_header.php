<?php
session_start();
if(!$_SESSION['admin_id']){
    header('location:sign-in.php');
}else {
  $admin_name =  $_SESSION['admin_name'];
  $admin_email =  $_SESSION['admin_email'];
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    <title>EStore Admin Dashboard</title>

    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500"
          rel="stylesheet"/>
    <link href="https://cdn.materialdesignicons.com/3.0.39/css/materialdesignicons.min.css" rel="stylesheet"/>

    <!-- PLUGINS CSS STYLE -->
    <link href="assets/plugins/toaster/toastr.min.css" rel="stylesheet"/>
    <link href="assets/plugins/nprogress/nprogress.css" rel="stylesheet"/>
    <link href="assets/plugins/flag-icons/css/flag-icon.min.css" rel="stylesheet"/>
    <link href="assets/plugins/jvectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet"/>
    <link href="assets/plugins/ladda/ladda.min.css" rel="stylesheet"/>
    <link href="assets/plugins/select2/css/select2.min.css" rel="stylesheet"/>
    <link href="assets/plugins/daterangepicker/daterangepicker.css" rel="stylesheet"/>

    <!-- SLEEK CSS -->
    <link id="sleek-css" rel="stylesheet" href="assets/css/sleek.css"/>


    <!-- FAVICON -->
    <link href="assets/img/favicon.png" rel="shortcut icon"/>

    <!--
      HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries
    -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="assets/plugins/nprogress/nprogress.js"></script>
</head>


<body class="sidebar-fixed sidebar-dark header-light header-fixed" id="body">
<script>
    NProgress.configure({showSpinner: false});
    NProgress.start();
</script>

<div class="mobile-sticky-body-overlay"></div>

<div class="wrapper">

    <!--
====================================
——— LEFT SIDEBAR WITH FOOTER
=====================================
-->
    <aside class="left-sidebar bg-sidebar">
        <div id="sidebar" class="sidebar sidebar-with-footer">
            <!-- Aplication Brand -->
            <div class="app-brand">
                <a href="manage_admins.php">
                    <svg
                        class="brand-icon"
                        xmlns="http://www.w3.org/2000/svg"
                        preserveAspectRatio="xMidYMid"
                        width="30"
                        height="33"
                        viewBox="0 0 30 33"
                    >
                        <g fill="none" fill-rule="evenodd">
                            <path
                                class="logo-fill-blue"
                                fill="#7DBCFF"
                                d="M0 4v25l8 4V0zM22 4v25l8 4V0z"
                            />
                            <path class="logo-fill-white" fill="#FFF" d="M11 4v25l8 4V0z"/>
                        </g>
                    </svg>
                    <span class="brand-name">EStore</span>
                </a>
            </div>
            <!-- begin sidebar scrollbar -->
            <div class="sidebar-scrollbar">

                <!-- sidebar menu -->
                <ul class="nav sidebar-inner" id="sidebar-menu">
                    <li>
                    <a href="manage_admins.php">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span class="nav-text">Manage Admins</span>
                    </a>
                    </li>

                    <li>
                    <a href="manage_users.php">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span class="nav-text">Manage Users</span>
                    </a>
                    </li>

                    <li>
                        <a href="manage_categories.php">
                            <i class="mdi mdi-view-dashboard-outline"></i>
                            <span class="nav-text">Manage Categories</span>
                        </a>
                    </li>
                    <li>
                        <a href="manage_sub_categories.php">
                            <i class="mdi mdi-view-dashboard-outline"></i>
                            <span class="nav-text">Manage Subcategories</span>
                        </a>
                    </li>
                    <li>
                        <a href="manage_products.php">
                            <i class="mdi mdi-view-dashboard-outline"></i>
                            <span class="nav-text">Manage Products</span>
                        </a>
                    </li>

                    <li>
                        <a href="manage_reviews.php">
                            <i class="mdi mdi-view-dashboard-outline"></i>
                            <span class="nav-text">Manage Reviews</span>
                        </a>
                    </li>



                        </ul>
                    </li>


                </ul>

            </div>

            <hr class="separator"/>


        </div>
    </aside>


    <div class="page-wrapper">
        <!-- Header -->
        <header class="main-header " id="header">
            <nav class="navbar navbar-static-top navbar-expand-lg">
                <!-- Sidebar toggle button -->
                <button id="sidebar-toggler" class="sidebar-toggle">
                    <span class="sr-only">Toggle navigation</span>
                </button>
                <!-- search form -->
                <div class="search-form d-none d-lg-inline-block">
                    <div class="input-group">
                        <button disabled type="button" name="search" id="search-btn" class="btn btn-flat">
                        </button>
                        <input disabled type="text" name="query" id="search-input" class="form-control"
                               placeholder=""
                               autofocus autocomplete="off"/>
                    </div>
                    <div id="search-results-container">
                        <ul id="search-results"></ul>
                    </div>
                </div>

                <div class="navbar-right ">
                    <ul class="nav navbar-nav">
                        <!-- Github Link Button -->


                        <!-- User Account -->
                        <li class="dropdown user-menu">
                            <button href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                                <img src="https://iconarchive.com/download/i91958/icons8/windows-8/Users-Administrator-2.ico" class="user-image" alt="User Image"/>
                                <span class="d-none d-lg-inline-block"><?php echo $admin_name ?></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <!-- User image -->
                                <li class="dropdown-header">
                                    <img src="https://iconarchive.com/download/i91958/icons8/windows-8/Users-Administrator-2.ico" class="img-circle" alt="User Image"/>
                                    <div class="d-inline-block">
                                        <?php echo $admin_name ?> <small class="pt-1"><?php echo $admin_email ?></small>
                                    </div>
                                </li>
                                <li class="dropdown-footer">
                                    <a href="sign-out.php"> <i class="mdi mdi-logout"></i> Log Out </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>


        </header>