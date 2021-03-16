<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class posisi extends CI_Controller {

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
        $data['userdet']    = $this->modeldb->userdetail($id_user);

		//ambil data job title user yang login
        $data['emppos'] 	= $this->modeldb->empjob($id_user);
		$emppos				= $data['emppos']['EmpJobTtl'];
		
		$data['direktorat']	= $this->modeldb->get_direktorat();

		//menampilkan list job
		$data['listjob']    = $this->modeldb->listposisi($emppos);
		
		//menampilkan total jobdesc
		$data['totaljob']	= $this->modeldb->countjobdesc($emppos);
        
		$this->load->view('tmp/header');
		$this->load->view('posisi/posisi', $data);
		$this->load->view('tmp/leftside', $data);
		$this->load->view('tmp/footer');
		$this->load->view('tmp/js_search');
		$this->load->view('tmp/js_job_post');
	}
	
	public function job()
	{
        $id_user            = $this->session->userdata('username');
		//$data['id_user']    = $this->session->userdata('username'); 

		//user detail       
        $data['userdet']    = $this->modeldb->userdetail($id_user);

		//ambil data job title user yang login
        $data['emppos'] 	= $this->modeldb->empjob($id_user);
		$emppos				= $data['emppos']['EmpJobTtl'];
		
		$data['direktorat']	= $this->modeldb->get_direktorat();

		$data['countjob']	= $this->modeldb->countjob();
		$totaljob 			= $data['countjob']['total'];

		//menampilkan list job
		$data['listjob']    = $this->modeldb->listjob($emppos);
		
		//menampilkan total jobdesc
		$data['totaljob']	= $this->modeldb->countjobdesc($emppos);
        
		$this->load->view('tmp/header');
		$this->load->view('job/job', $data);
		$this->load->view('tmp/leftside', $data);
		$this->load->view('tmp/footer');
		$this->load->view('tmp/js_search');
		$this->load->view('tmp/js_job_post');
    }
}
?>