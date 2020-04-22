<? 
	require_once("../config.inc.php");
	$grade=cmsDB2();
	$strSQL = "SELECT * FROM tbl_golongan
						WHERE gol_id = ".uriParam("gol_id")."";
	$grade->query($strSQL);
	$grade->next();
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title><?=$FJR_VARS["admin_title"]?> - Edit User</title>
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>

<body onLoad="">
<table border="0" cellpadding="2" width="101%" bgcolor="#DEDEDE" cellspacing="0">
  <form name="frmedit" action="qedit.php?gol_id=<?=uriParam("gol_id");?>" method="post">
	<tr>
		<td background="../images/depan.jpg"><b><font color="#FFFFFF">Edit Golongan/Pangkat</font></b></td>
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
					<td>Name Golongan </td>
					<td>:</td>
					<td><input type="Text" name="name"  maxlength="50" class="text" size="50" value="<?=$grade->row("name")?>"></td>
				</tr>
				<tr>
					<td>Branch Description</td>
					<td>:</td>
					<td><input type="Text" name="description"  maxlength="50" class="text" size="50"  value="<?=$grade->row("description")?>"></td>
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
			<input type="submit" class="button" value="Delete" onClick="document.frmedit.action='qdelete.php?gol_id=<?=uriParam("gol_id")?>'">&nbsp;&nbsp;
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