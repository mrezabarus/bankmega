<!DOCTYPE html>
<html>
<head>
  <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
  <meta charset="utf-8">

  <title><?php echo $title; ?></title>

  <meta content="image/jpeg">
  <meta content="Selamat datang di e-knowledge library, Human Capital Management (HCMG), PT. BANK MEGA Tbk.   Silahkan login untuk dapat mengunakan fasilitas kami. Terima kasih.">
  <meta content="Pilih materi e-knowledge dengan mengklik icon yang tersedia di atas. Harap menggunakan headset atau speaker saat menggunakan aplikasi e-knowledge. Harap menggunakan mendownload flash player pada PC jika belum ada atau ter-install." name="description">
  <meta content="Eknowledge Library">
  <meta content="app-id=579598589, app-argument=publ:library%3DhRRD75w" name="apple-itunes-app">
  <meta content="app-id=com.publ.reader&amp;referrer=library%3DhRRD75w" name="google-play-app">

  
  <link href="./assets/library.css" rel="stylesheet">
  <link href="./assets/custom_jack.css" rel="stylesheet">


</head>

<body class="" style="zoom: 1;">
  <div class="top has-description has-logo has-web-site " id="company-info">
    <div class="container">
      <div class="left">
        <img alt="" class="logo" id="company-logo" src="./assets/mega.png"> <span class="name" id="company-name">HCMG Eknowledge Library</span> 
		<a href="#description" class="toggle-description" id="toggle-description" title="deskripsi">
			<span class="bg"></span>
			<span class="text"></span>
		</a>
      </div>

      <div class="right">
		<a href="#" class="url" id="login" title="Login/Masuk">
			<span class="bg"></span>
			<span class="text">Login</span>
		</a>
      </div>

      <div class="clr"></div>

      <div class="description" id="company-description">		
		Sejak 2012 tim HCMG memanfaatkan pengetahuan yang luas dan keahlian dalam pengembangan aplikasi interaktif. Produk kami telah digunakan sebagai transfer pengetahuan tanpa terhalang jarak yang jauh, karena kami memanfaatkan teknologi dan infrastruktur yang telah ada. Dalam banyak hal dimungkinkan efisiensi waktu, tenaga dan biaya untuk produk yang telah kami buat. Kami sangat menghargai kualitas tinggi dari perkerjaan teman - teman dan saran untuk perbaikan yang berharga. Banyak manfaat yang diperoleh dan solusi baru untuk sistem eknowledge.
      </div>
  
    </div>
  </div>

  <div class="main">
    <div class="container">
      <div class="controls" id="controls" style="visibility: visible;">
        <div class="control-item">
          <form action="" method="post">
            <input autocomplete="off" id="filter" placeholder="Search" type="text" value="">
          </form>
        </div>

        <div class="control-item">
          <ul class="sorters" id="sorter">
			
			<?php 
			  // generate for control-item
			  $no = 1;
			  foreach( $control as $row => $val ){
				if($no == 1){
					$set = 'active';
				}
				else{
					$set = '';
				}
				
				echo '
            <li>
              <a class="asc '. $set .'" data-sorter="'. $row .'" href="#'. $row .'">'. $val .'</a>
            </li>				
				';
				$no++;
			  }
			?>
			
          </ul>
        </div>
      </div>

      <div class="sidebar">
        <ul id="collections-list">
			
		<?php 
		  // generate for sidebar
		  $no2 = 1;
		  foreach( $sidebar as $row2 => $val2 ){
			if($no2 == 1){
				$set2 = 'active';
			}
			else{
				$set2 = '';
			}
			
			echo '		
          <li>
            <a class="'. $set2 .'" href="#'. $val2 .'" id="collection-'. $no2 .'">'. $row2 .'</a>
          </li>		
			';
			$no2++;
		  }
		?>		
		
        </ul>
      </div>

      <div class="content">
        <ul class="publications" id="publications-list">
			
		<?php 
		  // generate for content
		  $no3 = 1;
		  foreach( $content as $row3 ){
			if($no3 == 1){
				$set3 = 'active';
			}
			else{
				$set3 = '';
			}
			
			echo '		
          <li>
		    <a href="'. $server . $row3->href .'" target="_blank">
			  <span class="face">			            
			    <span class="img">
			      <span>
				    <img src="./assets/'. $row3->img .'" alt="'. $row3->kursus .'">
				  </span>
				</span>			            
				<span class="text">				            
				  <span class="title">'. $row3->kursus .'</span>				            
				  <span class="date">'. date('Y | M j', strtotime($row3->create_project)) .'</span>			            
				</span>		            
			  </span>		            
			  <span class="back">			            
			    <div class="bg"></div>			            
				<div class="text">				            
				  <span class="desc">'. $row3->desc . ' ' . $row3->creator .'</span>
				  <div class="bottom">					            
					<span class="date">'. date('Y | M j', strtotime($row3->create_project)) .'</span>					            
					<span class="arr">'. $row3->arr .'</span>
				  </div>			            
				</div>		            
			  </span>	            
			</a>           
		  </li>	
			';
			$no3++;
		  }
		?>			
			  
        </ul>
      </div>

      <div class="clr"></div>
    </div>
  </div>
  
    <!-- Library core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="./assets/jquery.min.js"></script>
    <script src="./assets/placeholders.js"></script>
	<script>
		// if click #toggle-description
		// add class "show-description" to #company-info		
		$( "#toggle-description" ).click(function() {
		  $( "#company-description" ).toggle( 100, function() {
			classname = $( "#company-info" ).attr( "class" );
			n = classname.search("show-description");			
			//console.log(n);			
			if( n == -1 ){
				$( "#company-info" ).addClass( "show-description" );
			}
			else{
				$( "#company-info" ).removeClass( "show-description" )
			}
		  });
		});
		
		
	</script>
	
</body>
</html>