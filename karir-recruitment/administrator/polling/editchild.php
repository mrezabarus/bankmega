<?
	require_once("../config.inc.php");
?>
<?php
  $Sql = "select * from tbl_polling_answer where Polling_Answer_ID =" . $_GET["pollanswer_id"];
  $mega_db->query($Sql);
  $mega_db->next();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Edit Polling Answer</title>
<link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>
<body topmargin="0" leftmargin="0">
<form name="frmnew" action="qpollingchild.php?txtaction=edit&pollanswer_id=<?=$_GET['pollanswer_id']?>&poll_id=<?=$_GET['poll_id']?>" method="post">
<table border="0" width="100%" bgcolor="#DEDEDE" cellspacing="0" cellpadding="2">
  <tr>
	<td background="../images/depan.jpg"><b><font color="#FFFFFF">Edit Polling Answer</font></b></td>
  </tr>
  <tr>
    <td width="100%">
    <table border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td><b>Answer Title</b></td>
        <td><b>:</b></td>
        <td height="25"><input value="<?=$mega_db->row("Answer_Title");?>" type="text" name="txtanswer" size="39"></td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td>
			<input class="button" type="submit" value="Save" name="B1">
			<input class="button" type="button" value="Cancel" name="B1" onClick="history.back();">
			<input class="button" type="button" value="Delete" name="B1" onClick="location='qpollingchild.php?txtaction=delete&poll_id=<?=$_GET['poll_id']?>&pollanswer_id=<?=$_GET['pollanswer_id']?>'">
		</td>
      </tr>
    </table>
    </td>
  </tr>
</table>
</form>
</body>
</html>