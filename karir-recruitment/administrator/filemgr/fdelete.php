<?
	require ("_config.php");

	$path = _flm_post_param("PATH",false);
	$filecount = _flm_post_param("FILECOUNT",0);

	$files = array();

	for ($i = 1; $i <= $filecount; $i++) {
		if (trim(_flm_post_param("FILEID_".$i,"")) != "")
			$files[count($files)] = _flm_post_param("FILEID_".$i,"");
	}
	/*
	if (count($files) < 1 || $path === false || !$_FLM["IS_DELETE"]) {
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
	}*/
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title><?=$_FLM["TITLE"]?> | Rename File(s)</title>
	<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
  <!--
		function setCheck(state) {
			var frmEL = document.frmDelete.elements;
			var idx;
			for (var i=1;i<=frmEL["FILECOUNT"].value;i++) {
				idx = "FILEID_" + i;
				frmEL[idx].checked = state;
			}
		}
  //-->
  </SCRIPT>
	<link rel="STYLESHEET" type="text/css" href="../css/flmgr.css">
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
					<td class="flm_td_title1" align="left"><b>Delete File(s)</b></td>
				</tr>
			</table>
		</td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC"><img border="0" src="<?=$_FLM_IMGURL?>b.gif" width="1" height="1"></td>
  </tr>
	<form name="frmDelete" action="qdelete.php?<?=$_instanceurl?>" method="post">
	<input type="Hidden" name="PATH" value="<?=htmlentities($path)?>">
	<input type="hidden" name="FILECOUNT" value="<?=count($files)?>">
	<tr>
		<td>
			<table cellpadding="0" cellspacing="1" width="100%">
				<tr>
					<td width="1%" class="flm_td_title2"><input type="checkbox" onClick="setCheck(this.form,this.checked)"></td>
					<td width="99%" class="flm_td_title2"><b>&nbsp;Please reselect file(s), you want to delete...</b></td>
				</tr>
<?
	$i = 0;
	foreach ($files as $el) {
	$css_class = ($i+1) % 2 == 1?"class=\"flm_td_odd\"":"class=\"flm_td_even\"";
	$i++;
?>
				<tr>
					<td <?=$css_class?> width="1%"><input type="checkbox" name="FILEID_<?=$i?>" value="<?=htmlentities($el)?>"></td>
					<td <?=$css_class?> width="99%"><?=htmlentities(_flm_truncfname(basename($_FLM["ROOTPATH"].$path.$el),20))?></td>
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
  <tr>
    <td align="left">
			<table cellpadding="1">
				<tr>
					<td><input type="submit" class="flm_button" value="      Delete!      "> <input class="flm_button" type="button" value="Back to File List!" onClick="location = 'filelist.php?PATH=<?=rawurlencode($path)?>&<?=$_instanceurl?>&SEED=<?=mktime()?>'"></td>
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
