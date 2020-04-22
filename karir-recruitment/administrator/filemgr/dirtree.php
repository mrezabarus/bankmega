<?
	require("_config.php");
	
	$oppath = _flm_post_param("OPPATH","");
	$lastselpath = _flm_post_param("LASTSELPATH","");
	$selpath = _flm_post_param("SELPATH","");
	$lastactpath = _flm_post_param("LASTACTPATH","");
	
	$dirtree = _flm_dirtree($oppath);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title><?=$_FLM["TITLE"]?> | Directory Tree</title>
	<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
  <!--
  	function setOPPATH(val) {
			frm = document.frmDirTree;
			frm.OPPATH.value = val;
			frm.LASTACTPATH.value = val;
			frm.submit();
		}
  	function setSELPATH(val) {
			frm = document.frmDirTree;
			frm.SELPATH.value = val;
			frm.LASTACTPATH.value = val;
			frm.submit();
		}
		function setFileList() {
			<? if ($lastselpath != $selpath || $selpath == "") { ?>
			parent.fm_filelist.document.clear();
			parent.fm_filelist.document.write("<table width=100% height=80%><tr><td align=center valign=middle>");
			parent.fm_filelist.document.write("<font face=verdana style=\"font-size:11px\">Loading List of File(s)...</font>");
			parent.fm_filelist.document.write("</td></tr></table>");
			parent.fm_filelist.document.close();
    	parent.fm_filelist.location = "filelist.php?PATH=<?=rawurlencode($selpath)?>&<?=$_instanceurl?>&SEED=<?=mktime()?>";
			return false
			<? } ?>
		}
  //-->
  </SCRIPT>
	<link rel="STYLESHEET" type="text/css" href="../css/flmgr.css">
</head>

<body onLoad="setFileList();">
<table cellpadding="0" cellspacing="0" border="0">
	<form name="frmDirTree" action="<?=$_SERVER["PHP_SELF"]?>?<?=$_instanceurl?>#dirtree" method="post">
	<input type="hidden" name="OPPATH" value="<?=htmlentities($oppath)?>">
	<input type="hidden" name="SELPATH" value="<?=htmlentities($selpath)?>">
	<input type="hidden" name="LASTACTPATH" value="<?=htmlentities($lastactpath)?>">
	<input type="hidden" name="LASTSELPATH" value="<?=htmlentities($selpath)?>">
	<tr>
		<td><table cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td><img src="<?=$_FLM_IMGURL?>m.gif" width="17" height="22" alt="" border="0"></td>
					<td><? if ($selpath == "") { ?><img src="<?=$_FLM_IMGURL?>fo.gif" width="17" height="22" alt="" border="0"><? } else { ?><img src="<?=$_FLM_IMGURL?>fc.gif" width="17" height="22" alt="" border="0"><? } ?></td>
					<td nowrap><? if ($lastactpath == "") { ?><a name="dirtree"></a><? } ?>&nbsp;<a href="javascript:void(0)" onClick="setSELPATH(''); return false;" class="dirtree<? if ($selpath == '') { ?>_sel"<? } else { ?>_norm"<? } ?>>Root Path</a>&nbsp;</td>
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
	</form>
</table>
</body>
</html>
<? @clearstatcache(); ?>
