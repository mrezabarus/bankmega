<? 
	require_once("../config.inc.php");
	
	$sql = "INSERT INTO tbl_contact (contact_name,dept,divisi,email) VALUES ('";
	$sql .= postParam("username")."','".postParam("deptname")."','".postParam("divname")."','".postParam("email")."')";
	$mega_db->query($sql);
	
	jsAlertAndNavigate("Contact has been added","index.php?seed=".mktime());
?>