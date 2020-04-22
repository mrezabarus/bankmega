<?
	require_once("../config.inc.php");
	
	$part_id = templateValidateID(trim(postParam("TPID","")));
	$description = trim(postParam("DESC",""));
	$group = trim(postParam("GROUP","")) == ""?(trim(postParam("NEWGROUP","")) == ""?"":trim(postParam("NEWGROUP",""))):trim(postParam("GROUP",""));
	$fcontent = postParam("CONTENT","");
	$language_id = trim(postParam("LANGID",""));
	$custom_charset = trim(postParam("CCHARSET",""));
	$edition_id = trim(postParam("seledition",""));
	
	$err_num = 0;
	$errMissingInvalid = "";
	
	$qCheckID = cmsDB();
	$strSQL = "SELECT tp_id FROM ttemplate_part WHERE tp_id = '".$qCheckID->safeSQL($part_id)."'";
	$qCheckID->query($strSQL);
	
	if ($qCheckID->recordCount() > 0) {
		$err_num = 1;
	}
	
	if ($part_id == "") {
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
	
	$strSQL = "INSERT INTO ttemplate_part (tp_id,tp_description,tp_group,language_id,custom_charset,edition_id) ";
	$strSQL .= "VALUES ('".$mega_db->safeSQL($part_id)."','".$mega_db->safeSQL($description)."','".$mega_db->safeSQL($group)."','".$mega_db->safeSQL($language_id)."','".$mega_db->safeSQL($custom_charset)."',". $edition_id .")";
	$mega_db->query($strSQL);
	
	$fPath = templateFullPath($part_id,true);
	
	if ($fPath != '') {
		$fp = @fopen ($fPath, "wb+");
		$opresult = @fwrite ($fp, $fcontent);
		@fclose ($fp);
	}
	
	$message = "Shared Template Part added succesfully!";
	
	jsAlertAndNavigate($message,"index.php?seed=".mktime(),true);
?>