<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>New Polling</title>
<link href="../css/admin.css" rel="stylesheet" type="text/css">
</head>
<body topmargin="0" leftmargin="0">
<form name="frmnew" action="qpollingchild.php?txtaction=new&poll_id=<?=$_GET['poll_id']?>" method="post">
<table border="0" cellpadding="2" width="100%" bgcolor="#DEDEDE" cellspacing="0">
  <tr>
	<td background="../images/depan.jpg"><b><font color="#FFFFFF">New Polling</font></b></td>
  </tr>
  <tr>
    <td width="100%">
    <table border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td><b>Answer Title</b></td>
        <td><b>:</b></td>
        <td height="25"><input type="text" name="txtanswer" size="39"></td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td><input class="button" type="submit" value="Save" name="B1">&nbsp;
            <input class="button" type="button" value="Cancel" name="B1" onClick="location='pollanswer.php?poll_id=<?=$_GET['poll_id']?>&URLEncryptCode=<?=urlencode(date('m/d/y,h:m:s'))?>';"></td>
      </tr>
    </table>
    </td>
  </tr>
</table>
</form>
</body>
</html>