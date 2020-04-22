<? 
	require_once("../../config.inc.php");
	$mega_db = cmsDB2();
	if(isset($_GET["save"])){
		//echo postParam("USERLIST");
		$mega_db->query("delete from tbl_branch_hrmuser where branch_id = ".uriParam("branch_id"));
		if(listLen(postParam("USERLIST"))){
			for($i=1;$i<=listLen(postParam("USERLIST"));$i++){
				$mega_db->query("insert into tbl_branch_hrmuser(branch_id,user_id) values(".uriParam("branch_id").",".listGetAt(postParam("USERLIST"),$i).")");
			}
			echo "<script>alert('Branch User Updated');location='regionbranch.php';</script>";
		}else{
			echo "<script>alert('Branch User Updated');location='regionbranch.php';</script>";
		}
		die();
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title><?=$FJR_VARS["admin_title"]?> - Edit Region & Branch User</title>
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
	$mega_db->query("SELECT region_name,branch_name,branch_id FROM tbl_branch inner join tbl_region on tbl_branch.region_id=tbl_region.region_id WHERE tbl_branch.branch_id = ".uriParam("branch_id"));
	$mega_db->next();

	
	//$uGroup = cmsDB();
	$uGroup = cmsDB2();
	$uGroup->query("SELECT user_id from tbl_branch_hrmuser where user_id <> 1 and branch_id=".uriParam("branch_id"));
	$lstuser = $uGroup->valueList("user_id");
	if(listLen($lstuser)==0){$lstuser=0;}
	$uGroup->query("SELECT * from tbl_hrm_user where user_id<>1 and  user_id in (".$lstuser.")");
	
	//$avUser = cmsDB();
	$avUser = cmsDB2();
	$avUser->query("SELECT * from tbl_hrm_user where user_id<>1 and user_id not in (".$lstuser.")");

?>
<body onLoad="">
<table border="0" cellpadding="2" width="100%" bgcolor="#DEDEDE" cellspacing="0">
	<form name="frmedit" action="regionbranch_edit.php?save=yes&branch_id=<?=uriParam("branch_id");?>" method="post">
	<tr>
		<td colspan="4" background="../../images/depan.jpg"><b><font color="#FFFFFF">Edit Region and Branch User</font></b></td>
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
				<tr>
					<td colspan="3">
                    <table border="0" cellspacing="0" cellpadding="2">
                      <tr>
                        <td>Region Name&nbsp;</td>
                        <td>:</td>
                        <td>&nbsp;<b><?=$mega_db->row("region_name")?></b></td>
                      </tr>
                      <tr>
                        <td>Branch Name&nbsp;</td>
                        <td>:</td>
                        <td>&nbsp;<b><?=$mega_db->row("branch_name")?></b></td>
                      </tr>
                    </table></td>
				</tr>
				
				<tr><td colspan="3">&nbsp;</td></tr>
				<tr>
					<td colspan="3">
						<table border="0" cellpadding="2" cellspacing="0" width="100%">
							<tr>
								<td align="center"><b>Available User</b></td>
								<td>&nbsp;</td>
								<td align="center"><b>User in Branch</b></td>
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
            <td>&nbsp;</td>
            <td><input name="Button2" type="Button" class="button" onClick="location='regionbranch.php?seed=<?=mktime();?>'" value="Cancel"></td>
            <td></td>
          </tr>
        </table></td>
      </tr>
	</form>
</table>
</body>
</html>
