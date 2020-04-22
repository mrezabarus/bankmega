<?
	require_once("../config.inc.php");
	
	$template_id = trim(uriParam("pgid",""));
	
	$err_num = 0;
	$errMissingInvalid = "";
	
	if (templateValidateID($template_id) == "") {
		$err_num = 2;
		$errMissingInvalid = ListAppend($errMissingInvalid,"Template ID");
	}
	
	if ($err_num == 2) {
		jsRepostURIAndPostData("Missing or Invalid required field : ".$errMissingInvalid,"index.php?seed=".mktime());
		die();
	}
	
	$strSQL = "UPDATE ttemplate SET isindex = 0";
	$mega_db->query($strSQL);
	$mega_db->free();
	$strSQL = "UPDATE ttemplate SET isindex = 1 WHERE template_id = '".$mega_db->safeSQL($template_id)."'";
	$mega_db->query($strSQL);
	
	jsNavigate("index.php?seed=".mktime(),true);
?>