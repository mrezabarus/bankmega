<?
	require_once("../config.inc.php");
	
	if(getAdminCookie() == uriParam("aid")){
		jsAlertAndNavigate("You cannot delete yourself","edit.php?aid=".uriParam("aid")."&seed=".mktime(),true);
		exit;
	}
	
	$mega_db->query("SELECT user_id FROM tbl_hrm_user");
	if($mega_db->recordCount() == 2){
		jsAlertAndNavigate("Please add 1 new admin before you delete this one","edit.php?aid=".uriParam("aid")."&seed=".mktime(),true);
		exit;
	}
	
	$mega_db->query("DELETE FROM tbl_group_hrmuser WHERE user_id = ".uriParam("aid"));
	$mega_db->query("DELETE FROM tbl_hrm_user WHERE user_id = ".uriParam("aid"));
	jsAlertAndNavigate("User has deleted","index.php?seed=".mktime(),true);
?>