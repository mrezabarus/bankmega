<?
	require_once("../../config.inc.php");
	
	$qgroup = cmsDB();
	$qgroup->query("SELECT group_name FROM tadmingroup WHERE group_id = ".uriParam("gid"));
	$qgroup->next();
	
	$tempAuth = array();
	$mega_db->query("SELECT * FROM ttemp_authorized WHERE group_id = ".uriParam("gid"));
	while($mega_db->next()){
		if(!strlen(trim($mega_db->row("authorized_id")))){
			$tempAuth[$mega_db->row("temp_type")] = array();
			if(strlen(trim($mega_db->row("button")))){
				$tempAuth[$mega_db->row("temp_type").".".$mega_db->row("button")] = array();
			}
		}else if(!strlen(trim($mega_db->row("button")))){
			$tempAuth[$mega_db->row("temp_type").".".$mega_db->row("authorized_id")] = array();
		}else{
			$tempAuth[$mega_db->row("temp_type").".".$mega_db->row("authorized_id").".".$mega_db->row("button")] = array();
		}
	}
	//print_r($tempAuth);
	
	$mega_db2 = cmsDB();
	$mega_db2->query("SELECT * FROM ttemplate");
	
	$mega_db3 = cmsDB();
	$mega_db3->query("SELECT * FROM ttemplate_part");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>Untitled</title>
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
		
		var temptype, srcform, destform, inplist;
		var sel = 0;
		
		function getLibAuth(type, src, dest, list){
			temptype = type;
			srcform = src;
			destform = dest;
			inplist = list;
			if (src.selectedIndex > -1){
				sel = src.options[src.selectedIndex].value;
				window.open("libauth.php","WinLib","width=300,height=200,resizable=no,toolbar=no,status=no,menu=no,scrollbars=no");
			}
		}
		
		function moveValue(){
			getMove(srcform,destform);
			getList(destform,inplist);
		}
		
		function checkParent(parentForm,sibling,childForm){
			var sibCheck = false;
			if(childForm.checked){
				sibCheck = true;
			}else{
				var sib = sibling.split(",");
				for(i=0;i<sib.length;i++){
					if(eval("document.frmedit."+sib[i]).checked){
						sibCheck = true;
						break;
					}
				}
			}
			parentForm.checked = sibCheck;
		}
		
		function checkChild(parentForm,childList){
			var arr = childList.split(",");
			for(i=0;i<arr.length;i++){
				eval("document.frmedit."+arr[i]).checked = parentForm.checked;
			}
		}
	</SCRIPT>
</head>

