<?
$cms_pelatihan["datetime_format"] = "%m/%d/%Y %H:%i:%s";
$cms_pelatihan["date_format"] = "%m/%d/%Y";

function pelatihanInit($tempid = "",$artid = "") {
	global $FJR_VARS, $cms_pelatihan;
	global $_GET;	
	
	$tempid = trim(templateValidateID($tempid));
	$artid = trim(pelatihanValidateID($artid));
	if ($tempid == "") return;
	$qpelatihan = cmsDB();
	$qpelatihan->debug_msg = 0;
	
	$strSQL = "SELECT *,DATE_FORMAT(date_created, '".$cms_pelatihan["datetime_format"]."') as cdate,";
	$strSQL .= "DATE_FORMAT(date_modified, '".$cms_pelatihan["date_format"]."') as mdate FROM";
	if ($artid == "")
		$strSQL .= " db_mega.tbl_pelatihan WHERE and template_id = '".$qpelatihan->safeSQL($tempid)."'";
	else
		$strSQL .= " db_mega.tbl_pelatihan WHERE template_id = '".$qpelatihan->safeSQL($tempid)."' AND pelatihan_id = '".$qpelatihan->safeSQL($artid)."'";
	
	$qpelatihan->query($strSQL);
	
	if ($qpelatihan->recordCount() == 1) {
		$qpelatihan->next();
		$pelatihan_fields = array();
		$pelatihan_fields["date_created"] = $qpelatihan->row("cdate");
		$pelatihan_fields["date_modified"] = $qpelatihan->row("mdate");
		$pelatihan_fields["date"] = $qpelatihan->row("idate");
		$pelatihan_fields["title"] = $qpelatihan->row("ititle");
		$pelatihan_fields["summary"] = pelatihanDecodePath($qpelatihan->row("isummary"),"www_img_url,www_embed_url,cms_url");
		$cms_pelatihan["currpelatihan"] = $pelatihan_fields;
	}
}

function pelatihanField($field = "") {
	global $cms_pelatihan;
	if (isset($cms_pelatihan["currpelatihan"][$field]))
		return $cms_pelatihan["currpelatihan"][$field];
	else
		return "";
}

function pelatihanDateCreated() {
	return pelatihanField("date_created");
}

function pelatihanDateModified() {
	return pelatihanField("date_modified");
}

function pelatihanDate() {
	return pelatihanField("date");
}

function pelatihanTitle() {
	return pelatihanField("title");
}

function pelatihanSummary() {
	return pelatihanField("summary");
}

function pelatihanValidateID($str) {
	$newStr = strtolower($str);
	if (preg_match("/^[a-z0-9_]+\$/i",$str))
		return $newStr;
	else
		return "";
}

function pelatihanDecodePath($str = "",$list = "") {
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

function pelatihanEncodePath($str = "",$list = "") {
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