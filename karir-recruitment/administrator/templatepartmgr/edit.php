<? 
	require_once("../config.inc.php");
	
	$qlang = cmsDB();
	$qgroup = cmsDB();
	$qedition = cmsDB();

	$part_id = templateValidateID(uriParam("tpid",""));
	
	$strSQL = "SELECT tp_id,tp_group,tp_description,custom_charset,ttemplate_part.language_id,tlanguage.charset,edition_id
	           FROM ttemplate_part 
			   LEFT JOIN tlanguage ON ttemplate_part.language_id = tlanguage.language_id 
			   WHERE tp_id = '".$part_id."'";
	$mega_db->query($strSQL);
	
	if ($mega_db->recordCount() == 0) {
		jsAlertAndNavigate("Record doesn't exists","index.php?seed=".mktime());
		die();
	}
	
	$strSQL = "SELECT * from tlanguage";
	$qlang->query($strSQL);
	$strSQL = "SELECT DISTINCT tp_group from ttemplate_part WHERE tp_group <> ''";
	$qgroup->query($strSQL);
	
	$mega_db->next();
	
	$fpath = templateFullPath($mega_db->row("tp_id"),true);
	//echo $fpath;
	//die();
	$fd = fopen($fpath, "r");
	$fcontent = fread($fd, filesize($fpath));
	fclose($fd);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title><?=$FJR_VARS["admin_title"]?> - Shared Template Part Manager - Edit Part</title>
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
	<? if ($mega_db->row("charset") != "") { ?>
	<meta http-equiv="Content-Type" content="text/html; charset=<?=$mega_db->row("charset")?>">
	<? } else if ($mega_db->row("custom_charset") != "") { ?>
	<meta http-equiv="Content-Type" content="text/html; charset=<?=$mega_db->row("custom_charset")?>">
	<? } ?>
	<SCRIPT LANGUAGE="JavaScript" SRC="../js/misc.js" TYPE="text/javascript"></SCRIPT>
</head>

<body>
<table border="0" cellpadding="2" width="100%" bgcolor="#DEDEDE" cellspacing="0">
	<form name="frmEdit" action="qedit.php" method="post">
	<input type="hidden" name="TPID" value="<?=htmlentities($part_id)?>">
	<tr>
		<td background="../images/depan.jpg"><b><font color="#FFFFFF">Shared Template Part Manager - Edit Part</font></b></td>
	</tr>
	<tr>
		<td>
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
            <td width="100%" height="1"></td>
            </tr>
            </table>
		</td>
	</tr>
	<tr>
		<td>
			<table border="0" cellpadding="2" cellspacing="0">
				<tr>
					<td>Part ID</td>
					<td>:</td>
					<td colspan="3"><b><?=htmlentities($mega_db->row("tp_id"))?></b></td>
			  </tr>
				<tr>
					<td>Description</td>
					<td>:</td>
					<td colspan="3"><input type="text" name="DESC" size="20" maxlength="255" class="text" value="<?=htmlentities($mega_db->row("tp_description"))?>"></td>
				</tr>
				<tr>
					<td>New Group</td>
					<td>:</td>
					<td colspan="3"><input type="text" name="NEWGROUP2" size="20" maxlength="255" class="text"></td>
				</tr>
				<tr>
					<td>Group</td>
					<td>:</td>
					<td colspan="3"><select name="GROUP" class="select">
						<option value="" <?=strtolower(trim($qgroup->row("tp_group"))) == ""?"selected":""?>>New Group 
						<? while ($qgroup->next()) { ?>
						<option value="<?=htmlentities($qgroup->row("tp_group"))?>" <?=strtolower(trim($qgroup->row("tp_group"))) == strtolower(trim($mega_db->row("tp_group")))?"selected":""?>><?=htmlentities($qgroup->row("tp_group"))?>
						<? } ?>
					</select></td>
				</tr>
				<tr>
					<td colspan="5">Part Content</td>
				</tr>
				<tr>
					<td colspan="5"><textarea name="CONTENT" wrap="off" cols="66" rows="30" class="textarea"><?=htmlentities($fcontent)?></textarea></td>
				</tr>
			</table>
	  </td>
	</tr>
	<tr>
		<td>
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
            <td width="100%" height="1" bgcolor="#000000"></td>
            </tr>
            </table>
		</td>
	</tr>
	<tr>
		<td>
			&nbsp;
			<input type="submit" class="button" value="    Update    "> 
			<input type="button" class="button" value="    Delete    " onClick="if (confirm('Are you sure you want to delete this Template Part?')) location='qdelete.php?tpid=<?=$part_id?>&seed=<?=mktime()?>';"> 
			<input type="button" class="button" value="   Back   " onClick="location='index.php?seed=<?=mktime()?>'"></td>
	</tr>
	</form>
</table>
</body>
</html>
