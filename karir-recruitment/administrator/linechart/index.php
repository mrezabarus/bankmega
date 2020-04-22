<? 
	require_once("../config.inc.php");
	
	$strSQL = "select * from tbl_chart order by chart_id asc";
	$mega_db->query($strSQL);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
<title><?=$FJR_VARS["admin_title"]?> -  Chart Manager</title>
<link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>

<body>
<form name="frmtemplate" action="index.php" method="post">
<table border="0" cellpadding="2" width="100%" bgcolor="#DEDEDE" cellspacing="0">
	<tr>
		<td colspan="6" background="../images/depan.jpg"><b><font color="#FFFFFF">Chart Manager</font></b></td>
	</tr>
	<tr>
		<td colspan="6">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td width="100%" height="1"></td>
			</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td align="left"><b>ID</b></td>
		<td><b>Name</b></td>
		<td><b>Descriptions</b></td>
		<td><b>x Title</b></td>
		<td><b>y Title</b></td>
		<td align="center"><b>Dimensi</b></td>
	</tr>
	<tr>
		<td colspan="6">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1" bgcolor="#000000"></td>
                </tr>
            </table>
		</td>
	</tr>
	<? if ($mega_db->recordCount() == 0) { ?>
	<tr>
		<td colspan="6" align="center">No Chart Available...</td>
	</tr>
	<? } else { ?>
		<? while ($mega_db->next()) { ?>
			<tr>
					<td valign="top" align="left"><?=$mega_db->row("chart_id")?>.</td>
					<td valign="top"><a href="edit.php?chart_id=<?=rawurlencode($mega_db->row("chart_id"))?>&seed=<?=mktime()?>"><?=htmlentities($mega_db->row("chart_name"))?></a></td>
					<td valign="top"><?=htmlentities($mega_db->row("chart_desc"))?></td>
					<td valign="top"><?=htmlentities($mega_db->row("x_title"))?></td>
					<td valign="top"><?=htmlentities($mega_db->row("y_title"))?></td>
					<td valign="top" align="center"><?=htmlentities($mega_db->row("panjang"))?> x <?=htmlentities($mega_db->row("lebar"))?></td>
					
	</tr>
			
		<? } ?>
	<? } ?>
	<tr>
		<td colspan="6">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1" bgcolor="#000000"></td>
                </tr>
            </table>
		</td>
	</tr>
	<tr>
		<td colspan="6"><input type="button" class="button" value="Add" onClick="location='add.php?seed=<?=mktime()?>'"></td>
	</tr>
	<tr>
		<td colspan="6">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1"></td>
                </tr>
            </table>
		</td>
	</tr>
</table>
</form>
</body>
</html>