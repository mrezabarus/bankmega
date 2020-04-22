<html>
<head>
<title>New Guest Book</title>
</head>
<link rel="stylesheet" type="text/css" href="../css/admin.css">
<body>
<form name="frmnew" action="qgbookdesc.php?txtaction=new" method="post">
<table border="0" width="100%" bgcolor="#DEDEDE" cellspacing="0" cellpadding="2">
  <tr>
	<td background="../images/depan.jpg"><b><font color="#FFFFFF">New Feed Back Group</font></b></td>
  </tr>
  <tr>
    <td width="100%">
    <table border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td>Group Title</td>
        <td>:</td>
        <td><input type="text" name="txttitle" size="39"></td>
      </tr>
	  <tr>
        <td valign="top">Description</td>
        <td valign="top">:</td>
        <td><textarea name="txtdesc" rows="5" cols="39"></textarea></td>
      </tr>
	   <tr>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td></td>
        <td></td>
        <td>
		<input class="button" type="submit" value="Save" name="B1">&nbsp;
		<input type="button" class="button" value="Cancel" name="B1" onClick="location='index.php'"></td>
      </tr>
    </table>
    </td>
  </tr>
</table>
</form>
</body>
</html>