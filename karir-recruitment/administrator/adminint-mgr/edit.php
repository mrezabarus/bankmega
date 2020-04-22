<? 
	require_once("../config.inc.php");
	$mega_db = cmsDB2();
	$mega_db->query("SELECT * FROM tbl_hrm_user WHERE user_id = ".uriParam("aid"));
	$mega_db->next();
	$PWD = postParam("PWD",$mega_db->row("pwd"));
	$phone = postParam("phone",$mega_db->row("phone_no"));

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title><?=$FJR_VARS["admin_title"]?> - Edit User</title>
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>
<body onLoad="">
<table width="100%" border="0" cellpadding="2" bgcolor="#DEDEDE" cellspacing="0">
  <form name="frmedit" action="qedit.php?aid=<?=uriParam("aid");?>" method="post">
	<tr>
		<td background="../images/depan.jpg"><b><font color="#FFFFFF">Edit Member</font></b></td>
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
						echo "Error when add Member !!<br />";
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
					<td>Username</td>
			  <td>:</td>
		    <td colspan="3"><b><?=$mega_db->row("user_name");?></b></td>
			  </tr>
				<tr>
					<td>Full Name</td>
					<td>:</td>
					<td colspan="3"><?=$mega_db->row("full_name");?></td>
				</tr>
				<tr>
					<td <? if(isset($err) and ($err == 2 or $err == 4)){ ?>class="errtxt"<? } ?>>Password</td>
					<td <? if(isset($err) and ($err == 2 or $err == 4)){ ?>class="errtxt"<? } ?>>:</td>
					<td ><input type="password" name="PWD" size="20" maxlength="50" class="text" value="<?=$PWD;?>"></td>
				    <td ><input type="Checkbox" name="chgPass" class="text" <?if(postParam("chgPass")){?>checked<?}?>></td>
				    <td >Change Password</td>
				</tr>
				<tr>
					<td <? if(isset($err) and $err == 3){ ?>class="errtxt"<? } ?>>Re-type Password</td>
					<td <? if(isset($err) and $err == 3){ ?>class="errtxt"<? } ?>>:</td>
					<td colspan="3" ><input type="password" name="CONFPWD" size="20" maxlength="50" class="text" value="<?=$PWD;?>"></td>
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
		<td>
			&nbsp;<input type="submit" class="button" value="Update">&nbsp;&nbsp;
			<? if($mega_db->row("user_id") != getAdminCookie() and $FJR_VARS["rgb_id"] == 0){ ?>
			<input type="submit" class="button" value="Delete" onClick="document.frmedit.action='qdelete.php?aid=<?=uriParam("aid")?>'">&nbsp;&nbsp;
			<? } ?>
			<input type="Button" value="Cancel" class="button" onClick="location='index.php?seed=<?=mktime();?>'">
		</td>
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
