<? 
	require_once("../config.inc.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="../css/admin.css">
<title><?=$FJR_VARS["admin_title"]?> - My Profile</title>
</head>
<body onLoad="">
<table border="0" cellpadding="2" width="100%" bgcolor="#DEDEDE" cellspacing="0">
	<form name="frmedit" action="qadd.php" method="post" onSubmit="return Check()">
	<tr>
		<td background="../images/depan.jpg"><b><font color="#FFFFFF">Add Region Area</font></b></td>
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
			<table border="0" cellpadding="2" cellspacing="0">
				
				<tr>
					<td>Region Name</td>
					<td>:</td>
					<td><input type="Text" name="region_name" value="" maxlength="50" class="text" size="50" onKeyUp="this.value=this.value.toUpperCase()"></td>
				</tr>
				<tr>
					<td>Region Descriptions</td>
					<td>:</td>
					<td><input type="Text" name="region_desc" value="" maxlength="50" class="text" size="50"></td>
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
		<td>&nbsp;<input type="submit" class="button" value="    Save    ">&nbsp;&nbsp;<input type="Button" value="    Cancel    " class="button" onClick="location='index.php?seed=<?=mktime();?>'"></td>
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
<script>
function Check() {
     var errmsg='';
	 region_name=document.frmedit.region_name.value;
	 if (region_name.length == 0) errmsg +='Nama Region Wajib diisi!\n'; 
	 if ( errmsg.length) {
	      alert(errmsg);
	     return false;
	 } else return true;
}
</script>