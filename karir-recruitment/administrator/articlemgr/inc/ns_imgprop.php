<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>Image Properties</title>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
<!--
	function propvalue() {
		var frm = document.IMGPROP;
		var retStr = "\r";
		if (frm.iURL.value.length) {
			retStr += frm.iTYPE.selectedIndex==0?"<IMG":"<EMBED";
			retStr += " src=\"" + frm.iURL.value + "\"";
			retStr += isNaN(frm.iWIDTH.value)||frm.iWIDTH.value==""?"":" WIDTH=\"" + frm.iWIDTH.value + "\"";
			retStr += isNaN(frm.iHEIGHT.value)||frm.iHEIGHT.value==""?"":" HEIGHT=\"" + frm.iHEIGHT.value + "\"";
			retStr += isNaN(frm.iHSPACE.value)||frm.iHSPACE.value==""?"":" HSPACE=\"" + frm.iHSPACE.value + "\"";
			retStr += isNaN(frm.iVSPACE.value)||frm.iVSPACE.value==""?"":" VSPACE=\"" + frm.iVSPACE.value + "\"";
			retStr += isNaN(frm.iBORDER.value)||frm.iBORDER.value==""?"":" BORDER=\"" + frm.iBORDER.value + "\"";
			retStr += frm.iALIGN.options[frm.iALIGN.selectedIndex].value==""?"":" VSPACE=\"" + frm.iALIGN.options[frm.iALIGN.selectedIndex].value + "\"";
			retStr += ">";
		}
		return retStr;
	}
//-->
</SCRIPT>
</head>

<body bgcolor="#DEDEDE" marginheight="2" marginwidth="2">
<center>
<table border="0" cellpadding="3" cellspacing="0">
	<form name="IMGPROP">
	<tr>
		<td><font face="arial,helvetica" size="2">URL</font></td>
		<td><input type="text" name="iURL" size="35"></td>
	</tr>
	<tr>
		<td><font face="arial,helvetica" size="2">Type</font></td>
		<td><select name="iTYPE" width="290">
			<option>Image
			<option>Embbeded Object
		</select></td>
	</tr>
	<tr>
		<td colspan="2" align="right">
			<table>
				<tr>
					<td valign="top">
						<table>
							<tr>
								<td><font face="arial,helvetica" size="2">Width</font></td>
								<td><input name="iWIDTH" type="text" value="" size="10"></td>
							</tr>
							<tr>
								<td><font face="arial,helvetica" size="2">HSpace</font></td>
								<td><input name="iHSPACE" type="text" value="" size="10"></td>
							</tr>
							<tr>
								<td><font face="arial,helvetica" size="2">Border</font></td>
								<td><input name="iBORDER" type="text" value="0" size="10"></td>
							</tr>
						</table>
					</td>
					<td valign="top">
						<table>
							<tr>
								<td><font face="arial,helvetica" size="2">Height</font></td>
								<td><input name="iHEIGHT" type="text" value="" size="10"></td>
							</tr>
							<tr>
								<td><font face="arial,helvetica" size="2">VSpace</font></td>
								<td><input name="iVSPACE" type="text" value="" size="10"></td>
							</tr>
							<tr>
								<td><font face="arial,helvetica" size="2">Align</font></td>
								<td><select name="iALIGN" accesskey="100">
									<option value=""></option>
									<option value="left">left</option>
									<option value="right">right</option>
									<option value="top">top</option>
									<option value="middle">middle</option>
									<option value="bottom">bottom</option>
									<option value="absmiddle">absmiddle</option>
									<option value="texttop">texttop</option>
									<option value="baseline">baseline</option>												
								</select></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	</form>
</table>
</center>
</body>
</html>
