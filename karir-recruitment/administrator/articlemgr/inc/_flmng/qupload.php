<?
	require("_config.php");
	require("_lib.php");
	if (!isset($_POST['path'])||!$allow_upload) {
?>
<Table width="100%" height="90%">
	<tr>
		<td align="center" valign="middle"><a href="javascript:history.back();"><font face="arial,helvetica" size="2">File Manager Error : Missing Required Input or Not authorized to upload files!</font></a></td>
	</tr>
</table>
<?
		die("");
	}
	
	$result = array();
	$j = 0;
	for ($i=0;$i<count($upload_file);$i++) {
		if ($upload_file_name[$i]!="") {
			$result[$j]['name'] = TruncateFilename($upload_file_name[$i],20);
			$result[$j]['size'] = ceil($upload_file_size[$i]/1024)."KB";
			$result[$j]['type'] = $upload_file_type[$i];
			$result[$j]['status'] = "Succesfully Uploaded!";
			if (!@file_exists($RootPath.$path.$upload_file_name[$i])) {
				if (in_array(strtoupper($upload_file_type[$i]),$upload_mimetypes)) {
					if(!@copy($upload_file[$i], $RootPath.$path.$upload_file_name[$i]))
						$result[$j]['status'] = "Error : Unknown Error!";
				} else $result[$j]['status'] = "Error : File type is not allowed!";
			} else $result[$j]['status'] = "Error : File already exists!";
			$j++;
		}
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>devCMS | File Manager | Upload File(s) Result</title>
	<style>
		.flat {border:solid 1 black; font-family:verdana,helvetica; font-size:8pt;}
	</style>
</head>
<body>
<Table width="100%" height="90%">
	<tr>
		<td align="center" valign="middle">
<Table>
<?		
	if ($j==0) {
?>
	<tr>
		<td colspan="4" align="center"><font face="arial,helvetica" size="2">No file is uploaded!</font></td>
	</tr>
<?
		} else {
?>	
	<tr bgcolor="DEDEDE">
		<td><font face="arial,helvetica" size="2"><b>Filename</b></font></td>
		<td align="right"><font face="arial,helvetica" size="2"><b>Size</b></font></td>
		<td><font face="arial,helvetica" size="2"><b>Type</b></font></td>
		<td><font face="arial,helvetica" size="2"><b>Status</b></font></td>
	</tr>
<?
		}
		
		for ($i=0;$i<$j;$i++) {
			echo "<tr bgcolor=EEEEEE>";
			echo "<td><font face=arial size=2>".TruncateFilename($result[$i]["name"],15)."</font></td>";
			echo "<td align=right><font face=arial size=2>".$result[$i]["size"]."</font></td>";
			echo "<td><font face=arial size=2>".$result[$i]["type"]."</font></td>";
			echo "<td><font face=arial size=2>".$result[$i]["status"]."</font></td>";
			echo "</tr>";
		}
		
		clearstatcache();
?>
	<form action="upload.php" method="post">
	<input type="hidden" name="path" value="<?=$path?>">
	<tr>
		<td colspan="4" align="center" bgcolor="#DEDEDE"><input class="flat" type="submit" value=" Upload More! "> <input class="flat" type="button" value="      Back!      " onclick="location='filelist.php?path=<?=rawurlencode($path)."&SEED=".rawurlencode(date("mdYhis"))?>';"></td>
	</tr>
	</form>
</table>
		</td>
	</tr>
</table>
</body>
</html>


