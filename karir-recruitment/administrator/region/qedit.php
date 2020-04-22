<? 
	require_once("../config.inc.php");
	$region=cmsDB2();
	$sql = "UPDATE tbl_region 
	        SET region_name = '".postParam("region_name")."',region_desc = '".postParam("region_desc")."'
			WHERE region_id = ".uriParam("region_id");
	$region->query($sql);
	jsAlertAndNavigate("Region has updated","index.php?seed=".mktime());
?>