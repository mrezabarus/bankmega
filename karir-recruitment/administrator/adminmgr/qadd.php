<? 
	require_once("../config.inc.php");
	$err = 0;
	if(!strlen(trim(postParam("USERNAME"))))
		$err = 1;
		
	$mega_db->query("select username from tadmin where username = '".postParam("USERNAME")."'");
	$mega_db->next();
	if($mega_db->recordCount() > 0 and $err == 0)
		$err = 2;
		
	if($err > 0) {
		include "add.php";
		exit;
	}
	if (postParam("CONFPWD")==postParam("PWD")){
		$pwd_edit = base64_encode(base64_encode(postParam("PWD")));
		$sql = "INSERT INTO tadmin (username,password,email,issuperadmin) VALUES ('";
		$sql .= postParam("USERNAME")."','".$pwd_edit."','".postParam("EMAIL")."',0)";
		$mega_db->query($sql);
	}else{
		echo "<script>alert('Password Invalid!!');history.back();</script>";
		die();	
	}
	
	jsAlertAndNavigate("Admin has added","index.php?seed=".mktime());
?>