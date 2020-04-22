<? 
	require_once("../../config.inc.php");
	
	
	$strSQL2 = "DELETE FROM tbl_group_hrmuser WHERE group_id = '".uriParam("gid")."'";
	$mega_db->query($strSQL2);

	$strSQL3 = "DELETE FROM tbl_group_authorization WHERE group_id = '".uriParam("gid")."'";
	$mega_db->query($strSQL3);

	$strSQL4 = "DELETE FROM tbl_group WHERE group_id = '".uriParam("gid")."'";
	$mega_db->query($strSQL4);

	jsAlertAndNavigate("Group is deleted","index.php?seed=".mktime(),true);
?>