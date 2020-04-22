<?
	require_once("../config.inc.php");
	$mega_db->query("UPDATE tadmin SET issuperadmin = 0");
	$mega_db->query("UPDATE tadmin SET issuperadmin = 1 WHERE admin_id = ".uriParam("aid"));
?>
<script>
	location="index.php?seed=<?=mktime();?>";
</script>