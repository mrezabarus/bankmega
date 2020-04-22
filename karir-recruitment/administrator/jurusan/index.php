<?
	require_once("../config.inc.php");
	$jurusan=cmsDB2();
	$jurusan->query("SELECT * FROM tbl_jurusan");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>Untitled</title></head>
<link rel="stylesheet" type="text/css" href="../css/admin.css">
<body>
<table border="0" cellpadding="2" width="100%" bgcolor="#DEDEDE" cellspacing="0">
	<tr>
		<td colspan="4" background="../images/depan.jpg"><b><font color="#FFFFFF">List Jurusan</font></b></td>
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
		<td width="36" align="left"><b>No.</b></td>
		<td width="87"><strong>Kode</strong></td>
      <td width="864"><strong>Jurusan</strong></td>
  </tr>
	<tr>
		<td colspan="4">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1" bgcolor="#000000"></td>
                </tr>
            </table>		</td>
	</tr>
	<? if($jurusan->recordCount() == 0){ ?>
	<tr>
		<td colspan="3" align="center">No Jurusan Available...</td>
	</tr>
	<? }else{ ?>
	<form>
		<? while($jurusan->next()){?>
			<tr>
				<td align="left"><?=$jurusan->currentRow();?>.</td>
				<td><a href="edit.php?jur_id=<?=$jurusan->row("jur_id");?>"><?=$jurusan->row("code");?></a></td>
		      <td><?=$jurusan->row("jurusan");?></td>
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
		<td colspan="4"><input type="button" class="button" value="Add Jurusan" onClick="location='add.php?seed=<?=mktime()?>'"></td>
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