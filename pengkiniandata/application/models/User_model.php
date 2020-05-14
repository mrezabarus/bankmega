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
	function pendidikanList($iduser)
	{
		$hasil=$this->db->query("
								
								SELECT 
								a.id
								, a.employeeid
								, CASE 
										WHEN e.nama is NULL then a.jenjang_pendidikan
										ELSE e.nama
								END as jenjang_pendidikan
								, CASE 
									WHEN b.nama_pt is null then a.nama_institusi
									ELSE b.nama_pt
								END as nama_pt
								, CASE
									WHEN c.nama_program_studi is NULL then a.studi
									ELSE c.nama_program_studi
								END as nama_program_studi

								, d.inisial_gelar as gelar2
								, d.strata
								, d.singkatan
								from tbl_emp_pendidikan a
								left join master_perguruan_tinggi b
								on a.nama_institusi = b.code_pt
								left join master_jurusan c
								on a.studi = c.id
								left join master_gelar d
								on a.gelar = d.id
								left join master_jenjang_pendidikan e
								on a.jenjang_pendidikan = e.code_jenjang
								where a.employeeid = '$iduser'");
        return $hasil->result();
	}

	function get_pendidikan_by_code($id)
	{
		$hsl=$this->db->query("SELECT * FROM tbl_emp_pendidikan WHERE id='$id'");
        if($hsl->num_rows()>0){
            foreach ($hsl->result() as $data) {
                $hasil=array(
					'id' => $data->id,
                    'jenjang_pendidikan' => $data->jenjang_pendidikan,
					'nama_institusi' => $data->nama_institusi,
					'studi' => $data->studi,
					'gelar' => $data->gelar,
                    );
            }
        }
        return $hasil;
	}

	function jenjang_pendidikan()
	{
		$hasil=$this->db->query("SELECT * FROM master_jenjang_pendidikan order by nama ASC");
        return $hasil->result();
	}

	function nama_institusi()
	{
		$hasil=$this->db->query("SELECT * FROM master_perguruan_tinggi order by nama_pt ASC");
        return $hasil->result();
	}

	function gelar()
	{
		$hasil=$this->db->query("SELECT * FROM master_gelar order by inisial_gelar ASC");
        return $hasil->result();
	}

	function savependidikan($tglmasuk,$tgllulus,$inpjen,$inpins,$inpstd,$inpglr,$iduser){
        $data = array(
				'tgl_masuk'=>$tglmasuk,
				'tgl_lulus'=>$tgllulus,
                'jenjang_pendidikan' => $inpjen,
				'nama_institusi' => $inpins,
				'nama_institusi_2' => $inpins,
				'studi'=>$inpstd,
				'gelar'=>$inpglr,
				'employeeid'=>$iduser
            );  
        $result= $this->db->insert('tbl_emp_pendidikan',$data);
        return $result;
    }

	function jurusan()
	{
		$hasil=$this->db->query("SELECT * FROM master_jurusan order by nama_program_studi ASC");
        return $hasil->result();
	}

	function update_pendidikan($id,$ntglmasuk,$ntgllulus,$inpjen,$inpins,$inpstd,$inpglr,$datauser){
		
		$hasil=$this->db->query("UPDATE tbl_emp_pendidikan 
									SET tgl_masuk='$ntglmasuk'
									,tgl_lulus='$ntgllulus'
									, jenjang_pendidikan='$inpjen'
									, nama_institusi='$inpins'
									, studi='$inpstd'

									,gelar='$inpglr' 
									WHERE id='$id'");
		// echo "UPDATE tbl_unit SET unit_name='$namaunit_upd',id_property='$property_upd', detail='$detail_upd' WHERE id_unit='$id_unit'";
        return $hasil;
	}



	//data riwayat pekerjaan
	// function riwKerList($iduser)
	// {
	// 	$hasil=$this->db->query("
														
	// 							SELECT * 
	// 							from tbl_emp_historywork
	// 							where nip = '$iduser'
	// 							order by tgl_mulai asc
	// 						");
    //     return $hasil->result();
	// }

	function riwKerList($iduser)
	{
		$hasil=$this->db->query("
								SELECT 
								a.nip
								, a.id
								, a.nama_perusahaan
								, b.bidang_usaha
								, a.bidang_usaha
								, a.tgl_mulai
								, a.tgl_selesai
								, CASE
									WHEN a.nama_posisi is null THEN ''
									ELSE a.nama_posisi
								END as nama_posisi
								, a.level_jabatan
								, c.level_jabatan
								, c.level_jabatan_ojk
								, a.bidang_tugas
								, d.bidang_tugas as bidangtugas_d
								from tbl_emp_historywork a
								left join master_bidang_usaha b
								on a.jenis_bidang_usaha = b.sandi
								left join master_level_jabatan c
								on a.level_jabatan = c.id
								left join master_bidang_tugas d 
								on a.bidang_tugas = d.id
								where a.nip = '$iduser'
								order by a.tgl_mulai asc
							");
        return $hasil->result();
	}

	function get_riwker_by_code($id)
	{
		$hsl=$this->db->query("
							SELECT 
								a.nip
								, a.id
								, a.nama_perusahaan
								, b.sandi
								, b.bidang_usaha
								, a.tgl_mulai
								, a.tgl_selesai
								, CASE
									WHEN a.nama_posisi is null THEN ''
									ELSE a.nama_posisi
								END as nama_posisi
								, a.level_jabatan
								, c.level_jabatan
								, c.level_jabatan_ojk
								, a.bidang_tugas
								, d.bidang_tugas as bidangtugas_d
								from tbl_emp_historywork a
								left join master_bidang_usaha b
								on a.jenis_bidang_usaha = b.sandi
								left join master_level_jabatan c
								on a.level_jabatan = c.id
								left join master_bidang_tugas d 
								on a.bidang_tugas = d.id
								where a.id = '$id'
								group by a.id
								order by a.tgl_mulai asc");
        if($hsl->num_rows()>0){
            foreach ($hsl->result() as $data) {
                $hasil=array(
					'id' => $data->id,
					'nama_perusahaan' => $data->nama_perusahaan,
					'nama_posisi' => $data->nama_posisi,
					'tgl_mulai'=>$data->tgl_mulai,
					'tgl_selesai'=>$data->tgl_selesai,
					'sandi'=>$data->sandi
					
                    );
            }
        }
        return $hasil;
	}

	function bidang_usaha()
	{
		$hasil=$this->db->query("SELECT * FROM master_bidang_usaha order by bidang_usaha ASC");
        return $hasil->result();
	}

	function level_jabatan()
	{
		$hasil=$this->db->query("SELECT * FROM master_level_jabatan order by level_jabatan_ojk ASC");
        return $hasil->result();
	}

	function bidang_tugas()
	{
		$hasil=$this->db->query("SELECT * FROM master_bidang_tugas order by bidang_tugas ASC");
        return $hasil->result();
	}

	function saveHistoryJob($ntglmasuk,$ntglresign,$namaperusahaan,$inpbidangusaha,$inplvl_jbtn,$inpbdgtgs,$datauser,$posisi){
        $data = array(
				'nip'=>$datauser,
				'nama_perusahaan'=>$namaperusahaan,
				'jenis_bidang_usaha'=>$inpbidangusaha,
				'tgl_mulai'=>$ntglmasuk,
				'tgl_selesai'=>$ntglresign,
                'level_jabatan' => $inplvl_jbtn,
				'bidang_tugas' => $inpbdgtgs,
				'nama_posisi'=>$posisi
            );  
        $result= $this->db->insert('tbl_emp_historywork',$data);
        return $result;
	}
	
	function update_riwker($id,$ntglmasuk,$ntglresign,$namaperusahaan,$inpbidangusaha,$inplvl_jbtn,$inpbdgtgs,$datauser,$posisi){
		
		$hasil=$this->db->query("UPDATE tbl_emp_historywork 
									SET 
									nama_perusahaan='$namaperusahaan'
									,jenis_bidang_usaha= '$inpbidangusaha'
									,tgl_mulai='$ntglmasuk'
									,tgl_selesai='$ntglresign'
									,level_jabatan = '$inplvl_jbtn'
									,bidang_tugas = '$inpbdgtgs'
									,nama_posisi='$posisi'
									WHERE id='$id'");
		// echo "UPDATE tbl_unit SET unit_name='$namaunit_upd',id_property='$property_upd', detail='$detail_upd' WHERE id_unit='$id_unit'";
        return $hasil;
	}
}