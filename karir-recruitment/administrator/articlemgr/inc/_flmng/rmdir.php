<?
	require("_config.php");
	require("_lib.php");
	if (!isset($_POST['path'])) {
?>
		<Table width="100%" height="90%">
			<tr>
				<td align="center" valign="middle"><a href="javascript:history.back();"><font face="arial,helvetica" size="2">File Manager Error : Missing Required Input!</font></a></td>
			</tr>
		</table>
<?
	}
	
	$invalid_path = (count(explode("../",$RootPath.$path))>1) || (count(explode("..\\",$RootPath.$path))>1);
	if (strcmp(trim($RootPath.$path),trim($RootPath))==0 || $invalid_path) {
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>devCMS | File Manager | Remove Directory</title>
	<style>
		.flat {border:solid 1 black; font-family:verdana,helvetica; font-size:8pt;}
	</style>
</head>

<body>
	<table width="100%" height="95%">
		<tr>
			<td align="center" valign="middle">
				<table cellpadding="5">
					<tr>
						<td align="center"><a href="javascript:history.back();"><font face="arial,helvetica" size="2">File manager Error :<br>Cannot delete root directory or Invalid directory to delete!</font></a></td>
					</tr>
					<form>
					<tr>
						<td align="center" valign="top"><input class="flat" type="button" value="Close!" onclick="self.close();"></td>
					</tr>
					</form>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>
<?
	} else {
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>devCMS | File Manager | Remove Directory</title>
	<style>
		.flat {border:solid 1 black; font-family:verdana,helvetica; font-size:8pt;}
	</style>
</head>

<body>
	<table width="100%" height="95%">
		<tr>
			<td align="center" valign="middle">
				<table cellpadding="5">
					<tr>
						<td align="center"><font face="arial,helvetica" size="2">You're about to delete <?=htmlentities(TruncateFilename($path,50))?>.<br>Are you sure you want to proceed?</font></td>
					</tr>
					<form action="qrmdir.php" method="post">
					<input type="Hidden" name="path" value="<?=htmlentities($path)?>">
					<tr>
						<td align="center" valign="top"><input class="flat" type="submit" value="Delete Directory!"> <input class="flat" type="button" value=" Back! " onclick="location='filelist.php?path=<?=rawurlencode($path)."&SEED=".rawurlencode(date("mdYhis"))?>';"></td>
					</tr>
					</form>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>
<?
	}
?>
