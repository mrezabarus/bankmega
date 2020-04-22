<?
		require_once("../config.inc.php");
		
		$strsql = "insert into tbl_menudetail(auth_name,auth_desc,parent_id,level_id,urlid,lebar,tinggi,menu_id) values('" . $_POST["txtname"] . "','" . $_POST["txtdesc"] . "',0,0,'" . $_POST["txturl"] . "',". $_POST["txtwidth"] .",". $_POST["txtheight"] .",". $_GET["menu_id"] .")";
		$mega_db->query($strsql);
		
?>
<script language="JavaScript">
	alert("Record Inserted!");
	location = "authorization.php?menu_id=<?=$_GET["menu_id"]?>&URLEncode=<?=mktime()?>";
</script>