<?php
class Modeldb extends CI_Model {
  
	function __construct() 
	{
		// Call the Model constructor
		parent::__construct();
		
		date_default_timezone_set('Asia/Jakarta');
	}	

	function login($username, $password)
    {
        $this -> db -> select('tbl_user.id_user, tbl_user.username, tbl_user.password, tbl_user.active, tbl_user.id_group, tbl_user.id_group_menu, tbl_group.group_status');
        $this -> db -> from('tbl_user');
        $this -> db -> join('tbl_group', 'tbl_user.id_group = tbl_group.id_group', 'left');
        $this -> db -> where('tbl_user.username', $username);
        $this -> db -> where('tbl_user.password', MD5($password));
        $this -> db -> where('tbl_user.active', "YES");

        $this -> db -> limit(1);

        $query = $this -> db -> get();

        $num = $query -> num_rows();
        // echo "</br>";
        // echo $num;
        // echo "</br>";
        // echo MD5($password);
        if($query -> num_rows() == 1)
        {
            return $query->result();
        }
        else
        {
            return false;
        }
    }

    
    function detadmin($id_user){
        $query = $this->db->query("
                                    SELECT 
                                    a.username
                                    , b.group_name 
                                    from tbl_user a
                                    left join tbl_group b
                                    on a.id_group = b.id_group
                                    where a.username = '$id_user'
                                ");        
        return $query->row();
    }

    function menuadmin($id_group){
        $query = $this->db->query("
                                    Select *
                                    from tbl_menu a
                                    where a.id_group = '$id_group'
                                    group by a.id_menu
                                ");        

                                
        return $query->result();
    }    

    function countalljob(){
        $query = $this->db->query("
                                    SELECT COUNT(total) as total
                                    FROM (
                                    SELECT COUNT(position_name) as total
                                    from posisi
                                    where active = 'YES'
                                    GROUP by position_name
                                    )A
                                ");
        return $query->row_array();
    }

    function countalljobadmin($id_group){
        $query = $this->db->query("
                                    SELECT COUNT(total) as total
                                    FROM (
                                        SELECT COUNT(position_name) as total
                                        from posisi
                                        where active = 'YES'
                                        and position_id in (
                                            SELECT posisi 
                                            from tbl_access
                                            where id_group = '$id_group'
                                            )
                                        GROUP by position_name
                                    )A
                                ");
        return $query->row_array();
    }

    function groupstat($id_group){
        $query = $this->db->query("
                                    SELECT group_status, group_filter_pos 
                                    from tbl_group
                                    where id_group = '$id_group'
                                ");
        return $query->row_array();
    }

    function listjobadmin(){
        $query = $this->db->query("                                    
                                    SELECT * 
                                    from job a
                                    left join posisi b
                                    on a.id_job = b.job_id
                                    where a.id_job != ''
                                    group by b.position_title_id
                                "); 

        
        return $query->result();
    }

    function listjobadminfilter($id_group){
        $query = $this->db->query("                                    
                                    SELECT * 
                                    from job a
                                    left join posisi b
                                    on a.id_job = b.job_id
                                    
                                    where b.position_title_id in(
                                        SELECT id_pos_title 
                                        from position_title a
                                        left join tbl_access b
                                        on a.id = b.posisi
                                        where b.id_group = '$id_group'
                                    )
                                    group by b.position_title_id
                                "); 
        return $query->result();
    }

    function listpostitleadmin(){
        $query = $this->db->query("                                    
                                    SELECT * 
                                    from position_title a
                                    where a.active = 'YES'
                                "); 
        return $query->result();
    }

    function listpostitleadminfilter($id_group){
        $query = $this->db->query("                                    
                                    SELECT * 
                                    from position_title a
                                    where a.active = 'YES'
                                    and a.id in (
                                        SELECT posisi 
                                        from tbl_access
                                        where id_group = '$id_group'
                                    )
                                    group by no
                                "); 
                             
        return $query->result();
    }

    function detailuser($id_user){
        $query = $this->db->query("
                                SELECT 
                                a.EmpId
                                , a.EmpName
                                , a.EmpJobTtl
                                , b.position_name 
                                from employee a
                                left join posisi b
                                on a.EmpJobTtl = b.position_id
                                where a.EmpId = '$id_user'
                                and b.active = 'YES'
                                ");        
        return $query->row();
    }

    function empjob($id_user){
        $query = $this->db->query("
                                    SELECT 
                                    a.EmpId
                                    , a.EmpName
                                    , a.EmpJobTtl                                    
                                    from employee a                                   
                                    where a.EmpId = '$id_user'
                                ");        
        return $query->row_array(); 
    }

    function listjob($id_report_to){
        $query = $this->db->query("
                                    SELECT position_id
                                    , position_name 
                                    from posisi
                                    where active = 'YES'
                                    and report_to in (
                                    SELECT position_id
                                    from posisi
                                    where 1
                                    and active = 'YES'
                                    and report_to = '$id_report_to'
                                    )
                                    UNION 
                                    SELECT position_id
                                    , position_name 
                                    from posisi
                                    where 1
                                    and active = 'YES'
                                    and report_to = '$id_report_to'
                                    order by position_name ASC
                                ");        
        
        return $query->result();
    }

    
    function countjobdesc($id_report_to){
        $query = $this->db->query("
                                SELECT COUNT(position_id) as total
                                from (
                                    SELECT position_id
                                    , position_name 
                                    from posisi
                                    where active = 'YES'
                                    and report_to in (
                                    SELECT position_id
                                    from posisi
                                    where 1
                                    and active = 'YES'
                                    and report_to = '$id_report_to'
                                    )
                                    UNION 
                                    SELECT position_id
                                    , position_name 
                                    from posisi
                                    where 1
                                    and active = 'YES'
                                    and report_to = '$id_report_to'
                                    order by position_name ASC
                                )A
                                ");        
        
        return $query->row_array();
    }


}
?>