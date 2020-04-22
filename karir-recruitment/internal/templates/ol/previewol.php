<?php
require_once("../../config.php");
require_once("../../rtf/Rtf.php");
if(isset($_GET["ol_id"])){
	$ol = cmsDB();
	$ol_id_var = uriParam("ol_id");
	if(!intval($ol_id_var)){
		echo "Invalid Input";die()
	}
	$ol->query("select * from tbl_offering_letter where ol_id=".$ol_id_var);
	$ol->next();
	header("Location: ../../library/_files/offering_letter/".$ol->row("ol_file")); 	
	die();
}else{
			
			$selip_var=uriParam("selip");
			if(!intval($selip_var)){
				echo "Invalid Input";die()
			}
			$templateol_id=uriParam("templateol_id");
			$ol_no_var=uriParam("ol_no");
			
			$ip=cmsDB();
			$ip->query("select * from tbl_ijin_prinsip where ip_id=".$selip_var);
			$ip->next();
			$golongan = $ip->row("golongan");
			$comp_gp = number_format($ip->row("comp_gp"), 0, ',', '.').",-";
			$comp_tjabatan=number_format($ip->row("comp_tjabatan"), 0, ',', '.').",-";
			$comp_makan=number_format($ip->row("comp_makan"), 0, ',', '.').",-";
			$comp_transport=number_format($ip->row("comp_transport"), 0, ',', '.').",-";
			$start_date=datesql2date($ip->row("start_date"));
			$penempatan = $ip->row("rencana_penempatan");
			$end_probation = datesql2date($ip->row("ip_duration_end"));
			$pjs1 = $ip->row("pjs1");
			$pjs2 = $ip->row("pjs2");
			
			
			$jstest=cmsDB();
			$jstest->query("select tbl_jobseeker.*,tbl_jobseeker_test.vacant_pos_id from tbl_jobseeker_test inner join tbl_jobseeker on tbl_jobseeker_test.js_id=tbl_jobseeker.js_id where tbl_jobseeker_test.jstest_id=".$ip->row("jstest_id"));
			$jstest->next();
			
			$vacant_pos_id = $jstest->row("vacant_pos_id");
			$full_name = $jstest->row("full_name");
			$js_address = $jstest->row("address1");
			$pob = $jstest->row("place_of_birth");
			$dob = datesql2date($jstest->row("date_of_birth"));
			$jobseeker_id = $jstest->row("id_no");
			
			
			$position = cmsDB();
			$strsql = "select tbl_branch_mpp_apply.branch_id,tbl_position.position_name 
						from tbl_position 
						inner join tbl_branch_mpp_apply on tbl_branch_mpp_apply.position_id = tbl_position.position_id 
						inner join tbl_position_vacant on tbl_position_vacant.mpppos_id=tbl_branch_mpp_apply.mpppos_id 
						where tbl_position_vacant.vacantpos_id=" . $vacant_pos_id;
						
			$position->query($strsql);
			$position->next();
			$position_name = $position->row("position_name");
			
			
			$oltemp = cmsDB();
			$oltemp->query("select * from tbl_offering_letter_template where templateol_id=".$templateol_id);
			$oltemp->next();
			$file_name = $oltemp->row("template_file");
			//echo $file_name;
			$content = fopen ("../../library/_files/offering_letter_template/".$file_name, "r");
			$fcontent = fread($content, filesize("../../library/_files/offering_letter_template/".$file_name));
			$content = str_replace("[ol_date]", date("d-M-Y"),$fcontent);
			$content = str_replace("[ol_no]", $ol_no_var,$content);
			$content = str_replace("[jobseeker_name]", $full_name,$content);
			$content = str_replace("[jobseeker_address]", $js_address,$content);
			$content = str_replace("[position]", $position_name,$content);
			$content = str_replace("[pjs1]", $pjs1,$content);
			$content = str_replace("[pjs2]", $pjs2,$content);
			$content = str_replace("[golongan]", $golongan,$content);
			$content = str_replace("[grade]", $golongan,$content);
			$content = str_replace("[region_branch]", $penempatan,$content);
			$content = str_replace("[gaji_pokok]", $comp_gp,$content);
			$content = str_replace("[tunjangan_jabatan]", $comp_tjabatan,$content);
			$content = str_replace("[tunjangan_makan]", $comp_makan,$content);
			$content = str_replace("[tunjangan_transport]", $comp_transport,$content);
			$content = str_replace("[tanggal_start]", $start_date,$content);
			$content = str_replace("[end_probation]", $end_probation,$content);
			$content = str_replace("[pob]", $pob,$content);
			$content = str_replace("[dob]", $dob,$content);
			$content = str_replace("[jobseeker_id]", $jobseeker_id,$content);
			
			echo $content;
			die();
}
?>