<body>
<table border="0" cellpadding="4" width="100%" bgcolor="#DEDEDE" cellspacing="0">
	<form name="frmedit" action="qgroup_temp_auth.php?gid=<?=uriParam("gid")?>&seed=<?=mktime();?>" method="post">
	<tr>
		<td bgcolor="#000000"><font color="#FFFFFF"><b>Template Authorization For Group <?=$qgroup->row("group_name");?></b></font></td>
	</tr>
	<tr>
		<td>
			<table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td width="100%" height="1"><table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td width="100%" height="1"></td></tr></table></td></tr></table>
		</td>
	</tr>
	<tr>
		<td>
			<table border="0" cellpadding="4" cellspacing="0" width="100%">
				<tr>
					<td width="1%">7.</td>
					<td width="1%"><input type="Checkbox" name="TEMPLATEMGR" value="TEMPLATEMGR" class="text" onClick="checkChild(this,'TEMP,SHAREDTEMP');" <?if(array_key_exists("TEMPLATEMGR",$tempAuth)){?>checked<?}?>></td>
					<td width="98%">Template Manager</td>
				</tr>
				<tr>
					<td width="1%">&nbsp;</td>
					<td width="1%">&nbsp;</td>
					<td width="98%">
						<table width="70%" border="0" cellspacing="0" cellpadding="2">
							<tr>
								<td width="1%"><input type="Checkbox" name="TEMP" class="text" onClick="checkParent(TEMPLATEMGR,'SHAREDTEMP',this)" <?if(array_key_exists("TEMP",$tempAuth)){?>checked<?}?>></td>
								<td width="99%">Templates</td>
							</tr>
							<tr>
								<td width="1%">&nbsp;</td>
								<td width="99%">
									<table width="100%" border="0" cellspacing="0" cellpadding="2">
										<tr>
											<td width="1%"><input type="Checkbox" name="TEMP_ADD" value="ADD" class="text" <?if(array_key_exists("TEMP.ADD",$tempAuth)){?>checked<?}?>></td>
											<td width="99%">Allow to add new Template</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width="1%">&nbsp;</td>
								<td width="99%">
									<table width="100%" border="0" cellspacing="0" cellpadding="2">
										<tr>
											<td align="center">
												<select name="AVTEMP" size="5" style="width:200" class="text">
													<?while($mega_db2->next()){?>
														<?if(!array_key_exists("TEMP.".$mega_db2->row("template_id"),$tempAuth)){?>
															<option value="<?=$mega_db2->row("template_id");?>"><?=$mega_db2->row("display_name")?>
														<?}?>
													<?}?>
												</select>
											</td>
											<td align="center">
												<input type="Button" value="&gt;&gt;" onClick="getLibAuth('TEMP',AVTEMP, AUTHTEMP,TEMP_AUTH)">
												<br><br>
												<input type="Button" value="&lt;&lt;" onClick="getMove(AUTHTEMP,AVTEMP);getList(AUTHTEMP,TEMP_AUTH)">
													<?
														$mega_db2->reset();
														$str = array();
														$arrbtn = array("UPDATE","DELETE","PUBLISH","SETROMEVINDEX");
														while($mega_db2->next()){
															if(array_key_exists("TEMP.".$mega_db2->row("template_id"),$tempAuth)){
																$str[count($str)] = $mega_db2->row("template_id");
															}
															$strbtn = array();
															foreach($arrbtn as $btn){
																if(array_key_exists("TEMP.".$mega_db2->row("template_id").".".$btn,$tempAuth)){
																	$strbtn[count($strbtn)] = $btn;
																}
															}
															$btn = count($strbtn) > 0 ? join(",",$strbtn) : "";
													?>
															<input type="hidden" name="TEMP_prop_<?=$mega_db2->row("template_id")?>" value="<?=$btn;?>">
													<?
														}
													?>
												<input type="hidden" value="<?=join(",",$str);?>" name="TEMP_AUTH">
											</td>
											<td align="center">
												<select name="AUTHTEMP" size="5" multiple style="width:200" class="text">
													<?
														$mega_db2->reset();
														while($mega_db2->next()){
													?>
														<?if(array_key_exists("TEMP.".$mega_db2->row("template_id"),$tempAuth)){?>
															<option value="<?=$mega_db2->row("template_id");?>"><?=$mega_db2->row("display_name")?>
														<?}?>
													<?}?>
												</select>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr><td colspan="3">&nbsp;</td></tr>
							<tr>
								<td width="1%"><input type="Checkbox" name="SHAREDTEMP" class="text" onClick="checkParent(TEMPLATEMGR,'TEMP',this)" <?if(array_key_exists("SHAREDTEMP",$tempAuth)){?>checked<?}?>></td>
								<td width="99%" nowrap>Shared Template Parts</td>
							</tr>
							<tr>
								<td width="1%">&nbsp;</td>
								<td width="99%">
									<table width="100%" border="0" cellspacing="0" cellpadding="2">
										<tr>
											<td width="1%"><input type="Checkbox" name="SHAREDTEMP_ADD" value="ADD" class="text" <?if(array_key_exists("SHAREDTEMP.ADD",$tempAuth)){?>checked<?}?>></td>
											<td width="99%">Allow to add new Shared Template Parts</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width="1%">&nbsp;</td>
								<td width="99%" colspan="2">
									<table width="100%" border="0" cellspacing="0" cellpadding="2">
										<tr>
											<td align="center">
												<select name="AVSHAREDTEMP" size="5" style="width:200" class="text">
													<?while($mega_db3->next()){?>
														<?if(!array_key_exists("SHAREDTEMP.".$mega_db3->row("tp_id"),$tempAuth)){?>
															<option value="<?=$mega_db3->row("tp_id")?>"><?=$mega_db3->row("tp_id")?>
														<?}?>
													<?}?>
												</select>
											</td>
											<td align="center">
												<input type="Button" value="&gt;&gt;" onClick="getLibAuth('SHAREDTEMP',AVSHAREDTEMP, AUTHSHAREDTEMP,SHAREDTEMP_AUTH)">
												<br><br>
												<input type="Button" value="&lt;&lt;" onClick="getMove(AUTHSHAREDTEMP,AVSHAREDTEMP);getList(AUTHSHAREDTEMP,SHAREDTEMP_AUTH)">
												<?
													$mega_db3->reset();
													$str = array();
													$arrbtn = array("UPDATE","DELETE","PUBLISH","SETREMOVEINDEX");
													while($mega_db3->next()){
														if(array_key_exists("SHAREDTEMP.".$mega_db3->row("tp_id"),$tempAuth)){
															$str[count($str)] = $mega_db3->row("tp_id");
														}
														$strbtn = array();
														foreach($arrbtn as $btn){
															if(array_key_exists("SHAREDTEMP.".$mega_db3->row("tp_id").".".$btn,$tempAuth)){
																$strbtn[count($strbtn)] = $btn;
															}
														}
															$btn = count($strbtn) > 0 ? join(",",$strbtn) : "";
												?>
													<input type="hidden" value="<?=$btn;?>" name="SHAREDTEMP_prop_<?=$mega_db3->row("tp_id");?>">
												<?
													}
												?>
												<input type="hidden" value="<?=join(",",$str);?>" name="SHAREDTEMP_AUTH">
											</td>
											<td align="center">
												<select name="AUTHSHAREDTEMP" size="5" multiple style="width:200" class="text">
													<?
														$mega_db3->reset();
														while($mega_db3->next()){
													?>
														<?if(array_key_exists("SHAREDTEMP.".$mega_db3->row("tp_id"),$tempAuth)){?>
															<option value="<?=$mega_db3->row("tp_id")?>"><?=$mega_db3->row("tp_id")?>
														<?}?>
													<?}?>
												</select>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
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
		<td>
			&nbsp;
			<input type="button" class="button" value="    Back    " onClick="location='groupauth.php?gid=<?=uriParam("gid")?>&seed=<?=mktime();?>'">&nbsp;&nbsp;
			<input type="submit" class="button" value="    Save    ">&nbsp;&nbsp;
			<input type="button" class="button" value="    Cancel    " onClick="location='edit.php?gid=<?=uriParam("gid")?>&seed=<?=mktime();?>'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="submit" class="button" value="    Save & Go To Article Authorization    " onClick="selAct.value='GoToArticleAuth'">
			<input type="Hidden" name="selAct" value="">
		</td>
	</tr>
	<tr>
		<td>
			<table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td width="100%" height="1"><table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td width="100%" height="1"></td></tr></table></td></tr></table>
		</td>
	</tr>
	</form>
</table>

</body>
</html>
