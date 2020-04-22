<?
	require_once("../config.inc.php");
		
	$cekdb = cmsDB();
	$sql = "delete from tuser where user_id=".$_GET["uid"];
	$cekdb->query($sql);
		
	$message = "User Deleted!!";
	jsAlertAndNavigate($message,"index.php?ref=".mktime(),true);
	
?>