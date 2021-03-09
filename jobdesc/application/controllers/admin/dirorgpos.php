<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dirorgpos extends CI_Controller {

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
    
    
    public function get_organisasi(){
		$id=$this->input->post('id');
        $data=$this->modeldb->get_organisasi($id);
        echo json_encode($data);
	}

	public function get_pos_title(){
		$id=$this->input->post('idorg');
        $data=$this->modeldb->get_pos_title($id);
        echo json_encode($data);
    }

}
?>