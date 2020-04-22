<?
$cms_trick["datetime_format"] = "%m/%d/%Y %H:%i:%s";
$cms_trick["date_format"] = "%m/%d/%Y";

function trickInit($tempid = "",$artid = "") {
	global $FJR_VARS, $cms_trick;
	global $_GET;

	$tempid = trim(templateValidateID($tempid));
	$artid = trim(trickValidateID($artid));
	if ($tempid == "") return;
	$qtrick = cmsDB();
	$qtrick->debug_msg = 0;
	
	$strSQL = "SELECT *,DATE_FORMAT(date_created, '".$cms_trick["datetime_format"]."') as cdate,";
	$strSQL .= "DATE_FORMAT(date_modified, '".$cms_trick["date_format"]."') as mdate FROM";
	if ($artid == "")
		$strSQL .= " db_mega.tbl_trick WHERE template_id = '".$qtrick->safeSQL($tempid)."' AND isindex = 1";
	else
		$strSQL .= " db_mega.tbl_trick WHERE template_id = '".$qtrick->safeSQL($tempid)."' AND trick_id = '".$qtrick->safeSQL($artid)."'";
	
	$qtrick->query($strSQL);
	
	if ($qtrick->recordCount() == 1) {
		$qtrick->next();
		$trick_fields = array();
		$trick_fields["date_created"] = $qtrick->row("cdate");
		$trick_fields["date_modified"] = $qtrick->row("mdate");
		$trick_fields["date"] = $qtrick->row("idate");
		$trick_fields["title"] = $qtrick->row("ititle");
		$trick_fields["summary"] = trickDecodePath($qtrick->row("isummary"),"www_img_url,www_embed_url,cms_url");
		$trick_fields["content"] = trickDecodePath($qtrick->row("icontent"),"www_img_url,www_embed_url,cms_url");
		$cms_trick["currtrick"] = $trick_fields;
	}
}

function trickField($field = "") {
	global $cms_trick;
	if (isset($cms_trick["currtrick"][$field]))
		return $cms_trick["currtrick"][$field];
	else
		return "";
}

function trickDateCreated() {
	return trickField("date_created");
}

function trickDateModified() {
	return trickField("date_modified");
}

function trickDate() {
	return trickField("date");
}

function trickTitle() {
	return trickField("title");
}

function trickSummary() {
	return trickField("summary");
}

function trickContent() {
	return trickField("content");
}

function trickValidateID($str) {
	$newStr = strtolower($str);
	if (preg_match("/^[a-z0-9_]+\$/i",$str))
		return $newStr;
	else
		return "";
}

function trickDecodePath($str = "",$list = "") {
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

function trickEncodePath($str = "",$list = "") {
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