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
		//$data['listposisi']		= $this->user_model->listAllJob($datauser);

		
		
		$this->load->view('tmp/header', $data);
		$this->load->view('tmp/leftmenu', $data);
		$this->load->view('content', $data);
		// $this->load->view('tmp/rightmenu');
		$this->load->view('tmp/footer');
		//$this->load->view('welcome', $data);
	}

	// public function soalkuesioner($id)
	// {
	// 	$data['userlogin']		= $this->session->userdata("username");

	// 	$datauser 				= $data['userlogin'];
	// 	$data['userdetail']		= $this->user_model->user_detail($datauser);

	// 	$data['namakuesioner']	= $this->user_model->nama_kuesioner(); //nama table kuesioner
	// 	$data['soalkuesioner']	= $this->user_model->soal_kuesioner(); //nama table kuesioner

	// 	$tableSoal				= $this->user_model->view_tbl_soal();
		
	// 	//$data['tableSoal']		= $tableSoal;
	// 	if(!empty($tableSoal)){
	// 		foreach ($tableSoal as $key => $value) {
	// 			//echo $value->table_soal; 
	// 			$namaTable = $value->table_soal;
	// 			$data['soal_detail'] 	= $this->user_model->detail_soal($namaTable);
	// 		}
	// 	}
		
	// 	$this->load->view('tmp/header', $data);
	// 	$this->load->view('tmp/leftmenu', $data);
	// 	$this->load->view('content-soal(dua)', $data);
	// 	// $this->load->view('tmp/rightmenu');
	// 	$this->load->view('tmp/footer');
	// 	//$this->load->view('welcome', $data);

	// }

	public function soalkuesioner($id)
	{
		$data['userlogin']		= $this->session->userdata("username");

		$datauser 				= $data['userlogin'];
		$data['userdetail']		= $this->user_model->user_detail($datauser);

		//$data['namakuesioner']	= $this->user_model->nama_kuesioner(); //nama table kuesioner
		$data['soalkuesioner1']	= $this->user_model->soal_kuisioner_1(); //nama table kuesioner
		$data['soalkuesioner2']	= $this->user_model->soal_kuisioner_2(); //nama table kuesioner

		$this->load->view('tmp/header', $data);
		$this->load->view('tmp/leftmenu', $data);
		$this->load->view('content-soal(dua)', $data);
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