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
	
	if ($article_uid == "") {
		$err_num = 2;
		$errMissingInvalid = ListAppend($errMissingInvalid,"Article ID");
	}
	
	if ($err_num == 2) {
		jsRepostURIAndPostData("Missing or Invalid required field : ".$errMissingInvalid,"edit.php?pgid=".$template_id."&auid=".$article_uid."&seed=".mktime());
		die();
	}
	
	$strSQL = "DELETE FROM tarticle WHERE template_id = '".$riau_db->safeSQL($template_id)."' AND article_uid = ".$riau_db->safeSQL($article_uid);
	$riau_db->query($strSQL);
	
	$message = "Article deleted succesfully!";
	
	jsAlertAndNavigate($message,"index.php?pgid=".$template_id."&edition_id=".$_GET["edition_id"]."&seed=".mktime(),true);
?>