<? 
	require_once("../config.inc.php");
	$region=cmsDB2();
	$region->query("SELECT * FROM tbl_region WHERE region_id = ".uriParam("region_id"));
	$region->next();
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title><?=$FJR_VARS["admin_title"]?> - Edit User</title>
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>

<body onLoad="">
<table border="0" cellpadding="2" width="100%" bgcolor="#DEDEDE" cellspacing="0">
	<form name="frmedit" action="qedit.php?region_id=<?=uriParam("region_id");?>" method="post">
	<tr>
		<td background="../images/depan.jpg"><b><font color="#FFFFFF">Edit Region</font></b></td>
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
					<td>Region Name</td>
					<td>:</td>
					<td><input type="Text" name="region_name"  maxlength="50" class="text" size="50" value="<?=$region->row("region_name")?>"></td>
				</tr>
				<tr>
					<td>Region Descriptions</td>
					<td>:</td>
					<td><input type="Text" name="region_desc"  maxlength="50" class="text" size="50"  value="<?=$region->row("region_desc")?>"></td>
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
			<input type="submit" class="button" value="    Delete    " onClick="document.frmedit.action='qdelete.php?region_id=<?=uriParam("region_id")?>'">&nbsp;&nbsp;
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