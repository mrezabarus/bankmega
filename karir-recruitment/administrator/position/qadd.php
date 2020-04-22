<? 
	require_once("../config.inc.php");
	$position=cmsDB2();
	$sql = "INSERT INTO tbl_position(position_name,position_desc,catpos_id) 
	        VALUES ('".postParam("position_name")."','".postParam("position_desc")."','".postParam("catpos_id")."')";
	$position->query($sql);

	jsAlertAndNavigate("Position has been added","index.php?seed=".mktime());
?>