<?
require_once("../config.inc.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>Untitled</title>
</head>
<script>
function _showmenuprop(x){
	if (x==1){
		document.all["test1"].style.visibility = 'visible';
		document.all["test2"].style.visibility = 'visible';
		document.all["test3"].style.visibility = 'visible';
		document.all["test4"].style.visibility = 'visible';
	}else{
		document.all["test1"].style.visibility = 'hidden';
		document.all["test2"].style.visibility = 'hidden';
		document.all["test3"].style.visibility = 'hidden';
		document.all["test4"].style.visibility = 'hidden';
	}
}
</script>
<body>
<link rel="stylesheet" type="text/css" href="../css/admin.css">
<form name="frmauth" action="qnewauth.php" method="post">
<table width="100%" border="0" cellspacing="0" cellpadding="2" bgcolor="#DEDEDE">
  <tr>
	<td background="../images/depan.jpg"><b><font color="#FFFFFF">New Banner</font></b></td>
  </tr>
  <tr>
    <td width="100%">
      <table border="0" cellspacing="2" cellpadding="0">
        <tr>
          <td width="110">Banner Name</td>
          <td width="3">:</td>
          <td  colspan="4"><input type="text" name="txtname" size="35"></td>
        </tr>
       <tr>
          <td>Link To URL</td>
          <td>:</td>
          <td colspan="4">
		    <input type="text" name="txturl" size="35">
          </td>
		  </tr>
		  <tr>
          <td>Banner File Name</td>
          <td>:</td>
          <td colspan="4">
		    <input type="text" name="txtbanner" size="35"></td>
		  </tr>
        <tr>
          <td colspan="2"></td>
          <td colspan="2" ></td>
        </tr>
        <tr>
          <td colspan="2"></td>
          <td width="44" ><input class="button" type="submit" value="Save" name="B1"></td>
          <td width="199" ><input class="button" type="button" value="Cancel" name="B2" onClick="location='index.php?URLEncode=<?=mktime()?>'"></td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</form>
</body>
</html>
