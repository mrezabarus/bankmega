<? 
	require_once("../config.inc.php");
	$jurusan=cmsDB2();
	$sql = "INSERT INTO tbl_jurusan (code,jurusan) 
	        VALUES ('".postParam("code")."','".postParam("jurusan")."')";
	$jurusan->query($sql);

	jsAlertAndNavigate("Jurusan has been added","index.php?seed=".mktime());
?>