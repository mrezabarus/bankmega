<? 
	require_once("../config.inc.php");
	
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
	//$pwd_edit = base64_encode(base64_encode(postParam("PWD")));
	$pwd_input = postParam("PWD");
	    function createSalt()
	    {
			$text = md5(uniqid(rand(), true));
			return substr($text, 0, 3);
	    }
	     
	    $salt = createSalt();
	    $pwd_edit = hash('sha256', $salt . $pwd_input);	
	$sql = "UPDATE tadmin SET ";
	if (postParam("chgPass")) $sql .= "password = '".$pwd_edit."',";
	$sql .= "salt= '".$salt."',";
	$sql .= "email = '".postParam("EMAIL")."' ";
	$sql .= "WHERE admin_id = ".uriParam("aid");
	$mega_db->query($sql);
	jsAlertAndNavigate("User profile has updated","index.php?seed=".mktime());
?>