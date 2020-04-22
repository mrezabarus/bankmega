<?
	require_once("../../config.inc.php");
	
	$qgroup = cmsDB();
	$qauth = cmsDB();
	$qauthorization = cmsDB();
	
	$qgroup->query("SELECT group_name FROM tadmingroup WHERE group_id = ".uriParam("gid"));
	$qgroup->next();

	$qauth->query("select auth_id from tadmingroup_authorized where group_id= ".uriParam("gid"));
	$lstauth=$qauth->valueList("auth_id");
	$qauthorization->query("select * from tbl_authorization");
?>
<body>
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
<table border="0" cellpadding="2" width="100%" bgcolor="#DEDEDE" cellspacing="0">
	<form name="frmauthor" action="qgroupauthor.php?gid=<?=uriParam("gid");?>" method="post">
	<tr>
		<td background="../../images/depan.jpg"><b><font color="#FFFFFF">Group Authorization : </font><font color="#f0ff00"><?=$qgroup->row("group_name");?></font></b></td>    
	</tr>
	<tr>
		<td>
			<table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td width="100%" height="1"><table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td width="100%" height="1"></td></tr></table></td></tr></table>
		</td>
	</tr>
	<tr>
		<td>
			<table border="0" cellpadding="2" cellspacing="0" width="100%">
				<tr>
					<td width="10%" align="left"><input type="checkbox" onClick="setCheck(this.checked)"><b>No.</b></td>
					<td align="left"><b>Authorization Name</b></td>
				</tr>
				<tr>
					<td colspan="2">
						<table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td width="100%" height="1" bgcolor="#000000"><table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td width="100%" height="1"></td></tr></table></td></tr></table>
					</td>
				</tr>
				<?
				$no = 1;
				while($qauthorization->next()){?>
					<tr>
						<td width="10%" align="left"><input type="Checkbox" name="FILEID_<?=$no?>" value="<?=$qauthorization->row("auth_id")?>" <?if(listFind($lstauth,$qauthorization->row("auth_id"))){ echo "checked";}?>>&nbsp;<?=$no?>.</td>
						<td align="left"><?=$qauthorization->row("auth_name")?></td>
					</tr>
				<?
					$no++;
				}?>
				<input type="hidden" name="FILECOUNT" value="<?=$no?>">
			</table>
		</td>
	</tr>
	<tr>
		<td>
			<table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td width="100%" height="1" bgcolor="#000000"><table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td width="100%" height="1"></td></tr></table></td></tr></table>
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
	</form>
</table>

</body>
</html>
