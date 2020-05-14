<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class RiwayatPekerjaan extends CI_Controller {



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
		$data['bidangusaha']	= $this->user_model->bidang_usaha();
		$data['leveljabatan']	= $this->user_model->level_jabatan();
		$data['bidangtugas']	= $this->user_model->bidang_tugas();
		
		
		$this->load->view('tmp2/header', $data);
		$this->load->view('tmp2/leftmenu', $data);
		$this->load->view('riwayatKerja', $data);
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

	function data_riwker(){
		$data['userlogin']		= $this->session->userdata("username");

		$datauser 				= $data['userlogin'];

        $data=$this->user_model->riwkerList($datauser);
        echo json_encode($data);
	}

	function get_riwker(){
        $id=$this->input->get('idx');
        
        $data=$this->user_model->get_riwker_by_code($id);
        echo json_encode($data);
	}

	function saveHistoryJob()
	{
        //$judul= $this->input->post('judul');
		$namaperusahaan		    =	$this->input->post('namaperusahaan');
		$bidang_usaha			=	$this->input->post('bidang_usaha');
		$otherusaha			    =	$this->input->post('otherusaha');
		$level_jabatan			=	$this->input->post('level_jabatan');
		$otherlvljbt			=	$this->input->post('otherlvljbt');
		$bdgtgs				    =	$this->input->post('bdgtgs');
        $otherbdgtgs			=	$this->input->post('otherbdgtgs');
        $posisi                 =   $this->input->post('namaposisi');

		$tglmasuk				=	$this->input->post('tglmasuk');
		$tglresign				=	$this->input->post('tglresign');

		$ntglmasuk 				= 	date("Y-m-d", strtotime($tglmasuk));
		$ntglresign				= 	date("Y-m-d", strtotime($tglresign));

		if($bidang_usaha=='oth'){
			$inpbidangusaha		= $otherusaha;
		}
		else{
			$inpbidangusaha 	= $bidang_usaha;
		}

		if($level_jabatan == 'oth'){
			$inplvl_jbtn		= $otherlvljbt;
		}
		else{
			$inplvl_jbtn				= $level_jabatan;
		}

		if($bdgtgs	== 'oth'){
			$inpbdgtgs 			= $otherbdgtgs;
		}
		else{
			$inpbdgtgs 			= $bdgtgs;
		}

		$data['userlogin']		= $this->session->userdata("username");

		$datauser 				= $data['userlogin'];

		$result= $this->user_model->saveHistoryJob($ntglmasuk,$ntglresign,$namaperusahaan,$inpbidangusaha,$inplvl_jbtn,$inpbdgtgs,$datauser,$posisi);
		echo json_decode($result);
	}


	function update_riwker()
	{
        $id 					= 	$this->input->post('id');

		$namaperusahaan		    =	$this->input->post('namaperusahaan_upd');
		$bidang_usaha			=	$this->input->post('bidang_usaha_upd');
		$otherusaha			    =	$this->input->post('otherusaha_upd');
		$level_jabatan			=	$this->input->post('level_jabatan_upd');
		$otherlvljbt			=	$this->input->post('otherlvljbt_upd');
		$bdgtgs				    =	$this->input->post('bdgtgs_upd');
        $otherbdgtgs			=	$this->input->post('otherbdgtgs_upd');
        $posisi                 =   $this->input->post('namaposisi_upd');

		$tglmasuk				=	$this->input->post('tglmasuk_upd');
		$tglresign				=	$this->input->post('tglresign_upd');

		$ntglmasuk 				= 	date("Y-m-d", strtotime($tglmasuk));
		$ntglresign				= 	date("Y-m-d", strtotime($tglresign));

		if($bidang_usaha=='oth'){
			$inpbidangusaha		= $otherusaha;
		}
		else{
			$inpbidangusaha 	= $bidang_usaha;
		}

		if($level_jabatan == 'oth'){
			$inplvl_jbtn		= $otherlvljbt;
		}
		else{
			$inplvl_jbtn				= $level_jabatan;
		}

		if($bdgtgs	== 'oth'){
			$inpbdgtgs 			= $otherbdgtgs;
		}
		else{
			$inpbdgtgs 			= $bdgtgs;
		}

		$data['userlogin']		= $this->session->userdata("username");

		$datauser 				= $data['userlogin'];


        $result= $this->user_model->update_riwker($id,$ntglmasuk,$ntglresign,$namaperusahaan,$inpbidangusaha,$inplvl_jbtn,$inpbdgtgs,$datauser,$posisi);
		//$result= $this->user_model->($id,$ntglmasuk,$ntglresign,$inpjen,$inpins,$inpstd,$inpglr,$datauser);
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