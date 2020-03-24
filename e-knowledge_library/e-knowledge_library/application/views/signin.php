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

  <body class="no_navbar no_margin no_padding">
    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-xs-12">
		
		  </br>
		  <form class="form-horizontal" role="form"  action="" id="frmList" method="post" name="frmList">
			  
			  <div class="form-group ">
				<div class="col-sm-6">
				  <input type="text" placeholder="Username" name="username" class="form-control">
				</div>
			  </div>
			  
			  <div class="form-group ">
				<div class="col-sm-6">
				  <input type="password" placeholder="Password" name="password" class="form-control">
				</div>
			  </div>	
			  
			  <div class="form-group ">
				<div class="col-sm-6">
				  <button type="submit" class="btn btn-success">Send</button>
				</div>
			  </div>		
			  
			</form>	
		  
		  <!-- <p onclick="tutup();">close</p> -->
		  <?php 
			if(!empty($invalid)){
				echo $invalid;
			}
		  ?>
		  
        </div>

      </div>

    </div> <!-- /container -->

	
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url(); ?>assets/jquery/1.9.1/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/bootstrap_3.1.1/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/placeholders/placeholders.js"></script>
	
	<script>
		function tutup(){
			parent.$.colorbox.close(); return false;
			alert('fdf');
		}
	</script>
			
	<script src="<?php echo base_url(); ?>assets/bootstrapvalidator_0.5.3/dist/js/bootstrapValidator.js"></script>
	<script>
	$(document).ready(function() {
		$('#frmList').bootstrapValidator({
			feedbackIcons: {
				valid: 'glyphicon glyphicon-ok',
				invalid: 'glyphicon glyphicon-remove',
				validating: 'glyphicon glyphicon-refresh'
			},
			fields: {
				username: {
					validators: {
						notEmpty: {
							message: 'NIP/username tidak boleh kosong'
						}
					}
				},
				password: {
					validators: {
						notEmpty: {
							message: 'Password tidak boleh kosong'
						}
					}
				}
			}
		});
	});		
	</script>


		

</body></html>	