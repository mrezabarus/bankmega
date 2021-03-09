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
        $data['menuparent'] = "job";
        $id_user            = $this->session->userdata('username');
		$id_group		    = $this->session->userdata('id_group'); 
		$id_group_menu	    = $this->session->userdata('id_group_menu');
		//echo $id_group_menu;

		//user menu
		$data['menuadmin']	= $this->modeldb->menuadmin($id_group);
		//menampilkan status data group
		//jika dia admin dan filter = yes, maka join ke table tbl_access
        $data['groupstat'] 	= $this->modeldb->groupstat($id_group);
		$groupstat			= $data['groupstat']['group_status'];
		$groupfilter		= $data['groupstat']['group_filter_pos'];

		$data['direktorat']	= $this->modeldb->get_direktorat();


		if($groupstat = 'admin' AND $groupfilter == 'YES'){
			//menampilkan list job		
			$data['listjob']    = $this->modeldb->listjobadminfilter($id_group_menu);
			//$data['totaljob']	= $this->modeldb->countalljobadmin($id_group_menu);
		}
		else{
			//menampilkan list job		
			$data['listjob']    = $this->modeldb->listjobadmin();
			//menampilkan total jobdesc
			//$data['totaljob']	= $this->modeldb->countalljob();
		}
		// selesai filter per posisi


		//user detail       
		$data['admindet']   = $this->modeldb->detadmin($id_user);	

		$data['menu']		= $this->modeldb->menuadmin($id_group);
        
		$this->load->view('tmpadmin/header', $data);
        $this->load->view('admin/job/job', $data);
        $this->load->view('tmpadmin/leftside', $data);
		$this->load->view('tmpadmin/footer');
		$this->load->view('tmpadmin/js_search');
		$this->load->view('tmpadmin/js_job_post');
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

    public function add($id_job)
	{
        $data['menuparent'] = "job";
        $id_user            = $this->session->userdata('username');
		$id_group		    = $this->session->userdata('id_group'); 
		$id_group_menu	    = $this->session->userdata('id_group_menu');
		//echo $id_group_menu;
		$now 				= date("Y-m-d H:i:s");
		$admin 				= "adminjob";

		//insert data
		$savejobdata		= $this->modeldb->savejobdata($id_job,$id_user,$now,$admin,$now);
		

		//user menu
		$data['menuadmin']	= $this->modeldb->menuadmin($id_group);
		//menampilkan status data group
		//jika dia admin dan filter = yes, maka join ke table tbl_access
        $data['groupstat'] 	= $this->modeldb->groupstat($id_group);
		$groupstat			= $data['groupstat']['group_status'];
		$groupfilter		= $data['groupstat']['group_filter_pos'];

		$data['direktorat']	= $this->modeldb->get_direktorat();

		//user detail       
		$data['admindet']   = $this->modeldb->detadmin($id_user);	
		$data['menu']		= $this->modeldb->menuadmin($id_group);

		//DETAIL JOB
		$data['id_job']		= $id_job;
		$data['detailjob']	= $this->modeldb->detailjob($id_job);
        
		$this->load->view('tmpadmin/header', $data);
        $this->load->view('admin/job/addjob', $data);
        $this->load->view('tmpadmin/leftside', $data);
		$this->load->view('tmpadmin/footer');
		$this->load->view('tmpadmin/job_add_field');
		$this->load->view('tmpadmin/js_search');
	}
	
	public function view($id_pos){

		$data['menuparent'] = "job";
        $id_user            = $this->session->userdata('username');
		$id_group		    = $this->session->userdata('id_group'); 
		$id_group_menu	    = $this->session->userdata('id_group_menu');

		$data['id_pos']     = $id_pos;
		
		//echo $id_group_menu;

		//user menu
		$data['menuadmin']	= $this->modeldb->menuadmin($id_group);
		//menampilkan status data group
		//jika dia admin dan filter = yes, maka join ke table tbl_access
        $data['groupstat'] 	= $this->modeldb->groupstat($id_group);
		$groupstat			= $data['groupstat']['group_status'];
		$groupfilter		= $data['groupstat']['group_filter_pos'];

		$data['direktorat']	= $this->modeldb->get_direktorat();


		if($groupstat = 'admin' AND $groupfilter == 'YES'){
			//menampilkan list job		
			$data['listjob']    = $this->modeldb->listjobadminfilter($id_group_menu);
			//$data['totaljob']	= $this->modeldb->countalljobadmin($id_group_menu);
		}
		else{
			//menampilkan list job		
			$data['listjob']    = $this->modeldb->listjobadmin();
			//menampilkan total jobdesc
			//$data['totaljob']	= $this->modeldb->countalljob();
		}
		// selesai filter per posisi


		//user detail       
		$data['admindet']   = $this->modeldb->detadmin($id_user);	

		$data['menu']		= $this->modeldb->menuadmin($id_group);
        
		$this->load->view('tmpadmin/header', $data);
        $this->load->view('admin/job/jobview', $data);
        $this->load->view('tmpadmin/leftside', $data);
		$this->load->view('tmpadmin/footer');
		$this->load->view('tmpadmin/js_search');
		$this->load->view('tmpadmin/js_job_post');
	}
	
	function savekewenangan(){
		//$tgs 	= $this->input->post('tgs');
		$tgs 		= $this->input->post('tgs'); //get all $_POST items
		$id_job		= $this->input->post('id_job');
		$now 		= date("Y-m-d H:i:s");
		$id_user    = $this->session->userdata('username');
		$jmltgs = count($tgs);
		
		for($i=0; $i<$jmltgs; $i++){
			echo $tgs[$i];

			$result			= $this->modeldb->savekewenangan($tgs[$i],$id_job,$now,$id_user);
			echo json_decode($result);
		}
		//$data = json_decode(stripslashes($_POST['data']));
		//echo '<pre>';  print_r($tgs); echo '</pre>';
		
	}
}
?>