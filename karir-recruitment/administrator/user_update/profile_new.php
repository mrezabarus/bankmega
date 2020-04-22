<?
	require_once("../config.inc.php");
	$uid = is_numeric(uriParam("uid",0))?uriParam("uid",0):0;
	$isview = uriParam("act","") == "view"?true:false;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>Site User Manager - Profile | New User Mode</title>
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>
<body leftmargin="10" topmargin="0">
<?
	
	$area_db=cmsDB();

	if(isset($_POST["txtusername"])){ $txtusername = $_POST["txtusername"]; }else{ $txtusername = ""; }
	if(isset($_POST["txtnik"])){ $txtnik = $_POST["txtnik"]; }else{ $txtnik = ""; }
	if(isset($_POST["txtemail"])){ $txtemail = $_POST["txtemail"]; }else{ $txtemail = ""; }
	if(isset($_POST["txtfirstname"])){ $txtfirstname = $_POST["txtfirstname"]; }else{ $txtfirstname = ""; }
	if(isset($_POST["txtlastname"])){ $txtlastname = $_POST["txtlastname"]; }else{ $txtlastname = ""; }
	if(isset($_POST["txtphone"])){ $txtphone = $_POST["txtphone"]; }else{ $txtphone = ""; }
	if(isset($_POST["txthandphone"])){ $txthandphone = $_POST["txthandphone"]; }else{ $txthandphone = ""; }
	if(isset($_POST["selarea"])){ $selarea = $_POST["selarea"]; }else{ $selarea = ""; }
?>
<script language="JavaScript">
	function _resubmit(){
		document.frmaction.action = "<?=getenv("SCRIPT_NAME")?>?<?=getenv("QUERY_STRING")?>";
		document.frmaction.submit();
	}
</script>
<br />
<form name="frmaction" method="post" action="profile_qinsert.php?REFRESH=<?=mktime()?>">
<table border="0" cellpadding="2" cellspacing="0" width="100%" bgcolor="#DEDEDE">
  <tr>
	<td colspan="3" background="../images/depan.jpg"><b><font color="#FFFFFF">New User</font></b></td>
  </tr>
  <tr>
    <td colspan="3">
    <table border="0" cellpadding="2" cellspacing="0">
  <tr>
    <td>User Name</td>
    <td>:</td>
    <td><input type="text" name="txtusername" size="35" maxlength="35" value="<?=$txtusername?>"></td>
  </tr>
   <tr>
    <td>ID</td>
    <td>:</td>
    <td><input type="text" name="txtnik" size="35" maxlength="35" value="<?=$txtnik?>"></td>
  </tr>
  <tr>
    <td>Area</td>
    <td>:</td>
    <td>
		<?
			$area_db->query("select * from tarea");
			echo "<SELECT NAME = 'selarea'";
			echo "<OPTION VALUE = '0'>&lt;Select Area&gt;</OPTION> ";
			while ($area_db->next()) { 
				echo "<OPTION VALUE = '".$area_db->row("area_id")."'>".$area_db->row("area_name")."</OPTION> ";
			}
			echo "</select>"
		?>	</td>
  </tr>
  <tr>
    <td>Nama Depan*</td>
    <td>:</td>
    <td><input name="txtfirstname" size="35" maxlength="35" value="<?=$txtfirstname?>"></td>
  </tr>
  <tr>
    <td>Nama Belakang</td>
    <td>:</td>
    <td><input name="txtlastname" size="35" maxlength="35" value="<?=$txtlastname?>"></td>
  </tr>
  <tr>
    <td>Telepon*</td>
    <td>:</td>
    <td><input name="txtphone" size="35" maxlength="35" value="<?=$txtphone?>"></td>
  </tr>
  <tr>
    <td>HP</td>
    <td>:</td>
    <td><input name="txthandphone" size="35" maxlength="35" value="<?=$txthandphone?>"></td>
  </tr>
  <tr>
    <td>Email*</td>
    <td>:</td>
    <td><input name="txtemail" size="35" maxlength="35" value="<?=$txtemail?>"></td>
  </tr>
 
  <tr>
    <td colspan="3">&nbsp;</td>
    </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    <td><input class="button" type="submit" value="Save" name="B1">&nbsp;
      <input class="button" type="button" value="Kembali" name="B1" onClick="location='index.php?ref=<?=date('M/dd/YY HH:mm:ss')?>';"></td>
  </tr>
    </table>
    </td>
  </tr>
</table>
</form>
</body>
</html>