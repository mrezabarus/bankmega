<?php
class User_Model extends CI_Model{	
	function check_isvalidated(){

		$this->load->library('session');
        if(! $this->session->userdata('logged_in')){
            redirect('welcome');
        }
	}
	
	function user_detail($id_user){
		$query 		= $this->db->query("										
										SELECT 
										a.employeeid
										, a.employeename
										, DATE_FORMAT(a.employeejoindate, '%d %M %Y') as EmpJoinDAte
										, a.positiontitle
										, a.orggroup
										, aa.employeeid as nipatasan
										, aa.employeename as namaatasan
										from employee_detail a
										left join posisi b
										on a.positionid = b.position_id
										left join posisi bb
										on b.report_to = bb.position_id
										left join employee_detail aa
										on bb.position_id = aa.positionid
										where a.employeeid = '$id_user'
										group by a.employeeid	
                                        ");
                                        
        
		//return $query->row()->id_group;
		return $query->row_array();
	}

	function listAllJob($id_user)
	{
		$query 		= $this->db->query("
		SELECT * 
										from job
										where id_job in (
											SELECT job_id 
											from posisi
											where org_id in (
												SELECT orgid 
												from organization
												where parent_id in (
													SELECT org_id
													from posisi
													where active = 'YES'
													and position_id in (
														SELECT a.positionid
														from employee_detail a
														where a.employeeid = '$id_user'
														group by a.positionid
													)
												)
											)
											and active = 'YES'
										)
										");

		return $query->result();
	}

	function listSoal(){
		return $this->db->select('*')
	                ->from('soal')
				    ->get()
					->row();
	}

	function jumlahSoal(){
		return $this->db->select('*')
	                ->from('soal')
				    ->get()
					->num_row();
	}
}