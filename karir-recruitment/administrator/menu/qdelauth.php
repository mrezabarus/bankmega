<?
		require_once("../config.inc.php");
		
		$strsql = "delete from tbl_menudetail where auth_id=" . $_GET["id"];
		//echo $strsql;
		//die();
		$mega_db->query($strsql);
		
?>
<script language="JavaScript">
	alert("Record Deleted!");
	location = "authorization.php?menu_id=<?=$_GET["menu_id"]?>&URLEncode=<?=mktime()?>";
</script>