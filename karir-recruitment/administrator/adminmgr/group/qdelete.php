<? 
	require_once("../../config.inc.php");
	
	$mega_db->query("DELETE FROM ttemp_authorized WHERE group_id = ".uriParam("gid"));
	$mega_db->query("DELETE FROM tarticle_authorized WHERE group_id = ".uriParam("gid"));
	$mega_db->query("DELETE FROM tadmingroup_user WHERE group_id = ".uriParam("gid"));
	$mega_db->query("DELETE FROM tadmingroup_authorized WHERE group_id = ".uriParam("gid"));
	$mega_db->query("DELETE FROM tadmingroup WHERE group_id = ".uriParam("gid"));
	jsAlertAndNavigate("Group is deleted","index.php?seed=".mktime(),true);
?>