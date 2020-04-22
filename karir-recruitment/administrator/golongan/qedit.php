<? 
	require_once("../config.inc.php");
	$grade=cmsDB2();
	$sql = "UPDATE tbl_golongan SET ";
	$sql .= "name = '".postParam("name")."' ";
	$sql .= ",description = '".postParam("description")."' ";
	$sql .= "WHERE gol_id = ".uriParam("gol_id");
	$grade->query($sql);
	jsAlertAndNavigate("Grade has updated","index.php?seed=".mktime());
?>