<?
	require_once("../config.inc.php");
	
	$part_id = trim(uriParam("tpid",""));
	
	$err_num = 0;
	$errMissingInvalid = "";
	
	if (templateValidateID($part_id) == "") {
		$err_num = 2;
		$errMissingInvalid = ListAppend($errMissingInvalid,"Part ID");
	}
	
	if ($err_num == 2) {
		jsRepostURIAndPostData("Missing or Invalid required field : ".$errMissingInvalid,"edit.php?tpid=".$part_id."&seed=".mktime());
		die();
	}
	
	$strSQL = "DELETE FROM ttemplate_part WHERE tp_id = '".$mega_db->safeSQL($part_id)."'";
	$mega_db->query($strSQL);
	$mega_db->free();
	
	$fPath = templateFullPath($part_id,true);
	
	if ($fPath != '') {
		@unlink($fPath);
	}
	
	$message = "Template Part deleted succesfully!";
	
	jsAlertAndNavigate($message,"index.php?seed=".mktime(),true);
?>