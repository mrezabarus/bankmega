<?
	require_once("../config.inc.php");
	
	$part_id = trim(postParam("TPID",""));
	$description = trim(postParam("DESC",""));
	$group = trim(postParam("GROUP","")) == ""?(trim(postParam("NEWGROUP","")) == ""?"":trim(postParam("NEWGROUP",""))):trim(postParam("GROUP",""));
	$fcontent = postParam("CONTENT","");
	$language_id = trim(postParam("LANGID",""));
	$custom_charset = trim(postParam("CCHARSET",""));
	
	$err_num = 0;
	$errMissingInvalid = "";
	
	if (templateValidateID($part_id) == "") {
		$err_num = 2;
		$errMissingInvalid = ListAppend($errMissingInvalid,"Part ID");
	}
	
	if ($err_num == 1) {
		jsRepostURIAndPostData("Part ID already exists!","add.php");
		die();
	} else if ($err_num == 2) {
		jsRepostURIAndPostData("Missing or Invalid required field : ".$errMissingInvalid,"add.php");
		die();
	}
	
	$strSQL = "UPDATE ttemplate_part SET ";
	$strSQL .= "tp_description = '".$mega_db->safeSQL($description)."',";
	$strSQL .= "tp_group = '".$mega_db->safeSQL($group)."',";
	$strSQL .= "language_id = '".$mega_db->safeSQL($language_id)."',";
	$strSQL .= "custom_charset = '".$mega_db->safeSQL($custom_charset)."' ";
	$strSQL .= "WHERE tp_id = '".$mega_db->safeSQL($part_id)."'";
	$mega_db->query($strSQL);
	
	$fPath = templateFullPath($part_id,true);
	
	if ($fPath != '') {
		$fp = @fopen ($fPath, "wb+");
		$opresult = @fwrite ($fp, $fcontent);
		@fclose ($fp);
	}
	
	$message = "Shared Template Part updated succesfully!";
	
	jsAlertAndNavigate($message,"edit.php?tpid=".$part_id."&seed=".mktime(),true);
?>