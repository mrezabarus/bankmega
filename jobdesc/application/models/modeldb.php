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
        // $query = $this->db->query("                                    
        //                             SELECT * 
        //                             from job a
        //                             left join posisi b
        //                             on a.id_job = b.job_id
        //                             where a.id_job != ''
        //                             and a.position_title_id != ''
        //                             group by b.position_title_id
        //                         "); 
        $query = $this->db->query("                                    
                                    SELECT * 
                                    from job a
                                    left join posisi b
                                    on a.position_code = b.position_id
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

    function compareposjob(){
        $query = $this->db->query("SELECT
                                        x.totalJob,
                                        y.totalPositionTitle
                                    FROM
                                        (
                                            SELECT
                                                COUNT(id_job) AS totalJob
                                            FROM
                                                (
                                                    SELECT
                                                        id_job
                                                    FROM
                                                        job a
                                                    LEFT JOIN posisi b ON a.id_job = b.job_id
                                                    WHERE
                                                        a.id_job != ''
                                                    GROUP BY
                                                        b.position_title_id
                                                ) AS A
                                        ) AS x,
                                        (
                                            SELECT
                                                COUNT(id) AS totalPositionTitle
                                            FROM
                                                (
                                                    SELECT
                                                        id
                                                    FROM
                                                        position_title a
                                                    WHERE
                                                        a.active = 'YES'
                                                ) AS B
                                        ) AS y");
        return $query->row_array();
    }

    function compareposjobfilter($id_group){
        $query = $this->db->query("SELECT
                                    x.totalJob,
                                    y.totalPositionTitle
                                    FROM
                                    (
                                            SELECT
                                        COUNT(id_job) AS totalJob
                                        FROM
                                            (
                                                    SELECT
                                                            id_job
                                                    FROM
                                                            job a
                                                    LEFT JOIN posisi b ON a.id_job = b.job_id
                                                    WHERE
                                                            1
                                                            and b.position_title_id in (
                                                                SELECT id_pos_title
                                                                from position_title a
                                                                left join tbl_access b
                                                                on a.id = b.posisi
                                                                where b.id_group = '$id_group'
                                                            )
                                                    GROUP BY
                                                            b.position_title_id
                                            ) AS A
                                    
                                    ) AS x,
                                    (
                                            SELECT
                                        COUNT(id) AS totalPositionTitle
                                    FROM
                                    (
                                        SELECT
                                                a.id
                                        FROM
                                        position_title a
                                        LEFT join tbl_access b
                                        on a.id = b.posisi
                                        WHERE
                                        a.active = 'YES'
                                        and b.id_group = '$id_group'
                                    ) AS B
                                    
                                    ) AS y");
        return $query->row_array();
    }

    function compareposfile(){
        $query = $this->db->query("
                                SELECT x.totalJob, y.totalFile FROM 
                                    (
                                        SELECT 
                                        COUNT(id_job) as totalJob
                                        from (
                                        SELECT
                                        id_job
                                        FROM
                                        job a
                                        LEFT JOIN posisi b ON a.id_job = b.job_id
                                        WHERE
                                        a.id_job != ''
                                        GROUP BY
                                        b.position_title_id
                                        )A
                                    ) as x, 
                                    (
                                        SELECT COUNT(id_file) as totalFile
                                        FROM(
                                        SELECT * 
                                        from tbl_file
                                        where status = 'Y'
                                        and job_code_new is not null
                                        group by job_code_new
                                        )B
                                    ) as y
                                ");
        return $query->row_array();
    }

    function compareposfilefilter($id_group){
        $query = $this->db->query("
                                    SELECT x.totalJob, y.totalFile FROM 
                                    (
                                            SELECT 
                                            COUNT(id_job) as totalJob
                                        from (
                                            SELECT
                                                id_job
                                            FROM
                                            job a
                                            LEFT JOIN posisi b ON a.id_job = b.job_id
                                            WHERE
                                            a.id_job != ''
                                            
                                            and b.position_title_id in (
                                                    SELECT id_pos_title
                                                    from position_title a
                                                    left join tbl_access b
                                                    on a.id = b.posisi
                                                    where b.id_group = '$id_group'
                                            )
                                            GROUP BY
                                            b.position_title_id
                                    )A
                                    ) as x, 
                                    (		
                                    SELECT COUNT(totalFile) as totalFile
                                        FROM 
                                        (
                                            SELECT 
                                            COUNT(id_file) as totalFile
                                                FROM(
                                                SELECT * 
                                                from tbl_file
                                                where status = 'Y'
                                                and job_code_new is not null
                                                group by job_code_new
                                            )AA
                                            RIGHT JOIN posisi b ON AA.job_code_new = b.job_id
                                            where 1
                                            and b.position_title_id in (
                                                            SELECT id_pos_title
                                                            from position_title a
                                                            left join tbl_access b
                                                            on a.id = b.posisi
                                                            where b.id_group = '$id_group'
                                                    )
                                            group by AA.job_code_new
                                        )B
                                    ) as y
                                ");
        return $query->row_array();
    }

    /* DIREKTORAT, ORGANIZATION , POSITION TITLE FORM */
    function get_direktorat(){
        $query = $this->db->query("
                                    SELECT * from direktorat 
                                    where flag_active = 'YES'
                                    and dir_group_code NOT IN ('A','N')
                                    ");
        return $query;
    }

    function get_organisasi($id){
        $query = $this->db->query("SELECT * 
                                    from organization_group a
                                    left join organization b
                                    on a.org_group_id = b.org_group_id
                                    where a.flag_active = 'YES'
                                    and b.direktorat = '$id'
                                    group by a.org_group_code");
        return $query->result();
    }

    function get_pos_title($idorggrp){
        $query = $this->db->query("SELECT * 
                                    from position_title a
                                    left join posisi b
                                    on a.id_pos_title = b.position_title_id
                                    where 1
                                    and b.org_group = '$idorggrp'
                                    group by a.id_pos_title");
        return $query->result();
    }

    /* END SEARCH */

    function getjobfamily(){
        $query = $this->db->query("
                                    SELECT * 
                                    FROM job_family
                                    where flagactive = 'Y'
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

    function listposisi($id_report_to){
        // $query = $this->db->query("
        //                             SELECT position_id
        //                             , position_name 
        //                             , job_id
        //                             from posisi
        //                             where active = 'YES'
        //                             and report_to in (
        //                             SELECT position_id
        //                             from posisi
        //                             where 1
        //                             and active = 'YES'
        //                             and report_to = '$id_report_to'
        //                             )
        //                             UNION 
        //                             SELECT position_id
        //                             , position_name 
        //                             , job_id
        //                             from posisi
        //                             where 1
        //                             and active = 'YES'
        //                             and report_to = '$id_report_to'
        //                             order by position_name ASC
        //                         ");        
        $query = $this->db->query("SELECT
                                        position_id,
                                        position_name,
                                        job_id
                                    FROM
                                        posisi
                                    WHERE
                                        report_to = '$id_report_to'
                                    UNION
                                        SELECT
                                            position_id,
                                            position_name,
                                            job_id
                                        FROM
                                            posisi
                                        WHERE
                                            report_to IN (
                                                SELECT
                                                    position_id
                                                FROM
                                                    posisi
                                                WHERE
                                                    report_to = '$id_report_to'
                                            )
                                        UNION
                                            SELECT
                                                position_id,
                                                position_name,
                                                job_id
                                            FROM
                                                posisi
                                            WHERE
                                                report_to IN (
                                                    SELECT
                                                        position_id
                                                    FROM
                                                        posisi
                                                    WHERE
                                                        report_to IN (
                                                            SELECT
                                                                position_id
                                                            FROM
                                                                posisi
                                                            WHERE
                                                                report_to = '$id_report_to'
                                                        )
                                                )
                                            UNION
                                                SELECT
                                                    position_id,
                                                    position_name,
                                                    job_id
                                                FROM
                                                    posisi
                                                WHERE
                                                    report_to IN (
                                                        SELECT
                                                            position_id
                                                        FROM
                                                            posisi
                                                        WHERE
                                                            report_to IN (
                                                                SELECT
                                                                    position_id
                                                                FROM
                                                                    posisi
                                                                WHERE
                                                                    report_to IN (
                                                                        SELECT
                                                                            position_id
                                                                        FROM
                                                                            posisi
                                                                        WHERE
                                                                            report_to = '$id_report_to'
                                                                    )
                                                            )
                                                    )
                                                UNION
                                                    SELECT
                                                        position_id,
                                                        position_name,
                                                        job_id
                                                    FROM
                                                        posisi
                                                    WHERE
                                                        report_to IN (
                                                            SELECT
                                                                position_id
                                                            FROM
                                                                posisi
                                                            WHERE
                                                                report_to IN (
                                                                    SELECT
                                                                        position_id
                                                                    FROM
                                                                        posisi
                                                                    WHERE
                                                                        report_to IN (
                                                                            SELECT
                                                                                position_id
                                                                            FROM
                                                                                posisi
                                                                            WHERE
                                                                                report_to IN (
                                                                                    SELECT
                                                                                        position_id
                                                                                    FROM
                                                                                        posisi
                                                                                    WHERE
                                                                                        report_to = '$id_report_to'
                                                                                )
                                                                        )
                                                                )
                                                        )
                                                    GROUP BY
                                                        position_id");
        return $query->result();
    }

    function listjob($id_report_to){
        
        $query = $this->db->query("SELECT * 
                                    FROM (
                                        SELECT
                                            a.id_job,
                                            a.job_title,
                                            b.position_id,
	                                        b.position_name
                                        FROM
                                            job a
                                        LEFT JOIN posisi b ON a.position_code = b.position_id
                                        WHERE
                                            b.report_to IN (
                                                SELECT
                                                    position_id
                                                FROM
                                                    posisi
                                                WHERE
                                                    1
                                                AND active = 'YES'
                                                AND report_to = '$id_report_to'
                                            )
                                            UNION
                                            SELECT
                                                a.id_job,
                                                a.job_title,
                                                b.position_id,
	                                            b.position_name
                                            FROM
                                                job a
                                            LEFT JOIN posisi b ON a.position_code = b.position_id
                                            WHERE
                                                b.report_to IN (
                                                    SELECT
                                                        position_id
                                                    FROM
                                                        posisi
                                                    WHERE
                                                        1
                                                    AND active = 'YES'
                                                    AND report_to IN (
                                                        SELECT
                                                            position_id
                                                        FROM
                                                            posisi
                                                        WHERE
                                                            1
                                                        AND active = 'YES'
                                                        AND report_to = '$id_report_to'
                                                    )
                                                )
                                            UNION
                                                SELECT
                                                    a.id_job,
                                                    a.job_title,
                                                    b.position_id,
	                                                b.position_name
                                                FROM
                                                    job a
                                                LEFT JOIN posisi b ON a.position_code = b.position_id
                                                WHERE
                                                    b.report_to IN (
                                                        SELECT
                                                            position_id
                                                        FROM
                                                            posisi
                                                        WHERE
                                                            1
                                                        AND active = 'YES'
                                                        AND report_to IN (
                                                            SELECT
                                                                position_id
                                                            FROM
                                                                posisi
                                                            WHERE
                                                                1
                                                            AND active = 'YES'
                                                            AND report_to IN (
                                                                SELECT
                                                                    position_id
                                                                FROM
                                                                    posisi
                                                                WHERE
                                                                    1
                                                                AND active = 'YES'
                                                                AND report_to = '$id_report_to'
                                                            )
                                                        )
                                                    )
                                                UNION
                                                    SELECT
                                                        a.id_job,
                                                        a.job_title,
                                                        b.position_id,
	                                                    b.position_name
                                                    FROM
                                                        job a
                                                    LEFT JOIN posisi b ON a.position_code = b.position_id
                                                    WHERE
                                                        b.report_to = '$id_report_to'
                                        )A
                                        ORDER BY A.job_title");
        
        
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

    //fungsi menghitung totaljobdesc untuk menambahkan ke dalam kode jobdesc
    function countjob(){
        $query = $this->db->query("SELECT COUNT(*) as total from job");   
        return $query->row_array();
    }

    

    //fungsi untuk menyimpan list job
    function savejob($direktorat,$organization,$postitle,$jobname,$totaljob){
        $now 	= date("Y-m-d H:i:s");
        $left   = substr($postitle, 0, 3);
        $mid    = substr($postitle, 3, 3);
        $right  = substr($postitle, 6, 6);

        $con_pos = $left.".".$mid.".".$totaljob;
        $data = array(
				'id_job'=>$con_pos,
                'job_title'=>$jobname,
                'position_code'=>$postitle,
                'created_date'=>$now
            );  
        $result= $this->db->insert('job',$data);
        return $result;
    }

    //fungsi untuk menampilkan detail job
    function detailjob($id_job){
        $query = $this->db->query("
                                    SELECT 
                                    a.id_job
                                    , a.job_title
                                    , b.position_title 
                                    from job a
                                    left join position_title b
                                    on a.position_title_id = b.id_pos_title 
                                    where a.id_job = '$id_job'");        
        return $query->row();
    }

    

    function userdetail($id_user){
        $query = $this->db->query("
                                SELECT 
                                a.username
                                , b.group_name 
                                , c.nama
                                , c.jobtitlea
                                from tbl_user a
                                left join tbl_group b
                                on a.id_group = b.id_group
                                left join z_employee_list_2 c
                                on a.username = c.nip
                                where a.username = '$id_user'
                                ");        
        return $query->row();
    }

    /* SAVE JOB DESC */
    function savetugas($tgs_tgg_jwb,$jobid, $now, $id_user){
        $data = array(
				'tugas_tgg_jwb'=>$tgs_tgg_jwb,
                'job_id'=>$jobid,
                'date_created'=>$now,
                'created_by'=>$id_user
            );  
        $result= $this->db->insert('job_tugas_tgg_jwb',$data);
        return $result;
    }

    function savekewenangan($tgs_tgg_jwb,$jobid, $now, $id_user){
        $data = array(
				'kewenangan'=>$tgs_tgg_jwb,
                'job_id'=>$jobid,
                'date_created'=>$now,
                'created_by'=>$id_user
            );  
        $result= $this->db->insert('job_kewenangan',$data);
        return $result;
    }

    function saveedu($tgs_tgg_jwb,$jurusan,$jobid, $now, $id_user){
        $data = array(
                'min_education'=>$tgs_tgg_jwb,
                'education'=>$jurusan,
                'job_id'=>$jobid,
                'date_created'=>$now,
                'created_by'=>$id_user
            );  
        $result= $this->db->insert('job_edukasi',$data);
        return $result;
    }

    function saveexp($tgs_tgg_jwb,$jobid, $now, $id_user){
        $data = array(
				'min_pengalaman'=>$tgs_tgg_jwb,
                'job_id'=>$jobid,
                'date_created'=>$now,
                'created_by'=>$id_user
            );  
        $result= $this->db->insert('job_pengalaman',$data);
        return $result;
    }

    function saveexperince($tgs_tgg_jwb,$jobid, $now, $id_user){
        $data = array(
				'pengalaman'=>$tgs_tgg_jwb,
                'job_id'=>$jobid,
                'date_created'=>$now,
                'created_by'=>$id_user
            );  
        $result= $this->db->insert('job_pengalaman_kerja',$data);
        return $result;
    }

    function savekompetensi($tgs_tgg_jwb,$jobid, $now, $id_user){
        $data = array(
				'sikap'=>$tgs_tgg_jwb,
                'job_id'=>$jobid,
                'date_created'=>$now,
                'created_by'=>$id_user
            );  
        $result= $this->db->insert('job_kompetensi_sikap',$data);
        return $result;
    }

    //fungsi untuk menyimpan list job
    function savejobdata($id_job,$id_user,$now,$admin,$now){
        
        $data = array(
				'job_id'=>$id_job,
                'send_to'=>$id_user,
                'date_send'=>$now,
                'send_by'=>$admin,
                'created_date'=>$now,
                'created_by'=>$id_user,
                'flagdel'=>'0'
            );  
        $result= $this->db->insert('job_data',$data);
        return $result;
    }
    
    //check status jobdata
    function checkjobdata($id_group){
        $query = $this->db->query("
                                    SELECT COUNT(*) as total
                                    from job_data
                                    where job_id = '$id_group'
                                ");
        return $query->row_array();
    }


    // get data report //
    function profiljabatan($id_job){
        $query = $this->db->query("SELECT 
                                    b.position_id
                                    , b.position_name
                                    , c.position_name as posisi_supervisor
                                    , d.org_group_detail as unit_kerja
                                    , e.dir_group_name
                                    from job a
                                    left join posisi b
                                    on a.position_code = b.position_id
                                    left join posisi c
                                    on b.report_to = c.position_id
                                    left join organization_group d
                                    on b.org_group = d.org_group_id
                                    left join direktorat e
                                    on b.dir = e.id_dir
                                    where a.id_job = '$id_job'
                                    group by b.position_id");
        return $query->row();
    }

    function gettggjwb($id_job){
        $query = $this->db->query("SELECT *
                                    from job_tugas_tgg_jwb
                                    where job_id = '$id_job'");
        return $query->result();
    }

    function getkewenangan($id_job){
        $query = $this->db->query("SELECT *
                                    from job_kewenangan
                                    where job_id = '$id_job'");
        return $query->result();
    }

    function getpendidikan($id_job){
        $query = $this->db->query("SELECT *
                                    from job_edukasi
                                    where job_id = '$id_job'");
        return $query->row();
    }

    function getpengalaman($id_job){
        $query = $this->db->query("SELECT *
                                    from job_pengalaman
                                    where job_id = '$id_job'");
        return $query->row();
    }

    function getjobpeng($id_job){
        $query = $this->db->query("SELECT *
                                    from job_pengalaman_kerja
                                    where job_id = '$id_job'");
        return $query->result();
    }
    
    function getkompetensi($id_job){
        $query = $this->db->query("SELECT *
                                    from job_kompetensi_sikap
                                    where job_id = '$id_job'");
        return $query->result();
    }
    // end get data report //

}
?>