<?require_once("../config.inc.php");?>

<?php
  if ($_GET["txtaction"] == 'new'):
  		$Sql_Insert = "insert into tfeedback(fb_name,fb_desc) values('".$_POST["txttitle"]."','".$_POST["txtdesc"]."')";
		$mega_db->query($Sql_Insert);
  elseif ($_GET["txtaction"] == 'edit'):
  		$Sql_Update = "update tfeedback set fb_name='".$_POST["txttitle"]."',fb_desc='".$_POST["txtdesc"]."' where fb_id=".$_GET["fb_id"];
		$mega_db->query($Sql_Update);  			
  elseif ($_GET["txtaction"] == 'delete'):
	  	$Sql_Update = "delete from tfeedback where fb_id=" . $_GET["fb_id"];
		$mega_db->query($Sql_Update);
  endif;
  
?>
<script language="JavaScript">
	location="index.php?URLEncryptCode=<?=urlencode(date("m/d/y,h:m:s")) ?>";
</script>