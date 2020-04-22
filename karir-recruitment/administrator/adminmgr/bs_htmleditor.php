<?

//error_reporting(0);
	$bs_buttons["cut"]["id"] = "5003";$bs_buttons["cut"]["image"] = "images/cut.gif";$bs_buttons["cut"]["alt"] = "Cut";
	$bs_buttons["copy"]["id"] = "5002";$bs_buttons["copy"]["image"] = "images/copy.gif";$bs_buttons["copy"]["alt"] = "Copy";
	$bs_buttons["paste"]["id"] = "5032";$bs_buttons["paste"]["image"] = "images/paste.gif";$bs_buttons["paste"]["alt"] = "Paste";
	$bs_buttons["undo"]["id"] = "5049";$bs_buttons["undo"]["image"] = "images/undo.gif";$bs_buttons["undo"]["alt"] = "Undo";
	$bs_buttons["redo"]["id"] = "5033";$bs_buttons["redo"]["image"] = "images/redo.gif";$bs_buttons["redo"]["alt"] = "Redo";
	$bs_buttons["font"]["id"] = "5009";$bs_buttons["font"]["image"] = "images/fontprop.gif";$bs_buttons["font"]["alt"] = "Font";
	$bs_buttons["bold"]["id"] = "5000";$bs_buttons["bold"]["image"] = "images/bold.gif";$bs_buttons["bold"]["alt"] = "Bold";
	$bs_buttons["italic"]["id"] = "5023";$bs_buttons["italic"]["image"] = "images/italic.gif";$bs_buttons["italic"]["alt"] = "Italic";
	$bs_buttons["underline"]["id"] = "5048";$bs_buttons["underline"]["image"] = "images/under.gif";$bs_buttons["underline"]["alt"] = "Underline";
	$bs_buttons["outdent"]["id"] = "5031";$bs_buttons["outdent"]["image"] = "images/deindent.gif";$bs_buttons["outdent"]["alt"] = "Decrease Indent";
	$bs_buttons["indent"]["id"] = "5018";$bs_buttons["indent"]["image"] = "images/inindent.gif";$bs_buttons["indent"]["alt"] = "Indent";
	$bs_buttons["justifyleft"]["id"] = "5025";$bs_buttons["justifyleft"]["image"] = "images/left.gif";$bs_buttons["justifyleft"]["alt"] = "Align Left";
	$bs_buttons["justifycenter"]["id"] = "5024";$bs_buttons["justifycenter"]["image"] = "images/center.gif";$bs_buttons["justifycenter"]["alt"] = "Center";
	$bs_buttons["justifyright"]["id"] = "5026";$bs_buttons["justifyright"]["image"] = "images/right.gif";$bs_buttons["justifyright"]["alt"] = "Align Right";
	$bs_buttons["bullets"]["id"] = "5051";$bs_buttons["bullets"]["image"] = "images/bullist.gif";$bs_buttons["bullets"]["alt"] = "Bullets";
	$bs_buttons["numbers"]["id"] = "5030";$bs_buttons["numbers"]["image"] = "images/numlist.gif";$bs_buttons["numbers"]["alt"] = "Numbering";
	$bs_buttons["find"]["id"] = "5008";$bs_buttons["find"]["image"] = "images/find.gif";$bs_buttons["find"]["alt"] = "Find";
	$bs_buttons["table"]["id"] = "5022";$bs_buttons["table"]["image"] = "images/instable.gif";$bs_buttons["table"]["alt"] = "Insert Table";
	$bs_buttons["image"]["id"] = "5017";$bs_buttons["image"]["image"] = "images/image.gif";$bs_buttons["image"]["alt"] = "Insert Image";
	$bs_buttons["help"]["id"] = "6003";$bs_buttons["help"]["image"] = "images/help.gif";$bs_buttons["help"]["alt"] = "Help";
	$bs_buttons["hyperlink"]["id"] = "5016";$bs_buttons["hyperlink"]["image"] = "images/link.gif";$bs_buttons["hyperlink"]["alt"] = "Insert Hyperlink";
	$bs_buttons["unlink"]["id"] = "5050";$bs_buttons["unlink"]["image"] = "images/unlink.gif";$bs_buttons["unlink"]["alt"] = "Remove Link";
	$bs_buttons["showdetails"]["id"] = "6004";$bs_buttons["showdetails"]["image"] = "images/paragraph.gif";$bs_buttons["showdetails"]["alt"] = "Show Details";
	$bs_buttons["hr"]["id"] = "6009";$bs_buttons["hr"]["image"] = "images/hr.gif";$bs_buttons["hr"]["alt"] = "Insert Horizontal Line";
	$bs_buttons["save"]["id"] = "6005";$bs_buttons["save"]["image"] = "images/save.gif";$bs_buttons["save"]["alt"] = "Save the document!";
	$bs_buttons["specialchars"]["id"] = "6008";$bs_buttons["specialchars"]["image"] = "images/specialchar.gif";$bs_buttons["specialchars"]["alt"] = "Insert Special Character!";
	$bs_buttons["border"]["id"] = "6010";$bs_buttons["border"]["image"] = "images/border.gif";$bs_buttons["border"]["alt"] = "Show Borders";
	$bs_buttons["quickfontcolor"]["id"] = "6011";$bs_buttons["quickfontcolor"]["image"] = "images/fgcolor.gif";$bs_buttons["quickfontcolor"]["alt"] = "Font Color";
	$bs_buttons["bodybgcolor"]["id"] = "6007";$bs_buttons["bodybgcolor"]["image"] = "images/simbgcolor.gif";$bs_buttons["bodybgcolor"]["alt"] = "Simulate Document Background Color";
	$bs_buttons["file"]["id"] = "6012";$bs_buttons["file"]["image"] = "images/insertfile.gif";$bs_buttons["file"]["alt"] = "Insert Hyperlink to File Repository";
	
	$quickfonts = array("Arial","Tahoma","Courier New","Helvetica","Times New Roman","Verdana","Wingdings");

