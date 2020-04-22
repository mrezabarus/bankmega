<?
	require_once("../../config.php");
	$comp_name=cmsDB();
	$strsql = "delete from tbl_region_mpp where hacc_id=".$_GET["hacc_id"];
	$comp_name->query($strsql);
	header("Location: index.php"); 	
	die();
?>