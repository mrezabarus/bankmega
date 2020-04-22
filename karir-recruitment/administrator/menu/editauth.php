<?
	require_once("../config.inc.php");
	$menu_id=$_GET["menu_id"];
	$strsql = "SELECT * from tbl_menudetail where auth_id=". $_GET["id"];
	$mega_db->query($strsql);
	$mega_db->next();
	
?>
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
<link rel="stylesheet" type="text/css" href="../css/admin.css">
<link rel="stylesheet" type="text/css" href="stylesheet/stylesheet.css">
<body>
<form name="frmauth" action="qeditauth.php?menu_id=<?=$_GET["menu_id"]?>&id=<?=$_GET["id"]?>" method="post">
<table border="0" cellspacing="0" cellpadding="2" bgcolor="#DEDEDE" width="100%">
  <tr>
	<td background="../images/depan.jpg"><b><font color="#FFFFFF">Edit Child Authorization</font></b></td>
  </tr>
  <tr>
    <td width="100%" >
      <table border="0" cellspacing="2" cellpadding="0">
        <tr>
          <td>Authorization Name</td>
          <td>:</td>
          <td colspan="3"><input type="text" name="txtname" size="35" style="font-family: Arial; font-size: 10pt" value="<?=$mega_db->row("auth_name")?>"></td>
        </tr>
        <tr>
          <td valign="top">Description</td>
          <td valign="top">:</td>
          <td><textarea rows="4" name="txtdesc" cols="38" style="font-family: Arial; font-size: 10pt"><?=$mega_db->row("auth_desc")?></textarea></td>
		  <td valign="top">Width</td>
		  <td valign="top"><input type="text" name="txtwidth" size="5" value="<?=$mega_db->row("lebar")?>"></td>
        </tr>
		
		 <tr>
          <td>Action</td>
          <td>:</td>
          <td >
		    <input type="text" name="txturl" size="35" value="<?=$mega_db->row("urlid")?>">		  </td>
		  <td>Heigth</td>
		  <td><input type="text" name="txtheight" size="5" value="<?=$mega_db->row("tinggi")?>"></td>
        </tr>
        <tr>
          <td colspan="2"></td>
          <td ></td>
        </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
          <td colspan="3">&nbsp;<input class="button" type="submit" value="Update" name="B1" >&nbsp;
            <input class="button" type="button" value="Cancel" name="B1"  onClick="location='authorization.php?menu_id=<?=$_GET["menu_id"]?>&URLEncode=<?=mktime()?>'"></td>
          </tr>
      </table>
    </td>
  </tr>
</table>
</form>
</body>
</html>
