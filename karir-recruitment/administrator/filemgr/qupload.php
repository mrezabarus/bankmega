<?
	require("_config.php");

	$path = _flm_post_param("PATH",false);
	$path = _flm_pathfix($path);

	$upload_file = _flm_file_param("upload_file");
	$j = 0;
	for ($i=0;$i<count($upload_file['name']);$i++) {
		if ($upload_file['name'][$i]!="") {
			$result[$j]['name'] = $upload_file['name'][$i];
			$result[$j]['size'] = $upload_file['size'][$i];
			$result[$j]['type'] = $upload_file['type'][$i];
			$result[$j]['status'] = "Succesfully Uploaded!";
			if (!@file_exists($_FLM["ROOTPATH"].$path.$upload_file['name'][$i])) {
				//echo $upload_file['tmp_name'][$i]."|". $_FLM["ROOTPATH"].$path.$upload_file['name'][$i];
				copy($upload_file['tmp_name'][$i], $_FLM["ROOTPATH"].$path.$upload_file['name'][$i]);
				chmod ($_FLM["ROOTPATH"].$path.$upload_file['name'][$i], 755);
				//echo $_FLM["ROOTPATH"].$path.$upload_file['name'][$i];
				$chmod = "0755";    # File mode
				$file = $_FLM["ROOTPATH"].$path.$upload_file['name'][$i];    # file
				touch($file);
				eval("chmod(\"". $file ."\", ". $chmod .");");    
				//die();
			} else $result[$j]['status'] = "Error : File already exists!";
			$j++;
		}
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title><?=$_FLM["TITLE"]?> | Upload File Results...</title>
	<link rel="STYLESHEET" type="text/css" href="../css/flmgr.css">
</head>

<body topmargin="0" leftmargin="2" marginheight="2" marginwidth="2">
<table cellpadding="0" cellspacing="1" border="0" width="100%">
  <tr>
    <td bgcolor="#CCCCCC"><img border="0" src="<?=$_FLM_IMGURL?>b.gif" width="1" height="1"></td>
  </tr>
  <tr>
    <td class="flm_td_title1">
			<table cellpadding="2" width="100%">
				<tr>
		            <td background="../images/depan.jpg"><b><font color="#FFFFFF">Upload Files - Result</font></b></td>
				</tr>
			</table>
		</td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC"><img border="0" src="<?=$_FLM_IMGURL?>b.gif" width="1" height="1"></td>
  </tr>
	<tr>
		<td>
			<table cellpadding="3" cellspacing="1" border="0" width="100%">
				<tr>
					<td class="flm_td_title2"><b>Filename</b></td>
					<td class="flm_td_title2" align="right"><b>Size</b></td>
					<td class="flm_td_title2"><b>Type</b></td>
					<td class="flm_td_title2"><b>Status</b></td>
				</tr>
<?		
	if ($j==0) {
?>
				<tr>
					<td colspan="4" class="flm_td" align="center">No File is Uploaded!</td>
				</tr>
<?
		} else {
			for ($i=0;$i<$j;$i++) {
				$css_class = ($i+1) % 2 == 1?"class=\"flm_td_odd\"":"class=\"flm_td_even\"";
?>
				<tr>
					<td <?=$css_class?>><?=htmlentities(_flm_truncfname($result[$i]["name"],20))?></td>
					<td <?=$css_class?> align=right><?=_flm_fsizer($result[$i]["size"])?></td>
					<td <?=$css_class?>><?=$result[$i]["type"]?></td>
					<td <?=$css_class?>><?=$result[$i]["status"]?></td>
			  </tr>
<?
			}
		}
?>
			</table>
	  </td>
	</tr>
  <tr>
    <td bgcolor="#CCCCCC"><img border="0" src="<?=$_FLM_IMGURL?>b.gif" width="1" height="1"></td>
  </tr>
	<form action="fupload.php?<?=$_instanceurl?>" method="post">
	<input type="hidden" name="PATH" value="<?=$path?>">
	<tr>
		<td align="center">
			<table cellpadding="1">
				<tr>
					<td><input class="flm_button" type="submit" value=" Upload More! "> <input class="flm_button" type="button" value="Back to File List!" onClick="location = 'filelist.php?PATH=<?=rawurlencode($path)?>&<?=$_instanceurl?>&SEED=<?=mktime()?>'"></td>
				</tr>
			</table>
		</td>
	</tr>
	</form>
  <tr>
    <td bgcolor="#CCCCCC"><img border="0" src="<?=$_FLM_IMGURL?>b.gif" width="1" height="1"></td>
  </tr>
</table>
<? clearstatcache(); ?>
</body>
</html>
