<?
	require("_config.php");
	if (!isset($_POST['path'])) {
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
	<title>devCMS | File Manager | Make new Sub-Directory</title>
	<style>
		.flat {border:solid 1 black; font-family:verdana,helvetica; font-size:8pt;}
	</style>
</head>

<body>
<Table width="100%" height="95%">
	<tr>
		<td align="center" valign="middle">
			<table>
				<form action="qmkdir.php" method="post">
				<input type="hidden" name="path" value="<?=htmlentities($path)?>">
				<tr>
					<td align="center"><font face="arial,helvetica" size="2">New Sub-Directory Name</font></td>
				</tr>
				<tr>
					<td align="center"><input class="flat" type="Text" name="name" maxlength="255" size="30"></td>
				</tr>
				<tr>
					<td align="center"><input class="flat" type="submit" value="   Go!   "> <input class="flat" type="button" value=" Back! " onclick="location='filelist.php?path=<?=rawurlencode($path)."&SEED=".rawurlencode(date("mdYhis"))?>';"></td>
				</tr>
				</form>
			</table>
		</td>
	</tr>
</table>
</body>
</html>
