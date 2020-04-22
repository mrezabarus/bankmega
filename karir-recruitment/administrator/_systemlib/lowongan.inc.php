<?
$cms_lowongan["datetime_format"] = "%m/%d/%Y %H:%i:%s";
$cms_lowongan["date_format"] = "%m/%d/%Y";

function lowonganInit($tempid = "",$artid = "") {
	global $FJR_VARS, $cms_lowongan;
	global $_GET;	
	
	$tempid = trim(templateValidateID($tempid));
	$artid = trim(lowonganValidateID($artid));
	if ($tempid == "") return;
	$qlowongan = cmsDB();
	$qlowongan->debug_msg = 0;
	
	$strSQL = "SELECT *,DATE_FORMAT(date_created, '".$cms_lowongan["datetime_format"]."') as cdate,";
	$strSQL .= "DATE_FORMAT(date_modified, '".$cms_lowongan["date_format"]."') as mdate FROM";
	if ($artid == "")
		$strSQL .= " db_mega.tbl_lowongan WHERE template_id = '".$qlowongan->safeSQL($tempid)."'";
	else
		$strSQL .= " db_mega.tbl_lowongan WHERE template_id = '".$qlowongan->safeSQL($tempid)."' AND lowongan_id = '".$qlowongan->safeSQL($artid)."'";
	
	$qlowongan->query($strSQL);
	
	if ($qlowongan->recordCount() == 1) {
		$qlowongan->next();
		$lowongan_fields = array();
		$lowongan_fields["date_created"] = $qlowongan->row("cdate");
		$lowongan_fields["date_modified"] = $qlowongan->row("mdate");
		$lowongan_fields["date"] = $qlowongan->row("idate");
		$lowongan_fields["title"] = $qlowongan->row("ititle");
		$lowongan_fields["summary"] = lowonganDecodePath($qlowongan->row("isummary"),"www_img_url,www_embed_url,cms_url");
		$cms_lowongan["currlowongan"] = $lowongan_fields;
	}
}

function lowonganField($field = "") {
	global $cms_lowongan;
	if (isset($cms_lowongan["currlowongan"][$field]))
		return $cms_lowongan["currlowongan"][$field];
	else
		return "";
}

function lowonganDateCreated() {
	return lowonganField("date_created");
}

function lowonganDateModified() {
	return lowonganField("date_modified");
}

function lowonganDate() {
	return lowonganField("date");
}

function lowonganTitle() {
	return lowonganField("title");
}

function lowonganSummary() {
	return lowonganField("summary");
}

function lowonganValidateID($str) {
	$newStr = strtolower($str);
	if (preg_match("/^[a-z0-9_]+\$/i",$str))
		return $newStr;
	else
		return "";
}

function lowonganDecodePath($str = "",$list = "") {
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

function lowonganEncodePath($str = "",$list = "") {
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