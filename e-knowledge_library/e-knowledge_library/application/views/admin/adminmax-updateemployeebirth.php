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
			<p>Click start to <?php echo $title; ?></p>
			<button class="btn btn-success" type="button" onclick="Grabbing();">Start</button>
			</br>
			</br>


			<div id="Updating">
				<p>Updating proses</p>
				<div class="bs-docs-example">
				  <div class="progress progress-striped active">
					<div class="bar proses2" style="width: 0%">0% Complete</div>		
				  </div>
				</div>
			</div>
			
			<div class="finish">
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
	<script>
		function StartGrab(){
			var sendData = {
			  start:1
			}
		
			var jqxhr = $.post( "<?php echo base_url(); ?>index.php/adminmax/UpdateEmployeeBirth", sendData , function(data) {
			  //alert( "success" );
			  //console.log(data);
			  result = JSON.parse(data);
			  proses2(result.end);
			  Finish(result.jmlhRow);
			});		

		}
		
		function Finish(id){
			/* Finish */
			$(" .finish ").html( "Finished " + id+ " row update." );
		}
		
		function proses2(id){
			$( ".proses2" ).attr({ style:"width: "+ id +"%" });
			$( ".proses2" ).html( id + "% Complete" );		
		}
		
		function step2(){
			sts = $( ".proses2" ).attr( "style" );
			sts2 = sts.substr(6);
			sts3 = parseInt(sts2);
			// console.log(sts3);
			stepProgres = sts3 + 1 ;			
			if(stepProgres > 100){
				step2Stop();
			}
			else{
				$( ".proses2" ).attr({ style:"width: "+ stepProgres +"%" });
				$( ".proses2" ).html( stepProgres + "% Complete" );			
			}
		}
		
		//setInterval(function(){alert("Hello")}, 3000);				
		var loopstep2;
		function step2Play() {
			loopstep2 = setInterval(function(){
				step2();
			}, 1000);
		}
		
		function step2Stop() {
			clearInterval(loopstep2);
		}	
		
		
		function Grabbing(){
			step2Play();
			StartGrab();
		}		
	</script>
  

</body></html>