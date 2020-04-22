<?
	require_once("../config.inc.php");
	
	$template_id = templateValidateID(trim(strtolower(postParam("PGID",""))));
	$article_uid = trim(postParam("AUID",""));
	$article_id = articleValidateID(trim(postParam("AID","")));
	$idate = trim(postParam("IDATE",""));
	$ititle = trim(postParam("ITITLE",""));
	$edition_id = trim(postParam("seledition",""));
	$ikeyword = trim(postParam("IKEYWORD",""));
	$isummary = str_replace('\"', '',trim(articleEncodePath(postParam("ISUMMARY",""),"www_img_url,www_embed_url,cms_url")));
	$icontent = str_replace('\"', '',trim(articleEncodePath(postParam("ICONTENT",""),"www_img_url,www_embed_url,cms_url")));
	
	//$isummary = trim(articleEncodePath(postParam("ISUMMARY",""),"www_img_url,www_embed_url,cms_url"));
	//$icontent = trim(articleEncodePath(postParam("ICONTENT",""),"www_img_url,www_embed_url,cms_url"));
	
	$err_num = 0;
	$errMissingInvalid = "";
	
	$qCheckID = cmsDB();
	$strSQL = "SELECT article_id FROM tarticle WHERE article_id = '".$qCheckID->safeSQL($article_id)."' AND template_id = '".$qCheckID->safeSQL($template_id)."' AND article_uid <> '".$qCheckID->safeSQL($article_uid)."'";
	$qCheckID->query($strSQL);
	
	if ($qCheckID->recordCount() > 0) {
		$err_num = 1;
	}
	
	if (articleValidateID($article_id) == "") {
		$err_num = 2;
		$errMissingInvalid = ListAppend($errMissingInvalid,"Article ID");
	}
	
	if ($idate != "")
		if (!isDateTime($idate) && !isDate($idate))  {
			$err_num = 2;
			$errMissingInvalid = ListAppend($errMissingInvalid,"Article Date");
		}
	
	if (!is_numeric($article_uid))  {
		$err_num = 2;
		$errMissingInvalid = ListAppend($errMissingInvalid,"Article ID");
	}
	
	if ($err_num == 1) {
		jsRepostURIAndPostData("Article ID already exists!","edit.php?pgid=".$template_id."&auid=".$article_uid);
		die();
	} else if ($err_num == 2) {
		jsRepostURIAndPostData("Missing or Invalid required field : ".$errMissingInvalid,"edit.php?pgid=".$template_id."&auid=".$article_uid);
		die();
	}
	
	$qdate = "0000-00-00 00:00:00";
	if (isDate($idate)) {
		$idate_part = parseDate($idate);
		$qdate = @date("Y-m-d H:i:s",mktime(0,0,0,$idate_part[0],$idate_part[1],$idate_part[2]));
	} else if (isDateTime($idate)) {
		$idate_part = parseDateTime($idate);
		$qdate = @date("Y-m-d H:i:s",mktime($idate_part[3],$idate_part[4],$idate_part[5],$idate_part[0],$idate_part[1],$idate_part[2]));
	}
	$date_modified = @date("Y-m-d H:i:s");
	
	$strSQL = "UPDATE tarticle SET ";
	$strSQL .= "article_id = '".$riau_db->safeSQL($article_id)."',";
	$strSQL .= "idate = '".$riau_db->safeSQL($qdate)."',";
	$strSQL .= "ikeyword = '".$riau_db->safeSQL($ikeyword)."',";
	$strSQL .= "ititle = '".$riau_db->safeSQL($ititle)."',";
	$strSQL .= "isummary = '".$riau_db->safeSQL($isummary)."',";
	$strSQL .= "icontent = '".$riau_db->safeSQL($icontent)."',";
	$strSQL .= "edition_id = '".$riau_db->safeSQL($edition_id)."',";
	$strSQL .= "date_modified = '".$riau_db->safeSQL($date_modified)."' ";
	$strSQL .= "WHERE article_uid = ".$article_uid;
	$riau_db->query($strSQL);
	
	$message = "Article updated succesfully!";
	
	jsAlertAndNavigate($message,"index.php?pgid=".$template_id."&edition_id=".$_GET["edition_id"]."&seed=".mktime(),true);
?>