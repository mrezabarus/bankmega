<?
	require("_config.php");
	
	$path = _flm_post_param("PATH","");
	$oppath = _flm_post_param("OPPATH",$path);
	$lastselpath = _flm_post_param("LASTSELPATH","");
	$selpath = _flm_post_param("SELPATH",$path);
	$lastactpath = _flm_post_param("LASTACTPATH","");
	$filecount = _flm_post_param("FILECOUNT",0);
	
	$files = array();

	for ($i = 1; $i <= $filecount; $i++) {
		if (trim(_flm_post_param("FILEID_".$i,"")) != "")
			$files[count($files)] = _flm_post_param("FILEID_".$i,"");
	}
	/*
	if (count($files) < 1 || !$_FLM["IS_COPY"]) {
		$path = _flm_post_param("PATH","");
		ErrMsg(1,$path);
		die();
	}
	*/
	$path = _flm_pathfix($path);
	/*
	if (!_flm_isvalid_dir($_FLM["ROOTPATH"].$path)) {
		ErrMsg(1);
		die();
	}
	*/
	$dirtree = _flm_dirtree($oppath);

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title><?=$_FLM["TITLE"]?> | Copy File(s)</title>
	<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
  <!--
  	function setOPPATH(val) {
			frm = document.frmDirTree;
			frm.action = "<?=$_SERVER["PHP_SELF"]?>?<?=$_instanceurl?>#dirtree";
			frm.OPPATH.value = val;
			frm.LASTACTPATH.value = val;
			frm.submit();
		}

  	function setSELPATH(val) {
			frm = document.frmDirTree;
			frm.action = "<?=$_SERVER["PHP_SELF"]?>?<?=$_instanceurl?>#dirtree";
			frm.SELPATH.value = val;
			frm.LASTACTPATH.value = val;
			frm.submit();
		}

  	function frmSubmit() {
			frm = document.frmDirTree;
			frm.action = "qcopy.php?<?=$_instanceurl?>";
			<? if ($selpath != $path) { ?>
				frm.submit();
			<? } else { ?>
				alert('Cannot copy file, source and destination folder are the same!')
			<? } ?>
		}
  //-->
  </SCRIPT>
	<link rel="STYLESHEET" type="text/css" href="../css/flmgr.css">
</head>

<body topmargin="2" leftmargin="2" marginheight="2" marginwidth="2">
<table cellpadding="0" cellspacing="1" border="0" width="100%">
	<form name="frmDirTree" method="post">
  <tr>
    <td bgcolor="#CCCCCC"><img border="0" src="<?=$_FLM_IMGURL?>b.gif" width="1" height="1"></td>
  </tr>
  <tr>
    <td class="flm_td_title1">
			<table cellpadding="2" width="100%">
				<tr>
					<td class="flm_td_title1" align="left"><b>Copy File(s)</b></td>
				</tr>
			</table>
		</td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC"><img border="0" src="<?=$_FLM_IMGURL?>b.gif" width="1" height="1"></td>
  </tr>
  <tr>
    <td align="left">
			<table cellpadding="1">
				<tr>
					<td><input type="button" class="flm_button" value="       Copy!       " onClick="frmSubmit(); return false;"> <input class="flm_button" type="button" value="Back to File List!" onClick="location = 'filelist.php?PATH=<?=rawurlencode($path)?>&<?=$_instanceurl?>&SEED=<?=mktime()?>'"></td>
				</tr>
			</table>
		</td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC"><img border="0" src="<?=$_FLM_IMGURL?>b.gif" width="1" height="1"></td>
  </tr>
	<tr>
		<td>
			<table cellpadding="8" cellspacing="0" border="0" width="100%">
				<tr>
					<td class="flm_td_even">
