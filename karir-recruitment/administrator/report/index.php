<? 
	require_once("../config.inc.php");
	
	$strSQL = "select * from tbl_report order by report_id asc";
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
		<td colspan="6" background="../images/depan.jpg"><b><font color="#FFFFFF">Report List</font></b></td>
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
		<td align="right"><b>ID</b></td>
		<td><b>Report Name</b></td>
		<td><b>Coloumn</b></td>
		<td><b>Start Row</b></td>
		<td><b>End Row</b></td>
		<td align="center">File Name</td>
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
		<td colspan="6" align="center">No Report Available...</td>
	</tr>
	<? } else { ?>
		<? while ($mega_db->next()) { ?>
			<tr>
					<td valign="top" align="right"><?=$mega_db->row("report_id")?>.</td>
					<td valign="top"><a href="edit.php?report_id=<?=rawurlencode($mega_db->row("report_id"))?>&seed=<?=mktime()?>"><?=htmlentities($mega_db->row("report_name"))?></a></td>
					<td valign="top"><?=htmlentities($mega_db->row("col_1"))?>,<?=htmlentities($mega_db->row("col_2"))?></td>
					<td valign="top"><?=htmlentities($mega_db->row("start_row"))?></td>
					<td valign="top"><?=htmlentities($mega_db->row("end_row"))?></td>
					<td valign="top" align="left"><?=htmlentities($mega_db->row("file_name"))?></td>
					
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
