<?
		require_once("../config.inc.php");
		
		$strsql = "update tadvertisement set ad_name='".$_POST["txtname"]."',ad_banner='".$_POST["txtbanner"]."',ad_link='".$_POST["txturl"]."' where ad_id=".$_GET["ad_id"];
		$mega_db->query($strsql);
		
?>
<script language="JavaScript">
	alert("Record Updated!");
	location = "index.php?URLEncode=<?=mktime()?>";
</script>