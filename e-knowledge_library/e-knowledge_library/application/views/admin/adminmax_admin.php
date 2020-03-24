<?php 

	$list = array
	  (	
		//array("#link","link name"),
		array("","Home"),
		array("CekRegister","Cek Register"),
		array("LearningMonitor","Learning Monitor"),
		// array("UpdateEmployee","Update Employee"),
		// array("UpdateEmployeeBirth","Update Employee Birth"),
		array("UpdateSoalConfig","Update Soal Config"),
		array("UpdateEmployeeList","Update Employee List"),
		
		array("ResetPassword","Reset Password"),
		array("JadwalTraining","Jadwal Training"),
		array("JadwalTrainingMoodle","Jadwal Training (custom for moodle)"),
		
		array("addPeserta","Add Peserta"),
		array("EmployeeList","Employee List"),
		array("EmployeeList_bb_appl","Employee List CBOR"),
		
		array("cleanServer","Clean Server"),
		array("MoodleReport","Moodle Report"),
		array("MoodleResetofPosttest","Moodle Reset of Posttest"),
		array("About","About"),
		// array("link","linkname"),
	  ); 
			
	$data['list'] = $list;
		

					
					foreach( $data['list'] as $row ){
					  echo '
					<li class="">
					  <a href="'. base_url() .'index.php/adminmax/'. $row[0] .'" class="">'. $row[1] .'</a>
					</li>			  
					  ';
					}	
?>