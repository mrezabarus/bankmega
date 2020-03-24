<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico">

    <title><?php echo $title; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>assets/bootstrap_3.1.1/css/bootstrap.css" rel="stylesheet">
	
    <!-- bootstrap-select CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap-select/1.6.2/css/bootstrap-select.min.css" />

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>assets/jack/css/jackk_style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/jack/css/sticky-footer-navbar.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><<?php echo base_url(); ?>script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="<?php echo base_url(); ?>assets/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="<?php echo base_url(); ?>assets/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	
  </head>

  <body style="">

	<?php
		echo $this->load->view('content/navigasi-bar.php');
	?>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h1 class="nama"><?php echo $title; ?></h1>

		  <?php 
			$this->load->view('content/about_system');	  
		  ?>
		
      </div>
    </div>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
	  
		<div class="col-xs-12">
		  <?php 
			if(!empty($pesan)){
				echo '<h4 class="padding7 '. $pesan['class'] .'">'. $pesan['txt'] .'</h4></br>';
			}
		  ?>
		</div>
		
		<div class="col-xs-12">
			<form class="form-horizontal frmList" role="form"  action="" id="frmList" method="post" name="frmList">
		  
			  <div class="form-group ">
				<label class="col-sm-4 control-label">ID Jadwal </label>
				<div class="col-sm-6 selectContainer">
					<select name="id_jadwal" class="form-control" title='Pilih salah satu dari berikut..'>
						<option value=""></option>
						<?php 
						  foreach($jadwal as $row){
							echo '<option value="'. $row->id_jadwal .'">#'. $row->id_jadwal .' &nbsp; '. $row->kursus .' &nbsp; '. $row->peserta .'</option>';
						  }
						?>
					</select>
				</div>
			  </div>
			  
			  <div class="form-group ">
				<label class="col-sm-4 control-label">NIP </label>
				<div class="col-sm-6">
				  <input class="form-control"  name="id_user" value="" placeholder="NIP">
				</div>
			  </div>
			  
			  <div class="form-group ">
				<label class="col-sm-4 control-label">Nama </label>
				<div class="col-sm-6">
				  <input class="form-control"  name="user_name" value="" placeholder="Nama">
				</div>
			  </div>
			  
			  <div class="form-group ">
				<label class="col-sm-4 control-label">Posisi </label>
				<div class="col-sm-6">
				  <input class="form-control"  name="posisi_detail" value="" placeholder="Posisi" readonly>
				</div>
			  </div>
			  
			  <div class="form-group ">
				<label class="col-sm-4 control-label">Org </label>
				<div class="col-sm-6">
				  <input class="form-control"  name="org" value="" placeholder="Org" readonly>
				</div>
			  </div>
			  
			  <div class="form-group ">
				<label class="col-sm-4 control-label">Organisasi </label>
				<div class="col-sm-6">
				  <input class="form-control"  name="organisasi_name" value="" placeholder="Organisasi" readonly>
				</div>
			  </div>
			  
			  <div class="form-group ">
				<label class="col-sm-4 control-label">Regional</label>
				<div class="col-sm-6">
				  <input class="form-control"  name="regional_name" value="" placeholder="Regional" readonly>
				</div>
			  </div>

			  
			  <div class="form-group ">
				<label class="col-sm-4 control-label"></label>
				<div class="col-sm-6">
				  <button type="submit" class="btn btn-primary">Save</button>
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
		
      </div>



    </div> <!-- /container -->

	  <?php 
		$this->load->view('content/footer');	  
	  ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url(); ?>assets/jquery/1.9.1/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/bootstrap_3.1.1/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/placeholders/placeholders.js"></script>
  

	<!-- jquery-ui JS -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/jquery-ui-1.10.3/themes/flick/jquery-ui-1.9.2.custom.css">
	<script src="<?php echo base_url(); ?>assets/jquery-ui-1.10.3/ui/jquery.ui.core.js"></script>
	<script src="<?php echo base_url(); ?>assets/jquery-ui-1.10.3/ui/jquery.ui.widget.js"></script>
	<script src="<?php echo base_url(); ?>assets/jquery-ui-1.10.3/ui/jquery.ui.datepicker.js"></script>		<script src="<?php echo base_url(); ?>assets/jquery-ui-1.10.3/ui/jquery-ui.js"></script>	
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
	
	<!-- Bootstrap formvalidation JS -->
	<script src="<?php echo base_url(); ?>assets/bootstrap-select/1.6.2/js/formValidation.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/bootstrap-select/1.6.2/js/bootstrap-select.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/bootstrap-select/1.6.2/js/FormValidation.Framework.Bootstrap.js"></script>
		
	<script>
	$(document).ready(function() {
	$('#frmList')
		.find('[name="id_jadwal"]')
			.selectpicker()
			.change(function(e) {
				/* // revalidate the color when it is changed */
				$('#bootstrapSelectForm').formValidation('revalidateField', 'id_jadwal');
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
				id_jadwal: {
					validators: {
						callback: {
							message: 'Test tidak boleh kosong',
							callback: function(value, validator, $field) {
								// Get the selected options
								var options = validator.getFieldElements('id_jadwal').val();
								return (options != null && options.length >= 1 && options.length <= 4);
							}
						}
					}
				},
				id_user: {
					validators: {
						notEmpty: {
							message: 'NIP tidak boleh kosong'
						}
					}
				},
				user_name: {
					validators: {
						notEmpty: {
							message: 'Nama tidak boleh kosong'
						}
					}
				}
			}
		});
	});		
	</script>
	
	<script>
	$('input[name="id_user"]').autocomplete({
		source: "<?php echo base_url(); ?>index.php/adminmax/getiduser",
		select: function( event, ui ) {
							
			var url = "<?php echo base_url(); ?>index.php/adminmax/getiduser";
			var data = {
			  id:ui.item.value
			};			
			$('#feedback_terima').load(url,data, function(){});				
		}
	});
	
	$('input[name="user_name"]').autocomplete({
		// minLength: 2,
		source: "<?php echo base_url(); ?>index.php/adminmax/getusername",
		select: function( event, ui ) {
							
			var url = "<?php echo base_url(); ?>index.php/adminmax/getusername";
			var data = {
			  id:ui.item.value
			};			
			$('#feedback_terima').load(url,data, function(){});				
		}
	});	
	</script>	
	


	


</body></html>