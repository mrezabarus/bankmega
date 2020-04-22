<? 
	require_once("../config.inc.php");
	$lastjob=cmsDB2();
	$sql = "INSERT INTO tbl_lastjob (job_name) 
	        VALUES ('".postParam("job_name")."')";
	$lastjob->query($sql);

	jsAlertAndNavigate("Last Jobs has been added","index.php?seed=".mktime());
?>