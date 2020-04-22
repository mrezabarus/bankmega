<? 
	require_once("../config.inc.php");
	$region=cmsDB2();
	$sql = "INSERT INTO tbl_region (region_name,region_desc) VALUES ('";
	$sql .= postParam("region_name")."','".postParam("region_desc")."')";
	$region->query($sql);
	
	jsAlertAndNavigate("Region has been added","index.php?seed=".mktime());
?>