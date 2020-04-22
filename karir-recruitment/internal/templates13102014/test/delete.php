<?
	require_once("../../config.php");
	$test=cmsDB();
	
	$strsql = "delete from tbl_grouptest where grouptest_id=".$_GET["grouptest_id"];
	$test->query($strsql);
	$strsql = "delete from tbl_test where grouptest_id=".$_GET["grouptest_id"];
	$test->query($strsql);
	header("Location: index.php"); 	
	die();
?>