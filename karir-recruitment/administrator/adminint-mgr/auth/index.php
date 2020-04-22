<?
	require_once("../../config.inc.php");
	$mega_db->query("SELECT * FROM tbl_authorization");
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
		<td colspan="3" background="../../images/depan.jpg"><b><font color="#FFFFFF">Authorization Manager</font></b></td>
	</tr>
	<tr>
		<td colspan="3">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1"></td>
                </tr>
            </table>
		</td>
	</tr>
	<tr>
		<td width="20" align="right"><b>No.</b></td>
		<td><b>Authorization Name</b></td>
		<td><b>Description</b></td>
	</tr>
	<tr>
		<td colspan="3">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1" bgcolor="#000000"></td>
                </tr>
            </table>
		</td>
	</tr>
	<? if($mega_db->recordCount() == 0){?>
	<tr>
		<td colspan="3" align="center">No Authorization Available...</td>
	</tr>
	<? }else{ ?>
	<form>
		<? while($mega_db->next()){ ?>
			<tr>
				<td align="right"><?=$mega_db->currentRow();?>.</td>
				<td><a href="edit.php?auth_id=<?=$mega_db->row("auth_id");?>"><?=$mega_db->row("auth_name");?></a></td>
				<td><? if(strlen($mega_db->row("auth_desc"))){echo $mega_db->row("auth_desc"); }else{ echo "..";}?></td>
			</tr>
	<? 	}
	 } 
	?>
	<tr>
		<td colspan="3">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1" bgcolor="#000000"></td>
                </tr>
            </table>
		</td>
	</tr>
	<tr>
		<td colspan="3"><!--<input type="button" class="button" value="Add Authorization" onclick="location='add.php?seed=<?=mktime()?>'">--></td>
	</tr>
	</form>
	<tr>
		<td colspan="3">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1"></td>
                </tr>
            </table>
		</td>
	</tr>
</table>
</body>
</html>