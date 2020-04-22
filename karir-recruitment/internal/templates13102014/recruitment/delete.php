<?
	require_once("../../config.php");
	$dirpath = $ANOM_VARS["www_img_path"] . "test_photo/";
	
	 $jstest = cmsDB();
	 $jstest->query("select * from tbl_jobseeker_test where jstest_id=".uriParam("jstest_id"));
	 $jstest->next();
	 $selposition=$jstest->row("vacant_pos_id");
	 
     $position=cmsDB();
	 $strsql = "select tbl_branch_mpp_apply.*,tbl_position.position_name 
				from tbl_position 
				inner join tbl_branch_mpp_apply on tbl_branch_mpp_apply.position_id = tbl_position.position_id 
				inner join tbl_position_vacant on tbl_position_vacant.mpppos_id=tbl_branch_mpp_apply.mpppos_id 
				where tbl_position_vacant.vacantpos_id=" . $selposition;
	$position->query($strsql);
	//echo $strsql;die();
	$position->next();
	$qty_test = $position->row("qty_test")+1;
	$mpppos_id = $position->row("mpppos_id");

	$position->query("update tbl_branch_mpp_apply set qty_test=".$qty_test." where request_status='approved' and mpppos_id=".$mpppos_id."");


	$insert=cmsDB();
	$strsql = "delete from tbl_jobseeker_test where jstest_id=".uriParam("jstest_id");
	$insert->query($strsql);
	$insert->query("update tbl_jobseeker set avail_status='reserved' where js_id=".uriParam("js_id"));
	
	$insert->query("select * from tbl_jobseeker_test_detail where jstest_id=".uriParam("jstest_id"));
	while($insert->next()){
		$file_name = $insert->row("test_file");
		//echo $dirpath.$file_name . "<BR>";
		$delresult = unlink($dirpath.$file_name);
		//$arrresult = $delresult!=false?"Deleted":"Error while deleting file";
		//echo $arrresult;
	}
	$strsql = "delete from tbl_jobseeker_test_detail where jstest_id=".uriParam("jstest_id");
	$insert->query($strsql);
	echo "<script>alert('Recruitment Test Detail Deleted!!');location='index.php?refresh=".md5("mdYHis")."';</script>";
	die();
	
?>