<?
	require_once("../config.inc.php");
	$position=cmsDB2();
	$position->query("DELETE FROM tbl_position WHERE position_id = ".uriParam("position_id"));
	jsAlertAndNavigate("Position has been deleted","index.php?seed=".mktime(),true);
?>