<table cellpadding="0" cellspacing="0" border="0">
	<input type="hidden" name="PATH" value="<?=htmlentities($path)?>">
	<input type="hidden" name="OPPATH" value="<?=htmlentities($oppath)?>">
	<input type="hidden" name="SELPATH" value="<?=htmlentities($selpath)?>">
	<input type="hidden" name="LASTACTPATH" value="<?=htmlentities($lastactpath)?>">
	<input type="hidden" name="LASTSELPATH" value="<?=htmlentities($selpath)?>">
	<input type="hidden" name="FILECOUNT" value="<?=count($files)?>">
	<?
		$i = 0;
		foreach ($files as $el) { 
			$i++;
	?>
	<input type="hidden" name="FILEID_<?=$i?>" value="<?=htmlentities($el)?>">
	<? } ?>
	<tr>
		<td><table cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td><img src="<?=$_FLM_IMGURL?>m.gif" width="17" height="22" alt="" border="0"></td>
					<td><? if ($selpath == "") { ?><img src="<?=$_FLM_IMGURL?>fo.gif" width="17" height="22" alt="" border="0"><? } else { ?><img src="<?=$_FLM_IMGURL?>fc.gif" width="17" height="22" alt="" border="0"><? } ?></td>
					<td nowrap><? if ($lastactpath == "") { ?><a name="dirtree"></a><? } ?>&nbsp;<a href="javascript:void(0)" onClick="setSELPATH(''); return false;" class="dirtree<? if ($selpath == "") { ?>_sel"<? } else { ?>_norm"<? } ?>>Root Path</a>&nbsp;</td>
				</tr>
		</table></td>
	</tr>
<? for ($i = 0;$i<count($dirtree);$i++) { ?>
	<tr>
		<td><table cellpadding="0" cellspacing="0" border="0">
				<tr>
					<?=str_repeat("<td><img src=\"".$_FLM_IMGURL."b.gif\" width=\"17\" height=\"22\" alt=\"\" border=\"0\"></td>",$dirtree[$i]["depth"]+1)?>
					<td><? if (!$dirtree[$i]["haschild"]) { ?><img src="<?=$_FLM_IMGURL?>b.gif" width="17" height="22" alt="" border="0"><? } elseif ($dirtree[$i]["oppath"]) { ?><a href="javascript:void(0)" onClick="setOPPATH('<?=_flm_jsformat($dirtree[$i]["parentpath"])?>'); return false;"><img src="<?=$_FLM_IMGURL?>m.gif" width="17" height="22" alt="" border="0"></a><? } else { ?><a href="javascript:void(0)" onClick="setOPPATH('<?=_flm_jsformat($dirtree[$i]["relativepath"])?>'); return false;"><img src="<?=$_FLM_IMGURL?>p.gif" width="17" height="22" alt="" border="0"></a><? } ?></td>
					<td><? if ($dirtree[$i]["relativepath"] == $selpath) { ?><img src="<?=$_FLM_IMGURL?>fo.gif" width="17" height="22" alt="" border="0"><? } else { ?><img src="<?=$_FLM_IMGURL?>fc.gif" width="17" height="22" alt="" border="0"><? } ?></td>
					<td nowrap><? if ($dirtree[$i]["relativepath"] == $lastactpath) { ?><a name="dirtree"></a><? } ?>&nbsp;<a href="javascript:void(0)" onClick="setSELPATH('<?=_flm_jsformat($dirtree[$i]["relativepath"])?>'); return false;" class="dirtree<? if ($selpath == $dirtree[$i]["relativepath"]) { ?>_sel"<? } else { ?>_norm"<? } ?>><?=htmlentities($dirtree[$i]["name"])?></a>&nbsp;</td>
				</tr>
		</table></td>
	</tr>
<? } ?>
</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
  <tr>
    <td bgcolor="#CCCCCC"><img border="0" src="<?=$_FLM_IMGURL?>b.gif" width="1" height="1"></td>
  </tr>
  <tr>
    <td align="left">
			<table cellpadding="1">
				<tr>
					<td><input type="button" class="flm_button" value="       Copy!       " onClick="frmSubmit(); return false;"> <input class="flm_button" type="button" value="Back to File List!" onClick="location = 'filelist.php?PATH=<?=rawurlencode($path)?>&<?=$_instanceurl?>&SEED=<?=mktime()?>'"></td>
				</tr>
			</table>
		</td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC"><img border="0" src="<?=$_FLM_IMGURL?>b.gif" width="1" height="1"></td>
  </tr>
	</form>
</table>
</body>
</html>
<? @clearstatcache(); ?>
