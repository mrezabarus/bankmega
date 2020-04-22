<?
	require_once("../config.inc.php");
	$region=cmsDB2();
	$region->query("DELETE FROM tbl_region WHERE region_id = ".uriParam("region_id"));
	jsAlertAndNavigate("Region has been deleted","index.php?seed=".mktime(),true);
?>