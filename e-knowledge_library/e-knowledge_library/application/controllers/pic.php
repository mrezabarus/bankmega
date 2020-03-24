<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pic extends CI_Controller {

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
			if($_SESSION['status']==='pic' && !empty($_SESSION['lbrary_nip'])){
				$this->load->model('Pic_db');
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
		Pic Display
		- index		-> Home			
        - CekRegister 		
        - LearningMonitor	
        - JadwalTraining
        - EmployeeList
        - About		
	*/
	function index()
	{	
		$data['title'] = 'Person in Charge';
		
		$user 			= $_SESSION['name2lwr'];		
		
		$this->load->view('pic/adminmax-index.php', $data);
	}	
	
	function CekRegister()
	{
		$data['title'] = 'Cek Register';		
		
		$this->load->view('pic/adminmax-cekregister.php', $data);		
	}
	
	function LearningMonitor()
	{
		$data['title'] = 'Learning Monitor';		
		
		$this->load->view('pic/adminmax-learningmonitor.php', $data);		
	}
	
	function JadwalTraining()
	{
		$data['title'] = 'Jadwal Training';
		$data['result'] = $this->Pic_db->JadwalTraining();			
		$data['findSoalConfig'] = $this->Pic_db->findSoalConfig();	
		
		// $this->load->view('pic/adminmax-jadwaltraining-old', $data);	 //old	
		$this->load->view('pic/adminmax-jadwaltraining', $data);
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
		$data['kursus'] = $this->Pic_db->moodle_kursus();
		$data['tahun'] = $this->Pic_db->moodle_tahun_kursus();
		
		// echo '<pre>';
		// print_r($data);	
		// die;	
		
		$this->load->view('pic/adminmax-moodlereport-2', $data);	
	}		

	function EmployeeList()
	{
		$data['title'] = 'Employee List';
		
		$this->load->view('pic/adminmax-employeelist', $data);	
	}
	
	function About()
	{
		$data['title'] = 'About of System';			
		
		$this->load->view('admin/adminmax-about', $data);		
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
				$data['all'] = $this->Pic_db->moodle_training($fnd);

				$fnd['fileName'] = $fnd['training'] . ' All';
				$fnd['tahun'] = 'All';

				$data['attr']= $fnd;
				$data['export']= $this->Pic_db->moodle_export_all($fnd, $data['all']); 
			}
			else{
				$fnd['training'] = $array[3];
				$fnd['tahun'] = $array[4];
				$data['bytahun'] = $this->Pic_db->moodle_training_by_tahun($fnd);

				$fnd['fileName'] = $fnd['training'] . ' ' . $fnd['tahun'];

				$data['attr']= $fnd;
				$data['export']= $this->Pic_db->moodle_export($fnd, $data['bytahun']); 
			}

			// echo '<pre>';
			// print_r($array);
			// print_r($data);	
			// die;

			$this->load->view('admin/adminmax-curve-moodle', $data);
		}
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
			$result = $this->Pic_db->eknowledgeRegister($nip, $limit);			
			if(!empty($result)){
				$data['detail'] = 'http://172.29.119.99/bb_appl/pbl/pbl_detail_tag.php?nip=';
				$data['result'] = $result;				
				// echo '<pre>';
				// print_r($result);	
				// die;					
				$this->load->view('pic/print-register', $data);	
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
		
			echo $this->Pic_db->GETiduserORusername($_GET['term']);
			
		}
		elseif(!empty($_POST['id'])){	
			
			$nip = trim( $_POST['id'] );
			$nip = substr($nip, 0, 9);	
			$nip = trim( $nip );
			
			$rowdata['eknowledge'] = $this->Pic_db->eknowledgeMonitor($nip);
			
			if(empty($_SESSION['picArea'])){
				$rowdata['moodle'] = $this->Pic_db->LearningMonitor4moodle($nip);
			}
			
	
			// echo '<pre>';
			// print_r($rowdata);	
			// die;
			
			if(!empty($rowdata)){
				$data['detail'] = 'http://172.29.119.99/bb_appl/pbl/pbl_detail_tag.php?nip=';
				$data['rowdata'] = $rowdata;	
				$this->load->view('pic/print-eknowledgemonitor', $data);	
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
			$result = $this->Pic_db->employeeList($nip, $limit);			
			if(!empty($result)){
				$data['detail'] = 'http://172.29.119.99/bb_appl/pbl/pbl_detail_tag.php?nip=';		
				$data['result'] = $result;				
				// echo '<pre>';
				// print_r($result);	
				// die;					
				$this->load->view('pic/print-employeeList', $data);	
			}
			else{
				echo 'data not found / no registered';
			}			
		}
		else{
			echo 'Oopss no data..!';
		}		
	}		

	protected function moodle_register(){
		$rw =  $this->Pic_db->scoes_track_reg();

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
		$rw =  $this->Pic_db->scoes_track_duration();

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
		$rw =  $this->Pic_db->moodle_temp();

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
		
		if(!empty($_SESSION['picArea'])){			
			$picArea = $_SESSION['picArea'];
			
			if($id_kursus!=$picArea){
				echo 'Halaman yang Anda coba kunjungi dilarang diakses. ';
				die;
			}
		}
		
		if( !empty($id_kursus) && !empty($id_jadwal) ){	
			$find_1['id_kursus'] = $id_kursus;			
			$find_1['id_jadwal'] = $id_jadwal;	

			$data = $find_1;
			$data['title'] = 'View map progres';
			$data['active']['dropdown_2'] = ' class="active"';

			/* get jadwal_training  on key jadwal register */
			$findJadwal	= $this->Pic_db->findJadwal($find_1);	
			$data['findJadwal']	= $findJadwal;
			
			/* cari konfigurasi soal */
			$findSoalConfig	= $this->Pic_db->findSoalConfig($find_1);		
			
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
			
			$getDataChart = $this->Pic_db->getDataChart($find_2);
			$data['getDataChart']	= $getDataChart;	
			if(!empty($getDataChart)){			
				$data['SetData'] = $this->Pic_db->chartSetData($getDataChart);
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
						
			// $data['CurveExport']= $this->Pic_db->CurveExport($find_2);
			
			/* agak berat karena ngeload durasi materi */
			$data['CurveExport']= $this->Pic_db->CurveExport_rev2($find_2); 
				
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

/* End of file pic.php */
/* Location: ./application/controllers/pic.php */
