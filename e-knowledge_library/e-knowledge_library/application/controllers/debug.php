<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Debug extends CI_Controller {

	/**
	 * just for Debuging
	 */

	
	public function index()
	{
		$this->load->view('welcome_message');
	}
	
	function hanarafidah2()
	{
		$this->load->model('Adminmax_db');
		echo '<pre>';
		echo 'haha';
		// print_r( $this->session->all_userdata() );		
		// print_r( $this->Model_db->getBrowser() );
		// print_r( base_url() );		
		// print_r( $_SERVER );		//SERVER_ADDR
		// print_r( $this->Model_db->get_server_condition_rev3() );
		// print_r( $this->Model_db->get_server_condition_rev3() );
		
				
			$find_2['id_kursus'] = 9;			
			$find_2['id_jadwal'] = 1;			
			$find_2['jmlh_soal'] = 20;	
			
		print_r( $this->Adminmax_db->ReportDetail($find_2) );
		
		
		// $data = $this->Model_db->debug(); 
	}
	
	function cleanServerCondition()
	{
		echo '<pre>';
		echo 'cleanServerCondition';
		echo '<br>';
		
		print_r( $this->Model_db->cleanServerCondition() );
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */