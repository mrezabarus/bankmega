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
			<form class="form-horizontal frmList" role="form"  action="<?php echo base_url();?>index.php/adminmax/Curve4moodle" id="frmList" method="post" name="frmList">
		  
			  <div class="form-group ">
				<label class="col-sm-4 control-label">Kursus </label>
				<div class="col-sm-6 selectContainer">
					<select name="id_kursus" class="form-control" title='Pilih salah satu dari berikut..'>
						<option value=""></option>
						<!--<option value="0">All Course</option>-->
						<?php
						  foreach($kursus as $row_k){
							echo '
							<option value="'. $row_k->idnumber .'">'. $row_k->shortname .'</option>';
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
						<option value="<?php echo date("Y"); ?>">New Employee (<?php echo date("Y"); ?> only)</option>
						<option value="0">All Employee (all scoes track)</option>			
					</select>
				</div>
			  </div>

			  <div class="form-group ">
				<label class="col-sm-4 control-label">Tgl Mulai</label>
				<div class="col-sm-6">
				  <input class="form-control datepicker" name="tgl_mulai" value="" placeholder="Tahun - Bulan - Hari">
				</div>
			  </div>
			  			  
			  <div class="form-group ">
				<label class="col-sm-4 control-label">Tgl Selesai</label>
				<div class="col-sm-6">

				  <input class="form-control datepicker" name="tgl_selesai" value="" placeholder="Tahun - Bulan - Hari">
				</div>
			  </div>
			  
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
  
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/jquery-ui-1.10.3/themes/flick/jquery-ui-1.9.2.custom.css">
	<script src="<?php echo base_url(); ?>assets/jquery-ui-1.10.3/ui/jquery.ui.core.js"></script>
	<script src="<?php echo base_url(); ?>assets/jquery-ui-1.10.3/ui/jquery.ui.widget.js"></script>
	<script src="<?php echo base_url(); ?>assets/jquery-ui-1.10.3/ui/jquery.ui.datepicker.js"></script>	
	<script>
	$(function() {		
		$( ".datepicker" ).datepicker({ 
			dateFormat: 'yy-mm-dd' ,
			onSelect: function() {
				nama = (this).name;
				$('#frmList').formValidation('revalidateField', nama);
			}
		});
	});
	</script>


	<script src="<?php echo base_url(); ?>assets/bootstrap-select/1.6.2/js/formValidation.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/bootstrap-select/1.6.2/js/bootstrap-select.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/bootstrap-select/1.6.2/js/FormValidation.Framework.Bootstrap.js"></script>
	
	<script>
	$(document).ready(function() {
	$('#frmList')
		.find('[name="id_kursus"]')
			.selectpicker()
			.change(function(e) {
				/* // revalidate the color when it is changed */
				$('#bootstrapSelectForm').formValidation('revalidateField', 'id_kursus');
			})
			.end()
		.find('[name="source_by"]')
			.selectpicker()
			.change(function(e) {
				/* // revalidate the color when it is changed */
				$('#bootstrapSelectForm').formValidation('revalidateField', 'source_by');
			})
			.end()
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
						callback: {
							message: 'Kursus tidak boleh kosong',
							callback: function(value, validator, $field) {
								// Get the selected options
								var options = validator.getFieldElements('id_kursus').val();
								return (options != null && options.length >= 1 && options.length <= 4);
							}
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
				},
				tgl_mulai: {
					validators: {
						date: {
							format: 'YYYY-MM-DD',
							message: 'The value is not a valid date'
						},
						notEmpty: {
							message: 'Tgl Mulai tidak boleh kosong'
						}
					}
				},
				tgl_selesai: {
					validators: {
						date: {
							format: 'YYYY-MM-DD',
							message: 'The value is not a valid date'
						},
						notEmpty: {
							message: 'Tgl Selesai tidak boleh kosong'
						}
					}
				}
			}
		});
	});		
	</script>
	
	<script>
	function temp_moodle_update() {
		var data = {
			nip:'haha'
		};
		var url = '<?php echo base_url(); ?>index.php/adminmax/temp_moodle_update';
		$('#receiver').load(url,data, function(){
		});	
	};
	
	temp_moodle_update();
	</script> 	

</body></html>