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
		$data['jenjang']		= $this->user_model->jenjang_pendidikan();
		$data['institusi']		= $this->user_model->nama_institusi();
		$data['jurusan']		= $this->user_model->jurusan();
		$data['gelar']			= $this->user_model->gelar();
		
		
		$this->load->view('tmp2/header', $data);
		$this->load->view('tmp2/leftmenu', $data);
		$this->load->view('content2', $data);
		// $this->load->view('tmp/rightmenu');
		$this->load->view('tmp2/footer');
		//$this->load->view('welcome', $data);
	}

	public function detail()
	{
		$data['userlogin']		= $this->session->userdata("username");

		$datauser 				= $data['userlogin'];
		$data['userdetail']		= $this->user_model->user_detail($datauser);
		//$data['listposisi']		= $this->user_model->listAllJob($datauser);
		$data['jenjang']		= $this->user_model->jenjang_pendidikan();
		$data['institusi']		= $this->user_model->nama_institusi();
		$data['jurusan']		= $this->user_model->jurusan();
		$data['gelar']			= $this->user_model->gelar();
		
		
		$this->load->view('tmp2/header', $data);
		$this->load->view('tmp2/leftmenu', $data);
		$this->load->view('detail2', $data);
		// $this->load->view('tmp/rightmenu');
		$this->load->view('tmp2/footer');
		//$this->load->view('welcome', $data);
	}

	function data_pendidikan(){
		$data['userlogin']		= $this->session->userdata("username");

		$datauser 				= $data['userlogin'];

        $data=$this->user_model->pendidikanList($datauser);
        echo json_encode($data);
	}

	function get_pendidikan(){
		$id=$this->input->get('id');
        $data=$this->user_model->get_pendidikan_by_code($id);
        echo json_encode($data);
	}

	function savePendidikan()
	{
		//$judul= $this->input->post('judul');
		$jenjang_pendidikan		=	$this->input->post('jenjang_pendidikan');
		$otherpen				=	$this->input->post('otherpen');
		$nama_institusi			=	$this->input->post('nama_institusi');
		$otherins				=	$this->input->post('otherins');
		$studi					=	$this->input->post('studi');
		$otherstd				=	$this->input->post('otherstd');
		$gelar					=	$this->input->post('gelar');
		$otherglr				=	$this->input->post('otherglr');

		$tglmasuk				=	$this->input->post('tglmasuk');
		$tgllulus				=	$this->input->post('tgllulus');

		$ntglmasuk 				= 	date("Y-m-d", strtotime($tglmasuk));
		$ntgllulus 				= 	date("Y-m-d", strtotime($tgllulus));

		if($jenjang_pendidikan=='oth'){
			$inpjen				= $otherpen;
		}
		else{
			$inpjen				= $jenjang_pendidikan;
		}

		if($nama_institusi == 'oth'){
			$inpins				= $otherins;
		}
		else{
			$inpins				= $nama_institusi;
		}

		if($studi	== 'oth'){
			$inpstd 			= $otherstd;
		}
		else{
			$inpstd 			= $studi;
		}

		if($gelar == 'oth'){
			$inpglr 			= $otherglr;
		}
		else{
			$inpglr 			= $gelar;
		}

		$data['userlogin']		= $this->session->userdata("username");

		$datauser 				= $data['userlogin'];

		$result= $this->user_model->savependidikan($ntglmasuk,$ntgllulus,$inpjen,$inpins,$inpstd,$inpglr,$datauser);
		echo json_decode($result);
	}


	function update_pendidikan()
	{
		//$judul= $this->input->post('judul');
		$id 					= 	$this->input->post('id');
		$jenjang_pendidikan		=	$this->input->post('jenjang_pendidikan_upd');
		$otherpen				=	$this->input->post('otherpen_upd');
		$nama_institusi			=	$this->input->post('nama_institusi_upd');
		$otherins				=	$this->input->post('otherins_upd');
		$studi					=	$this->input->post('studi_upd');
		$otherstd				=	$this->input->post('otherstd_upd');
		$gelar					=	$this->input->post('gelar_upd');
		$otherglr				=	$this->input->post('otherglr_upd');

		$tglmasuk				=	$this->input->post('tglmasuk_upd');
		$tgllulus				=	$this->input->post('tgllulus_upd');

		$ntglmasuk 				= 	date("Y-m-d", strtotime($tglmasuk));
		$ntgllulus 				= 	date("Y-m-d", strtotime($tgllulus));

		if($jenjang_pendidikan=='' || $nama_institusi=='' || $studi=='' || $gelar==''){
			
		}

		if($jenjang_pendidikan=='oth'){
			$inpjen				= $otherpen;
		}
		// else if($jenjang_pendidikan==''){
		// 	$inpjen				= $otherpen;
		// }
		else{
			$inpjen				= $jenjang_pendidikan;
		}

		if($nama_institusi == 'oth'){
			$inpins				= $otherins;
		}
		// else if($nama_institusi == ''){
		// 	$inpins				= $otherins;
		// }
		else{
			$inpins				= $nama_institusi;
		}

		if($studi	== 'oth'){
			$inpstd 			= $otherstd;
		}
		// else if($studi == ''){
		// 	$inpstd 			= $otherstd;
		// }
		else{
			$inpstd 			= $studi;
		}

		if($gelar == 'oth'){
			$inpglr 			= $otherglr;
		}
		// else if($gelar == ''){
		// 	$inpglr 			= $otherglr;
		// }
		else{
			$inpglr 			= $gelar;
		}

		$data['userlogin']		= $this->session->userdata("username");

		$datauser 				= $data['userlogin'];

		$result= $this->user_model->update_pendidikan($id,$ntglmasuk,$ntgllulus,$inpjen,$inpins,$inpstd,$inpglr,$datauser);
		echo json_decode($result);
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