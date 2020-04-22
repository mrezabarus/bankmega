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
		jsRepostURIAndPostData("Missing or Invalid required field : ".$errMissingInvalid,"edit.php?pgid=".$template_id."&seed=".mktime());
		die();
	}
	
	$strSQL = "DELETE FROM ttemplate WHERE template_id = '".$mega_db->safeSQL($template_id)."'";
	$mega_db->query($strSQL);
	$mega_db->free();
	$strSQL = "DELETE FROM tarticle WHERE template_id = '".$mega_db->safeSQL($template_id)."'";
	$mega_db->query($strSQL);
	
	$fPath = templateFullPath($template_id);
	
	if ($fPath != '') {
		@unlink($fPath);
	}
	
	$message = "Template deleted succesfully!";
	
	jsAlertAndNavigate($message,"index.php?seed=".mktime(),true);
?>