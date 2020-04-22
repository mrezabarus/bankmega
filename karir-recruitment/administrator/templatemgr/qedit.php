<?
	require_once("../config.inc.php");
	
	$template_id = trim(postParam("PGID",""));
	$template_type = trim(postParam("TYPE",""));
	$display_name = trim(postParam("DNAME",""));
	$description = trim(postParam("DESC",""));
	$template_group = trim(postParam("GROUP","")) == ""?(trim(postParam("NEWGROUP","")) == ""?"":trim(postParam("NEWGROUP",""))):trim(postParam("GROUP",""));
	$language_id = trim(postParam("LANGID",""));
	$edition_id = trim(postParam("seledition",""));
	$custom_charset = trim(postParam("CCHARSET",""));
	$fcontent = postParam("CONTENT","");
	
	$error = 0;
	$errMissingInvalid = "";
	
	if ($display_name == "") {
		$error = 2;
		$errMissingInvalid = ListAppend($errMissingInvalid,"Display Name");
	}
	
	if ($error == 2) {
		jsAlertAndNavigate("Missing or Invalid required field : ".$errMissingInvalid,"edit.php?pgid=".$template_id,true);
		die();
	}
	
	$strSQL = "UPDATE ttemplate SET ";
	$strSQL .= "display_name = '".$mega_db->safeSQL($display_name)."',";
	$strSQL .= "template_type = ".$template_type.",";
	$strSQL .= "description = '".$mega_db->safeSQL($description)."',";
	$strSQL .= "template_group = '".$mega_db->safeSQL($template_group)."',";
	$strSQL .= "language_id = '".$mega_db->safeSQL($language_id)."',";
	$strSQL .= "custom_charset = '".$mega_db->safeSQL($custom_charset)."', ";
	$strSQL .= "edition_id = '".$mega_db->safeSQL($edition_id)."' ";
	$strSQL .= "WHERE template_id = '".$mega_db->safeSQL($template_id)."'";
	$mega_db->query($strSQL);
	
	$fPath = templateFullPath($template_id);
	
	if ($fPath != '') {
		$fp = @fopen ($fPath, "wb+");
		$opresult = @fwrite ($fp, $fcontent);
		@fclose ($fp);
	}
	
	$message = "Template updated succesfully!";
	
	jsAlertAndNavigate($message,"edit.php?pgid=".$template_id,true);
?>