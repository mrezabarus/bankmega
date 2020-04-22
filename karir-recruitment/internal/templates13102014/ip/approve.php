<?
require_once("../../config.php");
$insert = cmsDB();
$jstest = cmsDB();
$jstest->query("select * from tbl_ijin_prinsip where ip_id=".uriParam("ip_id"));
$jstest->next();
$jstest_id = $jstest->row("jstest_id");

$jstest->query("select * from tbl_jobseeker_test where jstest_id=".$jstest_id);
$jstest->next();
$seljobseeker=$jstest->row("js_id");

$insert->query("update tbl_jobseeker set avail_status='ol process' where js_id=".$seljobseeker);
$insert->query("update tbl_ijin_prinsip set ip_approver=".$_SESSION["user_id" . date("mdY")].",approved_date='".date("Y-m-d H:i:s")."',ip_status='approved' where ip_id=".uriParam("ip_id"));
header("Location: index.php?refresh=".md5("mdYHis")); 	
die();
?>