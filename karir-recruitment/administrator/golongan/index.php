<?
	require_once("../config.inc.php");
	$grade=cmsDB2();
	$strSQL = "SELECT * 
			  FROM tbl_golongan
			  ORDER BY gol_id asc";
	$grade->query($strSQL);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>Untitled</title></head>
<link rel="stylesheet" type="text/css" href="../css/admin.css">
<body>
<table border="0" cellpadding="2" width="100%" bgcolor="#DEDEDE" cellspacing="0">
	<tr>
		<td colspan="4" background="../images/depan.jpg"><b><font color="#FFFFFF">Grade</font></b></td>
  </tr>
	<tr>
		<td colspan="4">
                <table border="0" cellpadding="4" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1"></td>
                </tr>
            </table>
		</td>
	</tr>
	<tr>
		<td width="20" align="left"><b>No.</b></td>
		<td><b>Grade Name</b></td>
	  <td><strong>Descriptions</strong></td>
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
	<? if($grade->recordCount() == 0){ ?>
	<tr>
		<td colspan="3" align="center">No Grade Available...</td>
	</tr>
	<? }else{ ?>
	<form>
		<? while($grade->next()){?>
			<tr>
				<td align="left"><?=$grade->currentRow();?>.</td>
				<td><a href="edit.php?gol_id=<?=$grade->row("gol_id");?>"><?=$grade->row("name");?></a></td>
			  <td><?=$grade->row("description");?></td>
			</tr>
		<? } ?>
	<? } ?>
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
		<td colspan="3"><input type="button" class="button" value="Add Grade" onClick="location='add.php?seed=<?=mktime()?>'"></td>
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