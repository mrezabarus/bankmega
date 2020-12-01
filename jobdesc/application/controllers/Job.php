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
}
?>