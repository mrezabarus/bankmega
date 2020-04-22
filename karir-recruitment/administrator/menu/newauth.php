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
<form name="frmauth" action="qnewauth.php?menu_id=<?=$_GET["menu_id"]?>" method="post">
<table border="0" cellspacing="0" width="100%" cellpadding="2" bgcolor="#DEDEDE">
  <tr>
	<td background="../images/depan.jpg"><b><font color="#FFFFFF">New Top Authorization</font></b></td>
  </tr>
  <tr>
    <td width="100%">
      <table border="0" cellspacing="2" cellpadding="0">
        <tr>
          <td>Authorization Name</td>
          <td>:</td>
          <td  colspan="3"><input type="text" name="txtname" size="35" style="font-family: Arial; font-size: 10pt"></td>
        </tr>
        <tr>
          <td valign="top">Description</td>
          <td valign="top">:</td>
          <td ><textarea rows="4" name="txtdesc" cols="38" style="font-family: Arial; font-size: 10pt"></textarea></td>
		    <td valign="top">Width</td>
		  <td valign="top"><input type="text" name="txtwidth" size="5" style="font-family: Arial; font-size: 10pt" value="147"></td>
        </tr>
		
       <tr>
          <td>Action</td>
          <td>:</td>
          <td >
		    <input type="text" name="txturl" size="35" style="font-family: Arial; font-size: 10pt">		  </td>
		  <td>Heigth</td>
		  <td><input type="text" name="txtheight" size="5" style="font-family: Arial; font-size: 10pt" value="20"></td>
        </tr>
        <tr>
          <td colspan="2"></td>
          <td ></td>
        </tr>
        <tr>
          <td></td>
          <td></td>
          <td colspan="3">&nbsp;<input class="button" type="submit" value="Save" name="B1">&nbsp;
            <input class="button" type="button" value="Cancel" name="B1" onClick="location='authorization.php?URLEncode=<?=mktime()?>'"></td>
          </tr>
      </table>
    </td>
  </tr>
</table>
</form>
</body>
</html>