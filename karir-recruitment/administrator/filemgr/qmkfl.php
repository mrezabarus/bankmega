<?
	require("_config.php");
	
	$fname = _flm_post_param("FNAME",false);
	$fcontent = _flm_post_param("FCONTENT",false);
	$path = _flm_post_param("PATH",false);
	$path = _flm_pathfix($path);
	$opback = 0;
	
	$invalid_filename = _flm_invalidfname($fname) || !_flm_isvalid_ext(_flm_fext($fname));
	
	if (!$invalid_filename && !is_file($_FLM["ROOTPATH"].$path.$fname)) {
		$fp = @fopen ($_FLM["ROOTPATH"].$path.$fname, "wb+");
		$opresult = _flm_jsformat($_FLM["TITLE"])." : File created succesfully!";
		if (!$fp) {
			$opresult = _flm_jsformat($_FLM["TITLE"])." : Error while creating file!";		
			$opback = 1;
		}
		$opresult = @fwrite ($fp, $fcontent);
		if (!$opresult) {
			$opresult = _flm_jsformat($_FLM["TITLE"])." : Error while creating file!";
			$opback = 1;
		}
		else $opresult = _flm_jsformat($_FLM["TITLE"])." : File created succesfully!";
		@fclose ($fp);
	} elseif ($invalid_filename) {
		$opresult = _flm_jsformat($_FLM["TITLE"])." : Error, Invalid Filename or File Extension is not Allowed!";
		$opback = 1;
	}	else {
		$opresult = _flm_jsformat($_FLM["TITLE"])." : Error, File Already Exists!";
		$opback = 1;
	}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title><?=$_FLM["TITLE"]?> | Create Text File Results...</title>
</head>

<body>

<form name="frmMkFlErr" method="post" action="fmkfl.php?<?=$_instanceurl?>">
	<input type="hidden" name="PATH" value="<?=htmlentities($path)?>">
	<? if ($opback) { ?>
	<input type="hidden" name="FNAME" value="<?=htmlentities($fname)?>">
	<input type="hidden" name="FCONTENT" value="<?=htmlentities($fcontent)?>">
	<? } ?>
</form>

<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
<!--
		
		<? if ($opback) { ?>
			alert('<?=$opresult?>');
			document.frmMkFlErr.submit();
		<? } else { ?>
			if (confirm('<?=$opresult?>' + '\n' + 'Create Another File?'))
				document.frmMkFlErr.submit();
			else
				location = 'filelist.php?<?=$_instanceurl?>&SEED=<?=mktime()?>';
		<? } ?>
//-->
</SCRIPT>
<? clearstatcache(); ?>
</body>
</html>
