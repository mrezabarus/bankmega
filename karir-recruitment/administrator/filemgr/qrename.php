<?
	require("_config.php");

	$fcount = !is_numeric(_flm_post_param("FILECOUNT",false))?false:_flm_post_param("FILECOUNT",false);
	$path = _flm_post_param("PATH",false);
	$path = _flm_pathfix($path);
	$arrResult = array();
	$ctr = 0;
	
	for ($i = 1; $i <= $fcount; $i++) {
		$foo_oldname = _flm_post_param("OLDNAME_".$i,"");
		$foo_newname = _flm_post_param("NEWNAME_".$i,"");
		if (trim($foo_oldname) != "") {
			$pinfo_new = pathinfo($foo_newname);
			$old_invalid = !is_file($_FLM["ROOTPATH"].$path.$foo_oldname) || _flm_invalidfname($foo_oldname);
			$new_invalid = is_file($_FLM["ROOTPATH"].$path.$foo_newname) || _flm_invalidfname($foo_newname) || !_flm_isvalid_ext($pinfo_new["extension"]) || !_flm_isvalid_file($foo_newname);
			$arrResult[$ctr] = array();
			$arrResult[$ctr][0] = $foo_oldname;
			$arrResult[$ctr][1] = $foo_newname;
			if (!$new_invalid && !$old_invalid) {
				$result = @rename($_FLM["ROOTPATH"].$path.$foo_oldname,$_FLM["ROOTPATH"].$path.$foo_newname);
				$arrResult[$ctr][2] = $result?"Renamed Succesfully":"Unknown Error!";
			} else {
				$arrResult[$ctr][2] = "Invalid Filename or File Already Exists!";
			}
			$ctr++;
		}
	}
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title><?=$_FLM["TITLE"]?> | Rename File Results...</title>
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
					<td class="flm_td_title1" align="left"><b>Rename File(s) - Result!</b></td>
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
					<td class="flm_td_title2"><b>Old Filename</b></td>
					<td class="flm_td_title2"><b>New Filename</b></td>
					<td class="flm_td_title2"><b>Status</b></td>
				</tr>
<?
	if (count($arrResult)>0) {
		$i = 0;
		foreach ($arrResult as $el) {
			$css_class = ($i+1) % 2 == 1?"class=\"flm_td_odd\"":"class=\"flm_td_even\"";
			$i++;
?>	
				<tr>
					<td <?=$css_class?> width="40%"><?=htmlentities(_flm_truncfname($el[0],20))?></td>
					<td <?=$css_class?> width="40%"><?=htmlentities(_flm_truncfname($el[1],20))?></td>
					<td <?=$css_class?> width="20%"><?=$el[2]?></td>
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
