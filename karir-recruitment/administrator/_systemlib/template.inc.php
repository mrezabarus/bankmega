<?
$cms_template = array();
$cms_template["default_charset"] = "windows-1252";

$cms_template["type"] = array();
$cms_template["type"][0] = array();
$cms_template["type"][0]["name"] = "Static Template";
$cms_template["type"][0]["value"] = "0";
$cms_template["type"][1] = array();
$cms_template["type"][1]["name"] = "Dynamic Template";
$cms_template["type"][1]["value"] = "1";

function templateInit(&$tempid){
	global $FJR_VARS, $cms_template;

	$tempid = trim(templateValidateID($tempid));
	$qtemplate = cmsDB();
	
	$strSQL = "SELECT template_id,template_type,template_group,db_mega.ttemplate.language_id,
					  isindex,custom_charset,db_mega.ttemplate.display_name as tempDName,charset,
					  db_mega.tlanguage.display_name as langDName, description";
					  
	if ($tempid == "") {
		$strSQL .= " FROM db_mega.ttemplate 
					 LEFT JOIN db_mega.tlanguage ON db_mega.ttemplate.language_id = db_mega.tlanguage.language_id
		             WHERE isindex = 1";
	} else {
		$strSQL .= " FROM db_mega.ttemplate 
		             LEFT JOIN db_mega.tlanguage ON db_mega.ttemplate.language_id = db_mega.tlanguage.language_id 
					 WHERE template_id = '".$qtemplate->safeSQL($tempid)."'";
	}
	$qtemplate->query($strSQL);

	if ($qtemplate->recordCount() == 1) {
		$qtemplate->next();
		$template_fields = array();
		$template_fields["language_id"] = $qtemplate->row("language_id");
		$template_fields["language_charset"] = $qtemplate->row("charset");
		$template_fields["language_display_name"] = $qtemplate->row("langDName");
		$template_fields["template_id"] = $qtemplate->row("template_id");
		$template_fields["template_type"] = $qtemplate->row("template_type");
		$template_fields["group"] = $qtemplate->row("template_group");
		$template_fields["display_name"] = $qtemplate->row("tempDName");
		$template_fields["description"] = $qtemplate->row("description");
		$cms_template["currtemplate"] = $template_fields;
	}

	$qtemplate->free();
}

function templateField($field = "") {
	global $cms_template;
	if (isset($cms_template["currtemplate"][$field]))
		return $cms_template["currtemplate"][$field];
	else
		return "";
}

function templateLangID() {
	return templateField("language_ID");
}

function templateLangCharset() {
	return templateField("language_charset");
}

function templateLangDisplayName() {
	return templateField("language_display_name");
}

function templateID() {
	return templateField("template_id");
}

function templateType() {
	return templateField("template_type");
}

function templateGroup() {
	return templateField("group");
}

function templateDisplayName() {
	return templateField("display_name");
}

function templateDescription() {
	return templateField("description");
}

function templateInclude() {
	global $FJR_VARS;
	if (templateFullPath(templateID()) != "") {
		@include(templateFullPath(templateID()));
	} else {
		//custom 404 handler
	}
}

function templatePartInclude($id) {
	global $FJR_VARS;
	if (templateFullPath($id,true) != "") {
		include(templateFullPath($id,true));
	} else {
		//custom 404 handler
	}
}

function templateValidateID($str) {
	$newStr = strtolower($str);
	if (preg_match("/^[a-z0-9_]+\$/i",$newStr))
		return $newStr;
	else
		return "";
}

function templateFullPath($id,$ispart = false) {
	global $FJR_VARS;
	$newStr = templateValidateID($id);
	if ($newStr != "") {
		if (!$ispart)
			return $FJR_VARS["cms_template_path"].$newStr.".inc.php";
		else
			return $FJR_VARS["cms_template_path"].$newStr.".part.inc.php";
	} else
		return "";
}
?>