<?
	require("_config.php");

	$path = _flm_post_param("PATH",false);
	$filecount = _flm_post_param("FILECOUNT",0);
	
	$files = array();

	for ($i = 1; $i <= $filecount; $i++) {
		if (trim(_flm_post_param("FILEID_".$i,"")) != "")
			$files[count($files)] = _flm_post_param("FILEID_".$i,"");
	}
	$path = _flm_pathfix($path);

	$arrResult = array();
	$ctr = 0;
	
	foreach ($files as $el) {
		$el = stripslashes($el);
		$delresult = @unlink($_FLM["ROOTPATH"].$path.$el);
		$arrResult[$el] = $delresult!=false?"Deleted":"Error while deleting file";
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
					<td class="flm_td_title2"><b>Filename</b></td>
					<td class="flm_td_title2"><b>Status</b></td>
				</tr>
<?
	if (count($files)>0) {
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
