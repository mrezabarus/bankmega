<?php 
 
class M_login extends CI_Model{	
	function cek_login($table,$where){		
		return $this->db->get_where($table,$where);
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
}