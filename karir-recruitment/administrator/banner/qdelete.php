<?
		require_once("../config.inc.php");
				
		$del_db=cmsDB();
		$strsql = "delete from tadvertisement where ad_id=".$_GET["ad_id"];
		$del_db->query($strsql);
		
?>
<script language="JavaScript">
	alert("Record Deleted!");
	location = "index.php?URLEncode=<?=mktime()?>";
</script>