<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class job extends CI_Controller {

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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	
    public function __construct()
    {
        parent::__construct();
        $this->load->model("modeldb");
		//$this->modeldb->check_isvalidated();
		if($this->session->userdata('status') != "login"){
			redirect(("welcome"));
		}		
	}

	public function index()
	{
        $id_user            = $this->session->userdata('username');
		//$data['id_user']    = $this->session->userdata('username'); 

		//user detail       
        $data['userdet']    = $this->modeldb->detailuser($id_user);

		//ambil data job title user yang login
        $data['emppos'] 	= $this->modeldb->empjob($id_user);
        $emppos				= $data['emppos']['EmpJobTtl'];

		//menampilkan list job
		$data['listjob']    = $this->modeldb->listjob($emppos);
		
		//menampilkan total jobdesc
		$data['totaljob']	= $this->modeldb->countjobdesc($emppos);
        
		$this->load->view('tmp/header');
		$this->load->view('home', $data);
		$this->load->view('tmp/footer');
    }

    public function view($id_pos){

		$data['id_pos']     = $id_pos;
		
		$id_user            = $this->session->userdata('username');
		//$data['id_user']    = $this->session->userdata('username'); 

		//user detail       
        $data['userdet']    = $this->modeldb->detailuser($id_user);

		//ambil data job title user yang login
        $data['emppos'] 	= $this->modeldb->empjob($id_user);
        $emppos				= $data['emppos']['EmpJobTtl'];

		//menampilkan list job
		$data['listjob']    = $this->modeldb->listjob($emppos);
		
		//menampilkan total jobdesc
		$data['totaljob']	= $this->modeldb->countjobdesc($emppos);
		
        $this->load->view('tmp/header');
		$this->load->view('jobview', $data);
		$this->load->view('tmp/footer');
	}
	
	public function add($id_job)
	{
        $data['menuparent'] = "job";
        $id_user            = $this->session->userdata('username');
		$id_group		    = $this->session->userdata('id_group'); 
		$id_group_menu	    = $this->session->userdata('id_group_menu');
		//echo $id_group_menu;		

		//user menu
		$data['menuadmin']	= $this->modeldb->menuadmin($id_group);
		$now 				= date("Y-m-d H:i:s");
		$admin 				= "adminjob";
		//menampilkan status data group
		//jika dia admin dan filter = yes, maka join ke table tbl_access
        $data['groupstat'] 	= $this->modeldb->groupstat($id_group);
		$groupstat			= $data['groupstat']['group_status'];
		$groupfilter		= $data['groupstat']['group_filter_pos'];

		$data['direktorat']	= $this->modeldb->get_direktorat();

		//check jobdesc data
		$data['checkdata'] 	= $this->modeldb->checkjobdata($id_job);
		$checkdata			= $data['checkdata']['total'];
		if($checkdata < 1){
			$savejobdata		= $this->modeldb->savejobdata($id_job,$id_user,$now,$admin,$now);
		}else{}
				
		
		//user detail       
		$data['userdet']    = $this->modeldb->userdetail($id_user);	
		$data['menu']		= $this->modeldb->menuadmin($id_group);

		//DETAIL JOB
		$data['id_job']		= $id_job;
		$data['detailjob']	= $this->modeldb->detailjob($id_job);
        
		$this->load->view('tmp/header', $data);
        $this->load->view('job/addjob', $data);
        $this->load->view('tmp/leftside', $data);
		$this->load->view('tmp/footer');
		$this->load->view('tmp/job_add_field');
		$this->load->view('tmp/js_search');
	}

	public function addjoblist()
	{
		$direktorat 		= $this->input->post('direktorat');
		$organization 		= $this->input->post('organization');
		$postitle 			= $this->input->post('postitle');
		$jobname 			= $this->input->post('jobname');

		$data['countjob']	= $this->modeldb->countjob();
		$totaljob 			= $data['countjob']['total'];

		$result				= $this->modeldb->savejob($direktorat,$organization,$postitle,$jobname, $totaljob);
		echo json_decode($result);
    }

	function savetugas(){
		//$tgs 	= $this->input->post('tgs');
		$tgs 		= $this->input->post('tgs'); //get all $_POST items
		$id_job		= $this->input->post('id_job');
		$now 		= date("Y-m-d H:i:s");
		$id_user    = $this->session->userdata('username');
		$jmltgs = count($tgs);
		
		for($i=0; $i<$jmltgs; $i++){
			echo $tgs[$i];

			$result			= $this->modeldb->savetugas($tgs[$i],$id_job,$now,$id_user);
			echo json_decode($result);
		}
		//$data = json_decode(stripslashes($_POST['data']));
		//echo '<pre>';  print_r($tgs); echo '</pre>';
		
	}

	function savekewenangan(){
		//$tgs 	= $this->input->post('tgs');
		$kwn 		= $this->input->post('kwn'); //get all $_POST items
		$id_job		= $this->input->post('id_job');
		$now 		= date("Y-m-d H:i:s");
		$id_user    = $this->session->userdata('username');
		$jmlkwn = count($kwn);
		
		for($i=0; $i<$jmlkwn; $i++){
			echo $kwn[$i];

			$result			= $this->modeldb->savekewenangan($kwn[$i],$id_job,$now,$id_user);
			echo json_decode($result);
		}
		//$data = json_decode(stripslashes($_POST['data']));
		//echo '<pre>';  print_r($tgs); echo '</pre>';
		
	}

	function savekompetensi(){
		//$tgs 	= $this->input->post('tgs');
		$kom 		= $this->input->post('kom'); //get all $_POST items
		$id_job		= $this->input->post('id_job');
		$now 		= date("Y-m-d H:i:s");
		$id_user    = $this->session->userdata('username');
		$jmlkom = count($kom);
		
		for($i=0; $i<$jmlkom; $i++){
			echo $kom[$i];

			$result			= $this->modeldb->savekompetensi($kom[$i],$id_job,$now,$id_user);
			echo json_decode($result);
		}
		//$data = json_decode(stripslashes($_POST['data']));
		//echo '<pre>';  print_r($tgs); echo '</pre>';
		
	}

	function saveexperience(){
		//$tgs 	= $this->input->post('tgs');
		$pendidikan 		= $this->input->post('pendidikan'); //get all $_POST items
		$jurusan 			= $this->input->post('jurusan'); //get all $_POST items
		$expposition 		= $this->input->post('expposition'); //get all $_POST items

		$exp 				= $this->input->post('exp'); //get all $_POST items
		$id_job				= $this->input->post('id_job');
		$now 				= date("Y-m-d H:i:s");
		$id_user    		= $this->session->userdata('username');
		$jmlexp 			= count($exp);

		$resultpendidikan	= $this->modeldb->saveedu($pendidikan,$jurusan,$id_job,$now,$id_user);
		$resultpengalaman	= $this->modeldb->saveexp($expposition,$id_job,$now,$id_user);
		
		for($i=0; $i<$jmlexp; $i++){
			echo $exp[$i];

			$result			= $this->modeldb->saveexperince($exp[$i],$id_job,$now,$id_user);
			echo json_decode($result);
		}
		//$data = json_decode(stripslashes($_POST['data']));
		//echo '<pre>';  print_r($tgs); echo '</pre>';
		
	}

	function review($id_job){
		$data['profil'] 	= $this->modeldb->profiljabatan($id_job);
		$data['respons']	= $this->modeldb->gettggjwb($id_job);
		$data['kewenangan']	= $this->modeldb->getkewenangan($id_job);
		$data['pendidikan']	= $this->modeldb->getpendidikan($id_job);
		$data['experience']	= $this->modeldb->getpengalaman($id_job);
		$data['jobpeng']	= $this->modeldb->getjobpeng($id_job);		
		$data['kompetensi']	= $this->modeldb->getkompetensi($id_job);

		$this->load->view('job/preview', $data);
	}
}
?>