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
          <?php 
			$this->load->view('admin/about-system');	
		  ?>
		</br>
		</br>
	  </div>
	</div>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
		
		<div class="col-xs-12">
			<form class="form-horizontal" role="form" id="form1" name="form1" method="post" action="">
			  
			  <div class="form-group ">
				<label class="col-sm-4 control-label">NIP/Nama : </label>
				<div class="col-sm-6">
				  <input type="text" class="form-control" name="nip" id="nip" value="" placeholder="Input NIP/Nama">
				</div>
			  </div>		
			</form>
			</br>			
		</div>
		
		
		<div class="col-xs-12">
			<div id="receiver2">
			  <div id="feedback_terima">
			  
			  </div>		
			</div>		
		</div>
		
		<div class="col-xs-12">
			<div id="space">			
			  </br>	
			  </br>	
			  </br>	
			  </br>	
			  </br>	
			  </br>	
			</div>		
		</div>


      </div>


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

	<!-- jquery-ui JS -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/jquery-ui-1.10.3/themes/flick/jquery-ui-1.9.2.custom.css">
	<script src="<?php echo base_url(); ?>assets/jquery-ui-1.10.3/ui/jquery-ui.js"></script>		

	
	<script>
	$('input[name="nip"]').autocomplete({
		source: "<?php echo base_url(); ?>index.php/region/eknowledgeLearningMonitor",
		// minChars: 3,
		select: function( event, ui ) {

			event.preventDefault();
			decoded = $('<div/>').html(ui.item.value).text();
			$('input[name="nip"]').val(decoded);
		  		
 			var url = "<?php echo base_url(); ?>index.php/region/eknowledgeLearningMonitor";
			var data = {
			  id:ui.item.value
			};
			
			$('#feedback_terima').load(url,data, function(){});		
		}
	});	


	</script> 

</body></html>