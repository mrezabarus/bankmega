<?
	require("_config.php");

	$path = _flm_post_param("PATH",false);
	$fcontent = _flm_post_param("FCONTENT",false);
	$currFile = _flm_post_param("CURRFILE",false);

	$filecount = _flm_post_param("FILECOUNT",0);
	
	$files = array();

	for ($i = 1; $i <= $filecount; $i++) {
		if (trim(_flm_post_param("FILEID_".$i,"")) != "")
			$files[count($files)] = _flm_post_param("FILEID_".$i,"");
	}
	$path = _flm_pathfix($path);
	$invalid_filename = (count(explode("../",$currFile))>1) || (count(explode("..\\",$currFile))>1);

	if ($invalid_filename) {
		ErrMsg(2);
		die();
	}

	if (is_file($_FLM["ROOTPATH"].$path.$currFile)) {
		$fp = @fopen ($_FLM["ROOTPATH"].$path.$currFile, "wb+");
		$opresult = $_FLM["TITLE"]." : File updated succesfully!";
		if (!$fp) $opresult = $_FLM["TITLE"]." : Error while opening file!";		
		$opresult = @fwrite ($fp, $fcontent);
		if (!$opresult) $opresult = $_FLM["TITLE"]." : Error while writing file!";
		else $opresult = $_FLM["TITLE"]." : File updated succesfully!";
		@fclose ($fp);
	} else $opresult = $_FLM["TITLE"]." : Cannot find specified file!";
?>
<? clearstatcache(); ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title><?=$_FLM["TITLE"]?> | Edit File Results...</title>
</head>

<body onLoad="alert('<?=$opresult?>'); document.frmEdit.submit();">

<form name="frmEdit" action="fedit.php?<?=$_instanceurl?>" method="post">
	<input type="Hidden" name="PATH" value="<?=htmlentities($path)?>">
	<input type="Hidden" name="CURRFILE" value="<?=htmlentities($currFile)?>">
	<input type="Hidden" name="FILECOUNT" value="<?=count($files)?>">
<?
	$i = 0;
	foreach ($files as $el) {
		$el = stripslashes($el);
		$i++;
?>	<input type="Hidden" name="FILEID_<?=$i?>" value="<?=htmlentities($el)?>">
<?
	}
?>
</form>
</body>
</html>
