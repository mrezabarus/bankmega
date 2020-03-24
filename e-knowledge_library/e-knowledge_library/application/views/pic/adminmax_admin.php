<?php 

	$list = array
	  (	
		//array("#link","link name"),
		array("","Home"),
		array("CekRegister","Cek Register"),
		array("LearningMonitor","Learning Monitor"),
		array("JadwalTraining","Jadwal Training"),
		array("MoodleReport","Moodle Report"),
		array("EmployeeList","Employee List"),
		array("About","About"),
		// array("link","linkname"),
	  ); 
			
	$data['list'] = $list;
		

					
					foreach( $data['list'] as $row ){
					  echo '
					<li class="">
					  <a href="'. base_url() .'index.php/pic/'. $row[0] .'" class="">'. $row[1] .'</a>
					</li>			  
					  ';
					}	
?>
