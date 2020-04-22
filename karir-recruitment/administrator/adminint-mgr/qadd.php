<? 
	require_once("../config.inc.php");
	$err = 0;
	if(!strlen(trim(postParam("USERNAME"))))
		$err = 1;
		
	$mega_db->query("select user_name from tbl_hrm_user where user_name = '".postParam("USERNAME")."'");
	$mega_db->next();
	if($mega_db->recordCount() > 0 and $err == 0)
		$err = 2;
		
	if($err > 0) {
		include "add.php";
		exit;
	}
	if (postParam("CONFPWD")==postParam("PWD")){
		$sql = "INSERT INTO tbl_hrm_user (user_name,full_name,pwd,email,phone_no,position,rgb_id,group_id) VALUES ('";
		$sql .= postParam("USERNAME")."','".postParam("full_name")."','".postParam("PWD")."','".postParam("EMAIL")."','".postParam("phone")."','".postParam("position")."',0,0)";
		//echo $sql;die();
		$mega_db->query($sql);

	}else{
		echo "<script>alert('Password tidak sama/Invalid!!');history.back();</script>";
		die();	
	}
	
	jsAlertAndNavigate("Admin has added","index.php?seed=".mktime());
?>