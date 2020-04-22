<?
	require("_config.php");
	
	$path = _flm_pathfix(_flm_get_param("PATH",""));
	
	if (!_flm_isvalid_dir($_FLM["ROOTPATH"].$path)) {
		ErrMsg(1);
		die();
	}

	$epath = $path;
	$path = $_FLM["ROOTPATH"].$path;
	
	if (!@is_dir($path)) {
		$epath = "";
		$path = $_FLM["ROOTPATH"];
	}

	$d = @dir($path);
	$filecount = 0;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title><?=$_FLM["TITLE"]?> | Directory Tree</title>
	<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
  <!--
		function setCheck(state) {
			var frmEL = document.frmFileList.elements;
			var idx;
			for (var i=1;i<=frmEL["FILECOUNT"].value;i++) {
				idx = "FILEID_" + i;
				frmEL[idx].checked = state;
			}
		}
		
		function IsOneChecked() {
			var frmEL = document.frmFileList.elements;
			var idx;
			for (var i=1;i<=frmEL["FILECOUNT"].value;i++) {
				idx = "FILEID_" + i;
				if (frmEL[idx].checked) return true;
			}
			return false;
		}
  //-->
  </SCRIPT>
	<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
  <!--
		var stamp = '<?=mktime()?>';
		
		function refreshdir() {
			location = '<?=$_SERVER["PHP_SELF"]?>?PATH=<?=rawurlencode($epath)?>&<?=$_instanceurl?>&SEED=' + stamp;
		}

		
		function createfile() {
			frm = document.frmFileList;
			frm.action = 'fmkfl.php?<?=$_instanceurl?>&SEED=' + stamp;
			frm.submit();
		}
		
		
		function uploadfile(frm) {
			frm = document.frmFileList;
			frm.action = 'fupload.php?<?=$_instanceurl?>&SEED=' + stamp;
			frm.submit();
		}
		

		
		function editfile(frm) {
			if (!IsOneChecked()) {
				alert('<?=_flm_jsformat($_FLM["TITLE"])?> : Error, Please select 1 or more files!');
			} else {
				frm = document.frmFileList;
				frm.action = 'fedit.php?<?=$_instanceurl?>&SEED=' + stamp;
				frm.submit();
			}
		}
		
		function renamefile(frm) {
			if (!IsOneChecked()) {
				alert('<?=_flm_jsformat($_FLM["TITLE"])?> : Error, Please select 1 or more files!');
			} else {
				frm = document.frmFileList;
				frm.action = 'frename.php?<?=$_instanceurl?>&SEED=' + stamp;
				frm.submit();
			}
		}
		

		
		function deletefile(frm) {
			if (!IsOneChecked()) {
				alert('<?=_flm_jsformat($_FLM["TITLE"])?> : Error, Please select 1 or more files!');
			} else {
				frm = document.frmFileList;
				frm.action = 'fdelete.php?<?=$_instanceurl?>&SEED=' + stamp;
				frm.submit();
			}
		}
		
		function movefile(frm) {
			if (!IsOneChecked()) {
				alert('<?=_flm_jsformat($_FLM["TITLE"])?> : Error, Please select 1 or more files!');
			} else {
				frm = document.frmFileList;
				frm.action = 'fmove.php?<?=$_instanceurl?>&SEED=' + stamp;
				frm.submit();
			}
		}
		
		function copyfile(frm) {
			if (!IsOneChecked()) {
				alert('<?=_flm_jsformat($_FLM["TITLE"])?> : Error, Please select 1 or more files!');
			} else {
				frm = document.frmFileList;
				frm.action = 'fcopy.php?<?=$_instanceurl?>&SEED=' + stamp;
				frm.submit();
			}
		}
		
		function createdir(frm) {
			frm = document.frmFileList;
			frm.action = 'fmkdir.php?<?=$_instanceurl?>&SEED=' + stamp;
			frm.submit();
		}
		
		function deletedir(frm) {
			frm = document.frmFileList;
			frm.action = 'frmdir.php?<?=$_instanceurl?>&SEED=' + stamp;
			frm.submit();
		}
		
  //-->
  </SCRIPT>
	<link rel="STYLESHEET" type="text/css" href="../css/flmgr.css">
</head>

