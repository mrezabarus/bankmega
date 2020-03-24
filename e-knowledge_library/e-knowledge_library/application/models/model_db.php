<?php
class Model_db extends CI_Model {
  
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		
		date_default_timezone_set('Asia/Jakarta');
    }
	
	
	/* General query */	
	function eknowledgeLibrary()
	{
		$this->db->select('*');
		$this->db->from( 'eknowledge_library');
		$this->db->where( 'hide is null' );
		$this->db->order_by("id_kursus", "desc");
		// $this->db->where( $row );
		// $this->db->limit(1);
		
		$query = $this->db->get();	

		$chekRow = $query->num_rows;
		if($chekRow != "0")
		{
			// return $query;
			return $query->result();
		}	
	}
	
	function eknowledgeParticipant()
	{
		$this->db->select('*');
		$this->db->from( 'eknowledge_participant');
		
		$query = $this->db->get();	

		$chekRow = $query->num_rows;
		if($chekRow != "0")
		{
			// return $query;
			return $query->result();
		}	
	}
	

	
	



	
	
	
	/* 
		Welcome
		- SignIn
		- setVisitor
	*/			
	function SignIn($data) 
	{
		$limit = 1;
		
		$query = $this->db->get_where('data_user', $data, $limit);
		
		$chekRow = $query->num_rows;
		if($chekRow != "0")
		{	
			$return =  $query->result();
			return $return[0];
		}	
	}		
	
	function setVisitor()
	{
		//$query = $this->db->query('INSERT INTO `eknow_test`.`data_visitor` (`ID`, `id_kursus`, `ID_USER`, `USER_NAME`, `GENDER`, `UpdatedInDB`) VALUES (NULL, '7', '000000', 'jack', NULL, CURRENT_TIMESTAMP)');
		
		$getBrowser = $this->Model_db->getBrowser();
		
		$data = array(
		   'id_kursus' 		=> 0 ,
		   'id_user' 		=> $_SESSION['ID_USER'] ,
		   'user_name' 		=> $_SESSION['USER_NAME'],  
		   'GENDER' 		=> $_SESSION['GENDER'],  
		   'ip_client' 		=> $this->Model_db->get_client_ip(),    
		   'browserName' 	=> $getBrowser['name'],    
		   'browserVersion' => $getBrowser['version']   
		);
		
		$insert_query = $this->db->insert('data_visitor', $data);
		return $this->db->insert_id();
	}
		
	function UpdatePwd($id, $data) 
	{
		$this->db->where('ID_USER', $id);
		$this->db->update('data_user', $data);
	}
	
	function GetProfile() 
	{
		$id_user = $_SESSION['ID_USER'];

		$query = $this->db->query("
			select *
			from data_user a
			left join z_employee_list_2 b
			on a.id_user = b.nip

			where a.id_user = '". $id_user ."'
			limit 1
		");	

		$chekRow = $query->num_rows;
		if($chekRow != "0")
		{
			$return =  $query->result();
			return $return[0];
		}		
	}
	
	
	/* 
		Library
		- server_condition
		- server_condition
		- get_client_ip
		- array_random_assoc
		- Hari
		- Bulan
		- HariBulanID
		- getBrowser
		- cleanStr
		- compare
		- duration
		- duration
		- sectohours
	*/		
	function server_condition($data)
	{
		/* $data = array(
			 'title' => 'My title' ,
			 'name' => 'My Name' ,
			 'date' => 'My date'
		); */

		$this->db->insert('server_condition', $data);
	}
	
	function get_server_condition_rev3()
	{
		$query = $this->db->query("
			CALL getServerCondition()
		");
		
		$chekRow = $query->num_rows;
		if($chekRow != "0")
		{	
			return $query->result();
		}
	}
	
	function cleanGetServerCondition()
	{
		$data = $this->Model_db->get_server_condition_rev3();
		
		if(!empty( $data )){
			foreach( $data as $row ){
			
				if( (empty($row->limit)) || ($row->jmlh < $row->limit) ){					
						// filtering of limit
						$row2[]=$row;
						$count_of_load[$row->ip_server] = $row->jmlh;							
				}
				
				if(!empty($row->port)) {					
					$row->port2 = ':' . $row->port;						
				}
				else{
					$row->port2 = '';
				}				
				
				$row1[]=$row;
				//external request
				$server_sts[$row->ip_server] = $row->jmlh;
				$ip_server_limit[$row->ip_server] = $row->limit;	
		
			}
			
			$data2['row1'] = $row1;
			$data2['row2'] = $row2;
			$data2['count_of_load'] = $count_of_load;
			$data2['server_sts'] = $server_sts;
			$data2['ip_server_limit'] = $ip_server_limit;
			
			return $data2;
		}
	}
		
	function cleanServerCondition()
	{
		$query = $this->db->query("
			CALL cleanServerCondition()
		");
		
		return $this->db->affected_rows();
	}
	
	function get_client_ip() 
	{
		 $ipaddress = '';

		 if(!empty($_SERVER['HTTP_CLIENT_IP']))
			{$ipaddress = $_SERVER['HTTP_CLIENT_IP'];}
		 elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
			{$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];}
		 elseif(!empty($_SERVER['HTTP_X_FORWARDED']))
			{$ipaddress = $_SERVER['HTTP_X_FORWARDED'];}
		 elseif(!empty($_SERVER['HTTP_FORWARDED_FOR']))
			{$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];}
		 elseif(!empty($_SERVER['HTTP_FORWARDED']))
			{$ipaddress = $_SERVER['HTTP_FORWARDED'];}
		 elseif(!empty($_SERVER['REMOTE_ADDR']))
			{$ipaddress = $_SERVER['REMOTE_ADDR'];}
		 else
			{$ipaddress = 'UNKNOWN';}

		 return $ipaddress; 
	}
	
	function array_random_assoc($arr, $num = 1) 
	{
		$keys = array_keys($arr);
		shuffle($keys);
		
		$r = array();
		for ($i = 0; $i < $num; $i++) {
			$r[$keys[$i]] = $arr[$keys[$i]];
		}
		return $r;
	}
	
	function Hari( $id=1 ) 
	{
		$array_hari = array(1=>'Senin','Selasa','Rabu','Kamis','Jumat', 'Sabtu','Minggu'); 
		
		return $array_hari[$id];
	}
	
	function Bulan( $id=1 ) 
	{
		$array_bulan = array(1=>'Januari','Februari','Maret', 'April', 'Mei', 'Juni','Juli','Agustus','September','Oktober', 'November','Desember'); 
		
		return $array_bulan[$id];
	}
	
	function HariBulanID( $time) //2014-06-09 10:12:50
	{
		$array_hari = array(1=>'Senin','Selasa','Rabu','Kamis','Jumat', 'Sabtu','Minggu'); 
		$array_bulan = array(1=>'Januari','Februari','Maret', 'April', 'Mei', 'Juni','Juli','Agustus','September','Oktober', 'November','Desember'); 
		
		$tgl 	= date('d', strtotime( $time ) ); //Day of the month, 2 digits with leading zeros
		$hari 	= date('N', strtotime( $time ) ); //nama hari dalam bahasa indonesia
		$bulan 	= date('n', strtotime( $time ) ); //nama bulan dalam bahasa indonesia
		$tahun 	= date('Y', strtotime( $time ) ); //nama bulan dalam bahasa indonesia
		$start 	= date('H:i:s', strtotime( $time ) ); //nama bulan dalam bahasa indonesia
		
		$result['tgl']		= $tgl;
		$result['hari']		= $array_hari[$hari];
		$result['bulan']	= $array_bulan[$bulan];
		$result['tahun']	= $tahun;
		$result['start']	= $start;
		
		return $result;
	}
	
	function getBrowser() 
	{ 
		$u_agent = $_SERVER['HTTP_USER_AGENT']; 
		$bname = 'Unknown';
		$platform = 'Unknown';
		$version= "";

		//First get the platform?
		if (preg_match('/linux/i', $u_agent)) {
			$platform = 'linux';
		}
		elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
			$platform = 'mac';
		}
		elseif (preg_match('/windows|win32/i', $u_agent)) {
			$platform = 'windows';
		}
		
		// Next get the name of the useragent yes seperately and for good reason
		if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
		{ 
			$bname = 'Internet Explorer'; 
			$ub = "MSIE"; 
		} 
		elseif(preg_match('/Firefox/i',$u_agent)) 
		{ 
			$bname = 'Mozilla Firefox'; 
			$ub = "Firefox"; 
		} 
		elseif(preg_match('/Chrome/i',$u_agent)) 
		{ 
			$bname = 'Google Chrome'; 
			$ub = "Chrome"; 
		} 
		elseif(preg_match('/Safari/i',$u_agent)) 
		{ 
			$bname = 'Apple Safari'; 
			$ub = "Safari"; 
		} 
		elseif(preg_match('/Opera/i',$u_agent)) 
		{ 
			$bname = 'Opera'; 
			$ub = "Opera"; 
		} 
		elseif(preg_match('/Netscape/i',$u_agent)) 
		{ 
			$bname = 'Netscape'; 
			$ub = "Netscape"; 
		} 
		
		// finally get the correct version number
		$known = array('Version', $ub, 'other');
		$pattern = '#(?<browser>' . join('|', $known) .
		')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
		if (!preg_match_all($pattern, $u_agent, $matches)) {
			// we have no matching number just continue
		}
		
		// see how many we have
		$i = count($matches['browser']);
		if ($i != 1) {
			//we will have two since we are not using 'other' argument yet
			//see if version is before or after the name
			if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
				$version= $matches['version'][0];
			}
			else {
				$version= $matches['version'][1];
			}
		}
		else {
			$version= $matches['version'][0];
		}
		
		// check if we have a number
		if ($version==null || $version=="") {$version="?";}
		
		return array(
			'userAgent' => $u_agent,
			'name'      => $bname,
			'version'   => $version,
			'platform'  => $platform,
			'pattern'    => $pattern
		);
	}
	
	function cleanStr( $value ) 
	{
		$valueToCode_1 = mysql_real_escape_string($value);

		/* replace string */
		$cari = array("\\r\\n\\n", "\r\n\n", "rnn", "\\");
		$gantinya   = array("\r\n", "\r\n", "\r\n", "");
		$valueToCode_2 = str_replace($cari, $gantinya, $valueToCode_1);	
		$data4 = htmlspecialchars($valueToCode_2, ENT_QUOTES);
		
		return $data4;
	}

 	function compare($value, $min, $max)
	{
		if(($min <= $value) && ($max >= $value)){//compare scale sub component
			return true;
		}
		else{
			return false;
		}	
	}
	
	function duration()
	{
		$duration = time() - $this->session->userdata('time0');
		$duration2 = $this->Model_db->sectohours($duration); 
		
		return $duration2;
	}
	
	function sectohours($sec)
	{
		$bit2['H']    = $sec / 3600 % 168;
		$bit2['i']    = $sec / 60 % 60;
		$bit2['s']    = $sec % 60;
			
		foreach($bit2 as $k => $v){
			if(strlen($v) == 1){
				$bit2[$k] = '0' . $v;
			}
		}	
		
		return $bit2['H'].':'.$bit2['i'].':'.$bit2['s'];
	}
	

	
/* End of file model_db.php */
/*  */
}