<? 
	require_once("../config.inc.php");
	$branch=cmsDB2();
	$branch->query("SELECT * FROM tbl_branch WHERE branch_id = ".uriParam("branch_id"));
	$branch->next();
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title><?=$FJR_VARS["admin_title"]?> - Edit User</title>
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>

<body onLoad="">
<table border="0" cellpadding="2" width="101%" bgcolor="#DEDEDE" cellspacing="0">
  <form name="frmedit" action="qedit.php?branch_id=<?=uriParam("branch_id");?>" method="post">
	<tr>
		<td background="../images/depan.jpg"><b><font color="#FFFFFF">Edit Branch</font></b></td>
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
					<td><?
						$qregion=cmsDB2();
						$strSQL = "SELECT * 
								 FROM tbl_branch
								 LEFT JOIN tbl_region 
								 ON tbl_branch.region_id = tbl_region.region_id
								 WHERE branch_id = ".uriParam("branch_id")."
								 GROUP BY region_name";
						$qregion->query($strSQL);
						while ($qregion->next()) {
							echo "<option value='".htmlentities($qregion->row("branch_id"))."'";
							if(htmlentities($qregion->row("branch_id"))=="$branch_id"){
						echo "selected";
							}
							echo " >".htmlentities($qregion->row("region_name"))."</option>";
						}
					?></td>
				</tr>
				<tr>
					<td>Branch Name</td>
					<td>:</td>
					<td><input type="Text" name="branch_name"  maxlength="50" class="text" size="50" value="<?=$branch->row("branch_name")?>"></td>
				</tr>
				<tr>
					<td>Branch Description</td>
					<td>:</td>
					<td><input type="Text" name="branch_desc"  maxlength="50" class="text" size="50"  value="<?=$branch->row("branch_desc")?>"></td>
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
			<input type="submit" class="button" value="Delete" onClick="document.frmedit.action='qdelete.php?branch_id=<?=uriParam("branch_id")?>'">&nbsp;&nbsp;
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