<body topmargin="2" leftmargin="2" marginheight="2" marginwidth="2">
<table cellpadding="0" cellspacing="1" border="0" width="100%">
	<form name="frmFileList" method="post">
	<input type="Hidden" name="PATH" value="<?=htmlentities($epath)?>">
	<tr>
	  <td width="100%" bgcolor="#CCCCCC"><img border="0" src="<?=$_FLM_IMGURL?>b.gif" width="1" height="1"></td>
	</tr>
	<tr>
	  <td>
	    <table border="0" cellpadding="2">
	      <tr>
	        <td width="1%" nowrap class="fl_currpath" valign="top"><a name="top"></a>Current Directory</td>
	        <td width="1%" nowrap class="fl_currpath" valign="top">:</td>
	        <td width="98%" class="fl_currpath" valign="top">/<?=$epath?></td>
	      </tr>
	    </table>
	  </td>
	</tr>
	<tr>
		<td bgcolor="#CCCCCC"><img border="0" src="<?=$_FLM_IMGURL?>b.gif" width="1" height="1"></td>
	</tr>
	<tr>
		<td>
			<table border="0" cellpadding="0" width="100%">
			  <tr>
			    <td align="center"><a href="javascript:void(0)" onClick="refreshdir(); return false;"><img border="0" src="<?=$_FLM_IMGURL?>refresh.gif" alt="Refresh!" width="22" height="21"></a></td>
					
			    <td align="center"><a href="javascript:void(0)" onClick="createfile(); return false;"><img border="0" src="<?=$_FLM_IMGURL?>newfile.gif" alt="Create New File" width="22" height="21"></a></td>
					
			    <td align="center"><a href="javascript:void(0)" onClick="uploadfile(); return false;"><img border="0" src="<?=$_FLM_IMGURL?>upload.gif" alt="Upload Files!" width="22" height="21"></a></td>
					
			    <td align="center"><a href="javascript:void(0)" onClick="editfile(); return false;"><img border="0" src="<?=$_FLM_IMGURL?>edit.gif" alt="Edit Selected Files!" width="22" height="21"></a></td>
					
			    <td align="center"><a href="javascript:void(0)" onClick="renamefile(); return false;"><img border="0" src="<?=$_FLM_IMGURL?>rename.gif" alt="Rename Selected Files!" width="22" height="21"></a></td>
					
			    <td align="center"><a href="javascript:void(0)" onClick="deletefile(); return false;"><img border="0" src="<?=$_FLM_IMGURL?>delete.gif" alt="Delete Selected Files!" width="22" height="21"></a></td>
					
			    <td align="center"><a href="javascript:void(0)" onClick="movefile(); return false;"><img border="0" src="<?=$_FLM_IMGURL?>move.gif" alt="Move Selected Files!" width="22" height="21"></a></td>
					
			    <td align="center"><a href="javascript:void(0)" onClick="copyfile(); return false;"><img border="0" src="<?=$_FLM_IMGURL?>copy.gif" alt="Copy Selected Files!" width="22" height="21"></a></td>
					
			    <td align="center"><a href="javascript:void(0)" onClick="createdir(); return false;"><img border="0" src="<?=$_FLM_IMGURL?>mkdir.gif" alt="Make a New Directory!" width="22" height="21"></a></td>
					
			    <td align="center"><a href="javascript:void(0)" onClick="deletedir(); return false;"><img border="0" src="<?=$_FLM_IMGURL?>rmdir.gif" alt="Remove this Directory!" width="22" height="21"></a></td>
					
			  </tr>
			</table>
		</td>
	</tr>
	<tr>
		<td bgcolor="#CCCCCC"><img border="0" src="<?=$_FLM_IMGURL?>b.gif" width="1" height="1"></td>
	</tr>
	<tr>
		<td>
			<table cellpadding="2" cellspacing="1" border="0" width="100%">
				<tr>
          <td width="1%" valign="middle" align="center" class="fl_listtitle"><input type="checkbox" onClick="setCheck(this.checked)"></td>
          <td width="<?=$_FLM["SHOW_FILETYPE"]&&$_FLM["SHOW_FILESIZE"]?"75%":($_FLM["SHOW_FILETYPE"]?"89%":($_FLM["SHOW_FILESIZE"]?"85%":"99%"))?>" class="fl_listtitle"><b>Filename</b></td>
          <? if ($_FLM["SHOW_FILETYPE"]) { ?><td width="14%" class="fl_listtitle"><b>Type</b></td><? } ?>
					<? if ($_FLM["SHOW_FILESIZE"]) { ?><td width="10%" align="right" class="fl_listtitle"><b>Size</b></td><? } ?>
				</tr>
<?
	if ($d) {
		
		while (($el = $d->read()) !== false) {
			if (@is_file($path.$el)) {
				$filecount++;
				$css_class =$filecount % 2 == 1?"class=\"fl_list_odd\"":"class=\"fl_list_even\"";
?>
        <tr>
          <td <?=$css_class?> width="1%" valign="middle" align="center"><input type="checkbox" name="FILEID_<?=$filecount?>" value="<?=htmlentities($el)?>"></td>
          <td <?=$css_class?> width="<?=$_FLM["SHOW_FILETYPE"]&&$_FLM["SHOW_FILESIZE"]?"75%":($_FLM["SHOW_FILETYPE"]?"89%":($_FLM["SHOW_FILESIZE"]?"85%":"99%"))?>"><? if ($_FLM["IS_DOWNLOAD"]) { ?><a href="getfile.php?<?=$_instanceurl?>&filename=<?=rawurlencode($epath.$el)?>"><? } ?><?=htmlentities(_flm_truncfname($el))?><? if ($_FLM["IS_DOWNLOAD"]) { ?></a><? } ?></td>
          <? if ($_FLM["SHOW_FILETYPE"]) { ?><? $ext = _flm_fext($el); ?><td <?=$css_class?> width="14%"><?=trim($ext)!=""?$ext." ":""?>FILE</td><? } ?>
          <? if ($_FLM["SHOW_FILESIZE"]) { ?><td <?=$css_class?> width="10%" align="right" nowrap><?=_flm_fsize($path.$el)?></td><? } ?>
        </tr>
<?
			}
		}
		clearstatcache();
		$d->close();
	}
	?><input type="hidden" name="FILECOUNT" value="<?=$filecount?>"><?
	if ($filecount==0) {
?>
        <tr>
          <td width="100%" colspan="<?=$_FLM["SHOW_FILETYPE"]&&$_FLM["SHOW_FILESIZE"]?4:($_FLM["SHOW_FILETYPE"]||$_FLM["SHOW_FILESIZE"]?3:2)?>" valign="middle" align="center">&nbsp;</td>
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
		<td>
			<table border="0" cellpadding="2" width="100%">
			  <tr>
			    <td align="left" class="fl_listfooter"><?if ($filecount>=0) {?><a href="#top">Back to Top</a><?}?></td>
			    <td align="center" class="fl_listfooter">Total <?=$filecount?> File(s)</td>
			    <td align="right" class="fl_listfooter"><?if ($filecount>=0) {?><a href="#top">Back to Top</a><?}?></td>
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
