<?
require_once("../config.inc.php");

  $Sql = "select * from tbl_polling_answer where Polling_ID =" . $_GET["poll_id"];
  $mega_db->query($Sql);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Polling Answer List</title>
<link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>
<body topmargin="0" leftmargin="0">
<table border="0" width="100%" bgcolor="#DEDEDE" cellspacing="0" cellpadding="2">
  <tr>
	<td background="../images/depan.jpg"><b><font color="#FFFFFF">Polling Management</font></b></td>
  </tr>
  <tr>
    <td width="100%">
      <table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td><b>No.</b></td>
          <td><b>Answer Title</b></td>
        </tr>
		<?php
				$i = 1;
			  while ($mega_db->next()) { 
	 	  ?>
        <tr>
          <td><? echo $i;?>.</td>
          <td><a href="editchild.php?poll_id=<?=$_GET['poll_id']?>&pollanswer_id=<?=$mega_db->row("Polling_Answer_ID");?>&URLEncrypt=<?=urlencode(date('m/d/y,h:m:s'))?>">
		            <?=$mega_db->row("Answer_Title");?></a></td>
        </tr>
		 <?php
		  $i = $i+1;
		  }
		  ?>   
        <tr>
          <td colspan="2">
		  <input class="button" type="button" name="btnadd" value="New" onClick="location='newchild.php?poll_id=<?=$_GET["poll_id"]?>';">
		  <input class="button" type="button" name="btnback" value="Cancel" onClick="window.close();"></td>
        </tr>
      </table>
    </td>
  </tr>
</table>

</body>


</html>
