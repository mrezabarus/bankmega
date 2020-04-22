<? 
	require_once("../config.inc.php");
	if(isset($_GET["save"])){
		$save = cmsDB();
		$strsql = "update tbl_report set report_name='".trim($_POST["txtname"])."',col_1=".trim($_POST["txtcol1"]).",col_2=".trim($_POST["txtcol2"]).",start_row=".trim($_POST["txtstartrow"]).",end_row=".trim($_POST["txtendrow"]).",file_name='".trim($_POST["txtfilename"])."',delimeter='" . $_POST["txtdelimeter"] ."' where report_id=".$_GET["report_id"];
		$save->query($strsql);
		echo "<script>alert('Report Has Been Updated');location='index.php?refresh=".urlencode(date("m d Y h i s"))."';</script>";
        die();
	}
	if(isset($_GET["delete"])){
		$save = cmsDB();
		$strsql = "delete from tbl_report  where report_id=".$_GET["report_id"];
		$save->query($strsql);
		$strsql = "delete from tbl_reportdetail  where report_id=".$_GET["report_id"];
		$save->query($strsql);
		echo "<script>alert('Report Has Been Delete!!');location='index.php?refresh=".urlencode(date("m d Y h i s"))."';</script>";
		die();
	}
	$report = cmsDB();
	$strsql = "select * from tbl_report  where report_id=".$_GET["report_id"];
	$report->query($strsql);
	$report->next();
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
	<form name="frmAdd" action="edit.php?save=yes&report_id=<?=$_GET["report_id"]?>" method="post">
	<tr>
		<td background="../images/depan.jpg"><b><font color="#FFFFFF">Edit Report</font></b></td>
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
					<td>Report Name</td>
					<td>:</td>
					<td colspan="3"><input type="text" name="txtname" size="20" maxlength="255" class="text" value="<?=$report->row("report_name")?>"></td>
				</tr>
				<tr>
					<td>Coloumn 1</td>
					<td>:</td>
					<td colspan="3"><input type="text" name="txtcol1" size="5" maxlength="5" class="text" value="<?=$report->row("col_1")?>"></td>
				</tr>
				<tr>
					<td>Coloumn 2</td>
					<td>:</td>
					<td colspan="3"><input type="text" name="txtcol2" size="5" maxlength="5" class="text" value="<?=$report->row("col_2")?>"></td>
				</tr>
				<tr>
					<td>Picked Start Row</td>
					<td>:</td>
					<td colspan="3"><input type="text" name="txtstartrow" size="5" maxlength="5" class="text" value="<?=$report->row("start_row")?>"></td>
				</tr>
				<tr>
					<td>Picked End Row</td>
					<td>:</td>
					<td colspan="3"><input type="text" name="txtendrow" size="5" maxlength="5" class="text" value="<?=$report->row("end_row")?>"></td>
				</tr>
				<tr>
					<td>file Name</td>
					<td>:</td>
					<td colspan="3"><input type="text" name="txtfilename" size="40" maxlength="255" class="text" value="<?=$report->row("file_name")?>">
					exp : index.txt					</td>
				</tr>
				<tr>
					<td>Delimeter</td>
					<td>:</td>
					<td colspan="3">
						<input type="radio" name="txtdelimeter" value="chr(9)" <?if(trim($report->row("delimeter"))=="chr(9)"){ echo "checked";}?>>tab delimeter
						<input type="radio" name="txtdelimeter" value="," <?if(trim($report->row("delimeter"))==","){ echo "checked";}?>>, (comma) delimeter
						<input type="radio" name="txtdelimeter" value="|" <?if(trim($report->row("delimeter"))=="|"){ echo "checked";}?>>| (pipe) delimeter					</td>
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
		<td>&nbsp;<input type="submit" class="button" value="Update"> 
		<input type="button" class="button" value="Delete" onClick="location='edit.php?delete=yes&report_id=<?=$_GET["report_id"]?>&seed=<?=mktime()?>'">
		&nbsp;
		<input type="button" class="button" value="Cancel" onClick="location='index.php?seed=<?=mktime()?>'">
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
<br />
<?
	$reportdetail = cmsDB();
	$strsql = "select * from tbl_reportdetail  where report_id=".$_GET["report_id"];
	$reportdetail->query($strsql);
?>
<table border="0" cellpadding="2" width="100%" bgcolor="#DEDEDE" cellspacing="0">
	<tr>
		<td colspan="3" background="../images/depan.jpg"><b><font color="#FFFFFF">Report Content List</font></b></td>
	</tr>
	<tr>
		<td colspan="3">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td width="100%" height="1"></td>
                </tr>
			</table>
		</td>
	</tr>
	<tr>
		<td align="left"><b>Col 1</b></td>
	  <td align="left"><b>Col 2</b></td>
		<td align="left"><b>Insert Date</b></td>
  </tr>
	<tr>
		<td colspan="3">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1" bgcolor="#000000"></td>
                </tr>
            </table>
            </td>
	</tr>
	<? if ($reportdetail->recordCount() == 0) { ?>
	<tr>
		<td colspan="3" align="center">No Report Available...</td>
	</tr>
	<? } else { ?>
		<? while ($reportdetail->next()) { ?>
			<tr>
					<td valign="top" align="left"><?=htmlentities($reportdetail->row("col_1"))?></td>
					<td valign="top" align="left"><?=htmlentities($reportdetail->row("col_2"))?></td>
			  <td valign="top" align="left"><?=htmlentities($reportdetail->row("insert_date"))?></td>
										
  </tr>
			
		<? } ?>
	<? } ?>
	<tr>
		<td colspan="3">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1" bgcolor="#000000"></td>
                </tr>
            </table>
		</td>
	</tr>
	<tr>
		<td colspan="3">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1"></td>
                </tr>
            </table>
		</td>
	</tr>
</table>
</body>
</html>