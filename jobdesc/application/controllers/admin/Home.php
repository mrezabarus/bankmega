<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class home extends CI_Controller {

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


		if($groupstat = 'admin' AND $groupfilter == 'YES'){
			//untuk chart
			$data['composjob']	= $this->modeldb->compareposjobfilter($id_group_menu);
			$chart['totaljob']	= $data['composjob']['totalJob'];
			$chart['totalpos']	= $data['composjob']['totalPositionTitle'];

			$data['composfile']	= $this->modeldb->compareposfilefilter($id_group_menu);
			$chart['totaljobs']	= $data['composfile']['totalJob'];
			$chart['totalfile']	= $data['composfile']['totalFile'];

			//menampilkan list job					
			$data['listjob']    = $this->modeldb->listjobadminfilter($id_group_menu);
			$data['totaljob']	= $this->modeldb->countalljobadmin($id_group_menu);
		}
		else{
			//untuk chart
			$data['composjob']	= $this->modeldb->compareposjob();
			$chart['totaljob']	= $data['composjob']['totalJob'];
			$chart['totalpos']	= $data['composjob']['totalPositionTitle'];

			$data['composfile']	= $this->modeldb->compareposfile();
			$chart['totaljobs']	= $data['composfile']['totalJob'];
			$chart['totalfile']	= $data['composfile']['totalFile'];
			
			//menampilkan list job		
			$data['listjob']    = $this->modeldb->listjobadmin();
			//menampilkan total jobdesc
			$data['totaljob']	= $this->modeldb->countalljob();
		}
		// selesai filter per posisi


		//user detail       
		$data['admindet']   = $this->modeldb->detadmin($id_user);	

		$data['menu']		= $this->modeldb->menuadmin($id_group);
        
		$this->load->view('tmpadmin/header', $data);
        $this->load->view('admin/home', $data);
        //$this->load->view('tmpadmin/leftside', $data);
		$this->load->view('tmpadmin/footer');
		$this->load->view('tmpadmin/chart', $chart);
	}
	
	public function setupparam()
	{
        $id_user            = $this->session->userdata('username');
		$id_group		    = $this->session->userdata('id_group'); 

		//user detail       
		$data['admindet']   = $this->modeldb->detadmin($id_user);
		
		//user menu
		$data['menuadmin']	= $this->modeldb->menuadmin($id_group);

		//ambil data job title user yang login
        $data['emppos'] 	= $this->modeldb->empjob($id_user);
        $emppos				= $data['emppos']['EmpJobTtl'];

		//menampilkan list job
		$data['listjob']    = $this->modeldb->listjob($emppos);
		
		//menampilkan total jobdesc
		$data['totaljob']	= $this->modeldb->countalljob();

		$data['menu']		= $this->modeldb->menuadmin($id_group);
        
		$this->load->view('tmpadmin/header', $data);
        $this->load->view('admin/home', $data);
        $this->load->view('tmpadmin/leftside', $data);
		$this->load->view('tmpadmin/footer');
		
	}
	
	public function job()
	{
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
        $this->load->view('admin/job', $data);
        $this->load->view('tmpadmin/leftside', $data);
		$this->load->view('tmpadmin/footer');
	}

	public function position()
	{
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


		if($groupstat = 'admin' AND $groupfilter == 'YES'){
			//menampilkan list job		
			$data['listjob']    = $this->modeldb->listpostitleadminfilter($id_group_menu);
			//$data['totaljob']	= $this->modeldb->countallpostitleadmin($id_group_menu);
		}
		else{
			//menampilkan list job		
			$data['listjob']    = $this->modeldb->listpostitleadmin();
			//menampilkan total jobdesc
			//$data['totaljob']	= $this->modeldb->countallpostitle();
		}
		// selesai filter per posisi


		//user detail       
		$data['admindet']   = $this->modeldb->detadmin($id_user);	

		$data['menu']		= $this->modeldb->menuadmin($id_group);
        
		$this->load->view('tmpadmin/header', $data);
        $this->load->view('admin/position', $data);
        $this->load->view('tmpadmin/leftside', $data);
		$this->load->view('tmpadmin/footer');
	}
}
?>
