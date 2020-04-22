<?require_once("../config.inc.php");?>
<?php

  $Sql = "select * from tbl_polling where Polling_ID =" . $_GET["poll_id"];
 $mega_db->query($Sql);
 $mega_db->next();
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Edit Polling</title>
<link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>
<body topmargin="0" leftmargin="0">
<form name="frmedit" action="qpolling.php?poll_id=<?=$_GET['poll_id']?>&txtaction=edit" method="post">
<table border="0" width="100%" bgcolor="#DEDEDE" cellspacing="0" cellpadding="2">
  <tr>
	<td background="../images/depan.jpg"><b><font color="#FFFFFF">Edit Polling</font></b></td>
  </tr>
  <tr>
    <td width="100%">
    <table border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td>Polling Title</td>
        <td><b>:</b></td>
        <td><input type="text" value="<?=$mega_db->row("Polling_Title");?>" name="txttitle" size="60"></td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td>&nbsp;<input class="button" type="submit" value="Update" name="B1">
			&nbsp;<input class="button" type="button" value="Delete" name="B1" onClick="location='qpolling.php?txtaction=delete&poll_id=<?=$_GET['poll_id']?>';">
			&nbsp;<input class="button" type="button" value="Cancel" name="B1" onClick="location='index.php'">
		</td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td></td>
      </tr>
    </table>
    </td>
  </tr>
</table>
</form>
</body>
</html>