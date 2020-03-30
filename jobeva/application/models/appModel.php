<?php
Class AppModel extends CI_Model
{
	function User()
	{
		parent::__construct();
		//$erec = $this->load->database('pool', TRUE);
	}

	function insert($data,$table){
		$ins = $this->db->insert($table, $data);
	}

	function update_data($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	// function listAllJob($id_user)
	// {
	// 	$query 		= $this->db->query("
	// 									SELECT * 
	// 									from job
	// 									where id_job in (
	// 										SELECT job_id 
	// 										from posisi
	// 										where org_id in (
	// 											SELECT orgid 
	// 											from organization
	// 											where parent_id in (
	// 												SELECT org_id
	// 												from posisi
	// 												where active = 'YES'
	// 												and position_id in (
	// 													SELECT EmpJobTtl
	// 													from employee a
	// 													where a.Empid = '$id_user'
	// 												)
	// 											)
	// 										)
	// 										and active = 'YES'
	// 									)
	// 									");

		
	// 	return $query->result();
	// }

	function listAllJob($id_user)
	{
		$query 		= $this->db->query("
										SELECT * 
										from posisi
										where org_id in (
											SELECT orgid 
											from organization
											where parent_id in (
												SELECT org_id
												from posisi
												where active = 'YES'
												and position_id in (
													SELECT EmpJobTtl
													from employee a
													where a.Empid = '$id_user'
												)
											)
										)
										and active = 'YES'
										");

		
		return $query->result();
	}


	function userDetail($username)
	{
		$query 		= $this->db->query("SELECT
                                                a.username
                                                , b.EmpId
                                                , b.EmpName
                                                , SUBSTRING_INDEX(b.EmpJobLvl,'-',-1) as EmpGrade
                                                , c.position_id
                                                , c.position_name
                                                , cc.position_id as ReportToID
                                                , cc.position_name as ReportToNamer
                                                , bb.Empname as namaAtasan
                                                , d.organization_name
                                                , DATE_FORMAT(b.EmpDateStart, '%d %M %Y') as EmpJoinDAte
												, e.org_group_code
												, e.org_group_detail
                                                from tbl_user a
                                                left join employee b
                                                on a.username = b.EmpId
                                                left join posisi c
                                                on b.EmpJobTtl = c.Position_Id
                                                left join organization d
                                                on c.org_id = d.orgid
                                                left join posisi cc
                                                on c.report_to = cc.position_id
                                                left join employee bb
                                                on cc.position_id = bb.empjobttl
                                                left join organization_group e
                                                on d.org_group_id = e.org_group_id
                                                where c.active = 'YES'
                                                and a.username = '$username'
                                                group by a.username
													
                                        ");
                                        
        
		//return $query->row()->id_group;
		return $query->row_array();
	}

	
}
?>
