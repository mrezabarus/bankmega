<? 
	require_once("../config.inc.php");
	if(isset($_GET["save"])){
		$save = cmsDB();
		$strsql = "insert into tbl_report(report_name,col_1,col_2,start_row,end_row,file_name,delimeter) values";
		$strsql .= "('".trim($_POST["txtname"])."',".trim($_POST["txtcol1"]).",".trim($_POST["txtcol2"]).",".trim($_POST["txtstartrow"]).",".trim($_POST["txtendrow"]).",'".trim($_POST["txtfilename"])."','" . $_POST["txtdelimeter"]. "')";
		$save->query($strsql);
		echo "<script>alert('Report Has Been Sent');location='index.php?refresh=".urlencode(date("m d Y h i s"))."';</script>";die();
		
	}
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title><?=$FJR_VARS["admin_title"]?> - Report Manager - Add Template</title>
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
	<form name="frmAdd" action="add.php?save=yes" method="post">
	<tr>
		<td background="../images/depan.jpg"><b><font color="#FFFFFF">Add Report</font></b></td>
	</tr>
	<tr>
		<td>
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1"></td>
                </tr>
            </table>		</td>
	</tr>
	<tr>
		<td>
			<table border="0" cellpadding="2" cellspacing="0" width="100%">
				<tr>
					<td>Report Name :</td>
					<td colspan="3"><input type="text" name="txtname" size="20" maxlength="255" class="text" value=""></td>
				</tr>
				<tr>
					<td>Coloumn 1 :</td>
					<td colspan="3"><input type="text" name="txtcol1" size="5" maxlength="5" class="text" value="1"></td>
				</tr>
				<tr>
					<td>Coloumn 2 :</td>
					<td colspan="3"><input type="text" name="txtcol2" size="5" maxlength="5" class="text" value="2"></td>
				</tr>
				<tr>
					<td>Picked Start Row :</td>
					<td colspan="3"><input type="text" name="txtstartrow" size="5" maxlength="5" class="text" value="1"></td>
				</tr>
				<tr>
					<td>Picked End Row :</td>
					<td colspan="3"><input type="text" name="txtendrow" size="5" maxlength="5" class="text" value="2"></td>
				</tr>
				<tr>
					<td>file Name :</td>
					<td colspan="3"><input type="text" name="txtfilename" size="40" maxlength="255" class="text" value="">
					exp : index.txt					</td>
				</tr>
				<tr>
					<td>Delimeter :</td>
					<td colspan="3">
						<input type="radio" name="txtdelimeter" value="chr(9)" checked>tab delimeter
						<input type="radio" name="txtdelimeter" value=",">, (comma) delimeter
						<input type="radio" name="txtdelimeter" value="|">| (pipe) delimeter					</td>
				</tr>
			</table>		</td>
	</tr>	
	<tr>
		<td>
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1" bgcolor="#000000"></td>
                </tr>
            </table>		</td>
	</tr>
	<tr>
		<td>&nbsp;<input type="submit" class="button" value="Save">&nbsp;
	    <input type="button" class="button" value="Cancel" onClick="location='index.php?seed=<?=mktime()?>'"></td>
      </tr>
	<tr>
		<td>
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1"></td>
                </tr>
            </table>		</td>
	</tr>
	</form>
</table>
</body>
</html>