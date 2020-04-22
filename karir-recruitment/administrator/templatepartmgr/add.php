<? 
	require_once("../config.inc.php");
	
	$qlang = cmsDB();
	$qgroup = cmsDB();
	$qedition = cmsDB();
	
	$strSQL = "SELECT * from tlanguage";
	$qlang->query($strSQL);
	$strSQL = "SELECT DISTINCT tp_group from ttemplate_part WHERE tp_group <> ''";
	$qgroup->query($strSQL);
	
	$part_id = trim(postParam("TPID",""));
	$template_group = trim(postParam("GROUP",""));
	$template_newgroup = trim(postParam("NEWGROUP",""));
	$description = trim(postParam("DESC",""));
	$fcontent = trim(postParam("CONTENT",""));
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title><?=$FJR_VARS["admin_title"]?> - Shared Template Parts Manager - Add Part</title>
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
	<SCRIPT LANGUAGE="JavaScript" SRC="../js/taeditor.js" TYPE="text/javascript"></SCRIPT>
	<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
  <!--
  	var oContent;
		function editorInit() {
			oContent = new taEditor(document,document.frmAdd.CONTENT);
		}
  //-->
  </SCRIPT>
</head>
<body onLoad="editorInit()">
<table border="0" cellpadding="2" width="100%" bgcolor="#DEDEDE" cellspacing="0">
	<form name="frmAdd" action="qadd.php" method="post">
	<tr>
		<td background="../images/depan.jpg"><b><font color="#FFFFFF">Shared Template Parts Manager - Add Part</font></b></td>
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
					<td><input type="text" name="TPID" size="20" maxlength="255" class="text" value="<?=htmlentities($part_id)?>"></td>
			  </tr>
				<tr>
					<td>Description</td>
					<td>:</td>
					<td><input type="text" name="DESC" size="20" maxlength="255" class="text" value="<?=htmlentities($description)?>"></td>
				</tr>
				<tr>
					<td>New Group</td>
					<td>:</td>
					<td><input type="text" name="NEWGROUP2" size="20" maxlength="255" class="text"></td>
				</tr>
				<tr>
					<td>Group</td>
					<td>:</td>
					<td><select name="GROUP" class="select">
						<option value="">New Group
						<? while ($qgroup->next()) { ?>
						<option value="<?=htmlentities($qgroup->row("tp_group"))?>"<?=strtolower($qgroup->row("tp_group")) == strtolower($template_group)?"selected":""?>><?=htmlentities($qgroup->row("tp_group"))?>
						<? } ?>
					</select></td>
				</tr>
				<tr>
					<td colspan="3">Part Content :</td>
				</tr>
				<tr>
					<td colspan="3"><textarea name="CONTENT" cols="66" rows="30" class="textarea" wrap="off"><?=htmlentities($fcontent)?></textarea></td>
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
		<td>&nbsp;<input type="submit" class="button" value="    Save    "> <input type="button" class="button" value="  Cancel  " onClick="location='index.php?seed=<?=mktime()?>'"></td>
	</tr>
	</form>
</table>
</body>
</html>