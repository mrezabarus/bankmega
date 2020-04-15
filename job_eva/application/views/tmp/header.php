<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Responsive Admin Dashboard Template">
        <meta name="keywords" content="admin,dashboard">
        <meta name="author" content="stacks">
        <!-- Remove Tap Highlight on Windows Phone IE -->
        <meta name="msapplication-tap-highlight" content="no"/>
        <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        
        <!-- Title -->
        <title>JOB KUESIONER V1</title>

        <!-- Styles -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap" rel="stylesheet">
        <!-- <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet"> -->
        <link href="<?php echo base_url();?>template/assets/css/material-icons.css" rel="stylesheet">
        <link href="<?php echo base_url();?>template/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url();?>template/assets/plugins/font-awesome/css/all.min.css" rel="stylesheet">
        <link href="<?php echo base_url();?>template/assets/plugins/waves/waves.min.css" rel="stylesheet">
        <link href="<?php echo base_url();?>template/assets/plugins/nvd3/nv.d3.min.css" rel="stylesheet">

      
        <!-- Theme Styles -->
        <link href="<?php echo base_url();?>template/assets/css/alpha.min.css" rel="stylesheet">
        <link href="<?php echo base_url();?>template/assets/css/custom.css" rel="stylesheet">

        <!-- Javascripts -->
        <script src="<?php echo base_url();?>template/assets/plugins/jquery/jquery-3.4.1.min.js"></script>
        <script src="<?php echo base_url();?>template/assets/plugins/bootstrap/popper.min.js"></script>
        <script src="<?php echo base_url();?>template/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>template/assets/plugins/waves/waves.min.js"></script>
        <script src="<?php echo base_url();?>template/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <script src="<?php echo base_url();?>template/assets/plugins/d3/d3.min.js"></script>
        <script src="<?php echo base_url();?>template/assets/plugins/nvd3/nv.d3.min.js"></script>
        <script src="<?php echo base_url();?>template/assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>
        <script src="<?php echo base_url();?>template/assets/plugins/apexcharts/dist/apexcharts.min.js"></script>
        <script src="<?php echo base_url();?>template/assets/plugins/flot/jquery.flot.min.js"></script>
        <script src="<?php echo base_url();?>template/assets/plugins/flot/jquery.flot.time.min.js"></script>
        <script src="<?php echo base_url();?>template/assets/plugins/flot/jquery.flot.symbol.min.js"></script>
        <script src="<?php echo base_url();?>template/assets/plugins/flot/jquery.flot.resize.min.js"></script>
        <script src="<?php echo base_url();?>template/assets/plugins/flot/jquery.flot.tooltip.min.js"></script>
        <script src="<?php echo base_url();?>template/assets/js/alpha.min.js"></script>
        <script src="<?php echo base_url();?>template/assets/js/pages/dashboard.js"></script>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="loader">
            <div class="spinner-border text-primary" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <div class="alpha-app">
            <div class="page-header">
                <nav class="navbar navbar-expand primary">
                    <section class="material-design-hamburger navigation-toggle">
                        <a href="javascript:void(0)" data-activates="slide-out" class="button-collapse material-design-hamburger__icon">
                            <span class="material-design-hamburger__layer"></span>
                        </a>
                    </section>
                    <a class="navbar-brand" href="#">Job Kuesioner</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    
                </nav>
            </div><!-- Page Header -->
            <div class="search-results">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="search-results-header">
                                <h4>Quick Search Results</h4>
                                <a href="#" id="closeSearch"><i class="material-icons">close</i></a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <ul class="search-result-list user-search">
                                <li>
                                    <img src="<?php echo base_url();?>template/assets/images/avatars/avatar2.png" alt="">
                                    <p>Tom Manchester<br>(Works at <span class="search-input-value"></span>)</p>
                                </li>
                                <li>
                                    <img src="<?php echo base_url();?>template/assets/images/avatars/avatar1.png" alt="">
                                    <p>Luke Williams<br>(Lives in <span class="search-input-value"></span>)</p>
                                </li>
                                <li>
                                    <img src="<?php echo base_url();?>template/assets/images/avatars/avatar4.jpg" alt="">
                                    <p>People near:<br><span class="search-input-value"></span></p>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <ul class="search-result-list social-search">
                                <li>
                                    <div class="social-search-icon facebook-icon-bg">
                                        <i class="fab fa-facebook-f"></i>
                                    </div>
                                    <div class="social-search-text">
                                        <p><span class="search-input-value"></span> on Facebook</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="social-search-icon twitter-icon-bg">
                                        <i class="fab fa-twitter"></i>
                                    </div>
                                    <div class="social-search-text">
                                        <p><span class="search-input-value"></span> on Twitter</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="social-search-icon google-icon-bg">
                                        <i class="fab fa-google-plus-g"></i>
                                    </div>
                                    <div class="social-search-text">
                                        <p><span class="search-input-value"></span> on Google+</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <ul class="search-result-list article-search">
                                <li>
                                    <p>Lorem ipsum dolor sit amet, consectetur <span class="search-input-value"></span> adipiscing elit, sunt in culpa quifdaasd quis.</p>
                                    <span class="search-article-date">06 Dec, 2018</span>
                                </li>
                                <li>
                                    <p>Duis non semper sapien. Morbi imperdiet velit in <span class="search-input-value"></span> bibendum lobortis. Integer arcu urna, elementum in pellentesque nec, finibus at nisi.</p>
                                    <span class="search-article-date">19 Nov, 2017</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div><!-- Quick Search Results -->
                 
            
        