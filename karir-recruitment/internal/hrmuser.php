<?
	$base_path = "/home/xolut246/public_html/client/mega/internal/";
	$base_www = "http://xolution.net/client/mega/internal";
	$base_url = "/client/mega/internal/";

	session_start();
	/*
	require_once($base_path."includes/dbmysql.inc.php");
	require_once($base_path."includes/miscfunction.inc.php");
	require_once($base_path."includes/listfunction.inc.php");
	require_once($base_path."includes/defaultvar.inc.php");
	*/
	
	include "includes/dbmysql.inc.php";
	include "includes/miscfunction.inc.php";
	include "includes/listfunction.inc.php";
	include "includes/defaultvar.inc.php";
	
	$login = cmsDB();
	$update = cmsDB();
	$login->query("select * from tbl_hrm_user");
	while($login->next()){
		
		$dec_pwd = base64_decode(base64_decode(trim($login->row("pwd"))));
		//$update->query("update tbl_hrm_user set pwd='".$enc_pwd."' where user_id=".$login->row("user_id"));
		echo $login->row("user_name"). " | " . $login->row("pwd") . " | " . $dec_pwd . " --- Encrypted<BR>";
	}
	
?>