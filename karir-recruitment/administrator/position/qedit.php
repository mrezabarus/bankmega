<? 
	require_once("../config.inc.php");
	$position=cmsDB2();
	$sql = "UPDATE tbl_position SET ";
	$sql .= "position_name = '".postParam("position_name")."' ";
	$sql .= ",position_desc = '".postParam("position_desc")."' ";
	$sql .= "WHERE position_id = ".uriParam("position_id");
	$position->query($sql);
	jsAlertAndNavigate("Position has updated","index.php?seed=".mktime());
?>