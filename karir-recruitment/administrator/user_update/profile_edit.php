<?
	require_once("../config.inc.php");
	//$mega_db=cmsDB();
	$mega_db->query("select * from erecruitment.tbl_jobseeker where js_id= ".uriParam("js_id"));
	$mega_db->next();
	$date1 = explode('-',$mega_db->row("date_of_birth"));
	$day1 = explode(" ",$date1[2]);
	$date_of_birth = $day1[0].'-'.$date1[1].'-'.$date1[0];

//	$js_id = is_numeric(uriParam("js_id",0))?uriParam("js_id",0):0;
//	$isview = uriParam("act","") == "view"?true:false;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Site member Manager - Profile</title>
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>
<script language="JavaScript">
	function _resubmit(){
		document.frmaction.action = "<?=getenv("SCRIPT_NAME")?>?<?=getenv("QUERY_STRING")?>";
		document.frmaction.submit();
	}
</script>
<body>
<form name="frmaction" method="post" action="profile_qedit.php?js_id=<?=uriParam("js_id")?>">
<table border="0" cellpadding="2" cellspacing="0" width="100%" bgcolor="#DEDEDE">
  <tr>
	<td colspan="2" background="../images/depan.jpg"><b><font color="#FFFFFF">Edit
	      User Member</font></b></td>
  </tr>
  <tr>
    <td colspan="2">
    <table border="0" cellpadding="2" cellspacing="0">
<tr>
    <td><b>User Name</b></td>
    <td><b>:</b></td>
    <td><font color="#FF0000"><b><?=$mega_db->row("user_name")?></b></font></td>
  </tr>
  <tr>
    <td><b>Full Name</b></td>
    <td><b>:</b></td>
    <td><font color="#0000FF"><b><?=$mega_db->row("full_name")?></b></font></td>
  </tr>
  <tr>
    <td><b>Password Baru</b></td>
    <td><b>:</b></td>
    <td><input type="password" name="pwd" size="35" maxlength="35" value="<?=$mega_db->row("pwd")?>"></td>
  </tr>
  <tr>
    <td><b>Ketik Ulang Password Baru</b></td>
    <td><b>:</b></td>
    <td><input type="password" name="confpwd" size="35" maxlength="35" value="<?=$mega_db->row("pwd")?>"></td>
  </tr>
   <tr>
    <td><b>ID KTP</b></td>
    <td><b>:</b></td>
    <td><?=$mega_db->row("id_no")?></td>
  </tr>
  <tr>
    <td><b>Valid ID</b></td>
    <td>:</td>
    <td><?=$mega_db->row("id_no_valid")?></td>
  </tr>
  <tr>
    <td><b>Tanggal Lahir</b></td>
    <td><b>:</b></td>
    <td><?=$date_of_birth?></td>
  </tr>
  <tr>
    <td><b>Email</b></td>
    <td>:</td>
    <td><input name="email" size="35" maxlength="35" value="<?=$mega_db->row("email")?>"></td>
  </tr>
 
  <tr>
    <td colspan="3">&nbsp;</td>
    </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    <td>
	  <input class="button" type="submit" value="Update" name="B1">&nbsp;
	  <input class="button" type="button" value="Hapus" name="B1" onClick="location='qdelete.php?js_id=<?=uriParam("js_id")?>';">&nbsp;
      <input class="button" type="button" value="Kembali" name="B1" onClick="location='index.php?ref=<?=md5(mktime());?>';"></td>
  </tr>
  </table>
  </td>
  </tr>
</table>
</form>
</body>
</html>
