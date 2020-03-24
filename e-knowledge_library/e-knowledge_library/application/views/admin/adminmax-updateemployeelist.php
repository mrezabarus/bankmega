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
			<p><?php echo $name; ?> from &nbsp; <?php echo $source; ?></p>
			<p class="report">Last Update : <?php echo $lastUpdate->Update_time; ?></p>
			<button class="btn btn-success" type="button" onclick="Grabbing();">Start</button>
			</br>
			</br>

			<div id="Grabbing">
				<p>Grabbing process</p>
				<div class="bs-docs-example">
				  <div class="progress progress-striped active ">
					<div class="bar proses" style="width: 0%">0% Complete</div>		
				  </div>
				</div>
				<p class="report"></p>
			</div>

			<div id="Updating">
				<p>Updating process</p>
				<div class="bs-docs-example">
				  <div class="progress progress-striped active">
					<div class="bar proses" style="width: 0%">0% Complete</div>		
				  </div>
				</div>
				<p class="report"></p>
			</div>
			
			<div class="finish">
			</div>	
				
			</br>	
			</br>
			
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
	/* 
		new function ver 3.0 
		release 7 juli 2015
		
	*/	
	var loopDelay;
	
	
	/* Grabbing */		
		function Grabbing(){
		
			var sectorID = '#Grabbing';
			var Grabbing_result = {};
			
			loopNloop( sectorID );
			
			$.post( "<?php echo base_url(); ?>index.php/adminmax/grab_file/<?php echo $name; ?>", function(data) {
			  Grabbing_result = JSON.parse(data);
			  Grabbing_nextProses(); 			  
			});		
	
			function Grabbing_nextProses(){
				// console.log(s1_result);
				if(Grabbing_result.status == 'done'){
					progress_bar( sectorID, 100 );
					
					tablename = Grabbing_result.tablename;
					jmlhRow = Grabbing_result.jmlhRow;
					tgl = Grabbing_result.tgl;
					//Tabel:Employee, 57143 records, 17 file, 2015-08-11 14:26:33					
					$( sectorID + " .report" ).html( "Tabel:"+ tablename +", "+ jmlhRow +" records, "+ tgl +"" );
					
					loopStop();					
					Updating();
					// alert('Grab data is done.');
				}
				else{
					progress_error_cstm( sectorID );
					alert('Grab data is failed, server is busy.');
				}
			}
		}			
	
	/* Updating */
		function Updating(){
		
			var sectorID = '#Updating';
			var Updating_result = {};
			var target = "<?php echo base_url(); ?>index.php/adminmax/updating/<?php echo $name; ?>";		
			var limit = 1500;
			
			Updating_loop(target);
			
			function Updating_loop( target_default ){
				if(!Updating_result.x){
					new_start = 0;
				}
				else{
					new_start = Updating_result.x;
				}
				
				var sendData = {
				  limit:limit,
				  new_start:new_start
				}
			
				$.post( target_default, sendData , function(data) {
					Updating_result = JSON.parse(data);
					Updating_nextProses(); 
				});			
			}
			
			function Updating_nextProses(){
			
				// console.log(Updating_result);
				if(Updating_result.status == 'finish'){
					progress_bar( sectorID, 100 );
					loopStop();
					// alert('Grab data is done.');
					$( sectorID + " .report" ).html( "Finished " + Updating_result.jmlhRow + " row update." );
					Updating4moodle();
				}
				else if(Updating_result.status == 'run'){				
					sts_loop = ( Updating_result.end / Updating_result.jmlhRow ) * 100;								
					progress =  parseInt(sts_loop);					
					progress_bar( sectorID, progress );	
					
					$( sectorID + " .report" ).html( "Updating " + Updating_result.end + " row update." );
					
					Updating_loop( target );
				}
				else{
					progress_error_cstm( sectorID );
					alert('Updating data is failed, server is busy.');
				}			
			}			
		}
		
	/* General function */
		function progress_bar( bagian, progress ){	
		
			$( bagian + " .proses" ).attr({ style:"width: "+ progress +"%" });
			$( bagian + " .proses" ).html( progress + "% Complete" );			
		}

		function loopNloop(bagian, delay){

			sectorID = bagian;
			if(delay){
				jeda = delay;
			}
			else{
				jeda = 1000;
			}	
			
			loopDelay = setInterval(function(){ myTimer() }, jeda);
			
			function myTimer() {
				sts = $( sectorID + " .proses" ).attr( "style" );
				sts2 = sts.substr(6);
				sts3 = parseInt(sts2);
				// console.log(sts3);
				stepProgres = (sts3*1) + 1 ;			
				if(stepProgres < 100){
					progress_bar( sectorID, stepProgres );
				}
				else{	
					clearInterval(loopDelay);
				}
			}	
		}

		function loopStop() {
			clearInterval(loopDelay);
		}	
		
		function progress_error( bagian, progress ){
		
			$( bagian + " .bs-docs-example .progress" ).addClass( "progress-danger-striped" );
			$( bagian + " .proses" ).html( progress + "% Complete (danger)" );	
			$( bagian + " .proses" ).attr({ style:"width: "+ progress +"%" });
		}

		function progress_error_cstm( bagian ){
		
			sts = $( bagian + " .proses" ).attr( "style" );
			sts2 = sts.substr(6);
			progress = parseInt(sts2);
			
			if(progress < 17){
				progress = 17;
			}
			
			progress_error( bagian, progress );
			loopStop();
		}
		
		
		function Updating4moodle(){	
			var sendData = {
			  limit:1
			}
			
			var jqxhr = $.post( "<?php echo base_url(); ?>index.php/adminmax/Updating4moodle", sendData , function(data) {
			  //alert( "success" );
			  //console.log(data);
			});
		}		
		
	</script>
  

</body></html>