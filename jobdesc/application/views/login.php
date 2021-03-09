<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="generator" content="">
        <title>Signin</title>

        <!-- Bootstrap core CSS -->
        <link href="<?php echo base_url();?>assets/bootstrap-4.2/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">


        <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
            font-size: 3.5rem;
            }
        }
        </style>
        <!-- Custom styles for this template -->
        <link href="<?php echo base_url();?>assets/css/signinstyle.css" rel="stylesheet">

        <!-- font -->
        <link href="<?php echo base_url();?>assets/css/font.css" rel="stylesheet">
    </head>
    

    <body>
        <div class="container">
            <div class="row">
                <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                
                    <div class="card card-signin my-5">
                        <div class="card-body">
                            
                            <img class="mx-auto d-block" src="<?php echo base_url();?>assets/images/logo_mega.png" alt="" width="150">
                            <hr/ style="background-color:#B9DFFE;">
                            <h5 class="card-title text-center">Jobdesc Apps</h5>
                            <form class="form-signin" action="<?php echo site_url();?>/verifylogin/" method="post">
                            <div class="form-label-group">
                                <input type="text" name="username"  id="inputEmail" class="form-control" placeholder="Nip" required autofocus>
                                <label for="inputEmail"></label>
                            </div>

                            <div class="form-label-group">
                                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
                                <label for="inputPassword"></label>
                            </div>

                            
                            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Sign in</button>
                            
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </body>
</html>
