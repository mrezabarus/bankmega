<?
require_once("../../config.php");
$insert = cmsDB();
$jstest = cmsDB();
$jstest->query("select * from tbl_ijin_prinsip where ip_id=".uriParam("ip_id"));
$jstest->next();
$jstest_id = $jstest->row("jstest_id");

$jstest->query("select * from tbl_jobseeker_test where jstest_id=".$jstest_id);
$jstest->next();
$selposition=$jstest->row("vacant_pos_id");
$seljobseeker=$jstest->row("js_id");

$insert->query("update tbl_jobseeker_test set test_status_id='0' where jstest_id=".$jstest_id );
$insert->query("update tbl_jobseeker set avail_status='recruitment process' where js_id=".$seljobseeker);
$insert->query("delete from tbl_ijin_prinsip where ip_id=".uriParam("ip_id"));
header("Location: index.php?refresh=".md5("mdYHis")); 	
die();
?>