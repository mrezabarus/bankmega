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
	
	<!-- bootstrap-select CSS -->
    <link href="<?php echo base_url(); ?>assets/bootstrap-select/1.6.2/css/bootstrap-select.min.css" rel="stylesheet" >

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
		<br>
		<h1 class="nama"><?php echo $title; ?></h1>
          <?php 
			$this->load->view('admin/about-system');	
		  ?>
		<br>
		<br>
	  </div>
	</div>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">		
		<div class="col-xs-12">
 

        <div id="register">
				<p>Convert track register</p>
				<div class="bs-docs-example">
				  <div class="progress progress-striped active">
					<div class="bar proses" style="width: 0%">0% Complete</div>		
				  </div>
				</div>
				<p class="report"></p>
			</div>
			
			<br>

			<div id="duration">
				<p>Convert track duration</p>
				<div class="bs-docs-example">
				  <div class="progress progress-striped active">
					<div class="bar proses" style="width: 0%">0% Complete</div>		
				  </div>
				</div>
				<p class="report"></p>
			</div>
			
			<br>

			<div id="merge_data">
				<p>Merge data & create temporary</p>
				<div class="bs-docs-example">
				  <div class="progress progress-striped active">
					<div class="bar proses" style="width: 0%">0% Complete</div>		
				  </div>
				</div>
				<p class="report"></p>
			</div>
			
			<br>       
      </div>
    </div> <!-- /container  style="display: none;"-->

      <div class="row">		
		<div id="mergedata"  class="col-xs-12 hideme">
			<form class="form-horizontal frmList" role="form"  action="" id="frmList" method="post" name="frmList">
		  
			  <div class="form-group ">
				<label class="col-sm-4 control-label">Kursus </label>
				<div class="col-sm-6 selectContainer">
					<select name="id_kursus" class="form-control" title='Pilih salah satu dari berikut..'>
						<option value=""></option>
						<!--<option value="0">All Course</option>-->
						<?php
						  foreach($kursus as $row_k){
							echo '
							<option value="'. $row_k->shortname .'">'. $row_k->shortname .'</option>';
						  }
						?>
					</select>
				</div>
			  </div>
			  
			  <div class="form-group ">
				<label class="col-sm-4 control-label">Source by </label>
				<div class="col-sm-6 selectContainer">
					<select name="source_by" class="form-control" title='Pilih salah satu dari berikut..'>
						<option value=""></option>
						<option value="All">All</option>
						<!--<option value="0">All Course</option>-->
						<?php
						  foreach($tahun as $row_t){
							echo '
							<option value="'. $row_t->tahun .'">'. $row_t->tahun .'</option>';
						  }
						?>			
					</select>
				</div>
			  </div>
              <br>
              <br>
			  
			  <div class="form-group ">
				<label class="col-sm-4 control-label"></label>
				<div class="col-sm-6">
				  <button type="submit" class="btn btn-primary">Get Report</button>
				</div>
			  </div>
			  
			</form>
			<br>
			
		</div>
		
		<div class="col-xs-12">
			<div id="receiver" class="hide">
			  
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


	<script src="<?php echo base_url(); ?>assets/bootstrap-select/1.6.2/js/formValidation.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/bootstrap-select/1.6.2/js/bootstrap-select.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/bootstrap-select/1.6.2/js/FormValidation.Framework.Bootstrap.js"></script>
	
	<script>
	$(document).ready(function() {
	$('#frmList')
		.formValidation({
			framework: 'bootstrap',
			excluded: ':disabled',
			icon: {
				valid: 'glyphicon glyphicon-ok',
				invalid: 'glyphicon glyphicon-remove',
				validating: 'glyphicon glyphicon-refresh'
			},
			fields: {
				id_kursus: {
					validators: {
						notEmpty: {
							message: 'Kursus tidak boleh kosong.'
						},		
						callback: {
						}
					}
				},
				source_by: {
					validators: {
						callback: {
							message: 'Sumber tidak boleh kosong',
							callback: function(value, validator, $field) {
								// Get the selected options
								var options = validator.getFieldElements('source_by').val();
								return (options != null && options.length >= 1 && options.length <= 4);
							}
						}
					}
				}
			}
		})
		.on('success.form.fv', function(e) {
		
			e.preventDefault();				
			var $form = $(e.target);
			//var val = $form.serialize(); //id_kursus=1&source_by=2018
			var val = $form.serializeArray(); //array

			var fAray=[];
			$.each(val, function(i, field){
				//formarray.append(field.name + ":" + field.value + " ");
				fAray[field.name] = field.value;
			});			
			//console.log($form);
			//console.log(val);
			//console.log(fAray);

			id = '<?php echo base_url(); ?>index.php/pic/Curve4moodle2/' + fAray['id_kursus'] + '/' + fAray['source_by'];
			var win = window.open(id, '_blank');
			//win.focus();
		});

	});		


	</script>
	
	<script>
    function step1(id){
			sts = $( id ).attr( "style" );
			sts2 = sts.substr(6);
			sts3 = parseInt(sts2);
			//console.log(sts3);
			stepProgres = sts3 + 1 ;			
			if(stepProgres > 100){
				step1Stop(id);            
			}
			else{
				loopbar(id, stepProgres);		
			}
    }
        
    //setInterval(function(){alert("Hello")}, 3000);
    var loopstep1=[];
    function step1Play(id2) {
			id = id2 + ' .proses'
			loopstep1[id] = setInterval(function(){
				step1(id);
			}, 1000);
    }
            
    function step1Stop(id) {
        clearInterval(loopstep1[id]);
    }	   

		function loopbar(key, id) {
			$( key ).attr({ style:"width: "+ id +"%" });
			$( key ).html( id + "% Complete" );
		}

    function finish(key, id) {
			$( key + ' .proses' ).attr({ style:"width: "+ id +"%" });
			$( key + ' .proses' ).html( id + "% Complete" );
    }	

    function report(key, affected) {
			$( key + " .report" ).html( "Finished " + affected + " row update." );
    }

		function showForm() {
			//$( "#receiver2" ).show(1000);
			$( "#mergedata" ).show( 1000 );
			//console.log('dsdsd');
		}


		
		function register() {
			step1Play('#register');

			var val = {
				register:'key'
			};
			
			$.post('',val,function(dataRx,status){
				//console.log(dataRx);
				res = JSON.parse(dataRx);
				if (res.result === 'ok') {
					finish('#register', 100);
					report('#register', res.affected);
					duration();
				} 
				else if (res.result === 'error') {
					alert("Convert track register error");
				}
				else {
					
				}
			});	
		};
		
		function duration() {
			step1Play('#duration');

			var val = {
				duration:'key'
			};

			$.post('',val,function(dataRx,status){
				//console.log(dataRx);
				res = JSON.parse(dataRx);
				if (res.result === 'ok') {
					finish('#duration', 100);
					report('#duration', res.affected);
					merge_data();
				} 
				else if (res.result === 'error') {
					alert("Convert track register error");
				}
				else {
					
				}
			});	
		};
		
		function merge_data() {
			step1Play('#merge_data');

			var val = {
				merge_data:'key'
			};

			$.post('',val,function(dataRx,status){
				//console.log(dataRx);
				res = JSON.parse(dataRx);
				if (res.result === 'ok') {
					finish('#merge_data', 100);
					report('#merge_data', res.affected);
					showForm();
				} 
				else if (res.result === 'error') {
					alert("Merge data & create temporary error");
				}
				else {
					
				}
			});	
		};



		//showForm();
		//step1Play('#merge_data');
		//report('#merge_data', 7785);
		//finish('#merge_data', 100);

		register();
	</script> 	

</body></html>
