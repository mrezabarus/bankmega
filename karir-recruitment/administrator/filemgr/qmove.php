<?
	require("_config.php");

	$path = _flm_post_param("PATH",false);
	$selpath = _flm_post_param("SELPATH",false);
	$filecount = _flm_post_param("FILECOUNT",0);
	
	$files = array();

	for ($i = 1; $i <= $filecount; $i++) {
		if (trim(_flm_post_param("FILEID_".$i,"")) != "")
			$files[count($files)] = _flm_post_param("FILEID_".$i,"");
	}
	$path = _flm_pathfix($path);
	$selpath = _flm_pathfix($selpath);
	$arrResult = array();
	$ctr = 0;
	
		foreach ($files as $el) {
			$pinfo_new = pathinfo($el);
			if (_flm_invalidfname($el) || !_flm_isvalid_ext($pinfo_new["extension"]) || !_flm_isvalid_file($el)) {
				$arrResult[$el] = "<font color=\"#ff0000\">File cannot be moved!</font>";
			} elseif (@is_file($_FLM["ROOTPATH"].$selpath.$el)) {
				$arrResult[$el] = "<font color=\"#ff0000\">File already exists!</font>";
			} elseif ($path == $selpath) {
				$arrResult[$el] = "<font color=\"#ff0000\">Cannot move file, source and destination folder are the same!</font>";
			} else {
				$copy_result = @copy($_FLM["ROOTPATH"].$path.$el,$_FLM["ROOTPATH"].$selpath.$el);
				if ($copy_result) {
					$delete_result = @unlink($_FLM["ROOTPATH"].$path.$el);
					if ($copy_result && $delete_result)
						$arrResult[$el] = "File is moved!";
					else
						$arrResult[$el] = "<font color=\"#ff0000\">File is copied to destination folder but not succesfully moved!</font>";
				} else $arrresult[$el] = "<font color=\"#ff0000\">Cannot move file, unknown error occured while processing request!</font>";
			}
		}
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title><?=$_FLM["TITLE"]?> | Move File(s) - Result!</title>
	<LINK REL="StyleSheet" HREF="../css/flmgr.css" type="text/css">
</head>

<body topmargin="2" leftmargin="2" marginheight="2" marginwidth="2">
<table cellpadding="0" cellspacing="1" border="0" width="100%">
  <tr>
    <td bgcolor="#CCCCCC"><img border="0" src="<?=$_FLM_IMGURL?>b.gif" width="1" height="1"></td>
  </tr>
  <tr>
    <td class="flm_td_title1">
			<table cellpadding="2" width="100%">
				<tr>
					<td class="flm_td_title1" align="left"><b>Move File(s) - Result!</b></td>
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
					<td class="flm_td_title2"><b>Status</b></td>
				</tr>
<?
	if (count($arrResult)>0) {
		$i = 0;
		foreach ($files as $el) {
			$css_class = ($i+1) % 2 == 1?"class=\"flm_td_odd\"":"class=\"flm_td_even\"";
			$i++;
?>	
				<tr>
					<td <?=$css_class?> width="40%"><?=htmlentities(_flm_truncfname($el,20))?></td>
					<td <?=$css_class?> width="20%"><?=$arrResult[$el]?></td>
				</tr>
<?
		}
	} else {
?>	
				<tr>
					<td colspan="3" class="flm_td" align="center">No File is selected!</td>
				</tr>
<?
	}
?>
			</table>
		</td>
	</tr>
  <tr>
    <td bgcolor="#CCCCCC"><img border="0" src="<?=$_FLM_IMGURL?>b.gif" width="1" height="1"></td>
  </tr>
	<form>
  <tr>
    <td align="center">
			<table cellpadding="1">
				<tr>
					<td><input class="flm_button" type="button" value="Back to File List!" onClick="location = 'filelist.php?PATH=<?=rawurlencode($path)?>&<?=$_instanceurl?>&SEED=<?=mktime()?>'"></td>
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
