<? 
	require_once("../config.inc.php");
	$mega_db = cmsDB2();
	
	$err = 0;
	if(postParam("chgPass") and !strlen(trim(postParam("PWD"))))
		$err = 2;
	else if(postParam("chgPass") and !strlen(trim(postParam("CONFPWD"))))
		$err = 3;
	else if(postParam("chgPass") and postParam("PWD") != postParam("CONFPWD"))
		$err = 4;
		
	if($err > 0) {
		include "edit.php";
		exit;
	}
	
	$sql = "UPDATE tbl_hrm_user SET ";
	if (postParam("chgPass")) 
	$sql .= "pwd = '".postParam("PWD")."',";
	$sql .= "email = '".postParam("EMAIL")."' ";
	$sql .= "WHERE user_id = ".uriParam("aid");
	$mega_db->query($sql);
	jsAlertAndNavigate("User profile has updated","index.php?seed=".mktime());
?>
