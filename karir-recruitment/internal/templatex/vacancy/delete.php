<?
	require_once("../../config.php");
	$vacant=cmsDB();
	$vacant->query("select * from tbl_branch_mpp_apply where mpppos_id=".$_GET["mpppos_id"]);
	$vacant->next();
	$old_qty=$vacant->row("qty");
	$vacant->query("update tbl_region_mpp set hacc_val_apply=hacc_val_apply-".$old_qty." where hacc_id=". $_GET["hacc_id"]);
	
	$strsql = "delete from tbl_branch_mpp_apply where mpppos_id=".$_GET["mpppos_id"];
	$vacant->query($strsql);
	$strsql = "delete from tbl_position_vacant where mpppos_id=".$_GET["mpppos_id"];
	$vacant->query($strsql);
	header("Location: index.php"); 	
	die();
?>