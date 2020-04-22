<?
	require_once("../config.inc.php");
	$lastjob=cmsDB2();
	$lastjob->query("SELECT * FROM tbl_lastjob order by lst_id asc");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>Untitled</title></head>
<link rel="stylesheet" type="text/css" href="../css/admin.css">
<body>
<table border="0" cellpadding="2" width="100%" bgcolor="#DEDEDE" cellspacing="0">
	<tr>
		<td colspan="4" background="../images/depan.jpg"><b><font color="#FFFFFF">List Pengalaman Kerja</font></b></td>
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
		<td><strong>Pengalaman Kerja</strong></td>
      <td>&nbsp;</td>
  </tr>
	<tr>
		<td colspan="4">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1" bgcolor="#000000"></td>
                </tr>
            </table>		</td>
	</tr>
	<? if($lastjob->recordCount() == 0){ ?>
	<tr>
		<td colspan="3" align="center">No Pengalaman Kerja</td>
	</tr>
	<? }else{ ?>
	<form>
		<? while($lastjob->next()){?>
			<tr>
				<td align="left"><?=$lastjob->currentRow();?>.</td>
				<td><a href="edit.php?lst_id=<?=$lastjob->row("lst_id");?>"><?=$lastjob->row("job_name");?></a></td>
		      <td>&nbsp;</td>
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
		<td colspan="4"><input type="button" class="button" value="Add Pengalaman" onClick="location='add.php?seed=<?=mktime()?>'"></td>
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