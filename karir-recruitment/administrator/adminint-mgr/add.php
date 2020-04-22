<? 
	require_once("../config.inc.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title><?=$FJR_VARS["admin_title"]?> - My Profile</title>
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>
<?
	$USERNAME = postParam("USERNAME","");
?>
<body onLoad="">
<table border="0" cellpadding="2" width="100%" bgcolor="#DEDEDE" cellspacing="0">
	<form name="frmedit" action="qadd.php" method="post" onSubmit="return Check()">
	<tr>
		<td background="../images/depan.jpg"><b><font color="#FFFFFF">Add Member</font></b></td>
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
			<table border="0" cellpadding="4" cellspacing="0">
				<?
					if(isset($err)){
					echo "<tr><td class=\"errtxt\">";
						echo "Error add user !!<br />";
						if($err == 1) echo "User Name wajib diisi";
						if($err == 2) echo "User Name sudah ada";
					echo "</td></tr>";
					echo "<tr><td>&nbsp;</td></tr>";
					}
				?>
				<tr>
					<td <? if(isset($err) and ($err == 1 or $err == 2)){ ?>class="errtxt"<? } ?>>Username</td>
					<td <? if(isset($err) and ($err == 1 or $err == 2)){ ?>class="errtxt"<? } ?>>:</td>
					<td><input type="Text" name="USERNAME" value="<?=$USERNAME;?>" maxlength="50" class="text"></td>
				</tr>
				<tr>
					<td>Full Name</td>
					<td>:</td>
					<td ><input type="full_name" name="full_name" size="20" maxlength="50" class="text" value=""></td>
				</tr>
				<tr>
					<td>Password</td>
					<td>:</td>
					<td ><input type="password" name="PWD" size="20" maxlength="50" class="text" value=""></td>
				</tr>
				<tr>
					<td>Re-Type Password</td>
					<td>:</td>
					<td ><input type="password" name="CONFPWD" size="20" maxlength="50" class="text" value=""></td>
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
	</form>
</table>
</body>
</html>
<script>
function Check() {
     var errmsg='';
	 full_name=document.frmedit.full_name.value;
	 if (full_name.length == 0) errmsg +='full_name wajib diisi\n'; 
	 PWD=document.frmedit.PWD.value;
	 if (PWD.length == 0) errmsg +='password wajib diisi\n'; 
	 CONFPWD=document.frmedit.CONFPWD.value;
	 if (CONFPWD.length == 0) errmsg +='re-type password ulangi 1x lagi\n'; 
	 EMAIL=document.frmedit.EMAIL.value;
	 if (EMAIL.length == 0) errmsg +='email wajib diisi\n'; 
	 if ( errmsg.length) {
	      alert(errmsg);
	     return false;
	 } else return true;
}
</script>