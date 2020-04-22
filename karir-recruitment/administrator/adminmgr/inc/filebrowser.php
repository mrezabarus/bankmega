<?
	require ("_lib.php");
	require ("../config.php");

	$rootpath = $filepath;
	$allowed_ext = $file_ext;
	
	
	
	if (isset($op)) str_replace("..","",$op);
	else $op = "";
	
	$path = $rootpath.$op;
	
	if (!@is_dir($path)) {
?>
	<table width="100%" height="100%">
		<tr>
			<td valign="middle" align="center"><a href="javascript:history.back();"><font face="arial,helvetica" size="2">Cannot find specified path!</font></a></td>
		</tr>
	</table>
<?
		die();
	}
	
	$handler = @dir($path);
	
	$arr_ext = explode(",",strtoupper($allowed_ext));
	$arr_dir = array();
	$arr_file = array();
	$i = 0;
	$j = 0;
	while (false !== ($entry = $handler->read())) {
		$foo = explode(".",$entry);
		if (count($foo)>1) $ext = $foo[count($foo)-1];
		else $ext = "";
		$isExt = in_array(strtoupper($ext),$arr_ext);
		if (@is_dir($path.$entry) && $entry != "." && $entry != "..") {
			$arr_dir[$i]['name'] = $entry;
			$arr_dir[$i]['url'] = $op.$entry."/";
			$i++;
		} else if (@is_file($path.$entry) && $isExt) {
			$arr_file[$j]['name'] = $entry;
			$arr_file[$j]['ext'] = $ext;
			$j++;
		}
	}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>Image Browser</title>
	<meta http-equiv="Expires" content="0">
	<style>
		body { margin:0px}
		td {font-family:"verdana";font-size:8pt;}
		.list {font-family:"verdana";font-size:8pt;padding-right:3px;padding-left:3px;padding-top:1px;padding-bottom:1px}
		a {text-decoration:none;color:black}
		a:hover {text-decoration:underline}
		.td_header {background-color:buttonface;border:1px outset}
	</style>
	<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
  <!--
	function select_file(name) {
		parent.document.frmImgBrowser.iURL.value = "<?=$filebaseurl.$op?>" + name;
	}
  //-->
  </SCRIPT>
</head>

<body topmargin="0" leftmargin="0" marginheight="0" marginwidth="0">
<table cellpadding="0" cellspacing="1" border="0" width="100%">
	<tr>
		<td class="td_header" width="10%" nowrap>Name&nbsp;&nbsp;&nbsp;</td>
		<td class="td_header" width="90%" nowrap>Type&nbsp;&nbsp;&nbsp;</td>
	</tr>
<? if ($op!="/"&&$op!="") { ?>
	<tr>
		<td><table cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td nowrap><a title="<?=htmlentities(upperpath($op))?>" href="imgbrowser.php?op=<?=rawurlencode(upperpath($op))?>"><img src="images/folderclosed.gif" border="0"></a></td>
				<td nowrap><a title="<?=htmlentities(upperpath($op))?>" href="imgbrowser.php?op=<?=rawurlencode(upperpath($op))?>">..</a></td>
			</tr>
		</table></td>
		<td nowrap>directory</td>
	</tr>
<? } ?>
<? for ($i=0;$i<count($arr_dir);$i++) { ?>
	<tr>
		<td><table cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td nowrap><a title="<?=htmlentities($op.$arr_dir[$i]['name']."/")?>" href="imgbrowser.php?op=<?=rawurlencode($op.$arr_dir[$i]['name']."/")?>"><img src="images/folderclosed.gif" border="0"></a></td>
				<td nowrap><a title="<?=htmlentities($op.$arr_dir[$i]['name']."/")?>" href="imgbrowser.php?op=<?=rawurlencode($op.$arr_dir[$i]['name']."/")?>"><?=str_trunc($arr_dir[$i]['name'],20)?></a></td>
			</tr>
		</table></td>
		<td>directory</td>
	</tr>
<? } ?>
<? for ($i=0;$i<count($arr_file);$i++) { ?>
	<tr>
		<td><table cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td nowrap><a href="javascript:void(0);" onclick="select_file('<?=urlencode($arr_file[$i]['name'])?>')"><img src="images/images.gif" border="0"></a></td>
				<td nowrap><a href="javascript:void(0);" onclick="select_file('<?=urlencode($arr_file[$i]['name'])?>')"><?=TruncateFileName($arr_file[$i]['name'],20)?></a></td>
			</tr>
		</table></td>
		<td nowrap><?=$arr_file[$i]['ext']?> file</td>
	</tr>
<? } ?>
</table>
</body>
</html>
