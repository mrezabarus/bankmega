<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Eknowledge HRMS dengan kerangka ramping, intuitif, dan kuat front-end untuk pengembangan web lebih cepat dan lebih mudah.">
	<meta name="keywords" content="HTML, CSS, JS, JavaScript, framework, bootstrap, Eknowledge development">
    <meta name="author" content="Jack, Amil and HCMG contributors">

	<!-- Favicons -->
	<link rel="icon" href="<?php echo base_url(); ?>assets/images/favicon.png">

    <title><?php echo $title; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>assets/bootstrap_3.1.1/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>assets/offcanvas/offcanvas.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/offcanvas/jack_rev2.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/jack/css/jackk_style_home.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/jack/css/sticky-footer-navbar.css" rel="stylesheet">
	
	<!--[if IE]>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/offcanvas/all-ie-only.css" />
	<![endif]-->
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="<?php echo base_url(); ?>assets/offcanvas/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="<?php echo base_url(); ?>assets/offcanvas/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="<?php echo base_url(); ?>assets/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <nav class="navbar navbar-static-top navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo base_url(); ?>">Eknowledge Library</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <?php 
			$this->load->view('navbar_sigin_ok');	
		  ?>
        </div><!-- /.nav-collapse -->
      </div><!-- /.container -->
    </nav><!-- /.navbar -->

    <!-- Main jumbotron for a primary marketing message or call to action -->
	<div class="sambutan">
	  <div class="container">
		</br>
		<h1 class="nama"><?php echo $title; ?></h1>
		</br>
		</br>
	  </div>
	</div>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
		<h4>Personal info</h4>
		<br>
		
        <div class="col-xs-12">
		
			<div class="row">
			  <div class="col-sm-1"></div>
			  <div class="col-sm-4">NIP</div>
			  <div class="col-sm-6"><?php echo $row->ID_USER; ?></div>
			  <br>
			  <hr>
			</div>
			
			<div class="row">
			  <div class="col-sm-1"></div>
			  <div class="col-sm-4">Nama</div>
			  <div class="col-sm-6"><?php echo ucwords(strtolower($row->USER_NAME)); ?></div>
			  <br>
			  <hr>
			</div>
			
			<div class="row">
			  <div class="col-sm-1"></div>
			  <div class="col-sm-4">Gender</div>
			  <div class="col-sm-6"><?php echo $row->GENDER; ?></div>
			  <br>
			  <hr>
			</div>
			
			<div class="row">
			  <div class="col-sm-1"></div>
			  <div class="col-sm-4">Job title</div>
			  <div class="col-sm-6"><?php echo $row->jobtitle; ?></div>
			  <br>
			  <hr>
			</div>
			
			<div class="row">
			  <div class="col-sm-1"></div>
			  <div class="col-sm-4">Phone</div>
			  <div class="col-sm-6"><?php echo $row->mblphone; ?></div>
			  <br>
			  <hr>
			</div>
			
			<div class="row">
			  <div class="col-sm-1"></div>
			  <div class="col-sm-4">Email</div>
			  <div class="col-sm-6"><?php echo $row->email; ?></div>
			  <br>
			  <hr>
			</div>
			
			<div class="row">
			  <div class="col-sm-1"></div>
			  <div class="col-sm-4">Organization</div>
			  <div class="col-sm-6"><?php echo $row->org_group_name .' ('. $row->org_group_code .')'; ?></div>
			  <br>
			  <hr>
			</div>
			
			<div class="row">
			  <div class="col-sm-1"></div>
			  <div class="col-sm-4">Region</div>
			  <div class="col-sm-6"><?php echo $row->org_region_name; ?></div>
			  <br>
			  <hr>
			</div>
			
			<div class="row">
			  <div class="col-sm-1"></div>
			  <div class="col-sm-4">Job location</div>
			  <div class="col-sm-6"><?php echo $row->job_location; ?></div>
			  <br>
			  <hr>
			</div>
			
			<div class="row">
			  <div class="col-sm-1"></div>
			  <div class="col-sm-4">Start</div>
			  <div class="col-sm-6"><?php echo $start_dmy2['hari'] . ', ' . $start_dmy2['tgl'] . ' ' . $start_dmy2['bulan'] . ' ' . $start_dmy2['tahun'] ; ?></div>
			  <br>
			  <hr>
			</div>

        </div>			
      </div>
	  
      <div class="row">		
		<h4>Recent activity</h4>
		<br>
		<div class="col-xs-12">
		
			<div class="row">
			  <div class="col-sm-1"></div>
			  <div class="col-sm-4">Last Sign-in</div>
			  <div class="col-sm-6"></div>
			  <br>
			  <hr>
			</div>
			
		</div>
      </div>


    </div> <!-- /container -->
		<br>
		<br>
		<br>

	<?php 
		$this->load->view('footer');	  
	?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url(); ?>assets/jquery/1.9.1/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/bootstrap_3.1.1/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/placeholders/placeholders.js"></script>
  

</body></html>