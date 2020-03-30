<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

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
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct()
	{
		parent::__construct();
		$this->load->library('rzclass'); 
		
		$this->load->model('loginmodel','',TRUE);
		$this->load->model('appmodel','',TRUE);
		$this->rzclass->check_isvalidated(); //CHECK APAKAH USER SUDAH LOGIN
		//$this->load->model('peopleModel','',TRUE);

	}

	public function index()
	{
		//$this->load->view('welcome_message');
		$data['par_name']		= "Dashboard";//Menu Parent Name
		$data['menu']			= $this->rzclass->menuLeft();
		$data['username']		= $this->rzclass->getUserName();
        $data['userlogin']		= $this->rzclass->id_user_login();
        
        $dataUser 				= $data['userlogin'];
        $data['group']			= $this->rzclass->getGroup();
        // //echo $dataUser;

        $data['userDetail']		= $this->appmodel->userDetail($dataUser);
        $data['listposisi']		= $this->appmodel->listAllJob($dataUser);
		

		//echo $data['id_user'];
		$this->load->view('tmp/header', $data);
		$this->load->view('tmp/menu', $data);
		$this->load->view('home');
		$this->load->view('tmp/footer');
		$this->load->view('tmp/footer-tooltip', $data);
	}

}
