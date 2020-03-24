<?php
class Adminmax_db extends CI_Model {
  
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		
		date_default_timezone_set('Asia/Jakarta');		
    }
    
    
 
	
	function insert_ignore_batch($tablename, $data)
	{
		if(!empty($data)){
		
			$table = $tablename;
			$find_keys = $data[0];
			foreach($find_keys as $key => $val){
				$keys[] = "`".$key."`";
			}
			foreach($data as $row2){	
				$values[] = "('" . implode("', '", $row2) . "')";
			}
			
			$sql =  "INSERT IGNORE INTO ".$table." (".implode(', ', $keys).") VALUES ".implode(', ', $values);
			
			$query = $this->db->query( $sql );
			
			return $this->db->affected_rows();
		}		
	}   

	/* 
		Adminmax Monitoring service
		- jadwal
	*/		
	function jadwal()
	{
		$this->db->select('*');
		$this->db->from('jadwal_training');
		// $this->db->where_in('id', $id);
		// $this->db->where('id', $id);
		$this->db->order_by("UpdatedInDB", "desc"); 
		$this->db->limit(20);

		$query = $this->db->get();		
	
		$chekRow = $query->num_rows;
		if($chekRow != "0")
		{
			return $query->result();
		}
	}
	
	
	/* Service request
		- eknowledgeRegister
		- eknowledgeMonitor
		- updateIDjadwal
		- eknowledgeUser
		- resetPwd
		- getiduser
		- getiduser2
		- getusername
		- getusername2
		- insert_eknowledge_register
		- UpdateDataUser
		- UpdateDataUserByEmployee
		- updateNewEmployee
		- UpdateSoalConfig
	*/	
	function test() 
	{
		$data = 'haha';
		return $data;
	}
	
	function eknowledgeRegister($find, $limit=10)
	{
		$this->db->select('*');
		$this->db->from( 'eknowledge_register');		
		$this->db->like('ID_USER', $find);
		$this->db->or_like('USER_NAME', $find); 
		// $this->db->where( $row );	
		// $this->db->order_by("UpdatedInDB", "desc"); 		
		$this->db->limit( $limit );
				
		$query = $this->db->get();			

		$chekRow = $query->num_rows;
		if($chekRow != "0")
		{	
			return $query->result();
		}
	}
	
	function eknowledgeMonitor($nip)
	{
		$query = $this->db->query("

			select a2.id_jadwal_awal
				, a2.id_jadwal
				, a2.id_kursus
				, h2.kursus as kursus_name
				, a2.id_user
				, a2.user_name
				, a2.posisi_detail
				, a2.org
				, a2.organisasi_name
				, a2.regional_name
				, b2.activity 
				, (case when c2.`ID_USER` is not null then '1' else null end) as login
				, d2.max_nilai_pre as pretest0
				, ROUND( d2.max_nilai_pre * 100 /i2.jmlh_soal , 2 ) AS pretest
				, e2.duration
				, f2.max_nilai_post as posttest0
				, ROUND( f2.max_nilai_post * 100 /i2.jmlh_soal , 2 ) AS posttest
				, g2.sertifikat
				
			from (
					/* Data register group by id_kursus */
					SELECT *
					FROM eknowledge_register 
					WHERE ID_USER = '". $nip ."'
			) a2

			left join (
					/* Data activity last update group by id_kursus */
					SELECT b1.*
					FROM (
						SELECT id_jadwal
							   ,id_kursus
							   ,ID_USER
							   , max(UpdatedInDB) as maxUpdatedInDB
						FROM data_user_activities 
						WHERE ID_USER = '". $nip ."'       
						GROUP BY id_kursus	
						ORDER BY UpdatedInDB     
					)	a1
					left join (
						SELECT *
						FROM data_user_activities 
						WHERE ID_USER = '". $nip ."'
					) b1
					on a1.ID_USER = b1.ID_USER	
					and a1.id_kursus = b1.id_kursus
					and a1.maxUpdatedInDB = b1.UpdatedInDB
			) b2	
			on a2.ID_USER = b2.ID_USER	
			and a2.id_kursus = b2.id_kursus

			left join (
					/* yang sudah login */
					SELECT `ID_USER`, `id_kursus`
					FROM `data_visitor`
					WHERE ID_USER = '". $nip ."'
					GROUP BY `id_kursus`, `ID_USER`
			) c2	
			on a2.ID_USER = c2.ID_USER	
			and a2.id_kursus = c2.id_kursus

			left join (
					/* Data pretest group by id_kursus */
					SELECT `id_kursus`, `ID_USER`, max( nilai ) AS max_nilai_pre
					FROM (
							SELECT `id_kursus` , `id_jadwal` , `ID_USER` , `Ulangke` , sum( `value` ) AS nilai
							FROM `data_user_pretest`
							WHERE ID_USER = '". $nip ."'
							GROUP BY `id_kursus` , `id_jadwal` , `ID_USER` , `Ulangke`
							ORDER BY `id_kursus` , `id_jadwal` , `ID_USER` , `Ulangke` ASC
					)max_pre				
						/* `id_jadwal`,  gk di masukan (karena ingin mencari nilai tertinggi)*/
					GROUP BY `id_kursus`, `ID_USER`	
			) d2	
			on a2.ID_USER = d2.ID_USER	
			and a2.id_kursus = d2.id_kursus

			left join (
					/* Data materi (duration) */
					SELECT  id_jadwal, id_kursus, ID_USER, USER_NAME, SEC_TO_TIME( SUM( TIME_TO_SEC( duration ) ) ) as duration
					FROM durasi_halaman
					WHERE ID_USER = '". $nip ."'
					GROUP BY `id_kursus`, `ID_USER`
			) e2	
			on a2.ID_USER = e2.ID_USER	
			and a2.id_kursus = e2.id_kursus

			left join (
					/* Data posttest group by id_kursus */
					SELECT `id_kursus`, `ID_USER`, max( nilai ) AS max_nilai_post
					FROM (
							SELECT `id_kursus` , `id_jadwal` , `ID_USER` , `Ulangke` , sum( `value` ) AS nilai
							FROM `data_user_posttest`
							WHERE ID_USER = '". $nip ."'
							GROUP BY `id_kursus` , `id_jadwal` , `ID_USER` , `Ulangke`
							ORDER BY `id_kursus` , `id_jadwal` , `ID_USER` , `Ulangke` ASC
					)max_pre				
						/* `id_jadwal`,  gk di masukan (karena ingin mencari nilai tertinggi)*/
					GROUP BY `id_kursus`, `ID_USER`	
			) f2	
			on a2.ID_USER = f2.ID_USER	
			and a2.id_kursus = f2.id_kursus

			left join (
					/* yang sudah Serial */ 
					SELECT `id_kursus`, `ID_USER`, `USER_NAME` , `Serial` as sertifikat
					FROM `data_user_certify`
					WHERE ID_USER = '". $nip ."'
					GROUP BY `id_kursus`, `ID_USER`
			) g2	
			on a2.ID_USER = g2.ID_USER	
			and a2.id_kursus = g2.id_kursus

			left join eknowledge_library h2	
			on a2.id_kursus = h2.id_kursus
			
			left join soal_config i2	
			on a2.id_kursus = i2.id_kursus

		
		");			

		$chekRow = $query->num_rows;
		if($chekRow != "0")
		{	
			return $query->result();
		}
	}
	
	function LearningMonitor4moodle($nip)
	{
		$query = $this->db->query("
			SELECT 
                r.userid
                , r.scormid  
                , c.id as id_kursus 
                , c.shortname as kursus_name
				, a.username as id_user
				, a.fullname as user_name
				, if(b.posisi_detail is null,  h.jobtitle,b.posisi_detail ) as posisi_detail
				, if(b.org is null, h.org_group_code, b.org  ) as org
				, if(b.organisasi_name is null, h.org_group_name, b.organisasi_name  ) as organisasi_name
				, if(b.regional_name is null, h.org_region_name, b.regional_name  ) as regional_name
				, r.tgl_mulai 
				, d.nilai as pretest
				, e.durasi as duration
				, f.nilai as posttest
				, g.`serial` as sertifikat
				, i.title as activity
				, if(h.nip is not null, 1, null) as existing
			from (
				/* Register */
				SELECT d.userid
                       , d.scormid
                       , d.UpdatedInDB as tgl_mulai
				FROM  moodle_db.mdl_scorm_scoes_track d
				LEFT JOIN moodle_db.mdl_user f
				ON d.userid = f.id
				
				WHERE f.username = '". $nip ."'
				
				GROUP BY d.userid, d.scormid
				ORDER BY d.userid asc, d.scormid asc
            ) r
            
            left join moodle_db.mdl_user a
			on a.id = r.userid
            
            left join moodle_db.mdl_course c
			on c.idnumber = r.scormid
            
            left join (
                 select *
                 from moodle_db.j_register
                 where id_user = '". $nip ."'
            ) b			
			on b.id_user = a.username
			and b.id_kursus = c.id
            
            left join (
				/* prestest */
				SELECT d.userid
                       , d.scormid
                       , e.title
				       , max( CAST(d.`value` AS UNSIGNED)) as nilai
				FROM  moodle_db.mdl_scorm_scoes_track d
				LEFT JOIN moodle_db.mdl_scorm_scoes e
				ON d.scoid = e. id
				LEFT JOIN moodle_db.mdl_user f
				ON d.userid = f.id
				
				WHERE f.username = '". $nip ."'
				
				AND d.element = 'cmi.core.score.raw'
				AND e.title = 'Pre-Assessment'
				
				GROUP BY d.userid, d.scormid
				ORDER BY d.userid asc, d.scormid asc
			) d
			on d.userid = r.userid
			and d.scormid = r.scormid
 
			left join (
				/* durasi materi */
				SELECT d.userid
                       , d.scormid
				       , SEC_TO_TIME( sum( TIME_TO_SEC(d.`value`) ) ) as durasi
				FROM  moodle_db.mdl_scorm_scoes_track d
				LEFT JOIN moodle_db.mdl_scorm_scoes e
				ON d.scoid = e. id
				LEFT JOIN moodle_db.mdl_user f
				ON d.userid = f.id
				
				WHERE f.username = '". $nip ."'
				
				AND d.element = 'cmi.core.total_time'
				AND e.title not in ( 'Pre-Assessment', 'Post-Assessment' ) 
				
				GROUP BY d.userid, d.scormid
				ORDER BY d.userid asc, d.scormid asc
			) e
			on e.userid = r.userid
			and e.scormid = r.scormid             
            
 			left join (
				/* posttest */
				SELECT d.userid
                       , d.scormid
                       , e.title
				   , max( CAST(d.`value` AS UNSIGNED)) as nilai
				FROM  moodle_db.mdl_scorm_scoes_track d
				LEFT JOIN moodle_db.mdl_scorm_scoes e
				ON d.scoid = e. id
				LEFT JOIN moodle_db.mdl_user f
				ON d.userid = f.id
				
				WHERE f.username = '". $nip ."'
				
				AND d.element = 'cmi.core.score.raw'
				AND e.title = 'Post-Assessment'
				
				GROUP BY d.userid, d.scormid
				ORDER BY d.userid asc, d.scormid asc
			) f
			on f.userid = r.userid
			and f.scormid = r.scormid 
 
			left join (       
				/* Sertifikat */
				SELECT c.id_kursus
                       , c.id_user
                       , c.`serial`
				FROM moodle_db.j_certify c
				where id_user = '". $nip ."'
				
				GROUP BY  c.id_kursus, c.id_user				
			) g
			on g.id_user = a.username
			and g.id_kursus = c.id
			
			left join moodle_db.z_employee_list_2 h
			on h.nip = a.username
 
			left join (       
				/* last activity */
				select b.userid
					   , b.scormid
					   , e.title
				from (
					select max(d.id) as max_id
					from moodle_db.mdl_scorm_scoes_track d	
    				LEFT JOIN moodle_db.mdl_user f
    				ON d.userid = f.id
    				
    				WHERE f.username = '". $nip ."'
					group by userid, scormid
					order by userid, scormid
				) d
				left join moodle_db.mdl_scorm_scoes_track b
				on d.max_id = b.id

				left join moodle_db.mdl_scorm_scoes e
				on b.scoid = e.id				
			) i
			on i.userid = r.userid
			and i.scormid = r.scormid 
		
		");			

		$chekRow = $query->num_rows;
		if($chekRow != "0")
		{	
			return $query->result();
		}
	}
	
	function updateIDjadwal($id, $data) 
	{
		$this->db->where('id', $id);
		$this->db->update('eknowledge_register', $data);
		
		return $this->db->affected_rows();
	}
	
	function eknowledgeUser($find, $limit=10)
	{
		$this->db->select('data_user.*, z_employee_list_2.birth_dmy');
		$this->db->from( 'data_user');
		$this->db->join('z_employee_list_2', 'z_employee_list_2.nip = data_user.ID_USER', 'left');		
		$this->db->like('data_user.ID_USER', $find);
		$this->db->or_like('data_user.USER_NAME', $find); 
		// $this->db->where( $row );	
		// $this->db->order_by("UpdatedInDB", "desc"); 		
		$this->db->limit( $limit );
				
		$query = $this->db->get();			

		$chekRow = $query->num_rows;
		if($chekRow != "0")
		{	
			return $query->result();
		}
	}
	
	function resetPwd($nip){
	
		$query = $this->db->query("
			UPDATE `data_user` a
			
			SET     a.password = md5(a.ID_USER)
			WHERE a.ID_USER = '". $nip ."'
		");
		// $query = $this->db->query("
			// UPDATE `data_user` a
			// LEFT JOIN z_employee_list_2 b
			// ON b.nip = a.ID_USER
			
			// SET     a.password = md5( if(b.birth_dmy IS NULL, a.ID_USER, DATE_FORMAT( b.birth_dmy, '%d%m%y') ) )
			// WHERE a.ID_USER = '". $nip ."'
		// ");
			//SET     a.password = md5( DATE_FORMAT( b.birth_dmy, '%d%m%y') )
			// AND b.birth_dmy IS NOT NULL
			
		return $this->db->affected_rows();
	}
		
	function JadwalTraining()
	{
		$this->db->select('*');
		$this->db->from( 'jadwal_training');	
		$this->db->order_by("tgl_mulai", "desc");	
		$this->db->order_by("id_kursus", "asc"); 	
		$this->db->order_by("id_jadwal", "asc");  	
				
		$query = $this->db->get();			

		$chekRow = $query->num_rows;
		if($chekRow != "0")
		{	
			return $query->result();
		}
	}
		
	function JadwalTrainingMoodle()
	{
		$this->db->select('*');
		$this->db->from( 'moodle_db.j_jadwal_training');	
		$this->db->order_by("tgl_mulai", "desc");	
		$this->db->order_by("id_kursus", "asc"); 	
		$this->db->order_by("id_jadwal", "asc");  	
				
		$query = $this->db->get();			

		$chekRow = $query->num_rows;
		if($chekRow != "0")
		{	
			return $query->result();
		}
	}
		
	function GETdataIduserORusername($find)
	{		
		$this->db->select('*');
		$this->db->from( 'z_employee_list_2');				
		$this->db->like('nip', $find);
		$this->db->or_like('nama', $find); 
		$this->db->order_by("nip", "asc");		
		$this->db->limit( 10 );
				
		$query = $this->db->get();			

		$chekRow = $query->num_rows;
		if($chekRow != "0")
		{	
			return $query->result();
		}		
	}
		
	function GETiduserORusername($find)
	{		
		$term = trim( $find );
	
		$rowdata = $this->Adminmax_db->GETdataIduserORusername($term);
		
		if(!empty( $rowdata )){
			foreach($rowdata as $row){
				$row->nama = ucwords(strtolower( $row->nama));				
				$row2[] = $row->nip . ' &raquo; ' . $row->nama;
				// $row2[] = $row->nip . ' ? ' . $row->nama;
			}
			
			$row3 =  json_encode($row2);
			
			return $row3;				
		}
		else{
			return 'Oopss no data..!';
		}		
	}
		
	function getiduser($find)
	{		
		$this->db->select('*');
		$this->db->from( 'z_employee_list_2');		
		$this->db->like('nip', $find);
		$this->db->order_by("nip", "asc");		
		$this->db->limit( 10 );
				
		$query = $this->db->get();			

		$chekRow = $query->num_rows;
		if($chekRow != "0")
		{	
			return $query->result();
		}		
	}
	
	function getiduser2($find)
	{	
		$this->db->select('*');
		$this->db->from( 'z_employee_list_2');		
		$this->db->where('nip', $find);
		$this->db->order_by("nip", "asc");		
		$this->db->limit( 1 );
				
		$query = $this->db->get();			

		$chekRow = $query->num_rows;
		if($chekRow != "0")
		{	
			$return =  $query->result();
			return $return[0];
		}			
	}
	
	function getusername($find)
	{		
		$this->db->select('*');
		$this->db->from( 'z_employee_list_2');		
		$this->db->like('nama', $find);
		$this->db->order_by("nama", "asc");		
		$this->db->limit( 10 );
				
		$query = $this->db->get();			

		$chekRow = $query->num_rows;
		if($chekRow != "0")
		{	
			return $query->result();
		}		
	}
	
	function getusername2($find)
	{	
		$this->db->select('*');
		$this->db->from( 'z_employee_list_2');		
		$this->db->where('nama', $find);
		$this->db->order_by("nama", "asc");		
		$this->db->limit( 1 );
				
		$query = $this->db->get();			

		$chekRow = $query->num_rows;
		if($chekRow != "0")
		{	
			$return =  $query->result();
			return $return[0];
		}			
	}
	
	function insert_eknowledge_register($data)
	{
		if(!empty( $data )){			
			$insert_query = $this->db->insert_string('eknowledge_register', $data);  // QUERY RUNS ONCE
			$insert_query = str_replace('INSERT INTO','INSERT IGNORE INTO',$insert_query);
			// $insert_query = str_replace('INSERT INTO','REPLACE INTO',$insert_query);
			$this->db->query($insert_query);			
			
			return $this->db->insert_id();
		}						
	}
	
	function UpdateDataUser()
	{	
		$query = $this->db->query("
			CALL UpdateDataUser()
		");
		
		return $this->db->affected_rows();
	}
	
	function UpdateDataUserByEmployee()
	{	
		$query = $this->db->query("
			INSERT INTO `data_user` (ID_USER, USER_NAME, GENDER, NO_TELP, EMAIL, PASSWORD)
			
			select  c.nip
				,  c.nama
				, c.sex
				, c.mblphone 
				, c.email 
				, md5( c.nip ) as `password`
			from z_employee_list_2 c
			left join `data_user` b ON c.nip = b.`ID_USER`
			where b.`ID_USER` is null
		");
		
		return $this->db->affected_rows();
	}	

	function updateNewEmployee( $key )
	{
		
		$query = $this->db->query("
			INSERT IGNORE INTO `eknowledge_register` (`id_jadwal_awal`,`id_jadwal`,`id_kursus`,`ID_USER`,`USER_NAME`,`posisi_detail`,`org`,`organisasi_name`,`regional_name`) 

			select ". $key['id_jadwal'] .", ". $key['id_jadwal'] .", ". $key['id_kursus'] .", `nip`, `nama`, `jobtitlea`, `org_group_code`, `org_group_name`, `org_region_name` 
			from `z_employee_list_2`
			where start_dmy > TRIM(year(now()))
		");
		
		return $this->db->affected_rows();

	}
	
	function UpdateSoalConfig($id, $data) 
	{	
		$this->db->where('id', $id);
		$this->db->update('soal_config', $data);
		
		return $this->db->affected_rows();
	}	
	
	
	/* 
		Update Employeelist Proses
		- table_to_array
		- insert_employee
		- rev3_insert_employee
		- empty_employee
		- insert_batch_employee
		- empty_employee4moodle
		- miroring_z_employee_list_2
		- UpdateUserID4moodle
		- UpdateEmployeeBirth
		- employeeList
	*/
	function table_to_array($html, $file = false, $rowend = false)
	{

		if($file == true){
			$html = file_get_contents($html);
		}
		else{
		
		}

		/// start with nothing
		$table = $start = $end = false;
		/// 'Vrijdag' should be unique enough, but will fail if it appears elsewhere
		$pos = strpos($html, '<table');

		/// find your start and end based on reliable tags
		if ( $pos !== false ) {
		  $start = stripos($html, '<tr>', $pos);
		  if ( $start !== false ) {
			$end = stripos($html, '</table>', $start);
		  }
		}

		/// make sure we have a start and end
		if ( $start !== false && $end !== false ) {
		  /// we can now grab our table $html;
		  $table = substr($html, $start, $end - $start);
		  /// convert brs to something that wont be removed by strip_tags
		  $table = preg_replace('#<br ?/>#i', "\n", $table);
		}

		if ( $table ) {
		  /// break apart based on rows (a close tr is quite reliable to find)
		  $rows = preg_split('#</tr>#i', $table);
		  /// break apart the cells (a close td is quite reliable to find)
		  foreach ( $rows as $key => $row ) {
			$rows[$key] = preg_split('#</td>#i', $row);
		  }
		}
		else {
		  /// create so we avoid errors
		  $rows = array();
		}

		/// changed this here from a foreach to a for because it seems
		/// foreach was working from a copy of $rows and so any modifications
		/// we made to $rows while the loop was happening were ignored.
		$lof = count($rows);
		for ( $rkey=0; $rkey<$lof; $rkey++ ) {
		  /// pull out the row
		  $row = $rows[$rkey];
		  /// step each cell in the row
		  foreach ( $row as $ckey => $cell ) {
			/// pull out our rowspan value
			if ( preg_match('/ rowspan=.([0-9]+)./', $cell, $regs) ) {
			  /// if rowspan is greater than one (i.e. spread across multirows)
			  $rowspan = (int) $regs[1];
			  if ( $rowspan > 1 ) {
				/// then copy this cell into the next row down, but decrease it's rowspan
				/// so that when we find it in the next row we know how many more times
				/// it should span down.
				$newcell = preg_replace('/( rowspan=.)([0-9]+)(.)/', '${1}'.($rowspan-1).'${3}', $cell);
				array_splice( $rows[$rkey+1], $ckey, 0, $newcell );
			  }
			}
		  }
		}

		//tambahan custom
		$field_name = array('id','NIP','Name','Sex','Job_Title','Mbl_Phone','Email','Org','Organization','Region','Penempatan','StartDate','MasaKerja','','');
		$rows4 = array();

		/// now finally step the normalised table and get rid of the unwanted tags 
		/// that remain at the same time split our values in to something more useful
		foreach ( $rows as $rkey => $row ) {
			foreach ( $row as $ckey => $cell ) {
				$rows[$rkey][$ckey] = preg_split('/\n+/',trim(strip_tags( $cell )));

				$nama_field = $field_name[$ckey];
				//$value = str_replace( '&nbsp;', '', trim(strip_tags( $cell )));
				$value = str_replace( '&nbsp;', ' ', trim(strip_tags( $cell )));
				//$value = trim(strip_tags( $cell ));
				
				if($rkey){
					if($nama_field){
						if($value){
							$rows4[$rkey][$nama_field] = $value;	
						}			
					}

				}
			}
		}

		if($rowend == true){
			$jmlh = count($rows4);
			$rows4[$jmlh] = null;
		}
		
		return $rows4;
	}
	
	function insert_employee($data)
	{	
		if(!empty( $data )){			
			// $this->db->insert('z_employee_list', $data);
			$this->db->replace('z_employee_list', $data);
			return $this->db->insert_id();
		}
	}
	
	function rev3_insert_employee($data)
	{	
		if(!empty( $data )){			
			// $this->db->insert('z_employee_list', $data);
			$this->db->replace('z_employee_list_2', $data);
			return $this->db->insert_id();
		}
	}
	
	function empty_employee()
	{	
		// $this->db->empty_table('z_employee_list_2'); 
		$this->db->truncate('z_employee_list_2'); //auto increment start : 0
	}
	
	function insert_batch_employee($data)
	{	
		if(!empty( $data )){			
			$this->db->insert_batch('z_employee_list_2', $data); 
			// return $this->db->insert_id();
		}
	}
		
	function empty_table($tablename='')
	{	
		if(!empty($tablename)){			
			// $this->db->empty_table('z_employee_list_2'); 
			$this->db->truncate($tablename); //auto increment start : 0
		}		
	}
	
	function insert_batch_table($data, $tablename)
	{	
		if(!empty( $data )){			
			// $this->db->insert_batch($tablename, $data); 
			// return $this->db->insert_id();
            
            $this->insert_ignore_batch($tablename, $data); 
		}
	}
	
	function empty_employee4moodle()
	{	
		// $this->db->empty_table('z_employee_list_2'); 
		$this->db->truncate('moodle_db.z_employee_list_2'); //auto increment start : 0
	}
	
	function miroring_z_employee_list_2()
	{	
		$query = $this->db->query("
			REPLACE INTO moodle_db.z_employee_list_2

			SELECT *
			FROM z_employee_list_2;
		");
		
		return $this->db->affected_rows();
	}
	
	function UpdateUserID4moodle()
	{	
		$query = $this->db->query("
			INSERT IGNORE moodle_db.mdl_user (mnethostid, username, password, idnumber, firstname, lastname, email, city, country, phone1, fullname, confirmed)

			SELECT a.*, '1'
			FROM (
				SELECT '1'
				   , trim(nip) as nip2
				   , md5( CONCAT( trim(nip), 'awasbelumjinak') ) as password
				   , nip
				   , SUBSTRING_INDEX( trim( `nama` ) , ' ', 1 ) AS firstname
				   , SUBSTRING_INDEX( trim( `nama` ) , ' ', -1 ) AS lastname
				   , email
				   , org_region_name
				   , 'ID'
				   , mblphone
				   , trim( `nama` ) as fullname				   
				FROM  moodle_db.z_employee_list_2
			) a
			LEFT JOIN moodle_db.mdl_user b
			ON a.nip2 = b.username
			WHERE b.username is null
		");
		
		return $this->db->affected_rows();
	}
		
	function UpdateEmployeeBirth()
	{	
		$query = $this->db->query("
			REPLACE INTO z_employee_birth_list (EmpId,EmpName,EmpDateBirth,EmpCityBirth)

			(SELECT EmpId,EmpName,EmpDateBirth,EmpCityBirth
			FROM `db_proint_pub`.`employee`);
		");
		
		return $this->db->affected_rows();
	}	
	
	function employeeList($find, $limit=10)
	{
		$this->db->select('*');
		$this->db->from( 'z_employee_list_2');		
		$this->db->like('nip', $find);
		$this->db->or_like('nama', $find);
		$this->db->order_by("nama", "asc");		
		$this->db->limit( $limit );
				
		$query = $this->db->get();			

		$chekRow = $query->num_rows;
		if($chekRow != "0")
		{	
			return $query->result();
		}
	}	
	
	function lastUpdate($key){
		$query = $this->db->query("		
			SHOW TABLE STATUS
			FROM eknow_test
			WHERE name = '". $key ."'
			
		");
		
		$chekRow = $query->num_rows;
		if($chekRow != "0")
		{	
			// return $query;
			$return =  $query->result();
			return $return[0];
		}
	}
	
	


	
	/* 
		Adminmax Generate Report
		- CurveExportBody
		- CurveExport
		- ReportDetail
		- CurveExport_rev2
		- ReportDetail_rev2
		- CurveExportBody_rev2
	*/	
	function CurveExportBody($rowData)
	{
		$this->load->helper('file');
		
		$head = read_file('./assets/download/CurveExport_xls_head.html');
		$body = '';
		$end = read_file('./assets/download/CurveExport_xls_end.html');
		$no = 1;

		foreach($rowData as $row){	
			$body_loop = "	
			   <tr height='25.33' class='xl64' style='height:19.00pt;mso-height-source:userset;mso-height-alt:380;'>
				<td class='xl68' height='25.33' style='height:19.00pt;' x:num>". $row->id_jadwal ."</td>
				<td class='xl69' x:str>". $row->regional_name ."</td>
				<td class='xl69' x:str>". $row->organisasi_name ."</td>
				<td class='xl69' x:str>". $row->posisi_detail ."</td>
				<td class='xl69' x:str>". ucwords(strtolower($row->USER_NAME)) ."</td>
				<td class='xl69' x:str>". $row->nip ."</td>
				<td class='xl69' x:str>". $row->register ."</td>
				<td class='xl69' x:str>". $row->certify ."</td>
				<td class='xl69' x:str>". $row->uncer_passinggrade ."</td>
				<td class='xl69' x:str>". $row->un_passinggrade ."</td>
				<td class='xl69' x:str>". $row->un_login ."</td>
			   </tr>			
			";			
			$body = $body . $body_loop;
			$no++;
		}
		
		$result = $head . $body . $end;	
		return $result;
	}
	
	function CurveExport($key)
	{
		$data['size'] = '';
		
		$rowData 	= $this->Adminmax_db->ReportDetail($key); // get per batch 
		$result 	= $this->Adminmax_db->CurveExportBody($rowData); 			
		$fileName = $key['fileName']. '_batch_' . $key['id_jadwal'] .'.xls';
		$data['fileName'] = $fileName;
		// file_put_contents( "./assets/download/" . $fileName, $result);
		
		if ( ! write_file('./assets/download/'.$fileName, $result)){
			// echo 'Unable to write the file';
			$data['status'] =  false;
		}
		else{
			// echo 'File written!';
			$data['status'] =  true;
			$file_information = get_file_info('./assets/download/'.$fileName);
			$data['size'] = $file_information['size'];			
		}		
		
		return $data;
	}	
	
	function ReportDetail($key)
	{
		$query_sql = "
			SELECT a.`id_jadwal`
				, a.regional_name
				, a.organisasi_name
				, a.posisi_detail
				, a.USER_NAME
				, (a.`ID_USER`) as nip
				, (case when a.`ID_USER` is not null then 'yes' else null end) as register
				, (case when b.`ID_USER` is not null then 'yes' else null end) as certify
				, (case when f.`ID_USER` is not null then 'yes' else null end) as uncer_passinggrade
				, (case when g.`ID_USER` is not null then 'yes' else null end) as un_passinggrade
				, (case when h.`ID_USER` is not null then 'yes' else null end) as un_login
				   
			FROM `eknowledge_register` a
			LEFT JOIN 
				(/* ID user yang sudah cetak sertifikat (FINISH)*/
					SELECT `ID_USER` , `USER_NAME` , `Serial`
					FROM `data_user_certify`
					WHERE `id_kursus` = '". $key['id_kursus'] ."'
					AND `id_jadwal` = '". $key['id_jadwal'] ."'
					GROUP BY `ID_USER`
				) b
				ON a.`ID_USER` = b.`ID_USER` 

			LEFT JOIN
				(     /* keterangan untuk register */
					SELECT *
					FROM `eknowledge_register_ket`
					WHERE `id_kursus` = '". $key['id_kursus'] ."'
					AND `id_jadwal` = '". $key['id_jadwal'] ."'
					GROUP BY `ID_USER`
				) j
				ON  a.ID_USER = j.ID_USER

			LEFT JOIN
			   (/* ID user yang sudah passing grade tapi blum cetak sertifikat */
					SELECT d.`ID_USER`, d.`id_kursus`       
					FROM       
					(
						SELECT max_post.ID_USER, max_post.id_kursus, ROUND(max(nilai)*100 /". $key['jmlh_soal'] .", 2 ) AS konversi
						FROM (
						 SELECT ID_USER, id_kursus, Ulangke, sum( `value` ) as nilai
						 FROM `data_user_posttest`
									WHERE `id_kursus` = '". $key['id_kursus'] ."'
									AND `id_jadwal` = '". $key['id_jadwal'] ."'
									GROUP BY `ID_USER`,`Ulangke`
									ORDER BY `ID_USER`,`Ulangke` ASC
						)max_post      
						GROUP BY `ID_USER`	
						HAVING konversi >= 70			
					) d
					LEFT JOIN 
						(SELECT `ID_USER` , `USER_NAME` , `Serial`
						FROM `data_user_certify`
						WHERE `id_kursus` = '". $key['id_kursus'] ."'
						AND `id_jadwal` = '". $key['id_jadwal'] ."'
						GROUP BY `ID_USER`) b
					ON d.`ID_USER` = b.`ID_USER`
					WHERE b.`ID_USER` is null    
			   )f
				ON a.`ID_USER` = f.`ID_USER` 
				
			LEFT JOIN
			   (/* ID user yang belum passing grade tapi sudah login atau pretest */
					SELECT e.`ID_USER`, e.`id_kursus`       
					FROM 
						(SELECT `ID_USER`, `id_kursus`
						FROM `data_visitor`
						WHERE `id_kursus` = '". $key['id_kursus'] ."'
						GROUP BY `ID_USER`) e
					LEFT JOIN      
					(			
						SELECT max_post.ID_USER, max_post.id_kursus, ROUND(max(nilai)*100 /". $key['jmlh_soal'] .", 2 ) AS konversi
						FROM (
						 SELECT ID_USER, id_kursus, Ulangke, sum( `value` ) as nilai
						 FROM `data_user_posttest`
									WHERE `id_kursus` = '". $key['id_kursus'] ."'
									AND `id_jadwal` = '". $key['id_jadwal'] ."'
									GROUP BY `ID_USER`,`Ulangke`
									ORDER BY `ID_USER`,`Ulangke` ASC
						)max_post      
						GROUP BY `ID_USER`	
						HAVING konversi >= 70	
					) d
					ON e.`ID_USER` = d.`ID_USER`
					WHERE d.`ID_USER` is null    
			   )g
				ON a.`ID_USER` = g.`ID_USER` 
				
			LEFT JOIN
			   (/* ID user yang belum login */
					SELECT a.`ID_USER`, a.`id_kursus`       
					FROM 
						(SELECT `ID_USER`, `id_kursus`
						FROM`eknowledge_register`
						WHERE `id_kursus` = '". $key['id_kursus'] ."' 
						AND `id_jadwal` = '". $key['id_jadwal'] ."' 
						AND posisi_detail != '')a
					LEFT JOIN      
						(SELECT `ID_USER`, `id_kursus`
						FROM `data_visitor`
						WHERE `id_kursus` = '". $key['id_kursus'] ."'
						GROUP BY `ID_USER`) e
					
					ON e.`ID_USER` = a.`ID_USER`
					WHERE e.`ID_USER` is null 
			   )h
				ON a.`ID_USER` = h.`ID_USER` 					

			WHERE a.`id_kursus` = '". $key['id_kursus'] ."'
			AND a.`id_jadwal` = '". $key['id_jadwal'] ."'
			AND a.posisi_detail !=''

			ORDER BY certify desc, uncer_passinggrade desc, un_passinggrade desc, un_login desc, a.regional_name, a.organisasi_name, a.posisi_detail	
		";
		
		$query = $this->db->query($query_sql);
		
		$chekRow = $query->num_rows;
		if($chekRow != "0")
		{	
			return $query->result();
		}				
	}
	
	function CurveExport_rev2($key)
	{
		$data['size'] = '';
		
		$rowData 	= $this->Adminmax_db->ReportDetail_rev2($key); // get per batch 
		$result 	= $this->Adminmax_db->CurveExportBody_rev2($rowData); 			
		$fileName = $key['fileName']. '_batch_' . $key['id_jadwal'] .'.xls';
		$data['fileName'] = $fileName;
		// file_put_contents( "./assets/download/" . $fileName, $result);
		
		if ( ! write_file('./assets/download/'.$fileName, $result)){
			// echo 'Unable to write the file';
			$data['status'] =  false;
		}
		else{
			// echo 'File written!';
			$data['status'] =  true;
			$file_information = get_file_info('./assets/download/'.$fileName);
			$data['size'] = $file_information['size'];			
		}		
		
		return $data;
	}	
	
	function ReportDetail_rev2($key)
	{
		$query_sql = "

		SELECT ax.*
		FROM (/* report xxx */
				SELECT a.id_jadwal_awal
					, a.id_kursus
					, a.id_jadwal
					, a.regional_name
					, a.organisasi_name
					, a.posisi_detail
					, a.USER_NAME
					, a.ID_USER
					, (case when c.`ID_USER` is not null then '1' else null end) as login
					, d.konversi as pretest
					, e.duration
					, f.konversi as posttest
					, g.`Serial` 
					, if(h.ID_USER is null, 'yes', null) as resign					
					, j.EMAIL
					, a.org
					/* , b.keterangan */
					, h.org_region_name
				FROM (
					SELECT * 
					FROM `eknowledge_register`
					WHERE `id_kursus` = '". $key['id_kursus'] ."'
					AND `id_jadwal` = '". $key['id_jadwal'] ."'
				) a 
				
				/* keterangan untuk register 
				LEFT JOIN (
					SELECT *
					FROM eknowledge_register_ket
					WHERE `id_kursus` = '". $key['id_kursus'] ."'
					AND `id_jadwal` = '". $key['id_jadwal'] ."'
				) b
					ON a.id_kursus = b.id_kursus
					AND a.ID_USER = b.ID_USER
				*/
				LEFT JOIN
				   /* data user */ 
                    `data_user` j
					ON a.ID_USER = j.ID_USER 
                    
				LEFT JOIN
				   (/* yang sudah login */ 
						SELECT `ID_USER`, `id_kursus`
						FROM `data_visitor`
						WHERE `id_kursus` = '". $key['id_kursus'] ."'
						GROUP BY `id_kursus`, `ID_USER`
				   ) c
					ON a.id_kursus = c.id_kursus
					AND a.ID_USER = c.ID_USER  
				
				LEFT JOIN
				   (/* yang sudah pretest */ 
						SELECT `id_kursus` , `id_jadwal` , `ID_USER` , `Ulangke` , max( nilai ) AS max_val, ROUND( max( nilai ) * 100 /". $key['jmlh_soal'] .", 0 ) AS konversi
						FROM (
								SELECT `id_kursus` , `id_jadwal` , `ID_USER` , `Ulangke` , sum( `value` ) AS nilai
								FROM `data_user_pretest`
								WHERE `id_kursus` = '". $key['id_kursus'] ."'
								AND `id_jadwal` = '". $key['id_jadwal'] ."'
								GROUP BY `id_kursus` , `id_jadwal` , `ID_USER` , `Ulangke`
								ORDER BY `id_kursus` , `id_jadwal` , `ID_USER` , `Ulangke` ASC
						)max_pre				
							/* `id_jadwal`,  gk di masukan (karena ingin mencari nilai tertinggi)*/
						GROUP BY `id_kursus`, `ID_USER`		
				   ) d
					ON a.id_kursus = d.id_kursus
					AND a.ID_USER = d.ID_USER  
				
				LEFT JOIN
				   (/* yang sudah materi */ 
						SELECT  id_jadwal, id_kursus, ID_USER, USER_NAME, SEC_TO_TIME( SUM( TIME_TO_SEC( duration ) ) ) as duration
						FROM durasi_halaman
						WHERE `id_kursus` = '". $key['id_kursus'] ."'
						AND `id_jadwal` = '". $key['id_jadwal'] ."'
						GROUP BY `id_kursus`, `ID_USER`
				   ) e
					ON a.id_kursus = e.id_kursus
					AND a.ID_USER = e.ID_USER 
				
				LEFT JOIN
				   (/* yang sudah posttest */ 
			
						SELECT `id_kursus` , `id_jadwal` , `ID_USER` , `Ulangke` , max( nilai ) AS max_val, ROUND( max( nilai ) * 100 /". $key['jmlh_soal'] .", 0 ) AS konversi
						FROM (
								SELECT `id_kursus` , `id_jadwal` , `ID_USER` , `Ulangke` , sum( `value` ) AS nilai
								FROM `data_user_posttest`
								WHERE `id_kursus` = '". $key['id_kursus'] ."'
								AND `id_jadwal` = '". $key['id_jadwal'] ."'
								GROUP BY `id_kursus` , `id_jadwal` , `ID_USER` , `Ulangke`
								ORDER BY `id_kursus` , `id_jadwal` , `ID_USER` , `Ulangke` ASC
						)max_post				
							/* `id_jadwal`,  gk di masukan (karena ingin mencari nilai tertinggi)*/
						GROUP BY `id_kursus`, `ID_USER`		
				   ) f
					ON a.id_kursus = f.id_kursus
					AND a.ID_USER = f.ID_USER  
				
				LEFT JOIN
				   (/* yang sudah Serial */ 
						SELECT `id_kursus`, `ID_USER`, `USER_NAME` , `Serial`
						FROM `data_user_certify`
						WHERE `id_kursus` = '". $key['id_kursus'] ."'
						AND `id_jadwal` = '". $key['id_jadwal'] ."'
						GROUP BY `id_kursus`, `ID_USER`
				   ) g
					ON a.id_kursus = g.id_kursus
					AND a.ID_USER = g.ID_USER  
				
				LEFT JOIN
				   (/* yang sudah Resign */ 
						SELECT nip as ID_USER, nama, org_region_name
						FROM z_employee_list_2
						GROUP BY nip
				   ) h
					ON a.ID_USER = h.ID_USER

				where a.`id_kursus` = '". $key['id_kursus'] ."'
				and a.`id_jadwal` = '". $key['id_jadwal'] ."'
				and a.posisi_detail !=''

				GROUP BY a.`id_kursus`, a.`id_jadwal`, a.`ID_USER`
				ORDER BY `Serial` desc
					, posttest desc
					, pretest desc
					, login desc
					, a.regional_name
					, a.organisasi_name
					, a.posisi_detail
                    
                    

		) ax
		";
		
		$query = $this->db->query($query_sql);
		
		$chekRow = $query->num_rows;
		if($chekRow != "0")
		{	
			return $query->result();
		}				
	}
	
	function CurveExportBody_rev2($rowData)
	{		
		$this->load->helper('file');
		
		if($rowData[0]->id_kursus == '22'){		
			//custom by job location
			$head = read_file('./assets/download/CurveExport_xls_head_rev3_x_sary.html');
			$body = '';
			$end = read_file('./assets/download/CurveExport_xls_end.html');			
		}
		else{		
			// $head = read_file('./assets/download/CurveExport_xls_head_rev3.html');
			$head = read_file('./assets/download/CurveExport_xls_head_rev4.html'); //+email
			$body = '';
			$end = read_file('./assets/download/CurveExport_xls_end.html');
		}
		$no = 1;

		foreach($rowData as $row){	
			if($rowData[0]->id_kursus == '22'){				
				//custom by job location
				$org_region_name = "<td class='xl28' x:str>". $row->org_region_name ."</td>";
				$email = "<td class='xl29' x:str>". $row->EMAIL ."</td>";
			}
			else{
				$org_region_name = "";
				$email = "";
			}
			
			
			$body_loop = "	  

               <tr height='25.33' class='xl25' style='height:19.00pt;mso-height-source:userset;mso-height-alt:380;'>
                <td class='xl25' height='25.33' style='height:19.00pt;' x:num>". $row->id_jadwal ."</td>
                <td class='xl28' x:str>". $row->regional_name ."</td>
                ". $org_region_name ."
                <td class='xl28' x:str>". $row->organisasi_name ."</td>
                <td class='xl28' x:str>". $row->posisi_detail ."</td>
                <td class='xl28' x:str>". ucwords(strtolower($row->USER_NAME)) ."</td>
                <td class='xl29' x:str>". $row->ID_USER ."</td>
                <td class='xl29' x:str>". $row->login ."</td>
                <td class='xl29' x:str>". $row->pretest ."</td>
                <td class='xl29' x:str>". $row->duration ."</td>
                <td class='xl29' x:str>". $row->posttest ."</td>
                <td class='xl29' x:str>". $row->Serial ."</td>
                <td class='xl29' x:str>". $row->resign ."</td>
                <td class='xl28' x:str>". $row->EMAIL ."</td>
                ". $email ."
               </tr>
   
   		
			";			
			$body = $body . $body_loop;
			$no++;
		}
		
		$result = $head . $body . $end;	
		return $result;
	}
	




	/* 
		Curve Map
		- findJadwal
		- soal_config
		- findSoalConfig
		- getDataChart
		- chartSetData
	*/	
	function findJadwal($find_1)
	{		
		$this->db->select('*');
		$this->db->from('jadwal_training');
		$this->db->where($find_1);
		$this->db->limit(1);

		$query = $this->db->get();		
	
		$chekRow = $query->num_rows;
		if($chekRow != "0")
		{
			$return =  $query->result();
			return $return[0];
		}
	}
	function soal_config()
	{		
		$this->db->select('*');
		$this->db->from('soal_config');

		$query = $this->db->get();		
	
		$chekRow = $query->num_rows;
		if($chekRow != "0")
		{
			return $query->result();
		}
	}
	
	function findSoalConfig($find_1='')
	{		
		$this->db->select('*');
		$this->db->from('soal_config');
		
		if(!empty($find_1)){		
			$this->db->where('id_kursus', $find_1['id_kursus']);		
			$this->db->limit(1);
		}
		else{
			$this->db->limit(30);
		}
		

		$query = $this->db->get();		
	
		$chekRow = $query->num_rows;
		if($chekRow != "0")
		{			
			if(!empty($find_1)){		
				$return =  $query->result();
				return $return[0];
			}			
			else{
				foreach( $query->result() as $row ){
					$row2[$row->id_kursus] = $row;
				}
				
				return $row2;
			}
		}
	}
	
	function getDataChart($key)
	{
		$query_sql = "
			SELECT a.id_jadwal
				   , a.`regional_name`
				   , a.posisi_detail
				   , COUNT(a.`ID_USER`) as jumlah_peserta
				   , COUNT(b.`ID_USER`) as jumlah_cer
				   , COUNT(f.`ID_USER`) as jumlah_uncer_passinggrade
				   , COUNT(g.`ID_USER`) as jumlah_un_passinggrade
				   , COUNT(h.`ID_USER`) as jumlah_un_login
				   , COUNT(j.`ID_USER`) as keterangan
				   
			FROM `eknowledge_register` a
			LEFT JOIN 
				(/* ID user yang sudah cetak sertifikat (FINISH)*/
					SELECT `ID_USER` , `USER_NAME` , `Serial`
					FROM `data_user_certify`
					WHERE `id_kursus` = '". $key['id_kursus'] ."'
					AND `id_jadwal` = '". $key['id_jadwal'] ."'
					GROUP BY `ID_USER`
				) b
				ON a.`ID_USER` = b.`ID_USER` 

			LEFT JOIN
				(     /* keterangan untuk register */
					SELECT *
					FROM `eknowledge_register_ket`
					WHERE `id_kursus` = '". $key['id_kursus'] ."'
					AND `id_jadwal` = '". $key['id_jadwal'] ."'
					GROUP BY `ID_USER`
				) j
				ON  a.ID_USER = j.ID_USER

			LEFT JOIN
			   (/* ID user yang sudah passing grade tapi blum cetak sertifikat */
					SELECT d.`ID_USER`, d.`id_kursus`       
					FROM       
					(
						SELECT max_post.ID_USER, max_post.id_kursus, ROUND(max(nilai)*100 /". $key['jmlh_soal'] .", 2 ) AS konversi
						FROM (
						 SELECT ID_USER, id_kursus, Ulangke, sum( `value` ) as nilai
						 FROM `data_user_posttest`
									WHERE `id_kursus` = '". $key['id_kursus'] ."'
									AND `id_jadwal` = '". $key['id_jadwal'] ."'
									GROUP BY `ID_USER`,`Ulangke`
									ORDER BY `ID_USER`,`Ulangke` ASC
						)max_post      
						GROUP BY `ID_USER`	
						HAVING konversi >= 70			
					) d
					LEFT JOIN 
						(SELECT `ID_USER` , `USER_NAME` , `Serial`
						FROM `data_user_certify`
						WHERE `id_kursus` = '". $key['id_kursus'] ."'
						AND `id_jadwal` = '". $key['id_jadwal'] ."'
						GROUP BY `ID_USER`) b
					ON d.`ID_USER` = b.`ID_USER`
					WHERE b.`ID_USER` is null    
			   )f
				ON a.`ID_USER` = f.`ID_USER` 
				
			LEFT JOIN
			   (/* ID user yang belum passing grade tapi sudah login atau pretest */
					SELECT e.`ID_USER`, e.`id_kursus`       
					FROM 
						(SELECT `ID_USER`, `id_kursus`
						FROM `data_visitor`
						WHERE `id_kursus` = '". $key['id_kursus'] ."'
						GROUP BY `ID_USER`) e
					LEFT JOIN      
					(			
						SELECT max_post.ID_USER, max_post.id_kursus, ROUND(max(nilai)*100 /". $key['jmlh_soal'] .", 2 ) AS konversi
						FROM (
						 SELECT ID_USER, id_kursus, Ulangke, sum( `value` ) as nilai
						 FROM `data_user_posttest`
									WHERE `id_kursus` = '". $key['id_kursus'] ."'
									AND `id_jadwal` = '". $key['id_jadwal'] ."'
									GROUP BY `ID_USER`,`Ulangke`
									ORDER BY `ID_USER`,`Ulangke` ASC
						)max_post      
						GROUP BY `ID_USER`	
						HAVING konversi >= 70	
					) d
					ON e.`ID_USER` = d.`ID_USER`
					WHERE d.`ID_USER` is null    
			   )g
				ON a.`ID_USER` = g.`ID_USER` 
				
			LEFT JOIN
			   (/* ID user yang belum login */
					SELECT a.`ID_USER`, a.`id_kursus`       
					FROM 
						(SELECT `ID_USER`, `id_kursus`
						FROM`eknowledge_register`
						WHERE `id_kursus` = '". $key['id_kursus'] ."' 
						AND `id_jadwal` = '". $key['id_jadwal'] ."' 
						AND posisi_detail != '')a
					LEFT JOIN      
						(SELECT `ID_USER`, `id_kursus`
						FROM `data_visitor`
						WHERE `id_kursus` = '". $key['id_kursus'] ."'
						GROUP BY `ID_USER`) e
					
					ON e.`ID_USER` = a.`ID_USER`
					WHERE e.`ID_USER` is null 
			   )h
				ON a.`ID_USER` = h.`ID_USER` 					

			WHERE a.`id_kursus` = '". $key['id_kursus'] ."'
			AND a.`id_jadwal` = '". $key['id_jadwal'] ."'
			AND a.posisi_detail !=''
			
			GROUP BY  a.regional_name  
			ORDER BY a.regional_name, a.posisi_detail			
		";
		
		$query = $this->db->query($query_sql);
		
		$chekRow = $query->num_rows;
		if($chekRow != "0")
		{	
			return $query->result();
		}				
	}
	
	function chartSetData($getDataChart)
	{
		foreach($getDataChart as $row){	
			$categories[] = str_replace("Regional Office - ", "", $row->regional_name);

			$register[] = $row->jumlah_peserta;
			$unlogin[] 	= $row->jumlah_un_login;
			$unpass[] 	= $row->jumlah_un_passinggrade;
			$pass[] 	= $row->jumlah_uncer_passinggrade;
			$certify[] 	= $row->jumlah_cer;
		}
				
		$res['categories']	= "'" . implode("','", $categories) . "'";
		$res['register']	= implode(",", $register);
		$res['unlogin']		= implode(",", $unlogin);
		$res['unpass']		= implode(",", $unpass);
		$res['pass'] 		= implode(",", $pass);
		$res['certify']		= implode(",", $certify);
		
		return $res;					
	}
	
		
		
	/* 
		Curve4moodle
		- kursus
		- scoes_track_reg
		- scoes_track_duration
		- Curve4moodle_newEmployee_count
		- Curve4moodle_allEmployee_count
		- Curve4moodle_newEmployee_detail
		- Curve4moodle_allEmployee_detail
		- excelSetData
		- writingExcel
	*/
	function kursus_id($id)
	{
		$this->db->select('id as id_kursus,shortname,idnumber,fullname,certify_name');
		$this->db->from('moodle_db.mdl_course');
		// $this->db->where_in('id', $id);
		$this->db->where('id', $id);
		// $this->db->order_by("UpdatedInDB", "desc"); 
		$this->db->limit(1);

		$query = $this->db->get();		
	
		$chekRow = $query->num_rows;
		if($chekRow != "0")
		{
			$return =  $query->result();
			return $return[0];
		}
	}
	function jadwalMoodle($key)
	{
		$this->db->select('*');
		$this->db->from('moodle_db.j_jadwal_training');
		// $this->db->where_in('id', $id);
		$this->db->where( $key );
		// $this->db->order_by("UpdatedInDB", "desc"); 
		$this->db->limit(1);

		$query = $this->db->get();		
	
		$chekRow = $query->num_rows;
		if($chekRow != "0")
		{
			$return =  $query->result();
			return $return[0];
		}
	}
	
	function kursus($id='')
	{				
		if(!empty($id)){
			$and_1 = "and idnumber = '". $id ."'";
		}
		else{
			$and_1 = '';
		}
		
		$query_sql = "
			select id as id_kursus,shortname,idnumber,fullname,certify_name
			from moodle_db.mdl_course
			where ( idnumber != ''
			or idnumber is null ) "
			. $and_1 ;	
		
		$query = $this->db->query($query_sql);
		
		$chekRow = $query->num_rows;
		if($chekRow != "0")
		{	
			return $query->result();
		}
	}
	
	function moodle_kursus($id='')
	{				
		if(!empty($id)){
			$and_1 = "and idnumber = '". $id ."'";
		}
		else{
			$and_1 = '';
		}
		
		$query_sql = "
			select id as id_kursus,shortname,idnumber,fullname,certify_name
			from moodle_db.mdl_course
			where ( idnumber != ''
			or idnumber is null ) "
			. $and_1 ;	
		
		$query = $this->db->query($query_sql);
		
		$chekRow = $query->num_rows;
		if($chekRow != "0")
		{	
			return $query->result();
		}
	}
	
	function moodle_tahun_kursus()
	{				
		
		$query_sql = "
			select DATE_FORMAT( tgl_mulai, '%Y') as tahun
			from moodle_db.mdl_scorm_scoes_track_reg 			
			group by DATE_FORMAT( tgl_mulai, '%Y')
			order by DATE_FORMAT( tgl_mulai, '%Y') desc
		";	
		
		$query = $this->db->query($query_sql);
		
		$chekRow = $query->num_rows;
		if($chekRow != "0")
		{	
			return $query->result();
		}
	}
	
	function scoes_track_reg()
	{				
		$query_sql = "
			CALL moodle_db.scoes_track_reg() ;
		";		
		$query = $this->db->query($query_sql);
		
		return $this->db->affected_rows();
	}
	
	function scoes_track_duration()
	{				
		$query_sql = "
			CALL moodle_db.scoes_track_duration() ;
		";		
		$query = $this->db->query($query_sql);
		
		return $this->db->affected_rows();
	}
	
	function moodle_temp()
	{				
		$query_sql = "
			CALL moodle_db.z_moodle_temp() ;
		";		
		$query = $this->db->query($query_sql);
		
		return $this->db->affected_rows();
	}
	
	function moodle_training_by_tahun($key)
	{				
		$query_sql = "
			SELECT a.nip
				, a.nama
				, a.jobtitlea
				, a.email
				, a.org_group_name
				, a.org_region_name       
				, b.training
				, b.tahun
				, b.max_posttest      
			FROM `moodle_db`.`z_employee_list_2` a

			LEFT JOIN (
			SELECT *
					, MAX(`posttest`) AS max_posttest
			FROM (`moodle_db`.`z_moodle_temp`)
			WHERE `training` =  '". $key['training'] ."'
			AND `tahun` =  '". $key['tahun'] ."'
			GROUP BY `nip`
			ORDER BY `posttest` desc, `regional_name`, `organisasi_name`, `posisi_detail`, `nama`
			) b
			ON a.`nip` = b.`nip`

			ORDER BY b.`posttest` desc, a.`org_region_name`, a.`org_group_name`, a.`jobtitlea`, a.`nama`
		";		
		
		$query = $this->db->query($query_sql);
		
		$chekRow = $query->num_rows;
		if($chekRow != "0")
		{	
			return $query->result();
		}
	}
	
	function moodle_training($key)
	{				
		$query_sql = "
			SELECT *
			FROM (`moodle_db`.`z_moodle_temp`)
			WHERE `training` =  '". $key['training'] ."'
			ORDER BY case when nip is null then 1 else 0 end, `nip`, `tahun`, `attempt`
		";		
		
		$query = $this->db->query($query_sql);
		
		$chekRow = $query->num_rows;
		if($chekRow != "0")
		{	
			return $query->result();
		}
	}
	
	function moodle_training0($key)
	{
		$this->db->select('a*, gf', 'asa');
		$this->db->select('/**/ case when nip is null then 1 else 0 end');
		$this->db->from('moodle_db.z_moodle_temp');
		$this->db->where( $key );
		//$this->db->where('name !=', $name);
		$this->db->order_by(' ', ' ');
		$this->db->order_by("nip"); 
		$this->db->order_by("tahun");
		$this->db->order_by("attempt");

		// $this->db->where_in('id', $id);
		// $this->db->order_by("UpdatedInDB", "desc"); 
		//$this->db->limit(1);
		//$this->db->group_by("nip");
		// $this->db->order_by("regional_name"); 
		// $this->db->order_by("organisasi_name"); 
		// $this->db->order_by("posisi_detail"); 
		// $this->db->order_by("nama"); 

		$query = $this->db->get();		
	
		$chekRow = $query->num_rows;
		if($chekRow != "0")
		{
			$return =  $query->result();
			return $return[0];
		}
	}


	
	function moodle_export($key, $rowData)
	{
		$data['size'] = '';
		
		$result 	= $this->Adminmax_db->moodle_ExportBody($rowData); 	//CurveExportBody_rev2		
		$fileName = $key['fileName'] .'.xls';
		$data['fileName'] = $fileName;
		// file_put_contents( "./assets/download/" . $fileName, $result);
		
		if ( ! write_file('./assets/download/'.$fileName, $result)){
			// echo 'Unable to write the file';
			$data['status'] =  false;
		}
		else{
			// echo 'File written!';
			$data['status'] =  true;
			$file_information = get_file_info('./assets/download/'.$fileName);
			$data['size'] = $file_information['size'];			
		}		
		
		return $data;
	}
	
	function moodle_ExportBody($rowData)
	{		
		$this->load->helper('file');
		
		
		$head = read_file('./assets/download/CurveExport_xls_head_moodle.html'); //+email
		$body = '';
		$end = read_file('./assets/download/CurveExport_xls_end.html');

		$no = 1;

		foreach($rowData as $row){	
		
			$body_loop = "	  

               <tr height='25.33' class='xl25' style='height:19.00pt;mso-height-source:userset;mso-height-alt:380;'>
                <td class='xl25' height='25.33' style='height:19.00pt;' x:num>". $no ."</td>
                <td class='xl28' x:str>". $row->org_region_name ."</td>
                <td class='xl28' x:str>". $row->org_group_name ."</td>
                <td class='xl28' x:str>". $row->jobtitlea ."</td>
                <td class='xl28' x:str>". ucwords(strtolower($row->nama)) ."</td>
                <td class='xl29' x:str>". $row->nip ."</td>
                <td class='xl29' x:str>". $row->training ."</td>
                <td class='xl29' x:str>". $row->tahun ."</td>
                <td class='xl29' x:str>". $row->max_posttest ."</td>
                <td class='xl28' x:str>". $row->email ."</td>
                <td class='xl29' x:str>". '' ."</td>
                <td class='xl29' x:str>". '' ."</td>
								<td class='xl29' x:str>". '' ."</td>
								
               </tr>
   
   		
			";			
			$body = $body . $body_loop;
			$no++;
		}
		
		$result = $head . $body . $end;	
		return $result;
	}
	
	function moodle_export_all($key, $rowData)
	{
		$data['size'] = '';
		
		$result 	= $this->Adminmax_db->moodle_ExportBody_all($rowData); 	//CurveExportBody_rev2		
		$fileName = $key['fileName'] .'.xls';
		$data['fileName'] = $fileName;
		// file_put_contents( "./assets/download/" . $fileName, $result);
		
		if ( ! write_file('./assets/download/'.$fileName, $result)){
			// echo 'Unable to write the file';
			$data['status'] =  false;
		}
		else{
			// echo 'File written!';
			$data['status'] =  true;
			$file_information = get_file_info('./assets/download/'.$fileName);
			$data['size'] = $file_information['size'];			
		}		
		
		return $data;
	}
	
	function moodle_ExportBody_all($rowData)
	{		
		$this->load->helper('file');
		
		
		$head = read_file('./assets/download/CurveExport_xls_head_moodle_all.html'); //+email
		$body = '';
		$end = read_file('./assets/download/CurveExport_xls_end.html');

		$no = 1;

		foreach($rowData as $row){	
		
			$body_loop = "	  

               <tr height='25.33' class='xl25' style='height:19.00pt;mso-height-source:userset;mso-height-alt:380;'>
                <td class='xl25' height='25.33' style='height:19.00pt;' x:num>". $no ."</td>
                <td class='xl28' x:str>". $row->regional_name ."</td>
                <td class='xl28' x:str>". $row->organisasi_name ."</td>
                <td class='xl28' x:str>". $row->posisi_detail ."</td>
                <td class='xl28' x:str>". ucwords(strtolower($row->nama)) ."</td>
                <td class='xl29' x:str>". $row->nip ."</td>
                <td class='xl29' x:str>". $row->training ."</td>
                <td class='xl29' x:str>". $row->attempt ."</td>
                <td class='xl29' x:str>". $row->tahun ."</td>
                <td class='xl29' x:str>". $row->tgl_mulai ."</td>
                <td class='xl29' x:str>". $row->pretest ."</td>
                <td class='xl29' x:str>". $row->pre_date ."</td>
                <td class='xl29' x:str>". $row->materi ."</td>
                <td class='xl29' x:str>". $row->posttest ."</td>
                <td class='xl29' x:str>". $row->post_date ."</td>
                <td class='xl28' x:str>". $row->email ."</td>
                <td class='xl29' x:str>". '' ."</td>
								
							 </tr>
							 
			";			
			$body = $body . $body_loop;
			$no++;
		}
		
		$result = $head . $body . $end;	
		return $result;
	}
		
	function Curve4moodle_newEmployee_count($key)
	{				
		$query_sql = "
			/* 
			------------------------------------------------------
				Count of proses moodle tracking
			------------------------------------------------------
			 */
			select regional_name
				, co.shortname as training
				, count(a.nip) as jumlah_peserta
				, sum(if(reg.userid is null, 1, 0)) as jumlah_un_login
				, count(pre.userid) as pretest
				, count(m.userid) as materi
				, count(post.userid) as post
				, count(post.passinggrade) as passinggrade
				, count(post.un_passinggrade) as jumlah_un_passinggrade_0
				, sum(if((post.userid is null or post.un_passinggrade is not null) and pre.userid is not null, 1, 0)) as jumlah_un_passinggrade 
				, sum(if(cer.id_user is null && post.passinggrade is not null, 1, 0 )) as jumlah_uncer_passinggrade
				, count(cer.id_user) as jumlah_cer
				
			from (
				select nip
					, nama
					, jobtitlea as posisi_detail
					, email
					, org_group_name as organisasi_name
					, org_region_name as regional_name
					, job_location
					, start_dmy
					, DATE_FORMAT( start_dmy, '%m') as bulan
					, DATE_FORMAT( start_dmy, '%Y') as tahun
				from moodle_db.z_employee_list_2
				where DATE_FORMAT( start_dmy, '%Y') = '". $key['tahun'] ."'
				and start_dmy >= '". $key['tgl_mulai'] ."'
				and start_dmy <= '". $key['tgl_selesai'] ."'
				order by org_region_name
					, org_group_name
					, jobtitlea
					, nip
			) a


			left join (
				select id, username as nip, concat(firstname, ' ', lastname) as nama
				from moodle_db.mdl_user
			) usr
			on a.nip = usr.nip

			left join (
				select userid, scormid, tgl_mulai
				from moodle_db.mdl_scorm_scoes_track_reg 
				where scormid = '". $key['scormid'] ."'
			) reg 	/* register */
			on reg.userid = usr.id

			left join (
				select id as id_kursus,shortname,idnumber
				from moodle_db.mdl_course 
			) co
			on reg.scormid = co.idnumber

			left join (
				select userid, scormid, MAX( nilai ) as max_nilai
				from (
					select *, CAST( `value` as unsigned) as nilai
					from moodle_db.mdl_scorm_scoes_track
					where element = 'cmi.core.score.raw'
					order by userid, scormid
				) a
				left join moodle_db.mdl_scorm_scoes b
				on a.scoid = b.id
				
				where b.title = 'Pre-Assessment'
				
				group by userid, scormid
				order by userid, scormid
			) pre	/* pretest */
			on reg.userid = pre.userid
			and reg.scormid = pre.scormid

			left join (
				select userid, scormid, jmlh_wktu
				from moodle_db.mdl_scorm_scoes_track_duration     
				group by userid, scormid
				order by userid, scormid
			) m		/* materi */
			on reg.userid = m.userid
			and reg.scormid = m.scormid

			left join (
				select userid, scormid, MAX( nilai ) as max_nilai
					   , if(MAX( nilai ) >= 70, 1, null) as passinggrade
					   , if(MAX( nilai ) < 70, 1, null) as un_passinggrade
				from (
					select *, CAST( `value` as unsigned) as nilai
					from moodle_db.mdl_scorm_scoes_track
					where element = 'cmi.core.score.raw'
					order by userid, scormid
				) a
				left join moodle_db.mdl_scorm_scoes b
				on a.scoid = b.id
				
				where b.title = 'Post-Assessment'
				
				group by userid, scormid
				order by userid, scormid
			) post	/* posttest */
			on reg.userid = post.userid
			and reg.scormid = post.scormid

			left join (
				select id_user, id_kursus, `serial`
				from moodle_db.j_certify 
				group by id_kursus, id_user
			) cer /* sertifikat */
			on co.id_kursus = cer.id_kursus
			and a.nip = cer.id_user


			group by regional_name


		";
		
		$query = $this->db->query($query_sql);
		
		$chekRow = $query->num_rows;
		if($chekRow != "0")
		{	
			return $query->result();
		}	
	}
	
	function Curve4moodle_allEmployee_count($key)
	{				
		$query_sql = "
			/* 
			------------------------------------------------------
				Count of proses moodle tracking
			------------------------------------------------------
			 */
			select regional_name
				, co.shortname as training
				, count(a.nip) as jumlah_peserta
				, sum(if(reg.userid is null, 1, 0)) as jumlah_un_login
				, count(pre.userid) as pretest
				, count(m.userid) as materi
				, count(post.userid) as post
				, count(post.passinggrade) as passinggrade
				, count(post.un_passinggrade) as jumlah_un_passinggrade_0
				, sum(if((post.userid is null or post.un_passinggrade is not null) and pre.userid is not null, 1, 0)) as jumlah_un_passinggrade 
				, sum(if(cer.id_user is null && post.passinggrade is not null, 1, 0 )) as jumlah_uncer_passinggrade
				, count(cer.id_user) as jumlah_cer
				
			from (
				select nip
					, nama
					, jobtitlea as posisi_detail
					, email
					, org_group_name as organisasi_name
					, org_region_name as regional_name
					, job_location
					, start_dmy
					, DATE_FORMAT( start_dmy, '%m') as bulan
					, DATE_FORMAT( start_dmy, '%Y') as tahun
				from moodle_db.z_employee_list_2
				order by org_region_name
					, org_group_name
					, jobtitlea
					, nip
			) a


			left join (
				select id, username as nip, concat(firstname, ' ', lastname) as nama
				from moodle_db.mdl_user
			) usr
			on a.nip = usr.nip

			left join (
				select userid, scormid, tgl_mulai
				from moodle_db.mdl_scorm_scoes_track_reg 
				where scormid = '". $key['scormid'] ."'
			) reg 	/* register */
			on reg.userid = usr.id

			left join (
				select id as id_kursus,shortname,idnumber
				from moodle_db.mdl_course 
			) co
			on reg.scormid = co.idnumber

			left join (
				select userid, scormid, MAX( nilai ) as max_nilai
				from (
					select *, CAST( `value` as unsigned) as nilai
					from moodle_db.mdl_scorm_scoes_track
					where element = 'cmi.core.score.raw'
					order by userid, scormid
				) a
				left join moodle_db.mdl_scorm_scoes b
				on a.scoid = b.id
				
				where b.title = 'Pre-Assessment'
				
				group by userid, scormid
				order by userid, scormid
			) pre	/* pretest */
			on reg.userid = pre.userid
			and reg.scormid = pre.scormid

			left join (
				select userid, scormid, jmlh_wktu
				from moodle_db.mdl_scorm_scoes_track_duration     
				group by userid, scormid
				order by userid, scormid
			) m		/* materi */
			on reg.userid = m.userid
			and reg.scormid = m.scormid

			left join (
				select userid, scormid, MAX( nilai ) as max_nilai
					   , if(MAX( nilai ) >= 70, 1, null) as passinggrade
					   , if(MAX( nilai ) < 70, 1, null) as un_passinggrade
				from (
					select *, CAST( `value` as unsigned) as nilai
					from moodle_db.mdl_scorm_scoes_track
					where element = 'cmi.core.score.raw'
					order by userid, scormid
				) a
				left join moodle_db.mdl_scorm_scoes b
				on a.scoid = b.id
				
				where b.title = 'Post-Assessment'
				
				group by userid, scormid
				order by userid, scormid
			) post	/* posttest */
			on reg.userid = post.userid
			and reg.scormid = post.scormid

			left join (
				select id_user, id_kursus, `serial`
				from moodle_db.j_certify 
				group by id_kursus, id_user
			) cer /* sertifikat */
			on co.id_kursus = cer.id_kursus
			and a.nip = cer.id_user


			group by regional_name


		";
		
		$query = $this->db->query($query_sql);
		
		$chekRow = $query->num_rows;
		if($chekRow != "0")
		{	
			return $query->result();
		}	
	}
	
	function Curve4moodle_allEmployee_count0($key)
	{				
		$query_sql = "
			/* 
			------------------------------------------------------
				Count of proses moodle tracking
				
				Curve4moodle_allEmployee_count
			------------------------------------------------------
			 */
			select regional_name
				, co.shortname as training
				, count(a.nip) as jumlah_peserta
				, sum(if(reg.userid is null, 1, 0)) as jumlah_un_login
				, count(pre.userid) as pretest
				, count(m.userid) as materi
				, count(post.userid) as post
				, count(post.passinggrade) as passinggrade
				, count(post.un_passinggrade) as jumlah_un_passinggrade_0
				, sum(if((post.userid is null or post.un_passinggrade is not null) and pre.userid is not null, 1, 0)) as jumlah_un_passinggrade 
				, sum(if(cer.id_user is null && post.passinggrade is not null, 1, 0 )) as jumlah_uncer_passinggrade
				, count(cer.id_user) as jumlah_cer
				
			from (
				select nip
					, nama
					, jobtitlea as posisi_detail
					, email
					, org_group_name as organisasi_name
					, org_region_name as regional_name
					, job_location
					, start_dmy
					, DATE_FORMAT( start_dmy, '%m') as bulan
					, DATE_FORMAT( start_dmy, '%Y') as tahun
				from moodle_db.z_employee_list_2
				group by nip
				order by org_region_name
					, org_group_name
					, jobtitlea
					, nip
			) a


			left join (
				select id, username as nip, concat(firstname, ' ', lastname) as nama
				from moodle_db.mdl_user
			) usr
			on a.nip = usr.nip

			left join (
				select userid, scormid, tgl_mulai
				from moodle_db.mdl_scorm_scoes_track_reg 
				where scormid = '". $key['scormid'] ."'
				and tgl_mulai >= '". $key['tgl_mulai'] ."'
				and tgl_mulai <= '". $key['tgl_selesai'] ."'
			) reg 	/* register */
			on reg.userid = usr.id

			left join (
				select id as id_kursus,shortname,idnumber
				from moodle_db.mdl_course 
			) co
			on reg.scormid = co.idnumber

			left join (
				select userid, scormid, MAX( nilai ) as max_nilai
				from (
					select *, CAST( `value` as unsigned) as nilai
					from moodle_db.mdl_scorm_scoes_track
					where element = 'cmi.core.score.raw'
					order by userid, scormid
				) a
				left join moodle_db.mdl_scorm_scoes b
				on a.scoid = b.id
				
				where b.title = 'Pre-Assessment'
				
				group by userid, scormid
				order by userid, scormid
			) pre	/* pretest */
			on reg.userid = pre.userid
			and reg.scormid = pre.scormid

			left join (
				select userid, scormid, jmlh_wktu
				from moodle_db.mdl_scorm_scoes_track_duration     
				group by userid, scormid
				order by userid, scormid
			) m		/* materi */
			on reg.userid = m.userid
			and reg.scormid = m.scormid

			left join (
				select userid, scormid, MAX( nilai ) as max_nilai
					   , if(MAX( nilai ) >= 70, 1, null) as passinggrade
					   , if(MAX( nilai ) < 70, 1, null) as un_passinggrade
				from (
					select *, CAST( `value` as unsigned) as nilai
					from moodle_db.mdl_scorm_scoes_track
					where element = 'cmi.core.score.raw'
					order by userid, scormid
				) a
				left join moodle_db.mdl_scorm_scoes b
				on a.scoid = b.id
				
				where b.title = 'Post-Assessment'
				
				group by userid, scormid
				order by userid, scormid
			) post	/* posttest */
			on reg.userid = post.userid
			and reg.scormid = post.scormid

			left join (
				select id_user, id_kursus, `serial`
				from moodle_db.j_certify 
				group by id_kursus, id_user
			) cer /* sertifikat */
			on co.id_kursus = cer.id_kursus
			and a.nip = cer.id_user


			group by regional_name

		";
		
		$query = $this->db->query($query_sql);
		
		$chekRow = $query->num_rows;
		if($chekRow != "0")
		{	
			return $query->result();
		}	
	}
	
	
	function Curve4moodleCustom_count($key)
	{				
		$query_sql = "
			/* 
			------------------------------------------------------
				Count of proses moodle tracking
				
				Curve4moodle_allEmployee_count
			------------------------------------------------------
			 */
			select regional_name
				, co.shortname as training
				, count(a.nip) as jumlah_peserta
				, sum(if(reg.userid is null, 1, 0)) as jumlah_un_login
				, count(pre.userid) as pretest
				, count(m.userid) as materi
				, count(post.userid) as post
				, count(post.passinggrade) as passinggrade
				, count(post.un_passinggrade) as jumlah_un_passinggrade_0
				, sum(if((post.userid is null or post.un_passinggrade is not null) and pre.userid is not null, 1, 0)) as jumlah_un_passinggrade 
				, sum(if(cer.id_user is null && post.passinggrade is not null, 1, 0 )) as jumlah_uncer_passinggrade
				, count(cer.id_user) as jumlah_cer
				
			from (
                select if(b0.nip is null, a0.nip, b0.nip) as nip
					, if(b0.nip is null, a0.nama, b0.nama) as nama
					, jobtitlea as posisi_detail
					, email
					, org_group_name as organisasi_name
					, org_region_name as regional_name
					, job_location
					, start_dmy
					, DATE_FORMAT( start_dmy, '%m') as bulan
					, DATE_FORMAT( start_dmy, '%Y') as tahun
					, if(b0.nip is null, 'yes', null) as resign
				from (
    				select id_user as nip, user_name as nama 
                    from moodle_db.j_register
                    where id_jadwal = '". $key['id_jadwal'] ."'
                    and id_kursus = '". $key['id_kursus'] ."'  
                    group by id_user              
                ) a0
				left join moodle_db.z_employee_list_2 b0
				on a0.nip = b0.nip
				order by resign asc
					, org_region_name
                    , org_group_name
					, jobtitlea
					, nip
			) a


			left join (
				select id, username as nip, concat(firstname, ' ', lastname) as nama
				from moodle_db.mdl_user
			) usr
			on a.nip = usr.nip

			left join (
				select userid, scormid, tgl_mulai
				from moodle_db.mdl_scorm_scoes_track_reg 
				where scormid = '". $key['scormid'] ."'
			) reg 	/* register */
			on reg.userid = usr.id

			left join (
				select id as id_kursus,shortname,idnumber
				from moodle_db.mdl_course 
			) co
			on reg.scormid = co.idnumber

			left join (
				select userid, scormid, MAX( nilai ) as max_nilai
				from (
					select *, CAST( `value` as unsigned) as nilai
					from moodle_db.mdl_scorm_scoes_track
					where element = 'cmi.core.score.raw'
					order by userid, scormid
				) a
				left join moodle_db.mdl_scorm_scoes b
				on a.scoid = b.id
				
				where b.title = 'Pre-Assessment'
				
				group by userid, scormid
				order by userid, scormid
			) pre	/* pretest */
			on reg.userid = pre.userid
			and reg.scormid = pre.scormid

			left join (
				select userid, scormid, jmlh_wktu
				from moodle_db.mdl_scorm_scoes_track_duration     
				group by userid, scormid
				order by userid, scormid
			) m		/* materi */
			on reg.userid = m.userid
			and reg.scormid = m.scormid

			left join (
				select userid, scormid, MAX( nilai ) as max_nilai
					   , if(MAX( nilai ) >= 70, 1, null) as passinggrade
					   , if(MAX( nilai ) < 70, 1, null) as un_passinggrade
				from (
					select *, CAST( `value` as unsigned) as nilai
					from moodle_db.mdl_scorm_scoes_track
					where element = 'cmi.core.score.raw'
					order by userid, scormid
				) a
				left join moodle_db.mdl_scorm_scoes b
				on a.scoid = b.id
				
				where b.title = 'Post-Assessment'
				
				group by userid, scormid
				order by userid, scormid
			) post	/* posttest */
			on reg.userid = post.userid
			and reg.scormid = post.scormid

			left join (
				select id_user, id_kursus, `serial`
				from moodle_db.j_certify 
				group by id_kursus, id_user
			) cer /* sertifikat */
			on co.id_kursus = cer.id_kursus
			and a.nip = cer.id_user


			group by regional_name

		";
		
		$query = $this->db->query($query_sql);
		
		$chekRow = $query->num_rows;
		if($chekRow != "0")
		{	
			return $query->result();
		}	
	}
	
	function Curve4moodle_newEmployee_detail($key)
	{
		$query_sql = "
			/* 
			------------------------------------------------------
				Detail of proses moodle tracking
			------------------------------------------------------
			 */
			select a.*
				, co.shortname as training
				, DATE_FORMAT( reg.tgl_mulai, '%Y-%m-%d') as tgl_mulai
				, if(pre.max_nilai is not null, 1, null) as login
				, pre.max_nilai as pretest
				, if(m.jmlh_wktu is not null, 1, null) as materi
				, m.jmlh_wktu as durasi
				, post.max_nilai as posttest
				, cer.`serial` as sertifikat
				
			from (
				select nip
					, nama
					, jobtitlea as posisi_detail
					, email
					, org_group_name as organisasi_name
					, org_region_name as regional_name
					, job_location
					, start_dmy
					, DATE_FORMAT( start_dmy, '%m') as bulan
					, DATE_FORMAT( start_dmy, '%Y') as tahun
				from moodle_db.z_employee_list_2
				where DATE_FORMAT( start_dmy, '%Y') = '". $key['tahun'] ."'
				and start_dmy >= '". $key['tgl_mulai'] ."'
				and start_dmy <= '". $key['tgl_selesai'] ."'
				order by org_region_name
					, org_group_name
					, jobtitlea
					, nip
			) a

			left join (
				select id, username as nip, concat(firstname, ' ', lastname) as nama
				from moodle_db.mdl_user
			) usr
			on a.nip = usr.nip

			left join (
				select userid, scormid, tgl_mulai
				from moodle_db.mdl_scorm_scoes_track_reg 
				where scormid = '". $key['scormid'] ."'
			) reg 	/* register */
			on reg.userid = usr.id

			left join (
				select id as id_kursus,shortname,idnumber
				from moodle_db.mdl_course 
			) co
			on reg.scormid = co.idnumber

			left join (
				select userid, scormid, MAX( nilai ) as max_nilai
				from (
					select *, CAST( `value` as unsigned) as nilai
					from moodle_db.mdl_scorm_scoes_track
					where element = 'cmi.core.score.raw'
					order by userid, scormid
				) a
				left join moodle_db.mdl_scorm_scoes b
				on a.scoid = b.id
				
				where b.title = 'Pre-Assessment'
				
				group by userid, scormid
				order by userid, scormid
			) pre	/* pretest */
			on reg.userid = pre.userid
			and reg.scormid = pre.scormid

			left join (
				select userid, scormid, jmlh_wktu
				from moodle_db.mdl_scorm_scoes_track_duration     
				group by userid, scormid
				order by userid, scormid
			) m		/* materi */
			on reg.userid = m.userid
			and reg.scormid = m.scormid

			left join (
				select userid, scormid, MAX( nilai ) as max_nilai
					   , if(MAX( nilai ) >= 70, 1, null) as passinggrade
					   , if(MAX( nilai ) < 70, 1, null) as un_passinggrade
				from (
					select *, CAST( `value` as unsigned) as nilai
					from moodle_db.mdl_scorm_scoes_track
					where element = 'cmi.core.score.raw'
					order by userid, scormid
				) a
				left join moodle_db.mdl_scorm_scoes b
				on a.scoid = b.id
				
				where b.title = 'Post-Assessment'
				
				group by userid, scormid
				order by userid, scormid
			) post	/* posttest */
			on reg.userid = post.userid
			and reg.scormid = post.scormid

			left join (
				select id_user, id_kursus, `serial`
				from moodle_db.j_certify 
				group by id_kursus, id_user
			) cer /* sertifikat */
			on co.id_kursus = cer.id_kursus
			and a.nip = cer.id_user


			order by posttest desc
				, materi desc
				, pretest desc
				, login desc
				, a.regional_name
				, a.`organisasi_name`
				, a.posisi_detail
				, a.nip
				, reg.scormid
			";	
		
		$query = $this->db->query($query_sql);
		
		$chekRow = $query->num_rows;
		if($chekRow != "0")
		{	
			return $query->result();
		}	
	}
	
	function Curve4moodle_allEmployee_detail($key)
	{
		$query_sql = "
			/* 
			------------------------------------------------------
				Detail of proses moodle tracking
			------------------------------------------------------
			 */
			select a.*
				, co.shortname as training
				, DATE_FORMAT( reg.tgl_mulai, '%Y-%m-%d') as tgl_mulai
				, if(pre.max_nilai is not null, 1, null) as login
				, pre.max_nilai as pretest
				, if(m.jmlh_wktu is not null, 1, null) as materi
				, m.jmlh_wktu as durasi
				, post.max_nilai as posttest
				, cer.`serial` as sertifikat
				
			from (
				select nip
					, nama
					, jobtitlea as posisi_detail
					, email
					, org_group_name as organisasi_name
					, org_region_name as regional_name
					, job_location
					, start_dmy
					, DATE_FORMAT( start_dmy, '%m') as bulan
					, DATE_FORMAT( start_dmy, '%Y') as tahun
				from moodle_db.z_employee_list_2
				order by org_region_name
					, org_group_name
					, jobtitlea
					, nip
			) a

			left join (
				select id, username as nip, concat(firstname, ' ', lastname) as nama
				from moodle_db.mdl_user
			) usr
			on a.nip = usr.nip

			left join (
				select userid, scormid, tgl_mulai
				from moodle_db.mdl_scorm_scoes_track_reg 
				where scormid = '". $key['scormid'] ."'
			) reg 	/* register */
			on reg.userid = usr.id

			left join (
				select id as id_kursus,shortname,idnumber
				from moodle_db.mdl_course 
			) co
			on reg.scormid = co.idnumber

			left join (
				select userid, scormid, MAX( nilai ) as max_nilai
				from (
					select *, CAST( `value` as unsigned) as nilai
					from moodle_db.mdl_scorm_scoes_track
					where element = 'cmi.core.score.raw'
					order by userid, scormid
				) a
				left join moodle_db.mdl_scorm_scoes b
				on a.scoid = b.id
				
				where b.title = 'Pre-Assessment'
				
				group by userid, scormid
				order by userid, scormid
			) pre	/* pretest */
			on reg.userid = pre.userid
			and reg.scormid = pre.scormid

			left join (
				select userid, scormid, jmlh_wktu
				from moodle_db.mdl_scorm_scoes_track_duration     
				group by userid, scormid
				order by userid, scormid
			) m		/* materi */
			on reg.userid = m.userid
			and reg.scormid = m.scormid

			left join (
				select userid, scormid, MAX( nilai ) as max_nilai
					   , if(MAX( nilai ) >= 70, 1, null) as passinggrade
					   , if(MAX( nilai ) < 70, 1, null) as un_passinggrade
				from (
					select *, CAST( `value` as unsigned) as nilai
					from moodle_db.mdl_scorm_scoes_track
					where element = 'cmi.core.score.raw'
					order by userid, scormid
				) a
				left join moodle_db.mdl_scorm_scoes b
				on a.scoid = b.id
				
				where b.title = 'Post-Assessment'
				
				group by userid, scormid
				order by userid, scormid
			) post	/* posttest */
			on reg.userid = post.userid
			and reg.scormid = post.scormid

			left join (
				select id_user, id_kursus, `serial`
				from moodle_db.j_certify 
				group by id_kursus, id_user
			) cer /* sertifikat */
			on co.id_kursus = cer.id_kursus
			and a.nip = cer.id_user


			order by posttest desc
				, materi desc
				, pretest desc
				, login desc
				, a.regional_name
				, a.`organisasi_name`
				, a.posisi_detail
				, a.nip
				, reg.scormid
			";	
		
		$query = $this->db->query($query_sql);
		
		$chekRow = $query->num_rows;
		if($chekRow != "0")
		{	
			return $query->result();
		}	
	}
	
	function Curve4moodle_allEmployee_detail0($key)
	{
		$query_sql = "
			/* 
			------------------------------------------------------
				Detail of proses moodle tracking
			------------------------------------------------------
			 */
			select a.*
				, co.shortname as training
				, DATE_FORMAT( reg.tgl_mulai, '%Y-%m-%d') as tgl_mulai
				, if(pre.max_nilai is not null, 1, null) as login
				, pre.max_nilai as pretest
				, if(m.jmlh_wktu is not null, 1, null) as materi
				, m.jmlh_wktu as durasi
				, post.max_nilai as posttest
				, cer.`serial` as sertifikat
				
			from (
				select nip
					, nama
					, jobtitlea as posisi_detail
					, email
					, org_group_name as organisasi_name
					, org_region_name as regional_name
					, job_location
					, start_dmy
					, DATE_FORMAT( start_dmy, '%m') as bulan
					, DATE_FORMAT( start_dmy, '%Y') as tahun
				from moodle_db.z_employee_list_2
				group by nip
				order by org_region_name
					, org_group_name
					, jobtitlea
					, nip
			) a

			left join (
				select id, username as nip, concat(firstname, ' ', lastname) as nama
				from moodle_db.mdl_user
			) usr
			on a.nip = usr.nip

			left join (
				select userid, scormid, tgl_mulai
				from moodle_db.mdl_scorm_scoes_track_reg 
				where scormid = '". $key['scormid'] ."'
				and tgl_mulai >= '". $key['tgl_mulai'] ."'
				and tgl_mulai <= '". $key['tgl_selesai'] ."'
			) reg 	/* register */
			on reg.userid = usr.id

			left join (
				select id as id_kursus,shortname,idnumber
				from moodle_db.mdl_course 
			) co
			on reg.scormid = co.idnumber

			left join (
				select userid, scormid, MAX( nilai ) as max_nilai
				from (
					select *, CAST( `value` as unsigned) as nilai
					from moodle_db.mdl_scorm_scoes_track
					where element = 'cmi.core.score.raw'
					order by userid, scormid
				) a
				left join moodle_db.mdl_scorm_scoes b
				on a.scoid = b.id
				
				where b.title = 'Pre-Assessment'
				
				group by userid, scormid
				order by userid, scormid
			) pre	/* pretest */
			on reg.userid = pre.userid
			and reg.scormid = pre.scormid

			left join (
				select userid, scormid, jmlh_wktu
				from moodle_db.mdl_scorm_scoes_track_duration     
				group by userid, scormid
				order by userid, scormid
			) m		/* materi */
			on reg.userid = m.userid
			and reg.scormid = m.scormid

			left join (
				select userid, scormid, MAX( nilai ) as max_nilai
					   , if(MAX( nilai ) >= 70, 1, null) as passinggrade
					   , if(MAX( nilai ) < 70, 1, null) as un_passinggrade
				from (
					select *, CAST( `value` as unsigned) as nilai
					from moodle_db.mdl_scorm_scoes_track
					where element = 'cmi.core.score.raw'
					order by userid, scormid
				) a
				left join moodle_db.mdl_scorm_scoes b
				on a.scoid = b.id
				
				where b.title = 'Post-Assessment'
				
				group by userid, scormid
				order by userid, scormid
			) post	/* posttest */
			on reg.userid = post.userid
			and reg.scormid = post.scormid

			left join (
				select id_user, id_kursus, `serial`
				from moodle_db.j_certify 
				group by id_kursus, id_user
			) cer /* sertifikat */
			on co.id_kursus = cer.id_kursus
			and a.nip = cer.id_user


			order by posttest desc
				, materi desc
				, pretest desc
				, login desc
				, a.regional_name
				, a.`organisasi_name`
				, a.posisi_detail
				, a.nip
				, reg.scormid
			";	
		
		$query = $this->db->query($query_sql);
		
		$chekRow = $query->num_rows;
		if($chekRow != "0")
		{	
			return $query->result();
		}	
	}
	
	function Curve4moodleCustom_detail($key)
	{
		$query_sql = "
			/* 
			------------------------------------------------------
				Detail of proses moodle tracking
			------------------------------------------------------
			 */
			select a.*
				, co.shortname as training
				, DATE_FORMAT( reg.tgl_mulai, '%Y-%m-%d') as tgl_mulai
				, if(pre.max_nilai is not null, 1, null) as login
				, pre.max_nilai as pretest
				, if(m.jmlh_wktu is not null, 1, null) as materi
				, m.jmlh_wktu as durasi
				, post.max_nilai as posttest
				, cer.`serial` as sertifikat
				
			from (
                select if(b0.nip is null, a0.nip, b0.nip) as nip
					, if(b0.nip is null, a0.nama, b0.nama) as nama
					, jobtitlea as posisi_detail
					, email
					, org_group_name as organisasi_name
					, org_region_name as regional_name
					, job_location
					, start_dmy
					, DATE_FORMAT( start_dmy, '%m') as bulan
					, DATE_FORMAT( start_dmy, '%Y') as tahun
					, if(b0.nip is null, 'yes', null) as resign
				from (
    				select id_user as nip, user_name as nama 
                    from moodle_db.j_register
                    where id_jadwal = '". $key['id_jadwal'] ."'
                    and id_kursus = '". $key['id_kursus'] ."'  
                    group by id_user              
                ) a0
				left join moodle_db.z_employee_list_2 b0
				on a0.nip = b0.nip
				order by resign asc
					, org_region_name
                    , org_group_name
					, jobtitlea
					, nip
			) a

			left join (
				select id, username as nip, concat(firstname, ' ', lastname) as nama
				from moodle_db.mdl_user
			) usr
			on a.nip = usr.nip

			left join (
				select userid, scormid, tgl_mulai
				from moodle_db.mdl_scorm_scoes_track_reg 
				where scormid = '". $key['scormid'] ."'
			) reg 	/* register */
			on reg.userid = usr.id

			left join (
				select id as id_kursus,shortname,idnumber
				from moodle_db.mdl_course 
			) co
			on reg.scormid = co.idnumber

			left join (
				select userid, scormid, MAX( nilai ) as max_nilai
				from (
					select *, CAST( `value` as unsigned) as nilai
					from moodle_db.mdl_scorm_scoes_track
					where element = 'cmi.core.score.raw'
					order by userid, scormid
				) a
				left join moodle_db.mdl_scorm_scoes b
				on a.scoid = b.id
				
				where b.title = 'Pre-Assessment'
				
				group by userid, scormid
				order by userid, scormid
			) pre	/* pretest */
			on reg.userid = pre.userid
			and reg.scormid = pre.scormid

			left join (
				select userid, scormid, jmlh_wktu
				from moodle_db.mdl_scorm_scoes_track_duration     
				group by userid, scormid
				order by userid, scormid
			) m		/* materi */
			on reg.userid = m.userid
			and reg.scormid = m.scormid

			left join (
				select userid, scormid, MAX( nilai ) as max_nilai
					   , if(MAX( nilai ) >= 70, 1, null) as passinggrade
					   , if(MAX( nilai ) < 70, 1, null) as un_passinggrade
				from (
					select *, CAST( `value` as unsigned) as nilai
					from moodle_db.mdl_scorm_scoes_track
					where element = 'cmi.core.score.raw'
					order by userid, scormid
				) a
				left join moodle_db.mdl_scorm_scoes b
				on a.scoid = b.id
				
				where b.title = 'Post-Assessment'
				
				group by userid, scormid
				order by userid, scormid
			) post	/* posttest */
			on reg.userid = post.userid
			and reg.scormid = post.scormid

			left join (
				select id_user, id_kursus, `serial`
				from moodle_db.j_certify 
				group by id_kursus, id_user
			) cer /* sertifikat */
			on co.id_kursus = cer.id_kursus
			and a.nip = cer.id_user


			order by a.resign asc
				, posttest desc
				, materi desc
				, pretest desc
				, login desc
				, a.regional_name
				, a.`organisasi_name`
				, a.posisi_detail
				, a.nip
				, reg.scormid
			";	
		
		$query = $this->db->query($query_sql);
		
		$chekRow = $query->num_rows;
		if($chekRow != "0")
		{	
			return $query->result();
		}	
	}

	
	function excelSetData($rowData)
	{
		$this->load->helper('file');
		
		$head = read_file('./assets/download/template-moodle-head.html');
		$body = '';
		$end = read_file('./assets/download/template-moodle-end.html');
		$no = 1;

		foreach($rowData as $row){	
			if(!empty($row->resign)){
				$resign = "<td class='xl25'>". $row->resign ."</td>";
			}
			else{
				$resign = '';
			}
			
			$body_loop = "	
			
			   <tr height='24' style='height:18.00pt;mso-height-source:userset;mso-height-alt:360;'>
				<td class='xl27' height='24' style='height:18.00pt;' x:str>". $row->nip ."</td>
				<td class='xl28' x:str>". ucwords(strtolower($row->nama)) ."</td>
				<td class='xl28' x:str>". $row->posisi_detail ."</td>
				<td class='xl28'>". $row->email ."</td>
				<td class='xl28' x:str>". $row->organisasi_name ."</td>
				<td class='xl28' x:str>". $row->regional_name ."</td>
				<td class='xl27'>". $row->job_location ."</td>
				<td class='xl29' x:str>". $row->start_dmy ."</td>
				<td class='xl27' x:str>". $row->bulan ."</td>
				<td class='xl27' x:str>". $row->tahun ."</td>
				<td class='xl27' x:str>". $row->training ."</td>
				<td class='xl27' x:str>". $row->tgl_mulai ."</td>
				<td class='xl27' x:num>". $row->login ."</td>
				<td class='xl27' x:num>". $row->pretest ."</td>
				<td class='xl27' x:num>". $row->materi ."</td>
				<td class='xl27' x:str>". $row->durasi ."</td>
				<td class='xl27' x:num>". $row->posttest ."</td>
				<td class='xl25'>". $row->sertifikat ."</td>
				". $resign ."
			   </tr>			
			";			
			$body = $body . $body_loop;
			$no++;
		}
		
		$result = $head . $body . $end;	
		return $result;		
	}
	
	function writingExcel($result, $filename)
	{
		$fileName = $filename .'.xls';
		$data['size'] = '';					
		$data['fileName'] = $fileName;
		// file_put_contents( "./assets/download/" . $fileName, $result);
		
		if ( ! write_file('./assets/download/'.$fileName, $result)){
			// echo 'Unable to write the file';
			$data['status'] =  false;
		}
		else{
			// echo 'File written!';
			$data['status'] =  true;
			$file_information = get_file_info('./assets/download/'.$fileName);
			$data['size'] = $file_information['size'];			
		}		
		
		return $data;		
	}
	
	
	
	/* 
		Reset of Posttest Moodle
		- search_resetofposttestMoodle
		- backupOfTestMoodle
		- Clear_j_data_user_posttestMoodle
		- Clear_mdl_scorm_scoes_trackMoodle
	*/	
	function search_resetofposttestMoodle($row) 
	{		
		$query = $this->db->query("
			SELECT  *
			FROM
				(
					/* get max nilai posttest group by scormid*/
					SELECT t.userid
					   , t.scormid
					   , t.scoid
					   , t.attempt
					   , s.manifest as course1
					   , s.title as modulpost
					   , max(cast(t.value as signed)) as nilai
					   , max(cast(t.attempt as signed)) as  max_attempt_post
					   , u.username
					   , u.firstname
					   , u.lastname
					   
					FROM moodle_db.mdl_scorm_scoes_track t
					LEFT JOIN moodle_db.mdl_scorm_scoes s
					ON t.scoid = s.id
					LEFT JOIN moodle_db.mdl_user u
					ON t.userid = u.id
					
					WHERE u.username = '". $row['username'] ."'
					AND s.identifier = 'apos00001'
					AND t.element = 'cmi.core.score.raw'
					GROUP BY t.userid, t.scormid
					having max(cast(t.value as signed)) < 70
					
				) c        

			LEFT JOIN
				(
					SELECT a.userid, a.scormid, a.max_scoid, b.max_attempt, a.manifest as course2, a.title as lastmodul
        
					FROM 
						( 
							/* get max scoid group by attempt*/
							SELECT ta.*
								   , s.manifest
								   , s.title
							FROM (
								SELECT u.username, t.userid
								   , t.scormid
								   , t.attempt
								   , max(cast(scoid as signed)) as  max_scoid
								FROM moodle_db.mdl_scorm_scoes_track t
								LEFT JOIN moodle_db.mdl_user u
								ON t.userid = u.id
								
								WHERE u.username = '". $row['username'] ."'
								GROUP BY t.userid, t.scormid, t.attempt 
							) ta   
							LEFT JOIN moodle_db.mdl_scorm_scoes s
							ON ta.max_scoid = s.id
						) a
						
					LEFT JOIN    
						(       
							/* get max attempt group by scormid */
							SELECT t.userid
							   , t.scormid
							   , max(cast(attempt as signed)) as  max_attempt
							FROM moodle_db.mdl_scorm_scoes_track t
							LEFT JOIN moodle_db.mdl_scorm_scoes s
							ON t.scoid = s.id
							LEFT JOIN moodle_db.mdl_user u
							ON t.userid = u.id
							
							WHERE u.username = '". $row['username'] ."'
							GROUP BY t.userid, t.scormid        
						 ) b 
					ON a.userid = b.userid
					AND a.scormid = b.scormid
					AND a.attempt = b.max_attempt
						
					WHERE b.max_attempt is not null
				) d
			ON c.userid = d.userid
			AND c.scormid = d.scormid 

			LEFT JOIN 
				(
					/* get jmlh soal yg sdh d jawab */
					SELECT p.id_kursus, p.ID_USER, p.Ulangke, count(p.id) as jmlh, c.idnumber, c.shortname
					FROM moodle_db.j_data_user_posttest p
					LEFT JOIN moodle_db.mdl_course c
					ON p.id_kursus = c.id
					GROUP BY p.id_kursus, p.ID_USER, p.Ulangke
				)jpost 
			ON c.username = jpost.ID_USER
			AND c.scormid = jpost.idnumber
			AND c.attempt = jpost.Ulangke 
			
			ORDER BY c.userid, c.scormid			
			LIMIT 20

		");		//". $row['username'] ."

		$chekRow = $query->num_rows;
		if($chekRow != "0")
		{
			// return $query;
			return $query->result();
		}	
	}	
	
	function backupOfTestMoodle($row) 
	{		
		$execution = $this->session->userdata('name2lwr');
		
		$query = $this->db->query("
			REPLACE INTO moodle_db.j_data_user_posttest_reseter

			SELECT *, '". $execution ."'
			FROM moodle_db.j_data_user_posttest 
			WHERE ID_USER = '". $row['nip'] ."'	
			AND id_kursus = '". $row['id_kursus'] ."'	
			AND Ulangke = '". $row['attempt'] ."'	
		");
		
		return $this->db->affected_rows();	
	}
	
	function Clear_j_data_user_posttestMoodle($row) 
	{		
		//Clear j_data_user_posttest
		
		$query = $this->db->query("
			Delete
			FROM moodle_db.j_data_user_posttest 
			WHERE ID_USER = '". $row['nip'] ."'	
			AND id_kursus = '". $row['id_kursus'] ."'	
			AND Ulangke = '". $row['attempt'] ."'			

		");		//". $row['username'] ."
		
		return $this->db->affected_rows();	

	}
	
	function Clear_mdl_scorm_scoes_trackMoodle($row) 
	{	
		//$row['']
		
		if( ( $row['attempt'] == $row['max_attempt'] ) && ( $row['scoid'] == $row['max_scoid'] ) ){
		
			$query = $this->db->query("
				Delete
				FROM moodle_db.mdl_scorm_scoes_track 
				WHERE userid in (
					select id
					from moodle_db.mdl_user
					where username = '". $row['nip'] ."'
				)
				AND scormid = '". $row['scormid'] ."'	
				AND attempt = '". $row['attempt'] ."'
				AND scoid = '". $row['scoid'] ."'				
			");	

			return $this->db->affected_rows();	
			
		}
		elseif( $row['max_attempt'] > $row['attempt'] ){

			$query = $this->db->query("
				Delete
				FROM moodle_db.mdl_scorm_scoes_track 
				WHERE userid in (
					select id
					from moodle_db.mdl_user
					where username = '". $row['nip'] ."'
				)
				AND scormid = '". $row['scormid'] ."'	
				AND attempt = '". $row['max_attempt'] ."'	
			");	
			
			$query = $this->db->query("
				Delete
				FROM moodle_db.mdl_scorm_scoes_track 
				WHERE userid in (
					select id
					from moodle_db.mdl_user
					where username = '". $row['nip'] ."'
				)
				AND scormid = '". $row['scormid'] ."'	
				AND attempt = '". $row['attempt'] ."'
				AND scoid = '". $row['scoid'] ."'				
			");		
			
			return $this->db->affected_rows();	
		}
			
	}	
	
/* End of file adminmax_db.php */
/*  */
}		