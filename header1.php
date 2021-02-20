<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Hệ thống</title>


    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/nprogress.css" rel="stylesheet">
    <link href="css/custom.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <style>
        th {
            text-align: center;
        }
        .news__title {
            overflow: hidden;
            width: 150px;
            box-sizing: border-box;

        }
    </style>
</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="#" class="site_title"><i class="fa fa-book"></i> <span>Quản lý bán hàng</span></a>
                </div>

                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                <div class="profile clearfix">
                    <div class="profile_pic">
                        <img src="images/img.jpg" alt="..." class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                        <span>Xin chào,
                            <?php
                                echo $_SESSION["username"];
                            ?>
                        </span>

                        <h2></h2>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <!-- /menu profile quick info -->

                <br/>

                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <h3>Menu</h3>
                        <ul class="nav side-menu">
                            <li><a href="show_shipper.php"><i class="fa fa-user" aria-hidden="true"></i> Thông tin shipper <span class="fa fa-chevron-down"></span></a>

                            </li>
                            <li><a href="show_product.php"><i class="fa fa-table"></i> Quản lý sản phẩm <span class="fa fa-chevron-down"></span></a>
                            </li>
                            <li><a href="show_category.php"><i class="fa fa-tags"></i> Quản lý danh mục <span
                                    class="fa fa-chevron-down"></span></a>
                            </li>
                            <li><a href="show_news.php"><i class="fa fa-newspaper-o" aria-hidden="true"></i> Quản lý tin tức <span
                                    class="fa fa-chevron-down"></span></a>
                            </li>
                            <li><a href="show_newscategory.php"><i class="fa fa-tags"></i> Quản lý danh mục tin tức<span
                                    class="fa fa-chevron-down"></span></a>
                            </li>
                            <li><a href="show_order.php"><i class="fa fa-shopping-cart"></i> Quản lý đơn hàng <span
                                    class="fa fa-chevron-down"></span></a>
                            </li>
                            <li><a href="show_statical.php"><i class="fa fa-bar-chart-o"></i>Thống kê<span
                                    class="fa fa-chevron-down"></span></a>

                            </li>

                        </ul>
                    </div>


                </div>

            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="">
                            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown"
                               aria-expanded="false">
                                <img src="images/img.jpg" alt=""><?php
                                echo $_SESSION["username"];
                            ?>
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">
                                <li><a href="logout.php"><i class="fa fa-sign-out pull-right"></i> Thoát</a></li>
                            </ul>
                        </li>


                    </ul>
                </nav>
            </div>
        </div>
        <!-- /top navigation -->
