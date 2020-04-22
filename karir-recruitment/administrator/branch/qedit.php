<? 
	require_once("../config.inc.php");
	$branch=cmsDB2();
	$sql = "UPDATE tbl_branch SET ";
	$sql .= "branch_name = '".postParam("branch_name")."' ";
	$sql .= "WHERE branch_id = ".uriParam("branch_id");
	$branch->query($sql);
	jsAlertAndNavigate("Branch has updated","index.php?seed=".mktime());
?>