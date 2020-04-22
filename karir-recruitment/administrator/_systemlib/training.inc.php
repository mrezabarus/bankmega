<?
$cms_training["datetime_format"] = "%m/%d/%Y %H:%i:%s";
$cms_training["date_format"] = "%m/%d/%Y";

function trainingInit($tempid = "",$artid = "") {
	global $FJR_VARS, $cms_training;
	global $_GET;	
	
	$tempid = trim(templateValidateID($tempid));
	$artid = trim(trainingValidateID($artid));
	if ($tempid == "") return;
	$qtraining = cmsDB();
	$qtraining->debug_msg = 0;
	
	$strSQL = "SELECT *,DATE_FORMAT(date_created, '".$cms_training["datetime_format"]."') as cdate,";
	$strSQL .= "DATE_FORMAT(date_modified, '".$cms_training["date_format"]."') as mdate FROM";
	if ($artid == "")
		$strSQL .= " db_mega.tbl_training WHERE template_id = '".$qtraining->safeSQL($tempid)."'";
	else
		$strSQL .= " db_mega.tbl_training WHERE template_id = '".$qtraining->safeSQL($tempid)."' AND training_id = '".$qtraining->safeSQL($artid)."'";
	
	$qtraining->query($strSQL);
	
	if ($qtraining->recordCount() == 1) {
		$qtraining->next();
		$training_fields = array();
		$training_fields["date_created"] = $qtraining->row("cdate");
		$training_fields["date_modified"] = $qtraining->row("mdate");
		$training_fields["date"] = $qtraining->row("idate");
		$training_fields["title"] = $qtraining->row("ititle");
		$training_fields["group"] = $qtraining->row("group");
		$cms_training["currtraining"] = $training_fields;
	}
}

function trainingField($field = "") {
	global $cms_training;
	if (isset($cms_training["currtraining"][$field]))
		return $cms_training["currtraining"][$field];
	else
		return "";
}

function trainingDateCreated() {
	return trainingField("date_created");
}

function trainingDateModified() {
	return trainingField("date_modified");
}

function trainingDate() {
	return trainingField("date");
}

function trainingTitle() {
	return trainingField("title");
}

function trainingSummary() {
	return trainingField("summary");
}

function trainingValidateID($str) {
	$newStr = strtolower($str);
	if (preg_match("/^[a-z0-9_]+\$/i",$str))
		return $newStr;
	else
		return "";
}

function trainingDecodePath($str = "",$list = "") {
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

function trainingEncodePath($str = "",$list = "") {
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