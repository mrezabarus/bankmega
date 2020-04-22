<?
	require_once("../config.inc.php");
	$mega_db->query("DELETE FROM tbl_contact WHERE contact_id = ".uriParam("contact_id"));
	jsAlertAndNavigate("Contact has been deleted","index.php?seed=".mktime(),true);
?>