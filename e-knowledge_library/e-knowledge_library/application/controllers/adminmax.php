<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adminmax extends CI_Controller {

	/**
	 * khusus untuk mimin and momod
	 * 
	 * & special thanks to Hana rafidah
	 */
	public function __construct()
	{
		parent::__construct();
		// Your own constructor code

		session_start();
		if(isset($_SESSION['status'])){
			if($_SESSION['status']==='admin' && !empty($_SESSION['lbrary_nip'])){
				$this->load->model('Adminmax_db');
			}
			else{
				redirect('/welcome', 'refresh');
			}
		}		
		else{
			redirect('/welcome', 'refresh');
		}

        //nocache() method
        $this->nocache();		
	}	
	
	
	
	/* 
		Adminmax Display
		- index		-> Home			
        - CekRegister 		
        - LearningMonitor	
        - UpdateSoalConfig
        - UpdateEmployeeList	
        - ResetPassword
        - JadwalTraining
        - AddPeserta
        - EmployeeList
        - EmployeeList_bb_appl - > Employee List CBOR
        - CleanServer
        - MoodleReport
        - MoodleResetofPosttest
        - About		
	*/
	function index()
	{	
		$data['title'] = 'Adminmax';
		
		$user 			= $_SESSION['name2lwr'];		
		
		$this->load->view('admin/adminmax-index.php', $data);
	}	
	
	function CekRegister()
	{
		$data['title'] = 'Cek Register';		
		
		$this->load->view('admin/adminmax-cekregister.php', $data);		
	}
	
	function LearningMonitor()
	{
		$data['title'] = 'Learning Monitor';		
		
		$this->load->view('admin/adminmax-learningmonitor.php', $data);		
	}
	
	function UpdateSoalConfig()
	{
		$data['title'] = 'Update Soal Config';
		$updateDb = 0;
		
		/* cari konfigurasi soal */	
		$findSoalConfig = $this->Adminmax_db->soal_config();
		$data['row'] = $findSoalConfig;
		
		if(!empty($findSoalConfig)){
			foreach($findSoalConfig as $row){
				$komponen_soal_2 = json_decode($row->komponen_soal, true);// for Array
				
				$jmlh_soal	= array_sum($komponen_soal_2);
				$jmlh_soal2[$row->id_kursus] = $jmlh_soal;
				
				$rowx['jmlh_soal'] = $jmlh_soal;
				
				$update = $this->Adminmax_db->UpdateSoalConfig($row->id, $rowx);
				
				$updateDb = $updateDb + $update;
			}

		}			
		$data['jmlh_soal']	= $jmlh_soal2;			
		$data['affected_rows']	= $updateDb;			

			echo '<pre>';
			print_r($data);	
			die;		
			
		$findSoalConfig = $this->Adminmax_db->UpdateSoalConfig($id, $data);
		
		$this->load->view('admin/adminmax-updatesoalconfig', $data);	
	}
	
	function UpdateEmployeeList()
	{
		$data['title'] = 'Update Employee List';
		$data['name'] = 'Update Employee List';		
		$data['source'] = 'http://172.29.119.99/bb_appl/srv/srv_json_employee.php';		
		$data['lastUpdate'] = $this->Adminmax_db->lastUpdate('z_employee_list_2');		
		
		$this->load->view('admin/adminmax-updateemployeelist', $data);		
	}
	
	function ResetPassword()
	{
		$data['title'] = 'Reset Password';			
		
		$this->load->view('admin/adminmax-resetpassword.php', $data);		
	}
	
	function JadwalTraining()
	{
		$data['title'] = 'Jadwal Training';
		$data['result'] = $this->Adminmax_db->JadwalTraining();			
		$data['findSoalConfig'] = $this->Adminmax_db->findSoalConfig();	
		
		$this->load->view('admin/adminmax-jadwaltraining', $data);	
	}
	
	function JadwalTrainingMoodle()
	{
		$data['title'] = 'Jadwal Training';
		$data['result'] = $this->Adminmax_db->JadwalTrainingMoodle();		

		// echo '<pre>';
		// print_r($data);	
		// die;	
		
		$this->load->view('admin/adminmax-jadwaltrainingmoodle', $data);	
	}
	
	function addPeserta()
	{
		$data['title'] = 'Add Peserta';
		$data['jadwal']	= $this->Adminmax_db->jadwal();//
		
		
		if($_POST){	
			// echo '<pre>';
			// print_r($_POST);		
			// die;
			
			$row = $_POST;
			$rowExplode = explode(".", $_POST['id_jadwal']);
			
			$row['id_jadwal_awal'] = $rowExplode[0];
			$row['id_jadwal'] = $rowExplode[0];
			$row['id_kursus'] = $rowExplode[1];
						
			$return_id = $this->Adminmax_db->insert_eknowledge_register($row);
			
			$data['row'] = $this->Adminmax_db->UpdateDataUser();
			
			if(!empty($return_id)){
				$data['pesan']['txt'] = 'Data telah disimpan.';
				$data['pesan']['class'] = 'primary';
			}
		}
			$data['title'] = 'Add Peserta';				
			
			$this->load->view('admin/adminmax-add-peserta', $data);	
	}				

	function EmployeeList()
	{
		$data['title'] = 'Employee List';
		
		$this->load->view('admin/adminmax-employeelist', $data);	
	}
	
	function EmployeeList_bb_appl()
	{
		$data['title'] = 'Employee List bb appl';
		
		$this->load->view('admin/adminmax-employeelist-ukibb', $data);		
	}	
	
	function cleanServer()
	{
		$data['title'] = 'Clean Server Condition';
		$data['row'] = $this->Model_db->cleanServerCondition();
		
		$this->load->view('admin/adminmax-cleanserver', $data);	
	}
	
	function MoodleReport0()
	{
		$data['title'] = 'Request Report of Moodle';
		$data['kursus'] = $this->Adminmax_db->kursus();
		
		// echo '<pre>';
		// print_r($data);	
		// die;	
		
		$this->load->view('admin/adminmax-moodlereport', $data);	
	}
	
	function MoodleReport()
	{
		$post = $this->input->post();
		if(!empty($post)){
			// echo '<pre>';
			// print_r($post);	
			// die;

			if(!empty( $post['register'] )){							
				$data['feedback'] = $this->moodle_register( $post );	//scoes_track_reg
			}
			elseif(!empty( $post['duration'] )){			
				$data['feedback'] = $this->moodle_duration( $post );	//scoes_track_duration
			}
			elseif(!empty( $post['merge_data'] )){			
				$data['feedback'] = $this->moodle_temp( $post );	//z_moodle_temp
			}
			else{
				$data['feedback'] = null;
			}

			$json = json_encode($data['feedback']);
			echo $json;
			die;			
		}

		$data['title'] = 'Request Report of Moodle';
		$data['kursus'] = $this->Adminmax_db->moodle_kursus();
		$data['tahun'] = $this->Adminmax_db->moodle_tahun_kursus();
		
		// echo '<pre>';
		// print_r($data);	
		// die;	
		
		$this->load->view('admin/adminmax-moodlereport-2', $data);	
	}
	
	function MoodleResetofPosttest()
	{
		$data['title'] = 'Moodle Reset of Posttest';		
		
		$this->load->view('admin/adminmax-moodleresetofposttest.php', $data);	
	}
	
	function About()
	{
		$data['title'] = 'About of System';			
		
		$this->load->view('admin/adminmax-about', $data);		
	}
	

	
	/* 
		Service Data Request
		-  eknowledgeRegister
		-  eknowledgeLearningMonitor
		-  updateIDjadwal
		-  eknowledgeUser
		-  resetPwd
		-  findEmployeeList
		-  getiduser
		-  getusername
	*/
	function eknowledgeRegister() //srv for Cek Register
	{
		if($_POST){			
			$nip	=	trim( $_POST['nip']);
			$limit = 50;			
			$result = $this->Adminmax_db->eknowledgeRegister($nip, $limit);			
			if(!empty($result)){
				$data['detail'] = 'http://172.29.119.99/bb_appl/pbl/pbl_detail_tag.php?nip=';
				$data['result'] = $result;				
				// echo '<pre>';
				// print_r($result);	
				// die;					
				$this->load->view('admin/print-register', $data);	
			}
			else{
				echo 'data not found / no registered';
			}			
		}
		else{
			echo 'Oopss no data..!';
		}		
	}
	
	function eknowledgeLearningMonitor() //srv for LearningMonitor
	{
		if(!empty($_GET['term'])){	
		
			echo $this->Adminmax_db->GETiduserORusername($_GET['term']);
			
		}
		elseif(!empty($_POST['id'])){	
			
			$nip = trim( $_POST['id'] );
			$nip = substr($nip, 0, 9);	
			$nip = trim( $nip );
			
			$rowdata['eknowledge'] = $this->Adminmax_db->eknowledgeMonitor($nip);
			$rowdata['moodle'] = $this->Adminmax_db->LearningMonitor4moodle($nip);
	
			// echo '<pre>';
			// print_r($rowdata);	
			// die;
			
			if(!empty($rowdata)){
				$data['detail'] = 'http://172.29.119.99/bb_appl/pbl/pbl_detail_tag.php?nip=';
				$data['rowdata'] = $rowdata;	
				$this->load->view('admin/print-eknowledgemonitor', $data);	
			}
			else{
				echo 'data not found / no registered';
			}					
		}
		else{
			echo 'Oopss no data..!';
		}		
	}
	
	function updateIDjadwal()
	{
		if($_POST){
			$idx	=	trim( $_POST['idx']);			
			$data['id_jadwal']	=	trim( $_POST['newVal']);			
			$result = $this->Adminmax_db->updateIDjadwal($idx, $data);			
			if(!empty($result)){
				echo "
					<script>
						alert('". $result ." row affected.');
					</script>		
				";
			}
			else{
				echo "
					<script>
						alert('data can\'t be update.');
					</script>		
				";
			}			
		}
		else{
			echo 'Oopss no data..!';
		}		
	}
	
	function eknowledgeUser() //srv for Reset Password
	{
		if($_POST){			
			$nip	=	trim( $_POST['nip']);
			$limit = 10;			
			$result = $this->Adminmax_db->eknowledgeUser($nip, $limit);			
			if(!empty($result)){
				$data['detail'] = 'http://172.29.119.99/bb_appl/pbl/pbl_detail_tag.php?nip=';
				$data['result'] = $result;				
				// echo '<pre>';
				// print_r($result);	
				// die;					
				$this->load->view('admin/print-datauser', $data);	
			}
			else{
				echo 'data not found / no registered';
			}			
		}
		else{
			echo 'Oopss no data..!';
		}		
	}
	
	function resetPwd()
	{
		if($_POST){
			// echo '<pre>';
			// print_r($_POST);	
			// die;	
			
			$nip	=	trim( $_POST['nip']);
			
			$result = $this->Adminmax_db->resetPwd($nip);
			
			if(!empty($result)){
				echo 'true';
			}
			else{				
				echo 'false';
			}			
		}
		else{
			echo 'Oopss no data..!';
		}
	
	}

	function findEmployeeList() //srv for Employee List
	{
		if($_POST){
			$nip	=	trim( $_POST['nip']);
			$limit = 20;			
			$result = $this->Adminmax_db->employeeList($nip, $limit);			
			if(!empty($result)){
				$data['detail'] = 'http://172.29.119.99/bb_appl/pbl/pbl_detail_tag.php?nip=';		
				$data['result'] = $result;				
				// echo '<pre>';
				// print_r($result);	
				// die;					
				$this->load->view('admin/print-employeeList', $data);	
			}
			else{
				echo 'data not found / no registered';
			}			
		}
		else{
			echo 'Oopss no data..!';
		}		
	}		
	
	function getiduser()
	{		
		if(!empty($_GET['term'])){		
			$term = trim( $_GET['term'] );
			
			$rowdata = $this->Adminmax_db->getiduser($term);
						
			foreach($rowdata as $row){
				$row2[] = $row->nip;
			}
			
			$row3 =  json_encode($row2);
			
			echo $row3;		
		}
		if(!empty($_POST['id'])){				
			$term = trim( $_POST['id'] );
			$limit=1;
			
			$rowdata = $this->Adminmax_db->getiduser2($term);
			
			echo "
			<script>
				$('input[name=\"user_name\"]').val('". ucwords(strtolower( $rowdata->nama)) ."');
				$('#frmList').formValidation('revalidateField', 'user_name');
				$('input[name=\"posisi_detail\"]').val('". $rowdata->jobtitle ."');
				$('input[name=\"org\"]').val('". $rowdata->org_group_code ."');
				$('input[name=\"organisasi_name\"]').val('". $rowdata->org_group_name ."');
				$('input[name=\"regional_name\"]').val('". $rowdata->org_region_name ."');
			</script>
			";
		}
	}	

	function getusername()
	{		
		if(!empty($_GET['term'])){		
			$term = trim( $_GET['term'] );
			
			$rowdata = $this->Adminmax_db->getusername($term);

			foreach($rowdata as $row){
				$row2[] = ucwords(strtolower( $row->nama));
			}
			
			$row3 =  json_encode($row2);
			
			echo $row3;		
		}
		if(!empty($_POST['id'])){				
			$term = trim( $_POST['id'] );
			$limit=1;
			
			$rowdata = $this->Adminmax_db->getusername2($term);
			
			echo "
			<script>
				$('input[name=\"id_user\"]').val('". $rowdata->nip ."');
				$('#frmList').formValidation('revalidateField', 'id_user');
				$('input[name=\"posisi_detail\"]').val('". $rowdata->jobtitle ."');
				$('input[name=\"org\"]').val('". $rowdata->org_group_code ."');
				$('input[name=\"organisasi_name\"]').val('". $rowdata->org_group_name ."');
				$('input[name=\"regional_name\"]').val('". $rowdata->org_region_name ."');
			</script>
			";
		}
	}		

	function temp_moodle_update()
	{		
		$update['register'] = $this->Adminmax_db->scoes_track_reg();
		$update['duration'] = $this->Adminmax_db->scoes_track_duration();
		
		print_r($update);
	}
	
	function ResetofPosttestMoodle()
	{
		if(!empty($_GET['term'])){	
		
			echo $this->Adminmax_db->GETiduserORusername($_GET['term']);
			
		}
		elseif(!empty($_POST['id'])){	
			
			$nip = trim( $_POST['id'] );
			$nip = substr($nip, 0, 9);	
			$nip = trim( $nip );			

			// echo '<pre>';
			// print_r($nip);	
			// die;
			
			$row['username'] = $nip;			
			$result = $this->Adminmax_db->search_resetofposttestMoodle($row);
			
			if(!empty($result)){
				$data['result'] = $result;
				$this->load->view('admin/print-resetofposttestmoodle', $data);
				// $this->load->view('admin/search_resetofposttest', $data);	
			}
			else{
				echo 'data not found.';
			}	
		}
		else{
			echo 'Oopss no data..!';
		}
	}
	
	function ResetterOfNipMoodle()
	{
		if($_POST){
			// echo '<pre>';
			// print_r($_POST);	
			// die;	
			
			foreach( $_POST as $key => $value){
				$data[$key]	=	trim( $value );
			}

			/* copy data backup to j_data_user_posttest_reseter */
			if(!empty( $data['id_kursus'] )){
			
				$data2['result1'] = $this->Adminmax_db->backupOfTestMoodle($data);
				
				/* clear data j_data_user_posttest where nip and scormid */
				$data2['result2'] = $this->Adminmax_db->Clear_j_data_user_posttestMoodle($data);	
			}
			
				$data2['result3'] = $this->Adminmax_db->Clear_mdl_scorm_scoes_trackMoodle($data);	
			
			if(!empty( $data2['result3'] )){
				// echo 'true';
				
				echo '<pre>';
				echo 'Reset is done with nip :' . $data['nip'];
				echo '<br>';
				print_r($_POST);	
				print_r($data2);	
				// die;
			}
			else{				
				echo 'false';
			}			
		}
		else{
			echo 'Oopss no data..!';
		}	
	}
	
	
	
	/* 
		Update Employeelist Proses
		- progres_1_grab
		- progres_2_convert_to_json
		- progres_3_updating
	*/
	function progres_1_grab()
	{
		ini_set('max_execution_time', 420); //420 seconds = 7 minutes

		$root1 = "http://".$_SERVER['HTTP_HOST'];
		$script_name  = $_SERVER['SCRIPT_NAME'];

		/* Target Grabbing */
		$url = "http://172.29.119.99/bb_appl/pbl/pbl_emp_list.php";

		/* -----------------------------------------
		-- step 1 ( Parameter post Data request )
		----------------------------------------- */
		$postdata = http_build_query(
			array(
				// 'txt_nip_f' => '12057590', //NIP
				'txt_nip_f' => '', //NIP
				'txt_name_f' => '', //name
				'slc_orgsilo_f' => '', //ORG name
				'slc_regcode_f' => '', //Region code
				'slc_orgcode_f' => '', //ORG code
				'submit' => 'Cari' //btn find
			)
		);

		$opts = array('http' =>
			array(
				'method'  => 'POST',
				'header'  => 'Content-type: application/x-www-form-urlencoded',
				'content' => $postdata
			)
		);

		$context  = stream_context_create($opts);


		/* -----------------------------------------
		-- step 2 (Graping element)
		----------------------------------------- */	
		$result = file_get_contents($url, false, $context);	// get html

		/* -----------------------------------------
		-- step 3 (saving)
		----------------------------------------- */	
		$fileName = 'employee_list.html';
		file_put_contents( "./assets/download/" . $fileName, $result);

		/* -----------------------------------------
		-- step 4 (search element)
		----------------------------------------- */	
		$start_1 	= '<!-- CONTENT Table Area -->';
		$end_1		= '<!-- End CONTENT Table Area -->';
		$pos_1['start'] = strpos($result, $start_1, 0);
		$pos_1['end'] 	= strpos($result, $end_1, 0);
		$pos_1['end1'] 	= strlen($end_1);;
		$pos_1['end2']	= $pos_1['end'] - $pos_1['start'] + $pos_1['end1'];			

		/* -----------------------------------------
		-- step 5 (filtering)
		----------------------------------------- */	
		$section2 = substr($result, $pos_1['start'], $pos_1['end'] - $pos_1['start']);

		/* -----------------------------------------
		-- step 6 (filter saving)
		----------------------------------------- */	
		$fileNameClean = 'employee_list_Clean.html';
		file_put_contents( "./assets/download/" . $fileNameClean, $section2);	
		
		echo "100";	
	}	

	function progres_2_convert_to_json()
	{
		ini_set('max_execution_time', 420); //420 seconds = 7 minutes

		$root1 = "http://".$_SERVER['HTTP_HOST'];
		$script_name  = $_SERVER['SCRIPT_NAME'];

		/* -----------------------------------------
		-- step 7 (table to array)
		----------------------------------------- */			
		$file = './assets/download/employee_list_Clean.html';
		
		$row_data =  $this->Adminmax_db->table_to_array( $file, true, true);

		/* -----------------------------------------
		-- step 8 (json saving)
		----------------------------------------- */	
		$JsonToFile =  json_encode($row_data);

		$fileNameClean = './assets/download/' . 'JsonToFile.html';
		file_put_contents($fileNameClean, $JsonToFile);	

		echo "100";		
	}

	function progres_3_updating()
	{
		/* -----------------------------------------
		-- step 9 (saving to database)
		----------------------------------------- */	

		$json = file_get_contents('./assets/download/JsonToFile.html');
		$row_data = json_decode($json, true);		// for Array


		$limit = $_POST['limit'];
		$start_3 = $_POST['start'];
		$end_3 = $_POST['end'];
		
		// $limit = 100;
		// $start_3 = 1;
		// $end_3 = 100;

		/* new query trick */

		$table = 'z_employee_list';
		$query = '';
		$kosong = 0;

		for ($i = $start_3; $i <= $end_3; $i++) {
			// print_r($row_data[$i]);
			$keys ='';
			$values ='';
			
			$row2 = $row_data[$i];			

			if(!empty($row2)){
				
				$row2['StartDate'] = date("Y-m-d", strtotime($row2['StartDate'])); 
				
				$this->Adminmax_db->insert_employee($row2);
			}
			else{
				$kosong++;
			}
		}

		$result['nol'] = $kosong;	

		$start_4 = $end_3;
		$end_4 = $end_3*1 + $limit;

		$jmlhRow = count($row_data);

		$result['jmlhRow'] = $jmlhRow;

		if($end_4 > $jmlhRow){
			$end_4 = $jmlhRow;
			$result['update'] = $end_3;
		}

		$result['start'] = $start_4;
		$result['end'] = $end_4;

		$result2 =  json_encode($result);
		echo $result2;	
	}
	
	

	/* 
		Update Employee List Proses rev 3.0
		- rev3_progres_1_grab
		- rev3_progres_3_updating
	*/	
	function rev3_progres_1_grab()
	{
		ini_set('max_execution_time', 420); //420 seconds = 7 minutes

		/* Target Grabbing */
		$url = "http://172.29.119.99/bb_appl/srv/srv_json_employee.php";

		/* -----------------------------------------
		-- step 1 ( Parameter post Data request )
		----------------------------------------- */
		$postdata = http_build_query(
			array(
				'txt_nip_f' => '12057590', //NIP				
			)
		);

		$opts = array('http' =>
			array(
				'method'  => 'POST',
				'header'  => 'Content-type: application/x-www-form-urlencoded',
				'content' => $postdata
			)
		);

		$context  = stream_context_create($opts);

		/* -----------------------------------------
		-- step 2 (Graping element)
		----------------------------------------- */	
		$result = file_get_contents($url, false, $context);	// get html

		/* -----------------------------------------
		-- step 3 (clean atribute html)
		----------------------------------------- */	
		/* replace string 2 */
		$cari2 = array("<html><head>", '<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1"></head><body>', "</body></html>");
		$gantinya2   = array("", "", "");
		$result2 = str_replace($cari2, $gantinya2, $result);	

		/* -----------------------------------------
		-- step 4 (clean chr(13) / removed new line)
		----------------------------------------- */	
		$valueToCode_1 = mysql_real_escape_string($result2);
		
		/* replace string */
		$cari = array("\\r\\n\\n", "\r\n\n", "\\r\\n", "\r\n", "rnn", "rn", "\\");
		$gantinya   = array("", "", "", "", "", "", "");
		$valueToCode_2 = str_replace($cari, $gantinya, $valueToCode_1);	

		/* -----------------------------------------
		-- step 5 (hanya sebagai storage json yg sudah bersih)
		----------------------------------------- */	
		$htmlEncode = htmlspecialchars($valueToCode_2, ENT_QUOTES);
		$htmlDecode = htmlspecialchars_decode($htmlEncode);
		$fileNameClean = './assets/download/' . 'rev3_JsonToFile.html';
		file_put_contents($fileNameClean, $htmlDecode);		
	
		/* -----------------------------------------
		-- step 6 (status proses)
		----------------------------------------- */		
		echo "100";	
	}	
	
	function rev3_progres_3_updating()
	{
		/* -----------------------------------------
		-- step 9 (saving to database)
		----------------------------------------- */	

		$json 		= file_get_contents('./assets/download/rev3_JsonToFile.html');
		$row_data 	= json_decode($json, true);		// for Array
		$jmlhRow 	= count($row_data);

		$limit 		= $_POST['limit'];
		$start_3 	= $_POST['start'];
		$end_3 		= $_POST['end'];
		
		// $limit = 100;
		// $start_3 = 1;
		// $end_3 = 100;
		
		if($end_3 > $jmlhRow){
			$end_3 	= $jmlhRow;
		}

		/* new query trick */
		$kosong = 0;

		for ($i = $start_3; $i <= $end_3; $i++) {
			// print_r($row_data[$i]);
			
			$row2 = $row_data[$i];	

			if(!empty($row2)){				
				if($start_3 == 1){
					$this->Adminmax_db->empty_employee();
				}
				foreach($row2 as $row2key => $row2val){
					$val = trim($row2val);	
					
					if(empty($val)){			
						$row2[$row2key]	= null; 		
					}else{
						$row2[$row2key] = $val;
					}
				}
				
				$row2['start_dmy'] = date("Y-m-d", strtotime($row2['start_dmy'])); 
				$row2['birth_dmy'] = date("Y-m-d", strtotime($row2['birth_dmy'])); 				
				$row2['md5_hash'] = md5($row2['nip']); 		

				$row3[] = $row2;
				
				// $this->Adminmax_db->rev3_insert_employee($row2);				
			}
			else{
				$kosong++;
			}
		}
		
		if(!empty($row3)){		
			$this->Adminmax_db->insert_batch_employee($row3);
		}		
	
		$start_4 = $end_3 + 1;
		$end_4 = $end_3*1 + $limit;

		if($end_4 > $jmlhRow){
			$end_4 = $jmlhRow;
		}

		$result['update'] = $end_3;
		$result['nol'] = $kosong;
		$result['jmlhRow'] = $jmlhRow;
		$result['start'] = $start_4;
		$result['end'] = $end_4;

		$result2 =  json_encode($result);
		echo $result2;	
	}

	
	

	
	/* 
		System Grabbing rev 3.1
		- grab_file
		- updating
	*/	
	function grab_file($nama='')
	{
		$nama = urldecode($nama);
		
		if(!empty( $nama ))
		{
			ini_set('max_execution_time', 420); //420 seconds = 7 minutes
			ini_set('memory_limit','2048M');
			
			$url = 'http://172.29.119.99/bb_appl/srv/srv_json_employee.php';	
			$tablename = 'z_employee_list_2';
			
			$split_url = explode("/", $url);			
			$end = end($split_url);
			$s5_cari = array(".php");
			$s5_gantinya   = array(".json");
			$file_name = str_replace($s5_cari, $s5_gantinya, $end);	
			$split_file_name = explode("?", $file_name);
			$file_name = $split_file_name[0];

			/* Target Grabbing */
			// $url = "http://172.29.119.99/bb_appl/srv/srv_json_hcmg_CanJobTitle.php";

			/* -----------------------------------------
			-- step 1 ( Parameter post Data request )
			----------------------------------------- */
			$postdata = http_build_query(
				array(
					'txt_nip_f' => '12057590', //NIP				
				)
			);

			$opts = array('http' =>
				array(
					'method'  => 'POST',
					'header'  => 'Content-type: application/x-www-form-urlencoded',
					'content' => $postdata
				)
			);

			$context  = stream_context_create($opts);

			/* -----------------------------------------
			-- step 2 (Graping element)
			----------------------------------------- */	
			$result = @file_get_contents($url, false, $context);	// get html
			
			if($result === FALSE) {
			// handle error here... 
				$res['status'] = 'error';
				$res['file_name'] = $file_name ;
				
				$result2 =  json_encode($res);
				echo $result2;				
				die;
			}

			/* -----------------------------------------
			-- step 3 (clean atribute html)
			----------------------------------------- */	
			/* replace string 2 */
			$cari2 = array("<html><head>", '<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1"></head><body>', "</body></html>");
			$gantinya2   = array("", "", "");
			$result2 = str_replace($cari2, $gantinya2, $result);	

			
			$valueToCode_2 = $result2;

			/* -----------------------------------------
			-- step 5 (hanya sebagai storage json yg sudah bersih)
			----------------------------------------- */							
			
			$htmlEncode = htmlspecialchars($valueToCode_2, ENT_QUOTES);
			$htmlDecode = htmlspecialchars_decode($htmlEncode);
			$fileNameClean = './assets/download/' . $file_name;
			file_put_contents($fileNameClean, $htmlDecode);		
		
			/* -----------------------------------------
			-- step 6 (status proses)
			----------------------------------------- */	
			$row_data 	= json_decode($htmlDecode, true);		// for Array
			$jmlhRow 	= count($row_data);
			
			$res['status'] = 'done';
			$res['jmlhRow'] = $jmlhRow;
			$res['tablename'] = $tablename;
			$res['file_name'] = $file_name ;
			$res['dir_name'] = $fileNameClean ;
			$res['tgl'] = date('Y-m-d H:i:s');
			
			$result2 =  json_encode($res);
			echo $result2;
		}
	}	
	
	function updating($nama='')
	{
		$nama = urldecode($nama);
		
		if(!empty( $nama ))
		{
			ini_set('max_execution_time', 420); //420 seconds = 7 minutes
			ini_set('memory_limit','2048M');
			
			/* -----------------------------------------
			-- step 9 (saving to database)
			----------------------------------------- */	
			
			$url = 'http://172.29.119.99/bb_appl/srv/srv_json_employee.php';	
			$tablename = 'z_employee_list_2';
			
			$split_url = explode("/", $url);			
			$end = end($split_url);
			$s5_cari = array(".php");
			$s5_gantinya   = array(".json");
			$file_name = str_replace($s5_cari, $s5_gantinya, $end);	
			$split_file_name = explode("?", $file_name);
			$file_name = $split_file_name[0];
			
			$json_link = './assets/download/' . $file_name;
			
		
			/* get */					
			$json2 = @file_get_contents($json_link, false);
			
			/* convert array */					
			$row_data2 	= json_decode($json2, true);		// for Array
			$jmlhRow 	= count($row_data2);					
			
			/* porting system */							
			if(empty($_POST['limit'])){
				$limit = 100;
			}
			else{
				$limit 		= $_POST['limit'];
			}
			if(empty($_POST['new_start'])){
				$new_start = 0;
			}
			else{
				$new_start 	= $_POST['new_start'];	
			}
			
			/* 
				jika jmlh row data ada 7
				limit 3
				maka start = 1
				maka end = start + limit = 4
					exekusi
				maka start selanjutnya = end + 1 = 5
				maka end selanjutnya = start selanjutnya + limit = 8
				
			*/
			
			//set parameter (preparing set parameter)
			$x = $new_start;
			$lm = $limit;
			$jmlh = $jmlhRow;
			$status = 'run';
			$kosong = 0;
			
			/* 
			$x = 0;
			$lm = 3;
			$jmlh = 7;
			$status = 'run';
			$kosong = 0; */
			
			$s = $x + 1;
			$e = $s + $lm;
			
			// chek
			if( $e > $jmlh ){
				// ya
				$s = $s;
				$e = $jmlh;
				//feedback ststus
				$x = 0;
				$sts_loop = 'end';
				
				$status = 'finish';
			}
			else{
				// tdk
				$s = $s;
				$e = $e;
				//feedback ststus
				$x = $e;
				$sts_loop = 'loop';
			}
			
			// execute json data for updating to database
			for ($i = $s; $i <= $e; $i++){
				
				// print_r($row_data2[$i]);
				
				$row2 = $row_data2[$i];	

				if(!empty($row2)){				
					if( $s == 1 ){
						$this->Adminmax_db->empty_table( $tablename );
					}
					foreach($row2 as $row2key => $row2val){
						$val = trim($row2val);	
						
						if(empty($val)){			
							$row2[$row2key]	= null; 		
						}else{
							$row2[$row2key] = $val;
						}
					}
					
					/* Std Proint repair field UpdDate*/
					if(!empty($row2['UpdDate'])){
						$row2['UpdDate'] = date("Y-m-d", strtotime($row2['UpdDate'])); 
					}					
					
					/* Custom Table */
					if( $tablename == 'z_employee_list_2' ){					
						$row2['start_dmy'] = date("Y-m-d", strtotime($row2['start_dmy'])); 
						$row2['birth_dmy'] = date("Y-m-d", strtotime($row2['birth_dmy'])); 				
						$row2['md5_hash'] = md5($row2['nip']); 	
					}					

					$row3[] = $row2;
					
					// $this->Adminmax_db->rev3_insert_employee($row2);				
				}
				else{
					$kosong++;
				}
			}
			
			if(!empty($row3)){		
				$this->Adminmax_db->insert_batch_table($row3, $tablename);
			}

			/* -----------------------------------------
			-- step 10 (status proses)
			----------------------------------------- */	
			$res['x'] = $x;
			$res['limit'] = $lm;
			$res['jmlhRow'] = $jmlh;
			$res['start'] = $s;
			$res['end'] = $e;
			$res['sts_loop'] = $sts_loop;
			$res['status'] = $status;
			
			$result2 =  json_encode($res);
			
			echo $result2;
		}
	}

	function updateNewEmployee()
	{
		/*add register to default course id (33, 23) 
			33_penanganan_pengaduan_2019
			23_anti_fraud
			36_anti_fraud_2019
		
		*/
		$course = array(33, 23);
		$course2 = array(
			"110"=>"33"
			//, "111"=>"23"
			, "118"=>"36"
		);

		//echo '<pre>';
		// print_r( $course );
		//print_r( $course2 );

		foreach($course2 as $key => $val){
		 	$updt['id_jadwal'] = $key;
		 	$updt['id_kursus'] = $val;

			//print_r( $updt );

		 	$this->Adminmax_db->updateNewEmployee($updt);
		}
	}		
		
	

	/* 
		Moodle platform
		- Updating4moodle
		- Curve4moodle
	*/
	function Updating4moodle()	
	{
		$this->Adminmax_db->UpdateDataUserByEmployee();
		$this->updateNewEmployee();
		
		$this->Adminmax_db->empty_employee4moodle();
		$data['result'] = $this->Adminmax_db->miroring_z_employee_list_2();
		
		$this->Adminmax_db->UpdateUserID4moodle();		

		// echo '<pre>';
		// print_r($data);	
		// die;	
	}

	function Curve4moodle(){
		if(!empty($_POST)){
			$data['title'] = 'View map progres';
			$data['active']['dropdown_2'] = ' class="active"';

			// echo '<pre>';
			// print_r($_POST);
			// die;			
			
			$key['scormid'] = $_POST['id_kursus'];
			$key['tahun'] = $_POST['source_by'];
			$key['tgl_mulai'] = $_POST['tgl_mulai'];
			$key['tgl_selesai'] = $_POST['tgl_selesai'];
			
			$kursus = $this->Adminmax_db->kursus($_POST['id_kursus'])[0];
			
			if(!empty($_POST['source_by'])){
				$moodle_count = $this->Adminmax_db->Curve4moodle_newEmployee_count($key);
				$moodle_detail = $this->Adminmax_db->Curve4moodle_newEmployee_detail($key);
				$key['info'] = 'peserta New Employee ('. $key['tahun'] .')';
			}
			else{
				$moodle_count = $this->Adminmax_db->Curve4moodle_allEmployee_count($key);
				$moodle_detail = $this->Adminmax_db->Curve4moodle_allEmployee_detail($key);
				$key['info'] = 'All Employee (all scoes track)';
			}
						
			$chart = $this->Adminmax_db->chartSetData($moodle_count);
			$excel = $this->Adminmax_db->excelSetData($moodle_detail);
			
			$filename = $kursus->shortname . ' ' . $key['info'];
			$excel_file = $this->Adminmax_db->writingExcel($excel, $filename);
			
			$chart_default = array(
				'categories' => '',
				'register' => '',
				'unlogin' => '',
				'unpass' => '',
				'pass' => '',
				'certify' => '',				
				'title' => 'Historic Moodle',
				'subtitle' => 'HCMG File',
			);
			
			foreach($chart as $key2 => $val2){
				if(!empty($val2)){
					$chart_default[$key2] = $val2;
				}
			}
			
			if(!empty($kursus)){
				$chart_default['title'] = 'Historic e-learning ' . $kursus->fullname;
			}			
			
			$data['key'] = $key; 
			$data['kursus'] = $kursus; 
			// $data['moodle_count'] = $moodle_count; 
			$data['chart'] = $chart_default; 
			$data['excel_file'] = $excel_file; 
			
			// echo '<pre>';
			// print_r($data);
			// die;
			
			$this->load->view('admin/adminmax-curve4moodle', $data);	
		}
		else{
			echo 'Oopss no data..!';
		}
	}

	function Curve4moodleCustom($id_kursus='', $id_jadwal='')
	{	
		if( !empty($id_kursus) && !empty($id_jadwal) ){	
		
			$data['title'] = 'View map progres';
			$data['active']['dropdown_2'] = ' class="active"';

			/* get jadwal_training  on key jadwal register */
			$kursus	= $this->Adminmax_db->kursus_id($id_kursus);	
			$data['kursus_id']	= $kursus;
	
			
			$key['id_jadwal'] = $id_jadwal;	
			$key['id_kursus'] = $id_kursus;				
			$jadwal_training	= $this->Adminmax_db->jadwalMoodle($key);
			$data['jadwal_training'] = $jadwal_training;			
			$key['scormid'] = $kursus->idnumber;
			$key['tgl_mulai'] = $jadwal_training->tgl_mulai;
			$key['tgl_selesai'] = $jadwal_training->tgl_selesai;
			
			// echo '<pre>';
			// print_r($data);
			// die;		
			
				$moodle_count = $this->Adminmax_db->Curve4moodleCustom_count($key);
				$moodle_detail = $this->Adminmax_db->Curve4moodleCustom_detail($key);
				$key['info'] = $jadwal_training->keterangan;

						
			$chart = $this->Adminmax_db->chartSetData($moodle_count);
			$excel = $this->Adminmax_db->excelSetData($moodle_detail);
			
			$filename = $kursus->shortname . ' ' . $key['info'];
			$excel_file = $this->Adminmax_db->writingExcel($excel, $filename);
			
			$chart_default = array(
				'categories' => '',
				'register' => '',
				'unlogin' => '',
				'unpass' => '',
				'pass' => '',
				'certify' => '',				
				'title' => 'Historic Moodle',
				'subtitle' => 'HCMG File',
			);
			
			foreach($chart as $key2 => $val2){
				if(!empty($val2)){
					$chart_default[$key2] = $val2;
				}
			}
			
			if(!empty($kursus)){
				$chart_default['title'] = 'Historic e-learning ' . $kursus->fullname;
			}			
			
			$data['key'] = $key; 
			$data['kursus'] = $kursus; 
			// $data['moodle_count'] = $moodle_count; 
			$data['chart'] = $chart_default; 
			$data['excel_file'] = $excel_file; 
			
			// echo '<pre>';
			// print_r($data);
			// die;
			
			$this->load->view('admin/adminmax-curve4moodle', $data);	
		}
		else{
			echo 'Oopss no data..!';
		}
	}

	function Curve4moodle2()
	{
		$array = $this->uri->segment_array();

		$array[3] = urldecode($array[3]);
		$array[4] = urldecode($array[4]);

		$data['title'] = 'View map progres';
		$data['active']['dropdown_2'] = ' class="active"';

		if(!empty($array[4])){
			if($array[4]==='All'){

				$fnd['training'] = $array[3];
				$data['all'] = $this->Adminmax_db->moodle_training($fnd);

				$fnd['fileName'] = $fnd['training'] . ' All';
				$fnd['tahun'] = 'All';

				$data['attr']= $fnd;
				$data['export']= $this->Adminmax_db->moodle_export_all($fnd, $data['all']); 
			}
			else{
				$fnd['training'] = $array[3];
				$fnd['tahun'] = $array[4];
				$data['bytahun'] = $this->Adminmax_db->moodle_training_by_tahun($fnd);

				$fnd['fileName'] = $fnd['training'] . ' ' . $fnd['tahun'];

				$data['attr']= $fnd;
				$data['export']= $this->Adminmax_db->moodle_export($fnd, $data['bytahun']); 
			}

			// echo '<pre>';
			// print_r($array);
			// print_r($data);	
			// die;

			$this->load->view('admin/adminmax-curve-moodle', $data);
		}
	}

	protected function moodle_register(){
		$rw =  $this->Adminmax_db->scoes_track_reg();

		if(!empty($rw)){
			$rtn['result'] = 'ok';
			$rtn['affected'] = $rw;
		}
		else{
			$rtn['result'] = 'error';
			$rtn['affected'] = 0;
		}

		return $rtn;
	}

	protected function moodle_duration(){
		$rw =  $this->Adminmax_db->scoes_track_duration();

		if(!empty($rw)){
			$rtn['result'] = 'ok';
			$rtn['affected'] = $rw;
		}
		else{
			$rtn['result'] = 'error';
			$rtn['affected'] = 0;
		}

		return $rtn;
	}

	protected function moodle_temp(){
		$rw =  $this->Adminmax_db->moodle_temp();

		if(!empty($rw)){
			$rtn['result'] = 'ok';
			$rtn['affected'] = $rw;
		}
		else{
			$rtn['result'] = 'error';
			$rtn['affected'] = 0;
		}

		return $rtn;
	}
	
	
	/* 
		Curve Map
		- Curve
	*/
	function Curve($id_kursus='', $id_jadwal='')
	{	
		if( !empty($id_kursus) && !empty($id_jadwal) ){	
			$find_1['id_kursus'] = $id_kursus;			
			$find_1['id_jadwal'] = $id_jadwal;	

			$data = $find_1;
			$data['title'] = 'View map progres';
			$data['active']['dropdown_2'] = ' class="active"';

			/* get jadwal_training  on key jadwal register */
			$findJadwal	= $this->Adminmax_db->findJadwal($find_1);	
			$data['findJadwal']	= $findJadwal;
			
			/* cari konfigurasi soal */
			$findSoalConfig	= $this->Adminmax_db->findSoalConfig($find_1);		
			
			if(!empty($findSoalConfig)){
				/* convert komponen_soal to Array */
				$findSoalConfig->komponen_soal_2 = json_decode($findSoalConfig->komponen_soal, true);// for Array
				
				/* get jmlh soal from komponen soal */
				$jmlh = 0;
				foreach($findSoalConfig->komponen_soal_2 as $key3 => $val3){
					$jmlh = $jmlh + $val3;
				}				
				$findSoalConfig->jmlh_soal = $jmlh;	

			}			
			$data['findSoalConfig']	= $findSoalConfig;			
			
			/* getDataChart belum sempurna, nightly version */			
			$find_2['id_kursus'] = $id_kursus;			
			$find_2['id_jadwal'] = $id_jadwal;			
			$find_2['jmlh_soal'] = $findSoalConfig->jmlh_soal;			
			$find_2['fileName']  = $findJadwal->kursus;			
			
			$getDataChart = $this->Adminmax_db->getDataChart($find_2);
			$data['getDataChart']	= $getDataChart;	
			if(!empty($getDataChart)){			
				$data['SetData'] = $this->Adminmax_db->chartSetData($getDataChart);
				$data['SetData']['title'] = 'Historic ' .  $findJadwal->kursus;
				$data['SetData']['subtitle'] = 'HCMG File';
			}
			else{
            	$SetData['title']  = '';
            	$SetData['subtitle']  = '';
            	$SetData['categories']  = '';
            	$SetData['register'] = '';
            	$SetData['unlogin'] = '';
            	$SetData['unpass'] = '';
            	$SetData['pass'] = '';
            	$SetData['certify'] = '';
				
            	$data['SetData']  = $SetData;
			}
						
			// $data['CurveExport']= $this->Adminmax_db->CurveExport($find_2);
			
			/* agak berat karena ngeload durasi materi */
			$data['CurveExport']= $this->Adminmax_db->CurveExport_rev2($find_2); 
			
			// echo '<pre>';
			// print_r($data);	
			// die;	
			
			$this->load->view('admin/adminmax-curve', $data);	
		}
		else{
			echo 'Oopss no data..!';
		}
	}

	
	
	/* 
		for debuging
		- hanarafidah
	*/
	function hanarafidah()
	{
		echo '<pre>';
		echo 'Eknowledge Library Debuging';
		echo '<br>';
		echo '<br>';
		
		print_r($_SESSION);
		
		//unset($_SESSION['cart']); 
		// unset( $_SESSION['ek']); 		
	}	
	
	

	/* 
		General function
		- ses_destroy
		- Logout
		- SignOut
		- nocache
	*/	
	function ses_destroy()
	{
		session_destroy();
		
		redirect('/welcome/hanarafidah/', 'refresh');
	}
	
	function Logout()
	{
		session_destroy();
		
		redirect('/welcome', 'refresh');
	}
	
	function SignOut()
	{
		session_destroy();
		
		redirect('/welcome', 'refresh');
	}	

	function nocache() 
	{
		// CodeIgniter Framework version:
		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');

/* 		// PHP version:
		header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		header('Cache-Control: no-store, no-cache, must-revalidate');
		header('Cache-Control: post-check=0, pre-check=0',false);
		header('Pragma: no-cache');		 */
    }
	
	

}

/* End of file adminmax.php */
/* Location: ./application/controllers/adminmax.php */
