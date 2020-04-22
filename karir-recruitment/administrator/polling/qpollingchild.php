<?require_once("../config.inc.php");?>

<?php
     
  if ($_GET["txtaction"] == 'new'):
  		$Sql = "insert into tbl_polling_answer (Polling_ID,Answer_Title,Hints) 
		        values(".$_GET["poll_id"] .",'".$_POST["txtanswer"]."',0)";
		$mega_db->query($Sql);
  elseif ($_GET["txtaction"] == 'edit'):
		$Sql = "update tbl_polling_answer set Answer_Title='" .$_POST["txtanswer"]."'  where Polling_Answer_ID=" . $_GET["pollanswer_id"];
		$mega_db->query($Sql);	  			
  elseif ($_GET["txtaction"] == 'delete'):
  		$Sql = "delete from tbl_polling_answer where Polling_Answer_ID=" . $_GET["pollanswer_id"];
		$mega_db->query($Sql);	
  endif;
  echo $Sql;
 
 
?>

<?if ($_GET["txtaction"] == 'new'):?>
 <script language="JavaScript">
	location="newchild.php?poll_id=<?=$_GET['poll_id']?>&URLEncryptCode=<?=urlencode(date("m/d/y,h:m:s")) ?>";
	opener.location.reload();
 </script> 
 <?else:?>
  <script language="JavaScript">
	location="pollanswer.php?poll_id=<?=$_GET["poll_id"]?>&URLEncryptCode=<?=urlencode(date("m/d/y,h:m:s")) ?>";
	opener.location.reload();
</script>  
 <?endif;?> 