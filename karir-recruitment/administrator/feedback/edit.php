<? require_once("../config.inc.php");

 $Sql = "select * from tfeedback where fb_id =" . $_GET["fb_id"];
 $mega_db->query($Sql);
 $mega_db->next();
	
?>
<html>
<head>
<title>New Guest Book</title>
</head>
<link rel="stylesheet" type="text/css" href="../css/admin.css">
<body>
<form name="frmnew" action="qgbookdesc.php?txtaction=edit&fb_id=<?=$_GET['fb_id']?>" method="post">
<table border="0" width="100%" bgcolor="#DEDEDE" cellspacing="0" cellpadding="2">
  <tr>
	<td background="../images/depan.jpg"><b><font color="#FFFFFF">Edit Feed Back Group</font></b></td>
  </tr>
  <tr>
    <td width="100%">
    <table border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td>Group Title</td>
        <td>:</td>
        <td><input type="text" name="txttitle" value="<?=$mega_db->row("fb_name");?>" size="39"></td>
      </tr>
	    <tr>
        <td valign="top">Description</td>
        <td valign="top">:</td>
        <td><textarea name="txtdesc" rows="5" cols="39"><?=$mega_db->row("fb_desc");?></textarea></td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td>
		<input class="button" type="submit" value="Update" name="B1">&nbsp;
		<input class="button" type="button" value="Delete" name="B1" onClick="location='qgbookdesc.php?txtaction=delete&fb_id=<?=$_GET["fb_id"]?>'">&nbsp;
		<input class="button" type="button" value="Cancel" name="B1" onClick="location='index.php'">
		</td>
      </tr>
    </table>
    </td>
  </tr>
</table>
</form>
</body>
</html>