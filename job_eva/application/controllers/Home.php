<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {



	public function __construct()
    {
        parent::__construct();
        $this->load->model("user_model");
		$this->user_model->check_isvalidated();
	}
	
	public function index()
	{
		$data['userlogin']		= $this->session->userdata("username");

		$datauser 				= $data['userlogin'];
		$data['userdetail']		= $this->user_model->user_detail($datauser);
		$data['listposisi']		= $this->user_model->listAllJob($datauser);

		$this->load->view('tmp/header', $data);
		$this->load->view('tmp/leftmenu', $data);
		$this->load->view('content', $data);
		// $this->load->view('tmp/rightmenu');
		$this->load->view('tmp/footer');
		//$this->load->view('welcome', $data);
	}

	public function soalkuesioner($id)
	{
		$data['userlogin']		= $this->session->userdata("username");

		$datauser 				= $data['userlogin'];
		$data['userdetail']		= $this->user_model->user_detail($datauser);

		$data['soal'] 			= $this->user_model->listSoal();
		
		$this->load->view('tmp/header', $data);
		$this->load->view('tmp/leftmenu', $data);
		$this->load->view('content-soal', $data);
		// $this->load->view('tmp/rightmenu');
		$this->load->view('tmp/footer');
		//$this->load->view('welcome', $data);

	}
	/*
	public function soalshow()
	{
		//$data['listsoal']		= $this->user_model->listSoal();
		$get_soal = $this->user_model->listSoal();
		echo json_encode($get_soal); 
		exit();
	}

	public function jumlahSoal()
	{
		$get_jml_soal 	= $this->user_model->jumlahSoal();
		return $get_jml_soal;
	}
	*/
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */