<?
	require_once("../config.inc.php");
	$grade=cmsDB2();
	$grade->query("DELETE FROM tbl_golongan WHERE gol_id = ".uriParam("gol_id"));
	jsAlertAndNavigate("Grade has been deleted","index.php?seed=".mktime(),true);
?>