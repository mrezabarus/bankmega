<? 
	require_once("../config.inc.php");
	
	$sql = "UPDATE tbl_contact SET ";
	$sql .= "contact_name = '".postParam("username")."' ";
	$sql .= ",dept = '".postParam("deptname")."' ";
	$sql .= ",divisi = '".postParam("divname")."' ";
	$sql .= ",email = '".postParam("email")."' ";
	$sql .= "WHERE contact_id = ".uriParam("contact_id");
	$mega_db->query($sql);
	jsAlertAndNavigate("Contact has updated","index.php?seed=".mktime());
?>