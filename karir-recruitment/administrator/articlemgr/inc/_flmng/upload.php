<?
	require ("_config.php");
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
	<title>devCMS | File Manager | Upload File(s)</title>
	<style>
		.flat {border:solid 1 black; font-family:verdana,helvetica; font-size:8pt;}
	</style>
</head>

<body>
<Table width="100%" height="100%">
	<tr>
		<td align="center" valign="middle">
			<table>
				<form action="qupload.php" method="post" enctype="multipart/form-data">
				<input type="hidden" name="path" value="<?=htmlentities($path)?>">
				<tr>
					<td align="right"><font face="arial,helvetica" size="2">File-1 : </font></td>
					<td><input class="flat" type="file" name="upload_file[]"></td>
				</tr>
				<tr>
					<td align="right"><font face="arial,helvetica" size="2">File-2 : </font></td>
					<td><input class="flat" type="file" name="upload_file[]"></td>
				</tr>
				<tr>
					<td align="right"><font face="arial,helvetica" size="2">File-3 : </font></td>
					<td><input class="flat" type="file" name="upload_file[]"></td>
				</tr>
				<tr>
					<td align="right"><font face="arial,helvetica" size="2">File-4 : </font></td>
					<td><input class="flat" type="file" name="upload_file[]"></td>
				</tr>
				<tr>
					<td align="right"><font face="arial,helvetica" size="2">File-5 : </font></td>
					<td><input class="flat" type="file" name="upload_file[]"></td>
				</tr>
				<tr>
					<td align="right"></td>
					<td><input class="flat" type="submit" value=" Upload! "> <input class="flat" type="button" value="  Back!  " onclick="location='filelist.php?path=<?=rawurlencode($path)."&SEED=".rawurlencode(date("mdYhis"))?>';"></td>
				</tr>
				</form>
			</table>
		</td>
	</tr>
</table>
</body>
</html>
