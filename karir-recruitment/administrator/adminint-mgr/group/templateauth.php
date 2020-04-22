<?
	require_once("../../config.inc.php");
	
	$qgroup = cmsDB();
	$qauth = cmsDB();
	$qauthorization = cmsDB();
	
	$qgroup->query("SELECT group_name FROM tbl_group WHERE group_id = ".uriParam("gid"));
	$qgroup->next();
	
	$qauthorization->query("select distinct(region_name) as grp from tbl_region order by grp asc");
	$lstgroup=$qauthorization->valueList("grp");
	
	//$qauth->query("select template_id from tadmingroup_template where group_id= ".uriParam("gid"));
	$qauth->query("select branch_name from tbl_branch where region_id= ".uriParam("gid"));
	$lstauth=$qauth->valueList("branch_name");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>Untitled</title>

<link rel="stylesheet" type="text/css" href="../../css/admin.css">
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
  <!--
		function setCheck(state) {
			var frmEL = document.frmauthor.elements;
			var idx;
			for (var i=1;i<=frmEL["FILECOUNT"].value;i++) {
				idx = "FILEID_" + i;
				frmEL[idx].checked = state;
			}
		}
		
		function IsOneChecked() {
			var frmEL = document.frmauthor.elements;
			var idx;
			for (var i=1;i<=frmEL["FILECOUNT"].value;i++) {
				idx = "FILEID_" + i;
				if (frmEL[idx].checked) return true;
			}
			return false;
		}
  //-->
  </SCRIPT>
</head>
<body>
<table border="0" cellpadding="2" width="100%" bgcolor="#DEDEDE" cellspacing="0">
	<form name="frmauthor" action="qtemplateauth.php?gid=<?=uriParam("gid");?>" method="post">
	<tr>
		<td background="../../images/depan.jpg"><b><font color="#FFFFFF">Group Region & Branch Authorization : </font><font color="#f0ff00"><?=$qgroup->row("group_name");?></font></b></td>
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
					<td width="5%" align="left"><input type="checkbox" onClick="setCheck(this.checked)"></td>
					<td align="left"><b>Group Region &amp; Branch</b></td>
				</tr>
				<tr>
					<td colspan="2">
						<table border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                            <td width="100%" height="1" bgcolor="#000000"></td>
                            </tr>
                        </table>					</td>
				</tr>
				<?
				//echo $lstgroup;
				$no = 1;
				for($i=1;$i<=listLen($lstgroup);$i++){
					$qauth->query("select * from tbl_region where region_name='" . trim(listGetAt($lstgroup,$i)). "'");
				?>
					<tr>
							<td align="left" colspan="3"><b>[<?=trim(listGetAt($lstgroup,$i))?>]</b></td>
			  </tr>
					<?
					while($qauth->next()){
					?>
						<tr>
							<td width="5%" align="left"><input type="Checkbox" name="FILEID_<?=$no?>" value="<?=$qauth->row("region_id")?>" <? if(listFind($lstauth,$qauth->row("branch_name"))){ echo "checked";} ?>>&nbsp;</td>
							<td align="left">-&nbsp;
						    <?=$qauth->row("branch_name")?></td>
			  </tr>
					<?
						$no++;
					}
				} ?>
			</table>
		  <input type="hidden" name="FILECOUNT" value="<?=$no?>">
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
			<input type="submit" class="button" value="    Save    ">
			&nbsp;&nbsp;
			<input type="Button" value="    Cancel    " class="button" onClick="location='edit.php?gid=<?=uriParam("gid")?>&seed=<?=mktime();?>'">
			&nbsp;&nbsp;
			
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