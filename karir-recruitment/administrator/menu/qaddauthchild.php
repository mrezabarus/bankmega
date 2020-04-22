<?
		require_once("../config.inc.php");
		
		$strsql = "insert into tbl_menudetail(auth_name,auth_desc,parent_id,level_id,urlid,lebar,tinggi,menu_id) values('" . $_POST["txtname"] . "','" . $_POST["txtdesc"] . "',".$_GET["parent"].",'".$_GET["level_new"]."','" . $_POST["txturl"] . "',". $_POST["txtwidth"] .",". $_POST["txtheight"] .",". $_GET["menu_id"] .")";
		//echo $strsql;
		//die();
		$mega_db->query($strsql);
		
?>
<script language="JavaScript">
	alert("Record Inserted!");
	location = "authorization.php?menu_id=<?=$_GET["menu_id"]?>&URLEncode=<?=mktime()?>";
</script>