<?
require_once("../config.inc.php");
	$strsql = "SELECT * from tadvertisement where ad_id=". $_GET["ad_id"];
	$mega_db->query($strsql);
	$mega_db->next();
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
<form name="frmauth" action="qeditauth.php?ad_id=<?=$_GET["ad_id"]?>" method="post">
<table border="0" cellspacing="0" width="100%" cellpadding="2" bgcolor="#DEDEDE">
  <tr>
	<td background="../images/depan.jpg"><b><font color="#FFFFFF">Edit Banner</font></b></td>
  </tr>
  <tr>
    <td width="100%">
      <table border="0" cellspacing="0">
        <tr>
          <td>Banner Name</td>
          <td>:</td>
          <td  colspan="3"><input type="text" name="txtname" size="35" value="<?=$mega_db->row("ad_name")?>"></td>
        </tr>
       <tr>
          <td>Link To URL</td>
          <td>:</td>
          <td  colspan="3">
		    <input type="text" name="txturl" size="35" value="<?=$mega_db->row("ad_link")?>"></td>
		  </tr>
		  <tr>
          <td>Banner File Name</td>
          <td>:</td>
          <td  colspan="3">
		    <input type="text" name="txtbanner" size="35" value="<?=$mega_db->row("ad_banner")?>"></td>
		  </tr>
        <tr>
          <td colspan="2"></td>
          <td ></td>
        </tr>
        <tr>
          <td colspan="2"></td>
          <td >
		  <input class="button" type="submit" value=" Update " name="B1">
		  <input class="button" type="button" value=" Delete " name="B1" onClick="location='qdelete.php?ad_id=<?=$_GET["ad_id"]?>&URLEncode=<?=mktime()?>'">
          <input class="button" type="button" value=" Cancel " name="B1" onClick="location='index.php?URLEncode=<?=mktime()?>'"></td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</form>
</body>
</html>
