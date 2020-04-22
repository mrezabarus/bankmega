<?
	require_once("../../config.inc.php");
	
	$qgroup = cmsDB();
	$qgroup->query("SELECT group_name FROM tadmingroup WHERE group_id = ".uriParam("gid"));
	$qgroup->next();
	
	$mega_db->query("SELECT A.*, T.display_name FROM ttemp_authorized AS A, ttemplate AS T WHERE A.authorized_id = T.template_id AND A.group_id = ".uriParam("gid")." AND A.temp_type = 'TEMP' AND A.authorized_id <> ''");
	
	$arrArtAuth = array();
	$qartauth = cmsDB();
	$qartauth->query("SELECT * FROM tarticle_authorized WHERE group_id = ".uriParam("gid"));
	while($qartauth->next()){
		if(!strlen(trim($qartauth->row("template_id"))) and !strlen(trim($qartauth->row("button"))))
			$arrArtAuth[$qartauth->row("authorized_id")] = array();
		else if(!strlen(trim($qartauth->row("authorized_id"))) and !strlen(trim($qartauth->row("button"))))
			$arrArtAuth[$qartauth->row("template_id")] = array();
		else if(!strlen(trim($qartauth->row("button"))))
			$arrArtAuth[$qartauth->row("template_id").".".$qartauth->row("authorized_id")] = array();
		else if(strlen(trim($qartauth->row("template_id"))) and strlen(trim($qartauth->row("button"))) and !strlen(trim($qartauth->row("authorized_id"))))
			$arrArtAuth[$qartauth->row("template_id").".ADD"] = array();
		else
			$arrArtAuth[$qartauth->row("template_id").".".$qartauth->row("authorized_id").".".$qartauth->row("button")] = array();
	}
	//print_r($arrArtAuth);
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
		
		function getLibAuth(temp, src, dest, list){
			temptype = temp;
			srcform = src;
			destform = dest;
			inplist = list;
			if (src.selectedIndex > -1){
				sel = src.options[src.selectedIndex].value;
				window.open("artbtnauth.php","WinLib","width=300,height=225,resizable=no,toolbar=no,status=no,menu=no,scrollbars=no");
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
<table border="0" cellpadding="2" width="100%" bgcolor="#DEDEDE" cellspacing="0">
	<form name="frmedit" action="qgroup_art_auth.php?gid=<?=uriParam("gid")?>&seed=<?=mktime();?>" method="post">
	<tr>
		<td background="../../images/depan.jpg"><b><font color="#FFFFFF">Article Authorization For Group <?=$qgroup->row("group_name");?></font></b></td>    
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
					<td width="1%">8.</td>
					<td width="1%"><input type="Checkbox" name="ARTICLEMGR" value="ARTICLEMGR" class="text" <? if(array_key_exists("ARTICLEMGR",$arrArtAuth)){?>checked<?}?>></td>
					<td width="98%">Article Manager</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td colspan="2">
						<table border="0" cellpadding="2" cellspacing="0" width="100%">
							<?
								$arrArt = array();
								$qart = cmsDB();
								while($mega_db->next()){
									if(!array_key_exists($mega_db->row("authorized_id"),$arrArt)) {
										$arrArt[$mega_db->row("authorized_id")] = array();
										$qart->query("SELECT article_uid, article_id FROM tarticle WHERE template_id = '".$mega_db->row("authorized_id")."'");
							?>
										<tr>
											<td width="1%">&nbsp;</td>
											<td width="1%"><input type="Checkbox" name="ARTTEMP_<?=$mega_db->row("authorized_id");?>" value="<?=$mega_db->row("authorized_id");?>" class="text" <? if(array_key_exists($mega_db->row("authorized_id"),$arrArtAuth)){?>checked<?}?>></td>
											<td width="98%">Template : <?=$mega_db->row("display_name");?></td>
										</tr>
										<tr>
											<td width="1%">&nbsp;</td>
											<td width="1%"></td>
											<td width="98%">
												<table width="100%" border="0" cellspacing="0" cellpadding="2">
													<tr>
														<td width="1%"><input type="Checkbox" name="ARTTEMP_ADD_<?=$mega_db->row("authorized_id");?>" class="text" <? if(array_key_exists($mega_db->row("authorized_id").".ADD",$arrArtAuth)){?>checked<? } ?>></td>
														<td width="99%">Allow to add new Article</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td width="1%">&nbsp;</td>
											<td width="1%">&nbsp;</td>
											<td width="98%">
												<table width="100%" border="0" cellspacing="0" cellpadding="2">
													<tr>
														<td align="center">
															<select name="AVARTGROUP_<?=$mega_db->row("authorized_id");?>" size="6" style="width:250">
																<? while($qart->next()){?>
																	<? if(!array_key_exists($mega_db->row("authorized_id").".".$qart->row("article_uid"),$arrArtAuth)){?>
																		<option value="<?=$qart->row("article_uid")?>"><?=$qart->row("article_id")?>
																	<? } ?>
																<? } ?>
															</select>
														</td>
														<td align="center">
															<input type="Button" value="&gt;&gt;" onClick="getLibAuth('<?=$mega_db->row("authorized_id");?>',AVARTGROUP_<?=$mega_db->row("authorized_id");?>, AUTHARTGROUP_<?=$mega_db->row("authorized_id");?>, ART_AUTH_<?=$mega_db->row("authorized_id");?>)"><br /><br />
															<input type="Button" value="&lt;&lt;" onClick="getMove(AUTHARTGROUP_<?=$mega_db->row("authorized_id");?>,AVARTGROUP_<?=$mega_db->row("authorized_id");?>);getList(AUTHARTGROUP_<?=$mega_db->row("authorized_id");?>,ART_AUTH_<?=$mega_db->row("authorized_id");?>)">
															<?
																$arrbtn = array("ADD","UPDATE","DELETE","PUBLISH","SETREMOVEINDEX");
																$arrID = array();
																$artid = "";
																$qart->reset();
																while($qart->next()){
																	if(array_key_exists($mega_db->row("authorized_id").".".$qart->row("article_uid"),$arrArtAuth)){
																		$arrID[count($arrID)] = $qart->row("article_uid");
																	}
																	$artid = count($arrID) > 0 ? join(",",$arrID) : "";
																	$btnStr = array();
																	foreach($arrbtn as $btn){
																		if(array_key_exists($mega_db->row("authorized_id").".".$qart->row("article_uid").".".$btn,$arrArtAuth)){
																			$btnStr[count($btnStr)] = $btn;
																		}
																	}
																	$btn_str = count($btnStr) > 0 ? join(",",$btnStr) : "";
															?>
																<input type="hidden" name="btn_<?=$mega_db->row("authorized_id");?>_<?=$qart->row("article_uid")?>" value="<?=$btn_str;?>">
															<? } ?>
															<input type="hidden" value="<?=$artid;?>" name="ART_AUTH_<?=$mega_db->row("authorized_id");?>">
														</td>
														<td align="center">
															<select name="AUTHARTGROUP_<?=$mega_db->row("authorized_id");?>" multiple size="6" style="width:250">
																<?	
																	$qart->reset();
																	while($qart->next()){
																?>
																	<? if(array_key_exists($mega_db->row("authorized_id").".".$qart->row("article_uid"),$arrArtAuth)){?>
																		<option value="<?=$qart->row("article_uid")?>"><?=$qart->row("article_id")?>
																	<? }
																 	} ?>
															</select>
														</td>
													</tr>
												</table>
											</td>
										</tr>
								<? }
								} ?>		
						</table>
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
		<td>
			&nbsp;
			<input type="button" class="button" value="    Back    " onClick="location='group_temp_auth.php?gid=<?=uriParam("gid")?>&seed=<?=mktime();?>'">&nbsp;&nbsp;
			<input type="submit" class="button" value="    Save    ">&nbsp;&nbsp;
			<input type="button" class="button" value="    Cancel    " onClick="location='edit.php?gid=<?=uriParam("gid")?>&seed=<?=mktime();?>'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
