<? 
	require_once("../config.inc.php");
	$position=cmsDB2();
	$position->query("SELECT * FROM tbl_position WHERE position_id = ".uriParam("position_id"));
	$position->next();
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title><?=$FJR_VARS["admin_title"]?> - Edit User</title>
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>

<body onLoad="">
<table border="0" cellpadding="2" width="101%" bgcolor="#DEDEDE" cellspacing="0">
  <form name="frmedit" action="qedit.php?position_id=<?=uriParam("position_id");?>" method="post">
	<tr>
		<td background="../images/depan.jpg"><b><font color="#FFFFFF">Edit Position</font></b></td>
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
					<td><b>Position Name</b></td>
					<td><b>:</b></td>
					<td><input type="Text" name="position_name"  maxlength="50" class="text" size="50" value="<?=$position->row("position_name")?>"></td>
				</tr>
				<tr>
					<td>Position Description</td>
					<td>:</td>
					<td><input type="Text" name="position_desc"  maxlength="50" class="text" size="50"  value="<?=$position->row("position_desc")?>"></td>
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
			<input type="submit" class="button" value="Delete" onClick="document.frmedit.action='qdelete.php?position_id=<?=uriParam("position_id")?>'">&nbsp;&nbsp;
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