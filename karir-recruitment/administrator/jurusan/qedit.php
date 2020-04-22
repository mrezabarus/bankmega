<? 
	require_once("../config.inc.php");
	$jurusan=cmsDB2();
	$sql = "UPDATE tbl_jurusan SET ";
	$sql .= "code = '".postParam("code")."' ";
	$sql .= ",jurusan = '".postParam("jurusan")."' ";
	$sql .= "WHERE jur_id = ".uriParam("jur_id");
	$jurusan->query($sql);
	jsAlertAndNavigate("Jurusan has updated","index.php?seed=".mktime());
?>