<?
	require_once("../config.inc.php");
	
	$template_id = templateValidateID(trim(uriParam("pgid","")));
	$article_uid = trim(uriParam("auid",""));
	
	$err_num = 0;
	$errMissingInvalid = "";
	
	if ($template_id == "") {
		$err_num = 2;
		$errMissingInvalid = ListAppend($errMissingInvalid,"Template ID");
	}
	
	if (!is_numeric($article_uid)) {
		$err_num = 2;
		$errMissingInvalid = ListAppend($errMissingInvalid,"Article ID");
	}
	
	if ($err_num == 2) {
		jsRepostURIAndPostData("Missing or Invalid required field : ".$errMissingInvalid,"index.php?pgid=".$template_id."&seed=".mktime());
		die();
	}
	
	$strSQL = "UPDATE tarticle SET isindex = 0 WHERE edition_id=".$_GET["edition_id"]." and template_id = '".$riau_db->safeSQL($template_id)."'";
	$riau_db->query($strSQL);
	$riau_db->free();
	$strSQL = "UPDATE tarticle SET isindex = 1 WHERE edition_id=".$_GET["edition_id"]." and article_uid = '".$riau_db->safeSQL($article_uid)."'";
	$riau_db->query($strSQL);
	
	jsNavigate("index.php?pgid=".$template_id."&edition_id=".$_GET["edition_id"]."&seed=".mktime(),true);
?>