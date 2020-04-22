<?
		require_once("../config.inc.php");
		
		$strsql = "insert into tadvertisement(ad_name,ad_banner,ad_link) values";
		$strsql = $strsql . "('" . $_POST["txtname"] . "','" . $_POST["txtbanner"] . "','" . $_POST["txturl"] . "')";
		$mega_db->query($strsql);
		
?>
<script language="JavaScript">
	alert("Record Inserted!");
	location = "index.php?URLEncode=<?=mktime()?>";
</script>