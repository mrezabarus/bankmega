<? 
	require_once("../config.inc.php");
	$lastjob=cmsDB2();
	$sql = "UPDATE tbl_lastjob SET ";
	$sql .= "job_name = '".postParam("job_name")."' ";
	$sql .= "WHERE lst_id = ".uriParam("lst_id");
	$lastjob->query($sql);
	jsAlertAndNavigate("Pengalaman has updated","index.php?seed=".mktime());
?>