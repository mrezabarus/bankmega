<? 
	require_once("../../config.inc.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../../css/admin.css">
</head>
<?
	$GROUPNAME = postParam("GROUPNAME","");
	$DESC = postParam("DESC","");
?>
<body onLoad="">
<table border="0" cellpadding="2" width="100%" bgcolor="#DEDEDE" cellspacing="0">
	<form name="frmedit" action="qadd.php" method="post">
	<tr>
		<td background="../../images/depan.jpg"><b><font color="#FFFFFF">Add Group</font></b></td>
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
			<table border="0" cellpadding="4" cellspacing="0">
				<?
					if(isset($err)){
					echo "<tr><td class=\"errtxt\">";
						echo "Error add group !!<br />";
						if($err == 1) echo "Group Name wajib diisi";
						if($err == 2) echo "Group Name sudah ada";
					echo "</td></tr>";
					echo "<tr><td>&nbsp;</td></tr>";
					}
				?>
		  <tr>
					<td <? if(isset($err)){ ?>class="errtxt"<? } ?>>Group Name</td>
			<td>:</td>
			<td><input size="30" type="Text" name="GROUPNAME" value="<?=$GROUPNAME;?>" maxlength="50" class="text"></td>
			  </tr>
				<tr>
					<td>Description</td>
					<td>:</td>
					<td ><input type="text" name="DESC" size="50" maxlength="50" class="text" value="<?=$DESC;?>"></td>
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