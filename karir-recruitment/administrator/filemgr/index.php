<?
	require "_config.php";
	
	$FW = _flm_get_param("FW","0");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title><?=$_FLM["TITLE"]?></title>
</head>

<? if ($_FLM_SHOWHEADER) { ?>
<frameset rows="38,*" framespacing="0">
 	<frame name="fm_header" src="header.php?FW=<?=$FW?>&<?=$_instanceurl?>" scrolling="no" noresize>
	<frameset cols="<?=$_FLM_LEFTWIDTH?>,*" framespacing="4">
  	<frame name="fm_dirtree" src="dirtree.php?<?=$_instanceurl?>">
	  <frame name="fm_filelist" src="about:blank">
	</frameset>
  <noframes>
  <body>

  <p>This page uses frames, but your browser doesn't support them.</p>

  </body>
  </noframes>
</frameset>
<? } else { ?>
<frameset cols="<?=$_FLM_LEFTWIDTH?>,*" framespacing="4">
 	<frame name="fm_dirtree" src="dirtree.php?<?=$_instanceurl?>">
  <frame name="fm_filelist" src="about:blank">
  <noframes>
  <body>

  <p>This page uses frames, but your browser doesn't support them.</p>

  </body>
  </noframes>
</frameset>
<? } ?>

</html>
