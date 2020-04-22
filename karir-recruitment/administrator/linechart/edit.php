<? 
	require_once("../config.inc.php");
	$strSQL = "select * from tbl_chart where chart_id=".$_GET["chart_id"];
	$mega_db->query($strSQL);
	$mega_db->next();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title><?=$FJR_VARS["admin_title"]?> - Chart Manager - Edit Template</title>

</head>
<script>
function _showmenuprop(x){
	if (x==1){
		document.all["test1"].style.visibility = 'visible';
		document.all["test2"].style.visibility = 'hidden';
		
	}else{
		document.all["test1"].style.visibility = 'hidden';
		document.all["test2"].style.visibility = 'visible';
		
	}
}
</script>
<link rel="stylesheet" type="text/css" href="../css/admin.css">
<body onLoad="<?if($mega_db->row("report_id")<>0){ echo "_showmenuprop(1)";}else{ echo "_showmenuprop(2)";}?>">
<table border="0" cellpadding="2" width="100%" bgcolor="#DEDEDE" cellspacing="0">
	<form name="frmEdit" action="qedit.php?chart_id=<?=$_GET["chart_id"]?>" method="post">
	<tr>
		<td background="../images/depan.jpg"><b><font color="#FFFFFF">Edit Chart</font></b></td>
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
					<td>Chart Title</td>
					<td>:</td>
					<td colspan="3"><input type="text" name="txtname" size="20" maxlength="255" class="text" value="<?=htmlentities($mega_db->row("chart_name"))?>"></td>
				</tr>
				<tr>
					<td valign="top">Description</td>
					<td valign="top">:</td>
					<td colspan="3"><textarea name="txtdesc" cols="40" rows="5"><?=htmlentities($mega_db->row("chart_desc"))?></textarea></td>
				</tr>
				<tr>
					<td>X Title</td>
					<td>:</td>
					<td colspan="3"><input type="text" name="txtxname" size="20" maxlength="255" class="text" value="<?=htmlentities($mega_db->row("x_title"))?>"></td>
				</tr>
				<tr>
					<td>Y Title</td>
					<td>:</td>
					<td colspan="3"><input type="text" name="txtyname" size="20" maxlength="255" class="text" value="<?=htmlentities($mega_db->row("y_title"))?>"></td>
				</tr>
				<tr>
					<td>Panjang</td>
					<td>:</td>
					<td colspan="3"><input type="text" name="txtpanjang" size="10" maxlength="255" class="text" value="<?=htmlentities($mega_db->row("panjang"))?>"> px</td>
				</tr>
				<tr>
					<td>Lebar</td>
					<td>:</td>
					<td colspan="3"><input type="text" name="txtlebar" size="10" maxlength="255" class="text" value="<?=htmlentities($mega_db->row("lebar"))?>"> px</td>
				</tr>
				<tr>
					<td>Type</td>
					<td>:</td>
					<td colspan="3">
					<select name="selchart">
						<option value="1" <? if($mega_db->row("type")==1){echo "selected";}?>>Line Chart</option>
						<option value="2" <? if($mega_db->row("type")==2){echo "selected";}?>>Bar Chart</option>
						<option value="3" <? if($mega_db->row("type")==3){echo "selected";}?>>Table Diagram</option>
					</select>					</td>
				</tr>
				<tr>
					<td rowspan="2">Get Data From Report Manager</td>
					<td rowspan="2">:</td>
					<td rowspan="2">&nbsp;</td>
					<td>
					<input type="Radio" name="chkreport" value="1" onClick="_showmenuprop(1)" <? if($mega_db->row("report_id")<>0){ echo "checked";} ?>>Yes
					<input type="Radio" name="chkreport" value="2" onClick="_showmenuprop(2)" <? if($mega_db->row("report_id")==0){ echo "checked";} ?>>No
					<?
						$report = cmsDB();
						$report->query("select report_id,report_name from tbl_report");
						
					?>
                    </td>
			  		<td rowspan="2">
						<div id="test2" style="visibility: visible;">
						<input type="Hidden" name="txtreport" value="0">
						</div>					</td>
				</tr>
				<tr>
				  <td>					<div id="test1" style="visibility: visible;">
						<select name="selreport">
							<? while($report->next()){?>
								<option value="<?=$report->row("report_id")?>" <? if($mega_db->row("report_id")==$report->row("report_id")){ echo "selected";} ?>><?=$report->row("report_name")?></option>
							<? } ?>
						</select>
					</div>
</td>
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
		<input type="submit" class="button" value="    Update    "> 
		<input type="button" class="button" value="  Delete      " onClick="location='qdelete.php?chart_id=<?=$_GET["chart_id"]?>&seed=<?=mktime()?>'">
		<input type="button" class="button" value="  Cancel      " onClick="location='index.php?seed=<?=mktime()?>'"></td>
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
</table><br />
<?
include "index-detail.php";
?>
</body>
</html>
