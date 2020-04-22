<?
	require_once("../../config.inc.php");
	
	$qgroup = cmsDB();
	$qauth = cmsDB();
	$qauthorization = cmsDB();
	
	$qgroup->query("SELECT group_name FROM tbl_group WHERE group_id = ".uriParam("gid"));
	$qgroup->next();

	$qauth->query("select auth_id from tbl_group_authorization where group_id= ".uriParam("gid"));
	$lstauth=$qauth->valueList("auth_id");
	$qauthorization->query("select * from tbl_authorization WHERE parent_id = 0");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>Untitled</title>
<link rel="stylesheet" type="text/css" href="../../css/admin.css">
</head>
<body>
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
	  <?
  	function NumOfSubs($Parentid){
			$objSubCounter=cmsDB();
			$strSubCounter = "select *  from tbl_authorization where parent_id=" . $Parentid;
			$objSubCounter->query($strSubCounter); 
			$NumOfSubs = $objSubCounter->recordcount();
			return $NumOfSubs;
		}
	
		Function DisplaySubs($Parentid){
			global $lstauth;
			$menuchild = cmsDB();
			$strDisplaySub = "select *  from tbl_authorization where parent_id=" . $Parentid;
			$menuchild->query($strDisplaySub);
			
			while($menuchild->next()){?>
					<input type="Checkbox" name="FILEID_<?=$menuchild->row("auth_id")?>" value="<?=$menuchild->row("auth_id")?>" <?if(listFind($lstauth,$menuchild->row("auth_id"))){ echo " checked";}?>><?=$menuchild->row("auth_name")?><BR>
					<?if (NumOfSubs($menuchild->row("auth_id")) > 0) { ?>
					<?=DisplaySubs($menuchild->row("auth_id")) ?>
					<? }
			}
		} ?>
	<tr>
		<td background="../../images/depan.jpg"><b><font color="#FFFFFF">Group Authorization : </font><font color="#f0ff00"><?=$qgroup->row("group_name");?></font></b></td>    
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
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td width="5%" align="left"><input type="checkbox" onClick="setCheck(this.checked)"></td>
					<td width="5%" align="left"><b>No.</b></td>
					<td align="left"><b>Authorization Name</b></td>
				    <td align="left"><b>Access Name</b></td>
				</tr>
				<tr>
					<td colspan="4">
						<table border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                            <td width="100%" height="1" bgcolor="#000000"></td>
                            </tr>
                        </table>					</td>
				</tr>
				<?
				$no = 1;
				while($qauthorization->next()){
					$auth_name = $qauthorization->row("auth_name");
					$parent_id = $qauthorization->row("parent_id");
					$auth_id = $qauthorization->row("auth_id");
				?>
					<tr valign="top">
						<td width="5%" align="left"><input type="Checkbox" name="FILEID_<?=$qauthorization->row("auth_id")?>" value="<?=$qauthorization->row("auth_id")?>" <?if(listFind($lstauth,$qauthorization->row("auth_id"))){ echo "checked";}?>></td>
						<td width="5%" align="left"><?=$no?>.</td>
						<td width="29%" align="left"><?=$auth_name?></td>
					    <td width="61%" align="left">
						<?
							if(NumOfSubs($qauthorization->row("auth_id"))>0){
								echo DisplaySubs($qauthorization->row("auth_id"));
							}
							?>
						</td>
			  </tr>
				<?$no++;
						}?>
				<input type="hidden" name="FILECOUNT" value="<?=$no?>">
	  </table>	  </td>
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
		<td>
			&nbsp;
			<input type="submit" class="button" value="    Save    ">
			&nbsp;&nbsp;
			<input type="Button" value="    Cancel    " class="button" onClick="location='edit.php?gid=<?=uriParam("gid")?>&seed=<?=mktime();?>'">
&nbsp;&nbsp;		</td>
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