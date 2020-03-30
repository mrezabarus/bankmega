<?php
Class LoginModel extends CI_Model
	{
		function User()
		{
			parent::__construct();
			//$erec = $this->load->database('pool', TRUE);
		}

		function selUser($id_user)
		{
			$query 		= $this->db->query("Select * 
											from tbl_user a
											where a.id_user = '$id_user'
											");
			//return $query->row()->id_group;
			return $query->row_array();
		}

 		function login($username, $password)
 		{
		   $this -> db -> select('id_user, username, password, id_group');
		   $this -> db -> from('tbl_user');
		   $this -> db -> where('username', $username);
		   $this -> db -> where('password', MD5($password));
		   $this -> db -> where('active', "yes");
		   $this -> db -> limit(1);

		   $query = $this -> db -> get();

		   $num = $query -> num_rows();
		   //echo $num;
		   //echo MD5($password);
		   if($query -> num_rows() == 1)
		   {
		   		return $query->result();
		   }
		   else
		   {
		    	return false;
		   }
 		}

 		function selParMenu($id_par_menu)
		{
			$query 		= $this->db->query("Select * 
											from tbl_par_menu a
											where a.id_par_menu = '$id_par_menu'
											");
			//return $query->row()->id_group;
			return $query->row_array();
		}

 		/*
 		function chekstatus($id_user){
 			$query 		= $this->db->query("select *
 											from tbl_user_talent where id_user = '$id_user'
 											");
 			return $query->row()->id_user;
 		}
		*/



 		function checkmenu($id_group)
 		{
 			$query 		= $this->db->query("Select * 
											from tbl_user a
											left join tbl_group b
											on a.id_group = b.id_group
											left join tbl_group_menu c
											on c.id_group = b.id_group
											left join tbl_par_menu d
											on c.id_menu = d.id_par_menu
											left join tbl_sub_menu e
											on d.id_par_menu = e.id_par_menu
											where a.id_group = '$id_group'
											group by d.id_par_menu
											");
 			
			return $query->result();
			//return $query->row_array();
 		}
 		
 		function checksubmenu($id_user, $id_par_menu)
 		{
 			$query 		= $this->db->query("Select * 
											from tbl_user a
											left join tbl_group b
											on a.id_group = b.id_group
											left join tbl_group_menu c
											on c.id_group = b.id_group
											left join tbl_par_menu d
											on c.id_menu = d.id_par_menu
											left join tbl_sub_menu e
											on c.id_sub_menu = e.id_sub_menu
											where a.id_user = '$id_user'
											and e.id_par_menu = '$id_par_menu'
											group by e.id_sub_menu");
 			return $query->result();
 		}
 		
 		function checkgroup($id_user)
 		{
 			$query 		= $this->db->query("Select * 
											from tbl_user a
											where a.username = '$id_user'
											");
			return $query->row()->id_group;
			//return $query->row_array();
 		}

 		function namaPage($id_user)
 		{
 			$query 		= $this->db->query("Select * 
											from tbl_user a
											where a.id_user = '$id_user'
											");
			return $query->row()->id_group;
			//return $query->row_array();
 		}

 		function getUserName($id_user)
 		{
 			$query 		= $this->db->query("Select username 
											from tbl_user a
											where a.id_user = '$id_user'
											");
			//return $query->row()->id_group;
			return $query->row_array();
 		}

 		function getLevelOrg($id_user)
 		{
 			$query 		= $this->db->query("select 
												b.level_id 
												from employee_r_upload a
												left join organization b
												on a.org_id = b.orgid
												left join tbl_user c
												on a.employeeid = c.username
												where c.id_user = '$id_user'
											");
 			
			//return $query->row()->id_group;
			return $query->row_array();
 		}
 		
 		/*=====================================================================================*/
 		/*=====================================================================================*/
 		/*=====================================================================================*/
 		/*=====================================================================================*/
 		/*=====================================================================================*/
 		function view_user()
 		{
 			$query 		= $this->db->query("SELECT * 
											from tbl_user a
											left join tbl_group b
											on a.id_group = b.id_group");
 			return $query->result();
 		}

 		function view_group()
 		{
 			$query 		= $this->db->query("SELECT * 
											from tbl_group");
 			return $query->result();
 		}

 		function view_parmenu()
 		{
 			$query 		= $this->db->query("SELECT * 
											from tbl_par_menu");
 			return $query->result();
 		}

 		function view_submenu()
 		{
 			$query 		= $this->db->query("SELECT * 
											from tbl_sub_menu a
											left join tbl_par_menu b
											on a.id_par_menu = b.id_par_menu");
 			return $query->result();
 		}

 		function editSubMenu($id_sub_menu){
 			$query 		= $this->db->query("SELECT * 
											from tbl_sub_menu a
											left join tbl_par_menu b
											on a.id_par_menu = b.id_par_menu
											where a.id_sub_menu = '$id_sub_menu'");
 			return $query->row_array();
 		}

 		function GroupDetail($id_group)
		{
			$query		= $this->db->query("select * from tbl_group where id_group = '$id_group'");
			return $query->row_array();	
		}

		function menuSave($id_group)
		{
			$query		= $this->db->query("select *
												from tbl_group_menu a
												left join tbl_group b
												on a.id_group = b.id_group
												left JOIN tbl_sub_menu c
												on a.id_sub_menu = c.id_sub_menu
												where a.id_group = '$id_group'");
			return $query->result();
		}

		function menuSelectNotSave($id_group)
		{
			$query		= $this->db->query("SELECT * 
											from tbl_sub_menu
											where id_sub_menu not in
											(
												SELECT id_sub_menu from tbl_group_menu where id_group = '$id_group'
											)");
			
			return $query->result();
		}
		function deleteMenuAcceess($id_group)
		{
			$query		= $this->db->query("delete from tbl_group_menu where id_group = '$id_group'");

		}

		function getMenuId($id_sub_menu)
		{  
		    return $this->db->
		    select('*')->
		    from('tbl_sub_menu')->
		    where('id_sub_menu', $id_sub_menu)->
		    get()->row_array();
		}

		function checkuserbirth($nip, $birthdate)
		{
		   $borndate		= date("Y-m-d H:i:s", strtotime($birthdate));
		   //$borndate 			= date("Y-m-d", strtotime($datepicker));
		   /*$this -> db -> select('EmpId, EmpDateBirth');
		   $this -> db -> from('employee');
		   $this -> db -> where('EmpId', $nip);
		   $this -> db -> where('EmpDateBirth', $borndate);*/
		   //echo $borndate;
		   $query		= $this->db->query("SELECT * from tbl_user a left join employee b
		   									on a.username = b.EmpId
		   									where a.username = '$nip'
		   									and b.EmpDateBirth = '$borndate'
		   									limit 1");
		   
		   //$this -> db -> limit(1);

		   //$query = $this -> db -> get();

		   $num = $query -> num_rows();
		   //echo $num;
		   //echo MD5($password);
		   if($query -> num_rows() == 1)
		   {
		   		return $query->result();
		   }
		   else
		   {
		    	return false;
		   }
		}

		function insert($data,$table){
			$ins = $this->db->insert($table, $data);
		}
		function update_group_name($id,$data){
			$this->db->where('id_group', $id);
			$this->db->update('tbl_group', $data);
		}
		function update_data($where,$data,$table){
			$this->db->where($where);
			$this->db->update($table,$data);
		}
 		
 		
	}
?>
