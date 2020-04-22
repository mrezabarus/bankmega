<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>Insert Hyperlink</title>
	<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
  <!--
  	function InsertHyp() {
			frm = document.HYPFORM;
			if (frm.iURL.value!="") {
				var retVal = "\r<a href=\"" +frm.iURL.value+ "\"";
				retVal += frm.iNAME.value==""?"":" name=\"" +frm.iNAME.value+ "\"";
				retVal += frm.iTITLE.value==""?"":" title=\"" +frm.iTITLE.value+ "\"";
				retVal += frm.iTARGET.value==""?"":" target=\"" +frm.iTARGET.value+ "\"";
				retVal += ">"; 
				retVal += frm.iTITLE.value==""?frm.iURL.value:frm.iTITLE.value ;
				retVal += "</a>";
				opener.<?=$formfield?>.value += retVal;
			}
			window.close();
		}
  //-->
  </SCRIPT>
</head>

<body bgcolor="#DEDEDE">
	<table align="center">
		<form name="HYPFORM">
		<tr>
			<td><font face="arial,helvetica" size="2">Name</font></td>
			<td><input type="text" name="iNAME" value=""></td>
		</tr>
		<tr>
			<td><font face="arial,helvetica" size="2">URL</font></td>
			<td><input type="text" name="iURL" value=""></td>
		</tr>
		<tr>
			<td><font face="arial,helvetica" size="2">Title</font></td>
			<td><input type="text" name="iTITLE" value=""></td>
		</tr>
		<tr>
			<td><font face="arial,helvetica" size="2">Target</font></td>
			<td><input type="text" name="iTARGET" value=""></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="button" value="Insert" onclick="InsertHyp()"> <input type="button" value="Cancel" onclick="window.close();"></td>
		</tr>
		</form>
	</table>
</body>
</html>
