<?
	require("_config.php");
	require("_lib.php");
	if (!isset($_POST['chkFile']) || !isset($_POST['path'])) {
?>
<Table width="100%" height="90%">
	<tr>
		<td align="center" valign="middle"><a href="javascript:history.back();"><font face="arial,helvetica" size="2">File Manager Error : Missing Required Input!</font></a></td>
	</tr>
</table>
<?
		die();
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>devCMS | File Manager | Delete File Confirmation</title>
	<style>
		.flat {border:solid 1 black; font-family:verdana,helvetica; font-size:8pt;}
	</style>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
<!--
		function setCheck(frm,state) {
			frmEL = frm.elements;
			for (i=0;i<frmEL.length;i++) 
				if (frmEL[i].name=='chkFile[]') frmEL[i].checked = state;
		}
//-->
</SCRIPT></head>

<body>
<table cellpadding="3" cellspacing="2" border="0" width="100%">
	<form action="qdelete.php" method="post">
	<input type="Hidden" name="path" value="<?=$path?>">
	<tr bgcolor="#DEDEDE">
		<td width="100%" colspan="3"><font face="arial" size="2" color="#FF0000"><b>Please reselect file you want to delete!</b></font></td>
	</tr>
	<tr bgcolor="#DEDEDE">
		<td width="1%"><input type="checkbox" onclick="setCheck(this.form,this.checked)"></td>
		<td width="60%"><font face="arial,helvetica" size="2"><b>Filename</b></font></td>
		<td width="39%" align="right"><font face="arial,helvetica" size="2"><b>Size</b></font></td>
	</tr>
<?
	foreach ($_POST['chkFile'] as $el) {
?>	<tr bgcolor="#EEEEEE">
	<td width="1%"><input type="checkbox" name="chkFile[]" value="<?=htmlentities($el)?>"></td>
	<td width="60%"><font face="arial,helvetica" size="2"><?=htmlentities(TruncateFilename(basename($RootPath.$path.$el),20))?></font></td>
	<td width="39%" align="right"><font face="arial,helvetica" size="2"><?=FileSizeKB($RootPath.$path.$el)."KB"?></font></td>
</tr>
<?
	}
?>
		<tr bgcolor="#DEDEDE">
			<td width="100%" colspan="3"><input class="flat" type="submit" value="Delete File!">  <input class="flat" type="button" value="    Back!    " onclick="location='filelist.php?path=<?=rawurlencode($path)."&SEED=".rawurlencode(date("mdYhis"))?>';"></td>
		</tr>
	</form>
</table>
</body>
</html>
