<?
	require_once("../config.inc.php");
	$jurusan=cmsDB2();
	$jurusan->query("DELETE FROM tbl_jurusan WHERE jur_id = ".uriParam("jur_id"));
	jsAlertAndNavigate("Jurusan has been deleted","index.php?seed=".mktime(),true);
?>