<?
	require_once("../../config.php");
	$insert = cmsDB();
	$reference = cmsDB();
	$family=cmsDB();
	$couple=cmsDB();
	$child=cmsDB();
	$edu=cmsDB();
	$job=cmsDB();
	
	$insert->query("delete from tbl_jobseeker where js_id=".uriParam("js_id"));
	$insert->query("delete from tbl_jobseeker_interest_pos where js_id=".uriParam("js_id"));
	$reference->query("delete from tbl_jobseeker_reference where js_id=".uriParam("js_id"));
	$family->query("delete from tbl_jobseeker_family where js_id=".uriParam("js_id"));
	$family->query("delete from tbl_jobseeker_couple where js_id=".uriParam("js_id"));
	$family->query("delete from tbl_jobseeker_children where js_id=".uriParam("js_id"));
	$edu->query("delete from tbl_jobseeker_formal_edu where js_id=".uriParam("js_id"));
	$edu->query("delete from tbl_jobseeker_informal_edu where js_id=".uriParam("js_id"));
	$edu->query("delete from tbl_jobseeker_activity where js_id=".uriParam("js_id"));
	$edu->query("delete from tbl_jobseeker_language where js_id=".uriParam("js_id"));
	$job->query("delete from tbl_jobseeker_questionare where js_id=".uriParam("js_id"));
	$job->query("delete from tbl_jobseeker_jobexp where js_id=".uriParam("js_id"));
	$job->query("delete from tbl_jobseeker_addtional_info where question <>'reading_freq' and js_id=".uriParam("js_id"));
	
	header("Location: index.php?refresh=".md5("mdYHis")); 	
	die();
?>