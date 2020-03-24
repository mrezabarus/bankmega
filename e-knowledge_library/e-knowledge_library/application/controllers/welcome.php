<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	 
	public function __construct()
	{
		parent::__construct();
		// Your own constructor code

		//set session tidak menggunakan dari CI karena akan di gunakan secara global
		session_start();		
	}


	/* 
		Welcome
		- index
		- Peserta
		- signIn
		- EditProfile
		- KalenderTraining
		- ChangePassword
	*/		
	function index($id='')
	{
		$getBrowser = $this->Model_db->getBrowser();
		// $user		= $this->session->userdata('user');
				
		if( $getBrowser['name'] == 'Internet Explorer' && $getBrowser['version'] == '6.0' ){
			/* display for ie browser */
			$this->load->view('welcome-download');
		}
		else{
			/* display for recomended browser */
			$this->Peserta();
		}	
		
		/* switching module */
		if($id=='jack'){
			echo 'e-knowledge_library debug enable...  Have a nice day Tn. jack';
		}
		elseif(empty($_SESSION['lbrary_nip'])){		
			$this->SwitchOnOff();
		}		
	}
	
	function Peserta($id='',$signSts='')
	{
		$row['title'] = 'Eknowledge Library';
		$row['server'] = "http://".$_SERVER['HTTP_HOST'].'/';
		
		/* sign status */
		$row['signSts'] = $signSts;
		
		$id = trim(urldecode($id));
		$row['active'] = $id;
		
		/* for control item */
		$row['control'] = array(
			"date" => "Issue date",
			"name" => "Name"
		);
		
		/* for sidebar item */
		$sidebar = $this->Model_db->eknowledgeParticipant();
		foreach( $sidebar as $row2 ){
			$peserta[$row2->peserta] = $row2->kursus;
		}
		$row['peserta'] = $peserta;
		
		/* for content item */
		$content = $this->Model_db->eknowledgeLibrary();
		foreach( $content as $row4 ){
			$content2[$row4->id_kursus] = $row4;
		}
		/* $row['content'] = $content2; */
		
		
		
		/* 
			by request 	
			e-Learning Modul wajib dikerjakan ada di urutan atas			
		*/
		$cAx = explode(",", $peserta['All Employee']);
		foreach( $cAx as $rcAx ){
			$idcAx = trim($rcAx);
			if(!empty( $content2[$idcAx] )){
				$content3[$idcAx] = $content2[$idcAx];			
			}

		}		
		foreach( $content2 as $row5 ){
			if(empty($content3[$row5->id_kursus])){
				$content3[$row5->id_kursus] = $content2[$row5->id_kursus];
			}
		}
		
		$content2 = $content3;		
		
		/* for contentActive2 item */
		if(!empty($peserta[$id])){			
			$contentActive = explode(",", $peserta[$id]);		
			rsort($contentActive);
			/* $row['contentActive'] = $contentActive;	 */ 
			//selected for contentActive2
			foreach( $contentActive as $row3 ){
				$id_kursus = trim($row3);
				if(!empty($content2[$id_kursus])){
					$contentActive2[$id_kursus] = $content2[$id_kursus];
				}			
			}
			$row['contentActive2'] = $contentActive2;
			
			if($id=='All Eknowledge'){
				$row['contentActive2'] = $content2;
			}
			$row['sidebarActive'] = $id;
		}
		else{
			$row['contentActive2'] = $content2;
		}		
		
		// echo '<pre>';
		// print_r($row);
		// die;
		
		$this->load->view('welcome_rev_5', $row);
	}
	
	function signIn()
	{	
		$row['title'] = 'Sign In';
		
		if(!empty($_POST)){
			foreach($_POST as $key => $value ){
				/* anti SQL Injection */
				if($key == 'username'){
					$key = 'ID_USER';
				}
				elseif($key == 'password'){
					$key = 'PASSWORD';
					$value = md5( $value );
				}
				
				$safe_variable[$key] = mysql_real_escape_string($value);
			}	
			
			$result = $this->Model_db->SignIn($safe_variable);
			
			if(!empty($result)){				
				$set = array('ID_USER','USER_NAME','GENDER','NO_TELP','EMAIL', 'status');
				
				$user = new stdclass;
				foreach($set as $rdata){
					if($rdata=='status'){
						$sts = explode(" ", $result->$rdata);
						
						if(!empty($sts[0])){
							$status = $sts[0];	
							$_SESSION[$rdata] = $status;							
						}
						if(!empty($sts[1])){
							$picArea = $sts[1];
							$_SESSION['picArea'] = $picArea;
						}
					}
					else{
						$user->$rdata = $result->$rdata;
						$_SESSION[$rdata] = $result->$rdata;
					}
				}
				
				$_SESSION['name2lwr'] = ucwords(strtolower( $result->USER_NAME ));
				
				/* general set */				
				$set2 = array(
					'lbrary_nip'=>$result->ID_USER
					,'lbrary_name'=>$result->USER_NAME
					,'lbrary_gender'=>$result->GENDER
					,'lbrary_email'=>$result->EMAIL
				);
				
				// echo '<pre>';	
				// print_r($set2);
				// die;
				
				foreach($set2 as $key2 => $val2){
					$_SESSION[$key2] = $val2;
				}
								
				// login berhasil 
				// echo 'sukses';
				
				/* setVisitor */
				$this->Model_db->setVisitor();
				
				redirect('/welcome', 'refresh');
			}
			else{
				// $row['invalid'] = '<p class="f_error">Oops.. sorry user name or password invalid.</p>';
				// $this->load->view('signin', $row);
				$this->Peserta('',false);
			}			
		}
		else{
			// $this->load->view('signin', $row);
			redirect('/welcome', 'refresh');
		}		
	}
		
	function EditProfile()
	{
		if(empty($_SESSION['lbrary_nip'])){
			redirect('/welcome', 'refresh');
		}
		
		$data['title'] = 'Profile Settings';
		$data['row'] = $this->Model_db->GetProfile();
		$data['start_dmy2'] = $this->Model_db->HariBulanID($data['row']->start_dmy);
		
		
			// echo '<pre>';	
			// print_r($data);
			// die;
		
		$this->load->view('editprofile', $data);	
	}
	
	function KalenderTraining()
	{
		if(empty($_SESSION['lbrary_nip'])){
			redirect('/welcome', 'refresh');
		}
		$data['title'] = 'Kalender Training';
		
		$this->load->view('kalendertraining', $data);
	}
	
	function ChangePassword()
	{	
		if(empty($_SESSION['lbrary_nip'])){
			redirect('/welcome', 'refresh');
		}
		
		$data['title'] = 'Change Password';
		$data['active']['changepassword'] = ' class="active"';
		$data['ChangePassword'] = '';
		$data['CurrentPassword'] = '';
		$data['inputPassword'] = '';
		$data['ConfirmPassword'] = '';
		
		if(!empty($_POST)){
			// echo '<pre>';	
			// print_r($_POST);
			
			foreach($_POST as $key => $value ){
			
				if(empty($value)){
					$data[$key] = 'false';				
				}
				
				/* anti SQL Injection */	
				if($key == 'CurrentPassword'){
					$key = 'PASSWORD';
					$value = md5( $value );
				}
				else{
					$value = md5( $value );
				}				
				
				$safe_variable[$key] = mysql_real_escape_string($value);
			}		
			
			if($safe_variable['inputPassword'] === $safe_variable['ConfirmPassword'] && $data['inputPassword'] != 'false'){
			
				$datarow['ID_USER'] = $_SESSION['ID_USER'];
				$datarow['PASSWORD'] = $safe_variable['PASSWORD'];				
				/* search on database */
				$result = $this->Model_db->SignIn($datarow);
				
				if(!empty($result)){
				
					/* Update password */
					$updateData = array(
					   'PASSWORD' => $safe_variable['inputPassword'],
					   'trackPwd' => $result->trackPwd . ', ' . $_POST['inputPassword']
					);	
					$this->Model_db->UpdatePwd($result->ID_USER, $updateData);

					// echo '<pre>';	
					// print_r($updateData);
					
					$data['ChangePassword'] = 'true';
				}
				else{
					$data['CurrentPassword'] = 'false';
				}				
			}
			else{
				$data['inputPassword'] = 'false';
				$data['ConfirmPassword'] = 'false';
			}
			
			// echo '<pre>';	
			// print_r($data);			
			// die;
			
			$this->load->view('menu-change-password', $data);					
		}
		else{			
			$this->load->view('menu-change-password', $data);		
		}
	}	
	
	
	/* 
		for debuging
		- hanarafidah
		- ses_destroy
		- Logout
		- SignOut
	*/
	function hanarafidah()
	{
		echo '<pre>';
		echo 'Eknowledge Library Debuging';
		echo '<br>';
		echo '<br>';
		
		print_r($_SESSION);
		
		$ss = "pic";
		print_r(explode(" ",$ss));
		
		//unset($_SESSION['cart']); 
		// unset( $_SESSION['ek']); 		
	}
	
	function SwitchOnOff()
	{
		$server_addr = $_SERVER['SERVER_ADDR'];
		$server_saya = $_SERVER['HTTP_HOST'];
		$root2 = str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);			
			
		$row = $this->Model_db->cleanGetServerCondition();
		
		if(!empty( $row )){
			$server_sts = $row['server_sts'];
			
			$row2 = $row['row2'];
			$count_of_load = $row['count_of_load'];
			$server_sts = $row['server_sts'];
			$ip_server_limit = $row['ip_server_limit'];	
			
			
			if(empty($server_sts[$server_addr])){
				//echo 'Switch Off ';//stay, no redirect
				echo '<!-- Switch Off 1 -->';
			}
			elseif($row2[0]->ip_server == $server_addr){
				//echo 'Switch On - self server on top rank';//stay, no redirect
				echo '<!-- Self server 2 , Switch On - self server on top rank -->';
			}
			elseif(empty( $row2[1] )){
				echo 'Switch On - redirect to top rank';	
				header( 'Location: http://' . $row2[0]->ip_server . $row2[0]->port2 . $root2 );
			}
			else{		
				/* blum kelar ide'y */
				echo 'Switch On - redirect to top rank';	
				header( 'Location: http://' . $row2[0]->ip_server . $row2[0]->port2 . $root2 );
				
			}			
		}
		else{
			echo '<!-- Switch Off 0 -->';
		}
	}
	
	function cleanServer()
	{
		echo '<pre>';
		echo 'cleanServerCondition';
		echo '<br>';
		
		print_r( $this->Model_db->cleanServerCondition() );
	}
	
	function ses_destroy()
	{
		session_destroy();
		
		redirect('/welcome/hanarafidah/', 'refresh');
	}
	
	function Logout()
	{
		session_destroy();
		$this->session->sess_destroy();//ok	
		
		redirect('/welcome', 'refresh');
	}
	
	function SignOut()
	{
		session_destroy();
		$this->session->sess_destroy();//ok	
		
		redirect('/welcome', 'refresh');
	}
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */