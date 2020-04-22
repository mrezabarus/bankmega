<? 
	require_once("../config.inc.php");
	
	$strSQL = "SELECT tp_id, tp_group, tp_description, tlanguage.language_id, tlanguage.display_name
	           FROM ttemplate_part 
			   LEFT JOIN tlanguage ON ttemplate_part.language_id = tlanguage.language_id
			   ORDER BY tp_group, tp_id";
	$mega_db->query($strSQL);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
<title><?=$FJR_VARS["admin_title"]?> -  Shared Template Part Manager</title>
<link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>

<body>
<table border="0" cellpadding="2" width="100%" bgcolor="#DEDEDE" cellspacing="0">
	<form>
	<tr>
		<td colspan="5" background="../images/depan.jpg"><b><font color="#FFFFFF">Shared Template Part Manager</font></b></td>
	</tr>
	<tr>
		<td colspan="5">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td width="100%" height="1"></td>
			</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td width="30" align="left"><b>No.</b></td>
		<td><b>Group</b></td>
		<td><b>Part ID</b></td>
		<td><b>Description</b></td>
	</tr>
	<tr>
		<td colspan="5">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
            <td width="100%" height="1" bgcolor="#000000"></td>
            </tr>
            </table>
		</td>
	</tr>
	<? if ($mega_db->recordCount() == 0) { ?>
	<tr>
		<td colspan="6" align="center">No Shared Template Part Available...</td>
	</tr>
	<? } else { ?>
		<? while ($mega_db->next()) { ?>
	<tr>
		<td valign="top" align="left"><?=$mega_db->currentRow()?>.</td>
		<td valign="top"><?=htmlentities($mega_db->row("tp_group"))?></td>
		<td valign="top"><a href="edit.php?tpid=<?=rawurlencode($mega_db->row("tp_id"))?>&seed=<?=mktime()?>"><?=htmlentities($mega_db->row("tp_id"))?></a></td>
		<td valign="top"><?=htmlentities($mega_db->row("tp_description"))?></td>
	</tr>
		<? } ?>
	<? } ?>
	<tr>
		<td colspan="5">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
            <td width="100%" height="1" bgcolor="#000000"></td>
            </tr>
            </table>
		</td>
	</tr>
	<tr>
		<td colspan="5"><input type="button" class="button" value="Add" onClick="location='add.php?seed=<?=mktime()?>'"></td>
	</tr>
	</form>
</table>
</body>
</html>
