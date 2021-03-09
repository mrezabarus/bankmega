<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

        <title>Jobdesc App</title>

        <!-- Bootstrap core CSS -->
        <link href="<?php echo base_url();?>assets/bootstrap-4.2/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

        <!-- font awesome -->
        <link href="<?php echo base_url();?>assets/fontawesome/css/all.css" rel="stylesheet"> <!--load all styles -->

        <!-- Custom styles for this template -->
        <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">

        <!-- Chart.js -->
        <link href="<?php echo base_url();?>assets/Chart.js/dist/Chart.min.css" rel="stylesheet">

        <!-- Jquery Data Tables -->
        <link href="<?php echo base_url();?>assets/css/jquery.dataTables.min.css" rel="stylesheet">

        <!-- font -->
        <link href="<?php echo base_url();?>assets/css/font.css" rel="stylesheet">

        <style type="text/css">
            .preloader {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: 9999;
                
            }
            .preloader .loading {
                position: absolute;
                left: 50%;
                top: 50%;
                transform: translate(-50%,-50%);
                font: 14px arial;
            }
        </style>
    </head>

    <body>

        <div class="preloader">
            <div class="loading">
                <img src="<?php echo base_url();?>assets/images/loading1.gif" width="180">
            </div>
        </div>

        <?php 
            $url_top = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']; 
            $url_val = substr($url_top, strrpos($url_top, '/') + 1);
            
        ?>

        
        <nav class="navbar navbar-expand-md navbar-custom fixed-top">
            <a class="navbar-brand" href="#"><i class="fas fa-briefcase">&nbsp;</i>Jobdesc</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                
                    <?php foreach($menu as $e): ?>
                    <?php

                    $url_db     = $e->menu_href;
                    $url_val2   = substr($url_db, strrpos($url_db, '/') + 1);

                    $url_db_par = $e->menu_parent;

                    if(strtolower($menuparent)==strtolower($url_db_par)){
                        $active = "active";
                    }
                    else{
                        $active = "";
                    }
                    ?>

                    <li class="nav-item <?php echo $active;?>">
                        <a class="nav-link" href="<?php echo base_url();?><?php echo $e->menu_href;?>"><?php echo $e->menu_name;?> <span class="sr-only"></span></a>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url();?>index.php/verifylogin/logout"><i class="fas fa-user">&nbsp;</i>Logout</a>
                    </li>
                </ul>
                <!-- <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">User</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown03">
                        <a class="dropdown-item" href="#">Logout</a>
                        </div>
                    </li>
                </ul> -->
            </div>
        </nav>