<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Region extends CI_Controller {

	/**
	 * khusus untuk PIC Admin
	 * 
	 * & special thanks to Hana rafidah
	 */
	public function __construct()
	{
		parent::__construct();
		// Your own constructor code

		session_start();
		if(isset($_SESSION['status'])){
			if($_SESSION['status']==='region' && !empty($_SESSION['lbrary_nip'])){
				$this->load->model('Region_db');
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
		Region Display
		- index		-> Home			
        - CekRegister 		
        - LearningMonitor	
        - JadwalTraining
        - EmployeeList
        - About		
	*/
	function index()
	{	
		$data['title'] = 'Admin Regional';
		
		$user 			= $_SESSION['name2lwr'];		
		
		$this->load->view('region/adminmax-index.php', $data);
	}	
	
	function CekRegister()
	{
		$data['title'] = 'Cek Register';		
		
		$this->load->view('region/adminmax-cekregister.php', $data);		
	}
	
	function LearningMonitor()
	{
		$data['title'] = 'Learning Monitor';		
		
		$this->load->view('region/adminmax-learningmonitor.php', $data);		
	}
	
	function JadwalTraining()
	{
		$data['title'] = 'Jadwal Training';
		$data['result'] = $this->Region_db->JadwalTraining();			
		$data['findSoalConfig'] = $this->Region_db->findSoalConfig();	
		
		// $this->load->view('region/adminmax-jadwaltraining-old', $data);	 //old	
		$this->load->view('region/adminmax-jadwaltraining', $data);
	}		

	function EmployeeList()
	{
		$data['title'] = 'Employee List';
		
		$this->load->view('region/adminmax-employeelist', $data);	
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
		-  findEmployeeList
	*/
	function eknowledgeRegister() //srv for Cek Register
	{
		if($_POST){			
			$nip	=	trim( $_POST['nip']);
			$limit = 20;			
			$result = $this->Region_db->eknowledgeRegister($nip, $limit);			
			if(!empty($result)){
				$data['detail'] = 'http://172.29.119.99/bb_appl/pbl/pbl_detail_tag.php?nip=';
				$data['result'] = $result;				
				// echo '<pre>';
				// print_r($result);	
				// die;					
				$this->load->view('region/print-register', $data);	
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
		
			echo $this->Region_db->GETiduserORusername($_GET['term']);
			
		}
		elseif(!empty($_POST['id'])){	
			
			$nip = trim( $_POST['id'] );
			$nip = substr($nip, 0, 9);	
			$nip = trim( $nip );
			
			$rowdata['eknowledge'] = $this->Region_db->eknowledgeMonitor($nip);
			
			if(empty($_SESSION['picArea'])){
				$rowdata['moodle'] = $this->Region_db->LearningMonitor4moodle($nip);
			}
			
	
			// echo '<pre>';
			// print_r($rowdata);	
			// die;
			
			if(!empty($rowdata)){
				$data['detail'] = 'http://172.29.119.99/bb_appl/pbl/pbl_detail_tag.php?nip=';
				$data['rowdata'] = $rowdata;	
				$this->load->view('region/print-eknowledgemonitor', $data);	
			}
			else{
				echo 'data not found / no registered';
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
			$result = $this->Region_db->employeeList($nip, $limit);			
			if(!empty($result)){
				$data['detail'] = 'http://172.29.119.99/bb_appl/pbl/pbl_detail_tag.php?nip=';		
				$data['result'] = $result;				
				// echo '<pre>';
				// print_r($result);	
				// die;					
				$this->load->view('region/print-employeeList', $data);	
			}
			else{
				echo 'data not found / no registered';
			}			
		}
		else{
			echo 'Oopss no data..!';
		}		
	}		
	

	
	/* 
		Curve Map
		- Curve
	*/
	function Curve($id_kursus='', $id_jadwal='')
	{			
		
		if(!empty($_SESSION['picArea'])){			
			$picArea = $_SESSION['picArea'];
			
		}
		
		if( !empty($id_kursus) && !empty($id_jadwal) ){	
			$find_1['id_kursus'] = $id_kursus;			
			$find_1['id_jadwal'] = $id_jadwal;	

			$data = $find_1;
			$data['title'] = 'View map progres';
			$data['active']['dropdown_2'] = ' class="active"';

			/* get jadwal_training  on key jadwal register */
			$findJadwal	= $this->Region_db->findJadwal($find_1);	
			$data['findJadwal']	= $findJadwal;
			
			/* cari konfigurasi soal */
			$findSoalConfig	= $this->Region_db->findSoalConfig($find_1);		
			
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
			$find_2['region']  = $_SESSION['picArea'];			
			
			$getDataChart = $this->Region_db->getDataChart($find_2);
			$data['getDataChart']	= $getDataChart;	
			if(!empty($getDataChart)){			
				$data['SetData'] = $this->Region_db->chartSetData($getDataChart);
				$data['SetData']['title'] = 'Report of ' .  $findJadwal->kursus;
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
						
			// $data['CurveExport']= $this->Region_db->CurveExport($find_2);
			
			/* agak berat karena ngeload durasi materi */
			$data['CurveExport']= $this->Region_db->CurveExport_rev2($find_2); 
				
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

/* End of file region.php */
/* Location: ./application/controllers/region.php */