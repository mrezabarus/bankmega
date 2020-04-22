<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>Insert Table</title>
	<script language="JavaScript">
		function MakeTable(col,row,attr) {
			if (col==0||row==0) return "";
			var result = "<table" + attr + ">\n";
			for (i=0;i<row;i++) {
				result += "<tr>\n";
				for (j=0;j<col;j++) {
					result += "<td>&nbsp;</td>\n";
				}
				result += "</tr>\n";
			} 
			result += "</table>\n";
			return result
		}
		function InsertTable() {
			var frm = document.frmInsTable;
			if (isNaN(frm.irow.value)) {
				alert('Numeric input required!');
				frm.irow.focus();
			} else if (isNaN(frm.icol.value)) {
				alert('Numeric input required!');
				frm.icol.focus();
			} else {
				var row = frm.irow.value;
				var col = frm.icol.value;
				var attr = "";
				attr += frm.iwidth.value==""?"":" width=\""+frm.iwidth.value+"\"";
				attr += isNaN(frm.iborder.value)?"":" border=\""+frm.iborder.value+"\"";
				attr += isNaN(frm.ispacing.value)?"":" cellspacing=\""+frm.ispacing.value+"\"";
				attr += isNaN(frm.ipadding.value)?"":" cellpadding=\""+frm.ipadding.value+"\"";
				attr += frm.istyle.value==""?"":" style=\""+frm.istyle.value+"\"";
				opener.<?=$formfield?>.value += MakeTable(col,row,attr);
				window.close();
				opener.focus();
			}
		}
	</script>
</head>

<body bgcolor="#DEDEDE" marginheight="0" marginwidth="0">
	<table width="100%" height="100%">
		<tr>
			<td valign="middle" align="center">
	<table cellpadding="2" cellspacing="2" border="0" align="center">
		<form name="frmInsTable">
		<tr>
			<td nowrap><font face="arial,helvetica" size="2">Row</font></td>
			<td nowrap><input name="irow" type="text" maxlength="6" width="5" size="5" value="2"></td>
			<td nowrap><font face="arial,helvetica" size="2">&nbsp;&nbsp;&nbsp;Padding</font></td>
			<td nowrap><input name="ipadding" type="text" maxlength="6" width="5" size="5" value="0"></td>
		</tr>
		<tr>
			<td nowrap><font face="arial,helvetica" size="2">Column</font></td>
			<td nowrap><input name="icol" type="text" maxlength="6" width="5" size="5" value="2"></td>
			<td nowrap><font face="arial,helvetica" size="2">&nbsp;&nbsp;&nbsp;Spacing</font></td>
			<td nowrap><input name="ispacing" type="text" maxlength="6" width="5" size="5" value="0"></td>
		</tr>
		<tr>
			<td nowrap><font face="arial,helvetica" size="2">Width</font></td>
			<td nowrap><input name="iwidth" type="text" maxlength="6" width="5" size="5" value="100%"></td>
			<td nowrap><font face="arial,helvetica" size="2">&nbsp;&nbsp;&nbsp;Border</font></td>
			<td nowrap><input name="iborder" type="text" maxlength="6" width="5" size="5" value="1"></td>
		</tr>
		<tr>
			<td nowrap><font face="arial,helvetica" size="2">Style</font></td>
			<td colspan="3" nowrap><input name="istyle" type="text" maxlength="6" width="5" size="20"></td>
		</tr>
		<tr>
			<td colspan="4" nowrap align="center" bgcolor="#C0C0C0"><input type="button" value="    Ok    " onclick="InsertTable();"> <input type="button" value=" Cancel " onclick="window.close();"></td>
		</tr>
		</form>
	</table>
			</td>
		</tr>
	</table>
</body>
</html>
