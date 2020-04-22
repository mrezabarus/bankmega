<? 
	$strSQL = "select * from tbl_chartmember where chart_id=" . $_GET["chart_id"];
	$mega_db->query($strSQL);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<table border="0" cellpadding="2" width="100%" bgcolor="#DEDEDE" cellspacing="0">
	<tr>
		<td colspan="3" background="../images/depan.jpg"><b><font color="#FFFFFF">Chart Value</font></b></td>
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
		<td width="20" align="right">&nbsp;</td>
		<td><b>Chart Legend</b></td>
		<td><b>Chart Value</b></td>
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
	<form>
	<? } else { ?>
		<? while ($mega_db->next()) { ?>
			<tr>
					<td align="right">&nbsp;</td>
					<td valign="top"><a href="edit_child.php?chart_id=<?=rawurlencode($mega_db->row("chart_id"))?>&chartchild_id=<?=rawurlencode($mega_db->row("chartchild_id"))?>&seed=<?=mktime()?>"><?=htmlentities($mega_db->row("chart_desc"))?></a></td>
					<td valign="top"><?=htmlentities($mega_db->row("chart_value"))?></td>
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
		<td colspan="6"><input type="button" class="button" value="Add Child" onclick="location='add_child.php?chart_id=<?=$_GET["chart_id"]?>&seed=<?=mktime()?>'"></td>
	</tr>
	</form>
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