<?
	require_once("../../config.inc.php");
	$mega_db->query("SELECT * FROM tadmingroup order by group_name asc");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>Untitled</title>
</head>
<link rel="stylesheet" type="text/css" href="../../css/admin.css">
<body>
<table border="0" cellpadding="2" width="100%" bgcolor="#DEDEDE" cellspacing="0">
	<tr>
		<td colspan="3" background="../../images/depan.jpg"><b><font color="#FFFFFF">Admin Group Manager</font></b></td>
	</tr>
	<tr>
		<td colspan="3">
			<table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td width="100%" height="1"><table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td width="100%" height="1"></td></tr></table></td></tr></table>
		</td>
	</tr>
	<tr>
		<td width="47"><b>No.</b></td>
	  <td width="472"><b>Group Name</b></td>
	  <td width="466"><b>Description</b></td>
  </tr>
	<tr>
		<td colspan="3">
			<table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td width="100%" height="1" bgcolor="#000000"><table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td width="100%" height="1"></td></tr></table></td></tr></table>
		</td>
	</tr>
	<?if($mega_db->recordCount() == 0){?>
	<tr>
		<td colspan="3" align="center">No Group Available...</td>
	</tr>
	<? }else{ ?>
	<form>
		<? while($mega_db->next()){?>
			<tr>
				<td><?=$mega_db->currentRow();?>.</td>
				<td><a href="edit.php?gid=<?=$mega_db->row("group_id");?>"><?=$mega_db->row("group_name");?></a></td>
				<td><?=$mega_db->row("description");?></td>
			</tr>
		<? } ?>
	<? } ?>
	<tr>
		<td colspan="3">
			<table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td width="100%" height="1" bgcolor="#000000"><table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td width="100%" height="1"></td></tr></table></td></tr></table>
		</td>
	</tr>
	<tr>
		<td colspan="3"><input type="button" class="button" value="Add Group" onClick="location='add.php?seed=<?=mktime()?>'"></td>
	</tr>
	</form>
</table>

</body>
</html>
