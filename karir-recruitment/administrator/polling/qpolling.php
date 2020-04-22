<?require_once("../config.inc.php");?>

<?php
  if ($_GET["txtaction"] == 'new'):
  		$Sql_Insert = "insert into tbl_polling(Polling_Title,Polling_Date,Polling_Status) values('".$_POST["txttitle"]."',".time().",0)";
		//echo $Sql_Insert;
		$mega_db->query($Sql_Insert);
  elseif ($_GET["txtaction"] == 'edit'):
		$Sql_Insert = "update tbl_polling set Polling_Title='".$_POST["txttitle"]."',Polling_Date=".time()." where Polling_ID=" . $_GET["poll_id"];
		$mega_db->query($Sql_Insert);  			
  elseif ($_GET["txtaction"] == 'delete'):
  	$Sql_Update = "delete from tbl_polling where Polling_ID=" . $_GET["poll_id"];
		$mega_db->query($Sql_Update);
		$Sql_Update = "delete from tbl_polling_answer where Polling_ID=" . $_GET["poll_id"];
		$mega_db->query($Sql_Update);
  endif;
?>
 <script language="JavaScript">
	location="index.php?URLEncryptCode=<?=urlencode(date("m/d/y,h:m:s")) ?>";
 </script>  