<?
	require_once("../config.inc.php");
	$branch=cmsDB2();
	$branch->query("DELETE FROM tbl_branch WHERE branch_id = ".uriParam("branch_id"));
	jsAlertAndNavigate("Contact has been deleted","index.php?seed=".mktime(),true);
?>