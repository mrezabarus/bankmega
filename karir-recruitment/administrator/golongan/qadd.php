<? 
	require_once("../config.inc.php");
	$grade=cmsDB2();
	$sql = "INSERT INTO tbl_golongan (name,description) 
	        VALUES ('".postParam("name")."','".postParam("description")."')";
	$grade->query($sql);
	
	jsAlertAndNavigate("Grade has been added","index.php?seed=".mktime());
?>