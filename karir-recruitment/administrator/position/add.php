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
		<td background="../images/depan.jpg"><b><font color="#FFFFFF">Add Position</font></b></td>
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
					<td><b>Position Name</b></td>
					<td><b>:</b></td>
					<td><input type="Text" name="position_name" value="" maxlength="50" class="text" size="50"></td>
				</tr>
				<tr>
					<td><b>Catagory Posisi</b></td>
				  <td><b>:</b></td>
					<td><select name="catpos_id">
                      <option value="1">Front Office</option>
                      <option value="2">Back Office</option>
                    </select></td>
				</tr>
				<tr>
					<td><b>Position Descriptions</b></td>
				  <td><b>:</b></td>
					<td><input type="Text" name="position_desc" value="" maxlength="50" class="text" size="50"></td>
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
		<td>&nbsp;<input type="submit" class="button" value="Save">&nbsp;&nbsp;<input type="Button" value="Cancel" class="button" onClick="location='index.php?seed=<?=mktime();?>'"></td>
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
	 position_name=document.frmedit.position_name.value;
	 if (position_name.length == 0) errmsg +='Position Tidak boleh Kosong!\n'; 
	 if ( errmsg.length) {
	      alert(errmsg);
	     return false;
	 } else return true;
}
</script>