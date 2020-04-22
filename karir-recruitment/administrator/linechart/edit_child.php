<? 
	require_once("../config.inc.php");
	
	if(isset($_GET["finish"])){
		$strsql = "update tbl_chartmember set chart_value='".trim(postParam("txtvalue",""))."',chart_desc='".trim(postParam("txtlegend",""))."' where chartchild_id=".$_GET["chartchild_id"];
		$mega_db->query($strsql);
		$message = "Chart Detail Updated succesfully!";
		
		jsAlertAndNavigate($message,"edit.php?chart_id=".$_GET["chart_id"]."&seed=".mktime(),true);
		die();
	}

	if(isset($_GET["delete"])){
		$strsql = "delete from tbl_chartmember where chartchild_id=".$_GET["chartchild_id"];
		$mega_db->query($strsql);
		$message = "Chart Detail Deleted succesfully!";
		
		jsAlertAndNavigate($message,"edit.php?chart_id=".$_GET["chart_id"]."&seed=".mktime(),true);
		die();
	}
	
	$strsql = "select * from tbl_chartmember where chartchild_id=".$_GET["chartchild_id"];
	$mega_db->query($strsql);
	$mega_db->next();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title><?=$FJR_VARS["admin_title"]?> - Chart Detail Manager - Add Detail</title>
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
	<SCRIPT LANGUAGE="JavaScript" SRC="../js/taeditor.js" TYPE="text/javascript"></SCRIPT>
	<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
  <!--
  	var oContent;
		function editorInit() {
			oContent = new taEditor(document,document.frmAdd.CONTENT);
		}
  //-->
  </SCRIPT>
</head>

<body >
<table border="0" cellpadding="2" width="100%" bgcolor="#DEDEDE" cellspacing="0">
	<form name="frmeditChild" action="edit_child.php?finish=yes&chart_id=<?=$_GET["chart_id"]?>&chartchild_id=<?=$_GET["chartchild_id"]?>" method="post">
	<tr>
		<td background="../images/depan.jpg"><b><font color="#FFFFFF">Edit Detail Chart</font></b></td>
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
					<td>Chart Legend</td>
					<td>:</td>
					<td colspan="3"><input type="text" name="txtlegend" size="20" maxlength="255" class="text" value="<?=htmlentities($mega_db->row("chart_desc"))?>"></td>
				</tr>
				<tr>
					<td>Chart Value</td>
					<td>:</td>
					<td colspan="3"><input type="text" name="txtvalue" size="20" maxlength="255" class="text" value="<?=htmlentities($mega_db->row("chart_value"))?>"></td>
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
		<td>&nbsp;
		<input type="submit" class="button" value="Update"> 
		<input type="button" class="button" value="Delete" onClick="location='edit_child.php?delete=yes&chart_id=<?=$_GET["chart_id"]?>&chartchild_id=<?=$_GET["chartchild_id"]?>&seed=<?=mktime()?>'">
		<input type="button" class="button" value="Cancel" onClick="location='edit.php?chart_id=<?=$_GET["chart_id"]?>&seed=<?=mktime()?>'"></td>
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
