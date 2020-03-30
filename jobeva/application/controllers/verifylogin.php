<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class VerifyLogin extends CI_Controller
{
	function __construct()
	{
	  parent::__construct();
	  $this->load->model('loginmodel','',TRUE);
	}

	function index()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');

		if($this->form_validation->run()== FALSE )
		{
			$this->load->view("login");
		}
		else
		{
			redirect('home','refresh');
		}
	}

	function check_database($password)
	{
		$username = $this->input->post('username');
		
		$result = $this->loginmodel->login($username, $password);
		
		if($result)
		{
			$sess_array = array();
			foreach ($result as $row) 
			{
				$sess_array = array(
					'id_user' => $row->id_user,
					'username' => $row->username,
				);
				
				$this->session->set_userdata('logged_in', $sess_array);
			}
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('check_database', 'Invalid Username And Password');
			return false;
		}
	}

	function check_isvalidated(){

		$this->load->library('session');
        if(! $this->session->userdata('logged_in')){
            redirect('welcome');
        }
    }
	
	
	function logout()
	{
		session_start(); 
		$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect('welcome', 'refresh');
	}
}

/*

$userLogin    			= $this->session->userdata('logged_in');
$data['userlogin']		= $userLogin['username'];
$data['id_user']		= $userLogin['id_user'];



if( $this->session->userdata('logged_in') ) {
	$this->load->view('temp/header2',$data);
} else {
	$this->load->view('temp/header');
} 

*/
?>
