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
										SELECT * 
										from tbl_user a
										left join (
										SELECT 
										employeeid
										, employeename
										, MAX(period)
										, positionid
										, positiontitle
										, orgname
										, orggroup
										, 'DIV'
										, dir
										, location
										, regional
										, map
										, jobfunction
										, loc_ownership
										, employeejoblevel
										, id_pos_title
										from employee_detail 
										group by employeeid
										)B
										on a.username = B.employeeid
		
										where b.employeeid = '$id_user'
										group by b.employeeid	
                                        ");
                                        
        
		//return $query->row()->id_group;
		return $query->row_array();
	}
	function pendidikanList($iduser)
	{
		$hasil=$this->db->query("SELECT * FROM tbl_emp_pendidikan where employeeid = '$iduser'");
        return $hasil->result();
	}

	function get_pendidikan_by_code($id)
	{
		$hsl=$this->db->query("SELECT * FROM tbl_emp_pendidikan WHERE id='$id'");
        if($hsl->num_rows()>0){
            foreach ($hsl->result() as $data) {
                $hasil=array(
					'id' => $data->id,
                    'jenjang_pendidikan' => $data->jenjang_pendidikan,
					'nama_institusi' => $data->nama_institusi,
					'studi' => $data->studi,
					'gelar' => $data->gelar,
                    );
            }
        }
        return $hasil;
	}

	function jenjang_pendidikan()
	{
		$hasil=$this->db->query("SELECT * FROM master_jenjang_pendidikan order by nama desc");
        return $hasil->result();
	}
}