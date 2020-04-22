<?
	require ("_lib.php");
	require ("../config.php");

	if (!isset($OP)) $OP = "";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>Insert Frame</title>
	<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
  <!--
  	function InsertProp() {
			parent.opener.<?=$formfield?>.value += parent.properties.propvalue();
			parent.close();
			parent.opener.focus();
		}
<?if ($allow_img_upload||$allow_img_delete||$allow_img_mkdir||$allow_img_rmdir) {?>
<? if ($OP=="FILE") { ?>
		function open_flmng() {
			var w = 400;
			var h = 400;
			var l = Math.floor((screen.width-w)/2);
			var t = Math.floor((screen.height-h)/2);
			var FLMW = null;
			FLMW = window.open("_flmng/index.php","BS_HTMLEDITOR_FLM","width="+w+",height="+h+",left="+l+",top="+t+",toolbar=1,scrollbars=1,status=1");
			if (FLMW!=null) {
				FLMW.focus();
			}
		}
		<? } elseif ($OP=="IMG") { ?>
		function open_imgmng() {
			var w = 400;
			var h = 400;
			var l = Math.floor((screen.width-w)/2);
			var t = Math.floor((screen.height-h)/2);
			var IMGMW = null;
			IMGMW = window.open("_imgmng/index.php","BS_HTMLEDITOR_IMGM","width="+w+",height="+h+",left="+l+",top="+t+",toolbar=1,scrollbars=1,status=1");
			if (FLIMGMW!=null) {
				IMGMW.focus();
			}
		}
		<? } ?>
<?}?>
  //-->
  </SCRIPT>
</head>

<body marginheight="2" marginwidth="2" bgcolor="#DEDEDE">
<table cellpadding="0" cellspacing="0" border="0" width="100%" height="100%">
	<tr>
		<td valign="middle" align="center">
			<table cellpadding="4" cellspacing="0" border="0" width="100%">
				<form>
				<tr>
					<td><input type="button" value="Insert" onclick="InsertProp();"> <input type="button" value="Cancel" onclick="parent.close();"></td>
					<?if ($allow_img_upload||$allow_img_delete||$allow_img_mkdir||$allow_img_rmdir) {?><td align="right"><input type="button" value="File Manager" onclick="<? if ($OP=="FILE") { ?>open_flmng();<? } elseif ($OP=="IMG") { ?>open_imgmng();<? } ?>"></td><?}?>
				</tr>
				</form>
			</table>
		</td>
	</tr>
</table>
</body>
</html>
