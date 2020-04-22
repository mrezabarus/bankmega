<?
	require_once("../../config.inc.php");
	//$mega_db->query("SELECT * FROM tadmingroup order by group_name asc");
	$mega_db = cmsDB2();
	$mega_db->query("SELECT * 
					 FROM tbl_group
					 ORDER BY group_name asc");
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
		<td colspan="4" background="../../images/depan.jpg"><b><font color="#FFFFFF">Internal HRM Group</font></b></td>
	</tr>
	<tr>
		<td colspan="4">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1"></td>
                </tr>
            </table>		</td>
	</tr>
	<tr>
		<td width="56" align="left"><b>No.</b></td>
	  <td width="933"><b>Group Name</b></td>
  </tr>
	<tr>
		<td colspan="4">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1" bgcolor="#000000"></td>
                </tr>
            </table>		</td>
	</tr>
	<? if($mega_db->recordCount() == 0){?>
	<tr>
		<td colspan="4" align="center">No Group Available...</td>
	</tr>
	<? }else{ ?>
	<form>
		<? while($mega_db->next()){ ?>
			<tr>
				<td align="left"><?=$mega_db->currentRow();?>.</td>
			  <td><a href="edit.php?gid=<?=$mega_db->row("group_id");?>">
			    <?=$mega_db->row("group_name");?></a></td>
			</tr>
		<? }
		} ?>
	<tr>
		<td colspan="4">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1" bgcolor="#000000"></td>
                </tr>
            </table>		</td>
	</tr>
	<tr>
		<td colspan="4"><input type="button" class="button" value="Add Group" onClick="location='add.php?seed=<?=mktime()?>'"></td>
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