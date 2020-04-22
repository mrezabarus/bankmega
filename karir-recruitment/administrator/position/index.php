<?
	require_once("../config.inc.php");
	$position=cmsDB2();
	$position->query("SELECT * 
	                 FROM tbl_position
					 INNER JOIN tbl_cat_posisiton ON tbl_cat_posisiton.catpos_id = tbl_position.catpos_id
					 ORDER BY tbl_position.position_name ");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>Untitled</title></head>
<link rel="stylesheet" type="text/css" href="../css/admin.css">
<body>
<table border="0" cellpadding="2" width="100%" bgcolor="#DEDEDE" cellspacing="0">
	<tr>
		<td colspan="4" background="../images/depan.jpg"><b><font color="#FFFFFF">Position</font></b></td>
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
		<td><b>Position Name</b></td>
	    <td><b>Catagory Posisi</b></td>
	    <td><strong>Position Descriptions</strong></td>
  </tr>
	<tr>
		<td colspan="4">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1" bgcolor="#000000"></td>
                </tr>
            </table>		</td>
	</tr>
	<? if($position->recordCount() == 0){ ?>
	<tr>
		<td colspan="4" align="center">No Position Available...</td>
	</tr>
	<? }else{ ?>
	<form>
		<?while($position->next()){?>
			<tr>
				<td align="left"><?=$position->currentRow();?>.</td>
				<td><a href="edit.php?position_id=<?=$position->row("position_id");?>"><?=$position->row("position_name");?></a></td>
			    <td><?=$position->row("category_name");?></td>
		      <td><?=$position->row("position_desc");?></td>
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
		<td colspan="4"><input type="button" class="button" value="Add Position" onClick="location='add.php?seed=<?=mktime()?>'"></td>
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