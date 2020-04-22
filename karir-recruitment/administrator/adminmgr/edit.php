<? 
	require_once("../config.inc.php");
	$mega_db->query("SELECT * FROM tadmin WHERE admin_id = ".uriParam("aid"));
	$mega_db->next();
	$PWD = postParam("USERNAME",$mega_db->row("password"));
	$EMAIL = postParam("EMAIL",$mega_db->row("email"));
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title><?=$FJR_VARS["admin_title"]?> - Edit User</title>
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
	<style>
		.errtxt {color:red;}
	</style>
</head>

<body onLoad="">
<table border="0" cellpadding="2" width="100%" bgcolor="#DEDEDE" cellspacing="0">
	<form name="frmedit" action="qedit.php?aid=<?=uriParam("aid");?>" method="post">
	<tr>
		<td background="../images/depan.jpg"><b><font color="#FFFFFF">Edit Member</font></b></td>
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
					echo "</td></tr>";
					echo "<tr><td>&nbsp;</td></tr>";
					}
				?>
<tr>
					<td>User Name</td>
					<td>:</td>
			<td><b><?=$mega_db->row("username");?></b></td>
				</tr>
				<tr>
					<td <? if(isset($err) and ($err == 2 or $err == 4)){ ?>class="errtxt"<? } ?>>Password</td>
					<td <? if(isset($err) and ($err == 2 or $err == 4)){ ?>class="errtxt"<? } ?>>:</td>
					<td ><input type="password" name="PWD" size="20" maxlength="50" class="text" value="<?=$PWD;?>"> &nbsp;<input type="Checkbox" name="chgPass" class="text" <?if(postParam("chgPass")){?>checked<?}?>> Change Password</td>
				</tr>
				<tr>
					<td <? if(isset($err) and $err == 3){ ?>class="errtxt"<? } ?>>Re-Type Password</td>
					<td <? if(isset($err) and $err == 3){ ?>class="errtxt"<? } ?>>:</td>
					<td ><input type="password" name="CONFPWD" size="20" maxlength="50" class="text" value="<?=$PWD;?>"></td>
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
		<td>
			&nbsp;<input type="submit" class="button" value="Update">&nbsp;&nbsp;
			<? if($mega_db->row("admin_id") != getAdminCookie() and $FJR_VARS["isSuperAdmin"] == 1){ ?>
			<input type="submit" class="button" value="Delete" onClick="document.frmedit.action='qdelete.php?aid=<?=uriParam("aid")?>'">&nbsp;&nbsp;
			<? } ?>
			<input type="Button" value="Cancel" class="button" onClick="location='index.php?seed=<?=mktime();?>'">
		</td>
	</tr>
	</form>
</table>
</body>
</html>
