<?
$cms_article["datetime_format"] = "%m/%d/%Y %H:%i:%s";
$cms_article["date_format"] = "%m/%d/%Y";

function articleInit($tempid = "",$artid = "") {
	global $FJR_VARS, $cms_article;
	global $_GET;

	$tempid = trim(templateValidateID($tempid));
	$artid = trim(articleValidateID($artid));
	if ($tempid == "") return;
	$qarticle = cmsDB();
	$qarticle->debug_msg = 0;
	
	$strSQL = "SELECT *,DATE_FORMAT(date_created, '".$cms_article["datetime_format"]."') as cdate,";
	$strSQL .= "DATE_FORMAT(date_modified, '".$cms_article["date_format"]."') as mdate FROM";
	if ($artid == "")
		$strSQL .= " db_mega.tarticle WHERE edition_id=". $edition_id ."  and template_id = '".$qarticle->safeSQL($tempid)."' AND isindex = 1";
	else
		$strSQL .= " db_mega.tarticle WHERE edition_id=". $edition_id ." and  template_id = '".$qarticle->safeSQL($tempid)."' AND article_id = '".$qarticle->safeSQL($artid)."'";
	
	$qarticle->query($strSQL);
	
	if ($qarticle->recordCount() == 1) {
		$qarticle->next();
		$article_fields = array();
		$article_fields["date_created"] = $qarticle->row("cdate");
		$article_fields["date_modified"] = $qarticle->row("mdate");
		$article_fields["date"] = $qarticle->row("idate");
		$article_fields["title"] = $qarticle->row("ititle");
		$article_fields["summary"] = articleDecodePath($qarticle->row("isummary"),"www_img_url,www_embed_url,cms_url");
		$article_fields["content"] = articleDecodePath($qarticle->row("icontent"),"www_img_url,www_embed_url,cms_url");
		$cms_article["currarticle"] = $article_fields;
	}
}

function articleField($field = "") {
	global $cms_article;
	if (isset($cms_article["currarticle"][$field]))
		return $cms_article["currarticle"][$field];
	else
		return "";
}

function articleDateCreated() {
	return articleField("date_created");
}

function articleDateModified() {
	return articleField("date_modified");
}

function articleDate() {
	return articleField("date");
}

function articleTitle() {
	return articleField("title");
}

function articleSummary() {
	return articleField("summary");
}

function articleContent() {
	return articleField("content");
}

function articleValidateID($str) {
	$newStr = strtolower($str);
	if (preg_match("/^[a-z0-9_]+\$/i",$str))
		return $newStr;
	else
		return "";
}

function articleDecodePath($str = "",$list = "") {
	global $FJR_VARS;
	$list = split(",",$list);
	for ($i=0;$i<count($list);$i++) {
		for (;;) {
			$pos = strpos($str,"[%".$list[$i]."%]");
			if (!is_integer($pos)) break;
			$str = substr_replace($str,$FJR_VARS[$list[$i]],$pos,strlen(trim("[%".$list[$i]."%]")));
		}
	}
	return ($str);
}

function articleEncodePath($str = "",$list = "") {
	global $FJR_VARS;
	$list = split(",",$list);
	for ($i=0;$i<count($list);$i++) {
		for (;;) {
			$pos = strpos($str,$FJR_VARS[$list[$i]]);
			if (!is_integer($pos)) break;
			$str = substr_replace($str,"[%".$list[$i]."%]",$pos,strlen(trim($FJR_VARS[$list[$i]])));
		}
	}
	return ($str);
}
?>