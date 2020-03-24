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
          <!-- <ul class="nav navbar-nav">
            <li class="active"><a href="<?php echo base_url(); ?>">Home</a></li>
            <li><a href="http://getbootstrap.com/examples/offcanvas/#about">About</a></li>
            <li><a href="http://getbootstrap.com/examples/offcanvas/#contact">Contact</a></li>
          </ul> -->
		  <ul class="nav navbar-nav navbar-right">
			<li><a href="#" >User Name</a></li>
			<li><a href="#" >Sign Out</a></li>
		  </ul>
        </div><!-- /.nav-collapse -->
      </div><!-- /.container -->
    </nav><!-- /.navbar -->

    <!-- Main jumbotron for a primary marketing message or call to action -->
	<div class="sambutan">
	  <div class="container">
		<h1>Halo..!</h1>
		<p>Selamat datang di e-knowledge library, Human Capital Management (HCMG), PT. BANK MEGA Tbk. Silahkan sign in untuk dapat mengunakan fasilitas kami. Terima kasih.</p>
		</br>
		</br>
	  </div>
	</div>
	
    <div class="container">

      <div class="row row-offcanvas row-offcanvas-right">

        <div class="col-xs-12 col-sm-9">
          <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">eknowledge by posisi</button>
          </p>
          <div class="jumbotron yellow padding30">
            <!-- <h1>Eknowledge Library</h1> -->
            <p>Pilih materi eknowledge dengan mengklik icon yang tersedia dibawah.</p>
			Silakan menggunakan headset atau speaker saat menggunakan aplikasi eknowledge. 
			<br/>
			Silakan mendownload flash player pada PC jika belum ada/ter-install . 
			<br/>
			<br/>
			<a href="http://10.14.18.11/download/Firefox%20Setup%209.0.1.zip?">Download Firefox 9.zip</a>  |  					
			<a href="http://10.14.18.11/download/Firefox%20Setup%209.0.1.exe?">Download Firefox 9.exe</a>

			<br/>
			<a href="http://10.14.18.11/download/Flash%20Player%2011.7%20Plugin%20(for%20Netscape-compatible%20browsers).zip?">Download Flash Player 11.zip</a>  |  		
			<a href="http://10.14.18.11/download/Flash%20Player%2011.7.exe?">Download Flash Player 11.exe</a>
          </div><!-- end jumbotron -->		  
		  
          <div class="row">
		<?php 
		  // generate for content
		  $no3 = 1;
		  foreach( $contentActive2 as $row3 ){
			echo '		  
            <div class="col-xs-4 col-sm-4 col-lg-3 paddingb15">
              <div class="publications" onclick="go(\''. $server . $row3->href .'\')">
                <div class="row">
                  <div class="col-xs-12 img">
				  <img src="'. base_url() .'assets/images/'. $row3->img .'" class="img-thumbnail" alt="'. $row3->kursus .'">
			      </div>
			    </div>
                <div class="row face">
				  <div class="col-xs-12 boxh80">
					<div class="text">
					  <span class="title">'. $row3->kursus .'</span>
					  <span class="date">'. date('Y | M j', strtotime($row3->create_project)) .'</span>
					</div>
				  </div>
			    </div> <!-- row face! -->	
                <div class="row back">
				  <div class="col-xs-12 boxmax">
					<div class="text">				            
					  <span class="creator">'. $row3->desc . ' ' . $row3->creator .'</span>
					  <div class="bottom">					            
						<span class="date">'. date('Y | M j', strtotime($row3->create_project)) .'</span>
						<span class="arr">'. $row3->arr .'</span>
					  </div>			            
					</div>	
				  </div>
			    </div> <!-- row back! -->				
              </div> <!-- publications! -->
            </div>		
   
			';
			$no3++;
		  }
		?>			   
          </div><!--/row-->		  
        </div><!--/.col-xs-12.col-sm-9-->		

        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
          <div class="list-group">
			<?php 
			  // generate for sidebar
			  $no2 = 1;
			  foreach( $peserta as $row2 =>$val2 )
			  {			
				if(!empty($sidebarActive)){
					if($row2 == $sidebarActive){
						$set2 = 'active';
					}
					else{
						$set2 = '';
					}			
				}
				else{
					if($no2 == 1){
						$set2 = 'active';
					}
					else{
						$set2 = '';
					}				
				}
				
							
				$href2 = base_url() .'index.php/Peserta/' . $row2;
				
				echo '				  
			  <a href="'. $href2 .'" class="list-group-item '. $set2 .'">'. $row2 .'</a>
				';
				$no2++;
			  }
			?>	
          </div>
        </div><!--/.sidebar-offcanvas-->
      </div><!--/row-->
	  
    </div><!--/.container-->
	
	</br>
	</br>

    <!-- Footer
================================================== -->
<footer class="bs-docs-footer" role="contentinfo">
  <div class="container">  
    <p class="description">Kami sangat menghargai kualitas tinggi dari perkerjaan teman - teman dan 
	</br>saran untuk perbaikan yang berharga, sehingga bisa menjadi solusi baru dari sistem eknowledge.
	</p>
	
    <ul class="bs-docs-footer-links text-muted">
      <li>&copy;2015</li>
      <li>.</li>
      <li><a href="#">HCMG</a></li>
      <li>.</li>
      <li><a href="#">HRMS</a></li>
      <li>.</li>
      <li><a href="#">BANK MEGA</a></li>
      <li>.</li>
      <li><a href="#">About</a></li>
      <li>.</li>
      <li><a href="#">Issues</a></li>
      <li>.</li>
      <li><a href="#">Releases</a></li>
    </ul>
  </div><!--/.container-->
</footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url(); ?>assets/jquery/1.9.1/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/placeholders/placeholders.js"></script>
    <script src="<?php echo base_url(); ?>assets/bootstrap_3.1.1/js/bootstrap.min.js"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php echo base_url(); ?>assets/offcanvas/ie10-viewport-bug-workaround.js"></script>
    <script src="<?php echo base_url(); ?>assets/offcanvas/offcanvas.js"></script>
	
	<script>
		function go(id){
			var win = window.open(id, '_blank');
			win.focus();
		}
	</script>
  

</body></html>