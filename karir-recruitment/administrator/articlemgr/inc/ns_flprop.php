<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>Image Properties</title>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
<!--
	function propvalue() {
		var frm = document.FLPROP;
		var retStr = "\r";
		if (frm.iURL.value.length) {
			retStr += "<a href=\"" + frm.iURL.value + "\">";
			retStr += frm.iTITLE.value==""?frm.iURL.value:frm.iTITLE.value;
			retStr += "</a>";
		}
		return retStr;
	}
//-->
</SCRIPT>
</head>

<body bgcolor="#DEDEDE" marginheight="2" marginwidth="2">
<center>
<table border="0" cellpadding="3" cellspacing="0">
	<form name="FLPROP">
	<tr>
		<td><font face="arial,helvetica" size="2">Title</font></td>
		<td><input type="text" name="iTITLE" size="35"></td>
	</tr>
	<tr>
		<td><font face="arial,helvetica" size="2">URL</font></td>
		<td><input type="text" name="iURL" size="35"></td>
	</tr>
	</form>
</table>
</center>
</body>
</html>
