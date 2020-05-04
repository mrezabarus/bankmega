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

	function listAllJob($id_user)
	{
		$query 		= $this->db->query("
										SELECT * 
										from (
										
											SELECT * 
											from position_title
											where report_id_pos_title in 
											(
												SELECT id_pos_title
												from employee_detail
												where employeeid = '$id_user'
											)
											UNION /*kedua*/
											(
											SELECT * 
											from position_title
											where report_id_pos_title in 
												(
												SELECT id_pos_title
												from position_title
												where report_id_pos_title in 
													(
														SELECT id_pos_title
														from employee_detail
														where employeeid = '$id_user'
													)
												)
											)
											UNION /*ketiga*/
											(
											SELECT * 
											from position_title
											where report_id_pos_title in 
												(
													SELECT id_pos_title
													from position_title
													where report_id_pos_title in 
														(
															SELECT id_pos_title
															from position_title
															where report_id_pos_title in 
																(
																	SELECT id_pos_title
																	from employee_detail
																	where employeeid = '$id_user'
																)
														)
												)
											)
											UNION /* KE EMPAT */
											(
											SELECT * 
											from position_title
											where report_id_pos_title in 
												(
												SELECT id_pos_title 
												from position_title
												where report_id_pos_title in 
													(
														SELECT id_pos_title
														from position_title
														where report_id_pos_title in 
															(
																SELECT id_pos_title
																from position_title
																where report_id_pos_title in 
																	(
																		SELECT id_pos_title
																		from employee_detail
																		where employeeid = '$id_user'
																	)
															)
													)
												)
											)
											UNION /* KE LIMA */
											(
												SELECT * 
												from position_title
												where report_id_pos_title in 
												(
												SELECT id_pos_title 
												from position_title
												where report_id_pos_title in 
													(
													SELECT id_pos_title 
													from position_title
													where report_id_pos_title in 
														(
															SELECT id_pos_title
															from position_title
															where report_id_pos_title in 
																(
																	SELECT id_pos_title
																	from position_title
																	where report_id_pos_title in 
																		(
																			SELECT id_pos_title
																			from employee_detail
																			where employeeid = '$id_user'
																		)
																)
														)
													)
												)
											)
											UNION /* KE Enam */
											(
												SELECT * 
												from position_title
												where report_id_pos_title in 
												(
													SELECT id_pos_title 
													from position_title
													where report_id_pos_title in 
													(
													SELECT id_pos_title 
													from position_title
													where report_id_pos_title in 
														(
														SELECT id_pos_title 
														from position_title
														where report_id_pos_title in 
															(
																SELECT id_pos_title
																from position_title
																where report_id_pos_title in 
																	(
																		SELECT id_pos_title
																		from position_title
																		where report_id_pos_title in 
																			(
																				SELECT id_pos_title
																				from employee_detail
																				where employeeid = '$id_user'
																			)
																	)
															)
														)
													)
												)
											)
											UNION /* KE Tujuh */
											(
												SELECT * 
												from position_title
												where report_id_pos_title in 
												(
													SELECT position_title 
													from position_title
													where report_id_pos_title in 
													(
														SELECT id_pos_title 
														from position_title
														where report_id_pos_title in 
														(
														SELECT id_pos_title 
														from position_title
														where report_id_pos_title in 
															(
															SELECT id_pos_title 
															from position_title
															where report_id_pos_title in 
																(
																	SELECT id_pos_title
																	from position_title
																	where report_id_pos_title in 
																		(
																			SELECT id_pos_title
																			from position_title
																			where report_id_pos_title in 
																				(
																					SELECT id_pos_title
																					from employee_detail
																					where employeeid = '$id_user'
																				)
																		)
																)
															)
														)
													)
												)
												
											)
										)A
										
										group by A.id_pos_title
										order by A.position_title asc
		");
		/*
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
		*/
		return $query->result();
	}

	function view_tbl_soal(){
		$this->db->select('*');
		$this->db->from('soal');

		$query = $this->db->get();		
	
		$chekRow = $query->num_rows;
		if($chekRow != "0")
		{
			return $query->result();
		}
	}

	function nama_kuesioner(){
		$query 		= $this->db->query("SELECT * from soal");

		return $query->result();
	}

	function soal_kuisioner_1()
	{
		$query 		= $this->db->query("Select * from soal_kuesioner_1");
		return $query->result();
	}

	function soal_kuisioner_2()
	{
		$query 		= $this->db->query("Select * from soal_kuesioner_2");
		return $query->result();
	}

	function soal_kuesioner(){
		$query 		= $this->db->query("SELECT * from soal limit 1");

		return $query->result();
	}

	function detail_soal($namasoal)
	{
		$query 		= $this->db->query("SELECT * from $namasoal");
		echo "SELECT * from $namasoal";
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