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
		<p class="about1"><span class="about2">Eknowledge Bank Mega</span></p>
		</br>
		</br>
	  </div>
	</div>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
		<div class="col-xs-12">
			<form class="form-horizontal" role="form"  action="http://172.29.119.99/bb_appl/pbl/pbl_emp_list.php" id="frmList" method="post" name="frmList">
			  
			  <div class="form-group ">
				<label class="col-sm-4 control-label">NIP </label>
				<div class="col-sm-6">
				  <input class="form-control"  name="txt_nip_f" value="12057590" placeholder="-- NIP --">
				</div>
			  </div>	
			  
			  <div class="form-group ">
				<label class="col-sm-4 control-label">Nama </label>
				<div class="col-sm-6">
				  <input class="form-control"  name="txt_name_f" value="" placeholder="-- Name --">
				</div>
			  </div>
			  
			  <div class="form-group ">
				<label class="col-sm-4 control-label">Organization Group </label>
				<div class="col-sm-6">
				  <input class="form-control"  name="slc_orgsilo_f" value="" placeholder="-- All --">
				</div>
			  </div>
			  
			  <div class="form-group ">
				<label class="col-sm-4 control-label">KP / Region</label>
				<div class="col-sm-6">				  
					<select class="form-control"  name="slc_regcode_f">
						<option selected="" value="">-- All --</option>
						<option value="803">803 - Regional Office - Surabaya</option>
						<option value="804">804 - Regional Office - Bandung</option>
						<option value="805">805 - Regional Office - Jakarta 1</option>
						<option value="806">806 - Regional Office - Makassar</option>
						<option value="807">807 - Regional Office - Semarang</option>
						<option value="810">810 - Regional Office - Medan</option>
						<option value="811">811 - Regional Office - Jakarta 2</option>
						<option value="888">888 - KPNO</option>
					</select>
				</div>
			  </div>
			  
			  <div class="form-group ">
				<label class="col-sm-4 control-label">Org code</label>
				<div class="col-sm-6">
				  <input class="form-control"  name="slc_orgcode_f" value="" placeholder="-- All --">
				</div>
			  </div>
			  
			  <div class="form-group ">
				<label class="col-sm-4 control-label"></label>
				<div class="col-sm-6">
				  <input class="btn btn-primary"  type="submit" value="Cari" name="btn_find">
				</div>
			  </div>		
			  
			</form>
		
			
		</div>

      </div>

      <hr>


    </div> <!-- /container -->

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