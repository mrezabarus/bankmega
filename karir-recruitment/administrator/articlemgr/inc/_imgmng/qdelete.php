<?
	require("_config.php");
	require("_lib.php");
	if (!isset($_POST['chkFile']) || !isset($_POST['path']) || !$allow_delete) {
?>
<Table width="100%" height="90%">
	<tr>
		<td align="center" valign="middle"><a href="javascript:history.back();"><font face="arial,helvetica" size="2">File Manager Error : Missing Required Input or Not authorized to delete files!</font></a></td>
	</tr>
</table>
<?
		die();
	}
	
	$arrresult = array();
	foreach ($_POST['chkFile'] as $el) {
		$delresult = @unlink($RootPath.$path.$el);
		$arrresult[$el] = $delresult!=false?"Deleted":"Error while deleting file";
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>devCMS | File Manager | File Deletion</title>
	<style>
		.flat {border:solid 1 black; font-family:verdana,helvetica; font-size:8pt;}
	</style>
</head>

<body>
<table cellpadding="3" cellspacing="2" border="0" width="100%">
	<tr bgcolor="#DEDEDE">
		<td width="60%"><font face="arial,helvetica" size="2"><b>Filename</b></font></td>
		<td width="40%"><font face="arial,helvetica" size="2"><b>Status</b></font></td>
	</tr>
<?
	foreach ($_POST['chkFile'] as $el) {
?>	<tr bgcolor="#EEEEEE">
	<td width="60%"><font face="arial,helvetica" size="2"><?=htmlentities(TruncateFilename(basename($RootPath.$path.$el),20))?></font></td>
	<td width="40%"><font face="arial,helvetica" size="2"><?=$arrresult[$el]?></font></td>
</tr>
<?
	}
?>
		<tr bgcolor="#DEDEDE">
			<td width="100%" colspan="2" align="center"><input class="flat" type="button" value=" Back! " onclick="location='filelist.php?path=<?=rawurlencode($path)."&SEED=".rawurlencode(date("mdYhis"))?>';"></td>
		</tr>
</table>
</body>
</html>
