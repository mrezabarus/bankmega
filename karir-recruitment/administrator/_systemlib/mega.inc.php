<?
	error_reporting(E_ERROR);
	session_start();

	$FJR_VARS = Array();
//////////////////// Database Setting //////////////////////////////
/*

	$FJR_VARS["db_name_rec"]		= "mega_erecruitment";
	$FJR_VARS["db_name"]			= "db_mega";
	$FJR_VARS["db_host"]			= "localhost";
	$FJR_VARS["db_user"]			= "root";
	$FJR_VARS["db_pwd"]				= "";
*/
	$FJR_VARS["db_name_rec"]		= "erecruitment";
	$FJR_VARS["db_name"]			= "db_mega";
	$FJR_VARS["db_host"]			= "localhost";
	$FJR_VARS["db_user"]			= "root";
	$FJR_VARS["db_pwd"]				= "admin";

////////////////////////////////////////////////////////////////////////	

	$FJR_VARS["admin_path"]			= $base_path."administrator/";
	$FJR_VARS["admin_path1"]		= $base_path;
		
	$FJR_VARS["www_path"]			= $base_path."public/";
	$FJR_VARS["cms_path"]			= $base_path."_cms/";
	$FJR_VARS["addon_path"]			= $FJR_VARS["cms_path"] ."_addonlib/";
	$FJR_VARS["www_parent"]			= $base_url;
	
	$FJR_VARS["admin_url"]			= $base_url."administrator/";
	$FJR_VARS["www_url"]			= $base_url."public/";
	$FJR_VARS["cms_url"]			= $base_url."_cms/";
	$FJR_VARS["addon_url"]			= $FJR_VARS["cms_url"] ."_addonlib/";
	
	$FJR_VARS["admin_title"]		= "Administrator Area";
	$FJR_VARS["www_title"]			= ":: Mega E-Recruitment";
	
	$FJR_VARS["cms_template_path"]	= $FJR_VARS["cms_path"]."_templates/";
	$FJR_VARS["www_img_path"]		= $FJR_VARS["cms_path"]."_images/";
	$FJR_VARS["www_embed_path"]		= $FJR_VARS["cms_path"]."_embeds/";
	$FJR_VARS["www_file_path"]		= $FJR_VARS["cms_path"]."_files/";
	$FJR_VARS["www_js_path"]		= $FJR_VARS["cms_path"]."_js/";
	$FJR_VARS["www_css_path"]		= $FJR_VARS["cms_path"]."_css/";
	
	$FJR_VARS["www_img_url"]		= $FJR_VARS["cms_url"]."_images/";
	$FJR_VARS["www_embed_url"]		= $FJR_VARS["cms_url"]."_embeds/";
	$FJR_VARS["www_file_url"]		= $FJR_VARS["cms_url"]."_files/";
	$FJR_VARS["www_js_url"]			= $FJR_VARS["cms_url"]."_js/";
	$FJR_VARS["www_css_url"]		= $FJR_VARS["cms_url"]."_css/";
	$FJR_VARS["www_ajax_path"]		= $FJR_VARS["cms_url"]."_ajax/";
	$FJR_VARS["www_captcha_path"]	= $FJR_VARS["cms_url"]."_captcha/";
	$FJR_VARS["www_systemlib_path"]	= $FJR_VARS["cms_url"]."_systemlib/";

	$FJR_VARS["www_img_admin"]		= $FJR_VARS["admin_path1"]."images/gambar/";
	$FJR_VARS["www_embed_admin"]	= $FJR_VARS["admin_path1"]."images/embeds/";
	$FJR_VARS["www_banner_admin"]	= $FJR_VARS["admin_path1"]."images/banner/";
	$FJR_VARS["www_file_admin"]		= $FJR_VARS["admin_path1"]."images/files/";
	
	$FJR_VARS["admin_cookie"]		= "sysaid";
	$FJR_VARS["client_cookie"]		= "sysuid";
	$FJR_VARS["isSuperAdmin"]		= 0;
	$FJR_VARS["arrAuthorized"]		= array();

	$FJR_VARS["sys_minusername"]	= 4;
	$FJR_VARS["sys_maxusername"]	= 50;
	$FJR_VARS["sys_minpassword"]	= 4;
	$FJR_VARS["sys_maxpassword"]	= 50;
	
	$FJR_VARS["max_file_size"]		= 100000;
	$FJR_VARS["mime_type_image"]	= array("image/gif", "image/jpeg", "image/pjpeg", "image/tiff");
	$FJR_VARS["mime_type_embed"]	= array("application/x-swf", "video/quicktime", "video/x-sgi-movie", "audio/wav", "audio/mid", "video/x-msvideo");
	$FJR_VARS["mime_type_file"]		= array("text/plain", "text/html", "application/msword", "application/x-zip-compressed");
	$FJR_VARS["mime_type_css"]		= array("text/css");
	$FJR_VARS["mime_type_js"]		= array("application/x-javascript");

	function getAdminCookie() {
		/*
		global $FJR_VARS, $_COOKIE;
		$result = "";
		if (isset($_COOKIE[$FJR_VARS["admin_cookie"]]))
			if (is_numeric($_COOKIE[$FJR_VARS["admin_cookie"]])) $result = $_COOKIE[$FJR_VARS["admin_cookie"]];
		return $result;
		*/
		global $FJR_VARS;
		$result = "";
		if (isset($_SESSION[$FJR_VARS["admin_cookie"]]))
			if (is_numeric($_SESSION[$FJR_VARS["admin_cookie"]])) $result = $_SESSION[$FJR_VARS["admin_cookie"]];
		return $result;
		
	}

	function CheckUsername($val) {
		global $FJR_VARS;
		if (strlen($val) >= $FJR_VARS["sys_minusername"] && strlen($val) <= $FJR_VARS["sys_maxusername"]) {
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
		global $FJR_VARS;
		return (strlen($val) == strlen($cval)) && (strcasecmp($val,$cval) == 0) && (strlen($val) >= $FJR_VARS["sys_minpassword"] && strlen($val) <= $FJR_VARS["sys_maxpassword"]);
	}
	
	function cmsDB() {
		global $FJR_VARS;
		return new udv_db($FJR_VARS["db_name"],$FJR_VARS["db_name_rec"],$FJR_VARS["db_host"],$FJR_VARS["db_user"],$FJR_VARS["db_pwd"]);
	}
	function cmsDB2() {
		global $FJR_VARS;
		return new udv_db($FJR_VARS["db_name_rec"],$FJR_VARS["db_name"],$FJR_VARS["db_host"],$FJR_VARS["db_user"],$FJR_VARS["db_pwd"]);
	}


	set_magic_quotes_runtime(0);
?>
