<?php
class Region_db extends CI_Model {
  
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		//region_db
		//Region_db
		
		date_default_timezone_set('Asia/Jakarta');		
    }


	
	
	/* Service request
		- JadwalTraining
		- eknowledgeRegister
		- eknowledgeMonitor
		- LearningMonitor4moodle
		- GETdataIduserORusername
		- GETiduserORusername
		- employeeList
	*/
		
	function JadwalTraining()
	{
		$this->db->select('*');
		$this->db->from( 'jadwal_training');	
		$this->db->where('peserta !=', 'admin');
		if(!empty($_SESSION['picArea'])){
			$region = $_SESSION['picArea'];
			$this->db->like('peserta', $region);
		}
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
	
	function eknowledgeRegister($find, $limit=10)
	{
		$this->db->select('*');
		$this->db->from( 'eknowledge_register');	
		if(!empty($_SESSION['picArea'])){
			$region = $_SESSION['picArea'];
			$this->db->like('regional_name', $region);
			
			$where = "( ID_USER like '%".$find."%' OR USER_NAME like '%".$find."%' )";
			$this->db->where($where);
		}	
		else{		
			$this->db->like('ID_USER', $find);
			$this->db->or_like('USER_NAME', $find); 
		}	
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
		if(!empty($_SESSION['picArea'])){
			$region = $_SESSION['picArea'];
			$regional_name = "AND  `regional_name`  LIKE '%". $region ."%'";
		}
		else{
			$regional_name = " ";
		}
		
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
					WHERE 1=1
					and ID_USER = '". $nip ."'
					". $regional_name ."
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
		$region = $_SESSION['picArea'];
		
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
			
			AND ( b.regional_name  LIKE '%". $region ."%' OR h.org_region_name LIKE '%". $region ."%' )
		
		");			

		$chekRow = $query->num_rows;
		if($chekRow != "0")
		{	
			return $query->result();
		}
	}

	function GETdataIduserORusername($find)
	{		
		$region = $_SESSION['picArea'];
		
		$this->db->select('*');
		$this->db->from( 'z_employee_list_2');				
		$this->db->like('org_region_name', $region);
		// $this->db->like('nip', $find);
		// $this->db->or_like('nama', $find); 
		
		$where = "( nip like '%".$find."%' OR nama like '%".$find."%' )";
		$this->db->where($where);
			
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
	
		$rowdata = $this->GETdataIduserORusername($term);
		
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
			AND a.`regional_name`  LIKE '%". $key['region'] ."%'
			
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
		Adminmax Generate Report
		- CurveExport_rev2
		- ReportDetail_rev2
		- CurveExportBody_rev2
	*/
	
	function CurveExport_rev2($key)
	{
		$data['size'] = '';
		
		$rowData 	= $this->ReportDetail_rev2($key); // get per batch 
		$result 	= $this->CurveExportBody_rev2($rowData); 			
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
				AND a.`regional_name`  LIKE '%". $key['region'] ."%'

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
	
	
	
	
/* End of file Region_db.php */
/*  */
}	