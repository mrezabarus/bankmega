<?php
class Rekap_db extends CI_Model {
  
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		
		date_default_timezone_set('Asia/Jakarta');		
    }
	
	/* Service Report
		- Call_of_Model
		- xxxx
		- InternetBanking
		- Liability
		- ITSecurity
		- MegaPastiPlus
		- MegaMobile
		- CCBM
		- CreditCard
	*/	
	
	function Call_of_Model()
	{		
		$data = array(
		   1 => 'InternetBanking' ,
		   2 => 'Liability' ,
		   3 => 'xx' ,
		   4 => 'ITSecurity' ,
		   5 => 'MegaPastiPlus' ,
		   6 => 'MegaMobile' ,
		   7 => 'xx' ,
		   8 => 'CCBM' ,
		   9 => 'CreditCard' ,
		);
			
		return $data;
	}
	
	function xx()
	{
		/* step xx	eknowledge_rekap for xxx */
		
		$query = $this->db->query("
			xxxx
		");
			
		return $this->db->affected_rows();
	}
	
	function InternetBanking() /* step 1 */
	{
		/* step 1	eknowledge_rekap for InternetBanking */
		
		$query = $this->db->query("
			REPLACE INTO `eknowledge_rekap` (id_jadwal_awal, id_jadwal, id_kursus, ID_USER, USER_NAME, posisi_detail, org, organisasi_name,regional_name, keterangan, login, pretest, duration, posttest, `Serial`)

			SELECT ax.*
			FROM (/* report Internet Banking */
				SELECT a.id_jadwal_awal
					, a.id_jadwal
					, a.id_kursus
					, a.ID_USER
					, a.USER_NAME
					, a.posisi_detail
					, a.org
					, a.organisasi_name
					, a.regional_name
					, b.keterangan
					, (case when c.`ID_USER` is not null then '1' else null end) as login
					, d.konversi as pretest
					, e.duration
					, f.konversi as posttest
					, g.`Serial`
				FROM `eknowledge_register` a 
				
				/* keterangan untuk register */
				LEFT JOIN eknowledge_register_ket b
					ON a.id_kursus = b.id_kursus
					AND a.ID_USER = b.ID_USER
				
				LEFT JOIN
				   (/* yang sudah login */ 
						SELECT `ID_USER`, `id_kursus`
						FROM `data_visitor`
						GROUP BY `id_kursus`, `ID_USER`
				   ) c
					ON a.id_kursus = c.id_kursus
					AND a.ID_USER = c.ID_USER  
				
				LEFT JOIN
				   (/* yang sudah pretest */ 

						SELECT `id_kursus` , `id_jadwal` , `ID_USER` , `Ulangke` , max( nilai ) AS max_val, ROUND( max( nilai ) * 100 /20, 0 ) AS konversi
						FROM (
								SELECT `id_kursus` , `id_jadwal` , `ID_USER` , `Ulangke` , sum( `value` ) AS nilai
								FROM `data_user_pretest`
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
						GROUP BY `id_kursus`, `ID_USER`
				   ) e
					ON a.id_kursus = e.id_kursus
					AND a.ID_USER = e.ID_USER 
				
				LEFT JOIN
				   (/* yang sudah posttest */ 
				
						SELECT `id_kursus` , `id_jadwal` , `ID_USER` , `Ulangke` , max( nilai ) AS max_val, ROUND( max( nilai ) * 100 /20, 0 ) AS konversi
						FROM (
								SELECT `id_kursus` , `id_jadwal` , `ID_USER` , `Ulangke` , sum( `value` ) AS nilai
								FROM `data_user_posttest`
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
						GROUP BY `id_kursus`, `ID_USER`
				   ) g
					ON a.id_kursus = g.id_kursus
					AND a.ID_USER = g.ID_USER  

				where a.posisi_detail not in ('', 'Teller')
				AND a.`ID_USER` NOT IN ('000000', '08103905', '987654', '13034541', '08062953')
				and a.`id_kursus` = '1'

				GROUP BY a.`id_kursus`, a.`id_jadwal`, a.`ID_USER`
				order by a.regional_name, a.posisi_detail	

			) ax
		");
			
		return $this->db->affected_rows();
	}
	
	function Liability() /* step 2 */
	{
		/* step 2	eknowledge_rekap for Liability */
		
		$query = $this->db->query("
			REPLACE INTO `eknowledge_rekap` (id_jadwal_awal, id_jadwal, id_kursus, ID_USER, USER_NAME, posisi_detail, org, organisasi_name,regional_name, keterangan, login, pretest, duration, posttest, `Serial`)

			SELECT ax.*
			FROM (/* report Liability */
				SELECT a.id_jadwal_awal
					, a.id_jadwal
					, a.id_kursus
					, a.ID_USER
					, a.USER_NAME
					, a.posisi_detail
					, a.org
					, a.organisasi_name
					, a.regional_name
					, b.keterangan
					, (case 
							when c.`ID_USER` is not null then '1'
							when d.konversi is not null then '1'     
							when e.duration is not null then '1' 
							when f.konversi is not null then '1'         
					  else null end) as login
					, d.konversi as pretest
					, e.duration
					, f.konversi as posttest
					, g.`Serial`
				FROM `eknowledge_register` a 
				
				/* keterangan untuk register */
				LEFT JOIN eknowledge_register_ket b
					ON a.id_kursus = b.id_kursus
					AND a.ID_USER = b.ID_USER
				
				LEFT JOIN
				   (/* yang sudah login */ 
						SELECT `ID_USER`, `id_kursus`
						FROM `data_visitor`
						GROUP BY `id_kursus`, `ID_USER`
				   ) c
					ON a.id_kursus = c.id_kursus
					AND a.ID_USER = c.ID_USER  
				
				LEFT JOIN
				   (/* yang sudah pretest */ 

				   SELECT `id_kursus` , `id_jadwal` , `ID_USER` , `Ulangke` , max( nilai ) AS max_val, ROUND( max( nilai ) * 100 /30, 0 ) AS konversi
						FROM (
								SELECT `id_kursus` , `id_jadwal` , `ID_USER` , `Ulangke` , sum( `value` ) AS nilai
								FROM `data_user_pretest`
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
						GROUP BY `id_kursus`, `ID_USER`	
				   ) e
					ON a.id_kursus = e.id_kursus
					AND a.ID_USER = e.ID_USER 
				
				LEFT JOIN
				   (/* yang sudah posttest */ 
						
						SELECT `id_kursus` , `id_jadwal` , `ID_USER` , `Ulangke` , max( nilai ) AS max_val, ROUND( max( nilai ) * 100 /30, 0 ) AS konversi
						FROM (
								SELECT `id_kursus` , `id_jadwal` , `ID_USER` , `Ulangke` , sum( `value` ) AS nilai
								FROM `data_user_posttest`
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
						GROUP BY `id_kursus`, `ID_USER`	
				   ) g
					ON a.id_kursus = g.id_kursus
					AND a.ID_USER = g.ID_USER  

				where a.`ID_USER` NOT IN ('000000', '00000000', '00123456', '13034541', '12068375')
				and a.`id_kursus` = '2'

				GROUP BY a.`id_kursus`, a.`id_jadwal`, a.`ID_USER`
				order by a.regional_name, a.posisi_detail	

			) ax
		");
			
		return $this->db->affected_rows();
	}
	
	function ITSecurity() /* step 4 */
	{
		/* step 4	eknowledge_rekap for ITSecurity */
		
		$query = $this->db->query("
			REPLACE INTO `eknowledge_rekap` (id_jadwal_awal, id_jadwal, id_kursus, ID_USER, USER_NAME, posisi_detail, org, organisasi_name,regional_name, keterangan, login, pretest, duration, posttest, `Serial`)

			SELECT ax.*
			FROM (/* report IT Security */
				SELECT a.id_jadwal_awal
					, a.id_jadwal
					, a.id_kursus
					, a.ID_USER
					, a.USER_NAME
					, a.posisi_detail
					, a.org
					, a.organisasi_name
					, a.regional_name
					, b.keterangan
					, (case when c.`ID_USER` is not null then '1' else null end) as login
					, d.konversi as pretest
					, e.duration
					, f.konversi as posttest
					, g.`Serial`
				FROM `eknowledge_register` a 
				
				/* keterangan untuk register */
				LEFT JOIN eknowledge_register_ket b
					ON a.id_kursus = b.id_kursus
					AND a.ID_USER = b.ID_USER
				
				LEFT JOIN
				   (/* yang sudah login */ 
						SELECT `ID_USER`, `id_kursus`
						FROM `data_visitor`
						GROUP BY `id_kursus`, `ID_USER`
				   ) c
					ON a.id_kursus = c.id_kursus
					AND a.ID_USER = c.ID_USER  
				
				LEFT JOIN
				   (/* yang sudah pretest */ 
						SELECT `id_kursus` , `id_jadwal` , `ID_USER` , `Ulangke` , max( nilai ) AS max_val, ROUND( max( nilai ) * 100 /20, 0 ) AS konversi
						FROM (
								SELECT `id_kursus` , `id_jadwal` , `ID_USER` , `Ulangke` , sum( `value` ) AS nilai
								FROM `data_user_pretest`
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
						GROUP BY `id_kursus`, `ID_USER`
				   ) e
					ON a.id_kursus = e.id_kursus
					AND a.ID_USER = e.ID_USER 
				
				LEFT JOIN
				   (/* yang sudah posttest */ 

						SELECT `id_kursus` , `id_jadwal` , `ID_USER` , `Ulangke` , max( nilai ) AS max_val, ROUND( max( nilai ) * 100 /20, 0 ) AS konversi
						FROM (
								SELECT `id_kursus` , `id_jadwal` , `ID_USER` , `Ulangke` , sum( `value` ) AS nilai
								FROM `data_user_posttest`
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
						GROUP BY `id_kursus`, `ID_USER`
				   ) g
					ON a.id_kursus = g.id_kursus
					AND a.ID_USER = g.ID_USER  

				where a.posisi_detail not in ('', 'Kasir Theme Park')
				and a.`id_kursus` = '4'

				GROUP BY a.`id_kursus`, a.`id_jadwal`, a.`ID_USER`
				order by a.regional_name, a.posisi_detail	

			) ax
		");
			
		return $this->db->affected_rows();
	}
	
	function MegaPastiPlus() /* step 5 */
	{
		/* step 5	eknowledge_rekap for MegaPastiPlus */
		
		$query = $this->db->query("
			REPLACE INTO `eknowledge_rekap` (id_jadwal_awal, id_jadwal, id_kursus, ID_USER, USER_NAME, posisi_detail, org, organisasi_name,regional_name, keterangan, login, pretest, duration, posttest, `Serial`)

			SELECT ax.*
			FROM (/* report Mega Pasti Plus */
					SELECT a.id_jadwal_awal
						, a.id_jadwal
						, a.id_kursus
						, a.ID_USER
						, a.USER_NAME
						, a.posisi_detail
						, a.org
						, a.organisasi_name
						, a.regional_name
						, b.keterangan
						, (case 
								when c.`ID_USER` is not null then '1'
								when d.konversi is not null then '1'     
								when e.duration is not null then '1' 
								when f.konversi is not null then '1'         
						  else null end) as login
						, d.konversi as pretest
						, e.duration
						, f.konversi as posttest
						, g.`Serial`
					FROM `eknowledge_register` a 
					
					/* keterangan untuk register */
					LEFT JOIN eknowledge_register_ket b
						ON a.id_kursus = b.id_kursus
						AND a.ID_USER = b.ID_USER
					
					LEFT JOIN
					   (/* yang sudah login */ 
							SELECT `ID_USER`, `id_kursus`
							FROM `data_visitor`
							GROUP BY `id_kursus`, `ID_USER`
					   ) c
						ON a.id_kursus = c.id_kursus
						AND a.ID_USER = c.ID_USER  
					
					LEFT JOIN
					   (/* yang sudah pretest */ 

							SELECT `id_kursus` , `id_jadwal` , `ID_USER` , `Ulangke` , max( nilai ) AS max_val, ROUND( max( nilai ) * 100 /20, 0 ) AS konversi
							FROM (
									SELECT `id_kursus` , `id_jadwal` , `ID_USER` , `Ulangke` , sum( `value` ) AS nilai
									FROM `data_user_pretest`
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
							GROUP BY `id_kursus`, `ID_USER`
					   ) e
						ON a.id_kursus = e.id_kursus
						AND a.ID_USER = e.ID_USER 
					
					LEFT JOIN
					   (/* yang sudah posttest */ 
					   
							SELECT `id_kursus` , `id_jadwal` , `ID_USER` , `Ulangke` , max( nilai ) AS max_val, ROUND( max( nilai ) * 100 /20, 0 ) AS konversi
							FROM (
									SELECT `id_kursus` , `id_jadwal` , `ID_USER` , `Ulangke` , sum( `value` ) AS nilai
									FROM `data_user_posttest`
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
							GROUP BY `id_kursus`, `ID_USER`
					   ) g
						ON a.id_kursus = g.id_kursus
						AND a.ID_USER = g.ID_USER  

					where a.posisi_detail not in ('', 'Teller')
					AND a.`ID_USER` NOT IN ('000000', '08103905', '987654', '13034541', '08062953')
					and a.`id_kursus` = '5'

					GROUP BY a.`id_kursus`, a.`id_jadwal`, a.`ID_USER`
					order by a.regional_name, a.posisi_detail	

			) ax
		");
			
		return $this->db->affected_rows();
	}
	
	function MegaMobile() /* step 6 */
	{
		/* step 6	eknowledge_rekap for Mega Mobile */
		
		$query = $this->db->query("
			REPLACE INTO `eknowledge_rekap` (id_jadwal_awal, id_jadwal, id_kursus, ID_USER, USER_NAME, posisi_detail, org, organisasi_name,regional_name, keterangan, login, pretest, duration, posttest, `Serial`)

			SELECT ax.*
			FROM (/* report Mega Mobile */
					SELECT a.id_jadwal_awal
						, a.id_jadwal
						, a.id_kursus
						, a.ID_USER
						, a.USER_NAME
						, a.posisi_detail
						, a.org
						, a.organisasi_name
						, a.regional_name
						, b.keterangan
						, (case when c.`ID_USER` is not null then '1' else null end) as login
						, d.konversi as pretest
						, e.duration
						, f.konversi as posttest
						, g.`Serial`
					FROM `eknowledge_register` a 
					
					/* keterangan untuk register */
					LEFT JOIN eknowledge_register_ket b
						ON a.id_kursus = b.id_kursus
						AND a.ID_USER = b.ID_USER
					
					LEFT JOIN
					   (/* yang sudah login */ 
							SELECT `ID_USER`, `id_kursus`
							FROM `data_visitor`
							GROUP BY `id_kursus`, `ID_USER`
					   ) c
						ON a.id_kursus = c.id_kursus
						AND a.ID_USER = c.ID_USER  
					
					LEFT JOIN
					   (/* yang sudah pretest */ 
							SELECT `id_kursus` , `id_jadwal` , `ID_USER` , `Ulangke` , max( nilai ) AS max_val, ROUND( max( nilai ) * 100 /20, 0 ) AS konversi
							FROM (
									SELECT `id_kursus` , `id_jadwal` , `ID_USER` , `Ulangke` , sum( `value` ) AS nilai
									FROM `data_user_pretest`
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
							GROUP BY `id_kursus`, `ID_USER`	
					   ) e
						ON a.id_kursus = e.id_kursus
						AND a.ID_USER = e.ID_USER 
					
					LEFT JOIN
					   (/* yang sudah posttest */ 
				
							SELECT `id_kursus` , `id_jadwal` , `ID_USER` , `Ulangke` , max( nilai ) AS max_val, ROUND( max( nilai ) * 100 /20, 0 ) AS konversi
							FROM (
									SELECT `id_kursus` , `id_jadwal` , `ID_USER` , `Ulangke` , sum( `value` ) AS nilai
									FROM `data_user_posttest`
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
							GROUP BY `id_kursus`, `ID_USER`	
					   ) g
						ON a.id_kursus = g.id_kursus
						AND a.ID_USER = g.ID_USER  

					where a.`id_kursus` = '6'
					and a.posisi_detail !=''

					GROUP BY a.`id_kursus`, a.`id_jadwal`, a.`ID_USER`
					order by a.regional_name, a.posisi_detail	

			) ax
		");
			
		return $this->db->affected_rows();
	}
	
	function CCBM() /* step 8 */
	{
		/* step 8	eknowledge_rekap for CCBM */
		
		$query = $this->db->query("
			REPLACE INTO `eknowledge_rekap` (id_jadwal_awal, id_jadwal, id_kursus, ID_USER, USER_NAME, posisi_detail, org, organisasi_name,regional_name, keterangan, login, pretest, duration, posttest, `Serial`)

			SELECT ax.*
			FROM (/* report CCBM Plus with name */
					SELECT a.id_jadwal_awal
						, a.id_jadwal
						, a.id_kursus
						, a.ID_USER
						, a.USER_NAME
						, a.posisi_detail
						, a.org
						, a.organisasi_name
						, a.regional_name
						, b.keterangan
						, (case when c.`ID_USER` is not null then '1' else null end) as login
						, d.max_val as pretest
						, e.duration
						, f.jmlh as posttest
						, g.`Serial`
					FROM `eknowledge_register` a 
					
					/* keterangan untuk register */
					LEFT JOIN eknowledge_register_ket b
						ON a.id_kursus = b.id_kursus
						AND a.ID_USER = b.ID_USER
					
					LEFT JOIN
					   (/* yang sudah login */ 
							SELECT `ID_USER`, `id_kursus`
							FROM `data_visitor`
							GROUP BY `id_kursus`, `ID_USER`
					   ) c
						ON a.id_kursus = c.id_kursus
						AND a.ID_USER = c.ID_USER  
					
					LEFT JOIN
					   (/* yang sudah pretest */ 
							SELECT max_pre.ID_USER, max_pre.id_kursus, max( nilai )*10 as max_val
							FROM (
									SELECT `id_kursus`, `id_jadwal`, `ID_USER`,`Ulangke`, sum( `value` ) as nilai
									FROM `data_user_pretest`
									GROUP BY `id_kursus`, `id_jadwal`, `ID_USER`,`Ulangke`
									ORDER BY `id_kursus`, `id_jadwal`, `ID_USER`,`Ulangke` ASC
							) max_pre      
							GROUP BY `id_kursus`, `ID_USER`
					   ) d
						ON a.id_kursus = d.id_kursus
						AND a.ID_USER = d.ID_USER  
					
					LEFT JOIN
					   (/* yang sudah materi */ 
							SELECT  id_jadwal, id_kursus, ID_USER, USER_NAME, SEC_TO_TIME( SUM( TIME_TO_SEC( duration ) ) ) as duration
							FROM durasi_halaman
							GROUP BY id_kursus, id_user
					   ) e
						ON a.id_kursus = e.id_kursus
						AND a.ID_USER = e.ID_USER 
					
					LEFT JOIN
					   (/* yang sudah posttest */ 
							select *, if(nilai_simulasi is null,max_val,max_val + nilai_simulasi) AS jmlh
							from(
								SELECT max_post.ID_USER, max_post.id_kursus, max(nilai)*10 as max_val
								FROM (
										SELECT `id_kursus`, `id_jadwal`, `ID_USER`,`Ulangke`, sum( `value` ) as nilai
										FROM `data_user_posttest`
										GROUP BY `id_kursus`, `id_jadwal`, `ID_USER`,`Ulangke`
										ORDER BY `id_kursus`, `id_jadwal`, `ID_USER`,`Ulangke` ASC
								) max_post      
								GROUP BY `id_kursus`, `ID_USER`
							) as pg
							LEFT JOIN
							(
								SELECT nip, sum(value) * 30 as nilai_simulasi
								FROM ccbm.`simulasi_post`
								GROUP BY `nip`
							) as sim
							on pg.ID_USER = sim.nip
					   ) f
						ON a.id_kursus = f.id_kursus
						AND a.ID_USER = f.ID_USER  
					
					LEFT JOIN
					   (/* yang sudah Serial */ 
							SELECT `id_kursus`, `ID_USER`, `USER_NAME` , `Serial`
							FROM `data_user_certify`
							GROUP BY `id_kursus`, `ID_USER`
					   ) g
						ON a.id_kursus = g.id_kursus
						AND a.ID_USER = g.ID_USER  

					where a.posisi_detail not in ('', 'Customer Care Specialist', 'Customer Care Head')
					and a.org not in ('Q8J', 'q6b')
					and a.`id_kursus` = '8'
					and a.`ID_USER` != '12112224'

					GROUP BY a.`id_kursus`, a.`id_jadwal`, a.`ID_USER`
					order by a.regional_name, a.posisi_detail	

			) ax
		");
			
		return $this->db->affected_rows();
	}
	
	function CreditCard() /* step 9 */
	{
		/* step 9	eknowledge_rekap for Credit Card */
		
		$query = $this->db->query("
			REPLACE INTO `eknowledge_rekap` (id_jadwal_awal, id_jadwal, id_kursus, ID_USER, USER_NAME, posisi_detail, org, organisasi_name,regional_name, keterangan, login, pretest, duration, posttest, `Serial`)

			SELECT ax.*
			FROM (/* report Credit Card */
				SELECT a.id_jadwal_awal
					, a.id_jadwal
					, a.id_kursus
					, a.ID_USER
					, a.USER_NAME
					, a.posisi_detail
					, a.org
					, a.organisasi_name
					, a.regional_name
					, b.keterangan
					, (case when c.`ID_USER` is not null then '1' else null end) as login
					, d.konversi as pretest
					, e.duration
					, f.konversi as posttest
					, g.`Serial`
				FROM `eknowledge_register` a 
				
				/* keterangan untuk register */
				LEFT JOIN eknowledge_register_ket b
					ON a.id_kursus = b.id_kursus
					AND a.ID_USER = b.ID_USER
				
				LEFT JOIN
				   (/* yang sudah login */ 
						SELECT `ID_USER`, `id_kursus`
						FROM `data_visitor`
						GROUP BY `id_kursus`, `ID_USER`
				   ) c
					ON a.id_kursus = c.id_kursus
					AND a.ID_USER = c.ID_USER  
				
				LEFT JOIN
				   (/* yang sudah pretest */ 
						SELECT `id_kursus` , `id_jadwal` , `ID_USER` , `Ulangke` , max( nilai ) AS max_val, ROUND( max( nilai ) * 100 /20, 0 ) AS konversi
						FROM (
								SELECT `id_kursus` , `id_jadwal` , `ID_USER` , `Ulangke` , sum( `value` ) AS nilai
								FROM `data_user_pretest`
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
						GROUP BY `id_kursus`, `ID_USER`
				   ) e
					ON a.id_kursus = e.id_kursus
					AND a.ID_USER = e.ID_USER 
				
				LEFT JOIN
				   (/* yang sudah posttest */ 

						SELECT `id_kursus` , `id_jadwal` , `ID_USER` , `Ulangke` , max( nilai ) AS max_val, ROUND( max( nilai ) * 100 /20, 0 ) AS konversi
						FROM (
								SELECT `id_kursus` , `id_jadwal` , `ID_USER` , `Ulangke` , sum( `value` ) AS nilai
								FROM `data_user_posttest`
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
						GROUP BY `id_kursus`, `ID_USER`
				   ) g
					ON a.id_kursus = g.id_kursus
					AND a.ID_USER = g.ID_USER  

				where a.id_user not in ('12057590','13066072','06077309','00091364')
				and a.`id_kursus` = '9'
				and a.posisi_detail !=''

				GROUP BY a.`id_kursus`, a.`id_jadwal`, a.`ID_USER`
				order by a.regional_name, a.posisi_detail	

			) ax
		");
			
		return $this->db->affected_rows();
	}	
	


	/* Service Report for moodle
		- UpdateMoodle
	*/	
	function UpdateMoodle()
	{
		/* step EL	eknowledge_rekap for Moodle */
		
		$query = $this->db->query("
			REPLACE INTO eknow_test.`eknowledge_rekap_4_moodle` (id_jadwal_awal, id_jadwal, id_kursus, ID_USER, USER_NAME, posisi_detail, org, organisasi_name,regional_name, keterangan, login, pretest, duration, posttest, `Serial`)


			select r.id_jadwal
				, r.id_jadwal
				, r.id_kursus
				, r.ID_USER
				, r.USER_NAME
				, r.posisi_detail
				, r.org
				, r.organisasi_name
				, r.regional_name
				, r.keterangan
				, (case when d.userid is not null then '1' else null end) as login
				, d.nilai as pretest
				, e.durasi
				, f.nilai as posttest
				, g.`Serial`

			from (       
				/* Register */
				SELECT *
				FROM moodle_db.j_register
				GROUP BY  id_kursus, id_user
				
			) r

			left join moodle_db.mdl_user c 
			on c.username = r.id_user

			left join moodle_db.mdl_course c2 
			on c2.id = r.id_kursus

			left join (
				/* prestest */
				SELECT d.*, e.title
				   , max( CAST(d.`value` AS UNSIGNED)) as nilai
				FROM  moodle_db.mdl_scorm_scoes_track d
				LEFT JOIN moodle_db.mdl_scorm_scoes e
				ON d.scoid = e. id
				
				WHERE d.element = 'cmi.core.score.raw'
				AND e.title = 'Pre-Assessment'
				
				GROUP BY d.userid, d.scormid
				ORDER BY d.userid, d.scormid asc
			) d
			on d.userid = c.id
			and d.scormid = c2.idnumber

			left join (
				/* durasi materi */
				SELECT d.*, e.title
				   , SEC_TO_TIME( sum( TIME_TO_SEC(d.`value`) ) ) as durasi
				FROM  moodle_db.mdl_scorm_scoes_track d
				LEFT JOIN moodle_db.mdl_scorm_scoes e
				ON d.scoid = e. id
				
				WHERE d.element = 'cmi.core.total_time'
				AND e.title not in ( 'Pre-Assessment', 'Post-Assessment' ) 
				
				GROUP BY d.userid, d.scormid
				ORDER BY d.userid, d.scormid asc
			) e
			on e.userid = c.id
			and e.scormid = c2.idnumber

			left join (
				/* posttest */
				SELECT d.*, e.title
				   , max( CAST(d.`value` AS UNSIGNED)) as nilai
				FROM  moodle_db.mdl_scorm_scoes_track d
				LEFT JOIN moodle_db.mdl_scorm_scoes e
				ON d.scoid = e. id
				
				WHERE d.element = 'cmi.core.score.raw'
				AND e.title = 'Post-Assessment'
				
				GROUP BY d.userid, d.scormid
				ORDER BY d.userid, d.scormid asc
			) f
			on f.userid = c.id
			and f.scormid = c2.idnumber

			left join (       
				/* Sertifikat */
				SELECT *
				FROM moodle_db.j_certify
				GROUP BY  id_kursus, id_user
				
			) g
			on g.id_user = r.id_user
			and g.id_kursus = r.id_kursus
		");
			
		return $this->db->affected_rows();
	}	
	
}	