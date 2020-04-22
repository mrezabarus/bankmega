<?
	require("_config.php");
	require("_lib.php");
	if (!isset($_POST['path']) || !$allow_rmdir) {
?>
<Table width="100%" height="90%">
	<tr>
		<td align="center" valign="middle"><a href="javascript:history.back();"><font face="arial,helvetica" size="2">File Manager Error : Missing Required Input or Not authorized to delete directories!</font></a></td>
	</tr>
</table>
<?
		die();
	}
	$result = "devCMS | File Manager : Directory deleted succesfuly!";
	$invalid_path = (count(explode("../",$RootPath.$path))>1) || (count(explode("..\\",$RootPath.$path))>1);
	if (strcmp(trim($RootPath.$path),trim($RootPath))==0 || $invalid_path || !@is_dir($RootPath.$path)) $result = "devCMS | File Manager Error : Invalid directory name!";
	else {
		$rs = @rmdir($RootPath.$path);
		clearstatcache();
		if (!$rs) $result = "devCMS | File Manager Error : Unknown error occured while deleting directory!";
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>devCMS | File Manager | Remove Directory</title>
</head>

<body>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
<!--
	alert('<?=$result?>');
	location='filelist.php?path=<?=rawurlencode($path)."&SEED=".rawurlencode(date("mdYhis"))?>';
//-->
</SCRIPT>
</body>
</html>
