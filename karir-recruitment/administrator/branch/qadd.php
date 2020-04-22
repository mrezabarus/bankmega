<? 
	require_once("../config.inc.php");
	$branch=cmsDB2();
	$sql = "INSERT INTO tbl_branch (branch_name,region_id,branch_desc) 
	        VALUES ('".postParam("branch_name")."','".postParam("region_id")."','".postParam("branch_desc")."')";
	$branch->query($sql);
	
	jsAlertAndNavigate("Contact has been added","index.php?seed=".mktime());
?>