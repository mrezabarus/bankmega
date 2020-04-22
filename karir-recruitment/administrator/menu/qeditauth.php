<?
		require_once("../config.inc.php");
		
		$strsql = "update tbl_menudetail set auth_name='" . $_POST["txtname"] . "',auth_desc='" . $_POST["txtdesc"] . "',urlid='" . $_POST["txturl"] . "',lebar=". $_POST["txtwidth"] .",tinggi=". $_POST["txtheight"] ." where auth_id=" . $_GET["id"];
		//echo $strsql;
		//die();
		$mega_db->query($strsql);
		
?>
<script language="JavaScript">
	alert("Record Updated!");
	location = "authorization.php?menu_id=<?=$_GET["menu_id"]?>&URLEncode=<?=mktime()?>";
</script>