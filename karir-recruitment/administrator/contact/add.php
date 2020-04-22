<? 
	require_once("../config.inc.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="../css/admin.css">
<title><?=$FJR_VARS["admin_title"]?> - My Profile</title>
</head>
<body onLoad="">
<table border="0" cellpadding="2" width="100%" bgcolor="#DEDEDE" cellspacing="0">
	<form name="frmedit" action="qadd.php" method="post" onSubmit="return Check()">
	<tr>
		<td background="../images/depan.jpg"><b><font color="#FFFFFF">Add Contact</font></b></td>
	</tr>
	<tr>
		<td>
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1"></td>
                </tr>
            </table>
		</td>
	</tr>
	<tr>
		<td>
			<table border="0" cellpadding="2" cellspacing="0">
				<tr>
					<td>Nama</td>
					<td>:</td>
					<td><input type="Text" name="username" value="" maxlength="50" class="text" size="50"></td>
				</tr>
				<tr>
					<td>Department</td>
					<td>:</td>
					<td><input type="Text" name="deptname" value="" maxlength="50" class="text" size="50"></td>
				</tr>
				<tr>
					<td>Division</td>
					<td>:</td>
					<td><input type="Text" name="divname" value="" maxlength="50" class="text" size="50"></td>
				</tr>
				<tr>
					<td>Email</td>
					<td>:</td>
					<td><input type="Text" name="email" value="" maxlength="50" class="text" size="50"></td>
				</tr>
			</table>
	  </td>
	</tr>
	<tr>
		<td>
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1" bgcolor="#000000"></td>
                </tr>
            </table>
		</td>
	</tr>
	<tr>
		<td>&nbsp;<input type="submit" class="button" value="    Save    ">&nbsp;&nbsp;<input type="Button" value="    Cancel    " class="button" onClick="location='index.php?seed=<?=mktime();?>'"></td>
	</tr>
	<tr>
		<td>
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1"></td>
                </tr>
            </table>
		</td>
	</tr>
	</form>
</table>
</body>
</html>
<script>
function Check() {
     var errmsg='';
	 username=document.frmedit.username.value;
	 if (username.length == 0) errmsg +='Nama contact Wajib diisi!\n'; 
	 deptname=document.frmedit.deptname.value;
	 if (deptname.length == 0) errmsg +='Departement Wajib diisi!\n'; 
	 divname=document.frmedit.divname.value;
	 if (divname.length == 0) errmsg +='Divisi Wajib diisi!\n'; 
	 if ( errmsg.length) {
	      alert(errmsg);
	     return false;
	 } else return true;
}
</script>