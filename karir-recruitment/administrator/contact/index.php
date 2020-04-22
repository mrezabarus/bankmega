<?
	require_once("../config.inc.php");
	$mega_db->query("SELECT * FROM tbl_contact");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>Untitled</title></head>
<link rel="stylesheet" type="text/css" href="../css/admin.css">
<body>
<table border="0" cellpadding="2" width="100%" bgcolor="#DEDEDE" cellspacing="0">
	<tr>
		<td colspan="5" background="../images/depan.jpg"><b><font color="#FFFFFF">Contact</font></b></td>
	</tr>
	<tr>
		<td colspan="5">
                <table border="0" cellpadding="4" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1"></td>
                </tr>
            </table>		</td>
	</tr>
	<tr>
		<td width="20" align="right"><b>No.</b></td>
		<td><b>Nama</b></td>
		<td><b>Department</b></td>
		<td><b>Division</b></td>
	  <td><b>Email</b></td>
	</tr>
	<tr>
		<td colspan="5">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1" bgcolor="#000000"></td>
                </tr>
            </table>		</td>
	</tr>
	<? if($mega_db->recordCount() == 0){ ?>
	<tr>
		<td colspan="5" align="center">No Member Available...</td>
	</tr>
	<? }else{ ?>
	<form>
		<?while($mega_db->next()){?>
			<tr>
				<td align="right"><?=$mega_db->currentRow();?>.</td>
				<td><a href="edit.php?contact_id=<?=$mega_db->row("contact_id");?>"><?=$mega_db->row("contact_name");?></a></td>
				<td><?=$mega_db->row("dept");?></td>
				<td><?=$mega_db->row("divisi");?></td>
				<td><?=$mega_db->row("email");?></td>
			</tr>
		<? } ?>
	<? } ?>
	<tr>
		<td colspan="5">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1" bgcolor="#000000"></td>
                </tr>
            </table>		</td>
	</tr>
	<tr>
		<td colspan="5"><input type="button" class="button" value="Add Contact" onClick="location='add.php?seed=<?=mktime()?>'"></td>
	</tr>
	</form>
	<tr>
		<td colspan="5">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1"></td>
                </tr>
            </table>		</td>
	</tr>
</table>
</body>
</html>