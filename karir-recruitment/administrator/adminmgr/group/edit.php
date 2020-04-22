<? 
	require_once("../../config.inc.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title><?=$FJR_VARS["admin_title"]?> - Edit Group</title>
	<link rel="stylesheet" type="text/css" href="../../css/admin.css">
	<style>
		.errtxt {color:red;}
	</style>
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
	$mega_db->query("SELECT * FROM tadmingroup WHERE group_id = ".uriParam("gid"));
	$mega_db->next();
	$GROUPNAME = postParam("GROUPNAME",$mega_db->row("group_name"));
	$DESC = postParam("DESC",$mega_db->row("description"));
	
	$uGroup = cmsDB();
	$uGroup->query("SELECT G.*, U.username 
	                FROM tadmingroup_user AS G, tadmin AS U 
					WHERE G.admin_id = U.admin_id 
					AND G.group_id = ".uriParam("gid"));
	$arrUG = array();
	while($uGroup->next()){
		$arrUG[count($arrUG)] = $uGroup->row("admin_id");
	}
	
	$avUser = cmsDB();
	$SQL = "SELECT * FROM tadmin WHERE issuperadmin <> 1";
	if(count($arrUG) > 0){
		$SQL .= " AND admin_id NOT IN (".join(",",$arrUG).")";
	}
	$avUser->query($SQL);
?>

<body onLoad="">
<table border="0" cellpadding="2" width="100%" bgcolor="#DEDEDE" cellspacing="0">
	<form name="frmedit" action="qedit.php?gid=<?=uriParam("gid");?>" method="post">
	<tr>
		<td colspan="4" background="../../images/depan.jpg"><b><font color="#FFFFFF">Edit Group</font></b></td>
	</tr>
	<tr>
		<td>
			<table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td width="100%" height="1"><table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td width="100%" height="1"></td></tr></table></td></tr></table>
		</td>
	</tr>
	<tr>
		<td>
			<table border="0" cellpadding="2" cellspacing="0">
				<?
					if(isset($err)){
					echo "<tr><td class=\"errtxt\">";
						echo "Error when add group !!<br>";
						if($err == 1) echo "Group Name is Required";
						if($err == 2) echo "Group Name has existed";
					echo "</td></tr>";
					echo "<tr><td>&nbsp;</td></tr>";
					}
				?>
				<tr>
					<td <?if(isset($err)){?>class="errtxt"<?}?>>Group Name</td>
					<td <?if(isset($err)){?>class="errtxt"<?}?>>:</td>
					<td><input type="Text" name="GROUPNAME" value="<?=$GROUPNAME;?>" maxlength="50" class="text"><input type="Hidden" name="OLDGNAME" value="<?=$GROUPNAME;?>"></td>
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
										<?while($avUser->next()){?>
											<option value="<?=$avUser->row("admin_id");?>"><?=$avUser->row("username");?>
										<?}?>
									</select>								</td>
								<td align="center">
									<input type="Button" class="button" value="&gt;&gt;" onClick="getMove(AVUSER,USERGROUP);getList(USERGROUP,USERLIST);"><br><br>
									<input type="Button" class="button" value="&lt;&lt;" onClick="getMove(USERGROUP,AVUSER);getList(USERGROUP,USERLIST);">
									<input type="hidden" value="<?if(isset($arrUG)) echo join(",",$arrUG)?>" name="USERLIST">								</td>
								<td align="center">
									<select name="USERGROUP" multiple size="7" style="width:200;">
										<?
											$uGroup->reset();
											while($uGroup->next()){
										?>
											<option value="<?=$uGroup->row("admin_id");?>"><?=$uGroup->row("username");?>
										<?}?>
									</select>								</td>
							</tr>
						</table>					</td>
				</tr>
			</table>
	  </td>
	</tr>
	<tr>
		<td>
			<table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td width="100%" height="1" bgcolor="#000000"><table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td width="100%" height="1"></td></tr></table></td></tr></table>
		</td>
	</tr>
	<tr>
		<td><table border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td><input type="submit" class="button" value="    Update    "></td>
                <td><input type="Button" value="    Delete    " class="button" onClick="location='qdelete.php?gid=<?=uriParam("gid");?>&seed=<?=mktime();?>'"></td>
                <td><input type="Button" value="    Cancel    " class="button" onClick="location='index.php?seed=<?=mktime();?>'"></td>
                <td><?if(uriParam("gid") <> 1){?>
                  <input type="Button" class="button" value="Module Authorized" onClick="location='groupauth.php?gid=<?=uriParam("gid");?>&seed=<?=mktime();?>'">
                  <!--input type="Button" class="button" value="Template Authorized" onClick="location='templateauth.php?gid=<?=uriParam("gid");?>&seed=<?=mktime();?>'" -->
                  <?}?></td>
              </tr>
            </table></td>
	</tr>
	</form>
</table>
</body>
</html>