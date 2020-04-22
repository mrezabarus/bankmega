<?
	require "_config.php";
	
	$FW = _flm_get_param("FW","0");
?>
<html>

<head>
<title><?=$_FLM["TITLE"]?></title>
<style>
	a {text-decoration:none;}
	a:hover {text-decoration:underline;}
</style>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
<!--
		function FMWin() {
			fmwin = null;
			var W = screen.width-70;
			var H = screen.height-70;
			var L = Math.round((screen.width - W) / 2);
			var T = Math.round((screen.height - H) / 2)-10;
			fmwin = window.open("index.php?FW=1&<?=$_instanceurl?>","fm_win","resizeable=1,resizable=1,width="+W+",height="+H+",left="+L+",top="+T);
			if (fmwin!=null) fmwin.focus();
		}
//-->
</SCRIPT>
</head>

<body topmargin="1" leftmargin="1" marginheight="1" marginwidth="1">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tr>
    <td width="100%">
      <table border="0" cellpadding="0" width="100%" cellspacing="1">
        <tr>
          <td width="100%" colspan="2" bgcolor="#3366CC"><img border="0" src="<?=$_FLM_IMGURL?>b.gif" width="1" height="1"></td>
        </tr>
        <tr>
          <td width="100%" colspan="2" bgcolor="#3366CC">
						<table width="100%" cellpadding="0" cellspacing="0" border="0">
			        <tr>
			          <td width="1%" bgcolor="#3366CC">
			            <table border="0" cellpadding="6" cellspacing="0" width="100%">
			              <tr>
			                <td width="100%" align="center" nowrap><font size="2" face="Arial" color="#FFFFFF">&nbsp;&nbsp;<b><?=$_FLM["TITLE"]?></b></font></td>
			              </tr>
			            </table>
			          </td>
			          <td width="99%" align="right" bgcolor="#3366CC">
			            <table border="0" cellpadding="4" cellspacing="0">
			              <tr>
			                <td><a target="_parent" href="index.php?FW=<?=$FW?>&<?=$_instanceurl?>"><font size="2" face="Arial" color="#FFFFFF">Refresh!</font></a></td>
			                <td><font face="arial" size="2" color="#FFFFFF">|</font></td>
			                <td><?if ($FW != "0"){?><a href="javascript:void(0);" onclick="parent.close();"><font size="2" face="Arial" color="#FFFFFF">Close Window!</font></a><?} else {?><a href="javascript:void(0);" onclick="FMWin();"><font size="2" face="Arial" color="#FFFFFF">Open File Manager in new window!</font></a><?}?></td>
			              </tr>
			            </table>
			          </td>
			        </tr>
						</table>
					</td>
        </tr>
        <tr>
          <td width="100%" colspan="2" bgcolor="#3366CC"><img border="0" src="<?=$_FLM_IMGURL?>b.gif" width="1" height="1"></td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</body>

</html>
