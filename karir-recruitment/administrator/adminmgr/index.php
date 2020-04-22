<?
	require_once("../config.inc.php");
	$mega_db->query("SELECT * FROM tadmin ORDER BY issuperadmin DESC, username ASC");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>Untitled</title></head>
<link rel="stylesheet" type="text/css" href="../css/admin.css">
<body>
<table width="100%" border="0" align="center" cellpadding="2" cellspacing="0" bgcolor="#DEDEDE">
	<tr>
		<td colspan="3" background="../images/depan.jpg"><strong><font color="#FFFFFF">Admin List</font></strong></td>
	</tr>
	<tr>
		<td colspan="3">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1"></td>
                </tr>
            </table>            </td>
	</tr>
	<tr>
		<td width="7%"><b>No.</b></td>
		<td><b>User Name</b></td>
        <td><b>Right & Permission Access</b></td>
  </tr>
	<tr>
		<td colspan="3">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1" bgcolor="#000000"></td>
                </tr>
            </table>            </td>
	</tr>
	<? if($mega_db->recordCount() == 0){?>
	<tr>
		<td colspan="3" align="center">No User Available...</td>
	</tr>
	<? }else{ ?>
	<form>
		<? while($mega_db->next()){?>
			<tr>
				<td><?=$mega_db->currentRow();?>.</td>
				<td width="31%"><a href="edit.php?aid=<?=$mega_db->row("admin_id");?>"><?=$mega_db->row("username");?></a></td>
				<td width="62%"><?if($mega_db->row("issuperadmin") == 1) echo "SuperAdmin";?></td>
			</tr>
		<?}?>
	<?}?>
	<tr>
		<td colspan="3">
			<table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td width="100%" height="1" bgcolor="#000000"><table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td width="100%" height="1"></td></tr></table></td></tr></table>		</td>
	</tr>
	<tr>
		<td colspan="3"><input type="button" class="button" value="    Add Member    " onClick="location='add.php?seed=<?=mktime()?>'"></td>
	</tr>
	</form>
</table>
</body>
</html>