function jsformat($str) {
	$result = $str;
	$result = str_replace("\\","\\\\",$result); $result = str_replace("\f","\\f",$result); $result = str_replace("\b","\\b",$result); $result = str_replace("\r","\\r",$result);
	$result = str_replace("\t","\\t",$result); $result = str_replace("\'","\\'",$result); $result = str_replace("\"","\\\"",$result); $result = str_replace("\n","\\n",$result);
	return $result;
}

function BS_HTMLEDIT($fieldname,$formname,$content,$width,$height,$inc,$toolbar,$baseurl,$body_attr) {
	global $bs_num, $_ENV, $quickfonts, $bs_buttons;
	$bs_num++;
	if (!is_array($toolbar)) $toolbar = array("save","undo","redo","cut","copy","paste","find","bold","italic","underline","justifyleft",
																						"justifycenter","justifyright","numbers","bullets","outdent","indent","image","file",
																						"border","showdetails",
																						"||","quickformat","quickfont","quickfontsize","quickfontcolor","font","specialchars","hr","unlink","hyperlink","table","help");
	$IsMSIE = strpos(strtoupper($_ENV["HTTP_USER_AGENT"]),"MSIE") && strpos(strtoupper($_ENV["HTTP_USER_AGENT"]),"WIN");
	if ($IsMSIE) {
		if (strcmp(substr($inc,strlen($inc)),"/")==0) $inc = $inc."/";
?>
	<script language="JavaScript">
  	<? if ($bs_num==1) { ?>
			var bs_fieldname = new Array();				
			var bs_sourceview = new Array();				
			var bs_baseurl = new Array();				
			var inc = '<?=$inc?>';
			var bs_form = 'document.<?=$formname?>';
			var body_attr = new Array();
		<? } ?>
		
		var foo = new Array();
		<?if (is_array($body_attr)){?>
			<?if(isset($body_attr['background'])){?>foo['background'] = "<?=jsformat($body_attr['background'])?>";<?}else{?>foo['background'] = "";<?}?>
			<?if(isset($body_attr['bgcolor'])){?>foo['bgcolor'] = "<?=jsformat($body_attr['bgcolor'])?>";<?}else{?>foo['bgcolor'] = "";<?}?>
			<?if(isset($body_attr['text'])){?>foo['text'] = "<?=jsformat($body_attr['text'])?>";<?}else{?>foo['text'] = "";<?}?>
		<?}?>
		body_attr[<?=$bs_num?>] = foo;

		var errlevel = 2;
		bs_baseurl[<?=$bs_num?>] = "<?=$baseurl?>";
		bs_sourceview[<?=$bs_num?>] = false;
	</script>
 	<? if ($bs_num==1) { ?>
		<script language="JavaScript" src="<?=$inc?>dhtmled.js"></script>
		<script language="JavaScript" id="clientEventHandlersJS" src="<?=$inc?>bs_jshtmleditor.php?SEED=<?=urlencode(mktime("mdYHis"))?>"></script>
		<script language="JavaScript">
			if (errlevel == 2){
				document.write("<span style=\"font: 10pt Arial\">HTML Editor Error : Cannot load editor!");
				document.write("<comment>");
			}
		</script>
		<script language="javascript" src="<?=$inc?>user.js"></script>
		<style type="text/css">
			.disabled {filter:mask() mask(color=buttonshadow) dropshadow(offX=1,offY=1,color=buttonhighlight,positive=1);width:23;height:22;margin:1px;padding:0px;vertical-align:middle;border-width:0;visibility:visible;}
			.flat {width:23;height:22;margin:0px;padding:0px;vertical-align:middle;border-width:1px;border-color:buttonface;border-style:solid;visibility:visible;}		
			.outset {width:23;height:22;margin:0px;padding:0px;vertical-align:middle;border:1px solid;border-left-color:buttonhighlight;border-top-color:buttonhighlight;border-right-color:buttonshadow;border-bottom-color:buttonshadow;visibility:visible;}
			.inset {width:23;height:22;margin:0px;padding:0px;vertical-align:middle;border-width:1px;border-style:inset;visibility:visible;}
			.latched {width:23;height:22;margin:0px;padding:0px;vertical-align:middle;border-width:1px;border-style:inset;background-color:buttonface;visibility:visible;}
			.spc {margin:0;padding:0;vertical-align:middle;}
			table.bs_tableClass {border:1px outset;cursor:default;background-color:buttonshadow;}
			tr.bs_trClass {background-color:buttonface;}
			td.bs_tdClass {background-color:buttonface;}
		</style>
	<? } ?>
	
	<table bgcolor="buttonface" cellpadding="0" cellspacing="0" width="<?=$width?>" height="<?=$height?>" ondragstart="window.event.returnValue=false;" onselectstart="window.event.returnValue=false;" class="bs_tableClass">
		<tr class="bs_trClass">
			<td valign="bottom" colspan="2" class="bs_tdClass">
			<? if ($bs_num==1) { ?><iframe id="frame1" style="position:absolute; visibility:hidden; width:0; height:0; z-index:2;" vspace=0 hspace=0 marginheight="0" marginwidth="0" scrolling="no"></iframe><iframe id="frame2" style="position:absolute; visibility:hidden; width:10; height:10; z-index:2;" vspace=0 hspace=0 marginheight="0" marginwidth="0" scrolling="no"></iframe><? } ?>
				<table cellspacing=2 cellpadding=0 border=0>
					<tr valign="middle">
						<td width=10><img src="<?=$inc?>images/spacer.gif" width=9 height=24 alt=""></td>
						<td><span id="bs_tbar<?=$bs_num?>" onmouseover="bs_m_over(window.event.srcElement);" onmousedown="bs_m_down(window.event.srcElement);" onmouseup="bs_m_up(window.event.srcElement);" onmouseout="bs_m_out(window.event.srcElement);" ondragstart="window.event.returnValue=false;" onselectstart="window.event.returnValue=false;"><nobr>
						<? foreach ($toolbar as $btn) { ?>
							<? if (strcmp($btn,"|")==0) { ?><img src="<?=$inc?>images/space.gif" class="spc"><wbr><? } elseif (strcmp($btn,"||")==0) { ?><br><? } elseif (strcmp($btn,"quickfont")==0) { ?><img src="<?=$inc?>images/spacer.gif" width="1" height="24" style="vertical-align:middle;"><select size="1" id="oQuickFont<?=$bs_num?>" style="font:8pt Verdana;vertical-align:middle;" onchange="bs_quickfont(<?=$bs_num?>);">
								<? foreach ($quickfonts as $fontname) { ?><option name="<?=$fontname?>" value="<?=$fontname?>"><?=$fontname?></option><? } ?>
							<select><? } elseif (strcmp($btn,"quickformat")==0) { ?><img src="<?=$inc?>images/spacer.gif" width="1" height="24" style="vertical-align:middle;"><select size="1" id="oQuickFormat<?=$bs_num?>" style="width:120px;font:8pt Verdana;vertical-align:middle;" onchange="bs_quickformat(<?=$bs_num?>);"></select><? } elseif (strcmp($btn,"quickfontsize")==0) { ?><img src="<?=$inc?>images/spacer.gif" width="1" height="24" style="vertical-align:middle;"><select size="1" id="oQuickFontSize<?=$bs_num?>" style="width:40px;font:8pt Verdana;vertical-align:middle;" onchange="bs_quickfontsize(<?=$bs_num?>);">
								<option name="bs_fs1" value=1>8</option>
								<option name="bs_fs2" value=2>10</option>
								<option name="bs_fs3" value=3>12</option>
								<option name="bs_fs4" value=4>14</option>
								<option name="bs_fs5" value=5>18</option>
								<option name="bs_fs6" value=6>24</option>
								<option name="bs_fs7" value=7>36</option>
							</select><? } elseif ( in_array($btn,array_keys($bs_buttons)) ) { ?><img alt="<?=$bs_buttons[$btn]["alt"]?>" onclick="bs_onCommand(null, <?=$bs_num?>)" src="<?=$inc?><?=$bs_buttons[$btn]["image"]?>" type="btn" class="flat" cid="<?=$bs_buttons[$btn]["id"]?>"
							<? if (strcmp($btn,"table")==0) { ?>
								onDragStart="return false" onmouseover="bs_m_over(bs_tdrop<?=$bs_num?>);" onmouseout="bs_m_out(bs_tdrop<?=$bs_num?>);" 
								name="bs_tbtn<?=$bs_num?>"><img alt="Quick Table" onclick="onTable(<?=$bs_num?>)" onDragStart="return false" 
											onmouseover="bs_m_over(bs_tbtn<?=$bs_num?>);" onmouseout="bs_m_out(bs_tbtn<?=$bs_num?>);" 
											name="bs_tdrop<?=$bs_num?>" status="Insert a table" src="<?=$inc?>images/tbdown.gif" 
											type="btn" class="flat" style="width:9;" cid=5022
							<? } ?><? if (strcmp($btn,"specialchars")==0) { ?> name="bs_sc<?=$bs_num?>" <? } ?><? if (strcmp($btn,"quickfontcolor")==0) { ?> name="bs_qfc<?=$bs_num?>" <? } ?><? if (strcmp($btn,"bodybgcolor")==0) { ?> name="bs_bbgc<?=$bs_num?>" <? } ?>><? } ?>
						<? }  ?></nobr><br><img src="<?=$inc?>images/spacer.gif" width=1 height=1 alt=""></td>
					</tr>
				</table>
			</td>
			<td class="bs_tdClass">&nbsp;</td>
		</tr>
		<tr class="bs_trClass">
			<td class="bs_tdClass">&nbsp;</td>
			<td class="bs_tdClass" width="100%" height="100%" align="center">
				<OBJECT style="z-index:1;" classid="clsid:2D360201-FFF5-11d1-8D03-00A0C959BC0A" width="100%" height="100%" id="DHTMLSafe<?=$bs_num?>">
					<PARAM NAME=ScrollbarAppearance VALUE=0>
				</OBJECT>
				<script LANGUAGE="javascript" FOR="DHTMLSafe<?=$bs_num?>" EVENT="ShowContextMenu">
					return ShowMenu(<?=$bs_num?>);
				</script>
				<script LANGUAGE="javascript" FOR="DHTMLSafe<?=$bs_num?>" EVENT="onerror">
					return false;
				</script>
				<script LANGUAGE="javascript" FOR="DHTMLSafe<?=$bs_num?>" EVENT="onpaste">
					return false;
				</script>
				<script LANGUAGE="javascript" FOR="DHTMLSafe<?=$bs_num?>" EVENT="onkeypress">
					return bs_onkeypress(<?=$bs_num?>);
				</script>
				<script LANGUAGE="javascript" FOR="DHTMLSafe<?=$bs_num?>" EVENT="onbeforepaste">
					return false;
				</script>
				<script LANGUAGE="javascript" FOR="DHTMLSafe<?=$bs_num?>" EVENT="onmousedown">
					return bs_onmousedown(<?=$bs_num?>);
				</script>
				<script LANGUAGE="javascript" FOR="DHTMLSafe<?=$bs_num?>" EVENT="onclick">
					return bs_onclick(<?=$bs_num?>);
				</script>
				<script LANGUAGE="javascript" FOR="DHTMLSafe<?=$bs_num?>" EVENT="DisplayChanged">
					return bs_ondisplaychange(<?=$bs_num?>);
				</script>
				<script LANGUAGE="javascript" FOR="DHTMLSafe<?=$bs_num?>" EVENT="ContextMenuAction(itemIndex)">
					return bs_onmenuaction(itemIndex);
				</script>
				</td>
				<td class="bs_tdClass">&nbsp;</td>
			</tr>
			<tr class="bs_trClass">
				<td colspan="3" class="bs_tdClass">
					<table cellspacing=0 cellpadding=0 border=0 width="100%">
						<tr>
							<td><img src="<?=$inc?>images/spacer.gif" width="20" height="1"><img src="<?=$inc?>images/normaltabon.gif" width="49" height="11" border="0" alt="" name="normaltab<?=$bs_num?>" onclick="bs_editsourceinline(<?=$bs_num?>, false)"><img src="<?=$inc?>images/htmltaboff.gif" width="41" height="11" border="0" alt="" name="htmltab<?=$bs_num?>" onclick="bs_editsourceinline(<?=$bs_num?>, true)"></td>
							<td align="right"></td>
						</tr>					
					</table>
				</td>
			</tr><? if (!ereg("<body[^>]+",$content)) $content = "<body>".$content."</body>"; ?>
		</table><textarea style="visibility:hidden;display:none" id="bs_tx_content<?=$bs_num?>" name="<?=$fieldname?>"><?=$content?></textarea><script>bs_initialize(<?=$bs_num?>);</script>
<? } else {
		$width = str_replace("%","",$width);
		$height = str_replace("%","",$height);
		$cols = floor($width/6) > 10?floor($width/6):80;
		$rows = floor($height/16) > 10?floor($height/16):18;
?>
		<script language="JavaScript">
			<? if ($bs_num==1) { ?>
				inc = '<?=jsformat($inc)?>';
				bs_form = "document.<?=$formname?>";
				bs_fieldname = new Array();
			<? } ?>
			bs_fieldname[<?=$bs_num?>] = "<?=$fieldname?>";
		</script>
		<? if ($bs_num==1) { ?>
			<script language="JavaScript" src="<?=$inc?>dhtmled.js"></script>
			<script language="JavaScript" src="<?=$inc?>ns_js.php?SEED=<?=urlencode(mktime("mdYHis"))?>"></script>
		<? } ?>
		<table cellpadding="1" cellspacing="0" border="0">
		<tr>
			<td bgcolor="#000000">
		<table cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td bgcolor="#DEDEDE">
				<table cellpadding="0" cellspacing="2" border="0">
				<tr>
					<td>
						<table cellpadding="2" cellspacing="1" border="0">
						<tr bgcolor="#EDEDED">
							<?foreach ($toolbar as $btn) {?>
								<?if($btn=="||") {?>
								</tr><tr bgcolor="#EDEDED">
								<?}?>
								<?if($btn=="bold") {?>
								<td><a href="javascript:void(0);" target="_self" onclick="bs_menuaction(<?=$bs_buttons[$btn]['id']?>,<?=$bs_num?>);return false;"><img src="<?=$inc.$bs_buttons[$btn]['image']?>" border="0"></a></td>
								<?}?>
								<?if($btn=="italic") {?>
								<td><a href="javascript:void(0);" target="_self" onclick="bs_menuaction(<?=$bs_buttons[$btn]['id']?>,<?=$bs_num?>);return false;"><img src="<?=$inc.$bs_buttons[$btn]['image']?>" border="0"></a></td>
								<?}?>
								<?if($btn=="underline") {?>
								<td><a href="javascript:void(0);" target="_self" onclick="bs_menuaction(<?=$bs_buttons[$btn]['id']?>,<?=$bs_num?>);return false;"><img src="<?=$inc.$bs_buttons[$btn]['image']?>" border="0"></a></td>
								<?}?>
								<?if($btn=="specialchars") {?>
								<td><a href="javascript:void(0);" target="_self" onclick="bs_menuaction(<?=$bs_buttons[$btn]['id']?>,<?=$bs_num?>);return false;"><img src="<?=$inc.$bs_buttons[$btn]['image']?>" border="0"></a></td>
								<?}?>
								<?if($btn=="save") {?>
								<td><a href="javascript:void(0);" target="_self" onclick="bs_menuaction(<?=$bs_buttons[$btn]['id']?>,<?=$bs_num?>);return false;"><img src="<?=$inc.$bs_buttons[$btn]['image']?>" border="0"></a></td>
								<?}?>
								<?if($btn=="hyperlink") {?>
								<td><a href="javascript:void(0);" target="_self" onclick="bs_menuaction(<?=$bs_buttons[$btn]['id']?>,<?=$bs_num?>);return false;"><img src="<?=$inc.$bs_buttons[$btn]['image']?>" border="0"></a></td>
								<?}?>
								<?if($btn=="table") {?>
								<td><a href="javascript:void(0);" target="_self" onclick="bs_menuaction(<?=$bs_buttons[$btn]['id']?>,<?=$bs_num?>);return false;"><img src="<?=$inc.$bs_buttons[$btn]['image']?>" border="0"></a></td>
								<?}?>
								<?if($btn=="hr") {?>
								<td><a href="javascript:void(0);" target="_self" onclick="bs_menuaction(<?=$bs_buttons[$btn]['id']?>,<?=$bs_num?>);return false;"><img src="<?=$inc.$bs_buttons[$btn]['image']?>" border="0"></a></td>
								<?}?>
								<?if($btn=="image") {?>
								<td><a href="javascript:void(0);" target="_self" onclick="bs_menuaction(<?=$bs_buttons[$btn]['id']?>,<?=$bs_num?>);return false;"><img src="<?=$inc.$bs_buttons[$btn]['image']?>" border="0"></a></td>
								<?}?>
								<?if($btn=="file") {?>
								<td><a href="javascript:void(0);" target="_self" onclick="bs_menuaction(<?=$bs_buttons[$btn]['id']?>,<?=$bs_num?>);return false;"><img src="<?=$inc.$bs_buttons[$btn]['image']?>" border="0"></a></td>
								<?}?>
							<?}?>
							<td><a href="javascript:void(0);" target="_self" onclick="bs_menuaction(6013,<?=$bs_num?>)"><img src="<?=$inc?>images/preview.gif" border="0"></a></td>
						</tr>		
						</table>
					</td>
				</tr>
				<tr><td><textarea name="<?=$fieldname?>" COLS="<?=$cols?>" ROWS="<?=$rows?>" WRAP="off"><?=$content?></textarea></td></tr>
				<tr>
					<td>
						<table cellpadding="2" cellspacing="1" border="0" width="100%">
							<tr bgcolor="#C0C0C0">
								<td><font face="arial,helvetica" size="1">This Editor is designed for IE4+/Windows for fully operational features...</font></td>
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
		</table>
<?
	}
}

?>

