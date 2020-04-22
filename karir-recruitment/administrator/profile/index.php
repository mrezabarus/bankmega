<? 
	require_once("../config.inc.php");
	$mega_db->query("SELECT * FROM tadmin_new WHERE admin_id = ".$_SESSION[$FJR_VARS["admin_cookie"]]);
	$mega_db->next();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title><?=$FJR_VARS["admin_title"]?> - My Profile</title>
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
	<SCRIPT LANGUAGE="JavaScript" SRC="../js/taeditor.js" TYPE="text/javascript"></SCRIPT>
	<SCRIPT LANGUAGE="JavaScript" SRC="../js/misc.js" TYPE="text/javascript"></SCRIPT>
	<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
	<!--
		
	//-->
	</SCRIPT>
  </SCRIPT>
</head>

<body onLoad="">
<table border="0" cellpadding="4" width="100%" bgcolor="#DEDEDE" cellspacing="0">
	<form name="frmedit" action="qedit.php" method="post">
	<tr>
		<td background="../images/depan.jpg"><b><font color="#FFFFFF">Profile</font></b></td>
	</tr>
	<tr>
		<td>
			<table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td width="100%" height="1"><table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td width="100%" height="1"></td></tr></table></td></tr></table>
		</td>
	</tr>
	<tr>
		<td>
			<table border="0" cellpadding="4" cellspacing="0">
<tr>
					<td>User Name</td>
					<td>:</td>
					<td><b><?=$mega_db->row("username");?></b></td>
				</tr>
				<tr>
					<td>Password </td>
					<td>:</td>
					<td ><input type="password" name="PWD" size="30" maxlength="50" class="text" value="<?=$mega_db->row("password")?>"></td>
				</tr>
				<tr>
					<td>Re-Type Password </td>
					<td>:</td>
					<td ><input type="password" name="CONFPWD" size="30" maxlength="50" class="text" value="<?=$mega_db->row("password")?>"></td>
				</tr>
			</table>
	  </td>
	</tr>
	<tr>
		<td>
			<table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td width="100%" height="1" bgcolor="#000000"><table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td width="100%" height="1"></td></tr></table></td></tr></table>
		</td>
	</tr>
	<tr>
		<td>&nbsp;<input type="submit" class="button" value="Save"></td>
	</tr>
	</form>
</table>
</body>
</html>
