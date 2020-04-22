<?
	/*
	$base_path = "c:/xampp183/htdocs/mega/administrator/";
	$base_www = "http://localhost/mega/administrator";
	$base_url = "/mega/";
	
	$base_path = "c:/xampp/htdocs/administrator/";
	$base_www = "http://10.14.18.129/administrator";
	$base_url = "/";
	*/
	
	$base_path = "C:/Apache2/htdocs/erec/administrator/";
	$base_www = "http://localhost/erec/administrator";
	$base_url = "/erec/";
	
	/*
	require_once($base_path."_systemlib/dbmysql.inc.php");
	require_once($base_path."_systemlib/miscfunction.inc.php");
	require_once($base_path."_systemlib/listfunction.inc.php");
	require_once($base_path."_systemlib/mega.inc.php");
	require_once($base_path."_systemlib/template.inc.php");
	require_once($base_path."_systemlib/article.inc.php");
	require_once($base_path."_systemlib/lowongan.inc.php");
	require_once($base_path."_systemlib/pelatihan.inc.php");
	require_once($base_path."_systemlib/ujian.inc.php");
	require_once($base_path."_systemlib/training.inc.php");
	require_once($base_path."_systemlib/trick.inc.php");
	require_once($base_path."_systemlib/authorization.inc.php");
	*/
	
	include "_systemlib/dbmysql.inc.php";
	include "_systemlib/miscfunction.inc.php";
	include "_systemlib/listfunction.inc.php";
	include "_systemlib/mega.inc.php";
	include "_systemlib/template.inc.php";
	include "_systemlib/article.inc.php";
	include "_systemlib/lowongan.inc.php";
	include "_systemlib/pelatihan.inc.php";
	include "_systemlib/ujian.inc.php";
	include "_systemlib/training.inc.php";
	include "_systemlib/trick.inc.php";
	include "_systemlib/authorization.inc.php";
	
	
	$mega_db = cmsDB();
	$mega_db->debug_msg = 0;
	
	$nonAuthURL = array(strtolower($FJR_VARS["admin_url"]."login.php"),
											strtolower($FJR_VARS["admin_url"]."qlogin.php"));
	
	function checkAuth() {
		global $FJR_VARS, $_SERVER;
		$reserved_url = array(strtolower($FJR_VARS["admin_url"]."index.php"),
													strtolower($FJR_VARS["admin_url"]."login.php"),
													strtolower($FJR_VARS["admin_url"]."qlogin.php"));
		$ref = $FJR_VARS["admin_url"]."index.php";
		//echo "admin cookie = " . getAdminCookie();
		//die();
		if (getAdminCookie() == "") {
			if (!in_array(strtolower($_SERVER["PHP_SELF"]),$reserved_url)) {
				$ref = $_SERVER["PHP_SELF"];
				if (isset($_SERVER["QUERY_STRING"])) $ref .= "?".$_SERVER["QUERY_STRING"];
			}
			JSNavigate($FJR_VARS["admin_url"]."login.php?seed=".md5(date('m/d/y,h:m:s'))."&ref=".rawurlencode($ref));
			die();
		}
	}
	
	DisableCaching();
	
	if (!in_array(strtolower($_SERVER["PHP_SELF"]),$nonAuthURL)) checkAuth();
?>