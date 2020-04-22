<?
	require_once("../config.inc.php");
	
	$template_id = templateValidateID(trim(postParam("PGID","")));
	$template_type = trim(postParam("TYPE",0));
	$display_name = trim(postParam("DNAME",""));
	$description = trim(postParam("DESC",""));
	$template_group = trim(postParam("GROUP","")) == ""?(trim(postParam("NEWGROUP","")) == ""?"":trim(postParam("NEWGROUP",""))):trim(postParam("GROUP",""));
	$language_id = trim(postParam("LANGID",""));
	//$edition_id = trim(postParam("seledition",""));
	$custom_charset = trim(postParam("CCHARSET",""));
	$fcontent = postParam("CONTENT","");
	
	$err_num = 0;
	$errMissingInvalid = "";
	
	$qCheckID = cmsDB();
	$strSQL = "SELECT template_id FROM ttemplate WHERE template_id = '".$qCheckID->safeSQL($template_id)."'";
	$qCheckID->query($strSQL);
	
	if ($qCheckID->recordCount() > 0) {
		$err_num = 1;
	}
	
	if (templateValidateID($template_id) == "") {
		$err_num = 2;
		$errMissingInvalid = ListAppend($errMissingInvalid,"Template ID");
	}
	
	if ($display_name == "") {
		$err_num = 2;
		$errMissingInvalid = ListAppend($errMissingInvalid,"Display Name");
	}
	
	if ($err_num == 1) {
		jsRepostURIAndPostData("Template ID already exists!","add.php");
		die();
	} else if ($err_num == 2) {
		jsRepostURIAndPostData("Missing or Invalid required field : ".$errMissingInvalid,"add.php");
		die();
	}
	
	$strSQL = "INSERT INTO ttemplate (template_id,display_name,description,template_group,language_id,custom_charset,template_type,isindex) ";
	$strSQL .= "VALUES ('".$mega_db->safeSQL($template_id)."','".$mega_db->safeSQL($display_name)."','".$mega_db->safeSQL($description)."','".$mega_db->safeSQL($template_group)."',";
	$strSQL .= "'0','".$mega_db->safeSQL($custom_charset)."',".$mega_db->safeSQL($template_type).",'0')";
	//echo $strSQL;
	//die();
	$mega_db->query($strSQL);
	
	$fPath = templateFullPath($template_id);
	
	if ($fPath != '') {
		$fp = @fopen ($fPath, "wb+");
		$opresult = @fwrite ($fp, $fcontent);
		@fclose ($fp);
	}
	
	$message = "Template added succesfully!";
	
	jsAlertAndNavigate($message,"index.php?seed=".mktime(),true);
?>