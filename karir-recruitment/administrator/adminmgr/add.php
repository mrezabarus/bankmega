<? 
	require_once("../config.inc.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title><?=$FJR_VARS["admin_title"]?> - My Profile</title>
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
	<style>
		.errtxt {color:red;}
	</style>
</head>

<?
	$USERNAME = postParam("USERNAME","");
?>

<body onLoad="">
<table border="0" cellpadding="4" width="100%" bgcolor="#DEDEDE" cellspacing="0">
	<form name="frmedit" action="qadd.php" method="post">
	<tr>
		<td background="../images/depan.jpg"><b><font color="#FFFFFF">Add Member</font></b></td>
	</tr>
	<tr>
		<td>
			<table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td width="100%" height="1"><table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td width="100%" height="1"></td></tr></table></td></tr></table>
		</td>
	</tr>
	<tr>
		<td>
			<table border="0" cellpadding="4" cellspacing="0">
				<?
					if(isset($err)){
					echo "<tr><td class=\"errtxt\">";
						echo "Error when add user !!<br>";
						if($err == 1) echo "User Name is Required";
						if($err == 2) echo "Password is Required";
						if($err == 3) echo "Please Re-Type The Password";
						if($err == 4) echo "Password is not match with Re-Type Password";
						if($err == 5) echo "User Name has Existed";
					echo "</td></tr>";
					echo "<tr><td>&nbsp;</td></tr>";
					}
				?>
				<tr>
					<td <?if(isset($err) and ($err == 1 or $err == 5)){?>class="errtxt"<?}?>>Username</td>
					<td <?if(isset($err) and ($err == 1 or $err == 5)){?>class="errtxt"<?}?>>:</td>
					<td><input type="Text" name="USERNAME" value="<?=$USERNAME;?>" maxlength="50" size="25" class="text"></td>
				</tr>
				<tr>
					<td <?if(isset($err) and ($err == 2 or $err == 4)){?>class="errtxt"<?}?>>Password</td>
					<td <?if(isset($err) and ($err == 2 or $err == 4)){?>class="errtxt"<?}?>>:</td>
					<td ><input type="password" name="PWD" size="25" maxlength="50" class="text" value=""></td>
				</tr>
				<tr>
					<td <?if(isset($err) and $err == 3){?>class="errtxt"<?}?>>Re-Type Password</td>
					<td <?if(isset($err) and $err == 3){?>class="errtxt"<?}?>>:</td>
					<td ><input type="password" name="CONFPWD" size="25" maxlength="50" class="text" value=""></td>
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
		<td>&nbsp;<input type="submit" class="button" value="    Save    ">&nbsp;&nbsp;<input type="Button" value="    Cancel    " class="button" onClick="location='index.php?seed=<?=mktime();?>'"></td>
	</tr>
	<tr>
		<td>
			<table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td width="100%" height="1"><table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td width="100%" height="1"></td></tr></table></td></tr></table>
		</td>
	</tr>
	</form>
</table>
</body>
</html>
