<?
	require("_config.php");
	require("_lib.php");
	if (!isset($_POST['name']) || !isset($_POST['path']) || !$allow_mkdir) {
?>
<Table width="100%" height="90%">
	<tr>
		<td align="center" valign="middle"><a href="javascript:history.back();"><font face="arial,helvetica" size="2">File Manager Error : Missing Required Input or Not authorized to create sub directory!</font></a></td>
	</tr>
</table>
<?
		die();
	}
	$result = "devCMS | File Manager : Directory succesfuly created!";
	$is_invalidname = (@count(@split("[.\\?*#@^<>:|\"/]",$name)) > 1);
	if ($is_invalidname || @is_dir($RootPath.$path.$name)) $result = "devCMS | File Manager Error : Invalid directory name!";
	else {
		$rs = @mkdir($RootPath.$path.$name,0755);
		clearstatcache();
		if (!$rs) $result = "devCMS | File Manager Error : Unknown error occured while creating directory!";
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>devCMS | File Manager | Make new Sub-Directory</title>
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
