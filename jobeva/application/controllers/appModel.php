<?php
Class TalentModel extends CI_Model
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

	function getUsia($nip)
	{
		$query = $this->db->query("SELECT 
									empid, 
									empdatebirth,
									STR_TO_DATE(empdatebirth, '%m/%d/%Y'),
									STR_TO_DATE(empdatebirth, '%m/%d/%Y'),
									YEAR(CURDATE()),
									YEAR(STR_TO_DATE(empdatebirth, '%m/%d/%Y')),
									FLOOR(TIMESTAMPDIFF(MONTH,STR_TO_DATE(empdatebirth, '%m/%d/%Y'),NOW())/12) as usia
									from empdatebirth
									where empid = '$nip'");

		return $query->row();
	}

	function getPendidikan($nip)
	{
		$query = $this->db->query("SELECT 
									b.EduLvlStatus
									, b.EduLvlName
									, b.EduLevel
									, a.EmpEduLevel
									, c.EduInsName
									, a.EmpEduName
									, d.EduMjrName
									from edulevel b
									left join empeducation a
									on b.EduLvlCode = a.EmpEduLevel
									left join eduinstitution c
									on a.EmpEduIns = c.EduInsCode
									left join edumajor d
									on a.EmpEduMajor = d.EduMjrCode
									where a.empid = '$nip'
									and b.edulevel >= 7
									GROUP BY a.empid");
		
		return $query->result();
	}

	function getExperience($nip)
	{
		$query = $this->db->query("SELECT *
									from (
										(
										SELECT
										aa.Empid,
										bb.CanJobTtlName,
										aa.CompanyName,
										aa.JobStart,
										aa.JobEnd,
										aa.Sequence
										from empexperience aa
										left join canjobtitle bb
										on aa.JobTitle = bb.canjobttlcode
										where aa.Empid = '$nip'
										order by aa.Sequence DESC
										)
										union
										(
										SELECT 
										a.empStEmpId
										, b.jobTtlName
										,'Bank Mega'
										, a.EmpStStartDate
										, a.EmpStEndDate
										, a.EmpStEndDate
										from empstjobttl a
										left join jobtitle b
										on a.EmpStJobTtl = b.JobTtlCode
										where a.EmpStEmpID = '$nip'
										order by a.EmpStEndDate DESC
										) 
									)A
									order by A.JobStart ASC
									");
		
		return $query->result();
	}

	function selEmployee($id_employee)
	{
		$query 		= $this->db->query("SELECT 
										b.employeeid
										, b.employeename
										, c.position_name
										, e.organization_name
										, DATE_FORMAT(d.empJoinDate, '%d %M %Y')  as EmpJoinDate
										, f.org_group_code
										, f.org_group_detail
										, g.head_pos_id
										, h.position_name as posisiAtasan
										, i.employeeid as nipAtasan
										, i.employeename as namaAtasan
										from employee_r_upload b
										left join posisi c
										on b.position_id = c.position_id
										left join employee d
										on b.employeeid = d.empid
										left join organization e
										on b.org_id = e.orgid
										left join organization_group f
										on e.org_group_id = f.org_group_code
										left join organization g 
										on e.parent_id = g.orgid
										left join posisi h
										on g.head_pos_id = h.position_id
										left join employee_r_upload i
										on h.position_id = i.position_id
										where b.employeeid = '$id_employee' ");

		return $query->row_array();
	}

	function getGroupName($id_user)
	{
		$query 		= $this->db->query("Select group_name 
										from tbl_user a
										left join tbl_group b
										on a.id_group = b.id_group
										where a.id_user = '$id_user'
										");
		return $query->row()->group_name;
		//return $query->row_array();
	}

	function userDetail($id_user)
	{
		$query 		= $this->db->query("SELECT 
													a.id_user
													, a.viewonedown
													, a.username
													, b.empid
													, b.empname
													, SUBSTRING_INDEX(b.EmpJobLvl,'-',-1) as employeegrade
													, c.position_name
													, c.position_id
													, e.organization_name
													, DATE_FORMAT(b.empJoinDate, '%d %M %Y')  as EmpJoinDate
													, f.org_group_code
													, f.org_group_detail
													, g.head_pos_id
													, h.position_name as posisiAtasan
													, i.empid as nipAtasan
													, i.empname as namaAtasan
													, a.viewonedown
													from tbl_user a
													left join employee b
													on a.username = b.empid
													left join posisi c
													on b.empjobttl = c.position_id
													
													left join organization e
													on b.emporg = e.orgid
													left join organization_group f
													on e.org_group_id = f.org_group_id
													left join organization g 
													on e.parent_id = g.orgid
													left join posisi h
													on g.head_pos_id = h.position_id
													left join employee i
													on h.position_id = i.empjobttl
													where a.id_user = '$id_user'
													and c.active = 'YES'
													
										");
		//return $query->row()->id_group;
		return $query->row_array();
	}

	function checkPos($nip)
	{
		$query 		= $this->db->query("SELECT position_id 
										FROM employee_r_upload
										where employeeid = '$nip'
										");
		

		return $query->row_array(); 
	}

	function viewalasan($nip)
	{
		$query 		= $this->db->query("SELECT alasan 
										FROM talentlist
										where nip = '$nip'
										");
		

		return $query->row_array(); 
	}

	function getReadiness($nip, $eva)
	{
		$query 		= $this->db->query("SELECT readiness 
										FROM readinesssp
										where nip = '$nip'
										and addby = '$eva'
										and flagdel != '1'
										");
		

		return $query->row_array(); 
	}

	function getAsseementSp($nip, $eva)
	{
		$query 		= $this->db->query("SELECT assessment 
										FROM assessmentsp
										where nip = '$nip'
										and addby = '$eva'
										
										and flagdel != '1'
										");
		/*
		echo "SELECT assessment 
										FROM assessmentsp
										where nip = '$nip'
										and addby = '$eva'
										and position = '$pos_id'
										and flagdel != '1'
										";
		*/
		return $query->row_array(); 
	}

	function nilaiski($nip)
	{
		$query 		= $this->db->query("SELECT 
										fski_nip, 
										fski_final_score, 
										fski_year 
										FROM tbl_ski
										where fski_nip = '$nip'
										order by fski_year DESC
										limit 2
										");
		

		return $query->result(); 
	}

	function searchKeyword($keyword, $id_user)
	{
	$query 			= $this->db->query("SELECT 
											A.employeeid
											, A.employeename
											, p.position_id
											, p.position_name
											, ski.fski_final_score
											from (
												SELECT 
												a.employeeid 
												, a.employeename
												, a.period
												, a.position_id
												from employee_r_upload a
												left join organization b
												on a.org_id = b.orgid
												where a.org_id in (
													SELECT orgid
													from organization
													where parent_id in (
														SELECT org_id from employee_r_upload
														where employeeid in (
															SELECT username from tbl_user	
															where id_user = '$id_user'
														)
													)
													OR a.org_id in (
														SELECT a.org_id
															from employee_r_upload a
															left join tbl_user b
															on a.employeeid = b.username
															where b.id_user = '$id_user'
													)
													AND a.employeeid NOT IN(
														SELECT a.employeeid
															from employee_r_upload a
															left join tbl_user b
															on a.employeeid = b.username
															where b.id_user = '$id_user'
													)
												)
												union
												SELECT 
												a.employeeid 
												, a.employeename
												, a.period
												, a.position_id
												from employee_r_upload a
												left join organization b
												on a.org_id = b.orgid
												where b.parent_id in (
													SELECT orgid
													from organization
													where parent_id in (
														SELECT org_id from employee_r_upload
														where employeeid in (
															SELECT username from tbl_user	
															where id_user = '$id_user'
														)
													)
												)
												OR a.org_id in (
														SELECT a.org_id
															from employee_r_upload a
															left join tbl_user b
															on a.employeeid = b.username
															where b.id_user = '$id_user'
													)
													AND a.employeeid NOT IN(
														SELECT a.employeeid
															from employee_r_upload a
															left join tbl_user b
															on a.employeeid = b.username
															where b.id_user = '$id_user'
													)
													OR a.org_id in (
														SELECT orgid from organization
														where parent_id in (
															select orgid
															from organization where parent_id in (
																SELECT orgid
																from organization
																where parent_id in (
																	SELECT orgid
																	from organization
																	where parent_id in (
																		SELECT org_id from employee_r_upload
																		where employeeid in (
																			SELECT username from tbl_user	
																			where id_user = '$id_user'
																		)
																	)
																)
															)
														)
													)
										)A
										left join posisi p
											on A.position_id = p.position_id
										LEFT JOIN (
											SELECT fski_nip, fski_final_score
											FROM tbl_ski
											WHERE fski_year = '2016'
										) ski
											on A.employeeid = ski.fski_nip
										where 1 and
										(A.employeeid = '$keyword' OR A.employeename like '%$keyword%' OR p.position_name like '%$keyword%')
										AND
										A.employeeid not in (
											SELECT nip from talentlist
											where evaluator = '$id_user'
											and (flagdel is null or flagdel = 0)
										)
										group by A.employeeid
										");
	

		return $query->result(); 
	}

	function highlights($id_user)
	{
		$query 		= $this->db->query("SELECT 
		a.employeeid
		, a.employeename
		, b.position_name
		, a.position_id 
		, a.employeegrade
		, c.empdatestart
		, d.id_user
		from employee_r_upload a
		left join posisi b
		on a.position_id = b.position_id
		left join employee c
		on a.employeeid = c.EmpId
		left join tbl_user d
		on a.employeeid = d.username
		where a.position_id in(
			SELECT head_pos_id 
			from organization 
			where parent_id in (
				SELECT a.org_id
				from employee_r_upload a
				left join tbl_user b
				on a.employeeid = b.username
				where b.id_user = '$id_user'
			)
		)
		OR a.org_id in (
			SELECT a.org_id
				from employee_r_upload a
				left join tbl_user b
				on a.employeeid = b.username
				where b.id_user = '$id_user'
		)
		AND a.employeeid NOT IN(
			SELECT a.employeeid
				from employee_r_upload a
				left join tbl_user b
				on a.employeeid = b.username
				where b.id_user = '$id_user'
		) 
	GROUP BY a.employeeid
									");
		

		return $query->result(); 
	}

	function successoronedown($id_user)
	{
		$query 		= $this->db->query("SELECT 
										c.employeeid
										, c.employeename
										, c.position_id
										, d.position_name 
										, b.id_user
										from successlist a
										left join tbl_user b
										on a.addby = b.id_user
										left join employee_r_upload c
										on b.username = c.employeeid
										left join posisi d
										on c.position_id = d.position_id
										where addby in (
											SELECT 
												d.id_user
												from employee_r_upload a
												left join posisi b
												on a.position_id = b.position_id
												left join employee c
												on a.employeeid = c.EmpId
												left join tbl_user d
												on a.employeeid = d.username
												where a.position_id in(
													SELECT head_pos_id 
													from organization 
													where parent_id in (
														SELECT a.org_id
														from employee_r_upload a
														left join tbl_user b
														on a.employeeid = b.username
														where b.id_user = '$id_user'
													)
												)
												OR a.org_id in (
													SELECT a.org_id
														from employee_r_upload a
														left join tbl_user b
														on a.employeeid = b.username
														where b.id_user = '$id_user'
												)
												AND a.employeeid NOT IN(
													SELECT a.employeeid
														from employee_r_upload a
														left join tbl_user b
														on a.employeeid = b.username
														where b.id_user = '$id_user'
												) 
														
										)
										group by c.employeeid");

		
		return $query->result(); 
	}

	function successoronedownlist($id_user)
	{
		$query 		= $this->db->query("
										SELECT 
												a.employeeid
												, a.employeename
												, b.position_name
												, b.position_id 
												, a.employeegrade
												, c.empdatestart
												, d.id_user
											from  posisi b
											left join employee_r_upload a
											on b.position_id = a.position_id
											left join employee c
											on a.employeeid = c.EmpId
											left join tbl_user d
											on a.employeeid = d.username
											where b.position_id in(
												SELECT head_pos_id 
												from organization 
												where parent_id in (
													SELECT a.org_id
													from employee_r_upload a
													left join tbl_user b
													on a.employeeid = b.username
													where b.id_user = '$id_user'
												)
											)
											OR b.org_id in (
												SELECT a.org_id
													from employee_r_upload a
													left join tbl_user b
													on a.employeeid = b.username
													where b.id_user = '$id_user'
											)
											AND a.employeeid NOT IN(
												SELECT a.employeeid
													from employee_r_upload a
													left join tbl_user b
													on a.employeeid = b.username
													where b.id_user = '$id_user'
											) 
										");

		
		
		return $query->result(); 
	}

	function notEligible($id_user)
	{
		$query 		= $this->db->query("SELECT 
										A.employeeid
										, A.employeename
										, p.position_id
										, p.position_name
										, ski.fski_final_score
										from (
											SELECT 
											a.employeeid 
											, a.employeename
											, a.period
											, a.position_id
											from employee_r_upload a
											left join organization b
											on a.org_id = b.orgid
											where a.org_id in (
												SELECT orgid
												from organization
												where parent_id in (
													SELECT org_id from employee_r_upload
													where employeeid in (
														SELECT username from tbl_user	
														where id_user = '$id_user'
													)
												)
												OR a.org_id in (
													SELECT a.org_id
														from employee_r_upload a
														left join tbl_user b
														on a.employeeid = b.username
														where b.id_user = '$id_user'
												)
												AND a.employeeid NOT IN(
													SELECT a.employeeid
														from employee_r_upload a
														left join tbl_user b
														on a.employeeid = b.username
														where b.id_user = '$id_user'
												)
											)
											union
											SELECT 
											a.employeeid 
											, a.employeename
											, a.period
											, a.position_id
											from employee_r_upload a
											left join organization b
											on a.org_id = b.orgid
											where b.parent_id in (
												SELECT orgid
												from organization
												where parent_id in (
													SELECT org_id from employee_r_upload
													where employeeid in (
														SELECT username from tbl_user	
														where id_user = '$id_user'
													)
												)
											)
											OR a.org_id in (
													SELECT a.org_id
														from employee_r_upload a
														left join tbl_user b
														on a.employeeid = b.username
														where b.id_user = '$id_user'
												)
												AND a.employeeid NOT IN(
													SELECT a.employeeid
														from employee_r_upload a
														left join tbl_user b
														on a.employeeid = b.username
														where b.id_user = '$id_user'
												)
												OR a.org_id in (
													SELECT orgid from organization
													where parent_id in (
														select orgid
														from organization where parent_id in (
															SELECT orgid
															from organization
															where parent_id in (
																SELECT orgid
																from organization
																where parent_id in (
																	SELECT org_id from employee_r_upload
																	where employeeid in (
																		SELECT username from tbl_user	
																		where id_user = '$id_user'
																	)
																)
															)
														)
													)
												)
									)A
									left join posisi p
										on A.position_id = p.position_id
									LEFT JOIN (
										SELECT fski_nip, fski_final_score
										FROM tbl_ski
										WHERE fski_year = '2016'
									) ski
										on A.employeeid = ski.fski_nip
									where A.employeeid not in (
										SELECT nip from talentlist
										where evaluator = '$id_user'
										and (flagdel is null or flagdel = 0)
									)
									group by A.employeeid");

		

		return $query->result(); 
	}
	/*
	function notEligible($id_user)
	{
		$query 			= $this->db->query("SELECT 
												a.employeeid
												, a.employeename
												, p.position_id
												, p.position_name
												, ski.fski_final_score
											FROM
											employee_r_upload a
											left join organization b
												on a.org_id = b.orgid 
											left join posisi p
												on a.position_id = p.position_id
											LEFT JOIN employee_program ep
												on a.employeeid = ep.nip
											LEFT Join (
												SELECT *
												FROM tbl_user
												where id_user = '$id_user'
											) c
												on a.employeeid = c.username
											

												on a.employeeid = ski.fski_nip
											left join (
												SELECT 
												b.fski_nip
												, ROUND(SUM(a.fres_nilai_tertimbang_1) / count(a.fres_nilai_tertimbang_1),2) as NilaiKoma

												from tbl_ski_result a
												left join tbl_ski b
													on a.fres_skino_desc = b.fski_no_desc
												where b.fski_year = '2016'
												GROUP by b.fski_nip
											) skikpi
											on a.employeeid = skikpi.fski_nip
											where 
											(
												a.employeeid not in (
												SELECT nip
												FROM employee_program
											) 
												AND a.employeegrade not in (
												'MGR1','MGR2','SM1','SM2','AVP1','AVP2','SVP1','SVP2','VP1','VP2'
											)
												AND a.employeeid not in (
													SELECT nip
													FROM critical_pos
												)
											)
											and 
											b.head_pos_id in 
											(
												SELECT 
													a.position_id 
												from posisi a
												left join organization b
													on a.org_id = b.orgid
												where a.flag_head = 'YES'
													and b.org_group_id in (
														SELECT org_group_id
															from employee_r_upload a
															left join tbl_user b
															on a.employeeid = b.username
															where b.id_user = '$id_user'
													)
											)
											and 
											a.employeeid not in (
												SELECT nip from talentlist
											)
											OR a.org_id in (
												SELECT orgid from organization
												where parent_id in (
													select orgid
													from organization where parent_id in (
														SELECT orgid
														from organization
														where parent_id in (
															SELECT orgid
															from organization
															where parent_id in (
																SELECT org_id from employee_r_upload
																where employeeid in (
																	SELECT username from tbl_user	
																	where id_user = '$id_user'
																)
															)
														)
													)
												)
											)
											and c.id_user IS NULL
											order by ski.fski_final_score DESC
											
											");
		

		return $query->result(); 
	}
	*/

	function countEmpAllDir($id_user)
	{
		$query 			= $this->db->query("SELECT 
											COUNT(employeeid) as totalEmp
											from employee_r_upload
											where org_id in (
												SELECT orgid from organization
												where parent_id in (
													select orgid
													from organization where parent_id in (
														SELECT orgid
														from organization
														where parent_id in (
															SELECT orgid
															from organization
															where parent_id in (
																SELECT org_id
																from employee_r_upload a
																left join tbl_user b
																on a.employeeid = b.username
																where b.id_user = '$id_user'
															)
														)
													)
												)
											)
										");
		return $query->row_array(); 
	}
	
	function countEmpAll($id_user)
	{
		$query 		= $this->db->query("SELECT 
										COUNT(totalEmp) as totalEmp
										, period
										FROM (SELECT 
											COUNT(A.employeeid) as totalEmp
											,A.period
											from (
												SELECT 
												a.employeeid 
												, a.employeename
												, a.period
												, a.position_id
												from employee_r_upload a
												left join organization b
												on a.org_id = b.orgid
												where a.org_id in (
													SELECT orgid
													from organization
													where parent_id in (
														SELECT org_id from employee_r_upload
														where employeeid in (
															SELECT username from tbl_user	
															where id_user = '$id_user'
														)
													)
													OR a.org_id in (
														SELECT a.org_id
															from employee_r_upload a
															left join tbl_user b
															on a.employeeid = b.username
															where b.id_user = '$id_user'
													)
													AND a.employeeid NOT IN(
														SELECT a.employeeid
															from employee_r_upload a
															left join tbl_user b
															on a.employeeid = b.username
															where b.id_user = '$id_user'
													)
												)
												union
												SELECT 
												a.employeeid 
												, a.employeename
												, a.period
												, a.position_id
												from employee_r_upload a
												left join organization b
												on a.org_id = b.orgid
												where b.parent_id in (
													SELECT orgid
													from organization
													where parent_id in (
														SELECT org_id from employee_r_upload
														where employeeid in (
															SELECT username from tbl_user	
															where id_user = '$id_user'
														)
													)
												)
												OR a.org_id in (
														SELECT a.org_id
															from employee_r_upload a
															left join tbl_user b
															on a.employeeid = b.username
															where b.id_user = '$id_user'
													)
													AND a.employeeid NOT IN(
														SELECT a.employeeid
															from employee_r_upload a
															left join tbl_user b
															on a.employeeid = b.username
															where b.id_user = '$id_user'
													)
													OR a.org_id in (
														SELECT orgid from organization
														where parent_id in (
															select orgid
															from organization where parent_id in (
																SELECT orgid
																from organization
																where parent_id in (
																	SELECT orgid
																	from organization
																	where parent_id in (
																		SELECT org_id from employee_r_upload
																		where employeeid in (
																			SELECT username from tbl_user	
																			where id_user = '$id_user'
																		)
																	)
																)
															)
														)
													)
										)A
										left join posisi p
											on A.position_id = p.position_id
										LEFT JOIN (
											SELECT fski_nip, fski_final_score
											FROM tbl_ski
											WHERE fski_year = '2016'
										) ski
											on A.employeename = ski.fski_nip
										group by A.employeeid
										)A");
		
		
		return $query->row_array(); 
	}
	

	function countEmpAll1($id_user)
	{
		$query 		= $this->db->query("SELECT 
										COUNT(a.employeeid) as totalEmp
										, a.period
										FROM
										employee_r_upload a
										left join organization b
											on a.org_id = b.orgid 
										left join posisi p
											on a.position_id = p.position_id
										LEFT JOIN employee_program ep
											on a.employeeid = ep.nip
										LEFT Join (
											SELECT *
											FROM tbl_user
											where id_user = '$id_user'
										) c
											on a.employeeid = c.username
										LEFT JOIN (
											SELECT fski_nip, fski_final_score
											FROM tbl_ski
											WHERE fski_year = '2016'
										) ski
											on a.employeeid = ski.fski_nip
										left join (
											SELECT 
											b.fski_nip
											, ROUND(SUM(a.fres_nilai_tertimbang_1) / count(a.fres_nilai_tertimbang_1),2) as NilaiKoma

											from tbl_ski_result a
											left join tbl_ski b
												on a.fres_skino_desc = b.fski_no_desc
											where b.fski_year = '2016'
											GROUP by b.fski_nip
										) skikpi
										on a.employeeid = skikpi.fski_nip
										where 
										
										b.head_pos_id in 
										(
											SELECT 
												a.position_id 
											from posisi a
											left join organization b
												on a.org_id = b.orgid
											where a.flag_head = 'YES'
												and b.org_group_id in (
													SELECT org_group_id
														from employee_r_upload a
														left join tbl_user b
														on a.employeeid = b.username
														where b.id_user = '$id_user'
												)
										)

										and c.id_user IS NULL
										order by ski.fski_final_score DESC
										
										");
		
		
		return $query->row_array(); 
	}

	function intoTalentListDir($id_user, $grade)
	{
		$this -> db -> select('evaluator');
		$this -> db -> from('talentlist');
		//$this -> db -> where('username', $username);
		$this -> db -> where('evaluator',$id_user);
		//$this -> db -> where('active', "yes");
		$this -> db -> limit(1);

		$query = $this -> db -> get();
		$num = $query -> num_rows();
		//echo $num;
		if($query -> num_rows() != 1)
		{

			$sekarang	= date("Y-m-d H:i:s");
			$year 		= date("Y");

			$query 		= $this->db->query("INSERT INTO talentlist 
											(
											nip, 
											position, 
											evaluator, 
											page, 
											year, 
											dateinp, 					
											flagadd)
												SELECT 
												a.employeeid
												, a.position_id
												, $id_user
												, 1
												, $year
												, '$sekarang'
												, 0
												from (
													SELECT 
														a.employeeid
														, a.employeename
														, a.employeegrade
														, a.org_id
														, b.position_name
														, a.position_id 
														from employee_r_upload a
														left join posisi b
														on a.position_id = b.position_id
														where a.position_id in(
															SELECT head_pos_id 
															from organization 
															where parent_id in (
																SELECT a.org_id
																from employee_r_upload a
																left join tbl_user b
																on a.employeeid = b.username
																where b.id_user = '$id_user'
															)
														)
														OR a.org_id in (
															SELECT a.org_id
																from employee_r_upload a
																left join tbl_user b
																on a.employeeid = b.username
																where b.id_user = '$id_user'
														)
														AND a.employeeid NOT IN(
															SELECT a.employeeid
																from employee_r_upload a
																left join tbl_user b
																on a.employeeid = b.username
																where b.id_user = '$id_user'
														) 
													)a 
													left join organization b
													on a.org_id = b.orgid 
													left join posisi p
													on a.position_id = p.position_id
													LEFT JOIN 
													employee_program ep
													on a.employeeid = ep.nip
													LEFT Join (
														SELECT *
														FROM tbl_user
														where id_user = '$id_user'
													) c
													on a.employeeid = c.username
													LEFT JOIN (
															SELECT *
																FROM tbl_ski
																WHERE fski_year = '2016'
															) ski
															on a.employeeid = ski.fski_nip
													left join (
														SELECT 
														b.fski_nip
														, ROUND(SUM(a.fres_nilai_tertimbang_1) / count(a.fres_nilai_tertimbang_1),2) as NilaiKoma

														from tbl_ski_result a
														left join tbl_ski b
														on a.fres_skino_desc = b.fski_no_desc
														where b.fski_year = '2016'
														GROUP by b.fski_nip
													) skikpi
													on a.employeeid = skikpi.fski_nip
													where 
													(
														a.employeeid in (
															SELECT nip
															FROM employee_program
														) 
														OR a.employeegrade in (
															/*'MGR1','MGR2','SM1','SM2','AVP1','AVP2','SVP1','SVP2','VP1','VP2'*/
															'MGR','MGR1','MGR2','SM','SM1','SM2','AVP','AVP1','AVP2','SVP','SVP1','SVP2','VP','VP1','VP2'
														)
														OR a.employeeid in (
															SELECT nip
															FROM critical_pos
														)
													)

													and c.id_user IS NULL
													group by a.employeeid
													order by a.employeename ASC

											"); 
		}
		else
		{
			return false;
		}
	}

	function intoTalentListDirTopDown($id_user)
	{
		$query 		= $this->db->query("SELECT 
										a.nip
										, b.position_id
										, a.evaluator
										, a.id_talent
										, c.employeename
										, b.position_name
										, a.page

										, ep.final
										, a.box
										, a.flagadd
										, a.flightrisk
										, a.evaluator
										, a.flagdel
										, ep.flag_del
										from talentlist a
										left join posisi b
										on a.position = b.position_id
										left join employee_r_upload c
										on a.nip = c.employeeid
										left join employeepotensi ep
										on a.nip = ep.nip
										where a.evaluator in (
										/* LIST ONE DOWN */
										SELECT 
											c.id_user
											from employee_r_upload a
											left join posisi b
											on a.position_id = b.position_id
											left join tbl_user c
											on a.employeeid = c.username
											where a.position_id in(
												SELECT head_pos_id 
												from organization 
												where parent_id in (
													SELECT a.org_id
													from employee_r_upload a
													left join tbl_user b
													on a.employeeid = b.username
													where b.id_user = '$id_user'
												)
											)
											OR a.org_id in (
												SELECT a.org_id
													from employee_r_upload a
													left join tbl_user b
													on a.employeeid = b.username
													where b.id_user = '$id_user'
											)
											AND a.employeeid NOT IN(
												SELECT a.employeeid
													from employee_r_upload a
													left join tbl_user b
													on a.employeeid = b.username
													where b.id_user = '$id_user'
											) 

										)
										group by a.nip");
		
		//$query = $this -> db -> get();
		$num = $query -> num_rows();
		
		/*
		if($query -> num_rows() == 0)
		{

			$sekarang		= date("Y-m-d H:i:s");
			$year 			= date("Y");
			$query 			= $this->db->query("INSERT INTO talentlist (nip, position, evaluator, page, year, dateinp, 												flagadd)
													SELECT
													a.nip
													, a.position
													, $id_user
													, 1
													, $year
													, '$sekarang'
													, 0
													from talentlist a
													left join talentlist b
													on a.nip = b.nip
													and a.evaluator != b.evaluator
													where a.evaluator in (
													SELECT id_user 
														from talentlist a
														left join tbl_user b
														on a.nip = b.username
														where evaluator in (
															SELECT evaluator from talentlist
															where evaluator = '$id_user'
														)
													)
													and a.nip not in (
														SELECT nip from talentlist
														where evaluator = '$id_user'
													)
													and a.box <> ''
												"); 
			
		}
		else
		{
			return false;
		}
		*/
	}

	function intoTalentList($id_user, $levelOrg)
	{
		$this -> db -> select('evaluator');
		$this -> db -> from('talentlist');
		//$this -> db -> where('username', $username);
		$this -> db -> where('evaluator',$id_user);
		//$this -> db -> where('active', "yes");
		$this -> db -> limit(1);

		$query = $this -> db -> get();
		$num = $query -> num_rows();
		//echo $num;
		if($query -> num_rows() != 1)
		{
			$sekarang		= date("Y-m-d H:i:s");
			$year 			= date("Y");
			if($levelOrg=='L1-H'){
				$query 		= $this->db->query("INSERT INTO talentlist (nip, position, evaluator, page, year, dateinp, 									flagadd)
												SELECT 
												a.employeeid
												, p.position_id
												, $id_user
												, 1
												, $year
												, '$sekarang'
												, 0
												FROM
												employee_r_upload a
												left join organization b
												on a.org_id = b.orgid 
												left join posisi p
												on a.position_id = p.position_id
												LEFT JOIN 
												employee_program ep
												on a.employeeid = ep.nip
												LEFT Join (
													SELECT *
													FROM tbl_user
													where id_user = '$id_user'
												) c
												on a.employeeid = c.username
												LEFT JOIN (
														SELECT *
															FROM tbl_ski
															WHERE fski_year = '2016'
														) ski
														on a.employeeid = ski.fski_nip
												left join (
													SELECT 
													b.fski_nip
													, ROUND(SUM(a.fres_nilai_tertimbang_1) / count(a.fres_nilai_tertimbang_1),2) as NilaiKoma

													from tbl_ski_result a
													left join tbl_ski b
													on a.fres_skino_desc = b.fski_no_desc
													where b.fski_year = '2016'
													GROUP by b.fski_nip
												) skikpi
												on a.employeeid = skikpi.fski_nip
												where 
												(
													a.employeeid in (
														SELECT nip
														FROM employee_program
													) 
													OR a.employeegrade in (
														
														'MGR','MGR1','MGR2','SM','SM1','SM2','AVP','AVP1','AVP2','SVP','SVP1','SVP2','VP','VP1','VP2'
													)
													OR a.employeeid in (
														SELECT nip
														FROM critical_pos
													)
												)
												and 
												b.head_pos_id in 
												(
													SELECT a.position_id 
													from posisi a
													left join organization b
													on a.org_id = b.orgid
													where a.flag_head = 'YES'
													and b.org_group_id in (
														SELECT org_group_id
														from employee_r_upload a
														left join tbl_user b
														on a.employeeid = b.username
														where b.id_user = '$id_user'
													)
												)
												
												and c.id_user IS NULL
												order by a.employeename ASC");

			}
			
				
											
			
			else if($levelOrg == 'L1-B' OR $levelOrg == 'L2-H' ){
				$query 	= $this->db->query("INSERT INTO talentlist (nip, position, evaluator, page)
												SELECT 
												a.employeeid
												, e.position_id
												
												
												, $id_user
												, 1
												from employee_r_upload a
												left join organization b
												on a.org_id = b.orgid
												left join tbl_user c
												on a.employeeid = c.username
												left join tbl_ski d 
												on a.employeeid = d.fski_nip
												left join posisi e
												on a.position_id = e.position_id								
												LEFT JOIN (
													SELECT *
														FROM tbl_ski
														WHERE fski_year = '2016'
													) ski
													on a.employeeid = ski.fski_nip
												left join (
														SELECT 
														b.fski_nip
														, ROUND(SUM(a.fres_nilai_tertimbang_1) / count(a.fres_nilai_tertimbang_1),2) as NilaiKoma

														from tbl_ski_result a
														left join tbl_ski b
														on a.fres_skino_desc = b.fski_no_desc
														where b.fski_year = '2016'
														GROUP by b.fski_nip
													) skikpi
													on a.employeeid = skikpi.fski_nip
												WHERE
												(
													a.employeeid in (
														SELECT nip
														FROM employee_program
													) 
													OR a.employeegrade in (
														/*'MGR1','MGR2','SM1','SM2','AVP1','AVP2','SVP1','SVP2','VP1','VP2'*/
														'MGR','MGR1','MGR2','SM','SM1','SM2','AVP','AVP1','AVP2','SVP','SVP1','SVP2','VP','VP1','VP2'
													)
													OR a.employeeid in (
														SELECT nip
														FROM critical_pos
													)
												) AND
												b.head_pos_id in (
													SELECT position_id
													from employee_r_upload aa
													left join tbl_user bb
													on aa.employeeid = bb.username
													where bb.id_user = '$id_user'
												)
												
												and (d.fski_year = '2016' OR d.fski_nip IS NULL)
												and c.username IS NULL
												group by a.employeeid
												ORDER BY a.EmployeeId DESC
												");
			}
			else{
				$query 		= $this->db->query("INSERT INTO 
												talentlist (
												nip, 
												position, 
												evaluator, 
												page, 
												year, 
												dateinp, 									
												flagadd)
												SELECT 
												a.employeeid
												, p.position_id
												, $id_user
												, 1
												, $year
												, '$sekarang'
												, 0
												FROM
												employee_r_upload a
												left join organization b
												on a.org_id = b.orgid 
												left join posisi p
												on a.position_id = p.position_id
												LEFT JOIN 
												employee_program ep
												on a.employeeid = ep.nip
												LEFT Join (
													SELECT *
													FROM tbl_user
													where id_user = '$id_user'
												) c
												on a.employeeid = c.username
												LEFT JOIN (
														SELECT *
															FROM tbl_ski
															WHERE fski_year = '2016'
														) ski
														on a.employeeid = ski.fski_nip
												left join (
													SELECT 
													b.fski_nip
													, ROUND(SUM(a.fres_nilai_tertimbang_1) / count(a.fres_nilai_tertimbang_1),2) as NilaiKoma

													from tbl_ski_result a
													left join tbl_ski b
													on a.fres_skino_desc = b.fski_no_desc
													where b.fski_year = '2016'
													GROUP by b.fski_nip
												) skikpi
												on a.employeeid = skikpi.fski_nip
												where 
												
												(
													a.employeeid in (
														SELECT nip
														FROM employee_program
													) 
													OR a.employeegrade in (
														/*'MGR1','MGR2','SM1','SM2','AVP1','AVP2','SVP1','SVP2','VP1','VP2'*/
														'MGR','MGR1','MGR2','SM','SM1','SM2','AVP','AVP1','AVP2','SVP','SVP1','SVP2','VP','VP1','VP2'
													)
													OR a.employeeid in (
														SELECT nip
														FROM critical_pos
													)
												)AND
												(
													b.head_pos_id in 
													(
														SELECT a.position_id 
														from posisi a
														left join organization b
														on a.org_id = b.orgid
														where a.flag_head = 'YES'
														and b.org_group_id in (
															SELECT org_group_id
															from employee_r_upload a
															left join tbl_user b
															on a.employeeid = b.username
															where b.id_user = '$id_user'
														)
													)
													
													OR b.orgid in (
														SELECT orgid 
														from organization
														where parent_id in (
														SELECT orgid
															FROM organization
															where head_pos_id in (
																SELECT a.position_id 
																from posisi a
																left join organization b
																on a.org_id = b.orgid
																where a.flag_head = 'YES'
																and b.org_group_id in (
																	SELECT org_group_id
																	from employee_r_upload a
																	left join tbl_user b
																	on a.employeeid = b.username
																	where b.id_user = '$id_user'
																)
															)

														)
													)
												)

												and c.id_user IS NULL
												
												
												order by a.employeename ASC");
			}
			
			//return $query->result();
		}
		else
		{
			return false;
		}
	}

	function flightrisk()
	{
	$query 		= $this->db->query("SELECT 
										a.id
										, a.category
										, a.level
										, a.definition
										, a.description
										, a.classification_by_tower
										, a.color
										, b.totalCategory
										from flightrisk a
										left join 
											(
												SELECT 
												id
												,category
												, COUNT(category) as totalCategory
												from flightrisk
												GROUP by category
											)b
										on a.id = b.id
										order by a.id ASC");
		return $query->result();
	}

	function countdef()
	{

	}
	
	function talentMappingList($id_user)
	{
		$query 		= $this->db->query("SELECT 
										a.nip
										, a.id_talent
										, b.employeename
										, c.position_name
										, a.page
										, ski.nilaiSki
										, ep.final
										, a.box
										, a.flagadd
										, a.cr_status
										, CASE 
												WHEN emp.employeeid is null THEN 'NO'
												ELSE 'YES'
											END AS oneDownFlag
										, aa.box as boxDir
										, epep.final as potDir
										from talentlist a
										left join employee_r_upload b
										on a.nip = b.employeeid
										left join talentlist aa
										on a.nip = aa.nip
										and a.evaluator != aa.evaluator
										left join posisi c
										on b.position_id = c.position_id
										LEFT JOIN (
											SELECT * from employeepotensi 
												where 1 and (flag_del = 0 OR flag_del IS NULL)
											)ep
											on a.nip = ep.nip
										LEFT JOIN (
											SELECT * from employeepotensi 
												where 1 and (flag_del = 0 OR flag_del IS NULL)
											)epep
											on ep.nip = epep.nip
										and ep.evaluator != epep.evaluator
										LEFT JOIN (
											SELECT 
												a.employeeid
												, a.employeename
												, b.position_name
												, a.position_id 
												, a.employeegrade
												, c.empdatestart
												from employee_r_upload a
												left join posisi b
												on a.position_id = b.position_id
												left join employee c
												on a.employeeid = c.EmpId
												where a.position_id in(
													SELECT head_pos_id 
													from organization 
													where parent_id in (
														SELECT a.org_id
														from employee_r_upload a
														left join tbl_user b
														on a.employeeid = b.username
														where b.id_user = '$id_user'
													)
												)
												OR a.org_id in (
													SELECT a.org_id
														from employee_r_upload a
														left join tbl_user b
														on a.employeeid = b.username
														where b.id_user = '$id_user'
												)
												AND a.employeeid NOT IN(
													SELECT a.employeeid
														from employee_r_upload a
														left join tbl_user b
														on a.employeeid = b.username
														where b.id_user = '$id_user'
												) 
										)emp
										on a.nip = emp.employeeid
										LEFT JOIN (
											SELECT 
												fski_nip
												, fski_final_score as nilaiSki
												from (
												select
													fski_nip
													, fski_year
													, fski_final_score
												from tbl_ski
												where fski_year in
													(SELECT max(fski_year) as MAXA
													FROM tbl_ski) 
												 
												
												)SKI
											GROUP by fski_nip
										) ski
										on a.nip = ski.fski_nip
										where a.evaluator = '$id_user'

										and (a.flagdel = '0' OR a.flagdel is null)
										and (ep.flag_del = '0' OR ep.flag_del is null)
										group by a.nip
										order by  oneDownFlag DESC,  a.flagadd ASC , b.employeename ");

		
		return $query->result();
	}
	
	/*
	function talentMappingList($id_user)
	{
		$query 			= $this->db->query("SELECT 
												a.id_talent
												, a.nip
												, a.employeename
												, a.position_name
												, a.final
												, c.nilaitopDown
												, c.topDown
												, c.nilaiOneDown
												, c.OneDown
												, a.flagadd
												, a.page
												, a.box
												, a.box
												, a.box as boxOneDown
												, box.box as boxTopDown
												, box.evaluator
												FROM 
												(	
													Select 
														a.nip
														, a.id_talent
														, b.employeename
														, c.position_name
														, a.page
														, ski.TotalK
														, ski.TotalTiga
														, ski.TotalB
														, ep.final
														, a.box
														, a.flagadd
														, a.flightrisk
														, a.evaluator
														, a.flagdel
														, ep.flag_del
														from talentlist a
														left join employee_r_upload b
														on a.nip = b.employeeid
														left join posisi c
														on b.position_id = c.position_id
														left join employeepotensi ep
														on a.nip = ep.nip
														and a.id_talent = ep.id_talent
														LEFT JOIN (
															SELECT 
																fski_nip
																, COUNT(CASE WHEN fski_final_score in (5,4) then 'K' END) AS TotalK
																, COUNT(CASE WHEN fski_final_score = 3 then 'Tiga' END) AS TotalTiga
																, COUNT(CASE WHEN fski_final_score in (2,1) then 'B' END) AS TotalB
																from (
																select
																	fski_nip
																	, fski_year
																	, fski_final_score
																from tbl_ski
																where fski_year between 
																	(SELECT max(fski_year)-2 AS MINI
																	FROM tbl_ski)
																	AND
																	(SELECT max(fski_year) as MAXA
																	FROM tbl_ski) 
																
																)SKI
															GROUP by fski_nip
														) ski
														on a.nip = ski.fski_nip
														where a.evaluator = '$id_user'
														and (a.flagdel IS NULL OR a.flagdel = '0')
														group by a.nip
													
													UNION
													Select 
														a.nip
														, a.id_talent
														, b.employeename
														, c.position_name
														, a.page
														, ski.TotalK
														, ski.TotalTiga
														, ski.TotalB
														, ep.final
														, a.box
														, a.flagadd
														, a.flightrisk
														, a.evaluator
														, a.flagdel
														, ep.flag_del
														from talentlist a
														left join employee_r_upload b
														on a.nip = b.employeeid
														left join posisi c
														on b.position_id = c.position_id
														left join employeepotensi ep
														on a.nip = ep.nip
														and a.id_talent = ep.id_talent
														LEFT JOIN (
															SELECT 
																fski_nip
																, COUNT(CASE WHEN fski_final_score in (5,4) then 'K' END) AS TotalK
																, COUNT(CASE WHEN fski_final_score = 3 then 'Tiga' END) AS TotalTiga
																, COUNT(CASE WHEN fski_final_score in (2,1) then 'B' END) AS TotalB
																from (
																select
																	fski_nip
																	, fski_year
																	, fski_final_score
																from tbl_ski
																where fski_year between 
																	(SELECT max(fski_year)-2 AS MINI
																	FROM tbl_ski)
																	AND
																	(SELECT max(fski_year) as MAXA
																	FROM tbl_ski) 
																
																)SKI
															GROUP by fski_nip
														) ski
														on a.nip = ski.fski_nip
														
														where a.evaluator in (
															SELECT id_user 
															from talentlist a
															left join tbl_user b
															on a.nip = b.username
															where evaluator in (
																SELECT evaluator from talentlist
																where evaluator = '$id_user'
															)
														)
														and ep.final != ''
														and (a.flagdel IS NULL OR a.flagdel = '0')
														group by a.nip
													)a		
													left join talentlist b
													on a.nip = b.nip
													left join (
														SELECT 
															a.nip as nip
															, a.final as nilaitopDown
															, a.evaluator as topDown
															, b.final as nilaiOneDown
															, b.evaluator as OneDown
														from employeepotensi a
														left join employeepotensi b
														on a.nip = b.nip
														and a.evaluator != b.evaluator
														group by a.nip		
													)c
													on a.nip = c.nip
													left join (
														SELECT nip, evaluator, box 
														from talentlist
													)box
													on a.nip = box.nip
													and a.evaluator <> box.evaluator
													
													group by a.nip
													order by a.flagadd ASC
											");
		echo "SELECT 
												a.id_talent
												, a.nip
												, a.employeename
												, a.position_name
												, a.final
												, c.nilaitopDown
												, c.topDown
												, c.nilaiOneDown
												, c.OneDown
												, a.flagadd
												, a.page
												, a.box
												, a.box
												, a.box as boxOneDown
												, box.box as boxTopDown
												, box.evaluator
												FROM 
												(	
													Select 
														a.nip
														, a.id_talent
														, b.employeename
														, c.position_name
														, a.page
														, ski.TotalK
														, ski.TotalTiga
														, ski.TotalB
														, ep.final
														, a.box
														, a.flagadd
														, a.flightrisk
														, a.evaluator
														, a.flagdel
														, ep.flag_del
														from talentlist a
														left join employee_r_upload b
														on a.nip = b.employeeid
														left join posisi c
														on b.position_id = c.position_id
														left join employeepotensi ep
														on a.nip = ep.nip
														and a.id_talent = ep.id_talent
														LEFT JOIN (
															SELECT 
																fski_nip
																, COUNT(CASE WHEN fski_final_score in (5,4) then 'K' END) AS TotalK
																, COUNT(CASE WHEN fski_final_score = 3 then 'Tiga' END) AS TotalTiga
																, COUNT(CASE WHEN fski_final_score in (2,1) then 'B' END) AS TotalB
																from (
																select
																	fski_nip
																	, fski_year
																	, fski_final_score
																from tbl_ski
																where fski_year between 
																	(SELECT max(fski_year)-2 AS MINI
																	FROM tbl_ski)
																	AND
																	(SELECT max(fski_year) as MAXA
																	FROM tbl_ski) 
																
																)SKI
															GROUP by fski_nip
														) ski
														on a.nip = ski.fski_nip
														where a.evaluator = '$id_user'
														and (a.flagdel IS NULL OR a.flagdel = '0')
														group by a.nip
													
													UNION
													Select 
														a.nip
														, a.id_talent
														, b.employeename
														, c.position_name
														, a.page
														, ski.TotalK
														, ski.TotalTiga
														, ski.TotalB
														, ep.final
														, a.box
														, a.flagadd
														, a.flightrisk
														, a.evaluator
														, a.flagdel
														, ep.flag_del
														from talentlist a
														left join employee_r_upload b
														on a.nip = b.employeeid
														left join posisi c
														on b.position_id = c.position_id
														left join employeepotensi ep
														on a.nip = ep.nip
														and a.id_talent = ep.id_talent
														LEFT JOIN (
															SELECT 
																fski_nip
																, COUNT(CASE WHEN fski_final_score in (5,4) then 'K' END) AS TotalK
																, COUNT(CASE WHEN fski_final_score = 3 then 'Tiga' END) AS TotalTiga
																, COUNT(CASE WHEN fski_final_score in (2,1) then 'B' END) AS TotalB
																from (
																select
																	fski_nip
																	, fski_year
																	, fski_final_score
																from tbl_ski
																where fski_year between 
																	(SELECT max(fski_year)-2 AS MINI
																	FROM tbl_ski)
																	AND
																	(SELECT max(fski_year) as MAXA
																	FROM tbl_ski) 
																
																)SKI
															GROUP by fski_nip
														) ski
														on a.nip = ski.fski_nip
														
														where a.evaluator in (
															SELECT id_user 
															from talentlist a
															left join tbl_user b
															on a.nip = b.username
															where evaluator in (
																SELECT evaluator from talentlist
																where evaluator = '$id_user'
															)
														)
														and ep.final != ''
														and (a.flagdel IS NULL OR a.flagdel = '0')
														group by a.nip
													)a		
													left join talentlist b
													on a.nip = b.nip
													left join (
														SELECT 
															a.nip as nip
															, a.final as nilaitopDown
															, a.evaluator as topDown
															, b.final as nilaiOneDown
															, b.evaluator as OneDown
														from employeepotensi a
														left join employeepotensi b
														on a.nip = b.nip
														and a.evaluator != b.evaluator
														group by a.nip		
													)c
													on a.nip = c.nip
													left join (
														SELECT nip, evaluator, box 
														from talentlist
													)box
													on a.nip = box.nip
													and a.evaluator <> box.evaluator
													
													group by a.nip
													order by a.flagadd ASC
											";
		return $query->result();
	}
	*/
	function talentMappingListDir($id_user)
	{
		$query 		= $this->db->query("SELECT 
										a.nip
										, a.id_talent
										, b.employeename
										, c.position_name
										, a.page
										, a.cr_status
										, ski.nilaiSki
										, ep.final
										, a.box
										, a.flagadd
										from talentlist a
										left join employee_r_upload b
										on a.nip = b.employeeid
										left join posisi c
										on b.position_id = c.position_id
										LEFT JOIN (
											SELECT * from employeepotensi 
											where 1 and (flag_del = 0 OR flag_del IS NULL)
										)ep
										on a.nip = ep.nip
										LEFT JOIN (
												SELECT 
											a.employeeid
											, a.employeename
											, b.position_name
											, a.position_id 
											, a.employeegrade
											, c.empdatestart
											from employee_r_upload a
											left join posisi b
											on a.position_id = b.position_id
											left join employee c
											on a.employeeid = c.EmpId
											where a.position_id in(
												SELECT head_pos_id 
												from organization 
												where parent_id in (
													SELECT a.org_id
													from employee_r_upload a
													left join tbl_user b
													on a.employeeid = b.username
													where b.id_user = '$id_user'
												)
											)
											OR a.org_id in (
												SELECT a.org_id
													from employee_r_upload a
													left join tbl_user b
													on a.employeeid = b.username
													where b.id_user = '$id_user'
											)
											AND a.employeeid NOT IN(
												SELECT a.employeeid
													from employee_r_upload a
													left join tbl_user b
													on a.employeeid = b.username
													where b.id_user = '$id_user'
											) 
										)emp
										on a.nip = emp.employeeid
										LEFT JOIN (
											SELECT 
												fski_nip
												, fski_final_score as nilaiSki
												from (
												select
													fski_nip
													, fski_year
													, fski_final_score
												from tbl_ski
												where fski_year in
													(SELECT max(fski_year) as MAXA
													FROM tbl_ski) 
												 
												
												)SKI
											GROUP by fski_nip
										) ski
										on a.nip = ski.fski_nip
										where a.evaluator = '$id_user'
										and (a.flagdel = '0' OR a.flagdel is null)
										and (ep.flag_del = '0' OR ep.flag_del is null)
										and a.adddir = 'No'
										group by a.nip
										order by  a.flagadd ASC , b.employeename DESC ");


		
		return $query->result();
	}

	function talentMappingListAllTopDown($id_user)
	{
		$query 		= $this->db->query("
											SELECT 
											a.nip
											, b.employeename
											, b.employeeid
											, a.box 
											, c.final
											, d.position_name
											, a.cr_status
											from talentlist a
											left join employee_r_upload b
											on a.nip = b.employeeid
											left join employeepotensi c
											on a.nip = c.nip
											left join posisi d 
											on b.position_id = d.position_id
											where a.evaluator in (
											SELECT 
											u.id_user
											FROM
											employee_r_upload a
											left join organization b
											on a.org_id = b.orgid 
											left join posisi p
											on a.position_id = p.position_id
											LEFT JOIN 
											employee_program ep
											on a.employeeid = ep.nip
											LEFT JOIN tbl_user u
											on a.employeeid = u.username
											LEFT Join (
												SELECT *
												FROM tbl_user
												where id_user = '$id_user'
											) c
											on a.employeeid = c.username
											LEFT JOIN (
													SELECT *
														FROM tbl_ski
														WHERE fski_year = '2016'
													) ski
													on a.employeeid = ski.fski_nip
											left join (
												SELECT 
												b.fski_nip
												, ROUND(SUM(a.fres_nilai_tertimbang_1) / count(a.fres_nilai_tertimbang_1),2) as NilaiKoma

												from tbl_ski_result a
												left join tbl_ski b
												on a.fres_skino_desc = b.fski_no_desc
												where b.fski_year = '2016'
												GROUP by b.fski_nip
											) skikpi
											on a.employeeid = skikpi.fski_nip
											where 

											(
												a.employeeid in (
													SELECT nip
													FROM employee_program
												) 
												OR a.employeegrade in (
													/*'MGR1','MGR2','SM1','SM2','AVP1','AVP2','SVP1','SVP2','VP1','VP2'*/
													'MGR','MGR1','MGR2','SM','SM1','SM2','AVP','AVP1','AVP2','SVP','SVP1','SVP2','VP','VP1','VP2'
												)
												OR a.employeeid in (
													SELECT nip
													FROM critical_pos
												)
											)AND
											(
												b.head_pos_id in 
												(
													SELECT a.position_id 
													from posisi a
													left join organization b
													on a.org_id = b.orgid
													where a.flag_head = 'YES'
													and b.org_group_id in (
														SELECT org_group_id
														from employee_r_upload a
														left join tbl_user b
														on a.employeeid = b.username
														where b.id_user = '$id_user'
													)
												)
												
												OR b.orgid in (
													SELECT orgid 
													from organization
													where parent_id in (
													SELECT orgid
														FROM organization
														where head_pos_id in (
															SELECT a.position_id 
															from posisi a
															left join organization b
															on a.org_id = b.orgid
															where a.flag_head = 'YES'
															and b.org_group_id in (
																SELECT org_group_id
																from employee_r_upload a
																left join tbl_user b
																on a.employeeid = b.username
																where b.id_user = '$id_user'
															)
														)

													)
												)
											)
											and c.id_user IS NULL
											order by a.employeename ASC
											)");


		
		return $query->result();
	}

	function talentMappingListDirTopDown($id_user)
	{
		$query 		= $this->db->query("SELECT 
										a.nip
										, b.position_id
										, a.evaluator as useradd
										, a.id_talent
										, c.employeename
										, b.position_name
										, a.page
										, a.cr_status
										, ep.final
										, d.employeename as evaluatorname
										, d.employeeid as evaluatorid
										, a.box
										, a.flagadd
										, a.flightrisk
										, a.flagdel

										, ep.flag_del
										, epdir.final as finalepdir
										, tldir.evaluator
										, tldir.box as boxdir
										from talentlist a
										left join posisi b
										on a.position = b.position_id
										left join employee_r_upload c
										on a.nip = c.employeeid
										left join employeepotensi ep
										on a.nip = ep.nip
										left join tbl_user u 
										on a.evaluator = u.id_user
										left join employee_r_upload d
										on u.username = d.employeeid
										left join (
											SELECT *
											from employeepotensi 
											where evaluator = '$id_user'
										)epdir
										on a.nip = epdir.nip 
										left join (
											SELECT * 
											from talentlist
											where evaluator = '$id_user'
										)tldir
										on a.nip = tldir.nip
										where a.evaluator in (
										/* LIST ONE DOWN */
										SELECT 
											c.id_user
											from employee_r_upload a
											left join posisi b
											on a.position_id = b.position_id
											left join tbl_user c
											on a.employeeid = c.username
											where a.position_id in(
												SELECT head_pos_id 
												from organization 
												where parent_id in (
													SELECT a.org_id
													from employee_r_upload a
													left join tbl_user b
													on a.employeeid = b.username
													where b.id_user = '$id_user'
												)
											)
											OR a.org_id in (
												SELECT a.org_id
													from employee_r_upload a
													left join tbl_user b
													on a.employeeid = b.username
													where b.id_user = '$id_user'
											)
											AND a.employeeid NOT IN(
												SELECT a.employeeid
													from employee_r_upload a
													left join tbl_user b
													on a.employeeid = b.username
													where b.id_user = '$id_user'
											) 

										)
										group by a.nip");


		
		return $query->result();
	}

	function checklastski($nip)
	{
		$tahunSekarang 	= date("Y");
		$skilastyear = $tahunSekarang - 2;
		$query 		= $this->db->query("SELECT 
											fski_final_score
											FROM tbl_ski
											where fski_nip = '$nip'
											and fski_year = '$skilastyear' ");
		

		return $query->row_array(); 
	}

	function checkbox($nip){
		$query 		= $this->db->query("SELECT 
										a.nip
										, b.employeename
										, c.position_name
										, a.page
										, ski.Nilai1
										, ski.Nilai2
										, ski.Nilai3
										, ep.final
										, rb.potensi
										, rb.box
										from talentlist a
										left join employee_r_upload b
										on a.nip = b.employeeid
										left join posisi c
										on b.position_id = c.position_id
										left join employeepotensi ep
										on a.nip = ep.nip
										LEFT JOIN (
											SELECT 
											nip
											, CASE 
													WHEN Nilai1 in (5,4) then 'H' 
													WHEN Nilai1 in (3) then '3' 
													WHEN Nilai1 in (2,1) then 'L' 
												END AS Nilai1
											, CASE 
													WHEN Nilai2 in (5,4) then 'H' 
													WHEN Nilai2 in (3) then '3' 
													WHEN Nilai2 in (2,1) then 'L' 
												END AS Nilai2
											, CASE 
													WHEN Nilai3 in (5,4) then 'H' 
													WHEN Nilai3 in (3) then '3' 
													WHEN Nilai3 in (2,1) then 'L' 
												END AS Nilai3
											from (
												SELECT 
													fski_nip as nip
													, MAX(CASE when fski_year = (SELECT max(fski_year)-2 AS MINI FROM tbl_ski) then fski_final_score end) as Nilai1
													, MAX(CASE when fski_year = (SELECT max(fski_year)-1 AS MINI FROM tbl_ski) then fski_final_score end) as Nilai2
													, MAX(CASE when fski_year = (SELECT max(fski_year) AS MINI FROM tbl_ski) then fski_final_score end) as Nilai3	
													from (
													select
														fski_nip
														, fski_year
														, fski_final_score
													from tbl_ski
													where fski_year between 
														(SELECT max(fski_year)-2 AS MINI
														FROM tbl_ski)
														AND
														(SELECT max(fski_year) as MAXA
														FROM tbl_ski) 
													
													)SKI
													group by fski_nip
											)AS newrumus3
										) ski
										on a.nip = ski.nip
										LEFT JOIN rumusbox3 rb
										on ski.Nilai1 = rb.nilai1
										and ski.Nilai2 = rb.nilai2
										and ski.Nilai3 = rb.nilai3
										and ep.final =  rb.potensi
										where a.nip = '$nip'");
		return $query->result();
	}

	function checkbox3($nip, $id_user){
		$query 		= $this->db->query("SELECT 
										a.nip
										, b.employeename
										, c.position_name
										, a.page
										, ski.skinilaitahunsatu
										, ski.skinilaitahundua
										
										, ep.final
										, rb.potensi
										, rb.box
										from talentlist a
										left join employee_r_upload b
										on a.nip = b.employeeid
										left join posisi c
										on b.position_id = c.position_id
										left join employeepotensi ep
										on a.nip = ep.nip
										LEFT JOIN (
											SELECT 
											A.fski_nip
											,max(case when fski_year = '2015' then fski_final_score else '0' end) AS 'skinilaitahunsatu'
											,max(case when fski_year = '2016' then fski_final_score else '0' end) as 'skinilaitahundua'
											FROM (
											SELECT fski_nip, fski_year, fski_final_score from tbl_ski 
											where fski_year = '2015'
											union all
											SELECT fski_nip, fski_year, fski_final_score from tbl_ski 
											where fski_year = '2016'

											)A
											
											GROUP by A.fski_nip
												
										) ski
										on a.nip = ski.fski_nip
										LEFT JOIN rumusbox3 rb
										on ski.skinilaitahunsatu = rb.nilai1
										and ski.skinilaitahundua = rb.nilai2
										and ep.final =  rb.potensi
										where a.nip = '$nip'
										and (ep.flag_del = 0 OR ep.flag_del is null)
										and ep.evaluator = '$id_user' 
										group by rb.box");
		
		return $query->result();
	}

	function checkbox3add($nip){
		$query 		= $this->db->query("SELECT 
										a.nip
										, b.employeename
										, c.position_name
										, a.page
										, ski.skinilaitahunsatu
										, ski.skinilaitahundua
										
										, a.box
										from talentlist a
										left join employee_r_upload b
										on a.nip = b.employeeid
										left join posisi c
										on b.position_id = c.position_id
										left join employeepotensi ep
										on a.nip = ep.nip
										LEFT JOIN (
											SELECT 
												satu.fski_nip
												, satu.fski_year as skitahunsatu
												, satu.fski_final_score as skinilaitahunsatu
												, dua.fski_year as skitahundua
												, dua.fski_final_score as skinilaitahundua
												from tbl_ski satu
												left join tbl_ski dua
												on satu.fski_nip = dua.fski_nip
												where satu.fski_year = '2015'
												and dua.fski_year = '2016'
												order by satu.fski_year desc
												
										) ski
										on a.nip = ski.fski_nip
										LEFT JOIN rumusbox3 rb
										on ski.skinilaitahunsatu = rb.nilai1
										and ski.skinilaitahundua = rb.nilai2
										and ep.final =  rb.potensi
										where a.nip = '$nip'
										GROUP BY a.nip");
		return $query->row_array();
	}

	function checkpotensi($nip, $eval){
		$query 		= $this->db->query("SELECT 
										a.nip
										, b.employeename
										, c.position_name
										, a.page
										, ski.skinilaitahunsatu
										, ski.skinilaitahundua
										, rb.potensi
										, a.box
										from talentlist a
										left join employee_r_upload b
										on a.nip = b.employeeid
										left join posisi c
										on b.position_id = c.position_id
										left join employeepotensi ep
										on a.nip = ep.nip
										LEFT JOIN (
											SELECT 
												satu.fski_nip
												, satu.fski_year as skitahunsatu
												, satu.fski_final_score as skinilaitahunsatu
												, dua.fski_year as skitahundua
												, dua.fski_final_score as skinilaitahundua
												from tbl_ski satu
												left join tbl_ski dua
												on satu.fski_nip = dua.fski_nip
												where satu.fski_year = '2015'
												and dua.fski_year = '2016'
												order by satu.fski_year desc
												
										) ski
										on a.nip = ski.fski_nip
										LEFT JOIN rumusbox3 rb
										on ski.skinilaitahunsatu = rb.nilai1
										and ski.skinilaitahundua = rb.nilai2
										and ep.final = rb.potensi
										where a.nip = '$nip'
										and a.evaluator = '$eval'");
		return $query->row_array();
	}

	function talentNineBox2nd($id_user)
	{
		$query 		= $this->db->query("SELECT 
												COUNT(CASE WHEN BOX=0 then BOX END) AS DATA0
												, COUNT(CASE WHEN BOX=1 then BOX END) AS DATA1
												, COUNT(CASE WHEN BOX=2 then BOX END) AS DATA2
												, COUNT(CASE WHEN BOX=3 then BOX END) AS DATA3
												, COUNT(CASE WHEN BOX=4 then BOX END) AS DATA4
												, COUNT(CASE WHEN BOX=5 then BOX END) AS DATA5
												, COUNT(CASE WHEN BOX=6 then BOX END) AS DATA6
												, COUNT(CASE WHEN BOX=7 then BOX END) AS DATA7
												, COUNT(CASE WHEN BOX=8 then BOX END) AS DATA8
												, COUNT(CASE WHEN BOX=9 then BOX END) AS DATA9
											from talentlist
											where evaluator = '$id_user'
											and flagdel != '1'");
	
		
		return $query->row_array();
	}

	function talentNineBoxOneDown($id_user)
	{
		$query 		= $this->db->query("SELECT 
										COUNT(CASE WHEN BOX=0 then BOX END) AS DATA0
										, COUNT(CASE WHEN BOX=1 then BOX END) AS DATA1
										, COUNT(CASE WHEN BOX=2 then BOX END) AS DATA2
										, COUNT(CASE WHEN BOX=3 then BOX END) AS DATA3
										, COUNT(CASE WHEN BOX=4 then BOX END) AS DATA4
										, COUNT(CASE WHEN BOX=5 then BOX END) AS DATA5
										, COUNT(CASE WHEN BOX=6 then BOX END) AS DATA6
										, COUNT(CASE WHEN BOX=7 then BOX END) AS DATA7
										, COUNT(CASE WHEN BOX=8 then BOX END) AS DATA8
										, COUNT(CASE WHEN BOX=9 then BOX END) AS DATA9
									from talentlist a													
										where a.flagdel != '1' and a.nip in (
											SELECT 
												a.employeeid

												from employee_r_upload a
												left join posisi b
												on a.position_id = b.position_id
												left join employee c
												on a.employeeid = c.EmpId
												where a.position_id in(
													SELECT head_pos_id 
													from organization 
													where parent_id in (
														SELECT a.org_id
														from employee_r_upload a
														left join tbl_user b
														on a.employeeid = b.username
														where b.id_user = '$id_user'
													)
												)
												OR a.org_id in (
													SELECT a.org_id
														from employee_r_upload a
														left join tbl_user b
														on a.employeeid = b.username
														where b.id_user = '$id_user'
												)
												AND a.employeeid NOT IN(
													SELECT a.employeeid
														from employee_r_upload a
														left join tbl_user b
														on a.employeeid = b.username
														where b.id_user = '$id_user'
												) 
																		
											) 
											");
	
		
		return $query->row_array();
	}

	function talentNineBoxAll($id_user)
	{
		$query 	= $this->db->query("
					SELECT 
					COUNT(CASE WHEN BOX=0 then BOX END) AS DATA0
					, COUNT(CASE WHEN BOX=1 then BOX END) AS DATA1
					, COUNT(CASE WHEN BOX=2 then BOX END) AS DATA2
					, COUNT(CASE WHEN BOX=3 then BOX END) AS DATA3
					, COUNT(CASE WHEN BOX=4 then BOX END) AS DATA4
					, COUNT(CASE WHEN BOX=5 then BOX END) AS DATA5
					, COUNT(CASE WHEN BOX=6 then BOX END) AS DATA6
					, COUNT(CASE WHEN BOX=7 then BOX END) AS DATA7
					, COUNT(CASE WHEN BOX=8 then BOX END) AS DATA8
					, COUNT(CASE WHEN BOX=9 then BOX END) AS DATA9
				from(

					
					SELECT 
							A.nip
							, b.employeename
							, c.position_name												
							, a.evaluator
							, a.box
							
							from(

								SELECT 
								*
								from talentlist					
								
								where evaluator = '$id_user'
								and flagdel != '1'
								and box is not null
								union
								SELECT * 
								from talentlist
								where  flagdel != '1' AND
								evaluator in (
									SELECT 
											d.id_user
											from employee_r_upload a
											left join posisi b
											on a.position_id = b.position_id
											left join employee c
											on a.employeeid = c.EmpId
											left join tbl_user d
											on a.employeeid = d.username
											where a.position_id in(
												SELECT head_pos_id 
												from organization 
												where parent_id in (
													SELECT a.org_id
													from employee_r_upload a
													left join tbl_user b
													on a.employeeid = b.username
													where b.id_user = '$id_user'
												)
											)
											OR a.org_id in (
												SELECT a.org_id
													from employee_r_upload a
													left join tbl_user b
													on a.employeeid = b.username
													where b.id_user = '$id_user'
											)
											AND a.employeeid NOT IN(
												SELECT a.employeeid
													from employee_r_upload a
													left join tbl_user b
													on a.employeeid = b.username
													where b.id_user = '$id_user'
											)
								)
								)A
								left join employee_r_upload b
								on A.nip = b.employeeid
								left join posisi c
								on b.position_id = c.position_id
							where 1 and (A.evaluator = '$id_user')
					group by A.nip

					UNION

					SELECT 
							A.nip
							, b.employeename
							, c.position_name												
							, a.evaluator
							, a.box
							
							from(

								SELECT 
								*
								from talentlist					
								
								where evaluator = '$id_user'
								and flagdel != '1'
								and box is not null
								union
								SELECT * 
								from talentlist
								where  flagdel != '1' AND
								evaluator in (
									SELECT 
											d.id_user
											from employee_r_upload a
											left join posisi b
											on a.position_id = b.position_id
											left join employee c
											on a.employeeid = c.EmpId
											left join tbl_user d
											on a.employeeid = d.username
											where a.position_id in(
												SELECT head_pos_id 
												from organization 
												where parent_id in (
													SELECT a.org_id
													from employee_r_upload a
													left join tbl_user b
													on a.employeeid = b.username
													where b.id_user = '$id_user'
												)
											)
											OR a.org_id in (
												SELECT a.org_id
													from employee_r_upload a
													left join tbl_user b
													on a.employeeid = b.username
													where b.id_user = '$id_user'
											)
											AND a.employeeid NOT IN(
												SELECT a.employeeid
													from employee_r_upload a
													left join tbl_user b
													on a.employeeid = b.username
													where b.id_user = '$id_user'
											)
								)
								)A
								left join employee_r_upload b
								on A.nip = b.employeeid
								left join posisi c
								on b.position_id = c.position_id
							where 1 
					group by A.nip
				)a");
	
		
		return $query->row_array();
	}

	function talentNineBox($id_user)
	{
		$query 		= $this->db->query("SELECT 
									 	COUNT(CASE WHEN LP.BOX=0 then LP.BOX END) AS DATA0
										, COUNT(CASE WHEN LP.BOX=1 then LP.BOX END) AS DATA1
										, COUNT(CASE WHEN LP.BOX=2 then LP.BOX END) AS DATA2
										, COUNT(CASE WHEN LP.BOX=3 then LP.BOX END) AS DATA3
										, COUNT(CASE WHEN LP.BOX=4 then LP.BOX END) AS DATA4
										, COUNT(CASE WHEN LP.BOX=5 then LP.BOX END) AS DATA5
										, COUNT(CASE WHEN LP.BOX=6 then LP.BOX END) AS DATA6
										, COUNT(CASE WHEN LP.BOX=7 then LP.BOX END) AS DATA7
										, COUNT(CASE WHEN LP.BOX=8 then LP.BOX END) AS DATA8
										, COUNT(CASE WHEN LP.BOX=9 then LP.BOX END) AS DATA9
										FROM
										(
											Select 
											a.nip
											, b.employeename
											, c.position_name												
											, ep.final
											, rb.box
											from talentlist a
											left join employee_r_upload b
											on a.nip = b.employeeid
											left join posisi c
											on b.position_id = c.position_id
											left join tbl_ski ski
											on a.nip = ski.fski_nip
											left join employeepotensi ep
											on a.nip = ep.nip
											left join 
											(
												SELECT *
												from rumusbox
												
											) rb
											on 
											(
												CASE  
													WHEN a.ski IS NULL
													THEN 0
													ELSE a.ski
												END 
											) = rb.ski
											and ep.final = rb.potensi
											where a.evaluator = '$id_user'
											and (ski.fski_year = '2016' or ski.fski_nip is null)
											
										)LP
										HAVING COUNT(LP.BOX)	");
	
		
		return $query->row_array();
	}

	function talentMapping($id_user, $levelOrg)
	{
		if($levelOrg=='L1-H'){
			$query 		= $this->db->query("SELECT * FROM
											employee_r_upload a
											left join organization b
											on a.org_id = b.orgid 
											left join posisi p
											on a.position_id = p.position_id
											LEFT JOIN 
											employee_program ep
											on a.employeeid = ep.nip
											LEFT Join (
												SELECT *
												FROM tbl_user
												where id_user = '$id_user'
											) c
											on a.employeeid = c.username
											LEFT JOIN (
													SELECT *
														FROM tbl_ski
														WHERE fski_year = '2016'
													) KUM
													on a.employeeid = KUM.fski_nip
											where 
											(
												a.employeeid in (
													SELECT nip
													FROM employee_program
												) 
												OR a.employeegrade in (
													/*'MGR1','MGR2','SM1','SM2','AVP1','AVP2','SVP1','SVP2','VP1','VP2'*/
													'MGR','MGR1','MGR2','SM','SM1','SM2','AVP','AVP1','AVP2','SVP','SVP1','SVP2','VP','VP1','VP2'
												)
												OR a.employeeid in (
													SELECT nip
													FROM critical_pos
												)
											)
											and 
											b.head_pos_id in 
											(
												SELECT a.position_id
												FROM employee_r_upload c
												left join posisi a
												on c.position_id = a.position_id
												left join organization b
												on a.org_id = b.orgid
												where a.flag_head = 'YES'
												and b.org_group_id in (
													SELECT org_group_id
													from employee_r_upload a
													left join tbl_user b
													on a.employeeid = b.username
													where b.id_user = '$id_user'
												)
											)
											
											and c.id_user IS NULL
											
											order by a.employeename ASC");
		}
		else if($levelOrg == 'L1-B' OR $levelOrg == 'L2-H' ){
			$query 		= $this->db->query("SELECT * 
											from employee_r_upload a
											left join organization b
											on a.org_id = b.orgid
											left join tbl_user c
											on a.employeeid = c.username
											left join tbl_ski d 
											on a.employeeid = d.fski_nip
											left join posisi e
											on a.position_id = e.position_id
											WHERE
											(
												a.employeeid in (
													SELECT nip
													FROM employee_program
												) 
												OR a.employeegrade in (
													/*'MGR1','MGR2','SM1','SM2','AVP1','AVP2','SVP1','SVP2','VP1','VP2'*/
													'MGR','MGR1','MGR2','SM','SM1','SM2','AVP','AVP1','AVP2','SVP','SVP1','SVP2','VP','VP1','VP2'
												)
												OR a.employeeid in (
													SELECT nip
													FROM critical_pos
												)
											) AND
											b.head_pos_id in (
												SELECT position_id
												from employee_r_upload aa
												left join tbl_user bb
												on aa.employeeid = bb.username
												where bb.id_user = '$id_user'
											)
											
											and (d.fski_year = '2016' OR d.fski_nip IS NULL)
											and c.username IS NULL
											group by a.employeeid
											ORDER BY a.EmployeeId DESC
											");
		}
		else{
			$query 		= $this->db->query("SELECT * 
											from employee_r_upload a
											left join organization b
											on a.org_id = b.orgid
											left join tbl_user c
											on a.employeeid = c.username
											left join tbl_ski d 
											on a.employeeid = d.fski_nip
											left join posisi e
											on a.position_id = e.position_id
											WHERE
											(
												a.employeeid in (
													SELECT nip
													FROM employee_program
												) 
												OR a.employeegrade in (
													/*'MGR1','MGR2','SM1','SM2','AVP1','AVP2','SVP1','SVP2','VP1','VP2'*/
													'MGR','MGR1','MGR2','SM','SM1','SM2','AVP','AVP1','AVP2','SVP','SVP1','SVP2','VP','VP1','VP2'
												)
												OR a.employeeid in (
													SELECT nip
													FROM critical_pos
												)
											) AND
											b.head_pos_id in (
												SELECT position_id
												from employee_r_upload aa
												left join tbl_user bb
												on aa.employeeid = bb.username
												where bb.id_user = '$id_user'
											)
											and a.employeegrade in 
											(
											/*'AM1','AM2','MGR1','MGR2','SM1','SM2','AVP1','AVP2','SVP1','SVP2','VP1','VP2'*/
											'AM','AM1','AM2','MGR','MGR1','MGR2','SM','SM1','SM2','AVP','AVP1','AVP2','SVP','SVP1','SVP2','VP','VP1','VP2'
											)
											and (d.fski_year = '2016' OR d.fski_nip IS NULL)
											and c.username IS NULL
											group by a.employeeid
											ORDER BY a.EmployeeId DESC
											");

		}
		
		
		//return $query->row()->id_group;
		return $query->result();
	}

	public function boxCount($iduser, $total)
	{
		$query 		= $this->db->query("SELECT 
										a.nip
										, b.employeename
										, c.position_name												
										, ep.final
										, a.box
										
										from talentlist a
										left join employee_r_upload b
										on a.nip = b.employeeid
										left join posisi c
										on b.position_id = c.position_id
										
										left join employeepotensi ep
										on a.nip = ep.nip
										
										where a.evaluator = '$iduser'
										
										and a.box = '$total'
										group by a.nip
										
									");

		
		return $query->result();
	}

	public function boxCountDir($iduser, $total)
	{
		$query 		= $this->db->query("SELECT 
										a.nip
										, b.employeename
										, c.position_name												
										, ep.final
										, a.box
										
										from talentlist a
										left join employee_r_upload b
										on a.nip = b.employeeid
										left join posisi c
										on b.position_id = c.position_id
										
										left join employeepotensi ep
										on a.nip = ep.nip
										
										where a.nip in (
											SELECT 
												a.employeeid

												from employee_r_upload a
												left join posisi b
												on a.position_id = b.position_id
												left join employee c
												on a.employeeid = c.EmpId
												where a.position_id in(
													SELECT head_pos_id 
													from organization 
													where parent_id in (
														SELECT a.org_id
														from employee_r_upload a
														left join tbl_user b
														on a.employeeid = b.username
														where b.id_user = '$iduser'
													)
												)
												OR a.org_id in (
													SELECT a.org_id
														from employee_r_upload a
														left join tbl_user b
														on a.employeeid = b.username
														where b.id_user = '$iduser'
												)
												AND a.employeeid NOT IN(
													SELECT a.employeeid
														from employee_r_upload a
														left join tbl_user b
														on a.employeeid = b.username
														where b.id_user = '$iduser'
												) 
																		
											)
										
										and a.box = '$total'
										and a.flagdel != '1'
										group by a.nip
										
									");

		
		return $query->result();
	}

	public function boxCountDirAll($iduser, $total)
	{
		$query 		= $this->db->query("SELECT * from (
										SELECT 
										A.nip
										, b.employeename
										, c.position_name												
										, a.evaluator
										, a.box
										
										from(

											SELECT 
											*
											from talentlist					
											
											where evaluator = '$iduser'
											and flagdel != '1'
											and box is not null
											union
											SELECT * 
											from talentlist
											where  flagdel != '1' AND
											evaluator in (
												SELECT 
														d.id_user
														from employee_r_upload a
														left join posisi b
														on a.position_id = b.position_id
														left join employee c
														on a.employeeid = c.EmpId
														left join tbl_user d
														on a.employeeid = d.username
														where a.position_id in(
															SELECT head_pos_id 
															from organization 
															where parent_id in (
																SELECT a.org_id
																from employee_r_upload a
																left join tbl_user b
																on a.employeeid = b.username
																where b.id_user = '$iduser'
															)
														)
														OR a.org_id in (
															SELECT a.org_id
																from employee_r_upload a
																left join tbl_user b
																on a.employeeid = b.username
																where b.id_user = '$iduser'
														)
														AND a.employeeid NOT IN(
															SELECT a.employeeid
																from employee_r_upload a
																left join tbl_user b
																on a.employeeid = b.username
																where b.id_user = '$iduser'
														)
											)
											)A
											left join employee_r_upload b
											on A.nip = b.employeeid
											left join posisi c
											on b.position_id = c.position_id
										where 1 and (A.evaluator = '$iduser')
								group by A.nip

								UNION

								SELECT 
										A.nip
										, b.employeename
										, c.position_name												
										, a.evaluator
										, a.box
										
										from(

											SELECT 
											*
											from talentlist					
											
											where evaluator = '$iduser'
											and flagdel != '1'
											and box is not null
											union
											SELECT * 
											from talentlist
											where  flagdel != '1' AND
											evaluator in (
												SELECT 
														d.id_user
														from employee_r_upload a
														left join posisi b
														on a.position_id = b.position_id
														left join employee c
														on a.employeeid = c.EmpId
														left join tbl_user d
														on a.employeeid = d.username
														where a.position_id in(
															SELECT head_pos_id 
															from organization 
															where parent_id in (
																SELECT a.org_id
																from employee_r_upload a
																left join tbl_user b
																on a.employeeid = b.username
																where b.id_user = '$iduser'
															)
														)
														OR a.org_id in (
															SELECT a.org_id
																from employee_r_upload a
																left join tbl_user b
																on a.employeeid = b.username
																where b.id_user = '$iduser'
														)
														AND a.employeeid NOT IN(
															SELECT a.employeeid
																from employee_r_upload a
																left join tbl_user b
																on a.employeeid = b.username
																where b.id_user = '$iduser'
														)
											)
											)A
											left join employee_r_upload b
											on A.nip = b.employeeid
											left join posisi c
											on b.position_id = c.position_id
										where 1 
								group by A.nip
							)a
							where a.box = '$total'
							group by a.nip");

		
		return $query->result();
	}

	public function getSki($nip)
	{
		$query 		= $this->db->query("SELECT 
										fski_nip
										, fski_final_score
										, fski_position_proin_desc
										, fski_year
										from tbl_ski
										where fski_year between 
													(SELECT max(fski_year)-1 AS MINI
													FROM tbl_ski)
													AND
													(SELECT max(fski_year) as MAXA
													FROM tbl_ski) 
										and fski_nip = '$nip'");
		return $query->result();
	}

	public function getTotalBox($iduser)
	{
		$query 		= $this->db->query("SELECT 
										a.nip
										, b.employeename
										, c.position_name												
										, ep.final
										, rb.box
										from talentlist a
										left join employee_r_upload b
										on a.nip = b.employeeid
										left join posisi c
										on b.position_id = c.position_id
										left join tbl_ski ski
										on a.nip = ski.fski_nip
										left join employeepotensi ep
										on a.nip = ep.nip
										left join 
										(
											SELECT *
											from rumusbox
											
										) rb
										on 
										(
											CASE  
												WHEN a.ski IS NULL
												THEN 0
												ELSE a.ski
											END 
										) = rb.ski
										and ep.final = rb.potensi
										where a.evaluator = '$iduser'
										and (ski.fski_year = '2016' or ski.fski_nip is null)");
		return $query->row_array();
	}

	public function getRulCr($iduser)
	{
		$query 		= $this->db->query("
									SELECT ep.final,  SKI.nilaiSki
									from employeepotensi ep
									left join (
										select
											fski_nip
											, fski_year
											, fski_final_score as nilaiSki
										from tbl_ski
										where fski_year in
											(SELECT max(fski_year) as MAXA
											FROM tbl_ski) 
										and fski_nip = '$iduser'
										)SKI
									on ep.nip = SKI.fski_nip
									where ep.nip = '$iduser'
									and flag_del = '0'");

		
		return $query->row_array();
	}

	public function talentHistory($nip_tl, $ideva)
	{
		$query 		= $this->db->query("SELECT * 
										from employeepotensi 
										where nip = '$nip_tl' 
										and evaluator = '$ideva'");
		return $query->row_array();
	}



	/*function insertToTalentList()
	{

	}*/

	public function sEmployee($id_user, $keyword, $levelOrg)
	{
		if($levelOrg=='L1-H'){
			$query 		= $this->db->query("SELECT * FROM
											employee_r_upload a
											left join organization b
											on a.org_id = b.orgid 
											left join posisi p
											on a.position_id = p.position_id
											LEFT JOIN 
											employee_program ep
											on a.employeeid = ep.nip
											LEFT Join (
												SELECT *
												FROM tbl_user
												where id_user = '$id_user'
											) c
											on a.employeeid = c.username
											LEFT JOIN (
													SELECT *
														FROM tbl_ski
														WHERE fski_year = '2016'
													) KUM
													on a.employeeid = KUM.fski_nip
											where 1
											and (a.employeeid like '%$keyword%' OR a.employeename like '%$keyword%')
											and
											b.head_pos_id in 
											(
												SELECT a.position_id
												FROM employee_r_upload c
												left join posisi a
												on c.position_id = a.position_id
												left join organization b
												on a.org_id = b.orgid
												where a.flag_head = 'YES'
												and b.org_group_id in (
													SELECT org_group_id
													from employee_r_upload a
													left join tbl_user b
													on a.employeeid = b.username
													where b.id_user = '$id_user'
												)
											)
											
											and c.id_user IS NULL
											/*
											and a.employeeid not in (
												Select 
												nip 
												from talentlist a
												left join employee_r_upload b
												on a.nip = b.employeeid
												left join posisi c
												on b.position_id = c.position_id
												left join tbl_ski ski
												on a.nip = ski.fski_nip
												where a.evaluator = '$id_user'
												and (ski.fski_year = '2016' or ski.fski_nip is null)
											)
											*/
											order by a.employeename ASC
												LIMIT 0,6");
			
		}
		else if($levelOrg == 'L1-B' OR $levelOrg == 'L2-H' ){
			$query 		= $this->db->query("SELECT * 
											from employee_r_upload a
											left join organization b
											on a.org_id = b.orgid
											left join tbl_user c
											on a.employeeid = c.username
											left join tbl_ski d 
											on a.employeeid = d.fski_nip
											left join posisi e
											on a.position_id = e.position_id
											WHERE
											b.head_pos_id in (
												SELECT position_id
												from employee_r_upload aa
												left join tbl_user bb
												on aa.employeeid = bb.username
												where bb.id_user = '$id_user'
											)
											
											and (d.fski_year = '2016' OR d.fski_nip IS NULL)
											and (a.employeename like '%$keyword%' OR a.employeeid = '$keyword')
											and c.username IS NULL
											group by a.employeeid
											ORDER BY a.EmployeeId DESC
											");
		}
		else{
			$query 		= $this->db->query("SELECT * 
											from employee_r_upload a
											left join organization b
											on a.org_id = b.orgid
											left join tbl_user c
											on a.employeeid = c.username
											left join tbl_ski d 
											on a.employeeid = d.fski_nip
											left join posisi e
											on a.position_id = e.position_id
											WHERE
											(
												a.employeeid in (
													SELECT nip
													FROM employee_program
												) 
												OR a.employeegrade in (
													/*'MGR1','MGR2','SM1','SM2','AVP1','AVP2','SVP1','SVP2','VP1','VP2'*/
													'MGR','MGR1','MGR2','SM','SM1','SM2','AVP','AVP1','AVP2','SVP','SVP1','SVP2','VP','VP1','VP2'
												)
												OR a.employeeid in (
													SELECT nip
													FROM critical_pos
												)
											) AND
											b.head_pos_id in (
												SELECT position_id
												from employee_r_upload aa
												left join tbl_user bb
												on aa.employeeid = bb.username
												where bb.id_user = '$id_user'
											)
											and a.employeegrade in 
											(
											/*'AM1','AM2','MGR1','MGR2','SM1','SM2','AVP1','AVP2','SVP1','SVP2','VP1','VP2'*/
											'AM','AM1','AM2','MGR','MGR1','MGR2','SM','SM1','SM2','AVP','AVP1','AVP2','SVP','SVP1','SVP2','VP','VP1','VP2'
											)
											and (d.fski_year = '2016' OR d.fski_nip IS NULL)
											and c.username IS NULL
											group by a.employeeid
											ORDER BY a.EmployeeId DESC
											");

		}
		return $query->result();
	}

	public function sEmployeeS($id_user, $keyword)
	{
		
	
		$query 		= $this->db->query("SELECT * FROM
										employee_r_upload a
										left join organization b
										on a.org_id = b.orgid 
										left join posisi p
										on a.position_id = p.position_id
										LEFT JOIN 
										employee_program ep
										on a.employeeid = ep.nip
										LEFT Join (
											SELECT *
											FROM tbl_user
											where id_user = '$id_user'
										) c
										on a.employeeid = c.username
										LEFT JOIN (
												SELECT *
													FROM tbl_ski
													WHERE fski_year = '2016'
													and fski_final_score in ('3','4','5')
												) KUM
												on a.employeeid = KUM.fski_nip
										where 
										1 
										and KUM.fski_final_score  in ('3','4','5')
										and (a.employeeid like '%$keyword%' OR a.employeename like '%$keyword%')
										and c.id_user IS NULL
										/*
										and a.employeeid not in (
											Select 
											nip 
											from talentlist a
											left join employee_r_upload b
											on a.nip = b.employeeid
											left join posisi c
											on b.position_id = c.position_id
											left join tbl_ski ski
											on a.nip = ski.fski_nip
											where a.evaluator = '$id_user'
											and (ski.fski_year = '2016' or ski.fski_nip is null)
										)
										*/
										group by a.employeeid
										order by a.employeename ASC");
		
		return $query->result();
	}

	/*
	public function sEmployeeS($id_user, $keyword, $levelOrg)
	{
		
		if($levelOrg=='L1-H'){
			$query 		= $this->db->query("SELECT * FROM
												employee_r_upload a
												left join organization b
												on a.org_id = b.orgid 
												left join posisi p
												on a.position_id = p.position_id
												LEFT JOIN 
												employee_program ep
												on a.employeeid = ep.nip
												LEFT Join (
													SELECT *
													FROM tbl_user
													where id_user = '$id_user'
												) c
												on a.employeeid = c.username
												LEFT JOIN (
														SELECT *
															FROM tbl_ski
															WHERE fski_year = '2016'
															and fski_final_score in ('3','4','5')
														) KUM
														on a.employeeid = KUM.fski_nip
												where 
												1 
												and (a.employeeid like '%$keyword%' OR a.employeename like '%$keyword%')
												and c.id_user IS NULL
												/*
												and a.employeeid not in (
													Select 
													nip 
													from talentlist a
													left join employee_r_upload b
													on a.nip = b.employeeid
													left join posisi c
													on b.position_id = c.position_id
													left join tbl_ski ski
													on a.nip = ski.fski_nip
													where a.evaluator = '$id_user'
													and (ski.fski_year = '2016' or ski.fski_nip is null)
												)
												sampe sini
												group by a.employeeid
												order by a.employeename ASC");
			
		}
		else if($levelOrg == 'L1-B' OR $levelOrg == 'L2-H' ){
			$query 		= $this->db->query("SELECT * 
												from employee_r_upload a
												left join organization b
												on a.org_id = b.orgid
												left join tbl_user c
												on a.employeeid = c.username
												left join tbl_ski d 
												on a.employeeid = d.fski_nip
												left join posisi e
												on a.position_id = e.position_id
												WHERE
												(d.fski_year = '2016' OR d.fski_nip IS NULL)
												and (a.employeename like '%$keyword%' OR a.employeeid = '$keyword')
												and c.username IS NULL
												group by a.employeeid
												ORDER BY a.EmployeeId DESC
											");
		}
		else{
			$query 		= $this->db->query("SELECT * 
												from employee_r_upload a
												left join organization b
												on a.org_id = b.orgid
												left join tbl_user c
												on a.employeeid = c.username
												left join tbl_ski d 
												on a.employeeid = d.fski_nip
												left join posisi e
												on a.position_id = e.position_id
												WHERE
												(
													a.employeeid in (
														SELECT nip
														FROM employee_program
													) 
													OR a.employeegrade in (
														'MGR1','MGR2','SM1','SM2','AVP1','AVP2','SVP1','SVP2','VP1','VP2'
													)
													OR a.employeeid in (
														SELECT nip
														FROM critical_pos
													)
												) AND
												b.head_pos_id in (
													SELECT position_id
													from employee_r_upload aa
													left join tbl_user bb
													on aa.employeeid = bb.username
													where bb.id_user = '$id_user'
												)
												and a.employeegrade in 
												(
												'AM1','AM2','MGR1','MGR2','SM1','SM2','AVP1','AVP2','SVP1','SVP2','VP1','VP2'
												)
												and (d.fski_year = '2016' OR d.fski_nip IS NULL)
												and c.username IS NULL
												group by a.employeeid
												ORDER BY a.EmployeeId DESC
											");

		}
		return $query->result();
		
	}
	*/

	function getEmpData($employeeid){
		
		$query		= $this->db->query("SELECT 
										a.employeeid 
										, a.employeename
										, p.position_id
										, ski.fski_final_score
										, skikpi.NilaiKoma
										, p.position_name
										
										from employee_r_upload a
										left join posisi p
										on a.position_id = p.position_id
										left join tbl_ski ski
										on a.employeeid = ski.fski_nip
										left join (
													SELECT 
													b.fski_nip
													, ROUND(SUM(a.fres_nilai_tertimbang_1) / count(a.fres_nilai_tertimbang_1),2) as NilaiKoma

													from tbl_ski_result a
													left join tbl_ski b
													on a.fres_skino_desc = b.fski_no_desc
													where b.fski_year = '2016'
													GROUP by b.fski_nip
												) skikpi
										on a.employeeid = skikpi.fski_nip
										
										where a.employeeid = '$employeeid'
										group by a.employeeid");
		
		
		return $query->row_array(); 

	}

	function getTalentData($employeeid, $dataUser){
		
		$query		= $this->db->query("SELECT 
										id_talent 
										from talentlist 
										where nip = '$employeeid' 
										and evaluator = '$dataUser'");
		
		
		return $query->row_array(); 

	}

	public function checkPotensiScore($a1, $a2, $a3)
	{
		$query		= $this->db->query("SELECT 
											final
											from rumuspotensi 
										where aspiration in (select rumus from childrumusbox where child_rumus = '$a1')
										and ability in (select rumus from childrumusbox where child_rumus = '$a2')
										and engangement in (select rumus from childrumusbox where child_rumus = '$a3')");
		
		
		return $query->row_array(); 
	}

	public function checkPotensiInput($id_user){
		/*$query		= $this->db->query("SELECT 
											count(a.nip) as Total
											from talentlist a
											where nip not in (
												SELECT 
													a.nip 
												from employeepotensi a
												left join talentlist b
												on a.nip = b.nip
												where b.evaluator = '$id_user'
											)
											and a.evaluator = '$id_user'");*/
		$query		= $this->db->query("
										SELECT 
											count(a.nip) as Total
										from employeepotensi a
										left join talentlist b
										on a.nip = b.nip
										where b.evaluator = '$id_user'
									");
		return $query->row_array(); 
	}

	public function checkPotensiInputTotal($id_user){
		$query		= $this->db->query("SELECT 
											count(b.nip) as Total
										from talentlist b
										
										where b.evaluator = '$id_user'");
		
		return $query->row_array(); 
	}

	/*public function updateToHipo($id_user)
	{
		$query		= $this->db->query("update talentlist set page = '2' where evaluator = '$id_user'");
	}*/

	public function hipoListDir($id_user)
	{
		$query		= $this->db->query("SELECT 
										a.nip
										, d.employeename
										, e.position_name
										, a.box
										, a.flightrisk
										, fr.level
										, fr.category
										, a.deldir
										, a.dirid
										, a.cr_status
										, emprog.nip as emprog
										from talentlist a
										left join employeepotensi b
										on a.nip = b.nip
										left join tbl_ski ski
										on a.nip = ski.fski_nip 
										left join rumusbox c
										on b.final = c.potensi
										and ski.fski_final_score = c.ski
										left join employee_r_upload d
										on a.nip = d.employeeid
										left join posisi e
										on a.position = e.position_id
										left join flightrisk fr
										on a.flightrisk = fr.level
										left join employee_program emprog
										on a.nip = emprog.nip
										where 1
										AND 
										(
											a.box in ('9','8','7')
											OR(
												a.nip in 
												(
													SELECT nip
													FROM employee_program
												)
												
											)
											OR (
												a.cr_status = 'Yes'
											)
										)
										and a.evaluator = '$id_user'
										and a.box != ''
										and (a.deldir != '1' OR a.deldir is null)
										GROUP by a.nip
										");
		return $query->result();
	}

	public function hipoListDirAll($id_user)
	{
		$query		= $this->db->query("SELECT 
										a.nip
										, d.employeename
										, e.position_name
										, a.box
										, a.flightrisk
										, fr.level
										, fr.category
										, a.deldir
										, a.dirid
										, a.cr_status
										from talentlist a
										left join employeepotensi b
										on a.nip = b.nip
										left join tbl_ski ski
										on a.nip = ski.fski_nip 
										left join rumusbox c
										on b.final = c.potensi
										and ski.fski_final_score = c.ski
										left join employee_r_upload d
										on a.nip = d.employeeid
										left join posisi e
										on a.position = e.position_id
										left join flightrisk fr
										on a.flightrisk = fr.level
										where 1
										AND 
										(
											a.box in ('9','8','7')
											OR(
												a.nip in 
												(
													SELECT nip
													FROM employee_program
												)
												
											)
											OR (
												a.cr_status = 'Yes'
											)
										)
										and a.evaluator in (

											SELECT 
												c.id_user
												from employee_r_upload a
												left join posisi b
												on a.position_id = b.position_id
												left join tbl_user c
												on a.employeeid = c.username
												where a.position_id in(
													SELECT head_pos_id 
													from organization 
													where parent_id in (
														SELECT a.org_id
														from employee_r_upload a
														left join tbl_user b
														on a.employeeid = b.username
														where b.id_user = '$id_user'
													)
												)
												OR a.org_id in (
													SELECT a.org_id
														from employee_r_upload a
														left join tbl_user b
														on a.employeeid = b.username
														where b.id_user = '$id_user'
												)
												AND a.employeeid NOT IN(
													SELECT a.employeeid
														from employee_r_upload a
														left join tbl_user b
														on a.employeeid = b.username
														where b.id_user = '$id_user'
												) 

											

										)
										and a.box != ''
										and (a.deldir != '1' OR a.deldir is null)
										GROUP by a.nip
										");
		return $query->result();
	}

	public function getNotes($id){
		$query		= $this->db->query("SELECT 
										notes,
										dateupd
										from notes

										where id_talent = '$id'
										");
		
		return $query->result();
	}
		
	public function hipoList($id_user)
	{
		$query		= $this->db->query("SELECT 
										a.id_talent
										, a.nip
										, d.employeename
										, e.position_name
										, a.box
										, a.flightrisk
										, fr.level
										, fr.category
										, a.cr_status
										, emprog.nip as emprog
										, d.employeegrade
										from talentlist a
										left join employeepotensi b
										on a.nip = b.nip
										left join tbl_ski ski
										on a.nip = ski.fski_nip 
										left join rumusbox c
										on b.final = c.potensi
										and ski.fski_final_score = c.ski
										left join employee_r_upload d
										on a.nip = d.employeeid
										left join posisi e
										on a.position = e.position_id
										left join flightrisk fr
										on a.flightrisk = fr.level
										left join employee_program emprog
										on a.nip = emprog.nip
										where 1
										AND 
										(
											a.box in ('9','8','7')
											OR(
												a.nip in 
												(
													SELECT nip
													FROM employee_program
													where program = 'MMDP'
												)
												
											)
											OR (
												a.cr_status = 'Yes'
											)
										)
										and a.evaluator = '$id_user'
										and a.box != ''

										GROUP by a.nip
										");
		
		return $query->result();
	}

	public function hipoListReport($id_user)
		{
			$query		= $this->db->query("SELECT 
											DETAIL.nip
											, DETAIL.employeename 
											, DETAIL.box
											, DETAIL.position_name
											, DETAIL.evaluator
											, DETAIL.id_career
											, DETAIL.careerplan
											, DETAIL.development
											, DETAIL.id_development
											, ROWNIP.ROWSPANNIP
											, ROWNIP.id
											, ROWCAREER.id_career
											, ROWCAREER.ROWSPANCAREER
											
											from 
											(
											SELECT 
											a.nip
											, a.evaluator
											, b.employeename
											, a.box
											, e.position_name
											, c.id as id_career
											, c.careerplan
											, d.id as id_development
											, d.development
											
											from talentlist a
											left join employee_r_upload b
											on a.nip = b.employeeid
											left join careerplan c
											on a.nip = c.nip
											left join development_hipo d
											on a.nip = d.nip
											and c.id = d.id_career
											left join posisi e
											on b.position_id = e.position_id
											
											where a.box in ('7','8','9')
											and a.evaluator = '$id_user'
											order by a.nip, c.careerplan, d.development
											) as DETAIL
											LEFT JOIN
											(
											SELECT 
											a.nip
											,COUNT(a.nip) as ROWSPANNIP
											, c.id
											from talentlist a
											left join employee_r_upload b
											on a.nip = b.employeeid
											left join careerplan c
											on a.nip = c.nip
											left join development_hipo d
											on a.nip = d.nip
											left join posisi e
											on b.position_id = e.position_id
											where a.box in ('7','8','9')
											and a.evaluator = '$id_user'
											GROUP BY a.nip
											) AS ROWNIP
											on DETAIL.nip = ROWNIP.nip

											LEFT JOIN
											(
											SELECT 
											a.nip
											,COUNT(d.id_career) as ROWSPANCAREER
											,d.id_career
											,d.id
											from talentlist a
											left join employee_r_upload b
											on a.nip = b.employeeid
											left join careerplan c
											on a.nip = c.nip
											left join development_hipo d
											on a.nip = d.nip
											and c.id = d.id_career
											left join posisi e
											on b.position_id = e.position_id
											where a.box in ('7','8','9')
											and a.evaluator = '$id_user'
											GROUP BY d.id_career
											) AS ROWCAREER
											on DETAIL.id_career = ROWCAREER.id_career
											and DETAIL.nip = ROWCAREER.nip
											WHERE DETAIL.evaluator = '$id_user'

											");
			return $query->result();
		}

		/*public function hipoListReport($id_user)
		{
			$query		= $this->db->query("SELECT 
											DETAIL.nip
											, DETAIL.employeename 
											, DETAIL.box
											, DETAIL.position_name
											, DETAIL.evaluator
											, DETAIL.id_career
											, DETAIL.careerplan
											, DETAIL.development
											, DETAIL.id_development
											, ROWNIP.ROWSPANNIP
											, ROWNIP.id
											, ROWCAREER.id_career
											, ROWCAREER.ROWSPANCAREER
											, DETAIL.flightrisk
											, DETAIL.level
											, DETAIL.category
											from 
											(
											SELECT 
											a.nip
											, a.evaluator
											, b.employeename
											, a.box
											, e.position_name
											, c.id as id_career
											, c.careerplan
											, d.id as id_development
											, d.development
											, a.flightrisk
											, fr.level
											, fr.category
											from talentlist a
											left join employee_r_upload b
											on a.nip = b.employeeid
											left join careerplan c
											on a.nip = c.nip
											left join development_hipo d
											on a.nip = d.nip
											and c.id = d.id_career
											left join posisi e
											on b.position_id = e.position_id
											left join flightrisk fr
											on a.flightrisk = fr.level
											where a.box in ('7','8','9')
											and a.evaluator = '$id_user'
											order by a.nip, c.careerplan, d.development
											) as DETAIL
											LEFT JOIN
											(
											SELECT 
											a.nip
											,COUNT(a.nip) as ROWSPANNIP
											, c.id
											from talentlist a
											left join employee_r_upload b
											on a.nip = b.employeeid
											left join careerplan c
											on a.nip = c.nip
											left join development_hipo d
											on a.nip = d.nip
											left join posisi e
											on b.position_id = e.position_id
											where a.box in ('7','8','9')
											and a.evaluator = '$id_user'
											GROUP BY a.nip
											) AS ROWNIP
											on DETAIL.nip = ROWNIP.nip

											LEFT JOIN
											(
											SELECT 
											a.nip
											,COUNT(d.id_career) as ROWSPANCAREER
											,d.id_career
											,d.id
											from talentlist a
											left join employee_r_upload b
											on a.nip = b.employeeid
											left join careerplan c
											on a.nip = c.nip
											left join development_hipo d
											on a.nip = d.nip
											and c.id = d.id_career
											left join posisi e
											on b.position_id = e.position_id
											where a.box in ('7','8','9')
											and a.evaluator = '$id_user'
											GROUP BY d.id_career
											) AS ROWCAREER
											on DETAIL.id_career = ROWCAREER.id_career
											and DETAIL.nip = ROWCAREER.nip
											WHERE DETAIL.evaluator = '$id_user'

											");
			return $query->result();
		}*/

	public function hipoListReportDir($id_user)
	{
		$query		= $this->db->query("SELECT 
									DETAIL.nip
									, DETAIL.employeename 
									, DETAIL.box
									, DETAIL.position_name
									, DETAIL.evaluator
									, DETAIL.id_career
									, DETAIL.careerplan
									, DETAIL.development
									, DETAIL.id_development
									, ROWNIP.ROWSPANNIP
									, ROWNIP.id
									, ROWCAREER.id_career
									, ROWCAREER.ROWSPANCAREER
									, DETAIL.flightrisk
									, DETAIL.level
									, DETAIL.category
									from 
									(
									SELECT 
									a.nip
									, a.evaluator
									, b.employeename
									, a.box
									, e.position_name
									, c.id as id_career
									, c.careerplan
									, d.id as id_development
									, d.development
									, a.flightrisk
									, fr.level
									, fr.category
									from talentlist a
									left join employee_r_upload b
									on a.nip = b.employeeid
									left join careerplan c
									on a.nip = c.nip
									left join development_hipo d
									on c.id = d.id_career
									left join posisi e
									on b.position_id = e.position_id
									left join flightrisk fr
									on a.flightrisk = fr.level
									where (a.box in ('7','8','9') OR a.cr_status = 'Yes'OR a.nip in (SELECT nip from employee_program))
									and ( a.evaluator = '$id_user' OR a.evaluator in (SELECT 
												c.id_user
												from employee_r_upload a
												left join posisi b
												on a.position_id = b.position_id
												left join tbl_user c
												on a.employeeid = c.username
												where a.position_id in(
													SELECT head_pos_id 
													from organization 
													where parent_id in (
														SELECT a.org_id
														from employee_r_upload a
														left join tbl_user b
														on a.employeeid = b.username
														where b.id_user = '$id_user'
													)
												)
												OR a.org_id in (
													SELECT a.org_id
														from employee_r_upload a
														left join tbl_user b
														on a.employeeid = b.username
														where b.id_user = '$id_user'
												)
												AND a.employeeid NOT IN(
													SELECT a.employeeid
														from employee_r_upload a
														left join tbl_user b
														on a.employeeid = b.username
														where b.id_user = '$id_user'
												) 
									))
									order by a.nip, c.careerplan, d.development
									) as DETAIL
									LEFT JOIN
									(
									SELECT 
									a.nip
									,COUNT(a.nip) as ROWSPANNIP
									, c.id
									from talentlist a
									left join employee_r_upload b
									on a.nip = b.employeeid
									left join careerplan c
									on a.nip = c.nip
									left join development_hipo d
									on c.id = d.id_career
									left join posisi e
									on b.position_id = e.position_id
									where (a.box in ('7','8','9') OR a.cr_status = 'Yes'OR a.nip in (SELECT nip from employee_program))
									and ( a.evaluator = '$id_user' OR a.evaluator in (SELECT 
												c.id_user
												from employee_r_upload a
												left join posisi b
												on a.position_id = b.position_id
												left join tbl_user c
												on a.employeeid = c.username
												where a.position_id in(
													SELECT head_pos_id 
													from organization 
													where parent_id in (
														SELECT a.org_id
														from employee_r_upload a
														left join tbl_user b
														on a.employeeid = b.username
														where b.id_user = '$id_user'
													)
												)
												OR a.org_id in (
													SELECT a.org_id
														from employee_r_upload a
														left join tbl_user b
														on a.employeeid = b.username
														where b.id_user = '$id_user'
												)
												AND a.employeeid NOT IN(
													SELECT a.employeeid
														from employee_r_upload a
														left join tbl_user b
														on a.employeeid = b.username
														where b.id_user = '$id_user'
												) 
									))
									GROUP BY a.nip
									) AS ROWNIP
									on DETAIL.nip = ROWNIP.nip

									LEFT JOIN
									(
									SELECT 
									a.nip
									,COUNT(d.id_career) as ROWSPANCAREER
									,d.id_career
									,d.id
									from talentlist a
									left join employee_r_upload b
									on a.nip = b.employeeid
									left join careerplan c
									on a.nip = c.nip
									left join development_hipo d
									on a.nip = d.nip
									and c.id = d.id_career
									left join posisi e
									on b.position_id = e.position_id
									where (a.box in ('7','8','9') OR a.cr_status = 'Yes'OR a.nip in (SELECT nip from employee_program))
									and ( a.evaluator = '$id_user' OR a.evaluator in (SELECT 
												c.id_user
												from employee_r_upload a
												left join posisi b
												on a.position_id = b.position_id
												left join tbl_user c
												on a.employeeid = c.username
												where a.position_id in(
													SELECT head_pos_id 
													from organization 
													where parent_id in (
														SELECT a.org_id
														from employee_r_upload a
														left join tbl_user b
														on a.employeeid = b.username
														where b.id_user = '$id_user'
													)
												)
												OR a.org_id in (
													SELECT a.org_id
														from employee_r_upload a
														left join tbl_user b
														on a.employeeid = b.username
														where b.id_user = '$id_user'
												)
												AND a.employeeid NOT IN(
													SELECT a.employeeid
														from employee_r_upload a
														left join tbl_user b
														on a.employeeid = b.username
														where b.id_user = '$id_user'
												) 
									))
									GROUP BY d.id_career
									) AS ROWCAREER
									on DETAIL.id_career = ROWCAREER.id_career
									and DETAIL.nip = ROWCAREER.nip
									WHERE ( DETAIL.evaluator = '$id_user' OR DETAIL.evaluator in (SELECT 
												c.id_user
												from employee_r_upload a
												left join posisi b
												on a.position_id = b.position_id
												left join tbl_user c
												on a.employeeid = c.username
												where a.position_id in(
													SELECT head_pos_id 
													from organization 
													where parent_id in (
														SELECT a.org_id
														from employee_r_upload a
														left join tbl_user b
														on a.employeeid = b.username
														where b.id_user = '$id_user'
													)
												)
												OR a.org_id in (
													SELECT a.org_id
														from employee_r_upload a
														left join tbl_user b
														on a.employeeid = b.username
														where b.id_user = '$id_user'
												)
												AND a.employeeid NOT IN(
													SELECT a.employeeid
														from employee_r_upload a
														left join tbl_user b
														on a.employeeid = b.username
														where b.id_user = '$id_user'
												) 
									))
									GROUP BY DETAIL.id_development
									ORDER BY DETAIL.nip");

	
		return $query->result();
	}

	public function careerList($nip)
	{
		$query		= $this->db->query("SELECT 
										*
										from careerplan a
										left join development_activities b
										on a.category = b.id_dev_act

										where a.nip = '$nip'
										and (a.flagdel = '0' or a.flagdel is null)");
		
		return $query->result();
	}

	public function devActivities()
	{
		$query		= $this->db->query("SELECT 
										*
										from development_activities");
		
		return $query->result();
	}

	public function getDevelopment($nip, $id)
	{
		$query		= $this->db->query("SELECT 
										*
										from careerplan
										where nip = '$nip'
										and id = '$id'");
		
		return $query->row_array();
	}

	public function checkAtasan($nip, $addby)
	{
		$query		= $this->db->query("SELECT 
										*
										from tbl_user a
										left join employee_r_upload b
										on a.username = b.employeeid
										where a.id_user = '$addby'
										");
		
		return $query->row_array();
	}

	public function checkuser($nip)
	{
		$query		= $this->db->query("SELECT 
										*
										from employee_r_upload
										where employeeid = '$nip'
										");
		
		return $query->row_array();
	}

	public function getDevelopmentCar($nip, $id)
	{
		$query		= $this->db->query("SELECT 
											a.id
											, a.nip
											, a.careerplan
											, a.readinesscareer
											, a.fromip
											, b.id as iddevhipo
											, b.development
											, b.datestart
											, b.dateend
											, c.id_dev_act
											, c.dev_activities
											, d.status
											, d.flag
											, b.keterangan
											, e.employeename
											from careerplan a
											left join development_hipo b
											on a.id = b.id_career
											left join development_activities c
											on b.cat = c.id_dev_act
											left join car_development_hipo d
											on b.id = d.id_dev_hipo
											left join tbl_user u
											on b.addby = u.id_user
											left join employee_r_upload e
											on u.username = e.employeeid
											where a.nip = '$nip'
											and b.id_career = '$id'
											and (d.flag = '0' or d.flag is null)
											group by b.id
											");
		
		return $query->result();
	}

	public function getDevelopmentCarTitle($nip, $id)
	{
		$query		= $this->db->query("SELECT * 
											from careerplan a
											left join development_hipo b
											on a.id = b.id_career
											left join development_activities c
											on b.cat = c.id_dev_act
											where a.nip = '$nip'
											and b.id_career = '$id'");
		
		return $query->row_array();
	}

	public function successplan($pos_id)
	{
		$query 			= $this->db->query("Select 
											a.nip
											, b.employeename
											, c.position_name
											, asp.assessment
											, rsp.readiness
											, a.addby
											, a.position
											from successlist a
											left join employee_r_upload b
											on a.nip = b.employeeid
											left join posisi c
											on b.position_id = c.position_id
											left join tbl_ski ski
											on a.nip = ski.fski_nip
											
											left join assessmentsp asp
											on a.nip = asp.nip
											and a.addby = asp.addby
											and asp.flagdel != '1'

											left join readinesssp rsp
											on a.nip = rsp.nip
											and a.addby = rsp.addby
											and asp.position = rsp.position
											and rsp.flagdel != '1'
											
											where  (a.flagdel = '0' or a.flagdel is null)
											and a.position = '$pos_id'
											and (ski.fski_year = '2016' or ski.fski_nip is null)
											group by a.nip");
		
		return $query->result();
	}

	public function successplanpinca($kodepos, $id_user)
	{
		$query 			= $this->db->query("Select 
											a.nip
											, b.employeename
											, c.position_name
											, asp.assessment
											, a.position
											, rsp.readiness
											, a.addby
											from successlist a
											left join employee_r_upload b
											on a.nip = b.employeeid
											left join posisi c
											on b.position_id = c.position_id
											left join tbl_ski ski
											on a.nip = ski.fski_nip
											
											left join assessmentsp asp
											on a.nip = asp.nip
											and a.addby = asp.addby
											and asp.flagdel != '1'

											left join readinesssp rsp
											on a.nip = rsp.nip
											and a.addby = rsp.addby
											and asp.position = rsp.position
											and rsp.flagdel != '1'
											
											where a.position = '$kodepos' 
											and a.addby = '$id_user'
											and (a.flagdel = '0' or a.flagdel is null)

											and (ski.fski_year = '2016' or ski.fski_nip is null)");

		
		return $query->result();
	}

	public function successplanpincan($kodepos)
	{
		$query 			= $this->db->query("Select 
											a.nip
											, b.employeename
											, c.position_name
											, asp.assessment
											, a.position
											, rsp.readiness
											, a.addby
											from successlist a
											left join employee_r_upload b
											on a.nip = b.employeeid
											left join posisi c
											on b.position_id = c.position_id
											left join tbl_ski ski
											on a.nip = ski.fski_nip
											
											left join assessmentsp asp
											on a.nip = asp.nip
											and a.addby = asp.addby
											and asp.flagdel != '1'

											left join readinesssp rsp
											on a.nip = rsp.nip
											and a.addby = rsp.addby
											and asp.position = rsp.position
											and rsp.flagdel != '1'
											
											where a.position = '$kodepos' 
											and (a.flagdel = '0' or a.flagdel is null)

											and (ski.fski_year = '2016' or ski.fski_nip is null)");

		
		return $query->result();
	}
	
	//function successplanreport($id_user, $posid)
	function successplanreport($posid)
	{
		$query 			= $this->db->query("SELECT * 
												from assessmentsp a
												left join readinesssp b
												on a.nip = b.nip
												and a.addby = b.addby

												left join employee_r_upload c
												on a.nip = c.employeeid
												left join posisi d
												on c.position_id = d.position_id
												where 1 /*a.addby = '$id_user'
												and */ and a.position = '$posid'
												and a.flagdel != '1'
												and b.flagdel != '1'
												group by a.nip");
		echo "SELECT * 
		from assessmentsp a
		left join readinesssp b
		on a.nip = b.nip
		and a.addby = b.addby

		left join employee_r_upload c
		on a.nip = c.employeeid
		left join posisi d
		on c.position_id = d.position_id
		where 1 /*a.addby = '$id_user'
		and */ and a.position = '$posid'
		and a.flagdel != '1'
		and b.flagdel != '1'";
		return $query->result();
	}
	
	function successplanreportdiv($id_user, $posid)
	{
		$query 			= $this->db->query("SELECT * 
												from assessmentsp a
												left join readinesssp b
												on a.nip = b.nip
												and a.addby = b.addby

												left join employee_r_upload c
												on a.nip = c.employeeid
												left join posisi d
												on c.position_id = d.position_id
												left join (
													select *
													from notes_sp
													group by id
												) f
												on a.nip = f.empid
												where 1 /*a.addby = '$id_user'
												and */ and a.position = '$posid'
												and a.flagdel != '1'
												and b.flagdel != '1'");
		echo "SELECT * 
												from assessmentsp a
												left join readinesssp b
												on a.nip = b.nip
												and a.addby = b.addby

												left join employee_r_upload c
												on a.nip = c.employeeid
												left join posisi d
												on c.position_id = d.position_id
												left join (
													select *
													from notes_sp
													group by id
												) f
												on a.nip = f.empid
												where 1 /*a.addby = '$id_user'
												and */ and a.position = '$posid'
												and a.flagdel != '1'
												and b.flagdel != '1'";
		return $query->result();
	}
	
	public function notes_view($iduser)
	{
		$query 		= $this->db->query("SELECT *
																	from notes_sp
																	where empid = '$iduser'");
		return $query->row_array();
	}

	function successplanreportpinca($id_user, $posid)
	{
		$query 			= $this->db->query("SELECT * 
												from assessmentsp a
												left join readinesssp b
												on a.nip = b.nip
												and a.addby = b.addby

												left join employee_r_upload c
												on a.nip = c.employeeid
												left join posisi d
												on c.position_id = d.position_id
												where a.addby = '$id_user'
												and a.position = '$posid'
												and a.flagdel != '1'
												and b.flagdel != '1'");


		
		return $query->result();
	}

	function successplanreportpincaN($posid)
	{
		$query 			= $this->db->query("SELECT * 
												from assessmentsp a
												left join readinesssp b
												on a.nip = b.nip
												and a.addby = b.addby

												left join employee_r_upload c
												on a.nip = c.employeeid
												left join posisi d
												on c.position_id = d.position_id
												where a.position = '$posid'
												and a.flagdel != '1'
												and b.flagdel != '1'");


		
		return $query->result();
	}

	function successplanreportPos($id_user)
	{
		$query 			= $this->db->query("SELECT * 
												from assessmentsp a
												left join readinesssp b
												on a.nip = b.nip
												and a.addby = b.addby

												left join employee_r_upload c
												on a.nip = c.employeeid
												left join posisi d
												on c.position_id = d.position_id
												where a.addby = '$id_user'
												and a.flagdel != '1'
												and b.flagdel != '1'");
		return $query->result();
	}

	function viewOthersAdd($nip, $id_user)
	{
		$query 			= $this->db->query("SELECT 
											a.nip
											, h.employeename
											, f.position_name
											, g.position_name as successposition
											, d.assessment
											, e.readiness
											from successlist a
											left join tbl_user b
											on a.addby = b.id_user
											left join employee_r_upload c
											on b.username = c.employeeid
											left join assessmentsp d
											on a.nip = d.nip
											and a.addby = d.addby
											left join readinesssp e
											on a.nip = e.nip
											and a.addby = e.addby
											left join posisi f
											on a.position = f.position_id
											left join posisi g
											on c.position_id = g.position_id
											left join employee_r_upload h
											on a.nip = h.employeeid
											
											where a.nip = '$nip'
											and a.addby != $id_user
											group by b.id_user");
		return $query->result();
	}

	function listDevelopmentSP($nip, $position){
		$query 			= $this->db->query("SELECT * 
											from development_sp a
											left join development_activities b
											on a.cat = b.id_dev_act
											where a.nip = '$nip'
											and a.position = '$position'");
		
		return $query->result();
	}

	function adminparamtop(){
		$query 			= $this->db->query("SELECT * from param_top where flag = 'Y'");
		
		return $query->result();
	}

	function adminparamgrade(){
		$query 			= $this->db->query("SELECT * from param_grade");
		return $query->result();
	}

}
?>
