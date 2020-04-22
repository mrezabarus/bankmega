<? 
	require_once("../../config.inc.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title><?=$FJR_VARS["admin_title"]?> - Edit Group</title>
	<link rel="stylesheet" type="text/css" href="../../css/admin.css">
	<SCRIPT>
		var val,txt;
		function myStruct(txt,val) {
			this.txt = txt;
			this.val = val;
		}
		
		function getMove(src,dest){
			var arrSrc = new Array();
			var arrDest = new Array();
			
			for(var i=0;i<dest.options.length;i++){
				arrDest[arrDest.length] = new myStruct(dest.options[i].text,dest.options[i].value);
			}
			
			for(var i=0;i<src.options.length;i++){
				if(src.options[i].selected == false){
					arrSrc[arrSrc.length] = new myStruct(src.options[i].text,src.options[i].value);
				}else if (src.options[i].selected == true){
					arrDest[arrDest.length] = new myStruct(src.options[i].text,src.options[i].value);
				}
			}
			
			src.options.length = 0;
			dest.options.length = 0;
			
			for(var i=0;i<arrSrc.length;i++){
				src.options[i] = new Option(arrSrc[i].txt,arrSrc[i].val);
			}
			
			for(var i=0;i<arrDest.length;i++){
				dest.options[i] = new Option(arrDest[i].txt,arrDest[i].val);
			}
		}
		
		function getList(src,inp){
			var arrList = new Array();
			for(var i=0;i<src.options.length;i++){
				arrList[arrList.length] = src.options[i].value;
			}
			inp.value = arrList.join(",");
		}
	</SCRIPT>
</head>
<?
	$mega_db = cmsDB2();
	$mega_db->query("SELECT * FROM tbl_group WHERE group_id = ".uriParam("gid"));
	$mega_db->next();
	$GROUPNAME = $mega_db->row("group_name");
	$DESC = $mega_db->row("description");
	
	//$uGroup = cmsDB();
	$uGroup = cmsDB2();
	$uGroup->query("SELECT user_id from tbl_group_hrmuser where user_id<>1 and group_id=".uriParam("gid"));
	$lstuser = $uGroup->valueList("user_id");
	if(listLen($lstuser)==0){$lstuser=0;}
	$uGroup->query("SELECT * from tbl_hrm_user where user_id<>1 and  user_id in (".$lstuser.")");
	
	//$avUser = cmsDB();
	$avUser = cmsDB2();
	$avUser->query("SELECT * from tbl_hrm_user where user_id<>1 and user_id not in (".$lstuser.")");

?>
<body onLoad="">
<table border="0" cellpadding="2" width="100%" bgcolor="#DEDEDE" cellspacing="0">
	<form name="frmedit" action="qedit.php?gid=<?=uriParam("gid");?>" method="post">
	<tr>
		<td colspan="4" background="../../images/depan.jpg"><b><font color="#FFFFFF">Edit Group</font></b></td>
	</tr>
	<tr>
		<td colspan="4">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1"></td>
                </tr>
            </table>		</td>
	</tr>
	<tr>
		<td colspan="4">
			<table border="0" cellpadding="2" cellspacing="0">
				<?
					if(isset($err)){
					echo "<tr><td class=\"errtxt\">";
						echo "Error when add group !!<br />";
						if($err == 1) echo "Group Name is Required";
						if($err == 2) echo "Group Name has existed";
					echo "</td></tr>";
					echo "<tr><td>&nbsp;</td></tr>";
					}
				?>
<tr>
					<td <? if(isset($err)){?>class="errtxt"<? } ?>>Group Name</td>
					<td>:</td>
					<td><input size="30" type="Text" name="GROUPNAME" value="<?=$GROUPNAME;?>" maxlength="50" class="text"><input type="Hidden" name="OLDGNAME" value="<?=$GROUPNAME;?>"></td>
				</tr>
				<tr>
					<td>Description</td>
					<td>:</td>
					<td ><input type="text" name="DESC" size="50" maxlength="50" class="text" value="<?=$DESC;?>"></td>
				</tr>
				<tr><td colspan="3">&nbsp;</td></tr>
				<tr>
					<td colspan="3">
						<table border="0" cellpadding="2" cellspacing="0" width="100%">
							<tr>
								<td align="center">Available User</td>
								<td>&nbsp;</td>
								<td align="center">User in Group</td>
							</tr>
							<tr>
								<td align="center">
									<select name="AVUSER" multiple size="7" style="width:200;">
										<? while($avUser->next()){ ?>
											<option value="<?=$avUser->row("user_id");?>"><?=$avUser->row("user_name");?>
										<? } ?>
									</select>                                    </td>
								<td align="center">
									<input type="Button" class="button" value="&gt;&gt;" onClick="getMove(AVUSER,USERGROUP);getList(USERGROUP,USERLIST);"><br /><br />
									<input type="Button" class="button" value="&lt;&lt;" onClick="getMove(USERGROUP,AVUSER);getList(USERGROUP,USERLIST);">
									<input type="hidden" value="<? if(isset($arrUG)) echo join(",",$arrUG)?>" name="USERLIST">								</td>
								<td align="center">
									<select name="USERGROUP" multiple size="7" style="width:200;">
										<?
											$uGroup->reset();
											while($uGroup->next()){
										?>
											<option value="<?=$uGroup->row("user_id");?>"><?=$uGroup->row("user_name");?>
										<? } ?>
									</select>                                    </td>
							</tr>
						</table>                        </td>
				</tr>
			</table>	  </td>
	</tr>
	<tr>
		<td colspan="4">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1" bgcolor="#000000"></td>
                </tr>
            </table>		</td>
	</tr>
	<tr>
		<td colspan="4"><table width="0%" border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td><input name="submit" type="submit" class="button" value="Update"></td>
            <td><input name="Button3" type="Button" class="button" onClick="location='qdelete.php?gid=<?=uriParam("gid");?>&seed=<?=mktime();?>'" value="Delete"></td>
            <td><input name="Button2" type="Button" class="button" onClick="location='index.php?seed=<?=mktime();?>'" value="Cancel"></td>
            <td><? if(uriParam("gid") <> 1){ ?>
              <input name="Button" type="Button" class="button" onClick="location='groupauth.php?gid=<?=uriParam("gid");?>&seed=<?=mktime();?>'" value="Module Authorized">
              <!--- <input type="Button" class="button" value="Region & Branch Authorized" onClick="location='templateauth.php?gid=<?=uriParam("gid");?>&seed=<?=mktime();?>'"> --->
              <? } ?></td>
          </tr>
        </table></td>
      </tr>
	</form>
</table>
</body>
</html>
