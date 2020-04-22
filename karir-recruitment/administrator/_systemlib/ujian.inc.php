<?
$cms_ujian["datetime_format"] = "%m/%d/%Y %H:%i:%s";
$cms_ujian["date_format"] = "%m/%d/%Y";

function ujianInit($tempid = "",$artid = "") {
	global $FJR_VARS, $cms_ujian;
	global $_GET;	
	
	$tempid = trim(templateValidateID($tempid));
	$artid = trim(ujianValidateID($artid));
	if ($tempid == "") return;
	$qujian = cmsDB();
	$qujian->debug_msg = 0;
	
	$strSQL = "SELECT *,DATE_FORMAT(date_created, '".$cms_ujian["datetime_format"]."') as cdate,";
	$strSQL .= "DATE_FORMAT(date_modified, '".$cms_ujian["date_format"]."') as mdate FROM";
	if ($artid == "")
		$strSQL .= " db_mega.tbl_ujian WHERE template_id = '".$qujian->safeSQL($tempid)."'";
	else
		$strSQL .= " db_mega.tbl_ujian WHERE template_id = '".$qujian->safeSQL($tempid)."' AND ujian_id = '".$qujian->safeSQL($artid)."'";
	
	$qujian->query($strSQL);
	
	if ($qujian->recordCount() == 1) {
		$qujian->next();
		$ujian_fields = array();
		$ujian_fields["date_created"] = $qujian->row("cdate");
		$ujian_fields["date_modified"] = $qujian->row("mdate");
		$ujian_fields["date"] = $qujian->row("idate");
		$ujian_fields["title"] = $qujian->row("ititle");
		$ujian_fields["summary"] = ujianDecodePath($qujian->row("isummary"),"www_img_url,www_embed_url,cms_url");
		$cms_ujian["currujian"] = $ujian_fields;
	}
}

function ujianField($field = "") {
	global $cms_ujian;
	if (isset($cms_ujian["currujian"][$field]))
		return $cms_ujian["currujian"][$field];
	else
		return "";
}

function ujianDateCreated() {
	return ujianField("date_created");
}

function ujianDateModified() {
	return ujianField("date_modified");
}

function ujianDate() {
	return ujianField("date");
}

function ujianTitle() {
	return ujianField("title");
}

function ujianSummary() {
	return ujianField("summary");
}

function ujianValidateID($str) {
	$newStr = strtolower($str);
	if (preg_match("/^[a-z0-9_]+\$/i",$str))
		return $newStr;
	else
		return "";
}

function ujianDecodePath($str = "",$list = "") {
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

function ujianEncodePath($str = "",$list = "") {
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