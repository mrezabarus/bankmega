<?php	

	error_reporting(E_ERROR | E_PARSE);
	$ANOM_VARS = Array();
//////////////////// Database Setting /////////////////////
/*
	$ANOM_VARS["db_name"] 		= "mega_erecruitment";
	$ANOM_VARS["db_host"]		= "localhost";
	$ANOM_VARS["db_user"]		= "root";
	$ANOM_VARS["db_pwd"] 		= "";
*/
	$ANOM_VARS["db_name"] 		= "erecruitment";
	$ANOM_VARS["db_host"]		= "localhost";
	$ANOM_VARS["db_user"]		= "root";
	$ANOM_VARS["db_pwd"] 		= "admin";
//////////////////////////////////////////////////////////	
	
	$ANOM_VARS["admin_path"] = $base_path . "erec/internal/";
	$ANOM_VARS["www_path"]   = $base_path . "";

	$ANOM_VARS["admin_url"] = $base_url."erec/internal/";
	$ANOM_VARS["www_url"]   = $base_url."";
		
	$ANOM_VARS["admin_title"] = "Xolution.Net Framework Stable";
	$ANOM_VARS["www_title"]   = "::: Project Support System :::";
	
	$ANOM_VARS["www_img_path"]  = $ANOM_VARS["www_path"]."library/_images/";
	$ANOM_VARS["www_embed_path"]  = $ANOM_VARS["www_path"]."library/_embeds/";
	$ANOM_VARS["www_file_path"] = $ANOM_VARS["www_path"]."library/_files/";
	$ANOM_VARS["www_js_path"]   = $ANOM_VARS["www_path"]."library/_js/";
	$ANOM_VARS["www_css_path"]  = $ANOM_VARS["www_path"]."library/_stylesheet/";
	
	$ANOM_VARS["www_img_url"]  = $ANOM_VARS["www_url"]."library/_images/";
	$ANOM_VARS["www_embed_url"]  = $ANOM_VARS["www_url"]."library/_embeds/";
	$ANOM_VARS["www_file_url"] = $ANOM_VARS["www_url"]."library/_files/";
	$ANOM_VARS["www_js_url"]   = $ANOM_VARS["www_url"]."library/_js/";
	$ANOM_VARS["www_css_url"]  = $ANOM_VARS["www_url"]."library/_stylesheet/";
	
	$ANOM_VARS["admin_cookie"] = "sysadmin";
	$ANOM_VARS["client_cookie"] = "sysuser";
	$ANOM_VARS["isSuperAdmin"] = 0;
	$ANOM_VARS["arrAuthorized"] = array();

	$ANOM_VARS["sys_minusername"] = 4;
	$ANOM_VARS["sys_maxusername"] = 50;
	$ANOM_VARS["sys_minpassword"] = 4;
	$ANOM_VARS["sys_maxpassword"] = 50;
	
	$ANOM_VARS["max_file_size"] = 100000;
	$ANOM_VARS["mime_type_image"] = array("image/gif", "image/jpeg", "image/pjpeg", "image/tiff");
	$ANOM_VARS["mime_type_embed"] = array("application/x-swf", "video/quicktime", "video/x-sgi-movie", "audio/wav", "audio/mid", "video/x-msvideo");
	$ANOM_VARS["mime_type_file"] = array("text/plain", "text/html", "application/msword", "application/x-zip-compressed");
	$ANOM_VARS["mime_type_css"] = array("text/css");
	$ANOM_VARS["mime_type_js"] = array("application/x-javascript");

	function getAdminCookie() {
		global $ANOM_VARS, $_COOKIE;
		$result = "";
		if (isset($_COOKIE[$ANOM_VARS["admin_cookie"]]))
			if (is_numeric($_COOKIE[$ANOM_VARS["admin_cookie"]])) $result = $_COOKIE[$ANOM_VARS["admin_cookie"]];
		return $result;
	}

	function CheckUsername($val) {
		global $ANOM_VARS;
		if (strlen($val) >= $ANOM_VARS["sys_minusername"] && strlen($val) <= $ANOM_VARS["sys_maxusername"]) {
			$result = true;
			for ($i=0;$i<strlen($val);$i++) {
				if (($i==0 && !preg_match("/^[A-Za-z]/i",substr($val,$i,1))) || !preg_match("/^[A-Za-z0-9]/i",substr($val,$i,1))) {
					$result = false;
					break;
				}
			}
			return $result;
		}	else return false;
	}
	
	function CheckPassword($val,$cval) {
		global $ANOM_VARS;
		return (strlen($val) == strlen($cval)) && (strcasecmp($val,$cval) == 0) && (strlen($val) >= $ANOM_VARS["sys_minpassword"] && strlen($val) <= $ANOM_VARS["sys_maxpassword"]);
	}
	
	function cmsDB() {
		global $ANOM_VARS;
		return new udv_db($ANOM_VARS["db_name"],$ANOM_VARS["db_host"],$ANOM_VARS["db_user"],$ANOM_VARS["db_pwd"]);
	}

	set_magic_quotes_runtime(0);
?>
