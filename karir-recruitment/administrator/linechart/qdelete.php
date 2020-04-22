<?
	require_once("../config.inc.php");
	
	$strsql = "delete from tbl_chart where chart_id=" . $_GET["chart_id"];
	$mega_db->query($strsql);
	$message = "Chart Deleted succesfully!";
	
	jsAlertAndNavigate($message,"index.php?seed=".mktime(),true);
?>