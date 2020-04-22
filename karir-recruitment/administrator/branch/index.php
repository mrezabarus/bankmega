<?
	require_once("../config.inc.php");
	$branch=cmsDB2();
	$branch->query("SELECT * 
	                 FROM tbl_branch
	                 LEFT JOIN tbl_region ON tbl_branch.region_id = tbl_region.region_id
					 ORDER BY branch_id ");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>Untitled</title></head>
<link rel="stylesheet" type="text/css" href="../css/admin.css">
<body>
<table border="0" cellpadding="2" width="100%" bgcolor="#DEDEDE" cellspacing="0">
	<tr>
		<td colspan="4" background="../images/depan.jpg"><b><font color="#FFFFFF">Branch Area</font></b></td>
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
		<td><b>Branch Name</b></td>
		<td align="left"><strong>Region Name</strong></td>
	  <td><strong>Branch Descriptions</strong></td>
  </tr>
	<tr>
		<td colspan="4">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1" bgcolor="#000000"></td>
                </tr>
            </table>
		</td>
	</tr>
	<? if($branch->recordCount() == 0){ ?>
	<tr>
		<td colspan="4" align="center">No Member Available...</td>
	</tr>
	<? }else{ ?>
	<form>
		<?while($branch->next()){?>
			<tr>
				<td align="left"><?=$branch->currentRow();?>.</td>
				<td><a href="edit.php?branch_id=<?=$branch->row("branch_id");?>"><?=$branch->row("branch_name");?></a></td>
				<td align="left"><?=$branch->row("region_name");?></td>
			  <td><?=$branch->row("branch_desc");?></td>
			</tr>
		<? } ?>
	<? } ?>
	<tr>
		<td colspan="4">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1" bgcolor="#000000"></td>
                </tr>
            </table>
		</td>
	</tr>
	<tr>
		<td colspan="4"><input type="button" class="button" value="Add Branch" onClick="location='add.php?seed=<?=mktime()?>'"></td>
	</tr>
	</form>
	<tr>
		<td colspan="4">
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