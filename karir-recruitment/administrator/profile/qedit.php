<? 
	require_once("../config.inc.php");
	
	if ((postParam("PWD") != postParam("CONFPWD"))) {
		jsAlert("Password is not match with Re-Type Password !");
?>
		<script>history.back();</script>
<?
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
	
	$sql = "UPDATE tadmin_new SET ";
	if (strlen(trim(postParam("PWD")))) $sql .= "password = '".$pwd_edit."',";
	$sql .= "salt= '".$salt."',";	
	$sql .= "email = '".postParam("EMAIL")."' ";
	$sql .= "WHERE admin_id = ".$_SESSION[$FJR_VARS["admin_cookie"]];
	$mega_db->query($sql);
	jsAlertAndNavigate("Your profile has updated","index.php?seed=".mktime(),true);
?>