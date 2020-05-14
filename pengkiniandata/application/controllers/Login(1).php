<?php

class Login extends CI_Controller{
 
	function __construct(){
		parent::__construct();		
		$this->load->model('m_login');
 
	}
 
	function index(){
		$this->load->view('login_page');
	}
 
	function aksi_login(){
        $this->load->library('form_validation');
        
		$username = mysql_real_escape_string($this->input->post('username'));
        $password = mysql_real_escape_string($this->input->post('password'));
        

		$where = array(
			'username' => $username,
			'password' => md5($password)
			);
		$cek = $this->m_login->cek_login("tbl_user",$where)->num_rows();
		if($cek > 0){
 
			$data_session = array(
				'nama' => $username,
				'status' => "login"
				);
 
			$this->session->set_userdata($data_session);
 
			redirect(base_url("welcome","refresh"));
 
		}else{
			echo "password salah / User tidak terdaftar!";
		}
	}
 
	function logout(){
		$this->session->sess_destroy();
		redirect(base_url('login'));
	}
}