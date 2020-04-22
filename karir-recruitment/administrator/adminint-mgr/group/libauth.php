<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>Button Authorization</title>
	<link rel="stylesheet" type="text/css" href="../../css/admin.css">
	<script>
		function getAuth(){
			var arrCheck = new Array();
			for(i=0;i<document.frmedit.cAuth.length;i++){
				if(document.frmedit.cAuth[i].checked){
					arrCheck[arrCheck.length] = document.frmedit.cAuth[i].value;
				}
			}
			if(arrCheck.length != null){
				eval("opener.frmedit."+opener.temptype+"_prop_"+opener.sel).value = arrCheck.join(",");
				opener.moveValue();
			}
			self.close();
		}
		
		function initialized() {
			var arr = eval("opener.frmauthor."+opener.inpForm).value.split(",");
			for(j=0;j<arr.length;j++){
				for(i=0;i<document.frmedit.cAuth.length;i++){
					if(document.frmedit.cAuth[i].value == arr[j]){
						document.frmedit.cAuth[i].checked = true;
						break;
					}
				}
			}
		}
	</script>
</head>
<body marginheight="0" marginwidth="0" topmargin="0" leftmargin="0">
<table border="0" cellpadding="2" width="100%" bgcolor="#DEDEDE" cellspacing="0">
	<form name="frmedit" action="" method="post">
	<tr>
		<td background="../../images/depan.jpg"><b><font color="#FFFFFF">Button Authorization</font></b></td>
	</tr>
	<tr>
		<td>
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1"></td>
                </tr>
            </table>
		</td>
	</tr>
	<tr>
		<td>
			<table border="0" cellpadding="2" cellspacing="0" width="100%">
				<tr>
					<td width="1%"><input type="Checkbox" class="text" name="cAuth" value="UPDATE"></td>
					<td width="99%">UPDATE</td>
				</tr>
				<tr>
					<td width="1%"><input type="Checkbox" class="text" name="cAuth" value="DELETE"></td>
					<td width="99%">DELETE</td>
				</tr>
				<tr>
					<td width="1%"><input type="Checkbox" class="text" name="cAuth" value="PUBLISH"></td>
					<td width="99%">PUBLISH</td>
				</tr>
				<tr>
					<td width="1%"><input type="Checkbox" class="text" name="cAuth" value="SETREMOVEINDEX"></td>
					<td width="99%">SET/REMOVE INDEX</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1" bgcolor="#000000"></td>
                </tr>
            </table>
		</td>
	</tr>
	<tr>
		<td>
			&nbsp;
			<input type="Button" class="button" value="    OK    " onClick="getAuth();">&nbsp;&nbsp;
			<input type="Button" value="    Close    " class="button" onClick="self.close();">
		</td>
	</tr>
	<tr>
		<td>
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1"></td>
                </tr>
            </table>
		</td>
	</tr>
	</form>
</table>
</body>
</html>