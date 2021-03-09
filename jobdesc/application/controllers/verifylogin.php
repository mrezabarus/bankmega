<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Verifylogin extends CI_Controller
{
	function __construct()
	{
	  parent::__construct();
	  $this->load->model('modeldb','',TRUE);
	  $this->load->library('session');
	}

	function index()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');
		// $test =  $this->form_validation->run();
		// echo $test;
		if($this->form_validation->run()== null )
		{
			//$data['planet'] = $this->user_model->jenjang_pendidikan();
			?>
			<script>
			alert("Username tidak terdaftar...");
			</script>
			<?php
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
		
		
		$result = $this->modeldb->login($username, $password);
		
		if($result)
		{
			
			$sess_array = array();
			foreach ($result as $row) 
			{
				//echo $row->id_user;
				$sess_array = array(
					
					'id' => $row->id_user,
					'username' => $row->username,
					'status'=> 'login',
					'id_group'=> $row->id_group,
					'group_name'=>$row->group_status,
					'id_group_menu'=>$row->id_group_menu,
				);
				$group_name = $row->group_status;
				$this->session->set_userdata($sess_array);
				
			}
			if($group_name=="admin"){
				redirect('admin/home','refresh');
			}
			else{
				redirect('home','refresh');
			}
			//return TRUE;
			
		}
		else
		{
			//echo "Username dan password salah !";
			$this->form_validation->set_message('check_database', 'Invalid Username And Password');
			//return false;
		}
		echo $result;
	}

	private function check_isvalidated(){

		$this->load->library('session');
        if(! $this->session->userdata('logged_in')){
            redirect('login');
        }
    }
	
	
	function logout(){
		$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect('welcome', 'refresh');

		
	}
}
?>
