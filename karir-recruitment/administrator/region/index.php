<?
	require_once("../config.inc.php");
	$region=cmsDB2();
	$region->query("SELECT * FROM tbl_region");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>Untitled</title></head>
<link rel="stylesheet" type="text/css" href="../css/admin.css">
<body>
<table border="0" cellpadding="2" width="100%" bgcolor="#DEDEDE" cellspacing="0">
	<tr>
		<td colspan="4" background="../images/depan.jpg"><b><font color="#FFFFFF">Region Area</font></b></td>
	</tr>
	<tr>
		<td colspan="4">
                <table border="0" cellpadding="4" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1"></td>
                </tr>
            </table>		</td>
	</tr>
	<tr>
		<td width="20" align="left"><b>No.</b></td>
		<td><strong>Region Name </strong></td>
		<td><strong>Region Decscription </strong></td>
	</tr>
	<tr>
		<td colspan="4">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1" bgcolor="#000000"></td>
                </tr>
            </table>		</td>
	</tr>
	<? if($region->recordCount() == 0){ ?>
	<tr>
		<td colspan="4" align="center">No Member Available...</td>
	</tr>
	<? }else{ ?>
	<form>
		<?while($region->next()){?>
			<tr>
				<td align="left"><?=$region->currentRow();?>.</td>
				<td><a href="edit.php?region_id=<?=$region->row("region_id");?>">
				  <?=$region->row("region_name");?>
				</a></td>
			  <td><?=$region->row("region_desc");?></td>
			</tr>
		<? } ?>
	<? } ?>
	<tr>
		<td colspan="4">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1" bgcolor="#000000"></td>
                </tr>
            </table>		</td>
	</tr>
	<tr>
		<td colspan="4"><input type="button" class="button" value="Add Region" onClick="location='add.php?seed=<?=mktime()?>'"></td>
	</tr>
	</form>
	<tr>
		<td colspan="4">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1"></td>
                </tr>
            </table>		</td>
	</tr>
</table>
</body>
</html>