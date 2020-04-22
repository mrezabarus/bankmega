<? 
	require_once("../config.inc.php");
	$mega_db->query("SELECT * FROM tbl_contact WHERE contact_id = ".uriParam("contact_id"));
	$mega_db->next();
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title><?=$FJR_VARS["admin_title"]?> - Edit User</title>
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>

<body onLoad="">
<table border="0" cellpadding="2" width="100%" bgcolor="#DEDEDE" cellspacing="0">
	<form name="frmedit" action="qedit.php?contact_id=<?=uriParam("contact_id");?>" method="post">
	<tr>
		<td background="../images/depan.jpg"><b><font color="#FFFFFF">Edit Contact</font></b></td>
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
					<td><input type="Text" name="username"  maxlength="50" class="text" size="50"  value="<?=$mega_db->row("contact_name")?>"></td>
				</tr>
				<tr>
					<td>Department</td>
					<td>:</td>
					<td><input type="Text" name="deptname"  maxlength="50" class="text" size="50" value="<?=$mega_db->row("dept")?>"></td>
				</tr>
				<tr>
					<td>Division</td>
					<td>:</td>
					<td><input type="Text" name="divname"  maxlength="50" class="text" size="50" value="<?=$mega_db->row("divisi")?>"></td>
				</tr>
				<tr>
					<td>Email</td>
					<td>:</td>
					<td><input type="Text" name="email"  maxlength="50" class="text" size="50"  value="<?=$mega_db->row("email")?>"></td>
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
			&nbsp;<input type="submit" class="button" value="    Update    ">&nbsp;&nbsp;
			<input type="submit" class="button" value="    Delete    " onClick="document.frmedit.action='qdelete.php?contact_id=<?=uriParam("contact_id")?>'">&nbsp;&nbsp;
			<input type="Button" value="    Cancel    " class="button" onClick="location='index.php?seed=<?=mktime();?>'">
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