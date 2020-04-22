<?
	require_once("../config.inc.php");
	
	$mega_db->query("DELETE FROM tmessage WHERE msg_id = ".uriParam("msgid"));
	jsAlert("Message has deleted");
?>
<script>
	location = "index.php?seed=<?=mktime();?>";
</script>