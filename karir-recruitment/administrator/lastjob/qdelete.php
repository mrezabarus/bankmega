<?
	require_once("../config.inc.php");
	$lastjob=cmsDB2();
	$lastjob->query("DELETE FROM tbl_lastjob WHERE lst_id = ".uriParam("lst_id"));
	jsAlertAndNavigate("Pengalaman has been deleted","index.php?seed=".mktime(),true);
?>